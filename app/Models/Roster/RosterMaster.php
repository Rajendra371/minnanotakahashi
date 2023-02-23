<?php

namespace App\Models\Roster;

use DB;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

class RosterMaster extends Model
{
    protected $table = 'shift_master';
    protected $guarded = [];

    public function details()
    {
        return $this->hasMany('App\Models\Roster\RosterDetail', 'shift_masterid');
    }

    public static function employee_roster_list(Request $request)
    {
        $get = $request->all();
        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($value, ENT_QUOTES));
        }


        $department_id = $request->department_id;
        $designation_id = $request->designation_id;
        $employee_id = $request->employee_id;
        $date_type = $request->date_type;
        $from_date = $request->from_date;
        $to_date = $request->to_date;

        $main_location = session('MAIN_LOCATION');
        $group_code = auth()->user()->group_id ?? session('USERGROUP_ID');
        $auth_locationid = auth()->user()->locationid ?? session('LOCATION_ID');

        if ($main_location == 'Y' && in_array($group_code, [1])) {
            $location_id = $request->location_id;
        } else {
            $location_id = $auth_locationid;
        }

        $limit = 20;
        $offset = 0;
        if (!empty($request->iDisplayLength)) {
            $limit = $request->iDisplayLength;
            $offset = $request->iDisplayStart;
        }

        $nquery = DB::table('shift_master as sm')
            ->leftjoin('shift_detail as sd', 'sm.id', '=', 'sd.shift_masterid')
            ->leftjoin('employees as e', 'sd.empid', '=', 'e.id')
            ->leftjoin('department as dep', 'dep.id', '=', 'sd.department_id')
            ->leftjoin('designation as des', 'des.id', '=', 'sd.designation_id')
            ->select('sm.id');
        $query = DB::table('shift_master as sm')
            ->leftjoin('shift_detail as sd', 'sm.id', '=', 'sd.shift_masterid')
            ->leftjoin('employees as e', 'sd.empid', '=', 'e.id')
            ->leftjoin('department as dep', 'dep.id', '=', 'sd.department_id')
            ->leftjoin('designation as des', 'des.id', '=', 'sd.designation_id')
            ->select('sd.id', 'sm.refno', 'sm.gen_type', 'sd.startdatead', 'sd.start_time', 'sd.enddatead', 'sd.end_time', 'sd.total_hrs', 'sd.place', 'sd.remarks', 'sd.work_status', 'e.empcode', 'dep.depname as department', 'des.designation_name as designation', 'sd.checkin_date', 'sd.checkin_time', 'sd.complete_date', 'sd.complete_time', 'sd.work_details')
            ->selectRaw("CONCAT(e.first_name,' ',IFNULL(e.middle_name,''),' ',e.last_name) as full_name");

        if (!empty($date_type) && $date_type == 'range') {
            if (!empty($from_date) && !empty($to_date)) {
                $nquery->where('sd.startdatead', '>=', $from_date)->where('sd.startdatead', '<=', $to_date);
                $query->where('sd.startdatead', '>=', $from_date)->where('sd.startdatead', '<=', $to_date);
            }
        }
        if (!empty($department_id)) {
            $nquery->where('sd.department_id', '=', $department_id);
            $query->where('sd.department_id', '=', $department_id);
        }
        if (!empty($designation_id)) {
            $nquery->where('sd.designation_id', '=', $designation_id);
            $query->where('sd.designation_id', '=', $designation_id);
        }
        if (!empty($employee_id)) {
            $nquery->where('sd.empid', '=', $employee_id);
            $query->where('sd.empid', '=', $employee_id);
        }
        if (!empty($employee_type_id)) {
            $nquery->where('e.employee_type_id', '=', $employee_type_id);
            $query->where('e.employee_type_id', '=', $employee_type_id);
        }

        if (!empty($location_id)) {
            $nquery->where('sm.locationid', '=', $location_id);
            $query->where('sm.locationid', '=', $location_id);
        }


        if (!empty($get['sSearch_1'])) {
            $nquery->where('sm.refno', 'like', "%" . $get['sSearch_1'] . "%");
            $query->where('sm.refno', 'like', "%" . $get['sSearch_1'] .  "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('sm.type', 'like', "%" . $get['sSearch_2'] . "%");
            $query->where('sm.type', 'like', "%" . $get['sSearch_2'] .  "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('e.empcode', 'like', "%" . $get['sSearch_3'] . "%");
            $query->where('e.empcode', 'like', "%" . $get['sSearch_3'] .  "%");
        }
        if (!empty($get['sSearch_4'])) {
            $search_4 = $get['sSearch_4'];
            $nquery->where(function ($qry) use ($search_4) {
                return $qry->where('e.first_name', 'like', "%" . $search_4 . "%")
                    ->orWhere('e.middle_name', 'like', "%" .  $search_4 . "%")
                    ->orWhere('e.last_name', 'like', "%" .  $search_4 . "%");
            });

            $query->where(function ($qry) use ($search_4) {
                return $qry->where('e.first_name', 'like', "%" . $search_4 . "%")
                    ->orWhere('e.middle_name', 'like', "%" .  $search_4 . "%")
                    ->orWhere('e.last_name', 'like', "%" .  $search_4 . "%");
            });
        }
        if (!empty($get['sSearch_5'])) {
            $nquery->where('depname', 'like', "%" . $get['sSearch_5'] . "%");
            $query->where('depname', 'like', "%" . $get['sSearch_5'] . "%");
        }
        if (!empty($get['sSearch_6'])) {
            $nquery->where('designation_name', 'like', "%" . $get['sSearch_6'] . "%");
            $query->where('designation_name', 'like', "%" . $get['sSearch_6'] . "%");
        }
        if (!empty($get['sSearch_7'])) {
            $nquery->where('sd.startdatead', 'like', "%" . $get['sSearch_7'] . "%");
            $query->where('sd.startdatead', 'like', "%" . $get['sSearch_7'] . "%");
        }
        if (!empty($get['sSearch_8'])) {
            $nquery->where('sd.start_time', 'like', "%" . $get['sSearch_8'] . "%");
            $query->where('sd.start_time', 'like', "%" . $get['sSearch_8'] . "%");
        }
        if (!empty($get['sSearch_9'])) {
            $nquery->where('sd.enddatead', 'like', "%" . $get['sSearch_9'] . "%");
            $query->where('sd.enddatead', 'like', "%" . $get['sSearch_9'] . "%");
        }
        if (!empty($get['sSearch_10'])) {
            $nquery->where('sd.end_time', 'like', "%" . $get['sSearch_10'] . "%");
            $query->where('sd.end_time', 'like', "%" . $get['sSearch_10'] . "%");
        }
        if (!empty($get['sSearch_11'])) {
            $nquery->where('sd.total_hrs', 'like', "%" . $get['sSearch_11'] . "%");
            $query->where('sd.total_hrs', 'like', "%" . $get['sSearch_11'] . "%");
        }
        if (!empty($get['sSearch_12'])) {
            $nquery->where('sd.place', 'like', "%" . $get['sSearch_12'] . "%");
            $query->where('sd.place', 'like', "%" . $get['sSearch_12'] . "%");
        }
        if (!empty($get['sSearch_13'])) {
            $nquery->where('sd.remarks', 'like', "%" . $get['sSearch_13'] . "%");
            $query->where('sd.remarks', 'like', "%" . $get['sSearch_13'] . "%");
        }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'sm.refno';
        }
        if ($get['iSortCol_0'] == 2) {
            $order_by = 'sm.gen_type';
        }
        if ($get['iSortCol_0'] == 3) {
            $order_by = 'e.empcode';
        }
        if ($get['iSortCol_0'] == 4) {
            $order_by = 'e.first_name';
        }
        if ($get['iSortCol_0'] == 5) {
            $order_by = 'depname';
        }
        if ($get['iSortCol_0'] == 6) {
            $order_by = 'designation_name';
        }
        if ($get['iSortCol_0'] == 7) {
            $order_by = 'sd.startdatead';
        }
        if ($get['iSortCol_0'] == 8) {
            $order_by = 'sd.start_time';
        }
        if ($get['iSortCol_0'] == 9) {
            $order_by = 'sd.enddatead';
        }
        if ($get['iSortCol_0'] == 10) {
            $order_by = 'sd.end_time';
        }
        if ($get['iSortCol_0'] == 11) {
            $order_by = 'total_hrs';
        }
        if ($get['iSortCol_0'] == 12) {
            $order_by = 'place';
        }
        if ($get['iSortCol_0'] == 13) {
            $order_by = 'remarks';
        }
        if ($get['iSortCol_0'] == 14) {
            $order_by = 'work_status';
        }

        if (!empty($order) && !empty($order_by)) {
            $query->orderBy($order_by, $order);
        } else {
            $query->orderBy('e.id', 'DESC');
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