<?php

namespace App\Models\AssociatedCollege;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class AssociatedCollege extends Model
{
    protected $table = 'associated_college';
    protected $guarded = [];

    public static function get_list()
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

        $nquery = DB::table('associated_college as sd')
            ->select('sd.id', 'sd.college_name', 'sd.image', 'sd.is_publish', 'sd.college_url');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('sd.college_name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('sd.college_url', 'like', "%" . $get['sSearch_3'] . "%");
        }

        $query = DB::table('associated_college as sd')
            ->select('sd.id', 'sd.college_name', 'sd.image', 'sd.is_publish', 'sd.college_url');

        if (!empty($get['sSearch_1'])) {
            $query->where('sd.college_name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $query->where('sd.college_url', 'like', "%" . $get['sSearch_3'] . "%");
        }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'sd.college_name';
        }

        if ($get['iSortCol_0'] == 3) {
            $order_by = 'sd.college_url';
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
