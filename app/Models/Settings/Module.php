<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Http\Request;
use DB;

class Module extends Model
{
    protected $table = 'modules';
    protected $guarded = [];
    public function parent()
    {
        return $this->hasOne('App\Models\Settings\Module', 'id', 'parentmodule')
            ->Select('id', 'parentmodule', 'displaytext as value', 'displaytext as label', 'displaytext as title');
    }
    public function children()
    {
        return $this->hasMany('App\Models\Settings\Module', 'parentmodule', 'id')
            ->Select('id', 'parentmodule', 'displaytext as value', 'displaytext as label', 'displaytext as title');
    }

    public static function tree()
    {
        return static::with(implode('.', array_fill(0, 4, 'children')))
            ->where('parentmodule', '=', '0')
            ->Select('id', 'parentmodule', 'displaytext as value', 'displaytext as label', 'displaytext as title')
            ->get();
    }
    public static function getTableData($page_size, $page, $sorted, $filtered)
    {
        $softwareid = auth()->user()->softwareid;
        if ($page == 0) {
            $start_page = 0;
        } else {
            $start_page = ($page * $page_size);
        }
        $query = DB::table('modules as  m')
            ->leftJoin('modules as s', 's.id', '=', 'm.parentmodule')
            ->select(DB::raw('(CASE WHEN(m.parentmodule<>0) THEN  s.displaytext ELSE "--" END)  as parentm '), 'm.*')
            ->where('m.softwareid', $softwareid);
        //->get();
        // print_r($query);
        // die();
        $nquery = DB::table('modules as m')
            ->leftJoin('modules  as s', 's.id', '=', 'm.parentmodule')
            ->select(DB::raw('(CASE WHEN(m.parentmodule<>0) THEN  s.displaytext ELSE "--" END)  as parentm '), 'm.*')
            ->where('m.softwareid', $softwareid);
        // ->get();
        // print_r($nquery);
        // die();

        if (!empty($start_page)) {
            $query->offset($start_page);
        }
        if ($page_size) {
            $query->limit($page_size);
        }
        if (!empty($filtered)) {
            // echo "<pre></pre>";
            // print_r($filtered);
            // die();
            foreach ($filtered as $filter) {
                $query->where('m.' . $filter['id'], 'like', "%" . $filter['value'] . "%");

                $nquery->where('m.' . $filter['id'], 'like', "%" . $filter['value'] . "%");
            }
        }

        if (!empty($sorted)) {
            foreach ($sorted as $sort) {
                $sort_by = $sort['desc'];

                if ($sort_by == true) {
                    $sort_type = 'DESC';
                } else {
                    $sort_type = 'ASC';
                }
                $query->orderBy($sort['id'], $sort_type);

                $nquery->orderBy($sort['id'], $sort_type);
            }
        }
        $data = $query->get();
        // echo"<pre>";
        // print_r($data);
        // die();

        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {
            $array[$i]['id'] = $row->id;
            $array[$i]['parentmodule'] = $row->parentm;
            $array[$i]['displaytext'] = $row->displaytext;
            $array[$i]['displaytextnp'] = $row->displaytextnp;
            $array[$i]['modulelink'] = $row->modulelink;
            $array[$i]['icon'] = $row->icon;
            $i++;
        }

        $all_filtered_data = $nquery->get();
        $count = count($all_filtered_data);
        $data = $query->get();

        // echo"<pre>";
        // print_r($data);
        // die();

        $no_of_pages = ceil($count / $page_size);

        return array('rows' => $array, 'pages' => $no_of_pages);
    }
}