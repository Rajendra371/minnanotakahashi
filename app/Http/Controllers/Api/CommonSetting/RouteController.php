<?php
namespace App\Http\Controllers\Api\CommonSetting;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class RouteController extends Controller
{
    public function route_data()
    {
        $route_data=DB::table('modules')
        ->Select('modulelink as path','displaytext as name','module_key as component')
        ->where('isactive','Y')
        ->get();
        // print_r($route_data);
        // die();
        if($route_data)
        {
            return response()->json(['route_data'=>$route_data,'status'=>'success','message'=>'Record Fetched Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }
    } 
}
