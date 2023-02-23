<?php

namespace App\Http\Controllers\Api\Settings;

use Illuminate\Http\Request;
use App\Models\Settings\UserGroup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class UserGroupController extends Controller
{
    public function index()
    {
        $orgid = auth()->user()->orgid;
        $data = UserGroup::get()->where('orgid', $orgid);
        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Deleted Successfully!!']);
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
            'groupname' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('id', 'isactive');
        $id = $request->id;
        $input['isactive'] = $request->isactive ?? 'N';
        $softwareid = auth()->user()->softwareid;
        $createdby = auth()->user()->id;
        $orgid = auth()->user()->orgid;
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }

            $data = UserGroup::where('id', $id)->first();
            $input['updated_at'] = datetime();
            $input['updatedip'] = get_real_ipaddr();
            $input['updatedmac'] = get_Mac_Address();
            $input['updatedby'] = $createdby;
            save_log('usergroup', 'id', $id, $input, 'Update');
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

            $input['createdip'] = get_real_ipaddr();
            $input['createdmac'] = get_Mac_Address();
            $input['softwareid'] = $softwareid;
            $input['createdby'] = $createdby;
            $input['orgid'] = $orgid;
            if ($data = UserGroup::create($input)) {
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
        $trans = check_permission('Update');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        $data = UserGroup::where('id', $id)->first();
        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('usergroup', 'id', $id, false, 'Delete');
        $data = UserGroup::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function getTableData(Request $request)
    {
        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $page_size = $request->get('pageSize');
        $page = $request->get('page');
        $sorted = $request->get('sorted');
        $filtered = $request->get('filtered');

        $data = UserGroup::getTableData($page_size, $page, $sorted, $filtered);

        return response()->json($data);
    }

    public function view(Request $request)
    {
        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $vdata = DB::table('usergroup as u')
            ->where('u.id', $id)
            ->first();
        $view = view('Settings.UserGroup')
            ->with('vdata', $vdata);
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}