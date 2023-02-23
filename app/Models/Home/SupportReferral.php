<?php

namespace App\Models\Home;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class SupportReferral extends Model
{
    protected $table = 'support_referral';
    protected $guarded = [];

    public static function support_list()
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

        $nquery = DB::table('support_referral as sr')->select('sr.id');

        $query = DB::table('support_referral as sr')->select('sr.id', 'sr.type', 'sr.status', 'sr.full_name', 'sr.contact_number', 'sr.email', 'sr.subject', 'sr.state_id', 'sr.suburb', 'sr.message', 'sr.postdatead');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('sr.full_name', 'like', "%" . $get['sSearch_1'] . "%");
            $query->where('sr.full_name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('sr.type', 'like', "%" . $get['sSearch_2'] . "%");
            $query->where('sr.type', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('sr.email', 'like', "%" . $get['sSearch_3'] . "%");
            $query->where('sr.email', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $nquery->where('sr.contact_number', 'like', "%" . $get['sSearch_4'] . "%");
            $query->where('sr.contact_number', 'like', "%" . $get['sSearch_4'] . "%");
        }
        if (!empty($get['sSearch_5'])) {
            $nquery->where('sr.subject', 'like', "%" . $get['sSearch_5'] . "%");
            $query->where('sr.subject', 'like', "%" . $get['sSearch_5'] . "%");
        }
        if (!empty($get['sSearch_6'])) {
            $nquery->where('sr.message', 'like', "%" . $get['sSearch_6'] . "%");
            $query->where('sr.message', 'like', "%" . $get['sSearch_6'] . "%");
        }
        if (!empty($get['sSearch_8'])) {
            $nquery->where('sr.postdatead', 'like', "%" . $get['sSearch_8'] . "%");
            $query->where('sr.postdatead', 'like', "%" . $get['sSearch_8'] . "%");
        }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'sr.full_name';
        }

        if ($get['iSortCol_0'] == 2) {
            $order_by = 'sr.type';
        }

        if ($get['iSortCol_0'] == 3) {
            $order_by = 'sr.email';
        }

        if ($get['iSortCol_0'] == 4) {
            $order_by = 'sr.contact_number';
        }

        if ($get['iSortCol_0'] == 5) {
            $order_by = 'sr.subject';
        }

        if ($get['iSortCol_0'] == 6) {
            $order_by = 'sr.message';
        }

        if ($get['iSortCol_0'] == 7) {
            $order_by = 'sr.status';
        }

        if ($get['iSortCol_0'] == 8) {
            $order_by = 'sr.postdatead';
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