<?php

namespace App\Http\Controllers\Api\State;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\State\State;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class StateController extends Controller
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

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|max:10',
            'name' => 'required|string|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('id', 'isactive');
        $id = $request->id;
        $input['isactive'] = $request->isactive ?? 'N';
        if ($id) {
            $trans = check_permission('Update');

            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $data = State::find($id);

            $input['updated_at'] = datetime();
            $input['modifydatead'] = $this->postdatead;
            $input['modifydatebs'] = $this->postdatebs;
            $input['modifyip'] = $this->postip;
            $input['modifymac'] = $this->postmac;
            $input['modifyby'] = $this->userid;
            save_log('state', 'id', $id, $input, 'Update');
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
            $input['postdatead'] = $this->postdatead;
            $input['postdatebs'] = $this->postdatebs;
            $input['postip'] = $this->postip;
            $input['postmac'] = $this->postmac;
            $input['postby'] = $this->userid;
            if (State::create($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function list()
    {
        $data = State::get_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $i => $row) {
            $array[$i]['id'] = $row->id;
            $array[$i]['code'] = $row->code;
            $array[$i]['name'] = $row->name;
            $array[$i]['isactive'] = $row->isactive == 'Y' ? 'Yes' : 'No';
            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/state_setup/edit" data-id=' . $row->id . ' data-targetForm="stateSetupForm"><i class="fa fa-edit"></i></a>
            &nbsp
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/state_setup/delete" data-id=' . $row->id . ' data-targetForm="stateSetupForm" ><i class="fa fa-trash"></i></a>
            ';
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $data = State::where('id', $id)->first();

        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('state', 'id', $id, false, 'Delete');
        $data = State::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}