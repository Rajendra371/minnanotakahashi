<?php

namespace App\Http\Controllers\Api\NNE;

use App\Models\NNE\NneSetup;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class NneSetupController extends Controller
{
    public function index()
    {
        $data['category'] = DB::table('nne_category')->get();

        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Added Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'file' => 'file|mimes:jpeg,png,gif,jpg|max:5120',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('old_img_file');
        $old_img_file = $request->get('old_img_file');

        if ($request->hasFile('file')) {
            $nne_img = $request->file('file');
            $nne_image_name = time() . rand() .$nne_img->getClientOriginalName();
            $filename = preg_replace('/\s+/', '', $nne_image_name);
            $nne_img->move(('uploads/nne_image/'), $filename);
        }

        $id = $request->get('id');
        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();
        $title = $request->get('title');
        $nne_slug = Str::slug($title);
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }

            if (!empty($filename) && !empty($old_img_file)) {
                if (File::exists('uploads/nne_image/' . $old_img_file)) {
                    unlink('uploads/nne_image/' . $old_img_file);
                }
            }

            $data = NneSetup::where('id', $id)->first();
            $input['slug'] = $nne_slug;
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['image'] = !empty($filename) ? $filename : $old_img_file;
            $input['is_publish'] = !empty($request->get('is_publish')) ? $request->get('is_publish') : 'N';
            $input['is_unlimited'] = !empty($request->get('is_unlimited')) ? $request->get('is_unlimited') : 'N';

            unset($input['id']);
            unset($input['file']);

            save_log('nne', 'id', $id, $input, 'Update');
            $update = DB::table('nne')->where('id', $id)->update($input);
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
            $input['slug'] = $nne_slug;
            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');
            $input['postby'] = $postby;
            $input['image'] = !empty($filename) ? $filename : $old_img_file;
            unset($input['file']);
            if ($data = NneSetup::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function nne_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');
        $data = NneSetup::get_nne_list();

        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {

            $current_date = strtotime(CURDATE_EN);

            $array[$i]['id'] = $row->id;
            $array[$i]['category_typeid'] = $row->category_name;
            $array[$i]['image'] = '<img src="' . asset("uploads/nne_image/" . $row->image) . '" height="30px" width="30px">';
            $array[$i]['title'] = $row->title;
            $array[$i]['startdate'] = $row->startdate;
            $array[$i]['enddate'] = $row->enddate;
            $array[$i]['is_publish'] = $row->is_publish;
            $array[$i]['is_unlimited'] = $row->is_unlimited;

            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/nne_setup/nne_edit" data-id=' . $row->id . ' data-targetForm="nneForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            
            <a href="javascript:void(0)" class="view" data-url="/api/nne_setup/nne_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
            
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/nne_setup/nne_delete" data-id=' . $row->id . ' data-targetForm="nneForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            &nbsp
           
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function nne_edit(Request $request)
    {

        $id = $request->get('id');
        $nne_category = DB::table('nne_category')->where(['is_publish' => 'Y'])->get();
        $data = DB::table('nne')->where('id', $id)->first();
        $view = view("NNE/NneSetup")
            ->with('data', $data)->with('nne_category', $nne_category);
        // ->with('menu',$menu);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function nne_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        save_log('nne', 'id', $id, false, 'Delete');
        $data = NneSetup::where('id', $id)->delete();

        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function nne_view(Request $request)
    {
        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = NneSetup::get_all_nne_data($id);

        $view = view("NNE/NneSetupView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}