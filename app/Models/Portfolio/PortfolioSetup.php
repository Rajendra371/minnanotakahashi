<?php

namespace App\Models\Portfolio;

use Illuminate\Database\Eloquent\Model;
use DB;

class PortfolioSetup extends Model
{
     protected $table = 'portfolio';
     protected $fillable = ['id'];
    // protected $guarded = [];

  

    public static function get_portfolio_list(){
        $get = $_GET;
        $Name=$_GET['Name'];
        $portfolio=$_GET['portfolio'];
       
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }
        
        $limit = 20;
        $offset = 0;
        if(!empty($_GET["iDisplayLength"])){
           $limit = $_GET['iDisplayLength'];
           $offset = $_GET["iDisplayStart"];
        }

        $nquery = \DB::table('portfolio as ecl')
       ->leftjoin('portfolio_category as e','e.id','=','ecl.portfolio_categoryid')
        ->select('ecl.id','ecl.portfolio_categoryid','ecl.name','ecl.website','ecl.content','ecl.image','ecl.startdate','ecl.order','ecl.is_publish','ecl.enddate','ecl.meta_title','ecl.meta_keyword','ecl.meta_description','e.category_name');

        if(!empty($Name)){
            $nquery->where('ecl.name','=',$Name);      
          }
          if(!empty($portfolio)){
            $nquery->where('ecl.portfolio_categoryid','=',$portfolio);      
          }

        $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
       
        if(!empty($get['sSearch_1'])){
            $nquery->where('e.category_name','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $nquery->where('ecl.name','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $nquery->where('ecl.content','like',"%".$get['sSearch_3']."%");
        }
        
        if(!empty($get['sSearch_4'])){
            $nquery->where('ecl.website','like',"%".$get['sSearch_4']."%");
        }
      

    

        $query = \DB::table('portfolio as ecl')
        ->leftjoin('portfolio_category as e','e.id','=','ecl.portfolio_categoryid')
         ->select('ecl.id','ecl.portfolio_categoryid','ecl.name','ecl.website','ecl.content','ecl.image','ecl.startdate','ecl.order','ecl.is_publish','ecl.enddate','ecl.meta_title','ecl.meta_keyword','ecl.meta_description','e.category_name');

         if(!empty($Name)){
            $query->where('ecl.name','=',$Name);      
          }
          if(!empty($portfolio)){
            $query->where('ecl.portfolio_categoryid','=',$portfolio);      
          }
 
        
         if(!empty($get['sSearch_1'])){
            $query->where('e.category_name','like',"%".$get['sSearch_1']."%");
        }
        if(!empty($get['sSearch_2'])){
            $query->where('ecl.name','like',"%".$get['sSearch_2']."%");
        }
        if(!empty($get['sSearch_3'])){
            $query->where('ecl.content','like',"%".$get['sSearch_3']."%");
        }
        
        if(!empty($get['sSearch_4'])){
            $query->where('ecl.website','like',"%".$get['sSearch_4']."%");
        }

        $order_by = '';
        $order = '';
        if($get['sSortDir_0']){
              $order =$get['sSortDir_0'];
          }
          
          if($get['iSortCol_0']==1)
          {
              $order_by='ecl.id';
          }
          
          if($get['iSortCol_0']==2)
          {
              $order_by='ecl.id';
          }
       
        

         // $query->orderBy($order_by,$order);
            if(!empty($offset)){
                $query->offset($offset);
            }

            if($limit){
                $query->limit($limit);
            }
    
        $data = $query->get();

       
        // $all_filtered_data = $nquery->get();
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

    public static function get_all_portfoliosetup_data($id=false){
        $data=DB::table('portfolio as ecl')
        ->leftjoin('portfolio_category as e','e.id','=','ecl.portfolio_categoryid')
        ->select('ecl.*','e.category_name')
        ->where('ecl.id',$id)
        ->first();
        return $data;
    }


   
}