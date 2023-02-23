<?php

namespace App\Http\Controllers\Api\GeneralSetting;

use App\Models\GeneralSetting\UsefulLink;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;


class UsefulLinkController extends Controller
{
    public function index()
    {
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'designation' => 'required',
            'email' => 'required',
            'contact' => 'required',


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
            $data = UsefulLink::where('id', $id)->first();
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
            $input['isactive'] = !empty($request->get('isactive')) ? $request->get('isactive') : 'N';
            save_log('useful_link', 'id', $id, $input, 'Update');
            $update = \DB::table('useful_link')->where('id', $id)->update($input);
            if ($update) {
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
            if ($data = UsefulLink::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }




    public function usefullink_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');

        $data = UsefulLink::get_usefullink_list();
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
            $array[$i]['title'] = $row->title;
            $array[$i]['designation'] = $row->designation;
            $array[$i]['contact'] = $row->contact;
            $array[$i]['email'] = $row->email;
            $array[$i]['facebook_link'] = $row->facebook_link;
            $array[$i]['twitter_link'] = $row->twitter_link;
            $array[$i]['linkedin_link'] = $row->linkedin_link;
            $array[$i]['youtube_link'] = $row->youtube_link;
            $array[$i]['instagram_link'] = $row->instagram_link;

            $array[$i]['order'] = $row->order;
            $array[$i]['isactive'] = $row->isactive;





            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/usefullink/usefullink_edit" data-id=' . $row->id . ' data-targetForm="uesfulForm" data-edittype="template"><i class="fa fa-edit"></i></a>

            <a href="javascript:void(0)" class="view" data-url="/api/usefullink/usefullink_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>

            <a href="javascript:void(0)" class="btnDelete" data-url="/api/usefullink/usefullink_delete" data-id=' . $row->id . ' data-targetForm="uesfulForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function usefullink_view(Request $request)
    {
        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = UsefulLink::get_all_usefullink_data($id);

        $view = view("GeneralSetting/UsefulLinkView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function usefullink_edit(Request $request)
    {

        $id = $request->get('id');

        $data = \DB::table('useful_link')->where('id', $id)->first();
        $view = view("GeneralSetting/UsefulLink")
            ->with('data', $data);
        // ->with('location',$location);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function usefullink_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('useful_link', 'id', $id, false, 'Delete');
        $data = UsefulLink::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}