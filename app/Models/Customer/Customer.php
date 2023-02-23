<?php

namespace App\Models\Customer;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'user_detail';
    protected $guarded = [];
    protected $hidden = [
        'postdatead',
        'postdatebs',
        'posttime',
        'postip',
        'postmac',
        'modifyby',
        'modifydatead',
        'modifydatebs',
        'modifytime',
        'modifyip',
        'modifymac',
        'created_at',
        'updated_at',
    ];

    public static function get_user_detail_list()
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

        $nquery = DB::table('users as u')
            ->leftJoin('user_detail as ud', 'u.id', '=', 'ud.userid')
            ->select('u.id')
            ->where('u.user_type', 'CUSTOMER');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('ud.fullname', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('u.email', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('ud.mobile_no', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $nquery->where('ud.dob', 'like', "%" . $get['sSearch_4'] . "%");
        }

        $query = DB::table('users as u')
            ->leftJoin('user_detail as ud', 'u.id', '=', 'ud.userid')
            ->select('u.id', 'u.email', 'ud.fullname', 'ud.dob', 'ud.mobile_no')
            ->where('u.user_type', 'CUSTOMER');

        if (!empty($get['sSearch_1'])) {
            $query->where('ud.fullname', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $query->where('u.email', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $query->where('ud.mobile_no', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $query->where('ud.dob', 'like', "%" . $get['sSearch_4'] . "%");
        }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'ud.fullname';
        }
        if ($get['iSortCol_0'] == 2) {
            $order_by = 'u.email';
        }

        if ($get['iSortCol_0'] == 3) {
            $order_by = 'ud.mobile_no';
        }

        if ($get['iSortCol_0'] == 4) {
            $order_by = 'ud.dobs';
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
