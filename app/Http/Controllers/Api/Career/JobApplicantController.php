<?php

namespace App\Http\Controllers\Api\Career;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Career\JobApplicant;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class JobApplicantController extends Controller
{
    public function list(Request $request)
    {
        $data = JobApplicant::get_list($request);
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $key => $row) {

            $array[$key]['id'] = $row->id;
            $array[$key]['jobcode'] = $row->jobcode;
            $array[$key]['job_title'] = $row->job_title;
            $array[$key]['applicant_name'] = $row->full_name;
            $array[$key]['contact_no'] = $row->contact_number;
            $array[$key]['email'] = $row->email;
            $array[$key]['posted_date'] = $row->postdatead;
            $array[$key]['action'] = '<a href="javascript:void(0)" class="view" data-url="/api/job_applicant/view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
            &nbsp<a href="javascript:void(0)" class="btnDelete" data-url="/api/job_applicant/delete" data-id=' . $row->id . '><i class="fa fa-trash" /></i></a>
            &nbsp';
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
        $applicant = DB::table('job_applicant as j')
            ->leftjoin('job_application as ja', 'ja.id', '=', 'j.job_id')
            ->select('j.id', 'ja.job_title', 'ja.jobcode', 'j.full_name', 'j.contact_number', 'j.cv', 'j.cover_letter', 'j.postdatead', 'j.email')->where('j.id', $id)->first();
        $view = view("Career.view_applicant", compact('applicant'));
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->id;
        $applicant = DB::table('job_applicant')->where('id', $id)->first();
        if (DB::table('job_applicant')->where('id', $id)->delete()) {
            if (!empty($applicant->cv) && File::exists(public_path('uploads/job_applicant/' . $applicant->cv))) {
                unlink(public_path('uploads/job_applicant/' . $applicant->cv));
            }
            if (!empty($applicant->cover_letter) && File::exists(public_path('uploads/job_applicant/' . $applicant->cover_letter))) {
                unlink(public_path('uploads/job_applicant/' . $applicant->cover_letter));
            }
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}