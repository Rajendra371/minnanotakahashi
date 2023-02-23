<?php

namespace App\Http\Controllers\Api\Employee;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Employee\Employee;
use App\Models\Roster\RosterBook;
use Illuminate\Support\Facades\DB;
use App\Models\Roster\RosterDetail;
use App\Models\Roster\RosterMaster;
use App\Http\Controllers\Controller;
use App\Models\Employee\EmployeeTraining;
use App\Models\Training\Training;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeePortalController extends Controller
{
    public function __construct()
    {
        $this->postdatead = CURDATE_EN;
        $this->postdatebs = EngToNepDateConv(CURDATE_EN);
        $this->postip = get_real_ipaddr();
        $this->postmac = get_Mac_Address();
        $this->default_datepicker = get_constant_value("DEFAULT_DATEPICKER");
    }

    public function login_view()
    {
        return view('Employee.Portal.login');
    }

    public function login(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);
        if ($validation->fails()) {
            return response()->json(['stauts' => 'error', 'message' => $validation->errors()->all()]);
        }
        $user = Employee::where('email', $request->email)->first();

        if ($user) {
            if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                $user->current_login_date = Carbon::now();
                $user->save();
                return response()->json(['status' => 'success', 'message' => 'Login Successful, Redirecting Shortly ...', 'redirect' => route('dashboard')]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'The provided credentials do not match our records.']);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'The provided credentials do not match our records.']);
    }

    public function dashboard()
    {
        abort_if(!Auth::guard('employee')->check(), 401, 'Unauthorized Access');
        $employee_id =  Auth::guard('employee')->user()->id;
        $date = Carbon::today();
        $first_week_date = $date->startOfWeek()->format('Y/m/d');
        $last_week_date = $date->addWeek(3)->format('Y/m/d');
        $shifts = DB::table('shift_master as sm')->leftJoin('shift_detail as sd', 'sd.shift_masterid', '=', 'sm.id')->where('sm.status', 'O')->where('sd.status', 'O')->where(function ($qry) use ($employee_id) {
            return $qry->where('sm.empid', $employee_id)->orWhere('sd.empid', $employee_id);
        })->whereBetween('sd.startdatead', [$first_week_date, $last_week_date])->select('sm.id as masterid', 'sm.refno', 'sm.gen_type', 'sm.quota', 'sd.id as detailid', 'sd.designation_id', 'sd.department_id', 'sd.startdatead', 'sd.start_time', 'sd.enddatead', 'sd.end_time', 'sd.total_hrs', 'sd.place', 'sd.remarks', 'sd.work_status', 'sd.checkin_date', 'sd.checkin_time', 'sd.complete_date', 'sd.complete_time', 'sd.work_details')->orderBy('sd.startdatead')->get();

        $book_shifts = DB::table('shift_master as sm')->leftJoin('shift_detail as sd', 'sd.shift_masterid', '=', 'sm.id')->where('sm.gen_type', 'E')->whereNull('sd.empid')->where('sm.status', 'O')->where('sm.designation_id', Auth::guard('employee')->user()->designation_id)->whereBetween('sd.startdatead', [$first_week_date, $last_week_date])->select('sm.id as masterid', 'sm.refno', 'sm.gen_type', 'sm.quota', 'sd.id as detailid', 'sd.designation_id', 'sd.department_id', 'sd.startdatead', 'sd.start_time', 'sd.enddatead', 'sd.end_time', 'sd.total_hrs', 'sd.place', 'sd.remarks')->orderBy('sd.startdatead')->get();

        return view('Employee.Portal.dashboard', compact('book_shifts', 'shifts', 'first_week_date', 'last_week_date'));
    }

    public function shift_view(Request $request)
    {
        $detail = DB::table('shift_master as sm')->leftJoin('shift_detail as sd', 'sd.shift_masterid', '=', 'sm.id')->where('sd.id', $request->id)->where('sm.status', 'O')->select('sm.id as masterid', 'sm.refno', 'sm.gen_type', 'sm.quota', 'sd.id as detailid', 'sd.designation_id', 'sd.department_id', 'sd.startdatead', 'sd.start_time', 'sd.enddatead', 'sd.end_time', 'sd.total_hrs', 'sd.place', 'sd.remarks', 'sd.checkin_date', 'sd.checkin_time', 'sd.complete_date', 'sd.complete_time', 'sd.work_details')->first();
        $template = view('Employee.Portal.shift_detail', compact('detail'))->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'title' => 'Shift Detail']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Fetching Template']);
        }
    }

    public function refresh_roster()
    {
        abort_if(!Auth::guard('employee')->check(), 401, 'Unauthorized Access');
        $employee_id = Auth::guard('employee')->user()->id;
        $date = Carbon::today();
        $first_week_date = $date->startOfWeek()->format('Y/m/d');
        $last_week_date = $date->addWeek(3)->format('Y/m/d');
        $shifts =  DB::table('shift_master as sm')->leftJoin('shift_detail as sd', 'sd.shift_masterid', '=', 'sm.id')
            ->where('sm.status', 'O')->where('sd.status', 'O')->where(function ($qry) use ($employee_id) {
                return $qry->where('sm.empid', $employee_id)->orWhere('sd.empid', $employee_id);
            })->whereBetween('sd.startdatead', [$first_week_date, $last_week_date])->select('sm.id as masterid', 'sm.refno', 'sm.gen_type', 'sm.quota', 'sd.id as detailid', 'sd.designation_id', 'sd.department_id', 'sd.startdatead', 'sd.start_time', 'sd.enddatead', 'sd.end_time', 'sd.total_hrs', 'sd.place', 'sd.remarks', 'sd.work_status', 'sd.checkin_date', 'sd.checkin_time', 'sd.complete_date', 'sd.complete_time', 'sd.work_details')->orderBy('sd.startdatead')->get();
        $template = view('Employee.Portal.roster_table', compact('shifts'))->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Fetching Template']);
        }
    }

    public function refresh_book_shifts()
    {
        abort_if(!Auth::guard('employee')->check(), 401, 'Unauthorized Access');
        $date = Carbon::today();
        $first_week_date = $date->startOfWeek()->format('Y/m/d');
        $last_week_date = $date->endOfWeek()->format('Y/m/d');
        $book_shifts = DB::table('shift_master as sm')->leftJoin('shift_detail as sd', 'sd.shift_masterid', '=', 'sm.id')->where('sm.gen_type', 'E')->whereNull('sd.empid')->where('sm.status', 'O')->where('sm.designation_id', Auth::guard('employee')->user()->designation_id)->whereBetween('sd.startdatead', [$first_week_date, $last_week_date])->select('sm.id as masterid', 'sm.refno', 'sm.gen_type', 'sm.quota', 'sd.id as detailid', 'sd.designation_id', 'sd.department_id', 'sd.startdatead', 'sd.start_time', 'sd.enddatead', 'sd.end_time', 'sd.total_hrs', 'sd.place', 'sd.remarks')->orderBy('sd.startdatead')->get();
        // dd($book_shifts);
        $template = view('Employee.Portal.book_shift_table', compact('book_shifts'))->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Fetching Template']);
        }
    }

    public function shift_book(Request $request)
    {
        abort_if(!Auth::guard('employee')->check(), 401, 'Unauthorized Access');
        $employee_id = Auth::guard('employee')->user()->id;
        $shift_detail = RosterDetail::whereNull('empid')->where('id', $request->id)->first();
        if (empty($shift_detail)) {
            return response()->json(['status' => 'error', 'message' => 'Shift is already booked.']);
        }
        $shift_detail->empid = $employee_id;
        if ($shift_detail->save()) {
            return response()->json(['status' => 'success', 'message' => 'Shift booked successfully.']);
        } else {
            return response()->json(['status' => 'success', 'message' => 'Error booking shift.']);
        }

        //if multiple employee can book shift then use this code
        // $booked = RosterBook::where('shift_detailid', $request->id)->where('empid', $employee_id)->where('status', 'P')->count();
        // if ($booked > 0) {
        //     return response()->json(['status' => 'error', 'message' => 'Shift is already booked.']);
        // }
        // $booking_detail = array(
        //     'shift_masterid' => $shift_detail->shift_masterid,
        //     'shift_detailid' => $shift_detail->id,
        //     'empid' => $employee_id,
        //     'status' => 'P',
        //     'work_status' => 'P',
        //     'postdatead' => $this->postdatead,
        //     'postdatebs' => $this->postdatebs,
        //     'posttime' => date('H:i:s'),
        //     'postmac' => $this->postmac,
        //     'postip' => $this->postip,
        //     'postby' => $employee_id,
        //     'orgid' => Auth::guard('employee')->user()->orgid,
        //     'locationid' => Auth::guard('employee')->user()->locationid
        // );
        // $shift_book = new RosterBook();
        // $shift_book->fill($booking_detail);
        // if ($shift_book->save()) {
        //     return response()->json(['status' => 'success', 'message' => 'Shift booked successfully.']);
        // } else {
        //     return response()->json(['status' => 'success', 'message' => 'Error booking shift.']);
        // }
    }

    public function shift_complete_view(Request $request)
    {
        $detail = DB::table('shift_master as sm')->leftJoin('shift_detail as sd', 'sd.shift_masterid', '=', 'sm.id')->where('sd.id', $request->id)->where('sm.status', 'O')->select('sm.id as masterid', 'sm.refno', 'sm.gen_type', 'sm.quota', 'sd.id as detailid', 'sd.designation_id', 'sd.department_id', 'sd.startdatead', 'sd.start_time', 'sd.enddatead', 'sd.end_time', 'sd.total_hrs', 'sd.place', 'sd.remarks', 'sd.checkin_date', 'sd.checkin_time', 'sd.complete_date', 'sd.complete_time', 'sd.work_details')->first();
        $template = view('Employee.Portal.shift_complete_view', compact('detail'))->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'title' => 'Shift Complete']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Fetching Template']);
        }
    }

    public function shift_completed(Request $request)
    {
        abort_if(!Auth::guard('employee')->check(), 401, 'Unauthorized Access');
        $shift_detail = RosterDetail::find($request->id);
        if (empty($request->work_details)) {
            return response()->json(['status' => 'error', 'message' => 'Progress Note field is required.']);
        }
        if (empty($shift_detail)) {
            return response()->json(['status' => 'error', 'message' => 'Cannot Find The Shift Information.']);
        }

        $shift_detail->work_details = $request->work_details;
        $shift_detail->work_status = 'V';
        $shift_detail->complete_date = $this->postdatead;
        $shift_detail->complete_time = date('H:i:s');
        $shift_detail->save();

        return response()->json(['status' => 'success', 'message' => 'Status Changed successfully.', 'redirect' => route('dashboard')]);
    }

    public function shift_clockin(Request $request)
    {
        abort_if(!Auth::guard('employee')->check(), 401, 'Unauthorized Access');
        $shift_detail = RosterDetail::find($request->id);
        if (empty($shift_detail)) {
            return response()->json(['status' => 'error', 'message' => 'Cannot Find The Shift Information.']);
        }
        $shift_detail->checkin_date = $this->postdatead;
        $shift_detail->checkin_time = date('H:i:s');
        $shift_detail->save();
        return response()->json(['status' => 'success', 'message' => 'Successfully Clocked In.']);
    }

    public function logout(Request $request)
    {
        $user = $request->user('employee');
        $user->last_login_date = $user->current_login_date;
        $user->save();
        Auth::guard('employee')->logout();
        if ($request->ajax()) {
            return response()->json(['status' => 'success', 'redirect' => route('home')]);
        }
        return redirect()->route('home');
    }

    public function change_password_view()
    {
        return view('Employee.Portal.change_password');
    }

    public function change_password(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);
        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
        }
        $user = $request->user('employee');
        if (Hash::check($request->old_password, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->last_login_date = $user->current_login_date;
            $user->save();
            Auth::guard('employee')->logout();
            return response()->json(['status' => 'success', 'message' => 'Password Changed Successfully, Logging Out', 'redirect' => route('login')]);
        }
        return response()->json(['status' => 'error', 'message' => 'Sorry, The Old Password Is Incorrect']);
    }

    public function forgot_password_view()
    {
        return view('Employee.Portal.forgot_password');
    }

    public function forgot_password(Request $request)
    {
        $email = $request->email;
        if (!$email) {
            return response()->json(['status' => 'error', 'message' => "Please enter your email address."]);
        }
        $employee = Employee::where('email', $email)->first();
        if (!empty($employee)) {
            $db_email = $employee->email;
            $otp_code = strtoupper(generate_random_string(10));
            $input['email'] = $db_email;
            $input['token'] = $otp_code;
            $input['created_at'] = Carbon::now()->addMinutes(30);
            DB::table('password_resets')->insert($input);
            $parseValues = array(
                'USERNAME' => $employee->first_name . ' ' . $employee->last_name,
                'RESET_CODE' => $otp_code,
            );
            $mail_message = sendMail($parseValues, "password_reset", $db_email);
            Session::put('password_reset_email', $db_email);
            return response()->json(['status' => 'success', 'message' => $mail_message, 'redirect' => route('verify-reset-code')]);
        } else {
            return response()->json(['status' => 'error', 'message' => "Sorry the email does not exists"]);
        }
    }

    public function verify_reset_code_view()
    {
        if (Session::has('password_reset_email')) {
            return view('Employee.Portal.verify_reset_code');
        }
        return redirect()->route('home');
    }

    public function verify_reset_code(Request $request)
    {
        if (Session::has('password_reset_email')) {
            $validation = Validator::make($request->all(), [
                'reset_code' => 'required',
            ]);
            if ($validation->fails()) {
                return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
            }
            $reset_code = $request->reset_code;
            $email = Session::get('password_reset_email');

            $db_data =  DB::table('password_resets')->where('email', $email)->orderBy('id', 'desc')->first();
            if (!empty($db_data)) {
                $db_code = $db_data->token;
                $db_expires_at = $db_data->created_at;
                $current_time = Carbon::now();
                $expires = Carbon::parse($db_expires_at);
                if ($current_time->lt($expires)) {
                    if ($reset_code == $db_code) {
                        return response()->json(['status' => 'success', 'message' => 'Verification Success!!', 'redirect' => route('new_password')]);
                    } else {
                        return response()->json(['status' => 'error', 'message' => 'Invalid Code!!']);
                    }
                } else {
                    return response()->json(['status' => 'error', 'message' => 'The Code Has Expired!!']);
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'Sorry The Email Does Not  Exist']);
            }
        }
        return redirect()->route('home');
    }


    public function new_password_view()
    {
        if (Session::has('password_reset_email')) {
            return view('Employee.Portal.new_password');
        }
        return redirect()->route('home');
    }

    public function new_password(Request $request)
    {
        if (Session::has('password_reset_email')) {
            $validation = Validator::make($request->all(), [
                'password' => 'required|min:8|confirmed',
            ]);
            if ($validation->fails()) {
                return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
            }

            $password = $request->password;
            $email = Session::get('password_reset_email');
            $employee = Employee::where('email', $email)->first();
            if (!empty($employee)) {
                Session::forget('password_reset_email');
                $employee->password = Hash::make($password);
                if ($employee->save()) {
                    return response()->json(['status' => 'success', 'message' => 'Your Password Has Been Changed', 'redirect' => route('login')]);
                } else {
                    return response()->json(['status' => 'error', 'message' => 'Error Changing Password, Please Try Again']);
                }
            } else {
                return response()->json(['status' => 'error', 'message' => 'Sorry The Email Does Not Exists']);
            }
        }
        return redirect()->route('home');
    }

    public function trainings()
    {
        $trainings = Training::where('is_active', 'Y')->where('designation_id', Auth::guard('employee')->user()->designation_id)->orderBy('order')->get();
        $employee_trainings = EmployeeTraining::where('employee_id', Auth::guard('employee')->user()->id)->pluck('training_id')->toArray();
        // dd($employee_trainings);
        return view('Employee.Portal.training', compact('trainings', 'employee_trainings'));
    }

    public function refresh_training()
    {
        $trainings = Training::where('is_active', 'Y')->where('designation_id', Auth::guard('employee')->user()->designation_id)->orderBy('order')->get();
        $employee_trainings = EmployeeTraining::where('employee_id', Auth::guard('employee')->user()->id)->pluck('training_id')->toArray();
        $template = view('Employee.Portal.training_table_body', compact('trainings', 'employee_trainings'))->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Fetching Template']);
        }
    }

    public function save_trainings(Request $request)
    {
        try {
            $validation = Validator::make($request->all(), [
                'ids.*' => 'required',
                'files.*' => 'required|file|max:5120' 
            ]);
            if ($validation->fails()) {
                return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
            }

            $ids = $request->ids;
            $files = [];
            if ($request->hasFile('files')) {
                $files = $request->file('files');
            }
            $employee = Auth::guard('employee')->user();
            foreach ($ids as $key => $id) {
                $file = $files[$key];
                $filename = rand() . time() . '.' . $file->getClientOriginalExtension();
                $file->move(('uploads/employee_training/'), $filename);
                $employee->trainings()->attach($id, ['attachment' => $filename]);
            }
            return response()->json(['status' => 'success', 'message' => 'Selected Trainings Added']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful']);
        }
    }
}