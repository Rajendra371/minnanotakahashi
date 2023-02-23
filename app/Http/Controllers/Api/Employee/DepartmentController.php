<?php

namespace App\Http\Controllers\Api\Employee;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Employee\Department;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DepartmentController extends Controller
{
    public function __construct()
    {
        if (Auth::check()) {
            $this->locationid = auth()->user()->locationid;
            $this->orgid = auth()->user()->orgid;
            $this->empid = auth()->user()->empid;
            $this->userid = auth()->user()->id;
        } else {
            $this->orgid = session('ORGANIZATION_ID', '');
            $this->locationid = session('LOCATION_ID', '');
            $this->empid = session('EMPLOYEE_ID', '');
            $this->userid = session('USER_ID', '');
        }

        $this->postdatead = CURDATE_EN;
        $this->postdatebs = EngToNepDateConv(CURDATE_EN);
        $this->postip = get_real_ipaddr();
        $this->postmac = get_Mac_Address();
        $this->default_datepicker = get_constant_value("DEFAULT_DATEPICKER");
    }

    public function formData(Request $request)
    {
        $data['department'] = Department::where('isactive', 'Y')->get();
        $data['location'] = DB::table('location')
            ->select('locname', 'id')
            ->where('isactive', 'Y')
            ->get();
        return response()->json(['status' => 'success', 'message' => 'Record fetched successfully', 'data' => $data]);
    }

    public function list(Request $request)
    {
        $page_size = $request->get('pageSize');
        $page = $request->get('page');
        $sorted = $request->get('sorted');
        $filtered = $request->get('filtered');

        $data = Department::getDepList($page_size, $page, $sorted, $filtered);

        return response()->json($data);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'depname' => 'required',
            'depcode' => 'required',
            // 'locname' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->all();
        // dd($input);
        $id = $request->get('id');
        $isactive = !empty($request->get('isactive')) ? 'Y' : 'N';
        // dd($input);

        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $data = Department::where('id', $id)->where('orgid', $this->orgid)->first();

            $input['modifyip'] = $this->postip;
            $input['modifymac'] = $this->postmac;
            $input['modifydatead'] = $this->postdatead;
            $input['modifydatebs'] = $this->postdatebs;
            $input['modifytime'] = date('H:i:s');
            $input['modifyby'] = $this->userid;
            $input['isactive'] = $isactive;

            save_log('department', 'id', $id, $input, 'Update');
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

            $input['postip'] = $this->postip;
            $input['postmac'] = $this->postmac;
            $input['postdatead'] = $this->postdatead;
            $input['postdatebs'] = $this->postdatebs;
            $input['posttime'] = date('H:i:s');
            $input['locationid'] = $this->locationid;
            $input['orgid'] = $this->orgid;
            $input['postby'] = $this->userid;
            $input['isactive'] = $isactive;

            if ($data = Department::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function edit(Request $request)
    {
        $trans = check_permission('Update');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');

        $data = Department::where('id', $id)->where('orgid', $this->orgid)->first();

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
        save_log('department', 'id', $id, false, 'Delete');
        $data = Department::where('id', $id)->where('orgid', $this->orgid)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}