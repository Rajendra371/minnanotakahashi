<?php

namespace App\Http\Controllers\Api\Checkout;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Checkout\Checkout;
use App\Models\Checkout\CheckoutDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use Cart;
use DB;

class CheckoutController extends Controller
{
    public function add_checkout_address(Request $request)
    {
        try {
            $validation = Validator::make($request->all(),[
                'ship_fullname' => 'required|string|max:100',
                'ship_mobile_no' => 'required|digits:10', 
                'ship_str_address' => 'required|string|max:60', 
                'ship_province_id' => 'required|numeric', 
                'ship_district_id' => 'required|numeric', 
                'ship_mun_vdc_id' => 'required|numeric', 
                'ship_postal_zip_code' => 'nullable|numeric', 
                'billing_address' => 'required',
                'bill_fullname' => 'required_if:billing_address,D|string|max:100', 
                'bill_mobile_no' => 'required_if:billing_address,D|digits:10', 
                'bill_str_address' => 'required_if:billing_address,D|string|max:60', 
                'bill_province_id' => 'required_if:billing_address,D|numeric', 
                'bill_district_id' => 'required_if:billing_address,D|numeric', 
                'bill_mun_vdc_id' => 'required_if:billing_address,D|numeric', 
                'bill_postal_zip_code' => 'nullable|numeric', 
                ]);
    
                if( $validation->fails() ){
                    return response()->json(['status'=>'error','message'=>$validation->errors()->all()]);
                }
    
            $input = $request->all();
            $billing_address = $request->get('billing_address');    
            
            if($billing_address == 'S'){
                $input['bill_fullname'] = $input['ship_fullname'];
                $input['bill_mobile_no'] = $input['ship_mobile_no'];
                $input['bill_str_address'] = $input['ship_str_address'];
                $input['bill_province_id'] = $input['ship_province_id'];
                $input['bill_district_id'] = $input['ship_district_id'];
                $input['bill_mun_vdc_id'] = $input['ship_mun_vdc_id'];
                $input['bill_postal_zip_code'] = $input['ship_postal_zip_code'];
            }
    
            if (Auth::check())
            {
                $input['customer_id'] = auth()->user()->id;
            }else if(session('guest_customer_id')){
                $input['guest_customer_id'] = session('guest_customer_id');
            }
            if(Session::has('checkout_details')){
                Session::forget('checkout_details');
                Session::put(['checkout_details'=>$input]);
            }else{
                Session::put(['checkout_details'=>$input]);
            }
            Session::save();
            return response()->json(['status' => 'success','message'=>'Data Stored']);

        } catch (\Throwable $th) {
            return response()->json(['status' => 'error','message'=>$th->getMessage()]);
        } 
    }

    public function add_payment_method(Request $request)
    {   
        try {
            $validation = Validator::make($request->all(),[
                'payment_id'=>'required',
            ]);
            if($validation->fails()){
                return response()->json(['status'=>'error','message'=>'Please Select A Payment Method']);
            }
        $payment_id = $request->get('payment_id');
        if($payment_id){
            $checkout_detail = Session::get('checkout_details');
            if(!empty($checkout_detail)){
            $checkout_detail['payment_methodid'] = $payment_id; 
            Session::forget('checkout_details');
            Session::put(['checkout_details'=>$checkout_detail]);
            Session::save();
                return response()->json(['status' => 'success','message'=>'Payment Method Stored','data'=>$checkout_detail]);
            }
        }
        } catch (\Throwable $th) {
            return response()->json(['status'=>'error','message'=>$th->getMessage()]);
        }
    }

    public function confirm_checkout_order()
    {
        DB::beginTransaction();
        try {
            $checkout_detail = Session::get('checkout_details');
            if(!empty($checkout_detail)){
                $postdatead=CURDATE_EN;
                $postdatebs=EngToNepDateConv(CURDATE_EN);
                $postip=get_real_ipaddr();
                $postmac=get_Mac_Address();

                $order_prefix=get_constant_value('ORDER_NO_PREFIX');
                $order_length=get_constant_value('ORDER_NO_LENGTH');
                $checkout_detail['orderno'] = generate_invoiceno_new('orderno', 'orderno', 'product_checkout_master', $order_prefix, $order_length,false);
                $checkout_detail['postby'] = !empty($checkout_detail['customer_id']) ? $checkout_detail['customer_id'] : 0;
                $checkout_detail['postip']=$postip;
                $checkout_detail['postmac']=$postmac;
                $checkout_detail['postdatead']=$postdatead;
                $checkout_detail['postdatebs']=$postdatead;
                $checkout_detail['posttime']=date('H:i:s');
                $checkout_detail['currency']=CURRENCY;

                $mail_message = "";
                $mas_checkout = Checkout::create($checkout_detail);
                if($mas_checkout){
                    $tot_product = 0;
                    $sub_total = 0;
                    $cart_items = Cart::getContent();
                    $checkout_items_details = array();  
                    if(!empty($cart_items)){
                        foreach($cart_items as $cikey => $cival){
                            $checkout_items_details[] = array(
                                'checkout_masterid' => $mas_checkout->id,
                                'productid' => $cival->id,
                                'currency' => CURRENCY,
                                'qty' => $cival->quantity,
                                'rate' => $cival->price,
                                'total_amt' => ($cival->quantity * $cival->price),
                                'postip' => $postip,
                                'postmac' => $postmac,
                                'postdatead' => $postdatead,
                                'postdatebs' => $postdatebs,
                                'posttime' => date('H:i:s'),
                                'postby' => $mas_checkout->postby,
                                'created_at' => datetime(),
                                'updated_at' => datetime(),
                            );
                            $tot_product += $cival->quantity;
                            $sub_total += ($cival->quantity * $cival->price);
                        }
                    }
                    $update_chkout_master = array(
                        'total_product' => $tot_product,
                        'sub_totalamt' => $sub_total,
                        'grand_totalamt' => $sub_total,
                        'checkout_datead' =>  $postdatead,
                        'checkout_datebs' =>  $postdatebs,
                        'checkout_time'=> date('H:i:s'),
                        'updated_at'=> datetime(),
                        'modifyby' => $mas_checkout->postby,
                        'modifyip'=> $postip,
                        'modifymac'=> $postmac,
                        'modifydatead'=> $postdatead,
                        'modifydatebs'=> $postdatead,
                        'modifytime'=> date('H:i:s'),
                    );
                    Checkout::where('id',$mas_checkout->id)->update($update_chkout_master);
                    CheckoutDetail::insert($checkout_items_details);
                    Session::forget('checkout_details');
                    Session::forget('guest_customer_id');
                    Session::forget('4yTlTDKu3oJOfzD_cart_items');
                    $mail_message =  $this->send_order_mail($mas_checkout->id);
                }
            } 
            DB::commit();
            return response()->json(['status'=>'success','message'=>"Order Confirmed , $mail_message",'order_id'=>$mas_checkout->orderno]);
        }catch (\Throwable $th) {
            return response()->json(['status'=>'error','message'=>$th->getMessage()]);
        }
    }   


    public function send_order_mail($checkout_id, $print = false)
    {
        $parseValues = array();
        $checkout_data = Checkout::get_checkout_data_for_email($checkout_id); 
        if(!empty($checkout_data)){
            $data = $checkout_data[0];
            $currency = $data->currency;
            $emailAddress = !empty($data->user_email) ? $data->user_email : $data->guest_email;
            
            $email_details = "";
            $details = DB::table('product_checkout_detail as pd')->leftJoin('product as p','pd.productid','=','p.id')
            ->select('pd.productid','pd.qty','pd.rate','pd.total_amt','p.product_title','pd.checkout_masterid')->where('checkout_masterid',$checkout_id)->get();
            foreach ($details as $d => $det) {
                $email_details .= "<div
                style='display: flex;align-items: center;justify-content: space-between; padding:10px 0'
                >
                <div style='text-align: left;'>
                <p style='font-size: 15px;line-height: 1.3;'>
                $det->product_title<br />
                QTY: $det->qty
                </p>
                </div> 
                <div style='font-size:16px'>$currency ".number_format($det->total_amt,2)."</div>
                </div>";
            }

            $shipping_address = $this->get_address($data->ship_mun_vdc_id);
            $billing_address = $this->get_address($data->bill_mun_vdc_id);

            $billing_details = "<p style='font-size: 14px;text-align:left;line-height: 1.4;'>$data->bill_fullname</br>
              $data->bill_mobile_no</br>
              $data->bill_str_address, $billing_address  
            </p>";
            $shipping_details = "<p style='font-size: 14px;line-height: 1.4;'>$data->ship_fullname</br>
              $data->ship_mobile_no</br>
              $data->ship_str_address, $shipping_address  
            </p>";

            $parseValues = array(
                'USERNAME' => !empty($data->user_name) ? $data->user_name : $data->guest_name,
                'PAYMENT_METHOD' => $data->payment_name,
                'ORDER_ID' => $data->orderno,
                'ORDER_DATE' => $data->checkout_datead,
                'SUB_TOTAL' => "$currency ".number_format($data->sub_totalamt,2),
                'DISCOUNT' => $data->discount_amt,
                'SHIPPING_COST' => $data->shipping_amt,
                'GRAND_TOTAL' => "$currency ".number_format($data->grand_totalamt, 2),
                'PAYMENT_STATUS' => '',
                'ORDER_DETAILS' => $email_details,
                'BILLING_DETAILS' => $billing_details,
                'SHIPPING_DETAILS' => $shipping_details,
            );
            $mail_message = sendMail($parseValues,"product_order",$emailAddress,$print);
            if($print == 'Y'){
                return response()->json(['status'=>'success','template'=>$mail_message]);
            }
            // dd($parseValues,$emailAddress,$mail_message );
            return $mail_message;
        }
    }

    public function get_address($id)
    {
        $data = DB::table('state as p')
        ->leftJoin('districts as d','d.states_id','=','p.id')
        ->leftjoin('vdc as v','v.dist_id','=','d.districtid')
        ->select('p.stat_name','d.districtnamenp','v.vdc_namenp')
        ->where('v.id',$id)
        ->get();
        if(!empty($data[0])){
            $new_data = $data[0]->vdc_namenp .",". $data[0]->districtnamenp;
           return $new_data;
        }else{
           return '';
        }
    }
}
