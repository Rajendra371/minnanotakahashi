<?php

namespace App\Models\TeamTestimonial;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class TeamTestimonial extends Model
{
    protected $table = 'our_team';
    protected $guarded = [];

    public static function get_team_list()
    {
        $name = $_GET['name'] ?? '';
        $type = $_GET['type'] ?? '';
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

        $nquery = DB::table('our_team as ecl')
            ->select('id');

        $query = DB::table('our_team as ecl')
            ->select('id', 'name', 'description', 'skills', 'experience', 'type', 'address', 'designation', 'image', 'detail', 'contactno', 'email')
            ->selectRaw("CASE WHEN type = '1' THEN 'Team' WHEN type = '2' THEN 'Testimonial' ELSE '-' END as type ");

        if (!empty($name)) {
            $nquery->where('ecl.name', 'like', "%$name%");
            $query->where('ecl.name', 'like', "%$name%");
        }
        if (!empty($type)) {
            $nquery->where('ecl.type', $type);
            $query->where('ecl.type', $type);
        }

        if (!empty($get['sSearch_1'])) {
            $nquery->where('ecl.name', 'like', "%" . $get['sSearch_1'] . "%");
            $query->where('ecl.name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('ecl.designation', 'like', "%" . $get['sSearch_2'] . "%");
            $query->where('ecl.designation', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_5'])) {
            $nquery->where('ecl.contactno', 'like', "%" . $get['sSearch_5'] . "%");
            $query->where('ecl.contactno', 'like', "%" . $get['sSearch_5'] . "%");
        }

        if (!empty($get['sSearch_6'])) {
            $nquery->where('ecl.email', 'like', "%" . $get['sSearch_6'] . "%");
            $query->where('ecl.email', 'like', "%" . $get['sSearch_6'] . "%");
        }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'ecl.name';
        }

        if ($get['iSortCol_0'] == 2) {
            $order_by = 'designation';
        }
        if ($get['iSortCol_0'] == 2) {
            $order_by = 'designation';
        }
        if ($get['iSortCol_0'] == 3) {
            $order_by = 'type';
        }
        if ($get['iSortCol_0'] == 5) {
            $order_by = 'contactno';
        }
        if ($get['iSortCol_0'] == 6) {
            $order_by = 'email';
        }

        if (!empty($order) && !empty($order_by)) {
            $query->orderBy($order, $order_by);
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

    public static function get_all_testimonial_data($id = false)
    {
        $data = DB::table('our_team')
            ->where('id', $id)
            ->first();
        return $data;
    }
}