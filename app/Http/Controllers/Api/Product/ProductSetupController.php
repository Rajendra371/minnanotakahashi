<?php

namespace App\Http\Controllers\Api\Product;

use App\Models\Product\ProductSetup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;


class ProductSetupController extends Controller
{

    public function __construct(Request $request)
    {
        $this->adjacencyList = "";
      
    }


    public function index(){
        $data= DB::table('product_category as m')
        ->leftJoin('product_category as s', 's.id', '=', 'm.parentid')
        ->select(DB::raw('(CASE WHEN(m.parentid<>0) THEN  s.category_name ELSE "--" END)  as category '), 'm.*')->get();
        $data['color']= DB::table('product_color')->get();
        $data['style'] = DB::table('product_style')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $data['quality']= DB::table('product_quality')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $data['material']=DB::table('product_material')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $data['collection']= DB::table('product_collection')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $data['brand']= DB::table('product_brand')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $data['shape']= DB::table('product_shape')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $data['waves']= DB::table('product_waves')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $data['pattern']= DB::table('product_pattern')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $data['unit']= DB::table('product_unit')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $data['branch'] = DB::table('branch_setup')->where('is_active','Y')->get();
        
        $product_prefix=get_constant_value('PRODUCT_NO_PREFIX');
        $product_length=get_constant_value('PRODUCT_NO_LENGTH');
        $data['product_id'] = generate_invoiceno_new('product_id', 'product_id', 'product', $product_prefix, $product_length); 

        if($data)
        {
            return response()->json(['data'=>$data,'status'=>'success','message'=>'Record Added Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }
    }

   
    public function cat(){
        $data=\DB::table('product_category')->where(['is_publish'=>'Y'])->get();
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
            'category_id'=>'required',
            'product_title'=>'required',
            'product_description'=>'required',
            'price'=>'required',
            'attachment' => 'nullable|array',
            'attachment.*' => 'nullable|file|mimes:jpeg,png,gif,jpg|max:5120',
        ]);
       if ($validator->fails()) {
                return response()->json(['status'=>'error','message'=>$validator->errors()->all()]);
        }

        $input = $request->except('attachment','length','breadth','unit');
        $input['parentid'] = $input['category_id'];
        $temp_file_names = '';
        $file_names='';
       
        if($request->hasFile('attachment')){
          
            $files = $request->file('attachment');
            foreach ($files as $key => $file) {

            $product_image_name = $file->getClientOriginalName();
            $filename = time()."-".preg_replace('/\s+/', '', $product_image_name);
            $file->move(('uploads/product_image/'), $filename);
            $src = url("/uploads/product_image/$filename"); //source for image 
            $dest = public_path("uploads/product_image/thumbnail/$filename"); //needs directory path to store new image
            //$dest = url("/uploads/product_image/thumbnail/$filename");
            createThumbnail($src, $dest, 270, 320);
            $temp_file_names .= $filename.',';
            } 
            $file_names =!empty($temp_file_names) ? substr($temp_file_names, 0, -1): '';
        }
        
        $all_color_id = $request->get('color_id');
        if(!empty($all_color_id)){
        $all_color_id = implode(',',$all_color_id);
        $input['color_id']=$all_color_id;
        }
        
        // $all_branch_id = $request->get('branch_id');
        // if(!empty($all_branch_id)){
        // $all_branch_id = implode(',',$all_branch_id);
        // $input['branch_id']=$all_branch_id;
        // }

        $all_material_id = $request->get('material_id');
        if(!empty($all_material_id)){
        $all_material_id = implode(',',$all_material_id);
        $input['material_id']=$all_material_id;
        }

        $all_quality_id = $request->get('quality_id');
        if(!empty($all_quality_id)){
        $all_quality_id = implode(',',$all_quality_id);
        $input['quality_id']=$all_quality_id;
        }

        $all_style_id = $request->get('style_id');
        if(!empty($all_style_id)){
        $all_style_id = implode(',',$all_style_id);
        $input['style_id']=$all_style_id;
        }

        $all_collection_id = $request->get('collection_id');
        if(!empty($all_collection_id)){
        $all_collection_id = implode(',',$all_collection_id);
        $input['collection_id']=$all_collection_id;
        }

        $all_brand_id = $request->get('brand_id');
        if(!empty($all_brand_id)){
        $all_brand_id = implode(',',$all_brand_id);
        $input['brand_id']=$all_brand_id;
        }

        $all_shape_id = $request->get('shape_id');
        if(!empty($all_shape_id)){
        $all_shape_id = implode(',',$all_shape_id);
        $input['shape_id']=$all_shape_id;
        }

        $all_waves_id = $request->get('waves_id');
        if(!empty($all_waves_id)){
        $all_waves_id = implode(',',$all_waves_id);
        $input['waves_id']=$all_waves_id;
        }

        $all_pattern_id = $request->get('pattern_id');
        if(!empty($all_pattern_id)){
        $all_pattern_id = implode(',',$all_pattern_id);
        $input['pattern_id']=$all_pattern_id;
        }

        $length = $request->get('length');
        $breadth = $request->get('breadth');
        $unit = $request->get('unit');
        $dimension = array();
        $input['dimension'] = '';
        if(!empty($length[0])){
            for ($i=0; $i < count($length); $i++) { 
            $input['dimension'] .=$length[$i].'x'.$breadth[$i].' '.$unit[$i].',';
            }
        }

        $input['product_slug'] = str_slug($input['product_title'],'-');
       
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
            $data = ProductSetup::where('id', $id)->first();
           
            if(!empty($file_names)){
                $old_pic = $data->image;
                if(!empty($old_pic)){
                    $old_pic_arr = explode(",",$old_pic);
                    foreach ($old_pic_arr as $key => $image) {
                        if (File::exists('uploads/product_image/'.$image)) {
                            unlink('uploads/product_image/'.$image);
                        }
                    }
                }
            }
            
            $input['updated_at']=datetime();
            $input['modifyip']=$postip;
            $input['modifymac']=$postmac;
            $input['modifyby']=$postby;
            $input['modifydatead']=$postdatead;
            $input['modifydatebs']=$postdatead;
            $input['modifytime']=date('H:i:s');
            $input['image']=!empty($filename)?$filename:'';
            $input['is_publish']=!empty($request->get('is_publish'))?$request->get('is_publish'):'N';
     
            unset($input['id']);
            save_log('product','id',$id,$input,'Update');
            $update=\DB::table('product')->where('id',$id)->update($input);
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
            $input['image']=!empty($file_names)?$file_names:'';
        
            if($data=ProductSetup:: forceCreate($input)){
            return response()->json(['status'=>'success','message'=>'Record Saved Successfully!!']);
            }
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
        }
    }
   


    public function productsetup_list(Request $request){
        $date_type=get_constant_value('DEFAULT_DATEPICKER');

        $data = ProductSetup::get_productsetup_list();
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
            $summ = '';
            if(!empty($row->count_params)){
                $params = explode('|',$row->count_params);
                $summ = "<div class='d-flex justify-content-center'><span class='btn btn-sm btn-warning' style='color: rgb(255, 255, 255);'>".$params[0]."</span>"."<span class='btn btn-sm btn-success'>".$params[1]."</span>"."<span class='btn btn-sm btn-primary'>".$params[2]."</span></div>";
            }else{
                $summ = "<div class='d-flex justify-content-center'><span class='btn btn-sm btn-warning' style='color: rgb(255, 255, 255);'>0</span><span class='btn btn-sm btn-success'>0</span>"."<span class='btn btn-sm btn-primary'>0</span></div>";
            }
            $current_date=strtotime(CURDATE_EN);
            $array[$i]['id'] = $row->id;
            $array[$i]['parentid']= $row->category_name;
            $array[$i]['product_title']= $row->product_title;
            if(!empty($row->image)){
                $img = explode(',',$row->image);
                if(file_exists(public_path("uploads/product_image/thumbnail/".$img[0]))){
                    $array[$i]['image']= '<img src="'.asset("uploads/product_image/thumbnail/".$img[0]).'" height="30px" width="30px">';
                } else{
                    $array[$i]['image']= '';
                } 
            }else{
                $array[$i]['image']="";
            }
            $array[$i]['product_description'] = str_limit($row->product_description, $limit = 75, $end = '...');
            $array[$i]['price'] = $row->price;
            $array[$i]['discount_pc'] = $row->discount_pc;
            $array[$i]['discount_amount'] = $row->discount_amount;
            $array[$i]['product_code'] = $row->product_code;
            $array[$i]['product_id'] = $row->product_id;
            $array[$i]['is_publish'] = $row->is_publish == 'Y' ? 'Yes' : 'No';
            
            $array[$i]['order'] = $summ;
            $array[$i]['views'] = $row->view_count;
            $array[$i]['stock'] = 0;

            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnView" id="open_product_div" data-url="/api/product_setup/productsetup_edit" data-id='.$row->id.' 
            data-targetForm="productsetForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            &nbsp
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/product_setup/productsetup_delete" data-id='.$row->id.' data-targetForm="productsetForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered"=>$filtereddata,"recordsTotal"=>$totalrecs ,'data'=>$array]);
    }

     public function productsetup_edit(Request $request)
    {

        $id=$request->get('id');
        $parentcat=\DB::table('product_category')->where(['is_publish'=>'Y'])->get();
        $data = \DB::table('product')->where('id', $id)->first();
        $fields['color']= DB::table('product_color')->get();
        $fields['style'] = DB::table('product_style')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $fields['quality']= DB::table('product_quality')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $fields['material']=DB::table('product_material')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $fields['collection']= DB::table('product_collection')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $fields['brand']= DB::table('product_brand')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $fields['shape']= DB::table('product_shape')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $fields['waves']= DB::table('product_waves')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $fields['pattern']= DB::table('product_pattern')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $fields['unit']= DB::table('product_unit')->where('is_display',"1")->orderBy("display_order",'ASC')->get();
        $fields['branch'] = DB::table('branch_setup')->where('is_active','Y')->get();
        $view = view("Product/ProductSetup")
        ->with('data',$data)->with('parentcat',$parentcat)->with('fields',$fields);
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

    public function productsetup_delete(Request $request)
    {
          $trans=check_permission('Delete');
            if($trans=='error')
            {
                permission_message();
                exit;
            }
       
        $id=$request->get('id');
          save_log('product','id',$id,false,'Delete');
        $data=ProductSetup::where('id', $id)->delete();
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
        $cat_data .= '<select name="category_id" onChange={this.handleChanges} value={this.state.parentcat} class="form-control" id="category"> <option value="0">--Select--</option>';
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

    // /**
    //  * @param $src - a valid file location
    //  * @param $dest - a valid file target
    //  * @param $targetWidth - desired output width
    //  * @param $targetHeight - desired output height or null
    //  */
    // function createThumbnail($src, $dest, $targetWidth, $targetHeight = null) {
    //      $IMAGE_HANDLERS = [
    //         [],
    //         [
    //             'load' => 'imagecreatefromgif',
    //             'save' => 'imagegif',
    //             'quality' => 0
    //         ],
    //         [
    //             'load' => 'imagecreatefromjpeg',
    //             'save' => 'imagejpeg',
    //             'quality' => 100
    //         ],
    //         [
    //             'load' => 'imagecreatefrompng',
    //             'save' => 'imagepng',
    //             'quality' => 0
    //         ]
            
    //     ];
    
    //     // 1. Load the image from the given $src
    //     // - see if the file actually exists
    //     // - check if it's of a valid image type
    //     // - load the image resource
    
    //     // get the type of the image
    //     // we need the type to determine the correct loader
    //     $type = exif_imagetype($src);
    //     // dd( $src, $dest,$IMAGE_HANDLERS,$type);
    
    //     // if no valid type or no handler found -> exit
    //     if (!$type || !$IMAGE_HANDLERS[$type]) {
    //         return null;
    //     }
    
    //     // load the image with the correct loader
    //     $image = call_user_func($IMAGE_HANDLERS[$type]['load'], $src);
        
    //     // dd($image);
    //     // no image found at supplied location -> exit
    //     if (!$image) {
    //         return null;
    //     }
    
    
    //     // 2. Create a thumbnail and resize the loaded $image
    //     // - get the image dimensions
    //     // - define the output size appropriately
    //     // - create a thumbnail based on that size
    //     // - set alpha transparency for GIFs and PNGs
    //     // - draw the final thumbnail
    
    //     // get original image width and height
    //     $width = imagesx($image);
    //     $height = imagesy($image);
    
    //     // maintain aspect ratio when no height set
    //     if ($targetHeight == null) {
    
    //         // get width to height ratio
    //         $ratio = $width / $height;
    
    //         // if is portrait
    //         // use ratio to scale height to fit in square
    //         if ($width > $height) {
    //             $targetHeight = floor($targetWidth / $ratio);
    //         }
    //         // if is landscape
    //         // use ratio to scale width to fit in square
    //         else {
    //             $targetHeight = $targetWidth;
    //             $targetWidth = floor($targetWidth * $ratio);
    //         }
    //     }
    
    //     // create duplicate image based on calculated target size
    //     $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);
    //     // dd($thumbnail);
    
    //     // set transparency options for GIFs and PNGs
    //     if ($type == 1 || $type == 3) {
    
    //         // make image transparent
    //         imagecolortransparent(
    //             $thumbnail,
    //             imagecolorallocate($thumbnail, 0, 0, 0)
    //         );
    
    //         // additional settings for PNGs
    //         if ($type == 3) {
    //             imagealphablending($thumbnail, false);
    //             imagesavealpha($thumbnail, true);
    //         }
    //     }
    
    //     // copy entire source image to duplicate image and resize
    //     imagecopyresampled(
    //         $thumbnail,
    //         $image,
    //         0, 0, 0, 0,
    //         $targetWidth, $targetHeight,
    //         $width, $height
    //     );
    
    
    //     // 3. Save the $thumbnail to disk
    //     // - call the correct save method
    //     // - set the correct quality level
    
    //     // save the duplicate version of the image to disk
    //     return call_user_func(
    //         $IMAGE_HANDLERS[$type]['save'],
    //         $thumbnail,
    //         $dest,
    //         $IMAGE_HANDLERS[$type]['quality']
    //     );
    // }
}