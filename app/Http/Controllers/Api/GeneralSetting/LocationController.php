<?php

namespace App\Http\Controllers\Api\GeneralSetting;

use DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\GeneralSetting\Location;


class LocationController extends Controller
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

    public function index()
    {
        $data['district'] = DB::table('districts')->get();
        // echo "<pre>";
        // print_r( $data['district']);
        // die();


        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Added Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }


    public function store(Request $request)
    {
        $id = $request->id;
        $code_rule = 'required|string|unique:location,loccode|max:5';
        if ($id) {
            $code_rule = ['required', 'string', 'max:5', Rule::unique('location')->ignore($id)];
        }
        $messages = [
            'loccode.required' => 'The location code is required.',
            'loccode.unique' => 'The location code has already been taken.',
            'loccode.max' => 'The location code may not be greater than :max characters.',
        ];
        $validator = Validator::make($request->all(), [
            'loccode' => $code_rule,
            'locname' => 'required',
        ], $messages);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->all();
        $is_main = $request->ismain ?? 'N';
        if ($id) {
            $trans = check_permission('Update');

            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $data = Location::find($id);
            $input['isactive'] = $request->isactive ?? 'N';
            $input['ismain'] = $is_main;
            $input['updated_at'] = datetime();
            $input['modifydatead'] = $this->postdatead;
            $input['modifydatebs'] = $this->postdatebs;
            $input['modifyip'] = get_real_ipaddr();
            $input['modifymac'] = get_Mac_Address();
            $input['modifyby'] = auth()->user()->id;
            save_log('location', 'id', $id, $input, 'Update');
            if ($data->update($input)) {
                if ($is_main == 'Y') {
                    Location::where('id', '!=', $id)->update(['ismain' => 'N']);
                }
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

            $input['isactive'] = $request->isactive ?? 'N';
            $input['ismain'] = $is_main;
            $input['postdatead'] = $this->postdatead;
            $input['postdatebs'] = $this->postdatebs;
            $input['postip'] = $this->postip;
            $input['postmac'] = $this->postmac;
            $input['orgid'] = $this->orgid;
            if ($new = Location::create($input)) {
                if ($is_main == 'Y') {
                    Location::where('id', '!=', $new->id)->update(['ismain' => 'N']);
                }
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }


    public function location_list()
    {
        $data = Location::get_location_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {
            $array[$i]['id'] = $row->id;
            $array[$i]['loccode'] = $row->loccode;
            $array[$i]['locname'] = $row->locname;
            $array[$i]['ismain'] = $row->ismain == 'Y' ? 'Yes' : 'No';
            $array[$i]['isactive'] = $row->isactive == 'Y' ? 'Yes' : 'No';
            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/location/location_edit" data-id=' . $row->id . ' data-targetForm="locationForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            &nbsp
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/location/location_delete" data-id=' . $row->id . ' data-targetForm="locationForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';
            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function location_edit(Request $request)
    {
        $id = $request->get('id');
        $data = Location::where('id', $id)->first();

        $view = view("GeneralSetting/Location")
            ->with('data', $data);
        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function location_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('location', 'id', $id, false, 'Delete');
        $data = Location::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}