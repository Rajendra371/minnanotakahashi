<?php

namespace App\Models\Home;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class ClientReferral extends Model
{
    protected $table = 'client_referral';
    protected $guarded = [];

    public static function datatable_list()
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

        $nquery = DB::table('client_referral as cr')->leftJoin('identity as i', 'i.id', '=', 'cr.identity_id')->leftJoin('services as s', 's.id', '=', 'cr.service_id')->select('cr.id');

        $query = DB::table('client_referral as cr')->leftJoin('identity as i', 'i.id', '=', 'cr.identity_id')->leftJoin('services as s', 's.id', '=', 'cr.service_id')->select('cr.id', 'cr.first_name', 'cr.middle_name', 'cr.last_name', 'cr.age', 'cr.telephone', 'cr.mobile', 'cr.email', 'cr.contact_method', 'cr.service_id', 'cr.status', 'i.name as identity_name', 'cr.identity_other', 's.service_name');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('cr.first_name', 'like', "%" . $get['sSearch_1'] . "%");
            $query->where('cr.first_name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('i.name', 'like', "%" . $get['sSearch_2'] . "%");
            $query->where('i.name', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('cr.email', 'like', "%" . $get['sSearch_3'] . "%");
            $query->where('cr.email', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $nquery->where('cr.telephone', 'like', "%" . $get['sSearch_4'] . "%");
            $query->where('cr.telephone', 'like', "%" . $get['sSearch_4'] . "%");
        }
        if (!empty($get['sSearch_5'])) {
            $nquery->where('cr.contact_method', 'like', "%" . $get['sSearch_5'] . "%");
            $query->where('cr.contact_method', 'like', "%" . $get['sSearch_5'] . "%");
        }
        if (!empty($get['sSearch_6'])) {
            $nquery->where('s.service_name', 'like', "%" . $get['sSearch_6'] . "%");
            $query->where('s.service_name', 'like', "%" . $get['sSearch_6'] . "%");
        }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'cr.first_name';
        }

        if ($get['iSortCol_0'] == 2) {
            $order_by = 'i.identity';
        }

        if ($get['iSortCol_0'] == 3) {
            $order_by = 'cr.email';
        }

        if ($get['iSortCol_0'] == 4) {
            $order_by = 'cr.telephone';
        }

        if ($get['iSortCol_0'] == 5) {
            $order_by = 'cr.contact_method';
        }

        if ($get['iSortCol_0'] == 6) {
            $order_by = 's.service_name';
        }

        if ($get['iSortCol_0'] == 7) {
            $order_by = 'cr.status';
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

    public static function evaluation_datatable_list()
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

        $nquery = DB::table('quick_evaluation as qe')->select('qe.id');

        $query = DB::table('quick_evaluation as qe')->select('qe.id', 'qe.first_name', 'qe.last_name', 'qe.email', 'qe.postcode', 'qe.care_for', 'qe.interested_services', 'qe.ndis_registered', 'qe.hours', 'qe.days', 'qe.duration', 'qe.start_period', 'qe.status', 'postdatead', 'posttime');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('qe.first_name', 'like', "%" . $get['sSearch_1'] . "%");
            $query->where('qe.first_name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('qe.email', 'like', "%" . $get['sSearch_2'] . "%");
            $query->where('qe.email', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('qe.postcode', 'like', "%" . $get['sSearch_3'] . "%");
            $query->where('qe.postcode', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_7'])) {
            $nquery->where('qe.duration', 'like', "%" . $get['sSearch_7'] . "%");
            $query->where('qe.duration', 'like', "%" . $get['sSearch_7'] . "%");
        }
        if (!empty($get['sSearch_8'])) {
            $nquery->where('qe.days', 'like', "%" . $get['sSearch_8'] . "%");
            $query->where('qe.days', 'like', "%" . $get['sSearch_8'] . "%");
        }
        if (!empty($get['sSearch_9'])) {
            $nquery->where('qe.hours', 'like', "%" . $get['sSearch_9'] . "%");
            $query->where('qe.hours', 'like', "%" . $get['sSearch_9'] . "%");
        }
        if (!empty($get['sSearch_10'])) {
            $nquery->where('qe.start_period', 'like', "%" . $get['sSearch_10'] . "%");
            $query->where('qe.start_period', 'like', "%" . $get['sSearch_10'] . "%");
        }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'qe.first_name';
        }

        if ($get['iSortCol_0'] == 2) {
            $order_by = 'qe.email';
        }

        if ($get['iSortCol_0'] == 3) {
            $order_by = 'qe.postcode';
        }

        if ($get['iSortCol_0'] == 4) {
            $order_by = 'qe.care_for';
        }


        if ($get['iSortCol_0'] == 6) {
            $order_by = 'qe.ndis_registered';
        }

        if ($get['iSortCol_0'] == 7) {
            $order_by = 'qe.duration';
        }

        if ($get['iSortCol_0'] == 8) {
            $order_by = 'qe.days';
        }

        if ($get['iSortCol_0'] == 9) {
            $order_by = 'qe.hours';
        }

        if ($get['iSortCol_0'] == 10) {
            $order_by = 'qe.start_period';
        }

        if ($get['iSortCol_0'] == 11) {
            $order_by = 'qe.status';
        }

        if ($get['iSortCol_0'] == 12) {
            $order_by = 'qe.postdatead';
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