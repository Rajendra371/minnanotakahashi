<?php

namespace App\Models\Gallery;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class GalleryCategory extends Model
{
    protected $table = 'gallery_categories';
    protected $guarded = [];

    public static function get_gallerycategory_list()
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

        $nquery = DB::table('gallery_categories as ecl')
            // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
            ->select('*');

        $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('title', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('content', 'like', "%" . $get['sSearch_2'] . "%");
        }




        $query = DB::table('gallery_categories as ecl')
            // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
            ->select('*');

        if (!empty($get['sSearch_1'])) {
            $query->where('title', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $query->where('content', 'like', "%" . $get['sSearch_2'] . "%");
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