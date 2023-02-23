<?php

namespace App\Http\Controllers\Api\Contact;

use Illuminate\Http\Request;
use App\Models\Contact\Contact;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    public function contact_list()
    {
        $data = Contact::get_contact_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $i => $row) {

            $array[$i]['id'] = $row->id;
            $array[$i]['fullname'] = $row->full_name;
            $array[$i]['email'] = $row->email;
            $array[$i]['contact'] = $row->contact_number;
            $array[$i]['subject'] = $row->subject;
            $array[$i]['message'] = str_limit($row->message, 50);
            $array[$i]['postdatead'] = $row->postdatead . ' ' . $row->posttime;
            $array[$i]['action'] = '
            <a href="javascript:void(0)" class="view" data-url="/api/contact/view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/contact/delete" data-id=' . $row->id . '><i class="fa fa-trash" /></i></a>';
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
        $data = DB::table('contact_us_record as cr')
            ->select('cr.id', 'cr.full_name', 'cr.contact_number', 'cr.email', 'cr.subject', 'cr.message', 'cr.postdatead', 'cr.posttime')
            ->where('cr.id', $request->id)
            ->first();
        $view = view('Contact.view')->with('data', $data);
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
        if (DB::table('contact_us_record')->where('id', $request->id)->delete()) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Error While Deleting Record!!']);
    }
}