<?php

namespace App\Http\Controllers\Api\GeneralSetting;

use App\Models\GeneralSetting\SocialMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;


class SocialMediaController extends Controller
{
    public function index()
    {
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'fb_appid' => 'required',
            'google_appid' => 'required',
            'linkedin_appid' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->all();
        $id = $request->get('id');
        $postby = auth()->user()->id;
        $locationid = auth()->user()->locationid;
        $orgid = auth()->user()->orgid;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $data = SocialMedia::where('id', $id)->first();
            // echo "<pre>";
            // print_r($data);
            // die();
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['isfb_login'] = !empty($request->get('isfb_login')) ? $request->get('isfb_login') : 'N';
            $input['isgoogle_login'] = !empty($request->get('isgoogle_login')) ? $request->get('isgoogle_login') : 'N';
            $input['isgoogle_analytical'] = !empty($request->get('isgoogle_analytical')) ? $request->get('isgoogle_analytical') : 'N';
            $input['islinkedin_login'] = !empty($request->get('islinkedin_login')) ? $request->get('islinkedin_login') : 'N';
            save_log('social_media_integration', 'id', $id, $input, 'Update');
            $update = \DB::table('social_media_integration')->where('id', $id)->update($input);
            if ($update) {
                return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } else {
            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');
            $input['postby'] = $postby;
            if ($data = SocialMedia::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }




    public function socialmedia_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');

        $data = SocialMedia::get_socialmedia_list();
        // echo "<pre>";
        // print_r($data);
        // die();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {

            $current_date = strtotime(CURDATE_EN);
            // if($date_type=='NP'){
            //     $start_date = $row->startdate;
            //     $end_date = $row->enddate;
            // }
            // else{
            //      $start_date = $row->startdate;
            //      $end_date = $row->enddate;
            // }

            $array[$i]['id'] = $row->id;
            $array[$i]['isfb_login'] = $row->isfb_login;
            $array[$i]['fb_appid'] = $row->fb_appid;
            $array[$i]['isgoogle_login'] = $row->isgoogle_login;
            $array[$i]['google_appid'] = $row->google_appid;
            $array[$i]['isgoogle_analytical'] = $row->isgoogle_analytical;
            $array[$i]['google_analytics'] = $row->google_analytics;
            $array[$i]['islinkedin_login'] = $row->islinkedin_login;
            $array[$i]['linkedin_appid'] = $row->linkedin_appid;




            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/socialmediaintegration/socialmedia_edit" data-id=' . $row->id . ' data-targetForm="socialmediaintegrationForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            &nbsp
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/socialmediaintegration/socialmedia_delete" data-id=' . $row->id . ' data-targetForm="socialmediaintegrationForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function socialmedia_edit(Request $request)
    {

        $id = $request->get('id');

        $data = \DB::table('social_media_integration')->where('id', $id)->first();
        $view = view("GeneralSetting/SocialMedia")
            ->with('data', $data);
        // ->with('location',$location);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function socialmedia_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('social_media_integration', 'id', $id, false, 'Delete');
        $data = SocialMedia::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}