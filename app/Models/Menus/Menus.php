<?php

namespace App\Models\Menus;

use Illuminate\Database\Eloquent\Model;
use Validator;
use Illuminate\Http\Request;
use DB;
class Menus extends Model
{
protected $table='menu';
protected $guarded = [];

    public function parent()
    {
       return $this->hasOne('App\Models\Settings\Module', 'id', 'parentmodule')
       ->Select('id','parentmodule','displaytext as value','displaytext as label','displaytext as title');
    }

    public function children(){
       return $this->hasMany('App\Models\Settings\Module', 'parentmodule', 'id')
       ->Select('id' ,'parentmodule','displaytext as value','displaytext as label','displaytext as title');
     }
        
    public static function tree() {
       return static::with(implode('.',array_fill(0, 4, 'children')))
       ->where('parentmodule', '=','0')
       ->Select('id','parentmodule','displaytext as value','displaytext as label','displaytext as title')
       ->get();
        }

    public static function getTableData($page_size, $page, $sorted, $filtered){
          $softwareid=auth()->user()->softwareid;
        if($page == 0){
            $start_page = 0;
        }else{
            $start_page = ($page*$page_size);
        }
        $query = DB::table('menu as  m')
                ->select( 'm.*')
                // ->leftJoin('menu as s', 's.id', '=', 'm.menu_parent')
                // ->select( DB::raw('(CASE WHEN(m.menu_parent<>0) THEN  s.menu_name ELSE "--" END)  as parentm '), 'm.*')
                ->where('m.softwareid',$softwareid);
                //->get();
                // print_r($query);
                // die();
        $nquery = DB::table('menu as m')
                ->select( 'm.*')
                // ->leftJoin('menu  as s', 's.id', '=', 'm.menu_parent')
                // ->select( DB::raw('(CASE WHEN(m.menu_parent<>0) THEN  s.menu_name ELSE "--" END)  as parentm '), 'm.*')
                ->where('m.softwareid',$softwareid);
                    // ->get();
                    // print_r($nquery);
                    // die();

        if(!empty($start_page)){
            $query->offset($start_page);
        }
        if($page_size){
            $query->limit($page_size);
        }
        if(!empty($filtered)){
            // echo "<pre></pre>";
            // print_r($filtered);
            // die();
            foreach($filtered as $filter){
                $query->where('m.'.$filter['id'],'like',"%".$filter['value']."%");

                $nquery->where('m.'.$filter['id'],'like',"%".$filter['value']."%");
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
        // echo"<pre>";
        // print_r($data);
        // die();

        $i = 0;
        $array = array();
        foreach($data as $key=>$row){
            $array[$i]['id'] = $row->id;
            $array[$i]['menu_name'] = $row->menu_name;
            $array[$i]['menu_typeid'] = $row->menu_typeid;
            $array[$i]['menu_url'] = $row->menu_url;
            $array[$i]['menu_ismain'] = $row->menu_ismain;
            $i++;
        }

        $all_filtered_data = $nquery->get();
        $count = count($all_filtered_data);
        $data = $query->get();
        
        // echo"<pre>";
        // print_r($data);
        // die();

        $no_of_pages = ceil($count/$page_size);

        return array('rows'=>$array,'pages'=>$no_of_pages);
    }

    public static function get_menu_list(){
        $get = $_GET;
      
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }
        
        $limit = 20;
        $offset = 0;
        if(!empty($_GET["iDisplayLength"])){
           $limit = $_GET['iDisplayLength'];
           $offset = $_GET["iDisplayStart"];
        }

        $nquery = \DB::table('menu')
        // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
        ->select('*');
        
      

       
        if(!empty($get['sSearch_1'])){
            $nquery->where('menu_name','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $nquery->where('menu_typeid','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $nquery->where('menu_url','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $nquery->where('menu_ismain','like',"%".$get['sSearch_4']."%");
        }
       
       

    

        $query = \DB::table('menu')
        // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
        ->select('*');
       
        if(!empty($get['sSearch_1'])){
            $query->where('menu_name','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $query->where('menu_typeid','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $query->where('menu_url','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $query->where('menu_ismain','like',"%".$get['sSearch_4']."%");
        }
        
       

        $order_by = '';
        $order = '';
        if($get['sSortDir_0']){
              $order =$get['sSortDir_0'];
          }
          
          if($get['iSortCol_0']==1)
          {
              $order_by='id';
          }
          
          if($get['iSortCol_0']==2)
          {
              $order_by='id';
          }
       
        

         // $query->orderBy($order_by,$order);
            if(!empty($offset)){
                $query->offset($offset);
            }

            if($limit){
                $query->limit($limit);
            }
    
        $data = $query->get();

       
        // $all_filtered_data = $nquery->get();
        $count = $nquery->count();

        $no_of_pages = ceil($count/$limit);
       
        if($count>0){
        $ndata=$data;
        $ndata['totalrecs'] = $count;
        $ndata['totalfilteredrecs'] = $count;
        } 
        else
        {
            $ndata=array();
            $ndata['totalrecs'] = 0;
            $ndata['totalfilteredrecs'] = 0;
        }
        return $ndata;
    }

}
