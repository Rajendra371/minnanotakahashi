<?php

namespace App\Http\Controllers\Api\ClientReferral;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Service\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Home\ClientReferral;
use App\Http\Controllers\Controller;
use App\Models\Home\SupportReferral;
use Illuminate\Support\Facades\File;

class ClientReferralController extends Controller
{
    public function list()
    {
        $data = ClientReferral::datatable_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $i => $row) {

            $array[$i]['id'] = $row->id;
            $array[$i]['full_name'] = "$row->first_name $row->middle_name $row->last_name";
            $array[$i]['identity'] = stripos($row->identity_name, 'Other (Please specify)') !== false ? "Other ($row->identity_other)" : $row->identity_name;
            $array[$i]['email'] = $row->email;
            $array[$i]['contact'] = $row->telephone . ',' . $row->mobile;
            $array[$i]['contact_method'] = $row->contact_method;
            $array[$i]['service'] = $row->service_name ?: "Other";
            $array[$i]['status'] = $row->status == "P" ? 'Pending' : 'Seen';
            $array[$i]['action'] = '
            <a href="javascript:void(0)" class="view" data-url="/api/client_referral/view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/client_referral/delete" data-id=' . $row->id . '><i class="fa fa-trash"></i></a>
            ';
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function view(Request $request)
    {
        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->id;
        $data = DB::table('client_referral as cr')->leftJoin('identity as i', 'i.id', '=', 'cr.identity_id')->leftJoin('services as s', 's.id', '=', 'cr.service_id')->select('cr.*', 'i.name as identity_name', 's.service_name')->where('cr.id', $id)->first();
        $view = view('ClientReferral.view')->with('data', $data);
        $template = $view->render();
        if ($template) {
            if ($data->status == 'P') {
                DB::table('client_referral')->where('id', $id)->update(['status' => 'S']);
            }
            return response()->json(['status' => 'success', 'template' => $template]);
        }
        return response()->json(['status' => 'error', 'template' => '', 'message' => 'Data Not Found']);
    }

    public function delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->id;
        $data = ClientReferral::find($id);
        if ($data) {
            if (!empty($data->plan_attachment) && File::exists(public_path('uploads/client_referrals/' . $data->plan_attachment))) {
                unlink(public_path('uploads/client_referrals/' . $data->plan_attachment));
            }
        }
        if ($data->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful']);
    }

    public function evaluation_list()
    {
        $data = ClientReferral::evaluation_datatable_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $i => $row) {
            $services = '';
            if (!empty($row->interested_services)) {
                $services = Service::selectRaw("GROUP_CONCAT(service_name) as services")->whereIn('id', explode(',', $row->interested_services))->value('services');
            }

            $array[$i]['id'] = $row->id;
            $array[$i]['fullname'] = "$row->first_name $row->last_name";
            $array[$i]['email'] = $row->email;
            $array[$i]['postcode'] = $row->postcode;
            $array[$i]['care_for'] = $row->care_for;
            $array[$i]['services'] = Str::limit($services, 300, '...');
            $array[$i]['ndis'] = $row->ndis_registered;
            $array[$i]['duration'] = $row->duration;
            $array[$i]['days'] = $row->days;
            $array[$i]['hours'] = $row->hours;
            $array[$i]['start_period'] = $row->start_period;
            $array[$i]['status'] = $row->status == "P" ? 'Pending' : 'Seen';
            $array[$i]['postdatead'] = $row->postdatead;
            $array[$i]['action'] = '
            <a href="javascript:void(0)" class="view" data-url="/api/quick_evaluation/view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/quick_evaluation/delete" data-id=' . $row->id . '><i class="fa fa-trash"></i></a>
            ';
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function evaluation_view(Request $request)
    {
        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->id;
        $data = DB::table('quick_evaluation as qe')->where('qe.id', $id)->first();
        $view = view('ClientReferral.quick_evaluation_view')->with('data', $data);
        $template = $view->render();
        if ($template) {
            if ($data->status == 'P') {
                DB::table('quick_evaluation')->where('id', $id)->update(['status' => 'S']);
            }
            return response()->json(['status' => 'success', 'template' => $template]);
        }
        return response()->json(['status' => 'error', 'template' => '', 'message' => 'Data Not Found']);
    }

    public function evaluation_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->id;
        if (DB::table('quick_evaluation')->where('id', $id)->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful']);
    }

    public function support_list()
    {
        $data = SupportReferral::support_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $i => $row) {

            $array[$i]['id'] = $row->id;
            $array[$i]['full_name'] = $row->full_name;
            $array[$i]['email'] = $row->email;
            $array[$i]['type'] = $row->type;
            $array[$i]['contact_number'] = $row->contact_number;
            $array[$i]['subject'] = $row->subject;
            $array[$i]['message'] = Str::limit($row->message, 300, '...');
            $array[$i]['status'] = $row->status == "P" ? 'Pending' : 'Seen';
            $array[$i]['postdatead'] = $row->postdatead;
            $array[$i]['action'] = '
            <a href="javascript:void(0)" class="view" data-url="/api/support_referral/view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/support_referral/delete" data-id=' . $row->id . '><i class="fa fa-trash"></i></a>
            ';
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function support_view(Request $request)
    {
        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->id;
        $data = SupportReferral::where('id', $id)->first();
        $view = view('ClientReferral.support_referral_view')->with('data', $data);
        $template = $view->render();
        if ($template) {
            if ($data->status == 'P') {
                $data->status = 'S';
                $data->save();
            }
            return response()->json(['status' => 'success', 'template' => $template]);
        }
        return response()->json(['status' => 'error', 'template' => '', 'message' => 'Data Not Found']);
    }

    public function support_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->id;
        if (SupportReferral::where('id', $id)->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful']);
    }
}