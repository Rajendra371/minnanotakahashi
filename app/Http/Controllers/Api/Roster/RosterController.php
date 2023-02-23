<?php

namespace App\Http\Controllers\Api\Roster;

use DB;
use Validator;
use Carbon\Carbon;
use App\Helpers\General;
use Illuminate\Http\Request;
use App\Models\Roster\RosterBook;
use App\Models\Roster\RoserMaster;
use App\Models\Roster\RosterDetail;
use App\Models\Roster\RosterMaster;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class RosterController extends Controller
{

    function __construct()
    {

        if (Auth::check()) {
            $this->locationid = auth()->user()->locationid;
            $this->orgid = auth()->user()->orgid;
            $this->empid = auth()->user()->empid;
            $this->userid = auth()->user()->id;
            $this->groupcode = auth()->user()->group_id;
        } else {
            $this->orgid = session('ORGANIZATION_ID', '');
            $this->locationid = session('LOCATION_ID', '');
            $this->empid = session('EMPLOYEE_ID', '');
            $this->userid = session('USER_ID', '');
            $this->groupcode = session('USERGROUP_ID', '');
        }

        $this->location_ismain = session()->get('MAIN_LOCATION');
        $this->default_datepicker = get_constant_value("DEFAULT_DATEPICKER");
        $this->curdate_en = CURDATE_EN;
        $this->curdate_np = EngToNepDateConv(CURDATE_EN);
        $this->ip = get_real_ipaddr();
        $this->mac = get_Mac_Address();
    }

    public function entry_record(Request $request)
    {
        $gen_type = $request->get('gen_type');
        $designationid = $request->get('designationid');
        $departmentid = $request->get('departmentid');
        $employeeid = $request->get('employeeid');
        $refno = $this->max_refno();
        $operation = $request->get('operation');

        if ($this->location_ismain == 'Y' && in_array($this->groupcode, [1])) {
            $locationid = $request->locationid ?? $this->locationid;
        } else {
            $locationid = $this->locationid;
        }

        if ($operation == "insert") {
            $trans = check_permission('Insert');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $refno = $this->max_refno();
            if ($gen_type == 'S') {
                if ($employeeid == '' || empty($employeeid)) {
                    return response()->json(['status' => 'error', 'message' => 'Please Select An Employee!!']);
                }
                $employee_query = \DB::table('employees as e')
                    ->leftJoin('department as d', 'd.id', '=', 'e.department_id')
                    ->leftJoin('designation as de', 'de.id', '=', 'e.designation_id')
                    ->select(
                        'e.id as empid',
                        'd.id as depid',
                        'de.id as desgid',
                        'e.first_name',
                        'e.middle_name',
                        'e.last_name',
                        'e.empcode',
                        'd.depname',
                        'de.designation_name',
                        'e.mobile1',
                        'e.email',
                        'e.joining_datead',
                        'e.designation_id',
                        'e.department_id'
                    );
                if (!empty($employeeid)) {
                    $employee_query->where('e.id', '=', $employeeid);
                }
                if (!empty($locationid)) {
                    $employee_query->where('e.locationid', '=', $locationid);
                }
                $emp_result = $employee_query->first();

                $view = view('Roster.RosterEntrySingleForm', compact('emp_result', 'refno', 'operation'));
            } else if ($gen_type == "B") {
                $emp = DB::table('employees as e')
                    ->leftjoin('department as d', 'd.id', '=', 'e.department_id')
                    ->select('e.id', 'e.empcode', 'e.first_name', 'e.middle_name', 'e.last_name', 'e.designation_id as desgid', 'd.id as depid', 'd.depname');
                if (!empty($departmentid)) {
                    $emp->where('e.department_id', $departmentid);
                }
                if (!empty($designationid)) {
                    $emp->where('e.designation_id', $designationid);
                }
                if (!empty($locationid)) {
                    $emp->where('e.locationid', '=', $locationid);
                }
                $employee_data = $emp->get();
                // dd(($employee_data)->isEmpty());
                // dd($employee_data);

                if (($employee_data)->isEmpty()) {
                    return response()->json(['message' => 'No record found']);
                }

                $view = view('Roster.RosterEntryBulkForm', compact(
                    'refno',
                    'operation',
                    'employee_data'
                ));
            } else {
                $designation_data = DB::table('designation')
                    ->select('id', 'designation_name as name')
                    ->where('id', $designationid)
                    ->first();

                $view = view(
                    'Roster.RosterEmployelessForm',
                    compact(
                        'refno',
                        'designation_data',
                        'operation'
                    )
                );
            }
        } else {

            if ($operation == 'update') {
                $trans = check_permission('Update');
                if ($trans == 'error') {
                    permission_message();
                    exit;
                }
            }
            if ($operation == 'view') {
                $trans = check_permission('View');
                if ($trans == 'error') {
                    permission_message();
                    exit;
                }
            }
            $refno = $request->get('refno');
            $master_data = DB::table('shift_master')
                ->select('gen_type', 'remarks', 'id', 'empid')
                ->where('refno', $refno)
                ->where('locationid', $locationid)
                ->first();
            if ($master_data) {
                if ($master_data->gen_type == "S") {
                    // if ($employeeid == '' || empty($employeeid)) {
                    // }
                    $employee_query = \DB::table('employees as e')
                        ->leftJoin('department as d', 'd.id', '=', 'e.department_id')
                        ->leftJoin('designation as de', 'de.id', '=', 'e.designation_id')
                        ->select(
                            'e.id as empid',
                            'd.id as depid',
                            'de.id as desgid',
                            'e.first_name',
                            'e.middle_name',
                            'e.last_name',
                            'e.empcode',
                            'd.depname',
                            'de.designation_name',
                            'e.mobile1',
                            'e.email',
                            'e.joining_datead',
                            'e.designation_id',
                            'e.department_id'
                        );
                    $employee_query->where('e.id', '=', $master_data->empid);
                    $emp_result = $employee_query->first();

                    $shift_data = DB::table('shift_detail')
                        ->select('id', 'startdatead', 'start_time', 'enddatead', 'end_time', 'total_hrs', 'place', 'remarks')
                        ->where('shift_masterid', $master_data->id)
                        ->get();

                    $master_remarks = $master_data->remarks;
                    $view = view('Roster.RosterEntrySingleForm', compact(
                        'emp_result',
                        'shift_data',
                        'operation',
                        'refno',
                        'master_data'
                    ));
                } else if ($master_data->gen_type == "B") {
                    $shift_data = DB::table('shift_detail as sd')
                        ->leftjoin('employees as e', 'e.id', '=', 'sd.empid')
                        ->leftjoin('department as d', 'd.id', '=', 'sd.department_id')
                        ->select('sd.id', 'sd.empid', 'sd.department_id as depid', 'sd.startdatead', 'sd.start_time', 'sd.enddatead', 'sd.end_time', 'sd.total_hrs', 'sd.place', 'sd.remarks', 'e.empcode', 'e.first_name', 'e.middle_name', 'e.last_name', 'd.depname')
                        ->where('sd.shift_masterid', $master_data->id)
                        ->get();
                    // dd($shift_data);
                    $view = view('Roster.RosterEntryBulkForm', compact(
                        'refno',
                        'shift_data',
                        'operation',
                        'master_data'
                    ));
                } else {
                    $shift_data = DB::table('shift_master as sm')
                        ->leftjoin('shift_detail as sd', 'sd.shift_masterid', 'sm.id')
                        ->select('sm.id', 'sm.gen_type', 'sm.designation_id', 'sm.quota', 'sd.department_id', 'sd.startdatead', 'sd.start_time', 'sd.enddatead', 'sd.end_time', 'sd.total_hrs', 'sd.place', 'sd.remarks')
                        ->where('sm.refno', $refno)
                        ->first();
                    // dd($shift_data);
                    $master_data = DB::table('shift_master')
                        ->select('id')
                        ->where('refno', $refno)
                        ->first();
                    $shift_masterid = $shift_data->id ?? '';
                    $gen_type = $shift_data->gen_type ?? '';
                    $designationid = $shift_data->designation_id ?? '';
                    // dd($designationid);
                    if (!empty($designationid)) {
                        $designation_data = DB::table('designation')
                            ->select('id', 'designation_name as name')
                            ->where('id', $designationid)
                            ->first();
                    }
                    // dd($designation_data);
                    $view = view(
                        'Roster.RosterEmployelessForm',
                        compact(
                            'refno',
                            'shift_data',
                            'operation',
                            'shift_masterid',
                            'designation_data'
                        )
                    );
                }
            } else {
                return response()->json(['message' => 'No record found']);
            }
        }

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template], 200);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Fetching Form'], 500);
        }
    }


    public function save_employee_roster_individual(Request $request)
    {
        try {
            \DB::beginTransaction();
            $id = $request->get('shift_masterid');
            $sdid = $request->get('sdid');
            $empid = $request->get('empid');
            $shift_remarks = $request->get('shift_remarks');
            $depid = $request->get('depid');
            $desgid = $request->get('desgid');
            $gen_type = $request->get('gen_type');
            $refno = $request->get('refno');
            $startdate = $request->get('startdate');
            $starttime = $request->get('starttime');
            $enddate = $request->get('enddate');
            $endtime = $request->get('endtime');
            $totalhrs = $request->get('totalhrs');
            // dd($startdate);
            $place = $request->get('place');
            $remarks = $request->get('remarks');
            $quota = $request->get('quota');

            $validator = Validator::make($request->all(), [
                'empid' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
            }

            foreach ($startdate as $ksd => $val) {
                $sid = !empty($sdid[$ksd]) ? $sdid[$ksd] : '';
                if (!empty($sid)) {

                    $update_array[] = array(
                        'startdatead' => !empty($startdate[$ksd]) ? $startdate[$ksd] : '',
                        'startdatebs' => '',
                        'start_time' => !empty($starttime[$ksd]) ? $starttime[$ksd] : '',
                        'enddatead' => !empty($enddate[$ksd]) ? $enddate[$ksd] : '',
                        'enddatebs' => '',
                        'end_time' => !empty($endtime[$ksd]) ? $endtime[$ksd] : '',
                        'total_hrs' => !empty($totalhrs[$ksd]) ? $totalhrs[$ksd] : '',
                        'place' => !empty($place[$ksd]) ? $place[$ksd] : '',
                        'remarks' => !empty($remarks[$ksd]) ? $remarks[$ksd] : '',
                        'status' => 'O',
                        'modifydatead' => $this->curdate_en,
                        'modifydatebs' => $this->curdate_np,
                        'modifytime' => date('h:i:s'),
                        'modifymac' => $this->mac,
                        'modifyip' => $this->ip,
                        'modifyby' => $this->userid,
                    );
                } else {
                    $insert_array[] = array(
                        'shift_masterid' => $id,
                        'empid' => $empid,
                        'designation_id' => $desgid,
                        'department_id' => $depid,
                        'startdatead' => !empty($startdate[$ksd]) ? $startdate[$ksd] : '',
                        'startdatebs' => '',
                        'start_time' => !empty($starttime[$ksd]) ? $starttime[$ksd] : '',
                        'enddatead' => !empty($enddate[$ksd]) ? $enddate[$ksd] : '',
                        'enddatebs' => '',
                        'end_time' => !empty($endtime[$ksd]) ? $endtime[$ksd] : '',
                        'total_hrs' => !empty($totalhrs[$ksd]) ? $totalhrs[$ksd] : '',
                        'place' => !empty($place[$ksd]) ? $place[$ksd] : '',
                        'remarks' => !empty($remarks[$ksd]) ? $remarks[$ksd] : '',
                        'status' => 'O',
                        'postdatead' => $this->curdate_en,
                        'postdatebs' => $this->curdate_np,
                        'posttime' => date('h:i:s'),
                        'postmac' => $this->mac,
                        'postip' => $this->ip,
                        'postby' => $this->userid,
                        'orgid' => $this->orgid,
                        'locationid' => $this->locationid
                    );
                    // \DB::insert();
                }
            }

            // die();
            // dd($insert_array);
            if ($id) {
                $update_master_arr = array(
                    'remarks' => $shift_remarks,
                    'status' => 'O',
                    'modifydatead' => $this->curdate_en,
                    'modifydatebs' => $this->curdate_np,
                    'modifytime' => date('h:i:s'),
                    'modifymac' => $this->mac,
                    'modifyip' => $this->ip,
                    'modifyby' => $this->userid,
                );
                if (!empty($update_master_arr)) {
                    $update_master = \DB::table('shift_master')
                        ->where('id', $id)
                        ->update($update_master_arr);
                    if (!empty($update_master)) {
                        $form_array = array();
                        foreach ($startdate as $ksd => $st) {
                            $form_array[] = $sdid[$ksd];
                        }
                    }
                    // print_r($form_array);
                    // die();
                    $db_old_shift_det = DB::table('shift_detail')
                        ->where('shift_masterid', $id)
                        ->where('orgid', $this->orgid)
                        ->get();
                    $old_array = array();
                    if (!empty($db_old_shift_det)) {
                        foreach ($db_old_shift_det as $d) {
                            $old_array[] = $d->id;
                        }
                    }

                    if (!empty($update_array)) {
                        foreach ($update_array as $i => $d) {
                            \DB::table('shift_detail')
                                ->where('shift_masterid', $id)
                                ->where('id', $sdid[$i])
                                ->update($d);
                        }
                    }

                    if (!empty($insert_array)) {
                        foreach ($insert_array as $i => $d) {
                            \DB::table('shift_detail')
                                ->insert($insert_array);
                        }
                    }

                    $deleted_array = array_diff($old_array, $form_array);
                    // dd($deleted_array);
                    if (!empty($deleted_array)) {
                        foreach ($deleted_array as $d) {
                            $del_id = $d;
                            $deleted_record[] = DB::table('shift_detail')
                                ->where('id', $del_id)
                                ->where('shift_masterid', $id)
                                ->where('orgid', $this->orgid)
                                ->select('id', 'shift_masterid')
                                ->first();
                        }
                        // dd($deleted_record);
                        if (!empty($deleted_record)) {
                            foreach ($deleted_record as $i => $d) {
                                // dd($id);
                                $id = $d->id;
                                save_log('shift_detail', 'id', $id, false, 'Delete');
                                DB::table('shift_detail')->where('id', $id)->delete();
                            }
                        }
                    }
                    \DB::commit();
                    return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!', 200]);
                }

                // print_r($shiftdetail);
                // die();
            } else {
                $refno = $this->max_refno();
                $shiftMaster = array(
                    'gen_type' => $gen_type,
                    'refno' => $refno,
                    'empid' => $empid,
                    'designation_id' => $desgid,
                    'remarks' => $shift_remarks,
                    // 'quota' => $quota,
                    'status' => 'O',
                    'postdatead' => $this->curdate_en,
                    'postdatebs' => $this->curdate_np,
                    'posttime' => date('h:i:s'),
                    'postmac' => $this->mac,
                    'postip' => $this->ip,
                    'postby' => $this->userid,
                    'orgid' => $this->orgid,
                    'locationid' => $this->locationid,
                );
                // dd($shiftMaster);
                $shiftdetail = array();
                if (!empty($shiftMaster)) {
                    $insertId = \DB::table('shift_master')->insertGetId($shiftMaster);
                    if (!empty($insertId)) {
                        foreach ($startdate as $ksd => $st) {
                            $shiftdetail[] = array(
                                'shift_masterid' => $insertId,
                                'empid'         => $empid,
                                'designation_id' => $desgid,
                                'department_id' => $depid,
                                'startdatead' => !empty($startdate[$ksd]) ? $startdate[$ksd] : '',
                                'startdatebs' => '',
                                'start_time' => !empty($starttime[$ksd]) ? $starttime[$ksd] : '',
                                'enddatead' => !empty($enddate[$ksd]) ? $enddate[$ksd] : '',
                                'enddatebs' => '',
                                'end_time' => !empty($endtime[$ksd]) ? $endtime[$ksd] : '',
                                'total_hrs' => !empty($totalhrs[$ksd]) ? $totalhrs[$ksd] : '',
                                'place' => !empty($place[$ksd]) ? $place[$ksd] : '',
                                'remarks' => !empty($remarks[$ksd]) ? $remarks[$ksd] : '',
                                'status' => 'O',
                                'postdatead' => $this->curdate_en,
                                'postdatebs' => $this->curdate_np,
                                'posttime' => date('h:i:s'),
                                'postmac' => $this->mac,
                                'postip' => $this->ip,
                                'postby' => $this->userid,
                                'orgid' => $this->orgid,
                                'locationid' => $this->locationid
                            );
                        }
                    }
                    if (!empty($shiftdetail)) {
                        \DB::table('shift_detail')->insert($shiftdetail);

                        \DB::commit();
                        return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!', 200]);
                    }
                }
                // print_r($shiftdetail);
                // die();
            }
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    public function save_employee_roster_bulk(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die();
        // dd('test');
        try {
            \DB::beginTransaction();
            $id = $request->get('shift_masterid');
            $sdid = $request->get('sdid');
            $empid = $request->get('empid');
            $shift_remarks = $request->get('shift_remarks');
            $depid = $request->get('depid');
            $desgid = $request->get('desgid');
            $gen_type = $request->get('gen_type');
            $refno = $request->get('refno');
            $startdate = $request->get('startdate');
            $starttime = $request->get('starttime');
            $enddate = $request->get('enddate');
            $endtime = $request->get('endtime');
            $totalhrs = $request->get('totalhrs');
            // dd($startdate);
            $place = $request->get('place');
            $remarks = $request->get('remarks');
            $quota = $request->get('quota');

            $validator = Validator::make($request->all(), [
                'empid' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
            }
            // dd($empid, $depid);
            if ($id) {
                $update_master_arr = array(
                    'remarks' => $shift_remarks,
                    'status' => 'O',
                    'modifydatead' => $this->curdate_en,
                    'modifydatebs' => $this->curdate_np,
                    'modifytime' => date('h:i:s'),
                    'modifymac' => $this->mac,
                    'modifyip' => $this->ip,
                    'modifyby' => $this->userid,
                );
                // dd($update_master_arr);
                if (!empty($update_master_arr)) {
                    $update_master = \DB::table('shift_master')
                        ->where('id', $id)
                        ->update($update_master_arr);
                    if (!empty($update_master)) {
                        $form_array = array();
                        foreach ($startdate as $ksd => $st) {
                            $form_array[] = $sdid[$ksd];
                            $update_array[] = array(
                                'empid' => !empty($empid[$ksd]) ? $empid[$ksd] : '',
                                'department_id' => !empty($depid[$ksd]) ? $depid[$ksd] : '',
                                'startdatead' => !empty($startdate[$ksd]) ? $startdate[$ksd] : '',
                                'startdatebs' => '',
                                'start_time' => !empty($starttime[$ksd]) ? $starttime[$ksd] : '',
                                'enddatead' => !empty($enddate[$ksd]) ? $enddate[$ksd] : '',
                                'enddatebs' => '',
                                'end_time' => !empty($endtime[$ksd]) ? $endtime[$ksd] : '',
                                'total_hrs' => !empty($totalhrs[$ksd]) ? $totalhrs[$ksd] : '',
                                'place' => !empty($place[$ksd]) ? $place[$ksd] : '',
                                'remarks' => !empty($remarks[$ksd]) ? $remarks[$ksd] : '',
                                'status' => 'O',
                                'modifydatead' => $this->curdate_en,
                                'modifydatebs' => $this->curdate_np,
                                'modifytime' => date('h:i:s'),
                                'modifymac' => $this->mac,
                                'modifyip' => $this->ip,
                                'modifyby' => $this->userid,
                            );
                        }
                    }

                    $db_old_shift_det = DB::table('shift_detail')
                        ->where('shift_masterid', $id)
                        ->where('orgid', $this->orgid)
                        ->get();

                    $old_array = array();
                    if (!empty($db_old_shift_det)) {
                        foreach ($db_old_shift_det as $d) {
                            $old_array[] = $d->id;
                        }
                    }
                    // dd($form_array);
                    $deleted_array = array_diff($old_array, $form_array);
                    // dd($deleted_array);

                    if (!empty($deleted_array)) {
                        foreach ($deleted_array as $d) {
                            $del_id = $d;
                            $deleted_record[] = DB::table('shift_detail')
                                ->where('id', $del_id)
                                ->where('shift_masterid', $id)
                                ->where('orgid', $this->orgid)
                                ->select('id', 'shift_masterid')
                                ->first();
                        }
                        // dd($deleted_record);
                        if (!empty($deleted_record)) {
                            foreach ($deleted_record as $i => $d) {
                                // dd($id);
                                $id = $d->id;
                                save_log('shift_detail', 'id', $id, false, 'Delete');
                                DB::table('shift_detail')->where('id', $id)->delete();
                            }
                        }
                    }

                    if (!empty($update_array)) {
                        foreach ($update_array as $i => $d) {
                            \DB::table('shift_detail')
                                ->where('shift_masterid', $id)
                                ->where('id', $sdid[$i])
                                ->update($d);
                        }
                    }
                    \DB::commit();
                    return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!', 200]);
                }

                // print_r($shiftdetail);
                // die();
            } else {
                $refno = $this->max_refno();
                $shiftMaster = array(
                    'gen_type' => $gen_type,
                    'refno' => $refno,
                    'designation_id' => $desgid,
                    'remarks' => $shift_remarks,
                    // 'quota' => $quota,
                    'status' => 'O',
                    'postdatead' => $this->curdate_en,
                    'postdatebs' => $this->curdate_np,
                    'posttime' => date('h:i:s'),
                    'postmac' => $this->mac,
                    'postip' => $this->ip,
                    'postby' => $this->userid,
                    'orgid' => $this->orgid,
                    'locationid' => $this->locationid,
                );
                // dd($shiftMaster);
                $shiftdetail = array();
                if (!empty($shiftMaster)) {
                    $insertId = \DB::table('shift_master')->insertGetId($shiftMaster);
                    if (!empty($insertId)) {
                        foreach ($startdate as $ksd => $st) {
                            $shiftdetail[] = array(
                                'shift_masterid' => $insertId,
                                'empid'         => $empid[$ksd],
                                'department_id' => $depid[$ksd],
                                'startdatead' => !empty($startdate[$ksd]) ? $startdate[$ksd] : '',
                                'startdatebs' => '',
                                'start_time' => !empty($starttime[$ksd]) ? $starttime[$ksd] : '',
                                'enddatead' => !empty($enddate[$ksd]) ? $enddate[$ksd] : '',
                                'enddatebs' => '',
                                'end_time' => !empty($endtime[$ksd]) ? $endtime[$ksd] : '',
                                'total_hrs' => !empty($totalhrs[$ksd]) ? $totalhrs[$ksd] : '',
                                'place' => !empty($place[$ksd]) ? $place[$ksd] : '',
                                'remarks' => !empty($remarks[$ksd]) ? $remarks[$ksd] : '',
                                'status' => 'O',
                                'postdatead' => $this->curdate_en,
                                'postdatebs' => $this->curdate_np,
                                'posttime' => date('h:i:s'),
                                'postmac' => $this->mac,
                                'postip' => $this->ip,
                                'postby' => $this->userid,
                                'orgid' => $this->orgid,
                                'locationid' => $this->locationid
                            );
                        }
                    }
                    if (!empty($shiftdetail)) {
                        \DB::table('shift_detail')->insert($shiftdetail);

                        \DB::commit();
                        return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!', 200]);
                    }
                }
                // print_r($shiftdetail);
                // die();
            }
        } catch (\Exception $e) {
            \DB::rollback();
            return response()->json(['status' => 'error', 'message' => $e->getMessage()], 400);
        }
    }

    public function save_roster_employeless(Request $request)
    {
        try {
            $gen_type = $request->get('gen_type');
            $id = $request->get('shift_masterid');
            // $sdid = $request->get('sdid');
            $designationid = $request->get('designationid');
            $refno = $request->get('refno');
            $startdate = $request->get('startdate');
            $starttime = $request->get('starttime');
            $enddate = $request->get('enddate');
            $endtime = $request->get('endtime');
            $totalhrs = $request->get('total_hrs');
            $place = $request->get('place');

            // $shift_remarks = $request->get('shift_remarks');
            $remarks = $request->get('shift_remarks');
            // dd($quota);
            if (empty($designationid)) {
                return response()->json(['status' => 'error', 'message' => 'Designation cannot be empty!']);
            }
            // dd($id);
            // print_r($sdid);
            // die();
            DB::beginTransaction();

            if ($id) {
                $update_master_arr = array(
                    'modifydatead' => $this->curdate_en,
                    'modifydatebs' => $this->curdate_np,
                    'modifytime' => date('h:i:s'),
                    'modifymac' => $this->mac,
                    'modifyip' => $this->ip,
                    'modifyby' => $this->userid,
                );
                if (!empty($update_master_arr)) {
                    $update_master = \DB::table('shift_master')
                        ->where('id', $id)
                        ->update($update_master_arr);
                    if ($update_master) {
                        $detail_update_arr = array(
                            'designation_id' => $designationid,
                            'startdatead' => !empty($startdate) ? $startdate : '',
                            'startdatebs' => '',
                            'start_time' => !empty($starttime) ? $starttime : '',
                            'enddatead' => !empty($enddate) ? $enddate : '',
                            'enddatebs' => '',
                            'end_time' => !empty($endtime) ? $endtime : '',
                            'total_hrs' => !empty($totalhrs) ? $totalhrs : '',
                            'place' => !empty($place) ? $place : '',
                            'remarks' => !empty($remarks) ? $remarks : '',
                            'status' => 'O',
                            'modifydatead' => $this->curdate_en,
                            'modifydatebs' => $this->curdate_np,
                            'modifytime' => date('h:i:s'),
                            'modifymac' => $this->mac,
                            'modifyip' => $this->ip,
                            'modifyby' => $this->userid,
                        );
                    }
                }
                if (!empty($detail_update_arr)) {
                    \DB::table('shift_detail')
                        ->where('shift_masterid', $id)
                        ->update($detail_update_arr);
                    \DB::commit();
                    return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!', 200]);
                }
            } else {
                $refno = $this->max_refno();
                $shift_master_arr = array(
                    'gen_type' => $gen_type,
                    'refno' => $refno,
                    'designation_id' => $designationid,
                    'remarks' => $remarks,
                    'status' => 'O',
                    'postdatead' => $this->curdate_en,
                    'postdatebs' => $this->curdate_np,
                    'posttime' => date('h:i:s'),
                    'postmac' => $this->mac,
                    'postip' => $this->ip,
                    'postby' => $this->userid,
                    'orgid' => $this->orgid,
                    'locationid' => $this->locationid,

                );
                // dd($shift_master_arr);
                // print_r($startdate);
                // die();
                $shiftdetail = array();
                if (!empty($shift_master_arr)) {
                    $insertId = \DB::table('shift_master')->insertGetId($shift_master_arr);
                    // dd($insertId);
                    if (!empty($insertId)) {
                        // foreach ($startdate as $ksd => $st) {
                        //     $shiftdetail[] = array(
                        //         'shift_masterid' => $insertId,
                        //         'designation_id' => $designationid,
                        //         'startdatead' => !empty($startdate[$ksd]) ? $startdate[$ksd] : '',
                        //         'startdatebs' => '',
                        //         'start_time' => !empty($starttime[$ksd]) ? $starttime[$ksd] : '',
                        //         'enddatead' => !empty($enddate[$ksd]) ? $enddate[$ksd] : '',
                        //         'enddatebs' => '',
                        //         'end_time' => !empty($endtime[$ksd]) ? $endtime[$ksd] : '',
                        //         'total_hrs' => !empty($totalhrs[$ksd]) ? $totalhrs[$ksd] : '',
                        //         'place' => !empty($place[$ksd]) ? $place[$ksd] : '',
                        //         'remarks' => !empty($remarks[$ksd]) ? $remarks[$ksd] : '',
                        //         'status' => 'O',
                        //         'postdatead' => $this->curdate_en,
                        //         'postdatebs' => $this->curdate_np,
                        //         'posttime' => date('h:i:s'),
                        //         'postmac' => $this->mac,
                        //         'postip' => $this->ip,
                        //         'postby' => $this->userid,
                        //         'orgid' => $this->orgid,
                        //         'locationid' => $this->locationid,


                        //     );
                        // }
                        $shiftdetail = array(
                            'shift_masterid' => $insertId,
                            'designation_id' => $designationid,
                            'startdatead' => !empty($startdate) ? $startdate : '',
                            'startdatebs' => '',
                            'start_time' => !empty($starttime) ? $starttime : '',
                            'enddatead' => !empty($enddate) ? $enddate : '',
                            'enddatebs' => '',
                            'end_time' => !empty($endtime) ? $endtime : '',
                            'total_hrs' => !empty($totalhrs) ? $totalhrs : '',
                            'place' => !empty($place) ? $place : '',
                            'remarks' => !empty($remarks) ? $remarks : '',
                            'status' => 'O',
                            'postdatead' => $this->curdate_en,
                            'postdatebs' => $this->curdate_np,
                            'posttime' => date('h:i:s'),
                            'postmac' => $this->mac,
                            'postip' => $this->ip,
                            'postby' => $this->userid,
                            'orgid' => $this->orgid,
                            'locationid' => $this->locationid,


                        );
                        if (!empty($shiftdetail)) {
                            \DB::table('shift_detail')->insert($shiftdetail);
                            \DB::commit();
                            return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!', 200]);
                        }
                    }
                }
            }
        } catch (\Throwable $th) {
            \DB::rollback();
            return response()->json(['status' => 'error', 'message' => $th->getMessage()], 400);
        }
    }

    public function max_refno()
    {
        $refdata = \DB::table('shift_master')
            ->select('refno')
            ->where('orgid', $this->orgid)
            ->where('locationid', $this->locationid)
            ->orderBy('refno', 'DESC')
            ->first();
        if (!empty($refdata)) {
            $refno = $refdata->refno + 1;
        } else {
            $refno = 1;
        }
        return $refno;
    }

    public function get_total_hours(Request $request)
    {
        //new code
        $start_time = Carbon::parse($request->start_date . ' ' . $request->start_time);
        $end_time = Carbon::parse($request->end_date . ' ' . $request->end_time);
        // $start_date = $request->start_date;
        // $end_date = $request->end_date;

        // dd($start_time, $end_time, $start_date, $end_date);
        //original
        // $start_time = $request->start_time;
        // $end_time = $request->end_time;

        // dd($start_time, $end_time);
        try {
            // $hour = abs($start_time - $end_time) / (60 * 60);
            $hour = $end_time->diff($start_time);
            // dd($hour);
            $time = $hour->format('%H:%I:%S');

            return response()->json(['status' => 'success', 'time' => $time]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th]);
        }
    }

    /************************ Roster Report ***************************/
    public function generate_roster_report(Request $request, $print = 'N')
    {
        $designationid = $request->designationid;
        $departmentid = $request->departmentid;
        $employeeid = $request->employeeid;
        $date_type = $request->date_type;
        $from_date = $request->fromdate;
        $to_date = $request->todate;
        $report_wise = $request->report_wise;
        $report_type = $request->report_type;
        $template = '';
        if ($this->location_ismain == 'Y' && in_array($this->groupcode, [1])) {
            $locationid = $request->locationid ?? '';
        } else {
            $locationid = $this->locationid;
        }

        $print_template = '<div class="float-right print_btn">
        <a href="javascript:void(0)" class="btn btn-sm btn-danger btn_generate_pdf " data-href="/api/roster/download_roster_pdf" data-formid="rosterReportForm" title="PDF"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
        <a href="javascript:void(0)" class="btn btn-sm btn-success btn_generate_pdf " data-href="/api/roster/download_roster_excel" data-formid="rosterReportForm" title="Excel"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
        <a href="javascript:void(0)" class="btn btn-sm btn-primary btn_print" data-tabtype="printrpt" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a></div>';

        if ($report_wise == "employee") {
            if ($report_type == 'summary') {

                $report = DB::table('shift_master as sm')
                    ->join('shift_detail as sd', 'sd.shift_masterid', '=', 'sm.id')
                    ->join('employees as e', 'e.id', '=', 'sd.empid')
                    ->leftJoin('department as dep', 'dep.id', '=', 'e.department_id')
                    ->leftJoin('designation as deg', 'deg.id', '=', 'e.designation_id')
                    ->where('sm.status', 'O')
                    ->where('sd.status', 'O')
                    ->when($locationid, function ($query) use ($locationid) {
                        return $query->where('sm.locationid', $locationid);
                    })
                    ->when($designationid, function ($query) use ($designationid) {
                        return $query->where('e.designation_id', $designationid);
                    })
                    ->when($departmentid, function ($query) use ($departmentid) {
                        return $query->where('e.department_id', $departmentid);
                    })
                    ->when($employeeid, function ($query) use ($employeeid) {
                        return $query->where('e.id', $employeeid);
                    })->when($date_type == 'range', function ($query) use ($from_date, $to_date) {
                        return $query->where('sd.startdatead', '>=', $from_date)->where('sd.enddatead', '<=', $to_date);
                    })->select('e.id', 'e.empcode', 'e.first_name', 'e.last_name', 'e.middle_name', 'dep.depcode', 'dep.depname', 'deg.designation_name', 'deg.designation_code')
                    ->selectRaw("GROUP_CONCAT(total_hrs) as work_hours")
                    ->groupBy('e.id', 'e.empcode', 'e.first_name', 'e.last_name', 'e.middle_name', 'dep.depcode', 'dep.depname', 'deg.designation_name', 'deg.designation_code')
                    ->get();
                $template = view('Roster.Report.EmployeeSummaryReport', compact('report'))->render();
            } elseif ($report_type == 'detail') {
                $employees = DB::table('shift_detail as sd')
                    ->join('employees as e', 'e.id', '=', 'sd.empid')
                    ->leftJoin('department as dep', 'dep.id', '=', 'e.department_id')
                    ->leftJoin('designation as deg', 'deg.id', '=', 'e.designation_id')
                    ->where('sd.status', 'O')
                    ->when($locationid, function ($query) use ($locationid) {
                        return $query->where('e.locationid', $locationid);
                    })
                    ->when($designationid, function ($query) use ($designationid) {
                        return $query->where('e.designation_id', $designationid);
                    })
                    ->when($departmentid, function ($query) use ($departmentid) {
                        return $query->where('e.department_id', $departmentid);
                    })
                    ->when($employeeid, function ($query) use ($employeeid) {
                        return $query->where('e.id', $employeeid);
                    })->when($date_type == 'range', function ($query) use ($from_date, $to_date) {
                        return $query->where('sd.startdatead', '>=', $from_date)->where('sd.enddatead', '<=', $to_date);
                    })->select('e.id', 'e.empcode', 'e.first_name', 'e.last_name', 'e.middle_name', 'dep.depcode', 'dep.depname', 'deg.designation_name', 'deg.designation_code')->groupBy('e.id', 'e.empcode', 'e.first_name', 'e.last_name', 'e.middle_name', 'dep.depcode', 'dep.depname', 'deg.designation_name', 'deg.designation_code')->get();

                if (!$employees->isEmpty()) {
                    foreach ($employees as $key => $employee) {
                        $report[$key]['code'] = $employee->empcode;
                        $report[$key]['name'] = $employee->first_name . ' ' . $employee->middle_name . ' ' . $employee->last_name;
                        $report[$key]['department'] = $employee->depname;
                        $report[$key]['designation'] = $employee->designation_name;
                        $report[$key]['details'] = DB::table('shift_master as sm')->join('shift_detail as sd', 'sd.shift_masterid', '=', 'sm.id')->select('sm.id as master_id', 'sm.refno', 'sm.remarks as master_remarks', 'sd.id as detail_id', 'sd.startdatead', 'sd.start_time', 'sd.enddatead', 'sd.end_time', 'sd.total_hrs', 'sd.place', 'sd.remarks as detail_remarks', 'sd.work_status', 'sd.complete_date', 'sd.complete_time', 'sd.checkin_date', 'sd.checkin_time', 'sd.work_details')->when($date_type == 'range', function ($query) use ($from_date, $to_date) {
                            return $query->where('sd.startdatead', '>=', $from_date)->where('sd.enddatead', '<=', $to_date);
                        })->where('sm.status', 'O')->where('sd.status', 'O')->where('sd.empid', $employee->id)->when($locationid, function ($query) use ($locationid) {
                            return $query->where('sm.locationid', $locationid);
                        })->orderBy('sd.startdatead', 'ASC')->get();
                    }
                    $template = view('Roster.Report.EmployeeDetailReport', compact('report'))->render();
                }
            }
        } elseif ($report_wise == "date") {
            if ($report_type == 'summary') {
                $report = DB::table('shift_master as sm')
                    ->join('shift_detail as sd', 'sd.shift_masterid', '=', 'sm.id')
                    ->join('employees as e', 'e.id', '=', 'sd.empid')
                    ->where('sm.status', 'O')
                    ->where('sd.status', 'O')
                    ->when($locationid, function ($query) use ($locationid) {
                        return $query->where('sm.locationid', $locationid);
                    })
                    ->when($designationid, function ($query) use ($designationid) {
                        return $query->where('e.designation_id', $designationid);
                    })
                    ->when($departmentid, function ($query) use ($departmentid) {
                        return $query->where('e.department_id', $departmentid);
                    })
                    ->when($employeeid, function ($query) use ($employeeid) {
                        return $query->where('e.id', $employeeid);
                    })->when($date_type == 'range', function ($query) use ($from_date, $to_date) {
                        return $query->where('sd.startdatead', '>=', $from_date)->where('sd.enddatead', '<=', $to_date);
                    })->select('sd.startdatead')
                    ->selectRaw("GROUP_CONCAT(total_hrs) as work_hours, COUNT(DISTINCT sd.empid) as employees")
                    ->orderBy('sd.startdatead', 'ASC')
                    ->groupBy('sd.startdatead')
                    ->get();
                $template = view('Roster.Report.DateSummaryReport', compact('report'))->render();
            } elseif ($report_type == 'detail') {
                $dates = DB::table('shift_detail as sd')
                    ->where('sd.status', 'O')
                    ->when($date_type == 'range', function ($query) use ($from_date, $to_date) {
                        return $query->where('sd.startdatead', '>=', $from_date)->where('sd.enddatead', '<=', $to_date);
                    })->when($locationid, function ($query) use ($locationid) {
                        return $query->where('sd.locationid', $locationid);
                    })->selectRaw("DISTINCT(startdatead) as date")
                    ->orderBy('sd.startdatead', 'ASC')
                    ->groupBy('sd.startdatead')
                    ->get();

                if (!$dates->isEmpty()) {
                    foreach ($dates as $key => $date) {
                        $report[$key]['date'] = $date->date;
                        $report[$key]['details'] = DB::table('shift_master as sm')
                            ->join('shift_detail as sd', 'sd.shift_masterid', '=', 'sm.id')
                            ->join('employees as e', 'e.id', '=', 'sd.empid')
                            ->leftJoin('department as dep', 'dep.id', '=', 'e.department_id')
                            ->leftJoin('designation as deg', 'deg.id', '=', 'e.designation_id')
                            ->select('e.id as empid', 'e.empcode', 'e.first_name', 'e.last_name', 'e.middle_name', 'dep.depcode', 'dep.depname', 'deg.designation_name', 'deg.designation_code', 'sm.id as master_id', 'sm.refno', 'sm.remarks as master_remarks', 'sd.id as detail_id', 'sd.startdatead', 'sd.start_time', 'sd.enddatead', 'sd.end_time', 'sd.total_hrs', 'sd.place', 'sd.remarks as detail_remarks', 'sd.work_status', 'sd.complete_date', 'sd.complete_time', 'sd.checkin_date', 'sd.checkin_time', 'sd.work_details')
                            ->when($locationid, function ($query) use ($locationid) {
                                return $query->where('sm.locationid', $locationid);
                            })
                            ->when($designationid, function ($query) use ($designationid) {
                                return $query->where('e.designation_id', $designationid);
                            })
                            ->when($departmentid, function ($query) use ($departmentid) {
                                return $query->where('e.department_id', $departmentid);
                            })
                            ->when($employeeid, function ($query) use ($employeeid) {
                                return $query->where('e.id', $employeeid);
                            })->where('sm.status', 'O')->where('sd.status', 'O')->where('sd.startdatead', $date->date)->orderBy('sd.startdatead', 'ASC')->get();
                    }
                    $template = view('Roster.Report.DateDetailReport', compact('report'))->render();
                }
            }
        }

        if ($print == 'Y') {
            return $template;
        }

        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Template generated successfully', 'template' => $print_template . $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Could not generate template']);
        }
    }

    public function get_booked_shift_list(Request $request)
    {
        $gen_type = $request->gen_type;
        $refno = $request->refno;
        $data = RosterMaster::with('details')->where('gen_type', $gen_type)->where('refno', $refno)->first();
        $template = view('Roster.approve_shift_view', compact('data'))->render();
        if (!empty($template)) {
            return response()->json(['status' => 'success', 'message' => 'Template generated successfully', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No Information Found']);
        }
    }

    public function approve_shift(Request $request)
    {
        try {
            $detailid = $request->detailid;
            $empid = $request->empid;
            $bookid = $request->bookid;
            $shift_detail = RosterDetail::where('id', $detailid)->where('empid', $empid)->first();
            if (empty($shift_detail)) {
                return response()->json(['status' => 'error', 'message' => 'Shift Detail Not Found']);
            }
            $shift_detail->empid = null;
            $shift_detail->work_status = 'P';
            $shift_detail->save();
            // $book_detail = RosterBook::find($bookid);
            // $book_detail->status = 'A'; 
            // $book_detail->save();

            // RosterDetail::where('id', $detailid)->update(['empid' => $empid]);
            RosterMaster::where('id', $shift_detail->shift_masterid)->update(['empid' => null]);
            return response()->json(['status' => 'success', 'message' => 'Booking Cancelled Successfully']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function download_roster_pdf(Request $request)
    {
        $request->request->add(Input::all());
        $page_orientation = Input::get('page_orientation');
        $template = $this->generate_roster_report($request, 'Y');
        $page_layout = 'A4-P';
        $title = "Roster Report";
        if ($page_orientation == 'L') {
            $page_layout = 'A4-L';
        }
        General::get_pdf($template, $title, $page_layout);
    }

    public function download_roster_excel(Request $request)
    {
        $request->request->add(Input::all());
        $page_orientation = Input::get('page_orientation');
        $template = $this->generate_roster_report($request, 'Y');
        $page_layout = 'A4-P';
        $title = "Roster Report";
        if ($page_orientation == 'L') {
            $page_layout = 'A4-L';
        }
        General::get_excel($template, $title, $page_layout);
    }


    public function employee_roster_list(Request $request)
    {
        $data = RosterMaster::employee_roster_list($request);
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $key => $row) {
            $work_status = $row->work_status;
            $type = $row->gen_type;
            if ($work_status == 'P') {
                $cur_status = 'Pending';
                $status_color = '#fffa6f';
            } elseif ($work_status == 'V') {
                $cur_status = 'Needs Verification';
                $status_color = '#20a8d8';
            } elseif ($work_status == 'CO') {
                $cur_status = 'Completed';
                $status_color = '#4dbd74';
            } elseif ($work_status == 'C') {
                $cur_status = 'Cancelled';
                $status_color = '#f86c6b';
            } else {
                $cur_status = 'NA';
                $status_color = '#fff';
            }

            if ($type == 'S') {
                $roster_type = 'Single';
            } elseif ($type == 'B') {
                $roster_type = 'Bulk';
            } elseif ($type == 'E') {
                $roster_type = 'Employeeless';
            } else {
                $roster_type = '';
            }

            $array[$key]['id'] = $row->id;
            $array[$key]['refno'] = $row->refno;
            $array[$key]['type'] = $roster_type;
            $array[$key]['empcode'] = $row->empcode;
            $array[$key]['full_name'] = $row->full_name;
            $array[$key]['department'] = $row->department;
            $array[$key]['designation'] = $row->designation;
            $array[$key]['start_date'] = $row->startdatead;
            $array[$key]['start_time'] = $row->start_time;
            $array[$key]['end_date'] = $row->enddatead;
            $array[$key]['end_time'] = $row->end_time;
            $array[$key]['duration'] = $row->total_hrs;
            $array[$key]['place'] = $row->place;
            $array[$key]['remarks'] = $row->remarks;
            $array[$key]['checkin'] = "$row->checkin_date<br>$row->checkin_time";
            $array[$key]['checkout'] = "$row->complete_date<br>$row->complete_time";
            $array[$key]['work_details'] = $row->work_details;
            $array[$key]['status'] = $cur_status;
            $array[$key]['status_color'] = $status_color;
            $array[$key]['action'] = "";
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function change_status(Request $request)
    {
        $status = $request->status_id;
        $ids = $request->shift_detail_ids;
        if (!empty($ids) && count($ids) > 0 && RosterDetail::whereIn('id', $ids)->update(['work_status' => $status])) {
            return response()->json(['status' => 'success', 'message' => 'Status Changed Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Error Changing Status']);
    }
}