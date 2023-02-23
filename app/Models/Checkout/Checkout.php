<?php

namespace App\Models\Checkout;
use Illuminate\Support\Facades\Input;
use DB;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $table = 'product_checkout_master';
    protected $guarded = [];

    protected $hidden = [
        'postdatead',
        'postdatebs',
        'posttime',
        'postip',
        'postmac',
        'modifyby',
        'modifydatead',
        'modifydatebs',
        'modifytime',
        'modifyip',
        'modifymac',
        'created_at',
        'updated_at',
    ];  

    public static function get_checkout_data_for_email($master_id)
    {
        $data = DB::table('product_checkout_master as cm')
        ->leftJoin('payment_method as pm','cm.payment_methodid','=','pm.id')
        ->leftJoin('users as usr','cm.customer_id','=','usr.id')
        ->leftJoin('guest_customer as gc','cm.guest_customer_id','=','gc.id')
        ->where('cm.id',$master_id)
        ->select('cm.*','pm.payment_name','usr.username as user_name','usr.email as user_email','gc.fullname as guest_name','gc.email as guest_email')
        ->get();
        if($data){
            return $data;
        }
        return false;
    }

    public static function get_order_list($delivery = false)
    {
        $get = $_GET;
        $date_range = $_GET['date_range'];
        $payment_method=$_GET['payment_method'];
        $delivery_status = '';
        $order_status = '';
        // if($delivery == 'Y'){
        //     $delivery_status=$_GET['delivery_status'];
        // }else{
            $order_status=$_GET['order_status'];
        // }
        $frmDate=$_GET['frmDate'];
        $toDate=$_GET['toDate'];
       
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }
        
        $limit = 20;
        $offset = 0;
        if(!empty($_GET["iDisplayLength"])){
           $limit = $_GET['iDisplayLength'];
           $offset = $_GET["iDisplayStart"];
        }

        $nquery =  DB::table('product_checkout_master as cm')
        ->leftJoin('payment_method as pm','cm.payment_methodid','=','pm.id')
        ->leftJoin('users as usr','cm.customer_id','=','usr.id')
        ->leftJoin('guest_customer as gc','cm.guest_customer_id','=','gc.id')
        ->select('cm.*','pm.payment_name','usr.username as user_name','usr.email as user_email','usr.contact as usr_mobile','gc.mobile_no as guest_mobile','gc.fullname as guest_name','gc.email as guest_email', DB::raw("
        CASE
        WHEN cm.status = 'O' THEN 'Ordered'
        WHEN cm.status= 'CO' THEN 'Order Confirmed'
        ELSE 'Cancelled'
        END AS order_status
        "));

        // if($delivery == 'Y'){
        //     $nquery->where('cm.status','CO');
        //     if(!empty($delivery_status)){
        //         $nquery->where('cm.is_delivered',$delivery_status);
        //     }
        // }
      
        if($date_range == 'range' )
        { 
            $nquery->where('cm.checkout_datead','>=',"$frmDate");
            $nquery->where('cm.checkout_datead','<=',"$toDate");
        }else{
            $nquery->where('cm.checkout_datead',"$frmDate");
        }
        
        if(!empty($payment_method)){
            $nquery->where('cm.payment_methodid',$payment_method);
        }
      
        if(!empty($order_status)){
            $nquery->where('cm.status',$order_status);
        }
      
       
        if(!empty($get['sSearch_1'])){
            $nquery->where('cm.checkout_datead','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $nquery->where('usr.username','like',"%".$get['sSearch_2']."%")
            ->orWhere('gc.fullname','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $nquery->where('cm.ship_str_address','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $nquery->where('usr.contact','like',"%".$get['sSearch_4']."%")
            ->orWhere('gc.mobile_no','like',"%".$get['sSearch_4']."%");
        }
        if(!empty($get['sSearch_5'])){
            $nquery->where('cm.orderno','like',"%".$get['sSearch_5']."%");
        }
        if(!empty($get['sSearch_7'])){
            $nquery->where('pm.payment_name','like',"%".$get['sSearch_7']."%");
        }
       
        $query = DB::table('product_checkout_master as cm')
        ->leftJoin('payment_method as pm','cm.payment_methodid','=','pm.id')
        ->leftJoin('users as usr','cm.customer_id','=','usr.id')
        ->leftJoin('guest_customer as gc','cm.guest_customer_id','=','gc.id')
        ->select('cm.*','pm.payment_name','usr.username as user_name','usr.email as user_email','usr.contact as usr_mobile','gc.fullname as guest_name','gc.mobile_no as guest_mobile','gc.email as guest_email',DB::raw("
        CASE
        WHEN cm.status = 'O' THEN 'Ordered'
        WHEN cm.status= 'CO' THEN 'Order Confirmed'
        ELSE 'Cancelled'
        END AS order_status
        "));
        // if($delivery == 'Y'){
        //     $query->where('cm.status','CO');
        //     if(!empty($delivery_status)){
        //         $query->where('cm.is_delivered',$delivery_status);
        //     }
        // }
       
        if($date_range == 'range' )
        { 
            $query->where('cm.checkout_datead','>=',"$frmDate");
            $query->where('cm.checkout_datead','<=',"$toDate");
        }else{
            $query->where('cm.checkout_datead',"$frmDate");
        }
        
        if(!empty($payment_method)){
            $query->where('cm.payment_methodid',$payment_method);
        }
        if(!empty($order_status)){
            $query->where('cm.status',$order_status);
        }
        
        if(!empty($get['sSearch_1'])){
            $query->where('cm.checkout_datead','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $query->where('usr.username','like',"%".$get['sSearch_2']."%")
            ->orWhere('gc.fullname','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $query->where('cm.ship_str_address','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $query->where('usr.contact','like',"%".$get['sSearch_4']."%")
            ->orWhere('gc.mobile_no','like',"%".$get['sSearch_4']."%");
        }
        if(!empty($get['sSearch_5'])){
            $query->where('cm.orderno','like',"%".$get['sSearch_5']."%");
        }
        if(!empty($get['sSearch_7'])){
            $query->where('pm.payment_name','like',"%".$get['sSearch_7']."%");
        }
      
        $order_by = '';
        $order = '';
        if($get['sSortDir_0']){
            $order =$get['sSortDir_0'];
        }
          
        if($get['iSortCol_0']==1)
        {
            $order_by='cm.checkout_datead';
        }
        if($get['iSortCol_0']==2)
        {
            $order_by='usr.username';
        }
        if($get['iSortCol_0']==3)
        {
            $order_by='cm.ship_str_address';
        }
        if($get['iSortCol_0']==4)
        {
            $order_by='usr.contact';
        }
        if($get['iSortCol_0']==5)
        {
            $order_by='cm.orderno';
        }
        if($get['iSortCol_0']==8)
        {
            $order_by='cm.grand_totalamt';
        }
        if($get['iSortCol_0']==9)
        {
            $order_by='cm.status';
        }
        if(!empty($order) && !empty($order_by)){
            $query->orderBy($order_by,$order);
        }
          
        if(!empty($offset)){
            $query->offset($offset);
        }

        if($limit){
            $query->limit($limit);
        }
    
        $data = $query->orderBy('cm.checkout_datead','DESC')->get();

       
        $count = $nquery->count();

        $no_of_pages = ceil($count/$limit);
       
        if($count>0){
        $ndata=$data;
        $ndata['totalrecs'] = $count;
        $ndata['totalfilteredrecs'] = $count;
        } 
        else
        {
            $ndata=array();
            $ndata['totalrecs'] = 0;
            $ndata['totalfilteredrecs'] = 0;
        }
        return $ndata;
    }


    public static function get_order_status()
    {
        $frmdate= Input::get('frmDate');
        $todate= Input::get('toDate');
        $date_range = Input::get('date_range');
        $payment_method = Input::get('payment_method');
        $order_status = Input::get('order_status');
       
        $cond ='';
        if(!empty($payment_method)){
            $cond .= ' AND cm.payment_methodid  = "'.$payment_method.'"'  ;  
        }
        if(!empty($order_status)){
            $cond .= ' AND cm.status  = "'.$order_status.'"'  ;  
        }
        if($date_range == 'range' )
        { 
            $cond .= ' AND cm.checkout_datead >= "'.$frmdate.'"';
            $cond .= ' AND cm.checkout_datead <= "'.$todate.'"';
        }else{
            $cond .= ' AND cm.checkout_datead = "'.$frmdate.'"';
        }

        $result= DB::select("SELECT SUM(CASE WHEN(cm.status='O') THEN 1 ELSE 0 END ) orderedcnt,
        SUM(CASE WHEN(cm.status='CO') THEN 1 ELSE 0 END ) confirmedcnt,
        SUM(CASE WHEN(cm.status='C') THEN 1 ELSE 0 END ) cancelledcnt
        FROM product_checkout_master cm 
        WHERE cm.id IS NOT NULL $cond");
        
        return $result;
    }

}
