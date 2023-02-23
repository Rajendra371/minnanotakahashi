<?php

namespace App\Http\Controllers\Api\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Product\SalesSetupMaster;
use App\Models\Product\SalesSetupDetail;
use DB;
use Validator;

class SalesSetupController extends Controller
{   
    public function __construct(Request $request)
    {
        $this->adjacencyList = "";
      
    }


    public function get_from_template()
    {
        $category_list = $this->get_productcat();
        $view = view('Product.Sales_Form')->with('category_list',$category_list);
        $template = $view->render();
        if($template){
            return response()->json(['status'=>'success','data'=>$template]);
        }
        else
        {
        return response()->json(['status'=>'error','message'=>'Error Fetching Template']);
        }
    }

    public function store(Request $request)
    {   
       
        $validator = Validator::make($request->all(), [
            'product_category_id'=>'required',
            'sales_product_id' =>'required',
            'discount_percent' => 'required|regex:/^\d+(\.\d{1,2})?$/',
        ]);
        if ($validator->fails()) {
        return response()->json(['status'=>'error','message'=>$validator->errors()->all()]);
        }
        
        $id=$request->get('id');
        $input = $request->except('id','is_active','sales_product_id','product_select','product_sales','product_id');

        $product_select = $request->product_select;
        
        $input['is_active']=!empty($request->get('is_active'))?$request->get('is_active'):'N';

        $postby=auth()->user()->id;
        $locationid=auth()->user()->locationid;
        $orgid=auth()->user()->orgid;
        $postdatead=CURDATE_EN;
        $postdatebs=EngToNepDateConv(CURDATE_EN);
        $postip=get_real_ipaddr();
        $postmac=get_Mac_Address();
        DB::beginTransaction();
        try {
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

            $master_id = SalesSetupMaster::insertGetId($input);
            if($product_select == "custom"){
                $product_id = explode(",",$request->sales_product_id);
                foreach ($product_id as $key => $pid) {
                    $sales_details = array(
                        'product_sales_masterid' => $master_id,
                        'product_id' => $pid,
                        'discount_percent' => $input['discount_percent'],
                        'postip'=> $postip,
                        'postmac'=>  $postmac,
                        'postdatead'=> $postdatead,
                        'postdatebs'=> $postdatebs,
                        'posttime'=> date('H:i:s'),
                        'postby'=> $postby
                    );
                    SalesSetupDetail::create($sales_details);
                }
            }else{
                $product_category_id = $request->product_category_id;
                $product_id = DB::table('product')->where('category_id',$product_category_id)->where('is_publish','Y')->select('id')->get();
                foreach ($product_id as $key => $pid) {
                    $sales_details = array(
                        'product_sales_masterid' => $master_id,
                        'product_id' => $pid->id,
                        'discount_percent' => $input['discount_percent'],
                        'postip'=> $postip,
                        'postmac'=>  $postmac,
                        'postdatead'=> $postdatead,
                        'postdatebs'=> $postdatebs,
                        'posttime'=> date('H:i:s'),
                        'postby'=> $postby
                    );
                    SalesSetupDetail::create($sales_details);
                }
            }
            
            DB::commit();
            return response()->json(['status'=>'success','message'=>'Record Saved Successfully!!']);
        
        } catch (\Throwable $th) {
            DB::rollback();
            return response()->json(['status'=>'error','message'=>$th->getMessage()]);
        }
           
    }

    public function get_sales_list()
    {
        $data = SalesSetupMaster::get_sales_list_data();
        $filtereddata = ($data["totalfilteredrecs"]>0?$data["totalfilteredrecs"]:$data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);
        $array = array();
        foreach ($data as $i => $data) {
            $array[$i]['id'] = $data->id;
            $array[$i]['category_name'] = $data->category_name;
            $array[$i]['product_name'] = $data->product_title;
            $array[$i]['discount'] = $data->discount_percent;
            $array[$i]['start_date'] = $data->start_datead;
            $array[$i]['end_date'] = $data->end_datead;
            $array[$i]['image'] = '<img src='.asset("uploads/product_image/thumbnail/$data->image").' width="50px" height="50px">';
            $array[$i]['action'] = "";
            
        }
        return response()->json(["recordsFiltered"=>$filtereddata,"recordsTotal"=>$totalrecs ,'data'=>$array]);
    }


    public function get_product_list(Request $request)
    {
        $category_id = $request->category_id;
        // $data = DB::table('product')->where('category_id',$category_id)->where('is_publish','Y')->get();
        $view = view('Product.Sales_Product_List')->with('category_id',$category_id);
        $template = $view->render();
        if($template){
            return response()->json(['status'=>'success','data'=>$template,'message'=>'Template Fetched!!']);
        }
        
        return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
    }

    public function product_datatable_list()
    {      
        $data = SalesSetupMaster::get_product_list();
        $filtereddata = ($data["totalfilteredrecs"]>0?$data["totalfilteredrecs"]:$data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);
        $array = array();
        foreach ($data as $i => $data) {
            $array[$i]['id'] = $data->id;
            $array[$i]['product_title'] = $data->product_title;
            $array[$i]['price'] = $data->price;
            $array[$i]['publish'] = $data->is_publish;
            $array[$i]['image'] = '<img src='.asset("uploads/product_image/thumbnail/$data->image").' width="100px" height="100px">';

        }
        return response()->json(["recordsFiltered"=>$filtereddata,"recordsTotal"=>$totalrecs ,'data'=>$array]);
    }

    public function get_productcat()
    {
        $cat_data = '';
        $cat_data .= '<select name="product_category_id" class="form-control" id="category_id"> <option value="0">--Select--</option>'; 
        $cat_data .= $this->product_adjacency(0, 0, 0, 0);
        $cat_data .= '</select>';
        return $cat_data;
    }

    public function product_adjacency($id, $parent, $parent_id, $level)
    {
        $query = DB::table('product_category')
            ->where('parentid', '=', $parent_id)
            ->get();
        $oMenus = $query;
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
