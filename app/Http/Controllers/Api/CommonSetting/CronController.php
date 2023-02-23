<?php

namespace App\Http\Controllers\Api\CommonSetting;

use DB;
use App\Models\CommonSetting\Cron;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Dotenv\Validator as DotenvValidator;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Validator;


class CronController  extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Cron::all();
        if($data)
        {
              return response()->json(['data'=>$data,'status'=>'success','message'=>'Record Deleted Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'cron_name'=>'required',
            'cron_description'=>'required',
            'cron_code'=>'required',
            'is_active'=>'required',
            'action'=>'required',
        ]);
       if ($validator->fails()) {
        return response()->json(['status'=>'error','message'=>$validator->errors()->all()]);
        }
        $input = $request->all();
        $id=$request->get('id');
        if($id)
        {
        $data = Cron::where('id', $id)->first();
        // echo "<pre>";
        // print_r($data);
        // die();
        $input['updated_at']=datetime();
        $input['updatedip']=get_real_ipaddr();
        $input['updatedmac']=get_Mac_Address();
        $input['updatedby']='1';
         if($data->update($input))
         {
              return response()->json(['status'=>'success','message'=>'Record Updated Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }
        }
        else
        {
        $input['createdip']=get_real_ipaddr();
        $input['createdmac']=get_Mac_Address();
          if($data=Organization:: forceCreate($input)){
            return response()->json(['status'=>'success','message'=>'Record Saved Successfully!!']);
          }
           return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id=$request->get('id');
        $data = Cron::where('id', $id)->first();
        if($data)
        {
            return $data; //response()->json(['status'=>'success','message'=>'Record Deleted Successfully!!']);
         }
         else
         {
            return false;
         }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id=$request->get('id');
        $data=Cron::where('id', $id)->delete();
        if($data)
        {
              return response()->json(['status'=>'success','message'=>'Record Deleted Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }

    }

    public function getTableData(Request $request){
        $page_size = $request->get('pageSize');
        $page = $request->get('page');
        $sorted = $request->get('sorted');
        $filtered = $request->get('filtered');
        $data = Cron::getTableData($page_size, $page, $sorted, $filtered);

        return response()->json($data);
    }
}

