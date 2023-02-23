<?php

namespace App\Models\CommonSetting;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use DB;
class Gallery extends Model
{
    protected $table = 'galleries';
    protected $guarded = [];

    // public static function getTableData($page_size, $page, $sorted, $filtered){
    //     if($page == 0){
    //         $start_page = 0;
    //     }else{
    //         $start_page = ($page*$page_size);
    //     }

    //     $query = DB::table('location as l')
    //     ->leftjoin('location as l1','l1.id','=','l.parentloc_id')
    //     ->select( DB::raw('(CASE WHEN(l.parentloc_id<>0) THEN  l1.locname ELSE "--" END)  as parent_locname '), 'l.*');


    //     $nquery = DB::table('location as l')
    //     ->leftjoin('location as l1','l1.id','=','l.parentloc_id')
    //     ->select( DB::raw('(CASE WHEN(l.parentloc_id<>0) THEN  l1.locname ELSE "--" END)  as parent_locname '), 'l.*');

    //     if(!empty($start_page)){
    //         $query->offset($start_page);
    //     }

    //     if($page_size){
    //         $query->limit($page_size);
    //     }

    //     if(!empty($filtered)){
    //         foreach($filtered as $filter){
    //             $query->where('l.'.$filter['id'],'like',"%".$filter['value']."%");
    //             $nquery->where('l.'.$filter['id'],'like',"%".$filter['value']."%");
    //         }
    //     }

    //     if(!empty($sorted)){
    //         foreach($sorted as $sort){
    //             $sort_by = $sort['desc'];

    //             if($sort_by == true){
    //                 $sort_type = 'DESC';
    //             }else{
    //                 $sort_type = 'ASC';
    //             }

    //             $query->orderBy($sort['id'],$sort_type);

    //             $nquery->orderBy($sort['id'],$sort_type);
    //         }
    //     }

    //     $data = $query->get();

    //     $i = 0;
    //     $array = array();
    //     foreach($data as $key=>$row){
    //         $array[$i]['id'] = $key+1;
    //         $array[$i]['locname'] = $row->locname;
    //         $array[$i]['locaddress'] = $row->locaddress;
    //         $array[$i]['ismain'] = $row->ismain;
    //         $array[$i]['created_at'] = $row->created_at;
    //         $array[$i]['parent_locname'] = $row->parent_locname;;
    //         $i++;
    //     }

    //     $all_filtered_data = $nquery->get();
    //     $count = count($all_filtered_data);

    //     $no_of_pages = ceil($count/$page_size);

    //     return array('rows'=>$array,'pages'=>$no_of_pages);
    // }
}
