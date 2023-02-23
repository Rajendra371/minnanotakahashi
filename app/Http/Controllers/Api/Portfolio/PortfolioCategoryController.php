<?php

namespace App\Http\Controllers\Api\Portfolio;

use App\Models\Portfolio\PortfolioCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;


class PortfolioCategoryController extends Controller
{
    public function index(){
   
     }


public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'category_name'=>'required',
            'url'=>'required',
            'content'=>'required',
            
        ]);
       if ($validator->fails()) {
                return response()->json(['status'=>'error','message'=>$validator->errors()->all()]);
        }
        $input = $request->all();
        $id=$request->get('id');
        $postby=auth()->user()->id;
        $locationid=auth()->user()->locationid;
        $orgid=auth()->user()->orgid;
        $postdatead=CURDATE_EN;
        $postdatebs=EngToNepDateConv(CURDATE_EN);
        $postip=get_real_ipaddr();
        $postmac=get_Mac_Address();
        if($id)
        {
              $trans=check_permission('Update');
            if($trans=='error')
            {
                permission_message();
                 exit;
            }
        $data = PortfolioCategory::where('id', $id)->first();
        // echo "<pre>";
        // print_r($data);
        // die();
        $input['updated_at']=datetime();
        $input['modifyip']=$postip;
        $input['modifymac']=$postmac;
        $input['modifyby']=$postby;
        $input['modifydatead']=$postdatead;
        $input['modifydatebs']=$postdatead;
        $input['modifytime']=date('H:i:s');
        $input['is_publish']=!empty($request->get('is_publish'))?$request->get('is_publish'):'N';

         save_log('portfolio_category','id',$id,$input,'Update');
         $update=\DB::table('portfolio_category')->where('id',$id)->update($input);
         if($update)
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
            $input['postip']=$postip;
            $input['postmac']= $postmac;
            $input['postdatead']=$postdatead;
            $input['postdatebs']=$postdatebs;
            $input['posttime']=date('H:i:s');
            $input['postby']=$postby;
          if($data=PortfolioCategory:: forceCreate($input)){
            return response()->json(['status'=>'success','message'=>'Record Saved Successfully!!']);
          }
           return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
        }
    }
   

    

    public function portfoliocategory_list(Request $request){
        $date_type=get_constant_value('DEFAULT_DATEPICKER');

        $data = PortfolioCategory::get_portfoliocategory_list();
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
            // if($date_type=='NP'){
            //     $start_date = $row->startdate;
            //     $end_date = $row->enddate;
            // }
            // else{
            //      $start_date = $row->startdate;
            //      $end_date = $row->enddate;
            // }
        
            $array[$i]['id'] = $row->id;
            $array[$i]['category_name']= $row->category_name;
            $array[$i]['url'] = $row->url;
            $array[$i]['content'] = $row->content;
            $array[$i]['order'] = $row->order;
            $array[$i]['is_publish'] = $row->is_publish;
          

            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/portfolio_category/portfoliocategory_edit" data-id='.$row->id.' data-targetForm="portForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            &nbsp
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/portfolio_category/portfoliocategory_delete" data-id='.$row->id.' data-targetForm="portForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered"=>$filtereddata,"recordsTotal"=>$totalrecs ,'data'=>$array]);
    }

     public function portfoliocategory_edit(Request $request)
    {

        $id=$request->get('id');
        // $location =\DB::table('advertisement_location')->where(['is_active'=>'Y'])->get();
        $data = \DB::table('portfolio_category')->where('id', $id)->first();
        $view = view("Portfolio/PortfolioCategory")
        ->with('data',$data);
        // ->with('location',$location);
            
        $template = $view->render();

        if($template)
        {
            return response()->json(['status'=>'success','template'=> $template,'message'=>'Record Selected Successfully!!']);
        }
        else
        {
           return response()->json(['status'=>'error','data'=> '','message'=>'Unable to Edit']);
        }
    }

    public function portfoliocategory_delete(Request $request)
    {
          $trans=check_permission('Delete');
            if($trans=='error')
            {
                permission_message();
                exit;
            }
       
        $id=$request->get('id');
         save_log('portfolio_category','id',$id,false,'Delete');
        $data=PortfolioCategory::where('id', $id)->delete();
        if($data)
        {
              return response()->json(['status'=>'success','message'=>'Record Deleted Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }

    }

  

  
    

}