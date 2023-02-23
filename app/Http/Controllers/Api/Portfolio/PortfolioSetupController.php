<?php

namespace App\Http\Controllers\Api\Portfolio;

use App\Models\Portfolio\PortfolioSetup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;


class PortfolioSetupController extends Controller
{
    public function index(){
        $data['category'] = DB::table('portfolio_category')->get();
        // echo "<pre>";
        // print_r( $data['menu']);
        // die();
       

        if($data)
        {
            return response()->json(['data'=>$data,'status'=>'success','message'=>'Record Added Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }
     
    }


public function store(Request $request)
    {
        $upload_file=get_constant_value('IMAGES_FOLDER');
        $validator = Validator::make($request->all(), [
            'name'=>'required',
            'portfolio_categoryid'=>'required',
            'content'=>'required',
            'startdate'=>'required',
            'enddate'=>'required',
            // 'description'=>'required',
            'file' => 'file|mimes:jpeg,png,gif,jpg|max:5120',
        ]);
       if ($validator->fails()) {
                return response()->json(['status'=>'error','message'=>$validator->errors()->all()]);
        }
        $input = $request->except('old_img_file');
        //$input = $request->all();

        $temp_file_names = '';

        if($request->hasFile('file')){
            $images = $request->file('file');
            $portfolio_image_name = $images->getClientOriginalName();
            $portfolio_image_name = rand().'-'.$portfolio_image_name;
            $filename = preg_replace('/\s+/', '', $portfolio_image_name);
            $images->move(('uploads/portfolio_image/'), $filename);
    
        }

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
            
            $old_img_file=$request->get('old_img_file');
            if(!empty($filename)){
                if (\File::exists('uploads/portfolio_image/'.$old_img_file)) {
                    unlink('uploads/portfolio_image/'.$old_img_file);
                }
            }   
        $data = PortfolioSetup::where('id', $id)->first();
       
       
        $input['updated_at']=datetime();
        $input['modifyip']=$postip;
        $input['modifymac']=$postmac;
        $input['modifyby']=$postby;
        $input['modifydatead']=$postdatead;
        $input['modifydatebs']=$postdatead;
        $input['modifytime']=date('H:i:s');
        $input['image'] = !empty($filename)?$filename:$old_img_file;
        $input['is_publish']=!empty($request->get('is_publish'))?$request->get('is_publish'):'N';


        unset($input['id']);
        unset($input['file']);

         save_log('portfolio','id',$id,$input,'Update');
         $update=\DB::table('portfolio')->where('id',$id)->update($input);
         if( $update)
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
        $input['image'] = !empty($filename)?$filename:$old_img_file;
       
        unset($input['file']);
          if($data=PortfolioSetup:: forceCreate($input)){
            return response()->json(['status'=>'success','message'=>'Record Saved Successfully!!']);
          }
           return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
        }
    }
   
   

    public function portfoliosetup_list(Request $request){
        $date_type=get_constant_value('DEFAULT_DATEPICKER');

       

        $data = PortfolioSetup::get_portfolio_list();
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
            $array[$i]['portfolio_categoryid']= $row->category_name;
            $array[$i]['name']= $row->name;
            $array[$i]['content']= $row->content;
            $array[$i]['image']= '<img src="'.asset("uploads/portfolio_image/".$row->image).'" height="30px" width="30px">';
        
            $array[$i]['website'] = $row->website;
            $array[$i]['startdate'] = $row->startdate;
            $array[$i]['enddate'] = $row->enddate;
            $array[$i]['order'] = $row->order;
            $array[$i]['is_publish'] = $row->is_publish;
            
            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/portfolio_setup/portfoliosetup_edit" data-id='.$row->id.' data-targetForm="portfolioForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            
            <a href="javascript:void(0)" class="view" data-url="/api/portfolio_setup/portfoliosetup_view" data-id='.$row->id.'><i class="fa fa-eye" /></i></a>
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/portfolio_setup/portfoliosetup_delete" data-id='.$row->id.' data-targetForm="portfolioForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered"=>$filtereddata,"recordsTotal"=>$totalrecs ,'data'=>$array]);
    }



    public function portfoliosetup_view(Request $request)
    {
         $trans=check_permission('View');
       
            if($trans=='error')
            {
                permission_message();
                exit;
            }
        $id=$request->get('id');
        $data = PortfolioSetup::get_all_portfoliosetup_data($id);
      
        $view = view("Portfolio/PortfolioSetupView")
        ->with('data',$data);
            
        $template = $view->render();
        if($template)
        {
            return response()->json(['status'=>'success','message'=>'Data Available','template'=>$template]);
        }
        else
        {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
        }
    }
     public function portfoliosetup_edit(Request $request)
    {

        $id=$request->get('id');
        //$data['employees']=\DB::table('employee')->where(['isactive'=>'Y'])->get();
        $category =\DB::table('portfolio_category')->where(['is_publish'=>'Y'])->get();
        $data = \DB::table('portfolio')->where('id', $id)->first();
        // echo "<pre>";
        // print_r($data);
        // die();

        $view = view("Portfolio/PortfolioSetup")
        ->with('data',$data)->with('category',$category);
            
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

    public function portfoliosetup_delete(Request $request)
    {
          $trans=check_permission('Delete');
            if($trans=='error')
            {
                permission_message();
                exit;
            }
       
        $id=$request->get('id');
        save_log('portfolio','id',$id,false,'Delete');
        $data=PortfolioSetup::where('id', $id)->delete();
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