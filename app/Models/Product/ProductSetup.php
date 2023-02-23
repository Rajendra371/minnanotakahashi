<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use DB;

class ProductSetup extends Model
{
     protected $table = 'product';
    //  protected $fillable = ['id'];
    protected $guarded = [];

    public static function get_productsetup_list(){
        $get = $_GET;
        // $filter_date=$_GET['filter_date'];
       
        // $frmDate=$_GET['frmDate'];
        
        // $toDate=$_GET['toDate'];
        $search_txt=$_GET['search_txt'];
        // print_r($product);
        // die();
        $category=$_GET['category'];
        // print_r($category);
        // die();
        
       
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }
        
        $limit = 20;
        $offset = 0;
        if(!empty($_GET["iDisplayLength"])){
           $limit = $_GET['iDisplayLength'];
           $offset = $_GET["iDisplayStart"];
        }

        $nquery = \DB::table('product as m')
        ->leftJoin('product_category as s', 's.id', '=', 'm.parentid')
        ->leftJoin('product_views_count as pc','pc.product_id','=','m.id')
        ->leftJoin('product_checkout_detail as pcd','pcd.productid','=','m.id')
        ->select('m.id','m.product_code','m.parentid','m.product_title','m.product_description','m.image','m.price','m.discount_amount','m.discount_pc','m.is_publish','s.category_name','pc.view_count',
        DB::raw("fn_product_params_count(m.id) as count_params"),'m.product_id');
       

        $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
        if(!empty($search_txt)){
            $nquery->where('m.product_title','like',"%$search_txt%")
            ->orWhere('m.product_code','like',"%$search_txt%")
            ->orWhere('m.product_description','like',"%$search_txt%")
            ->orWhere('m.price','like',"%$search_txt%");
        }

        if(!empty($category)){
            $nquery->where('m.parentid','=',$category);
        }
       
        if(!empty($get['sSearch_1'])){
            $nquery->where('s.category_name','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $nquery->where('m.product_id','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $nquery->where('m.product_code','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $nquery->where('m.product_title','like',"%".$get['sSearch_4']."%");
        }
        if(!empty($get['sSearch_6'])){
            $nquery->where('m.product_description','like',"%".$get['sSearch_6']."%");
        }
      


        $query =\DB::table('product as m')
        ->leftJoin('product_category as s', 's.id', '=', 'm.parentid')
        ->leftJoin('product_views_count as pc','pc.product_id','=','m.id')
        ->leftJoin('product_checkout_detail as pcd','pcd.productid','=','m.id')
        ->select('m.id','m.product_code','m.parentid','m.product_title','m.product_description','m.image','m.price','m.discount_amount','m.discount_pc','m.is_publish','s.category_name','pc.view_count',
        DB::raw("fn_product_params_count(m.id) as count_params"),'m.product_id');
       
        if(!empty($search_txt)){
            $query->where('m.product_title','like',"%$search_txt%")
            ->orWhere('m.product_code','like',"%$search_txt%")
            ->orWhere('m.product_description','like',"%$search_txt%")
            ->orWhere('m.price','like',"%$search_txt%");
        }
        if(!empty($category)){
            $query->where('m.parentid','=',$category);
        }
        
        if(!empty($get['sSearch_1'])){
            $query->where('s.category_name','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $query->where('m.product_id','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $query->where('m.product_code','like',"%".$get['sSearch_3']."%");
        }
        if(!empty($get['sSearch_4'])){
            $query->where('m.product_title','like',"%".$get['sSearch_4']."%");
        }
        if(!empty($get['sSearch_6'])){
            $query->where('m.product_description','like',"%".$get['sSearch_6']."%");
        }
       
        $order_by = '';
        $order = '';
        if($get['sSortDir_0']){
            $order =$get['sSortDir_0'];
        }
          
        if($get['iSortCol_0']==1)
        {
            $order_by='m.id';
        }
        if($get['iSortCol_0']==2)
        {
            $order_by='m.product_id';
        }
        if($get['iSortCol_0']==3)
        {
            $order_by='m.product_code';
        }
        if($get['iSortCol_0']==4)
        {
            $order_by='m.product_title';
        }
        if($get['iSortCol_0']==6)
        {
            $order_by='m.product_description';
        }
        if($get['iSortCol_0']==7)
        {
            $order_by='m.price';
        }
        if(!empty($order_by)){
            $query->orderBy($order_by,$order);
        }
      
        if(!empty($offset)){
            $query->offset($offset);
        }

        if($limit){
            $query->limit($limit);
        }
    
        $data = $query->get();

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


   
}