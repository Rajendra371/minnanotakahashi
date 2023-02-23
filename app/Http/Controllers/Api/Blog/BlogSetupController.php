<?php

namespace App\Http\Controllers\Api\Blog;

use DB;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Blog\BlogSetup;
use App\Http\Controllers\Controller;


class BlogSetupController extends Controller
{
    public function index()
    {
        $data['category'] = DB::table('blog_category')->get();

        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Added Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }


    public function store(Request $request)
    {
        $upload_file = get_constant_value('IMAGES_FOLDER');
        $validator = Validator::make($request->all(), [
            'blog_title' => 'required',
            'blog_categoryid' => 'required',
            'content' => 'required',
            'file' => 'file|mimes:jpeg,png,jpg|max:5048',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('old_img_file', 'file');
        //$input = $request->all();

        $temp_file_names = '';

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            // 750*650
            $source = $image->getRealPath();
            $image_name = time() . rand() . '.' . $image->getClientOriginalExtension();
            $destination = public_path("uploads/blog_image/$image_name");
            resizeAndCompressImage($source, $destination, 750, 550, 60);
            $filename = $image_name;
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
        $blog_title = $request->get('blog_title');
        $blog_slug = Str::slug($blog_title);
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            if (!empty($filename)) {
                if (\File::exists('uploads/blog_image/' . $old_img_file)) {
                    unlink('uploads/blog_image/' . $old_img_file);
                }
            }

            $data = BlogSetup::where('id', $id)->first();

            $input['blog_slug'] = $blog_slug;
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['image'] = !empty($filename) ? $filename : $old_img_file;
            $input['is_publish'] = !empty($request->get('is_publish')) ? $request->get('is_publish') : 'N';

            // dd($input['image']);
            unset($input['id']);

            save_log('blog', 'id', $id, $input, 'Update');
            $update = \DB::table('blog')->where('id', $id)->update($input);
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
            $input['blog_slug'] = $blog_slug;
            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');
            $input['postby'] = $postby;
            $input['image'] = !empty($filename) ? $filename : $old_img_file;
            // dd($input['image']);

            if ($data = BlogSetup::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }



    public function blogsetup_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');

        $data = BlogSetup::get_blogsetup_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {

            $current_date = strtotime(CURDATE_EN);
            $array[$i]['id'] = $row->id;
            $array[$i]['blog_categoryid'] = $row->cat_name;
            $array[$i]['blog_title'] = $row->blog_title;
            $array[$i]['icon'] = $row->icon;
            $array[$i]['order'] = $row->order;
            $array[$i]['is_publish'] = $row->is_publish;
            $array[$i]['image'] = '<img src="' . asset("uploads/blog_image/" . $row->image) . '" height="30px" width="30px">';


            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/blog_setup/blogsetup_edit" data-id=' . $row->id . ' data-targetForm="blogForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            
            <a href="javascript:void(0)" class="view" data-url="/api/blog_setup/blogsetup_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>

            <a href="javascript:void(0)" class="btnDelete" data-url="/api/blog_setup/blogsetup_delete" data-id=' . $row->id . ' data-targetForm="blogForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function blogsetup_view(Request $request)
    {
        $trans = check_permission('View');

        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        $data = BlogSetup::get_all_blogsetup_data($id);

        $view = view("Blog/BlogSetupView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function blogsetup_edit(Request $request)
    {

        $id = $request->get('id');
        //$data['employees']=\DB::table('employee')->where(['isactive'=>'Y'])->get();
        $category = \DB::table('blog_category')->where(['is_active' => 'Y'])->get();
        $data = \DB::table('blog')->where('id', $id)->first();
        // echo "<pre>";
        // print_r($data);
        // die();

        $view = view("Blog/BlogSetup")
            ->with('data', $data)->with('category', $category);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function blogsetup_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('blog', 'id', $id, false, 'Delete');
        $data = BlogSetup::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}