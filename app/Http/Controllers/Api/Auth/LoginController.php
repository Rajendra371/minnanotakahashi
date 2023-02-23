<?php

namespace App\Http\Controllers\Api\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\CustomerResource;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $user_type = $request->get('user_type');
        if ($user_type == "CUSTOMER") {
            $check_user = User::where('email', $request->get('email'))->where('user_type', $user_type)->first();
            if (!$check_user) {
                $this->login_activity($request->get('email'), 'N');
                return response()->json([
                    'status' => 'error',
                    'message' => 'Invalid Email or Password!!!'
                ], 401);
            } else {
                if (!$token = auth()->attempt($request->only(['email', 'password']))) {
                    $this->login_activity($request->get('email'), 'N');
                    return response()->json([
                        'status' => 'error',
                        'message' => 'Invalid Email or Password!!!'
                    ], 401);
                }
                // dd($request->user());
                return (new CustomerResource($request->user()))
                    ->additional([
                        'token' => $token,
                        'status' => 'success'
                    ]);
            }
        }


        if (!$backend_token = auth()->attempt($request->only(['email', 'password'], ['exp' => Carbon::now()->addDays(7)->timestamp]))) {
            // print_r(auth()->user());
            // die();
            $this->login_activity($request->get('email'), 'N');
            return response()->json([
                'status' => 'success',
                'error' => [
                    'message' => 'Invalid Email or Password!!!'
                ]
            ], 422);
        }

        $this->login_activity($request->get('email'), 'Y', $request->user());
        if (auth()->user()->group_id == '2') {
            return (new UserResource($request->user()))
                ->additional([
                    'token' => JWTAuth::customClaims(['exp' => strtotime('+50 minutes')])->fromUser($request->user()),
                    'status' => 'success'
                ]);
        } else {
            $is_main = DB::table('location')->where('id', auth()->user()->locationid)->value('ismain');
            session()->put('USER_ID', auth()->id());
            session()->put('EMPLOYEE_ID', auth()->user()->empid);
            session()->put('ORGANIZATION_ID', auth()->user()->orgid);
            session()->put('LOCATION_ID', auth()->user()->locationid);
            session()->put('USERGROUP_ID', auth()->user()->group_id);
            session()->put('MAIN_LOCATION', $is_main);
            session()->save();
            return (new UserResource($request->user()))
                ->additional([
                    'token' => $backend_token,
                    'status' => 'success'
                ]);
        }
    }

    public function login_activity($email, $loginstatus = 'N', $request = false)
    {
        // echo auth()->user()->depid;
        // die();


        if ($loginstatus == 'Y') {
            $loginuseremail = $email;
            $loginuserid = $request->id;;
            $loginusername = $request->username;
            $loginlocation = $request->locationid;
            $loginorgid = $request->orgid;
            $loginsoftwareid = $request->softwareid;
        } else {
            $loginuseremail = $email;
            $loginuserid = 0;
            $loginusername = '';
            $loginlocation = '0';
            $loginorgid = '0';
            $loginsoftwareid = '0';
        }

        $postdataArray = [
            'loginusername' => $loginusername,
            'loginuserid' => $loginuserid,
            'loginuseremail' => $loginuseremail,
            'isvalidlogin' => $loginstatus,
            'logindatead' => CURDATE_EN,
            'logintime' => datetime('time'),
            'loginip' => get_real_ipaddr(),
            'loginmac' => get_Mac_Address(),
            'locationid' => $loginlocation,
            'orgid' => $loginorgid,
            'softwareid' => $loginsoftwareid

        ];

        // echo "<pre>";
        // print_r($request);
        // die();

        DB::table('loginactivity')->insert($postdataArray);
    }

    public function change_password(Request $request)
    {

        $id = auth()->user()->id;

        $input = $request->except('old_password', 'confirm_password');
        $pwd = $request->get('password');
        $data = User::where('id', $id)->first();
        $get_old_password = $request->get('old_password');
        print_r($input);
        print_r($id);
        print_r($data);
        die();
        $check = Hash::check($get_old_password, $data->password);
        if ($check == true) {
            // $data = User::where('id', $id)->first();
            $input['password'] = bcrypt($pwd);
            $input['updated_at'] = datetime();
            $input['updatedip'] = get_real_ipaddr();
            $input['updatedmac'] = get_Mac_Address();
            $input['updatedby'] = auth()->user()->id;
            save_log('users', 'id', $id, $input, 'Update');
            if ($data->update($input)) {
                return response()->json(['status' => 'success', 'message' => 'Password Updated Successfully!!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Old Password Didn\'t Match. Please Try Again !!']);
        }
    }

    public function customer_change_password(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'old_password' => 'required',
            'password' => 'required|string|min:8|confirmed',
        ]);
        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
        }
        $id = auth()->user()->id;

        $input = $request->except('old_password', 'password_confirmation');
        $pwd = $request->get('password');
        $data = User::where('id', $id)->first();
        $get_old_password = $request->get('old_password');

        $check = Hash::check($get_old_password, $data->password);
        if ($check == true) {
            $input['password'] = bcrypt($pwd);
            $input['updated_at'] = datetime();
            $input['updatedip'] = get_real_ipaddr();
            $input['updatedmac'] = get_Mac_Address();
            $input['updatedby'] = auth()->user()->id;
            save_log('users', 'id', $id, $input, 'Update');
            if ($data->update($input)) {
                return response()->json(['status' => 'success', 'message' => 'Password Updated Successfully!!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Old Password Didn\'t Match. Please Try Again !!']);
        }
    }

    public static function user_detail($get_data = false)
    {
        $current_user_id = auth()->user()->id;
        $user_type = auth()->user()->user_type;

        if ($user_type == 'CUSTOMER') {

            $data = DB::table('users as u')
                ->leftJoin('user_detail as ud', 'u.id', '=', 'ud.userid')
                ->where('u.id', $current_user_id)
                ->select('u.id', 'username', 'email', 'contact', 'email_verified_at', 'is_verified', 'ud.fullname', 'ud.dob', 'ud.bill_str_address', 'ud.bill_province_id', 'ud.bill_district_id', 'ud.bill_mun_vdc_id', 'ud.bill_postal_zip_code', 'ud.shipping_address', 'ud.ship_str_address', 'ud.ship_province_id', 'ud.ship_district_id', 'ud.ship_mun_vdc_id', 'ud.ship_postal_zip_code', 'ud.primary_email', 'ud.secondary_email', 'ud.attachment')
                ->first();
        } else {
            $data = DB::table('users as u')
                ->leftjoin('usergroup as g', 'g.id', '=', 'u.group_id')
                ->leftjoin('location as l', 'l.id', '=', 'u.user_locationid')
                ->where('u.id', $current_user_id)
                ->select('u.id', 'username', 'email', 'fullname', 'contact', 'groupname', 'locname', 'locaddress')
                ->first();
        }

        if ($data) {
            if ($get_data == 'Y') {
                return $data;
            }
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function guest_checkout(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'fullname' => 'required|string|max:50',
            'email' => 'required|email|max:50',
            'mobile_no' => 'required|digits:10'
        ]);
        $notAllowedEmailDomain = ['mailinator', 'guest', 'admin', 'test'];
        $email = $request->get('email');
        $email = explode('@', $email);
        $domain = explode('.', end($email));
        if (in_array(strtolower($domain[0]), $notAllowedEmailDomain)) {
            return response()->json(['status' => 'error', 'message' => 'Invalid Or Disposable Email Account Detected.']);
        }
        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
        }
        $input = $request->all();

        $guest_customer_id = DB::table('guest_customer')->insertGetId($input);
        if ($guest_customer_id) {
            session(['guest_customer_id' => $guest_customer_id]);
            $data = DB::table('guest_customer')->select('id as guest_id', 'fullname', 'email', 'mobile_no')->where('id', $guest_customer_id)->first();
            return response()->json(['status' => 'success', 'message' => 'Guest Customer Saved', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Saving Data']);
        }
    }


    public function GoogleLogin(Request $request)
    {
        $input = array();
        $profile_data = $request->get('response');
        // dd($profile_data['email']);

        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();

        if (!empty($profile_data)) {
            $check_db = $this->check_social_login($request, $profile_data['email'], $profile_data['googleId']);
            if ($check_db == 'success') {
                $validation = Validator::make(['email' => $profile_data['email']], [
                    'email' => 'required|email|unique:users',
                ]);

                if ($validation->fails()) {
                    return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
                }
                $input['email'] = $profile_data['email'];
                $input['username'] = $profile_data['name'];
                $input['social_media_id'] = $profile_data['googleId'];
                $input['password'] = Hash::make($profile_data['googleId']);
                $input['social_media_login'] = 'google';
                $input['user_type'] = 'CUSTOMER';
                $input['createdip'] = $postip;
                $input['createdmac'] = $postmac;
                $input['email_verified_at'] = datetime();
                $input['is_verified'] = 2;

                DB::beginTransaction();
                try {
                    $user = User::create($input);
                    if ($user) {
                        $user_details = array(
                            'userid' => $user->id,
                            'fullname' => $profile_data['name'],
                            'primary_email' => $profile_data['email'],
                            'postip' => $postip,
                            'postmac' =>  $postmac,
                            'postdatead' => $postdatead,
                            'postdatebs' => $postdatebs,
                            'posttime' => date('H:i:s'),
                        );
                        Customer::create($user_details);
                    }
                    DB::commit();
                    return $this->check_social_login($request, $profile_data['email'], $profile_data['googleId']);
                } catch (\Exception $th) {
                    DB::rollback();
                    return response()->json(['status' => 'error', 'message' => [$th->getMessage()]]);
                }
            } else {
                return $check_db;
            }
        }
    }
    public function FacebookLogin(Request $request)
    {
        $input = array();
        $profile_data = $request->get('response');

        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();

        if (!empty($profile_data)) {
            $check_db = $this->check_social_login($request, $profile_data['email'], $profile_data['userID']);
            if ($check_db == 'success') {

                $validation = Validator::make(['email' => $profile_data['email']], [
                    'email' => 'required|email|unique:users',
                ]);
                if ($validation->fails()) {
                    return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
                }
                $input['email'] = $profile_data['email'];
                $input['username'] = $profile_data['name'];
                $input['social_media_id'] = $profile_data['userID'];
                $input['password'] = Hash::make($profile_data['userID']);
                $input['social_media_login'] = 'facebook';
                $input['user_type'] = 'CUSTOMER';
                $input['createdip'] = $postip;
                $input['createdmac'] = $postmac;
                $input['email_verified_at'] = datetime();
                $input['is_verified'] = 2;

                DB::beginTransaction();
                try {
                    $user = User::create($input);
                    if ($user) {
                        $user_details = array(
                            'userid' => $user->id,
                            'fullname' => $profile_data['name'],
                            'primary_email' => $profile_data['email'],
                            'postip' => $postip,
                            'postmac' =>  $postmac,
                            'postdatead' => $postdatead,
                            'postdatebs' => $postdatebs,
                            'posttime' => date('H:i:s'),
                        );
                        Customer::create($user_details);
                    }
                    DB::commit();
                    return $this->check_social_login($request, $profile_data['email'], $profile_data['userID']);
                } catch (\Exception $th) {
                    DB::rollback();
                    return response()->json(['status' => 'error', 'message' => [$th->getMessage()]]);
                }
            } else {
                return $check_db;
            }
        }
    }


    public function check_social_login(Request $request, $email, $social_id)
    {
        $result = User::where('social_media_id', $social_id)->where('email', $email)->where('user_type', 'CUSTOMER')->first();
        if (!empty($result)) {
            if (!$token = auth()->attempt(['email' => $result->email, 'password' => $social_id])) {
                $this->login_activity($result->email, 'N');
                return response()->json([
                    'status' => 'error',
                    'message' => 'Error Logging In!!!'
                ], 401);
            }
            //   dd($request->user()); 
            $this->login_activity($email, 'Y', $request->user());
            return (new CustomerResource($request->user()))
                ->additional([
                    'token' => $token,
                    'status' => 'success'
                ]);
        } else {
            return 'success';
        }
    }
}