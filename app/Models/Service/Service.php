<?php

namespace App\Models\Service;

use Illuminate\Database\Eloquent\Model;
use DB;

class Service extends Model
{
    protected $table = 'services';
    protected $guarded = [];
    //  protected $fillable = ['id'];

    public static function get_service_list()
    {
        $get = $_GET;
        $filter_date = $_GET['filter_date'];
        $frmDate = $_GET['frmDate'];
        $toDate = $_GET['toDate'];

        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }

        $limit = 20;
        $offset = 0;
        if (!empty($_GET["iDisplayLength"])) {
            $limit = $_GET['iDisplayLength'];
            $offset = $_GET["iDisplayStart"];
        }

        $nquery = \DB::table('services')
            // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
            ->select('*');
        if (!empty($filter_date)) {
            if ($filter_date == 'range') {

                $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');
                // if($defaultpicker=='NP'){
                if (!empty($frmDate) && !empty($toDate)) {
                    $nquery->where('startdate', '>=', "$frmDate");
                    $nquery->where('enddate', '<=', "$toDate");
                }
            }
        }

        if (!empty($get['sSearch_1'])) {
            $nquery->where('service_name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('startdate', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('enddate', 'like', "%" . $get['sSearch_3'] . "%");
        }

        $query = \DB::table('services')
            // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
            ->select('*');

        if (!empty($filter_date)) {
            if ($filter_date == 'range') {
                $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');
                //  if($defaultpicker=='NP'){
                if (!empty($frmDate) && !empty($toDate)) {
                    $query->where('startdate', '>=', "$frmDate");
                    $query->where('enddate', '<=', "$toDate");
                }
            }
        }
        if (!empty($get['sSearch_1'])) {
            $query->where('service_name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $query->where('startdate', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $query->where('enddate', 'like', "%" . $get['sSearch_3'] . "%");
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

    public static function get_all_service_data($id = false)
    {
        $data = DB::table('services')
            ->where('id', $id)
            ->first();
        return $data;
    }
}