<?php

namespace App\Models\GeneralSetting;

use Illuminate\Database\Eloquent\Model;
use DB;

class UsefulLink extends Model
{
     protected $table = 'useful_link';
     protected $fillable = ['id'];
    // protected $guarded = [];

  

    public static function get_usefullink_list(){
        $Name=$_GET['Name'];
        $Is_Active=$_GET['Is_Active'];
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

        $nquery = \DB::table('useful_link as ecl')
        // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
        ->select('*');
         if(!empty($Name)){
            $nquery->where('ecl.title','=',$Name);      
          }
          if(!empty($Is_Active)){
            $nquery->where('ecl.isactive','=',$Is_Active);      
          }

        $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
       
        if(!empty($get['sSearch_1'])){
            $nquery->where('title','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $nquery->where('designation','like',"%".$get['sSearch_2']."%");
        }
       
        if(!empty($get['sSearch_3'])){
            $nquery->where('contact','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $nquery->where('email','like',"%".$get['sSearch_4']."%");
        }
       

    

        $query = \DB::table('useful_link as ecl')
        // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
        ->select('*');
        if(!empty($Name)){
            $query->where('ecl.title','=',$Name);      
          }
          if(!empty($Is_Active)){
            $query->where('ecl.isactive','=',$Is_Active);      
          }
        
        if(!empty($get['sSearch_1'])){
            $query->where('title','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $query->where('designation','like',"%".$get['sSearch_2']."%");
        }
        
        if(!empty($get['sSearch_3'])){
            $query->where('contact','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $query->where('email','like',"%".$get['sSearch_4']."%");
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
              $order_by='order';
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

    public static function get_all_usefullink_data($id=false){
        $data=DB::table('useful_link')
        ->where('id',$id)
        ->first();
        return $data;
    }


   
}