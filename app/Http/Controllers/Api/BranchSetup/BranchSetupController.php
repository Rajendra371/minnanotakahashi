<?php

namespace App\Http\Controllers\Api\BranchSetup;

use App\Models\BranchSetup\BranchSetup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

class BranchSetupController extends Controller
{
    public function store(Request $request)
    {
       $validation = Validator::make($request->all(),[
           'branch_name' => 'required|string|max:255',
           'branch_address' => 'required|string|max:255',
           'branch_location' => 'required|string|max:255',
       ]);
       if($validation->fails()){
           return response()->json(['status'=>'success','message'=>$validation->errors()->all()]);
       }

       $postby=auth()->user()->id;
       $locationid=auth()->user()->locationid; 
       $orgid=auth()->user()->orgid;
       $postdatead=CURDATE_EN;
       $postdatebs=EngToNepDateConv(CURDATE_EN);
       $postip=get_real_ipaddr();
       $postmac=get_Mac_Address();

       $input = $request->except('is_main','is_active');
       $id = $request->get('id');
       $is_main = $request->get('is_main');
       $is_active = $request->get('is_active');
       $input['is_main'] = $is_main == 'Y' ? 'Y' : 'N';
       $input['is_active'] = $is_active == 'Y' ? 'Y' : 'N';
        if($id){
            $trans=check_permission('Update');
            if($trans=='error')
            {
                permission_message();
                exit;
            }
           
            $input['updated_at']=datetime();
            $input['modifyip']=$postip;
            $input['modifymac']=$postmac;
            $input['modifyby']=$postby;
            $input['modifydatead']=$postdatead;
            $input['modifydatebs']=$postdatead;
            $input['modifytime']=date('H:i:s');
            $branch = BranchSetup::where('id',$id)->first();
            if(!empty($branch)){
                if($branch->update($input)){
                    if($is_main == 'Y'){
                        BranchSetup::whereNotIn('id',[$id])->update(['is_main'=>'N']);
                    }
                    save_log('branch_setup','id',$id,$input,'Update'); 
                    return response()->json(['status'=>'success','message'=>'Data Updated!!']);
                }else{
                    return response()->json(['status'=>'error','message'=>'Error Updating Data']);
                }
            }else{
                return response()->json(['status'=>'error','message'=>'Sorry The Data Does Not Exist']);
            }
        }else{
            $trans=check_permission('Insert');
            if($trans=='error')
            {
                permission_message();
                exit;
            }
            $input['postip']=$postip;
            $input['postmac']= $postmac;
            $input['postdatead']=$postdatead;
            $input['postdatebs']=$postdatebs;
            $input['posttime']=date('H:i:s');
            $input['postby']=$postby;
            if($data = BranchSetup:: forceCreate($input)){
                if($is_main == 'Y'){
                    BranchSetup::whereNotIn('id',[$data->id])->update(['is_main'=>'N']);
                }
                save_log('branch_setup','id',$id,$input,'Insert'); 
                return response()->json(['status'=>'success','message'=>'Record Saved Successfully!!']);
            }else{
                return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
            }
        }
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $data = BranchSetup::where('id',$id)->first();
        if($data){
            return response()->json(['status'=>'success','data'=>$data,'message'=>'Record Found']);
        }else{
            return response()->json(['status'=>'error','message'=>'Record Does Not Exist']);
        }
    }
    public function delete(Request $request)
    {
        $trans=check_permission('Delete');
        if($trans=='error')
        {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = BranchSetup::where('id',$id)->delete();
        if($data){
            save_log('branch_setup','id',$id,false,'Delete');
            return response()->json(['status'=>'success','message'=>'Record Deleted']);
        }else{
            return response()->json(['status'=>'error','message'=>'Error Deleting Record']);
        }
    }

    public function view(Request $request)
    {
        $trans=check_permission('View');
        if($trans=='error')
        {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = BranchSetup::where('id',$id)->first();
        $view = view('BranchSetup.View')->with('data',$data);
        $template = $view->render();
        if($template){
            return response()->json(['status'=>'success','template'=>$template,'message'=>'Record Fetched']);
        }else{
            return response()->json(['status'=>'error','message'=>'Error Fetching Record']);
        }
    }



    public function list()
    {
        $data = BranchSetup::get_list();
        $filtereddata = ($data["totalfilteredrecs"]>0?$data["totalfilteredrecs"]:$data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);
        $i = 0;
        $array = array();
        if(!empty($data)){
            foreach($data as $key=>$row){
                $array[$i]['id'] = $row->id;
                $array[$i]['branch_name']=$row->branch_name;
                $array[$i]['branch_address']= $row->branch_address;
                $array[$i]['branch_location'] = $row->branch_location;
                $array[$i]['is_active'] = $row->is_active;
                $array[$i]['is_main'] = $row->is_main;
                $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/branch_setup/edit" data-id='.$row->id.' data-targetForm="branchSetupForm" ><i class="fa fa-edit"></i></a>
                &nbsp
                <a href="javascript:void(0)" class="view" data-url="/api/branch_setup/view" data-id='.$row->id.'><i class="fa fa-eye" /></i></a>
                &nbsp
                <a href="javascript:void(0)" class="btnDelete" data-url="/api/branch_setup/delete" data-id='.$row->id.' data-targetForm="branchSetupForm"><i class="fa fa-trash"></i></a>
                ';
                $i++;
            }
        }
        return response()->json(["recordsFiltered"=>$filtereddata,"recordsTotal"=>$totalrecs ,'data'=>$array]);
    }

}
