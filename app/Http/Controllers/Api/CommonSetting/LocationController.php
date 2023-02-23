<?php

namespace App\Http\Controllers\Api\CommonSetting;

use DB;
use Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\CommonSetting\Location;


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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Location::all();
        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Fetched Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'loccode' => 'required',
            'locname' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->all();
        $id = $request->get('id');
        $is_main = $request->ismain ?? 'N';
        if ($id) {
            $data = Location::find($id);
            $input['isactive'] = $request->isactive ?? 'N';
            $input['ismain'] = $is_main;
            $input['updated_at'] = datetime();
            $input['modifydatead'] = $this->postdatead;
            $input['modifydatebs'] = $this->postdatebs;
            $input['modifyip'] = get_real_ipaddr();
            $input['modifymac'] = get_Mac_Address();
            $input['modifyby'] = auth()->user()->id;
            if ($data->update($input)) {
                if ($is_main == 'Y') {
                    Location::where('id', '!=', $id)->update(['ismain' => 'N']);
                }
                return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } else {
            $input['postdatead'] = $this->postdatead;
            $input['postdatebs'] = $this->postdatebs;
            $input['postip'] = $this->postip;
            $input['postmac'] = $this->postmac;
            $input['orgid'] = $this->orgid;
            if ($data = Location::create($input)) {
                if ($is_main == 'Y') {
                    Location::where('id', '!=', $data->id)->update(['ismain' => 'N']);
                }
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $id = $request->get('id');
        $data = Location::where('id', $id)->first();
        if ($data) {
            return $data; //response()->json(['status'=>'success','message'=>'Record Deleted Successfully!!']);
        } else {
            return false;
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $id = $request->get('id');
        $data = Location::where('id', $id)->delete();
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

        $data = Location::getTableData($page_size, $page, $sorted, $filtered);

        return response()->json($data);
    }
}