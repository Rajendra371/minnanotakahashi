<?php

namespace App\Http\Controllers\Api\AuditTrails;

 use App\Models\AuditTrails\AccessLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;


class AccessLogController extends Controller
{
    public function index(){
        $data['user'] = DB::table('loginactivity')->select('loginusername')->distinct()->get();
        
    
        if($data)
        {
            return response()->json(['data'=>$data,'status'=>'success','message'=>'Record Added Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }
     
    }





    public function accesslog_list(Request $request){
        $date_type=get_constant_value('DEFAULT_DATEPICKER');

       

        $data = AccessLog::get_accesslog_list();
        // echo "<pre>";
        // print_r($data);
        // die();
        $filtereddata = ($data["totalfilteredrecs"]>0?$data["totalfilteredrecs"]:$data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);
 
        $i = 0;
        $array = array();
        foreach($data as $key=>$row){
          
            $current_date=strtotime(CURDATE_EN);
           
            
        
            $array[$i]['id'] = $row->id;
            $array[$i]['logindatead']= $row->logindatead;
            $array[$i]['logintime'] = $row->logintime;
            $array[$i]['loginusername'] = $row->loginusername;
            $array[$i]['loginip'] =$row->loginip;
            $array[$i]['user_agent'] = $row->user_agent;
          
            

            $i++;
        }
        return response()->json(["recordsFiltered"=>$filtereddata,"recordsTotal"=>$totalrecs ,'data'=>$array]);
    }

   
}