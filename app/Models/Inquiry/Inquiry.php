<?php

namespace App\Models\Inquiry;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'ourproduct_enquiry';
    protected $guarded = [];

    public static function get_inquiry_list()
    {
        $get = $_GET;
        $product=$_GET['product'];
        $filter_date=$_GET['filter_date'];
        $frmDate=$_GET['frmDate'];
        $toDate=$_GET['toDate'];
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }

        $limit = 20;
        $offset = 0;
        if (!empty($_GET["iDisplayLength"])) {
            $limit = $_GET['iDisplayLength'];
            $offset = $_GET["iDisplayStart"];
        }

        $nquery = DB::table('ourproduct_enquiry as i')
            ->select('i.id');

            if(!empty($product))
            {
                $nquery->where('product_name','=',$product);
            }

            if(!empty($filter_date))
            {
                if($filter_date=='range'){
    
                    $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
                    // if($defaultpicker=='NP'){
                        if(!empty($frmDate) && !empty($toDate)){
                        $nquery->where('postdatead','>=',"$frmDate");
                        $nquery->where('postdatead','<=',"$toDate");
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
            if (!empty($search_text)) {
                $nquery->where(function ($nqry) use ($search_text) {
                    $nqry->where('c.fullname', 'like', "%$search_text%")
                        ->orWhere('c.company_name', 'like', "%$search_text%")
                        ->orWhere('c.email', 'like', "%$search_text%")
                        ->orWhere('c.mobile_no', 'like', "%$search_text%")
                        ->orWhere('c.product_name', 'like', "%$search_text%")
                        ->orWhere('c.subject', 'like', "%$search_text%");
                });
            }

        if (!empty($get['sSearch_1'])) {
            $nquery->where('i.fullname', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('i.company_name', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('i.email', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $nquery->where('i.mobile_no', 'like', "%" . $get['sSearch_4'] . "%");
        }
        if (!empty($get['sSearch_5'])) {
            $nquery->where('i.product_name', 'like', "%" . $get['sSearch_5'] . "%");
        }
        if (!empty($get['sSearch_6'])) {
            $nquery->where('i.subject', 'like', "%" . $get['sSearch_6'] . "%");
        }
        if (!empty($get['sSearch_7'])) {
            $nquery->where('i.message', 'like', "%" . $get['sSearch_7'] . "%");
        }

        $query = DB::table('ourproduct_enquiry as i')
            ->select('i.id', 'i.fullname', 'i.company_name', 'i.email','i.mobile_no', 'i.product_name', 'i.subject', 'i.message', 'i.postdatead', 'i.posttime');
        if(!empty($product))
        {
            $query->where('product_name','=',$product);
        }
        if(!empty($filter_date))
        {
            if($filter_date=='range'){
                $defaultpicker=get_constant_value('DEFAULT_DATEPICKER');
                //  if($defaultpicker=='NP'){
                    if(!empty($frmDate) && !empty($toDate)){
                    $query->where('postdatead','>=',"$frmDate");
                    $query->where('postdatead','<=',"$toDate");
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
        if (!empty($search_text)) {
            $query->where(function ($nqry) use ($search_text) {
                $nqry->where('c.fullname', 'like', "%$search_text%")
                    ->orWhere('c.company_name', 'like', "%$search_text%")
                    ->orWhere('c.email', 'like', "%$search_text%")
                    ->orWhere('c.mobile_no', 'like', "%$search_text%")
                    ->orWhere('c.product_name', 'like', "%$search_text%")
                    ->orWhere('c.subject', 'like', "%$search_text%");
            });
        }
        if (!empty($get['sSearch_1'])) {
            $query->where('i.fullname', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $query->where('i.company_name', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $query->where('i.email', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $query->where('i.mobile_no', 'like', "%" . $get['sSearch_4'] . "%");
        }
        if (!empty($get['sSearch_5'])) {
            $query->where('i.product_name', 'like', "%" . $get['sSearch_5'] . "%");
        }
        if (!empty($get['sSearch_6'])) {
            $query->where('i.subject', 'like', "%" . $get['sSearch_6'] . "%");
        }
        if (!empty($get['sSearch_7'])) {
            $query->where('i.message', 'like', "%" . $get['sSearch_7'] . "%");
        }
        $order_by = 'i.id';
        $order = 'DESC';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'i.fullname';
        }
        if ($get['iSortCol_0'] == 2) {
            $order_by = 'i.company_name';
        }

        if ($get['iSortCol_0'] == 3) {
            $order_by = 'i.email';
        }

        if ($get['iSortCol_0'] == 4) {
            $order_by = 'mobile_no';
        }

        if ($order && $order_by) {
            $query->orderBy($order_by, $order);
        }

        if (!empty($offset)) {
            $query->offset($offset);
        }

        if ($limit) {
            $query->limit($limit);
        }

        $data = $query->get();

        $count = $nquery->count();

        $no_of_pages = ceil($count / $limit);

        if ($count > 0) {
            $ndata = $data;
            $ndata['totalrecs'] = $count;
            $ndata['totalfilteredrecs'] = $count;
        } else {
            $ndata = array();
            $ndata['totalrecs'] = 0;
            $ndata['totalfilteredrecs'] = 0;
        }
        return $ndata;
    }
}
