<?php
namespace App\Models\Advertisement;

use Illuminate\Database\Eloquent\Model;
use DB;

class Advertisement extends Model
{
     protected $table = 'advertisement';
     protected $fillable = ['id'];
    // protected $guarded = [];

  

    public static function get_advertisement_list(){
        $get = $_GET;
        $page_menu=$_GET['page_menu'];
        $filter_date=$_GET['filter_date'];
       
        $frmDate=$_GET['frmDate'];
        
        $toDate=$_GET['toDate'];
        // print_r($toDate);
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

        $nquery = \DB::table('advertisement as ecl')
         ->leftjoin('advertisement_location as e','e.id','=','ecl.ad_locationid')
         ->leftjoin('menu as m','m.id','=','ecl.ad_page_id')
        
        ->select('ecl.ad_page_id','ecl.ad_locationid','ecl.content','ecl.startdate','ecl.enddate','ecl.order','ecl.is_publish','ecl.is_unlimited','ecl.id','e.location_name','m.menu_name');
        if(!empty($page_menu)){
            $nquery->where('ecl.ad_page_id','=',$page_menu);
        }
        if(!empty($filter_date))
        {
            if($filter_date=='range'){

                $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
                // if($defaultpicker=='NP'){
                    if(!empty($frmDate) && !empty($toDate)){
                    $nquery->where('ecl.startdate','>=',"$frmDate");
                    $nquery->where('ecl.enddate','<=',"$toDate");
                    }
                // }
                // else
                // {
                //     if(!empty($frmDate) && !empty($toDate)){
                //         $nquery->where('ecl.startdate','>=',$frmDate);
                //         $nquery->where('ecl.enddate','<=',$toDate);
                //         }
                // }
            }
        }
        

       // $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
       
        if(!empty($get['sSearch_1'])){
            $nquery->where('e.location_name','like',"%".$get['sSearch_1']."%");
        }

       
          if(!empty($get['sSearch_2'])){
              $nquery->where('ecl.startdate','like',"%".$get['sSearch_2']."%");
            }
       

      
          if(!empty($get['sSearch_3'])){
              $nquery->where('ecl.enddate','like',"%".$get['sSearch_3']."%");
            }
       
        
        if(!empty($get['sSearch_4'])){
            $nquery->where('ecl.content','like',"%".$get['sSearch_4']."%");
        }

        $query = \DB::table('advertisement as ecl')
         ->leftjoin('advertisement_location as e','e.id','=','ecl.ad_locationid')
         ->leftjoin('menu as m','m.id','=','ecl.ad_page_id')
         ->select('ecl.id','ecl.ad_page_id','ecl.ad_locationid','ecl.content','ecl.startdate','ecl.enddate','ecl.order','ecl.is_publish','ecl.is_unlimited','e.location_name','m.menu_name');

        if(!empty($page_menu)){
            $query->where('ecl.ad_page_id','=',$page_menu);
        }
        

         if(!empty($filter_date))
         {
             if($filter_date=='range'){
                 $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
                //  if($defaultpicker=='NP'){
                     if(!empty($frmDate) && !empty($toDate)){
                     $query->where('ecl.startdate','>=',"$frmDate");
                     $query->where('ecl.enddate','<=',"$toDate");
                     }
                //  }
                //  else
                //  {
                //      if(!empty($frmDate) && !empty($toDate)){
                //          $nquery->where('ecl.startdate','>=',$frmDate);
                //          $nquery->where('ecl.enddate','<=',$toDate);
                //          }
                //  }
             }
         }
        
        if(!empty($get['sSearch_1'])){
            $query->where('e.location_name','like',"%".$get['sSearch_1']."%");
        }

        
          if(!empty($get['sSearch_2'])){
              $query->where('ecl.startdate','like',"%".$get['sSearch_2']."%");
            }
     
          if(!empty($get['sSearch_3'])){
              $query->where('ecl.enddate','like',"%".$get['sSearch_3']."%");
            }
       
         
        
        if(!empty($get['sSearch_4'])){
            $query->where('ecl.content','like',"%".$get['sSearch_4']."%");
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
              $order_by='ecl.order';
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

    public static function get_all_advertisement_data($id=false){
        $data=DB::table('advertisement as adv')
        ->leftjoin('advertisement_location as adl','adl.id','=','adv.ad_locationid')
        ->leftjoin('menu as me','me.id','=','adv.ad_page_id')
        ->select('adv.*','adl.location_name','me.menu_name')
        ->where('adv.id',$id)
        ->first();
        return $data;
    }


   
}