<?php

namespace App\Http\Controllers\Api\Seo;

use App\Models\Seo\Seo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;


class SeoController extends Controller
{
    public function index()
    {
        $data['seo_page'] = DB::table('seo_page')->get();

        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Added Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'seo_title' => 'required',
            'seo_metakeyword' => 'required',
            'seo_pageid' => 'required',
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

            // $trans = check_permission('Update');
            // if ($trans == 'error') {
            //     permission_message();
            //     exit;
            // }
            $data = Seo::where('id', $id)->first();

            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['isactive'] = !empty($request->get('isactive')) ? $request->get('isactive') : 'N';


            unset($input['id']);
            save_log('seo', 'id', $id, $input, 'Update');
            $update = \DB::table('seo')->where('id', $id)->update($input);
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


            if ($data = Seo::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }




    public function seo_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');

        $data = Seo::get_seo_list();
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


            $array[$i]['id'] = $row->id;
            $array[$i]['seo_pageid'] = $row->page_name;
            $array[$i]['seo_title'] = $row->seo_title;
            $array[$i]['seo_metakeyword'] = $row->seo_metakeyword;
            $array[$i]['seo_metadescription'] = str_limit($row->seo_metadescription, $limit = 30, $end = "...");
            $array[$i]['schema1'] = $row->schema1;
            $array[$i]['schema2'] = $row->schema2;

            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/seo/seo_edit" data-id=' . $row->id . ' data-targetForm="seoForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            
           
            <a href="javascript:void(0)" class="view" data-url="/api/seo/seo_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
           
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/seo/seo_delete" data-id=' . $row->id . ' data-targetForm="seoForm" data-edittype="template"><i class="fa fa-trash"></i></a>
           
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function seo_view(Request $request)
    {
        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        $data = Seo::get_all_seo_data($id);

        $view = view("Seo/SeoView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function seo_edit(Request $request)
    {

        $id = $request->get('id');
        $seo_page = \DB::table('seo_page')->where(['is_active' => 'Y'])->get();
        $data = \DB::table('seo')->where('id', $id)->first();

        $view = view("Seo/Seo")
            ->with('data', $data)->with('seo_page', $seo_page);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function seo_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('seo', 'id', $id, false, 'Delete');
        $data = Seo::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}