<?php

namespace App\Http\Controllers\Api\Training;

use Illuminate\Http\Request;
use App\Models\Training\Training;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class TrainingController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            //'file' => 'file|mimes:jpeg,png,gif,jpg|max:5120',

        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('old_img_file');
        $old_img_file = $request->get('old_img_file');

        if ($request->hasFile('file')) {
            $images = $request->file('file');
            $service_image_name = $images->getClientOriginalName();
            $service_image_name = rand() . '-' . $service_image_name;
            $filename = preg_replace('/\s+/', '', $service_image_name);
            $images->move(('uploads/training_image/'), $filename);
        }

        $id = $request->get('id');
        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();
        $title = $request->get('title');
        $slug = strtolower(preg_replace('/\s+/', '-', $title));
        if ($id) {
            // $trans = check_permission('Update');
            // if ($trans == 'error') {
            //     permission_message();
            //     exit;
            // }
            if (!empty($filename)) {
                if (File::exists('uploads/training_image/' . $old_img_file)) {
                    if (!empty($old_img_file)) {
                        unlink('uploads/training_image/' . $old_img_file);
                    }
                }
            }
            $data = Training::where('id', $id)->first();
            $input['slug'] = $slug;
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['training_image'] = !empty($filename) ? $filename : $old_img_file;
            $input['is_publish'] = !empty($request->get('is_publish')) ? $request->get('is_publish') : 'N';
            unset($input['file']);
            save_log('training', 'id', $id, $input, 'Update');
            $update = DB::table('training')->where('id', $id)->update($input);
            if ($update) {
                return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } else {
            $input['slug'] = $slug;
            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');
            $input['postby'] = $postby;
            $input['training_image'] = !empty($filename) ? $filename : $old_img_file;

            unset($input['file']);
            if ($data = Training::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function training_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');

        $data = Training::get_training_list();
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
            if (!empty($row->trainer_image)) {
                $array[$i]['image1'] = '<img src="' . asset("uploads/trainer_image/" . $row->trainer_image) . '" height="30px" width="30px">';
            } else {
                $array[$i]['trainer_image'] = '';
            }


            $array[$i]['trainer_name'] = $row->trainer_name;

            $array[$i]['image1'] = $row->image1;
            $array[$i]['description'] = $row->description;
            $array[$i]['is_publish'] = $row->is_publish == "Y" ? "Yes" : "No";



            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/training/training_edit" data-id=' . $row->id . ' data-targetForm="trainingForm" data-edittype="template"><i class="fa fa-edit"></i></a>

            <a href="javascript:void(0)" class="view" data-url="/api/training/training_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>

            <a href="javascript:void(0)" class="btnDelete" data-url="/api/training/training_delete" data-id=' . $row->id . ' data-targetForm="trainingForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function training_view(Request $request)
    {
        $trans = check_permission('View');

        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = Training::get_all_training_data($id);

        $view = view("Training/TrainingView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function training_edit(Request $request)
    {

        $id = $request->get('id');

        $data = DB::table('training')->where('id', $id)->first();
        $view = view("Training/Training")
            ->with('data', $data);
        // ->with('location',$location);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function training_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('training', 'id', $id, false, 'Delete');
        $data = Training::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}