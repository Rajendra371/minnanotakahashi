<?php

namespace App\Http\Controllers\Api\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Employee\EmployeeType;
use Illuminate\Support\Facades\Validator;


class EmployeeTypeController extends Controller
{
    public function __construct()
    {
        $this->userid = auth()->user()->id;
        $this->locationid = auth()->user()->locationid;
        $this->orgid = auth()->user()->orgid;
        $this->curdate_en = CURDATE_EN;
        $this->curdate_np = EngToNepDateConv(CURDATE_EN);
        $this->ip = get_real_ipaddr();
        $this->mac = get_Mac_Address();
    }

    public function index()
    {
        $data = EmployeeType::where('orgid', '=', $this->orgid)->get();
        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Fetched Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_type' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('id', 'isactive');
        $id = $request->id;
        // $isactive = $request->isactive; 
        // $input['isactive'] = !empty($isactive) ? $isactive : "N";

        $isactive = !empty($request->get('isactive')) ? 'Y' : 'N';

        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $data = EmployeeType::where('id', $id)->where('orgid', $this->orgid)->first();

            $input['modifydatead'] = $this->curdate_en;
            $input['modifydatebs'] = $this->curdate_np;
            $input['modifytime'] = date('H:i:s');
            $input['modifyip'] = $this->ip;
            $input['modifymac'] = $this->mac;
            $input['modifyby'] = $this->userid;
            $input['isactive'] = $isactive;

            save_log('employee_type', 'id', $id, $input, 'Update');
            if ($data->update($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } else {
            $trans = check_permission('Insert');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $input['postip'] = $this->ip;
            $input['postmac'] = $this->mac;
            $input['postby'] = $this->userid;
            $input['postdatead'] = $this->curdate_en;
            $input['postdatebs'] = $this->curdate_np;
            $input['posttime'] = date('H:i:s');
            $input['locationid'] = $this->locationid;
            $input['orgid'] = $this->orgid;
            $input['isactive'] = $isactive;

            if ($data = EmployeeType::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function edit(Request $request)
    {
        //  echo "<pre>";
        // print_r($request->all());
        // die();
        $id = $request->get('id');
        $data = EmployeeType::where(['id' => $id, 'locationid' => $this->locationid, 'orgid' => $this->orgid])->select('id', 'employee_type', 'isactive')->first();
        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function destroy(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        save_log('employee_type', 'id', $id, false, 'Delete');
        $data = EmployeeType::where(['id' => $id, 'locationid' => $this->locationid, 'orgid' => $this->orgid])->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function getTableData(Request $request)
    {
        $page_size = $request->get('pageSize');
        $page = $request->get('page');
        $sorted = $request->get('sorted');
        $filtered = $request->get('filtered');

        $data = EmployeeType::getTableData($page_size, $page, $sorted, $filtered);

        return response()->json($data);
    }
}