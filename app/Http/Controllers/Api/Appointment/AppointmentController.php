<?php

namespace App\Http\Controllers\Api\Appointment;

use Illuminate\Http\Request;
use App\Models\Appointment\Appointment;
use App\Models\Frontend\Home;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AppointmentController extends Controller
{
    public function index()
    {
        $data['branch'] = Home::get_branch_data(array('branch_type' => 1)); 
        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Added Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function appointment_list()
    {
        $data = Appointment::get_appointment_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $i => $row) {

            $array[$i]['id'] = $row->id;
            $array[$i]['full_name'] = $row->full_name;
            $array[$i]['email'] = $row->email;
            $array[$i]['contact_number'] = $row->contact_number;
            $array[$i]['address'] = $row->address;
            $array[$i]['country'] = $row->country;
            $array[$i]['level'] = $row->level;
            $array[$i]['nearest_branch'] = $row->nearest_branch;
            $array[$i]['postdatead'] = $row->postdatead . ' ' . $row->posttime;
            $array[$i]['action'] = '
            <a href="javascript:void(0)" class="view" data-url="/api/appointment/view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/appointment/delete" data-id=' . $row->id . '><i class="fa fa-trash" /></i></a>';
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
        $data = DB::table('appointment as cr')
            ->select('cr.id', 'cr.full_name', 'cr.contact_number', 'cr.country', 'cr.address', 'cr.country', 'cr.level', 'cr.nearest_branch', 'cr.appointmentdate', 'cr.email', 'cr.subject', 'cr.message',  'cr.appointmentdate','cr.posttime','cr.postdatead')
            ->where('cr.id', $request->id)
            ->first();
        $view = view('Appointment.view')->with('data', $data);
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template]);
        }
        return response()->json(['status' => 'error', 'message' => 'Error']);
    }

    public function delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        if (DB::table('appointment')->where('id', $request->id)->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Error While Deleting Record!!']);
    }
}