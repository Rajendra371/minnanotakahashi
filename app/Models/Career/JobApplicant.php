<?php

namespace App\Models\Career;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Http\Request;

class JobApplicant extends Model
{
    protected $table = 'job_applicant';
    protected $guarded = [];

    public static function get_list(Request $request)
    {
        $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');

        $get = $request->all();
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($value, ENT_QUOTES));
        }

        $search_text = $request->get('search_text');

        $limit = 20;
        $offset = 0;
        if (!empty($request->iDisplayLength)) {
            $limit = $request->iDisplayLength;
            $offset = $request->iDisplayStart;
        }

        $nquery = DB::table('job_applicant as j')
            ->leftjoin('job_application as ja', 'ja.id', '=', 'j.job_id')
            ->select('j.id');
        $query = DB::table('job_applicant as j')
            ->leftjoin('job_application as ja', 'ja.id', '=', 'j.job_id')
            ->select('j.id', 'ja.job_title', 'ja.jobcode', 'j.full_name', 'j.contact_number', 'j.cv', 'j.cover_letter', 'j.postdatead', 'j.email');

        if (!empty($search_text)) {

            $nquery->where(function ($qry) use ($search_text) {
                return $qry->where('ja.jobcode', 'like', "%" . $search_text . "%")
                    ->orWhere('ja.job_title', 'like', "%" .  $search_text . "%")
                    ->orWhere('j.full_name', 'like', "%" .  $search_text . "%")
                    ->orWhere('j.contact_number', 'like', "%" .  $search_text . "%");
            });

            $query->where(function ($qry) use ($search_text) {
                return $qry->where('ja.jobcode', 'like', "%" . $search_text . "%")
                    ->orWhere('ja.job_title', 'like', "%" .  $search_text . "%")
                    ->orWhere('j.full_name', 'like', "%" .  $search_text . "%")
                    ->orWhere('j.contact_number', 'like', "%" .  $search_text . "%");
            });
        }

        if (!empty($get['sSearch_1'])) {
            $nquery->where('ja.jobcode', 'like', "%" . $get['sSearch_1'] . "%");
            $query->where('ja.jobcode', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('ja.job_title', 'like', "%" . $get['sSearch_2'] . "%");
            $query->where('ja.job_title', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('j.full_name', 'like', "%" . $get['sSearch_3'] . "%");
            $query->where('j.full_name', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $nquery->where('j.contact_number', 'like', "%" . $get['sSearch_4'] . "%");
            $query->where('j.contact_number', 'like', "%" . $get['sSearch_4'] . "%");
        }
        if (!empty($get['sSearch_5'])) {
            $nquery->where('j.email', 'like', "%" . $get['sSearch_5'] . "%");
            $query->where('j.email', 'like', "%" . $get['sSearch_5'] . "%");
        }
        if (!empty($get['sSearch_6'])) {
            $nquery->where('j.postdatead', 'like', "%" . $get['sSearch_6'] . "%");
            $query->where('j.postdatead', 'like', "%" . $get['sSearch_6'] . "%");
        }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'ja.jobcode';
        }
        if ($get['iSortCol_0'] == 2) {
            $order_by = 'ja.job_title';
        }
        if ($get['iSortCol_0'] == 3) {
            $order_by = 'j.full_name';
        }
        if ($get['iSortCol_0'] == 4) {
            $order_by = 'j.contact_number';
        }
        if ($get['iSortCol_0'] == 5) {
            $order_by = 'j.email';
        }
        if ($get['iSortCol_0'] == 6) {
            $order_by = 'j.postdatead';
        }

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
}