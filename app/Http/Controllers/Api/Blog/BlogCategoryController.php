<?php

namespace App\Http\Controllers\Api\Blog;

use App\Models\Blog\BlogCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;


class BlogCategoryController extends Controller
{

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
        $cat_slug = strtolower(preg_replace('/\s+/', '-', $cat_name));
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $data = BlogCategory::where('id', $id)->first();
            $input['cat_slug'] = $cat_slug;
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['is_active'] = !empty($request->get('is_active')) ? $request->get('is_active') : 'N';
            save_log('blog_category', 'id', $id, $input, 'Update');
            $update = \DB::table('blog_category')->where('id', $id)->update($input);
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
            $input['cat_slug'] = $cat_slug;
            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');
            $input['postby'] = $postby;
            if ($data = BlogCategory::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }


    public function blogcategory_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');

        $data = BlogCategory::get_blogcategory_list();

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


            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/blog_category/blogcategory_edit" data-id=' . $row->id . ' data-targetForm="blogcatForm" data-edittype="template"><i class="fa fa-edit"></i></a>

            <a href="javascript:void(0)" class="view" data-url="/api/blog_category/blogcategory_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>

            <a href="javascript:void(0)" class="btnDelete" data-url="/api/blog_category/blogcategory_delete" data-id=' . $row->id . ' data-targetForm="blogcatForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function blogcategory_view(Request $request)
    {
        $trans = check_permission('View');

        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = BlogCategory::get_all_blogcategory_data($id);

        $view = view("Blog/BlogCategoryView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
    public function blogcategory_edit(Request $request)
    {

        $id = $request->get('id');
        // $location =\DB::table('advertisement_location')->where(['is_active'=>'Y'])->get();
        $data = \DB::table('blog_category')->where('id', $id)->first();
        $view = view("Blog/BlogCategory")
            ->with('data', $data);
        // ->with('location',$location);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function blogcategory_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('blog_category', 'id', $id, false, 'Delete');
        $data = BlogCategory::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}