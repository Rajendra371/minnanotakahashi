<?php

namespace App\Models\Delivery;
use Illuminate\Support\Facades\Input;
use DB;

use Illuminate\Database\Eloquent\Model;

class DeliveryMaster extends Model
{
    protected $table = 'product_ass_deliverymaster';
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
    public static function get_delivery_list()
    {
        $get = $_GET;
        $date_range = $_GET['date_range'];
        $payment_method=$_GET['payment_method'];
        $delivery_status=$_GET['delivery_status'];
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

        $nquery = DB::table('product_ass_deliverymaster as pdm')  
        ->leftJoin('product_checkout_master as cm','pdm.checkout_masterid','=','cm.id')
        ->leftJoin('payment_method as pm','cm.payment_methodid','=','pm.id')
        ->leftJoin('users as usr','cm.customer_id','=','usr.id')
        ->leftJoin('guest_customer as gc','cm.guest_customer_id','=','gc.id')
        ->leftJoin('employee as e','e.id','=','pdm.assign_userid')
        ->select('pdm.*','cm.orderno','cm.ship_str_address','cm.currency','cm.is_delivery_assign','pm.payment_name','usr.username as user_name','usr.email as user_email','usr.contact as usr_mobile','gc.mobile_no as guest_mobile','gc.fullname as guest_name','gc.email as guest_email','e.first_name','e.last_name')
        ->where('cm.status','CO');

        if(!empty($delivery_status)){
            $nquery->where('cm.is_delivered',$delivery_status);
        }
        if($date_range == 'range' )
        { 
            $nquery->where('pdm.postdatead','>=',"$frmDate");
            $nquery->where('pdm.postdatead','<=',"$toDate");
        }else{
            $nquery->where('pdm.postdatead',"$frmDate");
        }
        
        if(!empty($payment_method)){
            $nquery->where('cm.payment_methodid',$payment_method);
        }
      
        if(!empty($order_status)){
            $nquery->where('cm.status',$order_status);
        }
      
       
        if(!empty($get['sSearch_1'])){
            $nquery->where('pdm.postdatead','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $nquery->where('usr.username','like',"%".$get['sSearch_2']."%")
            ->orWhere('gc.fullname','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $nquery->where('usr.contact','like',"%".$get['sSearch_3']."%")
            ->orWhere('gc.mobile_no','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $nquery->where('cm.orderno','like',"%".$get['sSearch_4']."%");
        }
        // if(!empty($get['sSearch_3'])){
        //     $nquery->where('cm.ship_str_address','like',"%".$get['sSearch_3']."%");
        // }
        // if(!empty($get['sSearch_7'])){
        //     $nquery->where('pm.payment_name','like',"%".$get['sSearch_7']."%");
        // }
       
        $query = DB::table('product_ass_deliverymaster as pdm')  
        ->leftJoin('product_checkout_master as cm','pdm.checkout_masterid','=','cm.id')
        ->leftJoin('payment_method as pm','cm.payment_methodid','=','pm.id')
        ->leftJoin('users as usr','cm.customer_id','=','usr.id')
        ->leftJoin('guest_customer as gc','cm.guest_customer_id','=','gc.id')
        ->leftJoin('employee as e','e.id','=','pdm.assign_userid')
        ->select('pdm.*','cm.orderno','cm.ship_str_address','cm.currency','cm.is_delivery_assign','pm.payment_name','usr.username as user_name','usr.email as user_email','usr.contact as usr_mobile','gc.mobile_no as guest_mobile','gc.fullname as guest_name','gc.email as guest_email','e.first_name','e.last_name')
        ->where('cm.status','CO');
       
        if(!empty($delivery_status)){
            $query->where('cm.is_delivered',$delivery_status);
        }
        
        if($date_range == 'range' )
        { 
            $query->where('pdm.postdatead','>=',"$frmDate");
            $query->where('pdm.postdatead','<=',"$toDate");
        }else{
            $query->where('pdm.postdatead',"$frmDate");
        }
        
        if(!empty($payment_method)){
            $query->where('cm.payment_methodid',$payment_method);
        }
        if(!empty($order_status)){
            $query->where('cm.status',$order_status);
        }
        
        if(!empty($get['sSearch_1'])){
            $query->where('pdm.postdatead','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $query->where('usr.username','like',"%".$get['sSearch_2']."%")
            ->orWhere('gc.fullname','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $query->where('usr.contact','like',"%".$get['sSearch_3']."%")
            ->orWhere('gc.mobile_no','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $query->where('cm.orderno','like',"%".$get['sSearch_4']."%");
        }
      
        $order_by = '';
        $order = '';
        if($get['sSortDir_0']){
            $order =$get['sSortDir_0'];
        }
          
        if($get['iSortCol_0']==1)
        {
            $order_by='pdm.postdatead';
        }
        if($get['iSortCol_0']==2)
        {
            $order_by='usr.username';
        }
        if($get['iSortCol_0']==3)
        {
            $order_by='usr.contact';
        }
        if($get['iSortCol_0']==4)
        {
            $order_by='cm.orderno';
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

    public static function get_delivery_status()
    {
        $frmdate= Input::get('frmDate');
        $todate= Input::get('toDate');
        $date_range = Input::get('date_range');
        $payment_method = Input::get('payment_method');
        $delivery_status = Input::get('delivery_status');
       
        $cond ='';
        if(!empty($payment_method)){
            $cond .= ' AND cm.payment_methodid  = "'.$payment_method.'"'  ;  
        }
        if(!empty($delivery_status)){
            $cond .= ' AND cm.is_delivered  = "'.$delivery_status.'"'  ;  
        }
        if($date_range == 'range' )
        { 
            $cond .= ' AND pdm.postdatead >= "'.$frmdate.'"';
            $cond .= ' AND pdm.postdatead <= "'.$todate.'"';
        }else{
            $cond .= ' AND pdm.postdatead = "'.$frmdate.'"';
        }

        $result= DB::select("SELECT SUM(CASE WHEN(cm.is_delivered='Y') THEN 1 ELSE 0 END ) deliveredcnt,
        SUM(CASE WHEN(cm.is_delivered='N') THEN 1 ELSE 0 END ) pendingcnt
        FROM product_checkout_master cm 
        LEFT JOIN product_ass_deliverymaster pdm on pdm.checkout_masterid = cm.id
        WHERE cm.id IS NOT NULL AND cm.status = 'CO' $cond");
        
        return $result;
    }

}
