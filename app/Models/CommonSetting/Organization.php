<?php

namespace App\Models\CommonSetting;

use Illuminate\Database\Eloquent\Model;
use DB;

class Organization extends Model
{
    protected $table = 'organization';
    protected $guarded = [];
    public static function getTableData($page_size, $page, $sorted, $filtered){
        if($page == 0){
            $start_page = 0;
        }else{
            $start_page = ($page*$page_size);
        }
        $query = DB::table('organization');
        $nquery = DB::table('organization');

        if(!empty($start_page)){
            $query->offset($start_page);
        }

        if($page_size){
            $query->limit($page_size);
        }
        if(!empty($filtered)){
            foreach($filtered as $filter){
                $query->where($filter['id'],'like',"%".$filter['value']."%");

                $nquery->where($filter['id'],'like',"%".$filter['value']."%");
            }
        }
        if(!empty($sorted)){
            foreach($sorted as $sort){
                $sort_by = $sort['desc'];
                if($sort_by == true){
                    $sort_type = 'DESC';
                }else{
                    $sort_type = 'ASC';
                }
                $query->orderBy($sort['id'],$sort_type);
                $nquery->orderBy($sort['id'],$sort_type);
            }
        }
        $data = $query->get();
        // echo "<pre>";
        // print_r($data);
        // die();
        $i = 0;
        $array = array();
        foreach($data as $key=>$row){
            $array[$i]['id'] = $row->id;
            $array[$i]['orgname'] = $row->orgname;
            $array[$i]['contact'] = $row->contact;
            $array[$i]['email'] = $row->email;
            $array[$i]['orgaddress1'] = $row->orgaddress1;
            $array[$i]['orgaddress2'] = $row->orgaddress2;
            $array[$i]['website'] = $row->website;
            $array[$i]['action'] = '<a href="javascript:void(0)">Test</a>';
            $i++;
            
        }

        $all_filtered_data = $nquery->get();
        $count = count($all_filtered_data);
        $no_of_pages = ceil($count/$page_size);
        return array('rows'=>$array,'pages'=>$no_of_pages);
    }
}
