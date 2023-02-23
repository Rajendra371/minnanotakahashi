<?php

namespace App\Models\University;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class University extends Model
{
    protected $table = 'universities';
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

        $nquery = DB::table('universities as u')
            ->select('u.id', 'u.title', 'u.slug', 'u.short_content', 'u.content', 'u.image', 'u.website', 'u.is_publish');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('u.title', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('u.content', 'like', "%" . $get['sSearch_3'] . "%");
        }

        $query = DB::table('universities as u')
            ->select('u.id', 'u.title', 'u.slug', 'u.short_content', 'u.content', 'u.image', 'u.website', 'u.is_publish');

        if (!empty($get['sSearch_1'])) {
            $query->where('u.title', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $query->where('u.content', 'like', "%" . $get['sSearch_3'] . "%");
        }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'u.title';
        }

        if ($get['iSortCol_0'] == 3) {
            $order_by = 'u.short_content';
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
