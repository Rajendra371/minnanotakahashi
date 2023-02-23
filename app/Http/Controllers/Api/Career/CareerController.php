<?php

namespace App\Http\Controllers\Api\Career;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Career\Career;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;


class CareerController extends Controller
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

    public function get_form(Request $request)
    {
        $id = $request->get('id') ?? '';

        $data['gender'] = DB::table('gender')
            ->where('isactive', 'Y')
            ->get();
        $data['jobcode'] = Career::generateJobCode();
        $data['currency'] = DB::table('currency')
            ->select('id', 'currency_code', 'currency', 'symbol')
            ->where('isactive', 'Y')
            ->get();
        $data['job_level'] = DB::table('job_level')
            ->select('id', 'title')
            ->where('isactive', 'Y')
            ->get();

        if ($id) {
            $data['jobdata'] = Career::where('id', $id)
                ->first();
            $data['jobcode'] = $data['jobdata']->jobcode;
        }
        $view = view("Career.CareerForm")
            ->with('data', $data);
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'View rendered successfull', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation unsuccessful']);
        }
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $messages = [
                'currency_id.required_if' => 'The currency field is required when the salary is fixed or in range',
                'salary_unit.required_if' => 'The salary unit field is required when the salary is fixed or in range',
                'minsalary.required_if' => 'The minimum salary field is required when the salary is fixed or in range',
                'maxsalary.required_if' => 'The maximum salary field is required when the salary is in range',
            ];
            $validation = Validator::make($request->all(), [
                'job_title' => 'required|string|max:250',
                'position' => 'required|string|max:100',
                'no_of_vacancy' => 'required|numeric',
                'job_description' => 'required',
                'job_specification' => 'required',
                'experience_type' => 'required',
                'salary_type' => 'required',
                'currency_id' => 'required_if:salary_type,F,R',
                'salary_unit' => 'required_if:salary_type,F,R',
                'minsalary' => 'required_if:salary_type,F,R',
                'maxsalary' => 'required_if:salary_type,R',
                'apply_before' => 'required|date_format:Y/m/d|after:today',
            ], $messages);

            if ($validation->fails()) {
                return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
            }
            $input = $request->all();
            $id = $request->get('id');
            if ($id) {
                $trans = check_permission('Update');
                if ($trans == 'error') {
                    permission_message();
                    exit;
                }
                $input['modifyip'] = $this->postip;
                $input['modifymac'] = $this->postmac;
                $input['modifydatead'] = $this->postdatead;
                $input['modifydatebs'] = $this->postdatebs;
                $input['modifytime'] = date('H:i:s');
                $input['modifyby'] = $this->userid;
                Career::where('id', $id)->update($input);
                DB::commit();
                return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!!']);
            } else {
                $trans = check_permission('Insert');
                if ($trans == 'error') {
                    permission_message();
                    exit;
                }
                $input['postip'] = $this->postip;
                $input['postmac'] = $this->postmac;
                $input['postdatead'] = $this->postdatead;
                $input['postdatebs'] = $this->postdatebs;
                $input['posttime'] = date('H:i:s');
                $input['locationid'] = $this->locationid;
                $input['orgid'] = $this->orgid;
                $input['postby'] = $this->userid;
                $create = Career::create($input);
                if ($create) {
                    DB::commit();
                    return response()->json(['status' => 'success', 'message' => 'Record Created Successfully']);
                }
            }
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function list(Request $request)
    {
        $data = Career::get_career_list($request);
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $key => $row) {
            $curstatus = $row->is_publish;
            if ($curstatus == 'Y') {
                $cur_status = 'Unpublish';
            } else {
                $cur_status = 'Publish';
            }
            $array[$key]['id'] = $row->id;
            $array[$key]['jobcode'] = $row->jobcode;
            $array[$key]['job_title'] = $row->job_title;
            $array[$key]['purpose'] = $row->purpose;
            $array[$key]['apply_before'] = $row->apply_before;
            $array[$key]['no_of_vacancy'] = $row->no_of_vacancy;
            $array[$key]['experience_type'] = $row->experience_type;
            $array[$key]['start_date'] = $row->start_date;
            $array[$key]['end_date'] = $row->end_date;
            $array[$key]['driving_license'] = $row->driving_license == "Y" ? "Yes" : "No";
            $array[$key]['salary_type'] = $row->salary_type == "F" ? "Fixed" : "Negotiable";
            $array[$key]['gender'] = $row->gender;
            $array[$key]['apply_online'] = $row->apply_online == "Y" ? "Yes" : "No";
            $array[$key]['apply_direct'] = $row->apply_direct == "Y" ? "Yes" : "No";
            $array[$key]['action'] = '<a href = "/badministrator/career_setup?id=' . $row->id . '" data-id =' . $row->id . '><i class = "fa fa-edit"></i></a> &nbsp;';
            $array[$key]['action'] .= '<a href = "javascript:void(0)" id = "publish_job" data-id =' . $row->id . '>' . $cur_status . '</a>';
            $array[$key]['curstatus']  = $curstatus;
            // if($row->is_publish == "Y"){
            //     $array[$key]['action'] .= '<a href = "javascript:void(0)" id = "publish_job" data-id ='.$row->id.'>Unpublish</a>';
            // }
            // else{
            //     $array[$key]['action'] .= '<a href = "javascript:void(0)" id = "publish_job" data-id ='.$row->id.'>Publish</a>';

            // }
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function publish_job(Request $request)
    {
        try {
            DB::beginTransaction();
            $id = $request->get('id');
            $publish = Career::select('is_publish')
                ->where('id', $id)
                ->first();
            if ($publish->is_publish == "Y") {
                $input['is_publish'] = "N";
            } else {
                $input['is_publish'] = "Y";
            }
            Career::where('id', $id)
                ->update($input);
            DB::commit();
            return response()->json(['status'  => 'success', 'message' => 'Operation succesful']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}