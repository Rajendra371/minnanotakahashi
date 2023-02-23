<?php

namespace App\Http\Controllers\Api\Ourproduct;

use Illuminate\Http\Request;
use App\Models\Ourproduct\Ourproduct;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class OurproductController extends Controller
{
    public function index(){
        $data['product_category'] = DB::table('ourproduct_category')->get();
      
       

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

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'file' => 'file|mimes:jpeg,png,gif,jpg|max:5120',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('old_img_file');
        $old_img_file = $request->get('old_img_file');

        if ($request->hasFile('file')) {
            $images = $request->file('file');
            $service_image_name = $images->getClientOriginalName();
            $service_image_name = rand() . '-' . $service_image_name;
            $filename = preg_replace('/\s+/', '', $service_image_name);
            $images->move(('uploads/product_image/'), $filename);
        }

        $id = $request->get('id');
        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();
        $title = $request->get('title');
        $slug = strtolower(preg_replace('/\s+/', '-', $title));
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            if (!empty($filename)) {
                if (File::exists('uploads/product_image/' . $old_img_file)) {
                    if(!empty($old_img_file)){
                     unlink('uploads/product_image/' . $old_img_file);
                    }
                }
            }
            
            $data = Ourproduct::where('id', $id)->first();
            $input['slug'] = $slug;
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['image'] = !empty($filename) ? $filename : $old_img_file;
            $input['is_publish'] = !empty($request->get('is_publish')) ? $request->get('is_publish') : 'N';
            unset($input['file']);
            save_log('our_product', 'id', $id, $input, 'Update');
            $update = DB::table('our_product')->where('id', $id)->update($input);
            if ($update) {
                return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } else {
            $input['slug'] = $slug;
            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');
            $input['postby'] = $postby;
            $input['image'] = !empty($filename) ? $filename : $old_img_file;

            unset($input['file']);
            if ($data = Ourproduct::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function ourproduct_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');

        $data = Ourproduct::get_ourproduct_list();
        // echo "<pre>";
        // print_r($data);
        // die();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {

            $current_date = strtotime(CURDATE_EN);
            // if($date_type=='NP'){
            //     $start_date = $row->startdate;
            //     $end_date = $row->enddate;
            // }
            // else{
            //      $start_date = $row->startdate;
            //      $end_date = $row->enddate;
            // }

            $array[$i]['id'] = $row->id;
            $array[$i]['title'] = $row->title;
            if(!empty($row->image)){
                $array[$i]['image'] = '<img src="' . asset("uploads/product_image/" . $row->image) . '" height="30px" width="30px">';
            }
            else{
                $array[$i]['image'] = '';
            }
            $array[$i]['short_description']= $row->short_description;
            $array[$i]['description']= $row->description;

            // $array[$i]['startdate'] = $row->startdate;
            // $array[$i]['enddate'] = $row->enddate;
            $array[$i]['order'] = $row->order;
            $array[$i]['is_publish'] = $row->is_publish;



            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/ourproduct/ourproduct_edit" data-id=' . $row->id . ' data-targetForm="ourproductForm" data-edittype="template"><i class="fa fa-edit"></i></a>

            <a href="javascript:void(0)" class="view" data-url="/api/ourproduct/ourproduct_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>

            <a href="javascript:void(0)" class="btnDelete" data-url="/api/ourproduct/ourproduct_delete" data-id=' . $row->id . ' data-targetForm="ourproductForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function ourproduct_view(Request $request)
    {
        $trans = check_permission('View');

        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = Ourproduct::get_all_ourproduct_data($id);

        $view = view("Ourproduct/OurproductView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function ourproduct_edit(Request $request)
    {

        $id = $request->get('id');
        $product_category =\DB::table('ourproduct_category')->where(['is_active'=>'Y'])->get();
        // dd($product_category);
        $data = DB::table('our_product')->where('id', $id)->first();
        $view = view("Ourproduct/Ourproduct")
            ->with('data', $data)->with('product_category',$product_category);
        // ->with('location',$location);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function ourproduct_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('our_product', 'id', $id, false, 'Delete');
        $data = OurProduct::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function ourproduct_index(){
        $data['category'] = DB::table('ourproduct_category')->get();
      
       

        if($data)
        {
            return response()->json(['data'=>$data,'status'=>'success','message'=>'Record Added Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }
     
    }

   public function ourproductcategory_store(Request $request)
   {

       $validator = Validator::make($request->all(), [
           'ourproduct_cat'=>'required',
           'description'=>'required',
           
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
       $ourproduct_cat = $request->get('ourproduct_cat');
       $slug = strtolower(preg_replace('/\s+/', '-', $ourproduct_cat));
       if($id)
       {
             $trans=check_permission('Update');
           if($trans=='error')
           {
               permission_message();
                exit;
           }
       $data = \DB::table('ourproduct_category')->where('id', $id)->first();
       $input['slug'] = $slug;
       $input['updated_at']=datetime();
       $input['modifyip']=$postip;
       $input['modifymac']=$postmac;
       $input['modifyby']=$postby;
       $input['modifydatead']=$postdatead;
       $input['modifydatebs']=$postdatead;
       $input['modifytime']=date('H:i:s');
       $input['is_active']=!empty($request->get('is_active'))?$request->get('is_active'):'N';
        save_log('ourproduct_category','id',$id,$input,'Update');
        $update=\DB::table('ourproduct_category')->where('id',$id)->update($input);
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
           $input['slug'] = $slug;
           $input['postip']=$postip;
           $input['postmac']= $postmac;
           $input['postdatead']=$postdatead;
           $input['postdatebs']=$postdatebs;
           $input['posttime']=date('H:i:s');
           $input['postby']=$postby;
           if($data=\DB::table('ourproduct_category')->insert($input)){
           return response()->json(['status'=>'success','message'=>'Record Saved Successfully!!']);
         }
          return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
       }
   }
  

   

   public function ourproductcategory_list(Request $request){
       $date_type=get_constant_value('DEFAULT_DATEPICKER');

       $data = OurProduct::get_ourproductcategory_list();
   
       $filtereddata = ($data["totalfilteredrecs"]>0?$data["totalfilteredrecs"]:$data["totalrecs"]);
       $totalrecs = $data["totalrecs"];
       unset($data["totalfilteredrecs"]);
       unset($data["totalrecs"]);

       $i = 0;
       $array = array();
       foreach($data as $key=>$row){
         
           $current_date=strtotime(CURDATE_EN);
       
       
           $array[$i]['id'] = $row->id;
           $array[$i]['ourproduct_cat']= $row->ourproduct_cat;
           $array[$i]['icon'] = $row->icon;
           $array[$i]['order'] = $row->order;
           $array[$i]['is_active'] = $row->is_active;
         

           $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/ourproduct_category/ourproductcategory_edit" data-id='.$row->id.' data-targetForm="ourproductcatForm" data-edittype="template"><i class="fa fa-edit"></i></a>

           <a href="javascript:void(0)" class="view" data-url="/api/ourproduct_category/ourproductcategory_view" data-id='.$row->id.'><i class="fa fa-eye" /></i></a>

           <a href="javascript:void(0)" class="btnDelete" data-url="/api/ourproduct_category/ourproductcategory_delete" data-id='.$row->id.' data-targetForm="ourproductcatForm" data-edittype="template"><i class="fa fa-trash"></i></a>
           ';

           $i++;
       }
       return response()->json(["recordsFiltered"=>$filtereddata,"recordsTotal"=>$totalrecs ,'data'=>$array]);
   }

   public function ourproductcategory_view(Request $request)
   {
       $trans=check_permission('View');
      
           if($trans=='error')
           {
               permission_message();
               exit;
           }
       $id=$request->get('id');
       $data = OurProduct::get_all_ourproductcategory_data($id);
     
       $view = view("OurProduct/OurProductCategoryView")
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
    public function ourproductcategory_edit(Request $request)
   {

       $id=$request->get('id');
       // $location =\DB::table('advertisement_location')->where(['is_active'=>'Y'])->get();
       $data = \DB::table('ourproduct_category')->where('id', $id)->first();
       $view = view("OurProduct/OurProductCategory")
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

   public function ourproductcategory_delete(Request $request)
   {
        $trans=check_permission('Delete');
           if($trans=='error')
           {
               permission_message();
               exit;
           }
      
       $id=$request->get('id');
       save_log('ourproduct_category','id',$id,false,'Delete');
       $data=\DB::table('ourproduct_category')->where('id', $id)->delete();
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
