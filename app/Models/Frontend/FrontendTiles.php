<?php

namespace App\Models\Frontend;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class FrontendTiles extends Model
{
    protected $table = 'frontend_tiles';
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

        $nquery = DB::table('frontend_tiles as sd')
            ->select('sd.id', 'sd.title', 'sd.icon', 'sd.content', 'sd.image', 'sd.is_publish', 'sd.for_header', 'sd.for_footer', 'sd.for_body');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('sd.title', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('sd.icon', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $nquery->where('sd.content', 'like', "%" . $get['sSearch_4'] . "%");
        }

        $query = DB::table('frontend_tiles as sd')
            ->select('sd.id', 'sd.title', 'sd.icon', 'sd.content', 'sd.image', 'sd.is_publish', 'sd.for_header', 'sd.for_footer', 'sd.for_body');

        if (!empty($get['sSearch_1'])) {
            $query->where('sd.title', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $query->where('sd.icon', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $query->where('sd.content', 'like', "%" . $get['sSearch_4'] . "%");
        }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'sd.title';
        }

        if ($get['iSortCol_0'] == 3) {
            $order_by = 'sd.icon';
        }

        if ($get['iSortCol_0'] == 4) {
            $order_by = 'sd.content';
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
