<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use DB;

class SalesSetupMaster extends Model
{
    protected $table = 'product_sales_master';
    protected $guarded = [];


    public static function get_sales_list_data()
    {
        $get = $_GET;

        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }
        
        $limit = 20;
        $offset = 0;
        if(!empty($_GET["iDisplayLength"])){
           $limit = $_GET['iDisplayLength'];
           $offset = $_GET["iDisplayStart"];
        }

        $nquery = DB::table('product_sales_master as psm')
        ->leftJoin('product_sales_detail as psd', 'psm.id','=','psd.product_sales_masterid')
        ->leftJoin('product as p','p.id','=','psd.product_id')
        ->leftJoin('product_category as pc','pc.id','=','p.category_id')
        ->select('psd.id','p.product_title','pc.category_name','p.image','p.price','psm.discount_percent','psm.start_datead','psm.end_datead')->where('p.is_publish','Y')->where('p.price','<>',NULL);
       
       
        // if(!empty($get['sSearch_1'])){
        //     $nquery->where('p.product_id','like',"%".$get['sSearch_1']."%");
        // }
        // if(!empty($get['sSearch_2'])){
        //     $nquery->where('p.price','like',"%".$get['sSearch_2']."%");
        // }

        $query = DB::table('product_sales_master as psm')
        ->leftJoin('product_sales_detail as psd', 'psm.id','=','psd.product_sales_masterid')
        ->leftJoin('product as p','p.id','=','psd.product_id')
        ->leftJoin('product_category as pc','pc.id','=','p.category_id')
        ->select('psd.id','p.product_title','pc.category_name','p.image','p.price','psm.discount_percent','psm.start_datead','psm.end_datead')->where('p.is_publish','Y')->where('p.price','<>',NULL);
       
       
        // if(!empty($get['sSearch_1'])){
        //     $query->where('p.product_id','like',"%".$get['sSearch_1']."%");
        // }
        // if(!empty($get['sSearch_2'])){
        //     $query->where('p.price','like',"%".$get['sSearch_2']."%");
        // }
       
        $order_by = '';
        $order = '';
        if($get['sSortDir_0']){
            $order =$get['sSortDir_0'];
        }
          
        if($get['iSortCol_0']==1)
        {
            $order_by='p.product_title';
        }
        if($get['iSortCol_0']==2)
        {
            $order_by='p.price';
        }
        if($get['iSortCol_0']==3)
        {
            $order_by='p.image';
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


    public static function get_product_list()
    {
        $get = $_GET;
        $search_txt="";
        // $_GET['search_txt'];
        $category_id=$_GET['category_id'];

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
        ->select('m.id','m.product_code','m.parentid','m.product_title','m.product_description','m.image','m.price','m.discount_amount','m.discount_pc','m.is_publish')
        ->where('m.is_publish','Y');
       

        $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
        if(!empty($search_txt)){
            $nquery->where('m.product_title','like',"%$search_txt%")
            ->orWhere('m.product_code','like',"%$search_txt%")
            ->orWhere('m.product_description','like',"%$search_txt%")
            ->orWhere('m.price','like',"%$search_txt%");
        }

        if(!empty($category_id)){
            $nquery->where('m.parentid','=',$category_id);
        }
       
       
        if(!empty($get['sSearch_1'])){
            $nquery->where('m.product_id','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $nquery->where('m.price','like',"%".$get['sSearch_2']."%");
        }

        $query = \DB::table('product as m')
        ->select('m.id','m.product_code','m.parentid','m.product_title','m.product_description','m.image','m.price','m.discount_amount','m.discount_pc','m.is_publish')
        ->where('m.is_publish','Y');
       

        $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
        if(!empty($search_txt)){
            $query->where('m.product_title','like',"%$search_txt%")
            ->orWhere('m.product_code','like',"%$search_txt%")
            ->orWhere('m.product_description','like',"%$search_txt%")
            ->orWhere('m.price','like',"%$search_txt%");
        }

        if(!empty($category_id)){
            $query->where('m.parentid','=',$category_id);
        }
       
       
        if(!empty($get['sSearch_1'])){
            $query->where('m.product_id','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $query->where('m.price','like',"%".$get['sSearch_2']."%");
        }
       
        $order_by = '';
        $order = '';
        if($get['sSortDir_0']){
            $order =$get['sSortDir_0'];
        }
          
        if($get['iSortCol_0']==1)
        {
            $order_by='m.product_title';
        }
        if($get['iSortCol_0']==2)
        {
            $order_by='m.price';
        }
        if($get['iSortCol_0']==3)
        {
            $order_by='m.image';
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
