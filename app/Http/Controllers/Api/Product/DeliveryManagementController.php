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

class DeliveryManagementController extends Controller
{
    public function delivery_list()
    {
        $data = DeliveryMaster::get_delivery_list();
        $filtereddata = ($data["totalfilteredrecs"]>0?$data["totalfilteredrecs"]:$data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);
 
        $array = array();
        foreach($data as $i=>$row){   
            
            $is_delivered = $row->is_delivered;
            if($is_delivered=='N'){
                $st_style='color:#ff9600';
            } 
            else if($is_delivered=='Y'){
                $st_style='color:#0b920b';
            }
           
            $array[$i]['id'] = $row->id; 
            $array[$i]['date']= $row->postdatead;
            $array[$i]['customer_name'] = !empty($row->user_name) ? $row->user_name : $row->guest_name;
            $array[$i]['mobile_no'] = !empty($row->usr_mobile) ? $row->usr_mobile : $row->guest_mobile ;
            $array[$i]['orderno'] = $row->orderno;
            $array[$i]['total_items'] = $row->product_cnt;
            $array[$i]['payment_method'] = $row->payment_name;
            $array[$i]['currency'] = $row->currency;
            $array[$i]['shipping_address'] = $row->ship_str_address;
            $array[$i]['grand_total'] = number_format($row->product_amt,2);
            $array[$i]['status'] = $row->is_delivered == 'Y' ? 'Delivered' : 'Pending';
            $array[$i]['st_style'] = $st_style;
            $array[$i]['delivery_assign'] = $row->is_delivery_assign == 'Y' ? 'Yes' : 'No';
            // $array[$i]['is_delivered'] = $row->is_delivered;
            $array[$i]['assign_user'] = $row->first_name.' '.$row->last_name;
            $array[$i]['action'] = $row->is_delivery_assign == 'Y' && $is_delivered == 'N' ? 
            "<input type='checkbox' class='deliver_stat_id' name='deliver_id[]' value = $row->id>"
            : '';   

            // $array[$i]['action'] = '
            // <a href="javascript:void(0)" class="view" data-url="/api/product_order/order_view" data-id='.$row->id.' data-targetForm="productcatForm" data-edittype="template"><i class="fa fa-eye"></i></a>  
            // ';            
        }
        
        return response()->json(["recordsFiltered"=>$filtereddata,"recordsTotal"=>$totalrecs ,'data'=>$array]);
    }

    public function assign_user_to_deliver_order(Request $request)
    {
        DB::beginTransaction();
        try{
            $delivery_id=$request->get('ch_id');
            $assign_userid = $request->get('assign_userid');
            if(empty($delivery_id)){
                return response()->json(['status'=>'error','message'=>'No Order Selected, Please Select An Order!!']);
            }
            if(!empty($delivery_id)){
            $result=DeliveryMaster::whereIn('id', $delivery_id)
            ->get();
            
            $postby=auth()->user()->id;
            $locationid=auth()->user()->locationid;
            $orgid=auth()->user()->orgid;
            $postdatead=CURDATE_EN;
            $postdatebs=EngToNepDateConv(CURDATE_EN);
            $postip=get_real_ipaddr();
            $postmac=get_Mac_Address();

            if(!empty($result)){ 
                $delivery_master_assign = array(
                        'assign_userid' => $assign_userid,
                        'assign_datead' => $postdatead,
                        'assign_datebs' => $postdatebs,
                        'assign_time' => date('H:i:s'),
                        'modifyby' => $postby,
                        'modifydatead' => $postdatead,
                        'modifydatebs' => $postdatebs,
                        'modifytime' => date('H:i:s'),
                        'modifyip' => $postip,
                        'modifymac' => $postmac
                    );
                    DeliveryMaster::whereIn('id',$delivery_id)->update($delivery_master_assign);

                    $updateStatusArray=array(
                        'is_delivery_assign'=> 'Y',
                        'modifydatead' => $postdatead,
                        'modifydatebs' => $postdatebs,
                        'modifytime' => date('H:i:s'),
                        'modifyip' => $postip,
                        'modifymac' => $postmac
                    );
                    foreach ($result as $key => $res) {
                        Checkout::where('id',$res->checkout_masterid)->update($updateStatusArray);
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


    public function change_delivery_status_completed(Request $request)
    {
        DB::beginTransaction();
        try{
            $delivery_id=$request->get('del_id');
            if(empty($delivery_id)){
                return response()->json(['status'=>'error','message'=>'No Order Selected, Please Select An Order!!']);
            }
            if(!empty($delivery_id)){
            $result=DeliveryMaster::whereIn('id', $delivery_id)
            ->get();
            
            $postby=auth()->user()->id;
            $locationid=auth()->user()->locationid;
            $orgid=auth()->user()->orgid;
            $postdatead=CURDATE_EN;
            $postdatebs=EngToNepDateConv(CURDATE_EN);
            $postip=get_real_ipaddr();
            $postmac=get_Mac_Address();

            if(!empty($result)){ 
                $delivery_master_assign = array(
                    'is_delivered' => 'Y',
                    'delivered_datead' => $postdatead,
                    'delivered_datebs' => $postdatebs,
                    'delivered_time' => date('H:i:s'),
                    'modifyby' => $postby,
                    'modifydatead' => $postdatead,
                    'modifydatebs' => $postdatebs,
                    'modifytime' => date('H:i:s'),
                    'modifyip' => $postip,
                    'modifymac' => $postmac
                );
                $delivery_detail = array(
                    'is_delivered' => 'Y',
                    'modifyby' => $postby,
                    'modifydatead' => $postdatead,
                    'modifydatebs' => $postdatebs,
                    'modifytime' => date('H:i:s'),
                    'modifyip' => $postip,
                    'modifymac' => $postmac
                );
                DeliveryMaster::whereIn('id',$delivery_id)->update($delivery_master_assign);
                DeliveryDetail::whereIn('product_ass_del_masterid',$delivery_id)->update($delivery_detail); 

                $updateStatusArray=array(
                    'is_delivered'=> 'Y',
                    'modifydatead' => $postdatead,
                    'modifydatebs' => $postdatebs,
                    'modifytime' => date('H:i:s'),
                    'modifyip' => $postip,
                    'modifymac' => $postmac
                );
                foreach ($result as $key => $res) {
                    Checkout::where('id',$res->checkout_masterid)->update($updateStatusArray);
                    CheckoutDetail::where('checkout_masterid',$res->checkout_masterid)->update($updateStatusArray);
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


    public function get_delivery_status(Request $request)
    {
        $summarydata=DeliveryMaster::get_delivery_status();
        $pendingcnt=0;
        $deliveredcnt=0;
       
        if(!empty($summarydata)){
            $pendingcnt=!empty($summarydata[0]->pendingcnt)?$summarydata[0]->pendingcnt:'0';
            $deliveredcnt=!empty($summarydata[0]->deliveredcnt)?$summarydata[0]->deliveredcnt:'0';
            return response()->json(['status'=>'success','message'=>'Data Available','pendingcnt'=>$pendingcnt,'deliveredcnt'=>$deliveredcnt]);

        }else{
            return response()->json(['status'=>'error','message'=>'Data Available','pendingcnt'=>$pendingcnt,'deliveredcnt'=>$deliveredcnt]);
        }
    }

}
