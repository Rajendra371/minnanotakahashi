<?php

namespace App\Models\State;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'state';
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

        $nquery = DB::table('state as s')
            ->select('s.id', 's.name', 's.code', 's.isactive');

        $query = DB::table('state as s')
            ->select('s.id', 's.name', 's.code', 's.isactive');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('s.code', 'like', "%" . $get['sSearch_1'] . "%");
            $query->where('s.code', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('s.name', 'like', "%" . $get['sSearch_2'] . "%");
            $query->where('s.name', 'like', "%" . $get['sSearch_2'] . "%");
        }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'code';
        }

        if ($get['iSortCol_0'] == 2) {
            $order_by = 'name';
        }

        if (!empty($order_by) && !empty($order)) {
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