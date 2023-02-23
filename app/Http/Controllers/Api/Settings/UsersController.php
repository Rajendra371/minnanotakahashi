<?php

namespace App\Http\Controllers\Api\Settings;

use DB;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Validator;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
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
        $id = $request->get('id');
        if ($id) {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'fullname' => 'required',
                'email' => 'required',
                'user_locationid' => 'required',
                'group_id' => 'required',
            ]);
        } else {
            $validator = Validator::make($request->all(), [
                'username' => 'required',
                'fullname' => 'required',
                'email' => 'required',
                'password' => 'required',
                'user_locationid' => 'required',
                'group_id' => 'required',
            ]);
        }


        $pwd = $request->get('password');
        $confirm_pwd = $request->get('confirm_password');
        $softwareid = auth()->user()->softwareid;
        $createdby = auth()->user()->id;
        $orgid = auth()->user()->orgid;

        $input = $request->except('id', 'password', 'confirm_password');
        $input['locationid'] = $input['user_locationid'];

        if ($pwd == $confirm_pwd) {
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
            }

            if ($id) {
                $trans = check_permission('Update');
                if ($trans == 'error') {
                    permission_message();
                    exit;
                }
                $data = User::where('id', $id)->first();
                $input['updated_at'] = datetime();
                $input['updatedip'] = get_real_ipaddr();
                $input['updatedmac'] = get_Mac_Address();
                $input['updatedby'] = $createdby;

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
                $input['password'] = Hash::make($pwd);
                $input['createdip'] = get_real_ipaddr();
                $input['createdby'] = $createdby;
                $input['orgid'] = $orgid;
                $input['softwareid'] = $softwareid;
            }

            if ($data = User::create($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
        return response()->json(['status' => 'error', 'message' => 'Password Didn\'t Match. Please Try Again !!']);
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
        $edittype = $request->get('edittype');
        $data = User::where('id', $id)->first();
        if ($edittype == "template") {
            $orgid = auth()->user()->orgid;
            $data['userdetail'] = $data;
            $data['location'] = DB::table('location')->where(['isactive' => 'Y', 'orgid' => $orgid])->get();
            $data['usergroup'] = DB::table('usergroup')->where(['orgid' => $orgid])->get();
            $data['department'] = DB::table('department')->where(['isactive' => 'Y'])->get();
            $view = view("Settings/Users/MainForm")->with('data', $data);
            $template = $view->render();

            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
            exit;
        }
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
        $data = User::where('id', $id)->delete();
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

        $data = $this->fetchTableData($page_size, $page, $sorted, $filtered);

        return response()->json($data);
    }

    /**Fetching getTableData directly without using Model only here */

    public function fetchTableData($page_size, $page, $sorted, $filtered)
    {
        $orgid = auth()->user()->orgid;
        if ($page == 0) {
            $start_page = 0;
        } else {
            $start_page = ($page * $page_size);
        }

        $query = DB::table('users as u')
            ->leftJoin('usergroup  as g', 'g.id', '=', 'u.group_id')
            ->leftJoin('location  as l', 'l.id', '=', 'u.user_locationid')
            ->where('u.orgid', $orgid)
            ->select('u.*', 'groupname', 'locname');

        $nquery = DB::table('users as u')
            ->leftJoin('usergroup  as g', 'g.id', '=', 'u.group_id')
            ->leftJoin('location  as l', 'l.id', '=', 'u.user_locationid')
            ->where('u.orgid', $orgid)
            ->select('u.*', 'groupname', 'locname');


        if (!empty($start_page)) {
            $query->offset($start_page);
        }

        if ($page_size) {
            $query->limit($page_size);
        }

        if (!empty($filtered)) {
            foreach ($filtered as $filter) {
                $query->where($filter['id'], 'like', "%" . $filter['value'] . "%");

                $nquery->where($filter['id'], 'like', "%" . $filter['value'] . "%");
            }
        }

        if (!empty($sorted)) {
            foreach ($sorted as $sort) {
                $sort_by = $sort['desc'];

                if ($sort_by == true) {
                    $sort_type = 'DESC';
                } else {
                    $sort_type = 'ASC';
                }

                $query->orderBy($sort['id'], $sort_type);

                $nquery->orderBy($sort['id'], $sort_type);
            }
        }

        $data = $query->get();

        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {
            $array[$i]['id'] = $row->id;
            $array[$i]['username'] = $row->username;
            $array[$i]['fullname'] = $row->fullname;
            $array[$i]['email'] = $row->email;
            $array[$i]['groupname'] = $row->groupname;
            $array[$i]['locname'] = $row->locname;
            $array[$i]['created_at'] = $row->created_at;
            $array[$i]['action'] = '<a href="javascript:void(0)">Test</a>';
            $i++;
        }

        $all_filtered_data = $nquery->get();
        $count = count($all_filtered_data);

        $no_of_pages = ceil($count / $page_size);

        return array('rows' => $array, 'pages' => $no_of_pages);
    }


    public function change_password(Request $request)
    {
        $password = $request->get('password');
        $userid = $request->get('userid');
        $createdby = auth()->user()->id;
        $data = User::where('id', $userid)->first();
        if ($password) {

            $input['password'] = bcrypt($password);
            $input['updated_at'] = datetime();
            $input['updatedip'] = get_real_ipaddr();
            $input['updatedmac'] = get_Mac_Address();
            $input['updatedby'] = $createdby;
            save_log('users', 'id', $userid, $input, 'Update');

            if ($data->update($input)) {
                return response()->json(['status' => 'success', 'message' => 'Password Change Successfully!!']);
                exit;
            } else {
                return response()->json(['status' => 'error', 'message' => 'Error Changing Password']);
            }
        } else {
            return response()->json(['status' => 'error', 'field' => 'password', 'message' => 'Password Field is required']);
            exit;
        }
    }

    public function view(Request $request)
    {
        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data =  DB::table('users as u')
            ->leftJoin('usergroup  as g', 'g.id', '=', 'u.group_id')
            ->leftJoin('location  as l', 'l.id', '=', 'u.user_locationid')
            ->select('u.*', 'groupname', 'locname')
            ->where('u.id', $id)->first();
        $view = view('Settings.User')
            ->with('data', $data);
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}