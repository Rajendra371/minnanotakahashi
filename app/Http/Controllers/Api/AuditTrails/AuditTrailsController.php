<?php

namespace App\Http\Controllers\Api\AuditTrails;

 use App\Models\AuditTrails\AuditTrails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;


class AuditTrailsController extends Controller
{
    public function index(){
        $data['action'] = DB::table('commonlogtable')->select('action')->distinct()->get();
        $data['tablename'] = DB::table('commonlogtable')->select('tablename')->distinct()->get();
        
    
        if($data)
        {
            return response()->json(['data'=>$data,'status'=>'success','message'=>'Record Added Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }
     
    }





    public function audittrails_list(Request $request){
        $date_type=get_constant_value('DEFAULT_DATEPICKER');

       

        $data = AuditTrails::get_audittrails_list();
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
            $array[$i]['postdatead']= $row->postdatead;
            $array[$i]['posttime'] = $row->posttime;
            $array[$i]['tablename'] = $row->tablename;
            $array[$i]['datanew'] = Null;
            $array[$i]['dataold'] = Null;
            $array[$i]['postip'] = $row->postip;
            $array[$i]['postby'] = $row->username;
            
            $i++;
        }
        return response()->json(["recordsFiltered"=>$filtereddata,"recordsTotal"=>$totalrecs ,'data'=>$array]);
    }

    
}