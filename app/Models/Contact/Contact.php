<?php

namespace App\Models\Contact;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'contact_us_record';
    protected $guarded = [];

    public static function get_contact_list()
    {
        $get = $_GET;
        $filter_date = $_GET['filter_date'];
        $frmDate = $_GET['frmDate'];
        $toDate = $_GET['toDate'];
        $search_text = $_GET['search_text'];

        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }

        $limit = 20;
        $offset = 0;
        if (!empty($_GET["iDisplayLength"])) {
            $limit = $_GET['iDisplayLength'];
            $offset = $_GET["iDisplayStart"];
        }

        $nquery = DB::table('contact_us_record as c')
            ->select('c.id');

        if (!empty($filter_date)) {
            if ($filter_date == 'range') {
                if (!empty($frmDate) && !empty($toDate)) {
                    $nquery->where('postdatead', '>=', "$frmDate");
                    $nquery->where('postdatead', '<=', "$toDate");
                }
            }
        }
        if (!empty($search_text)) {
            $nquery->where(function ($nqry) use ($search_text) {
                $nqry->where('c.full_name', 'like', "%$search_text%")
                    ->orWhere('c.email', 'like', "%$search_text%")
                    ->orWhere('c.contact_number', 'like', "%$search_text%")
                    ->orWhere('c.subject', 'like', "%$search_text%");
            });
        }
        if (!empty($get['sSearch_1'])) {
            $nquery->where('c.full_name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('c.email', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('c.contact_number', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $nquery->where('c.subject', 'like', "%" . $get['sSearch_4'] . "%");
        }
        if (!empty($get['sSearch_5'])) {
            $nquery->where('c.message', 'like', "%" . $get['sSearch_5'] . "%");
        }

        $query = DB::table('contact_us_record as c')
            ->select('c.id', 'c.full_name', 'c.email', 'c.contact_number', 'c.subject', 'c.message', 'c.postdatead', 'c.posttime');

        if (!empty($filter_date)) {
            if ($filter_date == 'range') {
                $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');
                if (!empty($frmDate) && !empty($toDate)) {
                    $query->where('postdatead', '>=', "$frmDate");
                    $query->where('postdatead', '<=', "$toDate");
                }
            }
        }
        if (!empty($search_text)) {
            $query->where(function ($nqry) use ($search_text) {
                $nqry->where('c.full_name', 'like', "%$search_text%")
                    ->orWhere('c.email', 'like', "%$search_text%")
                    ->orWhere('c.contact_number', 'like', "%$search_text%")
                    ->orWhere('c.subject', 'like', "%$search_text%");
            });
        }
        if (!empty($get['sSearch_1'])) {
            $query->where('c.full_name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $query->where('c.email', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $query->where('c.contact_number', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $query->where('c.subject', 'like', "%" . $get['sSearch_4'] . "%");
        }
        if (!empty($get['sSearch_5'])) {
            $query->where('c.message', 'like', "%" . $get['sSearch_5'] . "%");
        }
        $order_by = 'c.id';
        $order = 'DESC';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'c.full_name';
        }
        if ($get['iSortCol_0'] == 2) {
            $order_by = 'c.email';
        }

        if ($get['iSortCol_0'] == 3) {
            $order_by = 'c.contact_number';
        }

        if ($get['iSortCol_0'] == 4) {
            $order_by = 'c.subject';
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
