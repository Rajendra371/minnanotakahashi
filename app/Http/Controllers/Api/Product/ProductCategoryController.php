<?php

namespace App\Http\Controllers\Api\Product;

use App\Models\Product\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;


class ProductCategoryController extends Controller
{

    public function __construct(Request $request)
    {
        $this->adjacencyList = "";
      
    }

    public function index(){
        $data= DB::table('product_category as m')
        ->leftJoin('product_category as s', 's.id', '=', 'm.parentid')
        ->select(DB::raw('(CASE WHEN(m.parentid<>0) THEN  s.category_name ELSE "--" END)  as category '), 'm.*')->get();
        // echo "<pre>";
        // print_r( $data);
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
        // dd($request->all());
        $upload_file=get_constant_value('IMAGES_FOLDER');
        $validator = Validator::make($request->all(), [
            'category_name'=>'required',
            'sales_percent' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'file' => 'nullable|file|mimes:jpeg,png,gif,jpg|max:5120',
        ]);
        if ($validator->fails()) {
        return response()->json(['status'=>'error','message'=>$validator->errors()->all()]);
        }
        $input = $request->except('old_img_file','file','id','is_publish','is_featured');

        $temp_file_names = '';
       
        if($request->hasFile('file')){
            $product_img = $request->file('file');
            $product_image_name = time()."-".$product_img->getClientOriginalName();
            $filename = preg_replace('/\s+/', '', $product_image_name);
            $product_img->move(('uploads/product_image/'), $filename);
        }
        $input['is_publish']=!empty($request->get('is_publish'))?$request->get('is_publish'):'N';
        $input['is_featured']=!empty($request->get('is_featured'))?$request->get('is_featured'):'N';
        $input['category_slug'] = str_slug($input['category_name'],'-');

        $id=$request->get('id');
        $old_img_file=$request->get('old_img_file');

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
            if(!empty($filename)){
                if (File::exists('uploads/product_image/'.$old_img_file)) {
                    unlink('uploads/product_image/'.$old_img_file);
                }
            }
            
        $data = ProductCategory::where('id', $id)->first();

        $input['updated_at']=datetime();
        $input['modifyip']=$postip;
        $input['modifymac']=$postmac;
        $input['modifyby']=$postby;
        $input['modifydatead']=$postdatead;
        $input['modifydatebs']=$postdatead;
        $input['modifytime']=date('H:i:s');
        $input['image']=!empty($filename)?$filename:$old_img_file;
       
        save_log('product_category','id',$id,$input,'Update');
        $update=\DB::table('product_category')->where('id',$id)->update($input);
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
        $input['image']=!empty($filename)?$filename:$old_img_file;
       
        if($data=ProductCategory:: forceCreate($input)){
        return response()->json(['status'=>'success','message'=>'Record Saved Successfully!!']);
        }
        return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
        }
    }
   


    public function productcategory_list(Request $request){
        $date_type=get_constant_value('DEFAULT_DATEPICKER');
        
        $data = ProductCategory::get_productcategory_list();
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
            $array[$i]['parentid']= $row->category;
            $array[$i]['image']= 
            !empty($row->image) ?
                '<img src="'.asset("uploads/product_image/".$row->image).'" height="30px" width="30px">'
                :
                '';
            $array[$i]['category_name'] = $row->category_name;
            $array[$i]['is_publish'] = $row->is_publish;
            $array[$i]['is_featured'] = $row->is_featured;
            $array[$i]['order'] = $row->order;
            
          
            
            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/product_category/productcategory_edit" data-id='.$row->id.' data-targetForm="productcatForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            
            <a href="javascript:void(0)" class="view" data-url="/api/product_category/productcategory_view" data-id='.$row->id.'><i class="fa fa-eye" /></i></a>

            <a href="javascript:void(0)" class="btnDelete" data-url="/api/product_category/productcategory_delete" data-id='.$row->id.' data-targetForm="productcatForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered"=>$filtereddata,"recordsTotal"=>$totalrecs ,'data'=>$array]);
    }

    public function productcategory_view(Request $request)
    {
         $trans=check_permission('View');
       
            if($trans=='error')
            {
                permission_message();
                exit;
            }
        $id=$request->get('id');
        $data = ProductCategory::get_all_productcategory_data($id);
        
        
        $view = view("Product/ProductCategoryView")
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

     public function productcategory_edit(Request $request)
    {

        $id=$request->get('id');
        $parentcat=\DB::table('product_category')->where(['is_publish'=>'Y'])->get();
        // $menu =\DB::table('menu')->where(['menu_isactive'=>'Y'])->get();
        $data = \DB::table('product_category')->where('id', $id)->first();
        // echo "<pre>";
        // print_r($menu);
        // die();

        $view = view("Product/ProductCategory")
        ->with('data',$data)->with('parentcat',$parentcat);
        // ->with('menu',$menu);
            
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

    public function productcategory_delete(Request $request)
    {
          $trans=check_permission('Delete');
            if($trans=='error')
            {
                permission_message();
                exit;
            }
       
        $id=$request->get('id');
       save_log('product_category','id',$id,false,'Delete');
        $data=ProductCategory::where('id', $id)->delete();
        if($data)
        {
              return response()->json(['status'=>'success','message'=>'Record Deleted Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }

    }

    public function get_productcat()
    {
        $cat_data = '';
        $cat_data .= '<select name="parentid" onChange={this.handleChanges} value={this.state.parentcat} class="form-control" id="parentid"> <option value="0">--Select--</option>'; 
        $cat_data .= $this->product_adjacency(0, 0, 0, 0);
        $cat_data .= '</select>';
       
        if ($cat_data) {
            return response()->json(['data' => $cat_data, 'status' => 'success', 'message' => 'Record Fetched Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function product_adjacency($id, $parent, $parent_id, $level)
    {
        // $softwareid = auth()->user()->softwareid;
        $query = DB::table('product_category')
            ->where('parentid', '=', $parent_id)
            // ->where('softwareid', $softwareid)
            // ->orderby('ASC')
            ->get();
        $oMenus = $query;
        // $this->adjacencyList.="";
        foreach ($oMenus as $value) :
            $this->adjacencyList .= "<option value=" . $value->id;
            if ($parent == $value->id)
            $this->adjacencyList .= " selected";
            $this->adjacencyList .= ">" . str_repeat('  &minus; ', $level) . stripslashes($value->category_name) . "</option>";
            $this->product_adjacency($id, $parent, $value->id,  $level + 1);
        endforeach;
        return $this->adjacencyList;

    }
}