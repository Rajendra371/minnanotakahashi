<?php

namespace App\Http\Controllers\Api\Banner;

use Illuminate\Http\Request;
use App\Models\Banner\Banner;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;


class BannerController extends Controller
{
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'heading' => 'required',
            'content' => 'required',
            'file' => 'file|mimes:jpeg,png,jpg|max:5048',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('old_img_file');

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $source = $image->getRealPath();
            $image_name = time() . rand() . '.' . $image->getClientOriginalExtension();
            $destination = public_path("uploads/banner_image/$image_name");
            resizeAndCompressImage($source, $destination, 1920, 1080, 75);
            $filename = $image_name;
        }

        $id = $request->get('id');

        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();
        $old_img_file = $request->get('old_img_file');
        if ($id) {
            // $trans = check_permission('Update');
            // if ($trans == 'error') {
            //     permission_message();
            //     exit;
            // }

            if (!empty($filename)) {
                if (File::exists('uploads/banner_image/' . $old_img_file)) {
                    unlink('uploads/banner_image/' . $old_img_file);
                }
            }

            $data = Banner::where('id', $id)->first();


            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['banner_img'] = !empty($filename) ? $filename : $old_img_file;
            $input['is_publish'] = !empty($request->get('is_publish')) ? $request->get('is_publish') : 'N';
            $input['is_unlimited'] = !empty($request->get('is_unlimited')) ? $request->get('is_unlimited') : 'N';

            unset($input['id']);
            unset($input['file']);

            save_log('banner', 'id', $id, $input, 'Update');
            $update = DB::table('banner')->where('id', $id)->update($input);
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
            $input['banner_img'] = !empty($filename) ? $filename : $old_img_file;
            unset($input['file']);
            if ($data = Banner::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }



    public function banner_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');
        $data = Banner::get_banner_list();

        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {

            $current_date = strtotime(CURDATE_EN);



            $array[$i]['id'] = $row->id;
            $array[$i]['heading'] = $row->heading;
            $array[$i]['banner_img'] = '<img src="' . asset("uploads/banner_image/" . $row->banner_img) . '" height="30px" width="30px">';
            $array[$i]['content'] = $row->content;
            $array[$i]['startdate'] = $row->startdate;
            $array[$i]['enddate'] = $row->enddate;
            $array[$i]['is_publish'] = $row->is_publish;
            $array[$i]['is_unlimited'] = $row->is_unlimited;



            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/banner/banner_edit" data-id=' . $row->id . ' data-targetForm="bannerForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            
            <a href="javascript:void(0)" class="view" data-url="/api/banner/banner_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
            
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/banner/banner_delete" data-id=' . $row->id . ' data-targetForm="bannerForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            &nbsp
           
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function banner_edit(Request $request)
    {

        $id = $request->get('id');
        $data = DB::table('banner')->where('id', $id)->first();
        $view = view("Banner/Banner")
            ->with('data', $data);
        // ->with('menu',$menu);
        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function banner_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        save_log('banner', 'id', $id, false, 'Delete');
        $data = Banner::where('id', $id)->delete();

        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function banner_view(Request $request)
    {

        $trans = check_permission('View');
        // dd($trans);
        // die();
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = Banner::get_all_banner_data($id);


        $view = view("Banner/BannerView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}