<?php

namespace App\Http\Controllers\Api\Technology;

use App\Models\Technology\TechnologyCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;


class TechnologyCategoryController extends Controller
{
    public function index()
    {
    }


    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'cat_name' => 'required',
            'description' => 'required',

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
        $cat_name = $request->get('cat_name');
        $slug = strtolower(preg_replace('/\s+/', '-', $cat_name));
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $data = TechnologyCategory::where('id', $id)->first();
            $input['slug'] = $slug;
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['is_active'] = !empty($request->get('is_active')) ? $request->get('is_active') : 'N';
            save_log('technology_category', 'id', $id, $input, 'Update');
            $update = \DB::table('technology_category')->where('id', $id)->update($input);
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
            if ($data = TechnologyCategory::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }




    public function technologycategory_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');

        $data = TechnologyCategory::get_technologycategory_list();

        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {

            $current_date = strtotime(CURDATE_EN);


            $array[$i]['id'] = $row->id;
            $array[$i]['cat_name'] = $row->cat_name;
            $array[$i]['icon'] = $row->icon;
            $array[$i]['order'] = $row->order;
            $array[$i]['is_active'] = $row->is_active;


            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/technology_category/technologycategory_edit" data-id=' . $row->id . ' data-targetForm="technologycatForm" data-edittype="template"><i class="fa fa-edit"></i></a>

            <a href="javascript:void(0)" class="view" data-url="/api/technology_category/technologycategory_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>

            <a href="javascript:void(0)" class="btnDelete" data-url="/api/technology_category/technologycategory_delete" data-id=' . $row->id . ' data-targetForm="technologycatForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function technologycategory_view(Request $request)
    {
        $trans = check_permission('View');

        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = TechnologyCategory::get_all_technologycategory_data($id);

        $view = view("Technology/TechnologyCategoryView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
    public function technologycategory_edit(Request $request)
    {

        $id = $request->get('id');
        // $location =\DB::table('advertisement_location')->where(['is_active'=>'Y'])->get();
        $data = \DB::table('technology_category')->where('id', $id)->first();
        $view = view("Technology/TechnologyCategory")
            ->with('data', $data);
        // ->with('location',$location);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function technologycategory_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('technology_category', 'id', $id, false, 'Delete');
        $data = TechnologyCategory::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function tech_index()
    {
        $data['category'] = DB::table('technology_category')->get();



        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Added Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }


    public function tech_store(Request $request)
    {
        $upload_file = get_constant_value('IMAGES_FOLDER');
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'technology_catid' => 'required',
            'description' => 'required',
            // 'description'=>'required',
            'file' => 'file|mimes:jpeg,png,gif,jpg|max:5120',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('old_img_file', 'file');
        //$input = $request->all();

        $temp_file_names = '';

        if ($request->hasFile('file')) {
            $images = $request->file('file');
            $technology_image_name = $images->getClientOriginalName();
            $technology_image_name = rand() . '-' . $technology_image_name;
            $filename = preg_replace('/\s+/', '', $technology_image_name);
            $images->move(('uploads/technology_image/'), $filename);
        }

        $id = $request->get('id');
        $old_img_file = $request->get('old_img_file');

        $postby = auth()->user()->id;
        $locationid = auth()->user()->locationid;
        $orgid = auth()->user()->orgid;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();
        $title = $request->get('title');
        $slug = strtolower(preg_replace('/\s+/', '-', $title));
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            if (!empty($filename)) {
                if (\File::exists('uploads/technology_image/' . $old_img_file)) {
                    if (!empty($old_img_file)) {
                        unlink('uploads/technology_image/' . $old_img_file);
                    }
                }
            }


            $data = \DB::table('technology')->where('id', $id)->first();

            $input['slug'] = $slug;
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['image'] = !empty($filename) ? $filename : $old_img_file;
            $input['is_publish'] = !empty($request->get('is_publish')) ? $request->get('is_publish') : 'N';


            unset($input['id']);

            save_log('technology', 'id', $id, $input, 'Update');
            $update = \DB::table('technology')->where('id', $id)->update($input);
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
            $input['image'] = !empty($filename) ? $filename : $old_img_file;

            if ($data = \DB::table('technology')->insert($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }



    public function technologydescription_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');



        $data = TechnologyCategory::get_technologydescription_list();
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
            $array[$i]['technology_catid'] = $row->cat_name;
            $array[$i]['title'] = $row->title;
            $array[$i]['icon'] = $row->icon;
            $array[$i]['order'] = $row->order;
            $array[$i]['is_publish'] = $row->is_publish;
            if (!empty($row->image)) {
                $array[$i]['image'] = '<img src="' . asset("uploads/technology_image/" . $row->image) . '" height="30px" width="30px">';
            } else {
                $array[$i]['image'] = '';
            }


            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/technology_description/technologydescription_edit" data-id=' . $row->id . ' data-targetForm="technologyForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            
            <a href="javascript:void(0)" class="view" data-url="/api/technology_description/technologydescription_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>

            <a href="javascript:void(0)" class="btnDelete" data-url="/api/technology_description/technologydescription_delete" data-id=' . $row->id . ' data-targetForm="technologyForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function technologydescription_view(Request $request)
    {
        $trans = check_permission('View');

        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        $data = TechnologyCategory::get_all_technologydescription_data($id);

        $view = view("Technology/TechnologyDescriptionView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function technologydescription_edit(Request $request)
    {

        $id = $request->get('id');
        //$data['employees']=\DB::table('employee')->where(['isactive'=>'Y'])->get();
        $category = \DB::table('technology_category')->where(['is_active' => 'Y'])->get();
        $data = \DB::table('technology')->where('id', $id)->first();
        // echo "<pre>";
        // print_r($data);
        // die();

        $view = view("Technology/TechnologyDescription")
            ->with('data', $data)->with('category', $category);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function technologydescription_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('technology', 'id', $id, false, 'Delete');
        $data = \DB::table('technology')->where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}