<?php

namespace App\Models\AuditTrails;

use Illuminate\Database\Eloquent\Model;
use DB;

class AccessLog extends Model
{
     protected $table = 'loginactivity';
     protected $fillable = ['id'];

  

    public static function get_accesslog_list(){
        $get = $_GET;
        $Users=$_GET['Users'];
        $filter_date=$_GET['filter_date'];
        $frmDate=$_GET['frmDate'];
        $toDate=$_GET['toDate'];
       
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }
        
        $limit = 20;
        $offset = 0;
        if(!empty($_GET["iDisplayLength"])){
           $limit = $_GET['iDisplayLength'];
           $offset = $_GET["iDisplayStart"];
        }

        $nquery = \DB::table('loginactivity as ecl')
        // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
        ->select('ecl.*');
        if(!empty($filter_date))
        {
            if($filter_date=='range'){

                $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
                // if($defaultpicker=='NP'){
                    if(!empty($frmDate) && !empty($toDate)){
                    $nquery->where('ecl.logindatead','>=',"$frmDate");
                    $nquery->where('ecl.logindatead','<=',"$toDate");
                    }
                // }
                // else
                // {
                //     if(!empty($frmDate) && !empty($toDate)){
                //         $nquery->where('ecl.startdate','>=',$frmDate);
                //         $nquery->where('ecl.enddate','<=',$toDate);
                //         }
                // }
            }
        }
        if(!empty($Users)){
            $nquery->where('ecl.loginusername','=',$Users);
        }

        $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
       
        if(!empty($get['sSearch_1'])){
            $nquery->where('ecl.logindatead','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $nquery->where('ecl.loginusername','like',"%".$get['sSearch_2']."%");
        }
       

    

        $query = \DB::table('loginactivity as ecl')
        // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
        ->select('ecl.*');
        if(!empty($filter_date))
        {
            if($filter_date=='range'){
                $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
               //  if($defaultpicker=='NP'){
                    if(!empty($frmDate) && !empty($toDate)){
                    $query->where('ecl.logindatead','>=',"$frmDate");
                    $query->where('ecl.logindatead','<=',"$toDate");
                    }
               //  }
               //  else
               //  {
               //      if(!empty($frmDate) && !empty($toDate)){
               //          $nquery->where('ecl.startdate','>=',$frmDate);
               //          $nquery->where('ecl.enddate','<=',$toDate);
               //          }
               //  }
            }
        }

        if(!empty($Users)){
            $query->where('ecl.loginusername','=',$Users);
        }
        
        if(!empty($get['sSearch_1'])){
            $query->where('ecl.logindatead','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $query->where('ecl.loginusername','like',"%".$get['sSearch_2']."%");
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