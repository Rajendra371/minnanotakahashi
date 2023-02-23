<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;


class UserGroup extends Model
{
    protected $table = 'usergroup';
    protected $guarded = [];


    public static function getTableData($page_size, $page, $sorted, $filtered)
    {
        $softwareid = auth()->user()->softwareid;
        $orgid = auth()->user()->orgid;
        if ($page == 0) {
            $start_page = 0;
        } else {
            $start_page = ($page * $page_size);
        }

        $query = DB::table('usergroup as u')->select('u.id', 'u.groupcode', 'u.groupname', 'u.remarks', 'u.locationid', 'u.created_at')
            ->where('u.softwareid', $softwareid)
            ->where('u.softwareid', $orgid);

        $nquery = DB::table('usergroup as u')
            ->select('u.id', 'u.groupcode', 'u.groupname', 'u.remarks', 'u.locationid', 'u.created_at')
            ->where('u.softwareid', $softwareid)
            ->where('u.softwareid', $orgid);
        if (!empty($start_page)) {
            $query->offset($start_page);
        }

        if ($page_size) {
            $query->limit($page_size);
        }

        if (!empty($filtered)) {
            foreach ($filtered as $filter) {
                $query->where($filter['id'], 'like', "%" . $filter['value'] . "%");

                $nquery->where($filter['id'], 'like', "%" . $filter['value'] . "%");
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
            $array[$i]['groupcode'] = $row->groupcode;
            $array[$i]['groupname'] = $row->groupname;
            $array[$i]['remarks'] = $row->remarks;
            $array[$i]['created_at'] = $row->created_at;
            $array[$i]['action'] = '<a href="javascript:void(0)">Test</a>';
            $i++;
        }

        $all_filtered_data = $nquery->get();
        $count = count($all_filtered_data);

        $no_of_pages = ceil($count / $page_size);

        return array('rows' => $array, 'pages' => $no_of_pages);
    }
}