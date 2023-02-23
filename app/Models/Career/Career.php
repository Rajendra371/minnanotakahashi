<?php

namespace App\Models\Career;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;

class Career extends Model
{
    protected $table = 'job_application';
    protected $guarded = [];

    public function currency()
    {
        return $this->belongsTo('App\Models\Career\Currency', 'currency_id');
    }

    public static function get_career_list(Request $request)
    {
        $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');
        $get = $request->all();
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($value, ENT_QUOTES));
        }
        $date_type = $request->get('date_type') ?? '';
        if ($date_type == "R") {
            $start_date = $request->get('start_date') ?? '';
            $end_date = $request->get('end_date') ?? '';
        } else {
            $start_date = '';
            $end_date = '';
        }
        $gender_id = $request->get('gender_id') ?? '';
        $search_text = $request->get('search_text') ?? '';


        $limit = 20;
        $offset = 0;
        if (!empty($request->iDisplayLength)) {
            $limit = $request->iDisplayLength;
            $offset = $request->iDisplayStart;
        }

        $nquery = DB::table('job_application as j')
            ->leftjoin('gender as g', 'g.id', '=', 'j.gender')
            ->select('j.id');
        $query = DB::table('job_application as j')
            ->leftjoin('gender as g', 'g.id', '=', 'j.gender')
            ->select('j.id', 'j.jobcode', 'j.job_title', 'j.purpose', 'j.apply_before', 'j.no_of_vacancy', 'j.experience_type', 'j.start_date', 'j.end_date', 'j.driving_license', 'j.salary_type', 'g.gend_name as gender', 'j.apply_online', 'j.apply_direct', 'j.is_publish');

        if (!empty($start_date)) {
            $nquery->where('j.start_date', '>=', $start_date);
            $query->where('j.start_date', '>=', $start_date);
        }

        if (!empty($end_date)) {
            $nquery->where('j.start_date', '<=', $end_date);
            $query->where('j.start_date', '<=', $end_date);
        }

        if (!empty($gender_id)) {
            $nquery->where('j.gender', '=', $gender_id);
            $query->where('j.gender', '=', $gender_id);
        }

        if (!empty($search_text)) {

            $nquery->where(function ($qry) use ($search_text) {
                return $qry->where('j.jobcode', 'like', "%" . $search_text . "%")
                    ->orWhere('j.job_title', 'like', "%" .  $search_text . "%")
                    ->orWhere('j.purpose', 'like', "%" .  $search_text . "%")
                    ->orWhere('j.apply_before', 'like', "%" .  $search_text . "%");
            });

            $query->where(function ($qry) use ($search_text) {
                return $qry->where('j.jobcode', 'like', "%" . $search_text . "%")
                    ->orWhere('j.job_title', 'like', "%" .  $search_text . "%")
                    ->orWhere('j.purpose', 'like', "%" .  $search_text . "%")
                    ->orWhere('j.apply_before', 'like', "%" .  $search_text . "%");
            });
        }

        if (!empty($get['sSearch_1'])) {
            $nquery->where('j.jobcode', 'like', "%" . $get['sSearch_1'] . "%");
            $query->where('j.jobcode', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('j.job_title', 'like', "%" . $get['sSearch_2'] . "%");
            $query->where('j.job_title', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('j.apply_before', 'like', "%" . $get['sSearch_3'] . "%");
            $query->where('j.apply_before', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_6'])) {
            $nquery->where('j.start_date', 'like', "%" . $get['sSearch_6'] . "%");
            $query->where('j.start_date', 'like', "%" . $get['sSearch_6'] . "%");
        }
        // if (!empty($get['sSearch_7'])) {
        //     $nquery->where('j.end_date', 'like', "%" . $get['sSearch_7'] . "%");
        //     $query->where('j.end_date', 'like', "%" . $get['sSearch_7'] . "%");
        // }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'j.jobcode';
        }

        if ($get['iSortCol_0'] == 2) {
            $order_by = 'j.job_title';
        }
        if ($get['iSortCol_0'] == 3) {
            $order_by = 'j.apply_before';
        }

        if ($get['iSortCol_0'] == 6) {
            $order_by = 'j.start_date';
        }
        // if ($get['iSortCol_0'] == 7) {
        //     $order_by = 'j.end_date';
        // }


        if (!empty($order) && !empty($order_by)) {
            $query->orderBy($order_by, $order);
        } else {
            $query->orderBy('j.id', 'DESC');
        }
        if (!empty($offset)) {
            $query->offset($offset);
        }

        if ($limit) {
            $query->limit($limit);
        }

        $data = $query->get();
        $count = $nquery->count();

        // $no_of_pages = ceil($count / $limit);

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


    public static function generateJobCode()
    {
        $count = Career::count();
        if ($count) {
            $jobcode = str_pad($count + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $jobcode = '0001';
        }
        return $jobcode;
    }
}