<?php

namespace App\Http\Controllers\Api\GeneralSetting;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\GeneralSetting\EmailIntegration;
use App\Models\GeneralSetting\EmailTemplate;

class EmailIntegrationController extends Controller
{
    public function index()
    {
        $data['protocol'] = DB::table('email_protocol_type')->where(['isactive' => 'Y'])->get();
        $data['encryption'] = DB::table('email_encryption_type')->where(['isactive' => 'Y'])->get();
        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Added Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }



    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mail_from_name' => 'required|string|max:50',
            'mail_from_address' => 'required|string|max:50',
            'smtp_port' => 'required|string|max:50',
            'smtp_user' => 'required|string|max:50',
            'smtp_host' => 'required|string|max:60',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('is_active');
        $id = $request->get('id');
        $input['is_active'] = $request->get('is_active', 'N');
        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $data = EmailIntegration::where('id', $id)->first();
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            save_log('email_configuration', 'id', $id, $input, 'Update');
            if ($data->update($input)) {
                if ($input['is_active'] == 'Y') {
                    EmailIntegration::where('id', '!=', $id)->update(['is_active' => 'N']);
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
            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');
            $input['postby'] = $postby;
            if ($data = EmailIntegration::forceCreate($input)) {
                if ($input['is_active'] == 'Y') {
                    EmailIntegration::where('id', '!=', $data->id)->update(['is_active' => 'N']);
                }
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function emailintegration_list(Request $request)
    {

        $data = EmailIntegration::get_emailintegration_list();

        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {
            $array[$i]['id'] = $row->id;
            $array[$i]['company_email'] = $row->mail_from_address;
            $array[$i]['email_protocol_typeid'] = $row->protocal_name;
            $array[$i]['smtp_host'] = $row->smtp_host;
            $array[$i]['smtp_user'] =  $row->smtp_user;
            $array[$i]['smtp_port'] = $row->smtp_port;
            $array[$i]['email_encryption_typeid'] = $row->encryption_name;
            $array[$i]['is_active'] = $row->is_active;

            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/emailintegration/emailintegration_edit" data-id=' . $row->id . ' data-targetForm="emailForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            &nbsp
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/emailintegration/emailintegration_delete" data-id=' . $row->id . ' data-targetForm="emailForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function emailintegration_edit(Request $request)
    {

        $id = $request->get('id');
        $protocol = DB::table('email_protocol_type')->where(['isactive' => 'Y'])->get();
        $encryption = DB::table('email_encryption_type')->where(['isactive' => 'Y'])->get();
        $data = DB::table('email_configuration')->where('id', $id)->first();
        // dd($data);
        $view = view("GeneralSetting/EmailIntegration")
            ->with('data', $data)->with('protocol', $protocol)->with('encryption', $encryption);
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function emailintegration_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('email_configuration', 'id', $id, false, 'Delete');
        $data = EmailIntegration::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function template_data()
    {
        $data = DB::table('email_template')->where('is_active', 'Y')->get();
        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data, 'message' => 'Success!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function email_template_store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'id' => 'required',
            'subject' => 'required|string|max:50',
            'body' => 'required'
        ]);
        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
        }
        $input = $request->all();
        $id = $request->get('id');

        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();
        $trans = check_permission('Update');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $data = EmailTemplate::where('id', $id)->first();
        $input['updated_at'] = datetime();
        $input['modifyip'] = $postip;
        $input['modifymac'] = $postmac;
        $input['modifyby'] = $postby;
        $input['modifydatead'] = $postdatead;
        $input['modifydatebs'] = $postdatebs;
        $input['modifytime'] = date('H:i:s');
        dump($input);
        dd($data);
        save_log('email_template', 'id', $id, $input, 'Update');
        if ($data->update($input)) {
            return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}