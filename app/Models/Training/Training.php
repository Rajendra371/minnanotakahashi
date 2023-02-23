<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;
use DB;

class Training extends Model
{
    protected $table = 'training';
    protected $fillable = ['id'];
    // protected $guarded = [];



    public static function get_training_list()
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

        $nquery = \DB::table('training')
            // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
            ->select('id');
        if (!empty($filter_date)) {
            if ($filter_date == 'range') {

                $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');
                // if($defaultpicker=='NP'){
                if (!empty($frmDate) && !empty($toDate)) {
                    $nquery->where('start_date', '>=', "$frmDate");
                    $nquery->where('end_date', '<=', "$toDate");
                }
            }
        }



        if (!empty($get['sSearch_1'])) {
            $nquery->where('title', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('description', 'like', "%" . $get['sSearch_3'] . "%");
        }



        $query = \DB::table('training')
            // ->leftjoin('employee as e','e.device_id','=','ecl.empid')
            ->select('id', 'title', 'description', 'trainer_name', 'is_publish', 'image1', 'trainer_image');


        if (!empty($filter_date)) {
            if ($filter_date == 'range') {
                $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');
                //  if($defaultpicker=='NP'){
                if (!empty($frmDate) && !empty($toDate)) {
                    $query->where('start_date', '>=', "$frmDate");
                    $query->where('end_date', '<=', "$toDate");
                }
            }
        }
        if (!empty($get['sSearch_1'])) {
            $query->where('title', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $query->where('description', 'like', "%" . $get['sSearch_3'] . "%");
        }



        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'title';
        }

        if (!empty($order) && !empty($order_by)) {
            $query->orderBy($order_by, $order);
        }

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

    public static function get_all_training_data($id = false)
    {
        $data = DB::table('training')
            ->where('id', $id)
            ->first();
        return $data;
    }
}