<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Model;
use DB;

class FaqCategory extends Model
{
    protected $table = 'faq_category';
    protected $guarded = [];

    public function faqs()
    {
        return $this->hasMany('App\Models\Faq\FaqSetup', 'faq_categoryid');
    }

    public static function get_faqcategory_list()
    {
        $get = $_GET;

        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }

        $limit = 20;
        $offset = 0;
        if (!empty($_GET["iDisplayLength"])) {
            $limit = $_GET['iDisplayLength'];
            $offset = $_GET["iDisplayStart"];
        }

        $nquery = \DB::table('faq_category as ecl')
            // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
            ->select('*');

        $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('category_name', 'like', "%" . $get['sSearch_1'] . "%");
        }




        $query = \DB::table('faq_category as ecl')
            // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
            ->select('*');

        if (!empty($get['sSearch_1'])) {
            $query->where('category_name', 'like', "%" . $get['sSearch_1'] . "%");
        }


        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'id';
        }

        if ($get['iSortCol_0'] == 2) {
            $order_by = 'id';
        }



        // $query->orderBy($order_by,$order);
        if (!empty($offset)) {
            $query->offset($offset);
        }

        if ($limit) {
            $query->limit($limit);
        }

        $data = $query->get();


        // $all_filtered_data = $nquery->get();
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