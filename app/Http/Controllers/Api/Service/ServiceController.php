<?php

namespace App\Http\Controllers\Api\Service;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Service\Service;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class ServiceController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'service_name' => 'required',
            'content' => 'required',
            'file' => 'file|mimes:jpeg,png,jpg|max:5048',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('old_img_file', 'for_form', 'is_publish', 'file');
        $old_img_file = $request->get('old_img_file');
        $input['for_form'] = $request->for_form ?? 'N';
        $input['is_publish'] = $request->is_publish ?? 'N';
        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $source = $image->getRealPath();
            $image_name = time() . rand() . '.' . $image->getClientOriginalExtension();
            $destination = public_path("uploads/service_image/$image_name");
            resizeAndCompressImage($source, $destination, 640, 426, 60);
            $filename = $image_name;
        }

        $id = $request->get('id');
        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();
        $service_name = $request->get('service_name');
        $slug =  Str::slug($service_name);
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            if (!empty($filename)) {
                if (File::exists('uploads/service_image/' . $old_img_file)) {
                    if (!empty($old_img_file)) {
                        unlink('uploads/service_image/' . $old_img_file);
                    }
                }
            }
            $data = Service::where('id', $id)->first();
            $input['slug'] = $slug;
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['image'] = !empty($filename) ? $filename : $old_img_file;

            save_log('services', 'id', $id, $input, 'Update');
            $update = DB::table('services')->where('id', $id)->update($input);
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
            $input['slug'] = $slug;
            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');
            $input['postby'] = $postby;
            $input['image'] = !empty($filename) ? $filename : $old_img_file;

            if ($data = Service::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function service_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');

        $data = Service::get_service_list();
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
            $array[$i]['service_name'] = $row->service_name;
            if (!empty($row->image)) {
                $array[$i]['image'] = '<img src="' . asset("uploads/service_image/" . $row->image) . '" height="30px" width="30px">';
            } else {
                $array[$i]['image'] = '';
            }
            // $array[$i]['short_content']= $row->short_content;
            // $array[$i]['content']= $row->content;

            $array[$i]['startdate'] = $row->startdate;
            $array[$i]['enddate'] = $row->enddate;
            $array[$i]['order'] = $row->order;
            $array[$i]['is_publish'] = $row->is_publish;



            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/service/service_edit" data-id=' . $row->id . ' data-targetForm="serviceForm" data-edittype="template"><i class="fa fa-edit"></i></a>

            <a href="javascript:void(0)" class="view" data-url="/api/service/service_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>

            <a href="javascript:void(0)" class="btnDelete" data-url="/api/service/service_delete" data-id=' . $row->id . ' data-targetForm="serviceForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function service_view(Request $request)
    {
        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = Service::get_all_service_data($id);

        $view = view("Service/ServiceView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function service_edit(Request $request)
    {

        $id = $request->get('id');
        $data = DB::table('services')->where('id', $id)->first();
        $view = view("Service/Service")
            ->with('data', $data);
        // ->with('location',$location);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function service_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('services', 'id', $id, false, 'Delete');
        $data = Service::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}