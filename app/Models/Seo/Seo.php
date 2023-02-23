<?php

namespace App\Models\Seo;

use Illuminate\Database\Eloquent\Model;
use DB;

class Seo extends Model
{
     protected $table = 'seo';
     protected $fillable = ['id'];
    // protected $guarded = [];

  

    public static function get_seo_list(){
        $get = $_GET;
        $seo_page=$_GET['seo_page'];
       
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }
        
        $limit = 20;
        $offset = 0;
        if(!empty($_GET["iDisplayLength"])){
           $limit = $_GET['iDisplayLength'];
           $offset = $_GET["iDisplayStart"];
        }

        $nquery = \DB::table('seo as ecl')
        ->leftjoin('seo_page as e','e.id','=','ecl.seo_pageid')
        ->select('ecl.id','ecl.seo_pageid','ecl.seo_title','ecl.seo_metakeyword','ecl.seo_metadescription','ecl.schema1','ecl.schema2','ecl.isactive','e.page_name');
        if(!empty($seo_page)){
            $nquery->where('ecl.seo_pageid','=',$seo_page);
        }

        $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
        if(!empty($get['sSearch_1'])){
            $nquery->where('ecl.page_name','like',"%".$get['sSearch_1']."%");
        }
       
        if(!empty($get['sSearch_2'])){
            $nquery->where('ecl.seo_title','like',"%".$get['sSearch_2']."%");
        }
        
        if(!empty($get['sSearch_3'])){
            $nquery->where('seo_metakeyword','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $nquery->where('seo_metadescription','like',"%".$get['sSearch_4']."%");
        }
        if(!empty($get['sSearch_5'])){
            $nquery->where('schema1','like',"%".$get['sSearch_5']."%");
        }
        if(!empty($get['sSearch_6'])){
            $nquery->where('schema2','like',"%".$get['sSearch_6']."%");
        }
       

        $query = \DB::table('seo as ecl')
        ->leftjoin('seo_page as e','e.id','=','ecl.seo_pageid')
        ->select('ecl.id','ecl.seo_pageid','ecl.seo_title','ecl.seo_metakeyword','ecl.seo_metadescription','ecl.schema1','ecl.schema2','ecl.isactive','e.page_name');
        if(!empty($seo_page)){
            $query->where('ecl.seo_pageid','=',$seo_page);
        }
        if(!empty($get['sSearch_1'])){
            $query->where('ecl.page_name','like',"%".$get['sSearch_1']."%");
        }
       
        if(!empty($get['sSearch_2'])){
            $query->where('ecl.seo_title','like',"%".$get['sSearch_2']."%");
        }
        
        if(!empty($get['sSearch_3'])){
            $query->where('seo_metakeyword','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $query->where('seo_metadescription','like',"%".$get['sSearch_4']."%");
        }
        if(!empty($get['sSearch_5'])){
            $query->where('schema1','like',"%".$get['sSearch_5']."%");
        }
        if(!empty($get['sSearch_6'])){
            $query->where('schema2','like',"%".$get['sSearch_6']."%");
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
         // if($get['iSortCol_0']==3)
         //  {
         //      $order_by='tole_name';
         //  }
         // if($get['iSortCol_0']==4)
         //  {
         //      $order_by='road_name';
         //  }
        

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

    public static function get_all_seo_data($id=false){
        $data=DB::table('seo as ecl')
        ->leftjoin('seo_page as e','e.id','=','ecl.seo_pageid')
        ->select('ecl.id','ecl.seo_pageid','ecl.seo_title','ecl.seo_metakeyword','ecl.seo_metadescription','ecl.schema1','ecl.schema2','ecl.isactive','e.page_name')
        ->where('ecl.id',$id)
        ->first();
        return $data;
    }


   
}