<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Checkout\Checkout;
use App\Models\Checkout\CheckoutDetail;
use App\Models\Delivery\DeliveryMaster;
use App\Models\Delivery\DeliveryDetail;
use Validator;
use DB;

class ProductOrderController extends Controller
{

    public function product_order_data()
    {
        $data['payment_method'] = DB::table('payment_method')->select('id','payment_name')->where('isactive','Y')->get();
        $data['delivery_person'] = DB::table('employee')->select('id','first_name','last_name')->get();
        
        return response()->json(['status'=>'success','data'=>$data]);
    }

    public function order_view(Request $request)
    {
        $checkout_id = $request->get('id');
        $data['master'] = DB::table('product_checkout_master as cm')
        ->leftJoin('payment_method as pm','cm.payment_methodid','=','pm.id')
        ->leftJoin('users as usr','cm.customer_id','=','usr.id')
        ->leftJoin('guest_customer as gc','cm.guest_customer_id','=','gc.id')
        ->select('cm.*','pm.payment_name','usr.username as user_name','usr.email as user_email','usr.contact as usr_mobile','gc.fullname as guest_name','gc.mobile_no as guest_mobile','gc.email as guest_email',DB::raw("
        CASE
        WHEN cm.status = 'O' THEN 'Ordered'
        WHEN cm.status= 'CO' THEN 'Order Confirmed'
        ELSE 'Cancelled'
        END AS order_status
        "))->where('cm.id',$checkout_id)->first();
        
        $data['details'] = DB::table('product_checkout_detail as pd')->leftJoin('product as p','pd.productid','=','p.id')
        ->leftJoin('product_color as pc','p.color_id','=','pc.id')
        ->leftJoin('product_material as pm','p.material_id','=','pm.id')
        ->leftJoin('product_shape as ps','p.shape_id','=','ps.id')
        ->select('pd.id','pd.productid','p.image','pd.qty','pd.rate','pd.total_amt','p.product_title','pd.checkout_masterid','pd.status','p.product_code','p.product_description','pc.color_name','pc.hex_code','pm.material_name','ps.shape_name')->where('checkout_masterid',$checkout_id)->get();
        // dd($data);
        $view = view('Product.ProductOrder.View')->with('data',$data);
        $template = $view->render();
        if($template){
            return response()->json(['status'=>'success','template'=>$template,'message'=>'Data Fetched']);
        }else{
            return response()->json(['status'=>'error','message'=>'Error']);
        }

    }


    public function product_order_list()
    {
        $data = Checkout::get_order_list();
        $filtereddata = ($data["totalfilteredrecs"]>0?$data["totalfilteredrecs"]:$data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);
 
        $array = array();
        foreach($data as $i=>$row){   
            
            $status = $row->status;
            if($status=='O'){
                $st_style='color:#ff9600';
            } 
            else if($status=='CO'){
                $st_style='color:#0b920b';
            }
            else if($status=='C'){
                $st_style='color:#ff0800';
            }
        
            $array[$i]['id'] = $row->id;
            $array[$i]['order_status'] = $row->status;
            $array[$i]['checkout_datead']= $row->checkout_datead;
            $array[$i]['customer_name'] = !empty($row->user_name) ? $row->user_name : $row->guest_name;
            $array[$i]['address'] =  $row->ship_str_address;
            $array[$i]['mobile_no'] = !empty($row->usr_mobile) ? $row->usr_mobile : $row->guest_mobile ;
            $array[$i]['orderno'] = $row->orderno;
            $array[$i]['total_items'] = $row->total_product;
            $array[$i]['payment_method'] = $row->payment_name;
            $array[$i]['currency'] = $row->currency;
            $array[$i]['grand_total'] = number_format($row->grand_totalamt,2);
            $array[$i]['status'] = $row->order_status;
            $array[$i]['st_style'] = $st_style;
            $array[$i]['action'] = '
            <a href="javascript:void(0)" class="view" data-url="/api/product_order/order_view" data-id='.$row->id.' data-targetForm="productcatForm" data-edittype="template"><i class="fa fa-eye"></i></a>  
            ';            
        }
        
       // <a href="javascript:void(0)" class="" data-url="/api/product_order/confirm_order" data-id='.$row->id.'><i class="fa fa-check" /></i></a>
       // <a href="javascript:void(0)" class="" data-url="/api/product_order/cancel_order" data-id='.$row->id.'><i class="fa fa-times" style="color:red;"}}></i></a>
        return response()->json(["recordsFiltered"=>$filtereddata,"recordsTotal"=>$totalrecs ,'data'=>$array]);
    }


    public function change_order_status(Request $request)
    {
        DB::beginTransaction();
        try{
            $checkout_id=$request->get('ch_id');
            $status = $request->get('status');
            if(empty($checkout_id)){
                return response()->json(['status'=>'error','message'=>'No Order Selected, Please Select An Order!!']);
            }
            if(!empty($checkout_id)){
            $result=Checkout::whereIn('id', $checkout_id)
            ->get();
            
            $postby=auth()->user()->id;
            $locationid=auth()->user()->locationid;
            $orgid=auth()->user()->orgid;
            $postdatead=CURDATE_EN;
            $postdatebs=EngToNepDateConv(CURDATE_EN);
            $postip=get_real_ipaddr();
            $postmac=get_Mac_Address();

            if(!empty($result)){
                $updateStatusArray=array(
                    'status'=> $status,
                    'status_datead'=>$postdatead,
                    'status_datebs'=>$postdatebs,
                    'status_time'=>date('H:i:s'),
                    'status_by'=>$postby,
                    'status_ip'=>$postip
                );
                Checkout::whereIn('id', $checkout_id)->update($updateStatusArray);
                CheckoutDetail::whereIn('checkout_masterid', $checkout_id)->update(['status'=>$status]);
                if($status == 'CO'){
                    foreach ($result as $key => $res) {
                        $delivery_master = array(
                            'customer_id' => $res->customer_id,
                            'guest_customer_id' => $res->guest_customer_id,
                            'checkout_masterid' => $res->id,
                            'product_cnt' => $res->total_product,
                            'product_amt' => $res->grand_totalamt,
                            'postby'=>$postby,
                            'postdatead' => $postdatead,
                            'postdatebs' => $postdatebs,
                            'posttime' => date('H:i:s'),
                            'postip' => $postip,
                            'postmac' => $postmac,
                            'created_at' => datetime(),
                            'updated_at' => datetime()
                        ); 
                        $del_masterid =  DeliveryMaster::insertGetId($delivery_master);
                        $checkout_items =CheckoutDetail::where('checkout_masterid', $res->id)->get();
                        if(!empty($checkout_items)){
                            foreach ($checkout_items as $chk => $chval) {
                                $delivery_details = array(
                                    'product_ass_del_masterid' => $del_masterid,
                                    'checkout_masterid' => $chval->checkout_masterid,
                                    'checkout_detailid' => $chval->id,
                                    'product_id' => $chval->productid,
                                    'qty' => $chval->qty,
                                    'pur_rate' => $chval->rate,
                                    'total_amt' => $chval->total_amt,
                                    'postby'=>$postby,
                                    'postdatead' => $postdatead,
                                    'postdatebs' => $postdatebs,
                                    'posttime' => date('H:i:s'),
                                    'postip' => $postip,
                                    'postmac' => $postmac,
                                );
                                DeliveryDetail::create($delivery_details);
                            }
                        }
                    }
                }
            }
        }
        DB::commit();
        return response()->json(['status'=>'success','message'=>'Record Updated Successfully !!']);     
    }
    catch (\Exception $e) {
        DB::rollback();
        return response()->json(['status'=>'error','message'=>$e->getMessage()]);
    }   
    }

    public function change_item_status(Request $request)
    {
        DB::beginTransaction();
        try{
            $det_id=$request->get('ch_id');
            $status = $request->get('status');
            if(empty($det_id)){
                return response()->json(['status'=>'error','message'=>'No Item Selected, Please Select An Item!!']);
            }
            if(!empty($det_id)){
            $result=CheckoutDetail::whereIn('id', $det_id)
            ->get();
            
            $postby=auth()->user()->id;
            $locationid=auth()->user()->locationid;
            $orgid=auth()->user()->orgid;
            $postdatead=CURDATE_EN;
            $postdatebs=EngToNepDateConv(CURDATE_EN);
            $postip=get_real_ipaddr();
            $postmac=get_Mac_Address();

            if(!empty($result)){
                $checkout_masterid = $result[0]->checkout_masterid;
                $master_data = Checkout::where('id',$checkout_masterid)->first();
                $amount = 0;
                $qty = 0;
                foreach ($result  as $key => $res) {
                    $amount += $res->total_amt; 
                    $qty += $res->qty;
                    DB::table('checkout_item_removed_log')->insert(['checkout_detail_id'=>$res->id,'status'=>$status]);
                }
                CheckoutDetail::whereIn('id', $det_id)->update(['status'=>$status]);
                $updArr = array(
                    'total_product' => $master_data->total_product - $qty,
                    'sub_totalamt' => $master_data->sub_totalamt - $amount,
                    'grand_totalamt' => $master_data->grand_totalamt - $amount,
                );
                $master_data->update($updArr);
            }
        }
        DB::commit();
        return response()->json(['status'=>'success','message'=>'Record Updated Successfully !!']);     
    }
    catch (\Exception $e) {
        DB::rollback();
        return response()->json(['status'=>'error','message'=>$e->getMessage()]);
    }   
    }

    public function get_order_status(Request $request)
    {
        $summarydata=Checkout::get_order_status();
        $orderedcnt=0;
        $confirmedcnt=0;
        $cancelledcnt=0;
        if(!empty($summarydata)){
            $orderedcnt=!empty($summarydata[0]->orderedcnt)?$summarydata[0]->orderedcnt:'0';
            $confirmedcnt=!empty($summarydata[0]->confirmedcnt)?$summarydata[0]->confirmedcnt:'0';
            $cancelledcnt=!empty($summarydata[0]->cancelledcnt)?$summarydata[0]->cancelledcnt:'0';
            return response()->json(['status'=>'success','message'=>'Data Available','orderedcnt'=>$orderedcnt,'confirmedcnt'=>$confirmedcnt,'cancelledcnt'=>$cancelledcnt]);

        }else{
            return response()->json(['status'=>'error','message'=>'Data Available','orderedcnt'=>$orderedcnt,'confirmedcnt'=>$confirmedcnt,'cancelledcnt'=>$cancelledcnt]);
        }
    }

}