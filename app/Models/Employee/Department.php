<?php

namespace App\Models\Employee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Department extends Model
{
    protected $table = 'department';
    protected $guarded = [];

    public static function getDepList($page_size, $page, $sorted, $filtered)
    {
        $orgid = auth()->user()->orgid;

        if ($page == 0) {
            $start_page = 0;
        } else {
            $start_page = ($page * $page_size);
        }

        $query = DB::table('department as d')
            ->leftjoin('department as dep', 'dep.id', '=', 'd.parentdepid')
            ->leftjoin('location as l', 'l.id', '=', 'd.locationid')
            ->where('d.orgid', '=', $orgid)
            ->select(DB::raw('(CASE WHEN(d.parentdepid<>0) THEN  dep.depname ELSE "--" END)  as parent_depname '), 'd.*', 'locname');


        $nquery = DB::table('department as d')
            ->leftjoin('department as dep', 'dep.id', '=', 'd.parentdepid')
            ->leftjoin('location as l', 'l.id', '=', 'd.locationid')
            ->where('d.orgid', '=', $orgid)
            ->select(DB::raw('(CASE WHEN(d.parentdepid<>0) THEN  dep.depname ELSE "--" END)  as parent_depname '), 'd.*', 'locname');


        if (!empty($start_page)) {
            $query->offset($start_page);
        }

        if ($page_size) {
            $query->limit($page_size);
        }

        if (!empty($filtered)) {
            foreach ($filtered as $filter) {
                if ($filter['id'] == 'parent_depname') {
                    $query->where('dep.depname', 'like', "%" . $filter['value'] . "%");

                    $nquery->where('dep.depname', 'like', "%" . $filter['value'] . "%");
                } else {
                    $query->where('d.' . $filter['id'], 'like', "%" . $filter['value'] . "%");

                    $nquery->where('d.' . $filter['id'], 'like', "%" . $filter['value'] . "%");
                }
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
        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {
            $array[$i]['id'] = $row->id;
            $array[$i]['depname'] = $row->depname;
            $array[$i]['depcode'] = $row->depcode;
            $array[$i]['parent_depname'] = $row->parent_depname;
            $array[$i]['locname'] = $row->locname;
            $array[$i]['isactive'] = $row->isactive;
            $i++;
        }

        $all_filtered_data = $nquery->get();
        $count = count($all_filtered_data);

        $no_of_pages = ceil($count / $page_size);

        return array('rows' => $array, 'pages' => $no_of_pages);
    }
}