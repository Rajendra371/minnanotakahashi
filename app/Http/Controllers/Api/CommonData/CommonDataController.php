<?php

namespace App\Http\Controllers\Api\CommonData;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;

class CommonDataController extends Controller
{
    public function get_seo_data()
    {
        $base_url = URL::to('/');
        $currenturl = $_SERVER['HTTP_REFERER'];
        $new_url = str_replace($base_url . "/", "", $currenturl);
        $data['seo'] = DB::table('seo_page as sp')->leftJoin('seo as s', 'sp.id', '=', 's.seo_pageid')
            ->select('sp.id', 'sp.page_name', 's.seo_title', 's.seo_metakeyword', 's.seo_metadescription', 's.schema1', 's.schema2')
            ->where('sp.page_code', $new_url)->where('s.isactive', 'Y')->first();
        if ($data['seo']) {
            $data['general'] = array(
                'host_name' => $base_url,
                'logo' => url('/uploads/thedial.jpg')
            );
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error']);
        }
        // dd($new_url);
    }

    public function get_footer_address()
    {
        $res = DB::table('branch_setup')->select('id', 'branch_name', 'contact_number', 'email', 'is_main')
            ->selectRaw("CONCAT(branch_address,', ',branch_location) as address")->where('is_active', 'Y')->get();
        if (!empty($res)) {
            return response()->json(['data' => $res, 'status' => 'success']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
        }
    }



    public function get_payment_method()
    {
        $data = DB::table('payment_method')->select('id', 'payment_name', 'logo')->where('isactive', 'Y')->get();
        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
        }
    }


    public function get_month()
    {
        $data = DB::table('monthname')->get();
        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
        }
    }

    public function get_colorlist()
    {
        $data = DB::table('product_color')->get();
        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
        }
    }

    public function get_search_filter_data()
    {
        $data['size'] = DB::table('product')->select(DB::raw("DISTINCT(dimension)"))->whereNotNull('dimension')->get();
        $data['shape'] = DB::table('product_shape')->select('id', 'shape_name')->where('is_display', '1')->get();
        $data['material'] = DB::table('product_material')->select('id', 'material_name')->where('is_display', '1')->get();
        // dd($data);
        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
        }
    }

    public function get_province()
    {
        $data = DB::table('state')->get();
        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
        }
    }

    public function get_district(Request $request)
    {
        $state_id = $request->get('state_id');
        if ($state_id) {
            $data = DB::table('districts')->where('states_id', $state_id)->get();
            if ($data) {
                return response()->json(['status' => 'success', 'data' => $data]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
            }
        }
    }

    public function get_region(Request $request)
    {
        $district_id = $request->get('district_id');
        if ($district_id) {
            $data = DB::table('vdc')->where('dist_id', $district_id)->get();
            if ($data) {
                return response()->json(['status' => 'success', 'data' => $data]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
            }
        }
    }

    public static function get_address_name(Request $request)
    {
        // $type = $request->get('type');
        $id = $request->get('id');

        $data = DB::table('state as p')
            ->leftJoin('districts as d', 'd.states_id', '=', 'p.id')
            ->leftjoin('vdc as v', 'v.dist_id', '=', 'd.districtid')
            ->select('p.stat_name', 'd.districtnamenp', 'v.vdc_namenp')
            ->where('v.id', $id)
            ->get();

        if (!empty($data[0])) {
            $new_data = $data[0]->vdc_namenp . "," . $data[0]->districtnamenp;
            return response()->json(['status' => 'success', 'data' => $new_data]);
        } else {

            return response()->json(['status' => 'success', 'data' => '']);
        }
    }

    public function get_default_currency()
    {
        $currency = CURRENCY;
        if (!empty($currency)) {
            return response()->json(['status' => 'success', 'data' => $currency]);
        }
        return response()->json(['status' => 'error', 'message' => 'Currency Not Set']);
    }

    public function custom_carpet_order_store(Request $request)
    {
        // dd($request->all());     
        $validator = Validator::make($request->all(), [
            'color' => 'required',
            'file' => 'required|file|mimes:jpeg,png,gif,jpg,pdf|max:5120',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();

        $input = $request->except('length', 'breadth', 'unit', 'file');
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $filename = time() . "-" . preg_replace('/\s+/', '', $file->getClientOriginalName());
            $file->move(('uploads/custom_carpet_order/'), $filename);
            $input['design_attachment'] = $filename;
        }
        $input['postip'] = $postip;
        $input['postmac'] = $postmac;
        $input['postdatead'] = $postdatead;
        $input['postdatebs'] = $postdatebs;
        $input['posttime'] = date('H:i:s');
        $input['size'] = "$request->length X $request->breadth $request->unit";

        if (DB::table('custom_carpet_order')->insert($input)) {
            // send mail to merorug and customer with attachment
            // code here
            // Mail::send([], [], function($message){
            //     $message->attachData(asset("uploads/custom_carpet_order/$filename"), 'filename.ext', ['mime' => extension]);
            //     $message->to(merorug); 
            //     $message->cc(customer);
            //     $message->subject('Custom Design');
            //     $message->setBody('Details', 'text/html');
            // });
            return response()->json(['status' => 'success', 'message' => 'Request Sent Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Sending Details!!']);
        }
    }
}
