<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Api\Auth\LoginController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer\Customer;
use App\Mail\CustomerRegister;
use Validator;
use App\User;
use Mail;
use DB;
use Carbon\Carbon;



class RegisterController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest');
    }

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'contact' => 'required|numeric',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if($validation->fails()){
            return response()->json(['status'=>'error','message'=>$validation->errors()->all()]);
        }
       
        $input = $request->except('password','password_confirmation');
        $password = $request->get('password');
        $input['password'] = Hash::make($password);
        $email = $input['email'];
        $username = $input['username'];
        $mobile_no = $input['contact'];

        $postdatead=CURDATE_EN;
        $postdatebs=EngToNepDateConv(CURDATE_EN);
        $postip=get_real_ipaddr();
        $postmac=get_Mac_Address();

        $input['createdip']=$postip;
        $input['createdmac']= $postmac;
        $otp_code = strtoupper(generate_random_string(10));

        $input['otp_code'] = $otp_code;
        $input['otp_expires_at'] = Carbon::now()->addHours(24);

        DB::beginTransaction(); 
        $mail_message = '';
        try {
           $user = User::create($input);
            if($user){
                $user_details = array(
                    'userid' => $user->id,
                    'fullname' => $username,
                    'mobile_no' => $mobile_no,
                    'primary_email' => $email,
                    'postip'=> $postip,
                    'postmac'=>  $postmac,
                    'postdatead'=> $postdatead,
                    'postdatebs'=> $postdatebs,
                    'posttime'=> date('H:i:s'),
                );
                Customer::create($user_details);

                $parseValues = array(
                    'USERNAME' => $username,
                    'OTP' => $otp_code,
                    'VERIFYLINK' => url("/api/verify_email/$email/$otp_code")
                );
                $mail_message = sendMail($parseValues,"user_registration",$email); 

                DB::commit();
                return response()->json(['status'=>'success','message'=>['User Registration Successful', $mail_message]]);
            }
        } catch (\Exception $th) {
           DB::rollback();
           return response()->json(['status'=>'error','message'=>[$th->getMessage()]]);
        }
       
    }

    public function resend_verification_code(Request $request)
    {
        $input['email'] = $request->get('email');
        if(Auth::check()){
            $input['email'] = auth()->user()->email;
        }
        $otp_code = strtoupper(generate_random_string(10));
        $input['otp_code'] = $otp_code;
        $input['otp_expires_at'] = Carbon::now()->addHours(24);
        $mail_message='';
        try {
            $user  = Auth::user();
            $user->update($input);

            $parseValues = array(
                'USERNAME' => auth()->user()->username,
                'OTP' => $otp_code,
            );
            $mail_message = sendMail($parseValues,"resend_code",$input['email']);
            return response()->json(['status'=>'success','message'=>$mail_message]);
            
        } catch (\Throwable $th) {
            return response()->json(['status'=>'error','message'=>$mail_message]);
        }
        
    }

    public function verify_email(Request $request)
    {
        $email = $request->get('email');
        $otp_code = $request->get('otp_code');
        $user = Auth::user();
        $db_otp_code = $user->otp_code;
        $expires_at = $user->otp_expires_at;

        $current_time = Carbon::now();
        $expires = Carbon::parse($expires_at);
        if($current_time->lt($expires)){
            if($otp_code == $db_otp_code){
                $user->update(['email_verified_at'=>datetime(), 'is_verified'=>2]);
                $data = LoginController::user_detail('Y');
                return response()->json(['status'=>'success','data'=>$data,'message'=>'Email Verified!!']);
            }else{
                return response()->json(['status'=>'error','message'=>'Invalid Code!!']);
            }
        }else{
            return response()->json(['status'=>'error','message'=>'The Code Has Expired!!']);
        }
    }

    public function reset_user_password(Request $request)
    {
        $email = $request->get('email');
        $check_email = User::where('email',$email)->where('user_type',"CUSTOMER")->first();
        if(!empty($check_email)){
            $db_email = $check_email->email;
            $otp_code = strtoupper(generate_random_string(8));
            $input['email'] =$db_email;
            $input['token'] = $otp_code;
            $input['created_at'] = Carbon::now()->addMinutes(10);
            DB::table('password_resets')->insert($input);
            $parseValues = array(
                'USERNAME' => $check_email->username,
                'RESET_CODE' => $otp_code,
            );
            $mail_message = sendMail($parseValues,"password_reset",$db_email);
            return response()->json(['status'=>'success','message'=>$mail_message]);
        }else{
            return response()->json(['status'=>'error','message'=>"Sorry the email does not exists"]);
        }
    }

    public function submit_reset_code(Request $request)
    {
        $email = $request->get('email');
        $reset_code = $request->get('reset_code');

        $db_data =  DB::table('password_resets')->where('email',$email)->orderBy('id','desc')->first();
        if(!empty($db_data)){
            $db_code = $db_data->token;
            $db_expires_at = $db_data->created_at;
            $current_time = Carbon::now();
            $expires = Carbon::parse($db_expires_at);
            if($current_time->lt($expires)){
                if($reset_code == $db_code){
                    return response()->json(['status'=>'success','message'=>'Verification Success!!']);
                }else{
                    return response()->json(['status'=>'error','message'=>'Invalid Code!!']);
                }
            }else{
                return response()->json(['status'=>'error','message'=>'The Code Has Expired!!']);
            }
        }else{
            return response()->json(['status'=>'error','message'=>'Sorry The Email Does Not  Exist' ]);
        }

    }

    public function user_change_password(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' =>'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if($validation->fails()){
            return response()->json(['status'=>'error','message'=>$validation->errors()->all()]);
        }

        $password = $request->get('password');
        $email = $request->get('email');
        $user = User::where('email',$email)->first();
        if(!empty($user)){
            $new_password = Hash::make($password);
            if($user->update(['password'=>$new_password])){
                return response()->json(['status'=>'success','message'=>'Your Password Has Been Changed']);
            }else{
                return response()->json(['status'=>'error','message'=>'Error Changing Password, Please Try Again']);
            }
        }else{
            return response()->json(['status'=>'error','message'=>'Sorry The User Does Not Exists']);

        }

    }

}
