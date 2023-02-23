<?php

namespace App\Http\Controllers\Api\GeneralSetting;

use DB;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use App\Models\GeneralSetting\SiteSetting;

class SiteSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['detail'] = DB::table('site_settings')->get();
        $default_timezone = '';
        if (!empty($data['detail'][0])) {
            $default_timezone = $data['detail'][0]->default_time_zone ?? '';
        }
        $data['timezone'] = timezone_list('default_time_zone', $default_timezone);
        $data['site_url'] = URL::to('/uploads/sitesetting_image');
        if ($data) {
            return  response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'organization_name' => 'required|string|max:80',
            'file' => 'nullable|file|mimes:jpg,jpeg,png,svg|max:2048',
            'address1' => 'required|string|max:60',
            'address2' => 'nullable|string|max:60',
            'mobile' => 'nullable|numeric|digits:10',
            'phone' => 'nullable',
            'email' => 'required|email|max:60',
            'contact_person' => 'nullable|string|max:50',
            'facebook_link' => 'nullable|string|max:100',
            'google_link' => 'nullable|string|max:100',
            'linkedin_link' => 'nullable|string|max:100',
            'twitter_link' => 'nullable|string|max:100',
            'instagram_link' => 'nullable|string|max:100',
            'youtube_link' => 'nullable|string|max:100',
            'opening_days' => 'nullable|string|max:50',
            'opening_time' => 'nullable|string|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }

        $input = $request->except('id', 'file');

        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $logo_name = $image->getClientOriginalName();
            $logo_name = rand() . '-' . $logo_name;
            $filename = preg_replace('/\s+/', '', $logo_name);
            $image->move(('uploads/sitesetting_image/'), $filename);
            $input['logo'] = $filename;
        }

        $id = $request->id;
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }

            $data = SiteSetting::where('id', $id)->first();
            if (!empty($input['logo'])) {
                if (!empty($data->logo) && File::exists('uploads/sitesetting_image/' . $data->logo)) {
                    unlink('uploads/sitesetting_image/' . $data->logo);
                }
            }
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            if ($data->update($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } else {
            $trans = check_permission('Insert');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');
            $input['postby'] = $postby;

            if (SiteSetting::create($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function edit(Request $request)
    {
        $id = $request->get('id');
        $data = SiteSetting::where('id', $id)->first();
        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Fetched Successfully!!']);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function destroy(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = SiteSetting::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}