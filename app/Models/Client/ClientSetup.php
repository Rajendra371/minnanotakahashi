<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;
use DB;

class ClientSetup extends Model
{
     protected $table = 'clients';
     protected $fillable = ['id'];
    // protected $guarded = [];

  

    public static function get_client_list(){
        $get = $_GET;
        $Client_Name=$_GET['Client_Name'];
         $Client_Category=$_GET['Client_Category'];
       
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }
        
        $limit = 20;
        $offset = 0;
        if(!empty($_GET["iDisplayLength"])){
           $limit = $_GET['iDisplayLength'];
           $offset = $_GET["iDisplayStart"];
        }

        $nquery = \DB::table('clients as ecl')
       ->leftjoin('client_category as e','e.id','=','ecl.client_catid')
        ->select('ecl.id','ecl.order','ecl.is_publish','ecl.client_catid','ecl.client_name','ecl.url','ecl.content','ecl.logo','ecl.meta_title','ecl.meta_keyword','ecl.meta_description','e.category_name');

        // if(!empty($Client_Name)){
        //     $nquery->where('ecl.client_name','=',$Client_Name);      
        //   }
        //   if(!empty($Client_Category)){
        //     $nquery->where('ecl.client_catid','=',$Client_Category);      
        //   }

        $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
       
        if(!empty($get['sSearch_1'])){
            $nquery->where('e.category_name','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $nquery->where('ecl.client_name','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $nquery->where('ecl.url','like',"%".$get['sSearch_3']."%");
        }
        
        if(!empty($get['sSearch_4'])){
            $nquery->where('ecl.content','like',"%".$get['sSearch_4']."%");
        }
      

    

        $query = \DB::table('clients as ecl')
        ->leftjoin('client_category as e','e.id','=','ecl.client_catid')
         ->select('ecl.id','ecl.client_catid','ecl.client_name','ecl.url','ecl.content','ecl.logo','ecl.meta_title','ecl.order','ecl.is_publish','ecl.meta_keyword','ecl.meta_description','e.category_name');

        //  if(!empty($Client_Name)){
        //     $query->where('ecl.client_name','=',$Client_Name);      
        //   }
        //   if(!empty($Client_Category)){
        //     $query->where('ecl.client_catid','=',$Client_Category);      
        //   }
 
        
        if(!empty($get['sSearch_1'])){
            $query->where('e.category_name','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $query->where('ecl.client_name','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $query->where('ecl.url','like',"%".$get['sSearch_3']."%");
        }
        
        if(!empty($get['sSearch_4'])){
            $query->where('ecl.content','like',"%".$get['sSearch_4']."%");
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

    public static function get_all_client_data($id=false){
        $data=DB::table('clients as ecl')
        ->leftjoin('client_category as e','e.id','=','ecl.client_catid')
        ->select('ecl.*','e.category_name')
        ->where('ecl.id',$id)
        ->first();
        return $data;
    }


   
}