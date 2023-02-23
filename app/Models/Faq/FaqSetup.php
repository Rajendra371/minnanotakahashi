<?php

namespace App\Models\Faq;

use Illuminate\Database\Eloquent\Model;
use DB;

class FaqSetup extends Model
{
    protected $table = 'faq';
    protected $guarded = [];



    public static function get_faqsetup_list()
    {
        $faq_cat = $_GET['faq_cat'];
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

        $nquery = \DB::table('faq as ecl')
            ->leftjoin('faq_category as e', 'e.id', '=', 'ecl.faq_categoryid')
            ->select('ecl.title', 'ecl.id', 'ecl.order', 'ecl.description', 'ecl.faq_categoryid', 'e.category_name', 'ecl.is_publish');

        if (!empty($faq_cat)) {
            $nquery->where('ecl.faq_categoryid', '=', $faq_cat);
        }

        $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('e.category_name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('ecl.title', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('ecl.description', 'like', "%" . $get['sSearch_3'] . "%");
        }





        $query = \DB::table('faq as ecl')
            ->leftjoin('faq_category as e', 'e.id', '=', 'ecl.faq_categoryid')
            ->select('ecl.title', 'ecl.order', 'ecl.id', 'ecl.description', 'ecl.faq_categoryid', 'e.category_name', 'ecl.is_publish');

        if (!empty($faq_cat)) {
            $query->where('ecl.faq_categoryid', '=', $faq_cat);
        }

        if (!empty($get['sSearch_1'])) {
            $query->where('e.category_name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $query->where('ecl.title', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $query->where('ecl.description', 'like', "%" . $get['sSearch_3'] . "%");
        }


        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'ecl.id';
        }

        if ($get['iSortCol_0'] == 2) {
            $order_by = 'ecl.id';
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

    public static function get_all_faqsetup_data($id = false)
    {
        $data = DB::table('faq as ecl')
            ->leftjoin('faq_category as e', 'e.id', '=', 'ecl.faq_categoryid')
            ->select('ecl.*', 'e.category_name')
            ->where('ecl.id', $id)
            ->first();
        return $data;
    }
}