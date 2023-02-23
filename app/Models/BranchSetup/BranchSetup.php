<?php

namespace App\Models\BranchSetup;

use Illuminate\Database\Eloquent\Model;

class BranchSetup extends Model
{
    protected $table = 'branch_setup';
    protected $guarded = [];

    public static function get_list()
    {
        $get = $_GET;
        $branch_name=$_GET['branch_name'];
        $is_active=$_GET['is_active'];
       
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }
        
        $limit = 20;
        $offset = 0;
        if(!empty($_GET["iDisplayLength"])){
           $limit = $_GET['iDisplayLength'];
           $offset = $_GET["iDisplayStart"];
        }

        $nquery = BranchSetup::select('id','branch_name','branch_address','branch_location','is_active','is_main');
        if(!empty($branch_name))
        {
            $nquery->where('branch_name','like',"%$branch_name%");
        }
        if(!empty($is_active))
        {
            $nquery->where('is_active',$is_active);
        }
       
        if(!empty($get['sSearch_1'])){
            $nquery->where('branch_name','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $nquery->where('branch_location','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $nquery->where('branch_address','like',"%".$get['sSearch_3']."%");
        }
        
        $query =  BranchSetup::select('id','branch_name','branch_address','branch_location','is_active','is_main');
        if(!empty($branch_name))
        {
            $query->where('branch_name','like',"%$branch_name%");
        }
        if(!empty($is_active))
        {
            $query->where('is_active',$is_active);
        }
       
        if(!empty($get['sSearch_1'])){
            $query->where('branch_name','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $query->where('branch_location','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $query->where('branch_address','like',"%".$get['sSearch_3']."%");
        }

        $order_by = '';
        $order = '';
        if($get['sSortDir_0']){
              $order =$get['sSortDir_0'];
          }
          
          if($get['iSortCol_0']==1)
          {
              $order_by='branch_name';
          }
          
          if($get['iSortCol_0']==2)
          {
              $order_by='branch_location';
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
