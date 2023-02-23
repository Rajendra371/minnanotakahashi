<?php

namespace App\Models\Page;

use Illuminate\Database\Eloquent\Model;
use DB;

class Page extends Model
{
     protected $table = 'pages';
     protected $fillable = ['id'];
    // protected $guarded = [];

  

    public static function get_page_list(){
        $get = $_GET;
        $page_menu=$_GET['page_menu'];
       
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }
        
        $limit = 20;
        $offset = 0;
        if(!empty($_GET["iDisplayLength"])){
           $limit = $_GET['iDisplayLength'];
           $offset = $_GET["iDisplayStart"];
        }

        $nquery = \DB::table('pages as ecl')
        ->leftjoin('menu as e','e.id','=','ecl.menuid')
        ->select('ecl.id','ecl.menuid','ecl.page_title','ecl.short_content','ecl.description','ecl.images','ecl.is_publish','e.menu_name');
        if(!empty($page_menu))
        {
            $nquery->where('ecl.menuid','=',$page_menu);
        }

        $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
        if(!empty($get['sSearch_1'])){
            $nquery->where('e.menu_name','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $nquery->where('ecl.page_title','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $nquery->where('ecl.short_content','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $nquery->where('ecl.description','like',"%".$get['sSearch_4']."%");
        }

    

        $query = \DB::table('pages as ecl')
        ->leftjoin('menu as e','e.id','=','ecl.menuid')
        ->select('ecl.id','ecl.menuid','ecl.page_title','ecl.short_content','ecl.description','ecl.images','ecl.is_publish','e.menu_name');
        if(!empty($page_menu))
        {
            $query->where('ecl.menuid','=',$page_menu);
        }
        
        if(!empty($get['sSearch_1'])){
            $query->where('e.menu_name','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $query->where('ecl.page_title','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $query->where('ecl.short_content','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $query->where('ecl.description','like',"%".$get['sSearch_4']."%");
        }

        $order_by = '';
        $order = '';
        if($get['sSortDir_0']){
              $order =$get['sSortDir_0'];
          }
          
          if($get['iSortCol_0']==1)
          {
              $order_by='ecl.id';
          }
          
          if($get['iSortCol_0']==2)
          {
              $order_by='ecl.id';
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

    public static function get_all_page_data($id=false){
        $data=DB::table('pages as ecl')
        ->leftjoin('menu as e','e.id','=','ecl.menuid')
        ->select('ecl.*','e.menu_name')
        ->where('ecl.id',$id)
        ->first();
        return $data;
    }


   
}