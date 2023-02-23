<?php

namespace App\Http\Controllers\Api\Employee;

use App\Helpers\General;
use App\Jobs\SendEmailJob;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Employee\Employee;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function __construct()
    {
        if (Auth::check()) {
            $this->locationid = auth()->user()->locationid;
            $this->orgid = auth()->user()->orgid;
            $this->empid = auth()->user()->empid;
            $this->userid = auth()->user()->id;
            $this->groupcode = auth()->user()->group_id;
        } else {
            $this->orgid = session('ORGANIZATION_ID', '');
            $this->locationid = session('LOCATION_ID', '');
            $this->empid = session('EMPLOYEE_ID', '');
            $this->userid = session('USER_ID', '');
            $this->groupcode = session('USERGROUP_ID', '');
        }

        $this->location_ismain = session()->get('MAIN_LOCATION');
        $this->postdatead = CURDATE_EN;
        $this->postdatebs = EngToNepDateConv(CURDATE_EN);
        $this->postip = get_real_ipaddr();
        $this->postmac = get_Mac_Address();
        $this->default_datepicker = get_constant_value("DEFAULT_DATEPICKER");
    }

    public function general_data()
    {
        $employee_status = Input::get('status', '');
        $locationid = $this->locationid;
        $dep_list = \DB::table('department')
            ->where(array('isactive' => 'Y', 'locationid' => $locationid))
            ->where('orgid', $this->orgid)
            ->select('id', 'depcode', 'depname')
            ->orderBy('depname', 'ASC')
            ->get();
        $designation_list = \DB::table('designation')
            ->where('orgid', $this->orgid)
            ->where(array('isactive' => 'Y'))
            ->select('id', 'designation_code', 'designation_name')
            ->orderBy('designation_name', 'ASC')
            ->get();
        $martial_list = \DB::table('martial_status')
            ->where('orgid', $this->orgid)
            ->where(array('isactive' => 'Y'))
            ->select('id', 'mast_name', 'mast_namenp')
            ->orderBy('mast_name', 'ASC')
            ->get();
        $employee_type_list = \DB::table('employee_type')
            ->where('orgid', $this->orgid)
            ->where(array('isactive' => 'Y'))
            ->select('id', 'employee_type')
            ->orderBy('employee_type', 'ASC')
            ->get();
        $employee_list = \DB::table('employees')
            ->where('orgid', $this->orgid)
            ->where(array('locationid' => $locationid))
            ->when($employee_status, function ($query, $employee_status) {
                return $query->where('status', $employee_status);
            })
            ->select(\DB::raw("CONCAT(empcode,' | ',first_name,' ',IFNULL(middle_name,''),' ',last_name) AS full_name"), 'id', 'empcode')->orderBy('first_name', 'ASC')
            ->get();

        $location_query = \DB::table('location')->where('orgid', $this->orgid)->select('id', 'loccode', 'locname')->where('isactive', 'Y');
        if ($this->location_ismain != 'Y' && !in_array($this->groupcode, [1])) {
            $location_query->where('id', $this->locationid);
        }
        $location_list = $location_query->get();

        $user_location = $this->locationid;


        return response()->json([
            'status' => 'success',
            'dep_list' => $dep_list,
            'designation_list' => $designation_list,
            'martial_list' => $martial_list,
            'employee_type_list' => $employee_type_list,
            'employee_list' => $employee_list,
            'location_list' => $location_list,
            'user_location' => $user_location,
        ]);
    }


    public function get_employee(Request $request)
    {
        if ($this->location_ismain == 'Y' && in_array($this->groupcode, [1])) {
            $locationid = $request->locationid ?? '';
        } else {
            $locationid = $this->locationid;
        }
        $designationId = $request->designationid;
        $departmentId = $request->departmentid;
        $status = $request->status;
        $employee_list = Employee::where('orgid', $this->orgid)
            ->when($locationid, function ($query, $locationid) {
                return $query->where('locationid', $locationid);
            })
            ->when($departmentId, function ($query, $departmentId) {
                return $query->where('department_id', $departmentId);
            })
            ->when($designationId, function ($query, $designationId) {
                return $query->where('designation_id', $designationId);
            })
            ->when($status, function ($query, $status) {
                return $query->where('status', $status);
            })
            // ->when($status == 'inactive', function ($query) {
            //     return $query->where('status', 'N');
            // })
            ->select('id', 'empcode')
            ->selectRaw("CONCAT(empcode,' | ',first_name,' ',IFNULL(middle_name,''),' ',IFNULL(last_name,'')) AS full_name")
            ->orderBy('first_name', 'ASC')
            ->get();
        if ($employee_list) {
            return response()->json(['status' => 'success', 'employee_list' => $employee_list, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Fetch']);
        }
    }

    public function formData()
    {
        try {
            $data['employee_code'] = Employee::generateEmployeeCode();
            $data['gender'] = DB::table('gender')->select('id', 'gend_name')->where('isactive', 'Y')->get();
            $data['blood_group'] = DB::table('blood_group')->select('id', 'blgr_name as blood_group')->where('isactive', 'Y')->get();
            $data['department'] = DB::table('department')->select('id', 'depname')->where('isactive', 'Y')->get();
            $data['designation'] = DB::table('designation')->select('id', 'designation_name')->where('isactive', 'Y')->get();
            $data['employee_type'] = DB::table('employee_type')->select('id', 'employee_type')->where('isactive', 'Y')->get();
            $data['employee_list'] = Employee::where('status', 'Y')->select('id', 'empcode')->selectRaw("CONCAT(empcode,' | ',first_name,' ',IFNULL(middle_name,''),' ',last_name) as full_name")->where('isactive', 'Y')->get();
            $data['location'] = DB::table('location')->select('id', 'loccode', 'locname')->where('isactive', 'Y')->get();
            return response()->json(['status' => 'success', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function get_loc_emp_code(Request $request, $code = false)
    {
        try {
            $locationid = $request->get('locationid');
            $loc_code = DB::table('location')
                ->where('id', $locationid)
                ->where('isactive', 'Y')
                ->where('orgid', $this->orgid)
                ->value('loccode');
            $empcode = DB::table('employees')
                ->where('locationid', $locationid)
                ->orderBy('empcode', 'DESC')
                ->value('empcode');
            $loc_data['loc_code'] = '';
            $loc_data['emp_code'] = '0001';
            if ($loc_code) {
                $emp_code = !empty($empcode) ? intval(str_replace($loc_code . '-', '', $empcode)) + 1 : '1';
                $emp_code = str_pad($emp_code, 4, '0', STR_PAD_LEFT);
                $loc_data['loc_code'] = $loc_code;
                $loc_data['emp_code'] = $emp_code;
            }

            if ($code) {
                if (!empty($loc_data['loc_code'])) {
                    return $loc_data['loc_code'] . '-' . $loc_data['emp_code'];
                } else {
                    return $loc_data['emp_code'];
                }
            }

            return response()->json(['status' => 'success', 'loc_data' => $loc_data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function store(Request $request)
    {
        try {
            $id = $request->id;
            $email_rule = 'required|email|unique:employees,email|max:100';
            if ($id) {
                $email_rule = ['required', 'email', 'max:100', Rule::unique('employees')->ignore($id)];
            }
            $validation = Validator::make($request->all(), [
                'first_name' => 'required|alpha|max:50',
                'last_name' => 'required|alpha|max:50',
                'email' => $email_rule,
                'gender_id' => 'required',
                'locationid' => 'required',
                'empcode' => 'required'
            ]);

            if ($validation->fails()) {
                return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
            }

            $input = $request->except('birth_date', 'empcode', 'id', 'same_address');
            $locationid = $request->locationid;
            $birth_date = $request->birth_date;
            if ($birth_date) {
                if ($this->default_datepicker == 'EN') {
                    $input['birth_datead'] = $birth_date;
                    $input['birth_datebs'] = EngToNepDateConv($birth_date);
                } else {
                    $input['birth_datead'] = NepToEngDateConv($birth_date);
                    $input['birth_datebs'] = $birth_date;
                }
            }
            if ($id) {
                $trans = check_permission('Update');
                if ($trans == 'error') {
                    permission_message();
                    exit;
                }
                $employee = Employee::where('id', $id)->first();
                if ($locationid != $employee->locationid) {
                    $input['empcode'] = $this->get_loc_emp_code($request, true);
                }

                $input['modifyip'] = $this->postip;
                $input['modifymac'] = $this->postmac;
                $input['modifydatead'] = $this->postdatead;
                $input['modifydatebs'] = $this->postdatebs;
                $input['modifytime'] = date('H:i:s');
                $input['modifyby'] = $this->userid;
                if (Employee::where('id', $id)->update($input)) {
                    return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!!']);
                }
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            } else {
                $trans = check_permission('Insert');
                if ($trans == 'error') {
                    permission_message();
                    exit;
                }
                $password = generate_random_string(10);
                $input['token'] = Str::uuid();
                $input['password'] = Hash::make($password);
                $input['emp_first_password'] = $password;
                $input['postip'] = $this->postip;
                $input['postmac'] = $this->postmac;
                $input['postdatead'] = $this->postdatead;
                $input['postdatebs'] = $this->postdatebs;
                $input['posttime'] = date('H:i:s');
                // $input['locationid'] = $this->locationid; //inserted from employee form 
                $input['orgid'] = $this->orgid;
                $input['postby'] = $this->userid;
                $input['empcode'] = $this->get_loc_emp_code($request, true);
                if (Employee::create($input)) {

                    //Send Email To New Employee With Password
                    // $emailDetails = [
                    //     'values' => array(
                    //         'USERNAME' => $input['first_name'] . ' ' . $input['middle_name'] . ' ' . $input['last_name'],
                    //         'PASSWORD' => $password
                    //     ),
                    //     'email_template' => 'user_registration',
                    //     'email_to' => $input['email']
                    // ];
                    // dispatch(new SendEmailJob($emailDetails));
                    $parseValues = array(
                        'USERNAME' => $input['first_name'] . ' ' . $input['middle_name'] . ' ' . $input['last_name'],
                        'PASSWORD' => $password
                    );
                    $mail_message = sendMail($parseValues, "user_registration", $input['email']);
                    return response()->json(['status' => 'success', 'message' => 'Record Created Successfully, Employee Temporary Password is' . $password . ' !!']);
                }
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function view(Request $request)
    {
        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->id;
        $employee = Employee::find($id);
        $view = view("Employee.view")
            ->with('employee', $employee);
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function edit(Request $request)
    {
        $trans = check_permission('Update');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->id;
        $employee = Employee::find($id);
        if ($employee) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'employee' => $employee]);
        }
        return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
    }

    public function employee_resign(Request $request)
    {
        // dd($id);
        $id = $request->get('id');
        // dd($id);
        try {
            DB::beginTransaction();
            $input['isactive'] = "N";
            $input['status'] = "N";
            $update = Employee::where('id', $id)
                ->update($input);
            DB::commit();
            return response()->json(['status' => 'success', 'message' => 'Resignation successful']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function datatableList(Request $request)
    {
        $data = Employee::getDatatableList($request);
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $key => $row) {
            $curstatus = $row->status;
            if ($curstatus == 'Y') {
                $cur_status = 'Current';
            } else {
                $cur_status = 'Resigned';
            }

            $array[$key]['id'] = $row->id;
            $array[$key]['empcode'] = $row->empcode;
            $array[$key]['full_name'] = $row->employee_name;
            $array[$key]['gend_name'] = $row->gend_name;
            $array[$key]['depname'] = $row->depname;
            $array[$key]['designation_name'] = $row->designation_name;
            $array[$key]['mobile'] = $row->mobile1;
            $array[$key]['email'] = $row->email;
            $array[$key]['emp_type'] = $row->employee_type;
            $array[$key]['status'] = $cur_status;
            $array[$key]['cstatus'] = $curstatus;
            // dd($cur_status);
            if ($cur_status == 'Current') {
                $array[$key]['action'] = '<a href="/badministrator/employee?id=' . $row->id . '" ><i class="fa fa-edit"></i></a>
                &nbsp
                <a href="javascript:void(0)" class="view" data-url="/api/employee/view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
                &nbsp
                <a href= "javascript:void(0)" id = "emp_resgn_btn" data-id =' . $row->id . '>Resign</a>';
            } else {
                $array[$key]['action'] = ' <a href="javascript:void(0)" class="view" data-url="/api/employee/view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
                &nbsp';
            }
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function get_employee_data_pdf(Request $request)
    {
        ini_set('memory_limit', '256M');
        $data = Employee::getDatatableList($request);
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);
        $view = view("Employee/employee_list_pdf")
            ->with('data', $data);
        $html = $view->render();
        $title = 'Employee_List';
        $page_layout = 'A4-P';
        General::get_pdf($html, $title, $page_layout);
    }

    public function get_employee_data_excel(Request $request)
    {
        ini_set('memory_limit', '256M');
        $data = Employee::getDatatableList($request);
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);
        $view = view("Employee/employee_list_pdf")
            ->with('data', $data);
        $html = $view->render();
        $title = 'Employee_List';
        $page_layout = 'A4-P';
        General::get_excel($html, $title, $page_layout);
    }

    public function get_employee_data_word(Request $request)
    {
        ini_set('memory_limit', '256M');
        $data = Employee::getDatatableList($request);
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);
        $view = view("Employee/employee_list_pdf")
            ->with('data', $data);
        $html = $view->render();
        $title = 'Employee_List';
        $page_layout = 'A4-P';
        General::get_word($html, $title, $page_layout);
    }
}