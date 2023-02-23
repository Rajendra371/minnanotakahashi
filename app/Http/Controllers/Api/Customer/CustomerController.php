<?php

namespace App\Http\Controllers\Api\Customer;


use Illuminate\Http\Request;
use App\Models\Checkout\Checkout;
use App\Models\Customer\Customer;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Api\Auth\LoginController;

class CustomerController extends Controller
{
    public function save_customer_profile(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'fullname' => 'required|string|max:50',
            'yearid' => 'required|numeric',
            'monthid' => 'required|numeric',
            'dayid' => 'required|numeric',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
        }

        $customer_id = auth()->user()->id;
        $input = $request->except('yearid', 'monthid', 'dayid');
        $year = $request->get('yearid');
        $month = $request->get('monthid');
        $day = $request->get('dayid');
        $dob = sprintf('%s/%s/%s', $year, $month, $day);
        $input['dob'] = $dob;
        $input['userid'] = $customer_id;
        $user_details = Customer::where('userid', $customer_id)->first();

        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();

        if ($user_details) {

            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatebs;
            $input['modifytime'] = date('H:i:s');

            if ($user_details->update($input)) {
                $data = LoginController::user_detail('Y');
                return response()->json(['status' => 'success', 'message' => 'Record Updated', 'data' => $data]);
            } else {
                return response()->json(['status' => 'error', 'message' => ['Error Updating Record']]);
            }
        } else {

            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');

            Customer::create($input);
            $data = LoginController::user_detail('Y');
            if ($data) {
                return response()->json(['status' => 'success', 'message' => 'Record Updated', 'data' => $data]);
            } else {
                return response()->json(['status' => 'error', 'message' => ['Error Updating Record']]);
            }
        }
    }

    public function user_detail_list()
    {
        $data = Customer::get_user_detail_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $i => $row) {

            $array[$i]['id'] = $row->id;
            $array[$i]['fullname'] = $row->fullname;
            $array[$i]['mobile_no'] = $row->mobile_no;
            $array[$i]['dob'] = $row->dob;
            $array[$i]['email'] = $row->email;
            $array[$i]['action'] = '
            <a href="javascript:void(0)" class="view" data-url="/api/customer/view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>';
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function view(Request $request)
    {
        $data = DB::table('users as u')
            ->leftJoin('user_detail as ud', 'u.id', '=', 'ud.userid')
            ->select('u.id', 'u.email', 'ud.*')
            ->where('u.user_type', 'CUSTOMER')
            ->where('u.id', $request->id)
            ->first();
        $view = view('Customer.view')->with('data', $data);
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template]);
        }
        return response()->json(['status' => 'error', 'message' => 'Error']);
    }

    public function save_attachments(Request $request)
    {
        try {
            if (Auth::check()) {
                $validation = Validator::make($request->all(), [
                    'file' => 'required|file|mimes:jpeg,png,gif,jpg,pdf|max:5120',
                ]);
                if ($validation->fails()) {
                    return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
                }
                $data = Customer::where('userid', auth()->id())->first();
                $images = $request->file('file');
                $image_name = $images->getClientOriginalName();
                $image_name = rand() . '-' . $image_name;
                $filename = preg_replace('/\s+/', '', $image_name);
                $images->move(('uploads/user_attachment/'), $filename);
                if (!empty($data->attachment)) {
                    if (File::exists('uploads/user_attachment/' . $data->attachment)) {
                        unlink('uploads/user_attachment/' . $data->attachment);
                    }
                }
                if ($data->update(['attachment' => $filename])) {
                    $data = LoginController::user_detail('Y');
                    return response()->json(['status' => 'success', 'message' => 'File Uploaded Successfully', 'data' => $data]);
                }
            }
            return response()->json(['status' => 'error', 'message' => 'Error Uploading File.']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Error Uploading File.']);
        }
    }

    public function save_customer_address(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'bill_str_address' => 'required|string|max:60',
            'bill_province_id' => 'required|numeric',
            'bill_district_id' => 'required|numeric',
            'bill_mun_vdc_id' => 'required|numeric',
            'bill_postal_zip_code' => 'nullable|numeric',
            'shipping_address' => 'required',
            'ship_str_address' => 'required_if:shipping_address,D|string|max:60',
            'ship_province_id' => 'required_if:shipping_address,D|numeric',
            'ship_district_id' => 'required_if:shipping_address,D|numeric',
            'ship_mun_vdc_id' => 'required_if:shipping_address,D|numeric',
            'ship_postal_zip_code' => 'nullable|numeric',
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
        }

        $customer_id = auth()->user()->id;
        $input = $request->all();
        $shipping_address = $request->get('shipping_address');
        $input['userid'] = $customer_id;

        if ($shipping_address == 'S') {
            $input['ship_str_address'] = $input['bill_str_address'];
            $input['ship_province_id'] = $input['bill_province_id'];
            $input['ship_district_id'] = $input['bill_district_id'];
            $input['ship_mun_vdc_id'] = $input['bill_mun_vdc_id'];
            $input['ship_postal_zip_code'] = $input['bill_postal_zip_code'];
        }

        $user_details = Customer::where('userid', $customer_id)->first();
        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();

        if ($user_details) {

            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatebs;
            $input['modifytime'] = date('H:i:s');

            if ($user_details->update($input)) {
                $data = LoginController::user_detail('Y');
                return response()->json(['status' => 'success', 'message' => 'Record Updated', 'data' => $data]);
            } else {
                return response()->json(['status' => 'error', 'message' => ['Error Updating Record']]);
            }
        } else {

            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');

            Customer::create($input);
            $data = LoginController::user_detail('Y');
            if ($data) {
                return response()->json(['status' => 'success', 'message' => 'Record Updated', 'data' => $data]);
            } else {
                return response()->json(['status' => 'error', 'message' => ['Error Updating Record']]);
            }
        }
    }



    public function order_list()
    {
        try {
            $data = array();
            $pd = array();
            if (Auth::check()) {
                $result = Checkout::where('customer_id', auth()->user()->id)->get();
                if (!empty($result)) {
                    foreach ($result as $key => $res) {
                        $data[$key]['id'] = $res->id;
                        $data[$key]['orderno'] = $res->orderno;
                        $data[$key]['checkout_datead'] = $res->checkout_datead;
                        $data[$key]['total_product'] = $res->total_product;
                        $data[$key]['grand_totalamt'] = $res->grand_totalamt;
                        $data[$key]['status'] = $res->status;
                        $data[$key]['currency'] = $res->currency;
                        $details = DB::table('product_checkout_detail as pd')->leftJoin('product as p', 'pd.productid', '=', 'p.id')
                            ->select('pd.productid', 'pd.qty', 'pd.rate', 'pd.total_amt', 'p.product_code', 'p.product_title', 'p.image', 'pd.checkout_masterid')->where('checkout_masterid', $res->id)->get();
                        if (!empty($details)) {
                            foreach ($details as $d => $det) {
                                $pd[] = array(
                                    'product' => $det->productid,
                                    'product_code' => $det->product_code,
                                    'product_title' => $det->product_title,
                                    'image' => url("/uploads/product_image/thumbnail/$det->image"),
                                    'qty' => $det->qty,
                                    'rate' => $det->rate,
                                    'total_amt' => $det->total_amt,
                                    'master_id' => $det->checkout_masterid,
                                );
                                //    'image' => "http://cms.xelwel.com.np/public/images/frontend/product/$det->image",
                            }
                            $data[$key]['order_details'] = $pd;
                        }
                    }
                }
            }
            return response()->json(['status' => 'success', 'message' => 'Order List Fetched Successfully', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }
}
