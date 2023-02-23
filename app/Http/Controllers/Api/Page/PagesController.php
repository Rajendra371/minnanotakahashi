<?php

namespace App\Http\Controllers\Api\Page;
use Illuminate\Support\Str;
use App\Models\Page\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use DB;
use Validator;


class PagesController extends Controller
{
    public function index()
    {
        $data['menu'] = DB::table('menu')->get();

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
            'page_title' => 'required',
            'file' => 'file|mimes:jpeg,png,jpg|max:5048',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('old_img_file', 'file');

        $temp_file_names = '';

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $source = $image->getRealPath();
            $image_name = time() . rand() . '.' . $image->getClientOriginalExtension();
            $destination = public_path("uploads/page_image/$image_name");
            resizeAndCompressImage($source, $destination, 460, 320, 60);
            $filename = $image_name;
        }

        $old_img_file = $request->get('old_img_file');
        $id = $request->get('id');

        $postby = auth()->user()->id;
        $locationid = auth()->user()->locationid;
        $orgid = auth()->user()->orgid;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();
        $page_title = $request->get('page_title');
        $slug =  Str::slug($page_title);
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            if (!empty($filename)) {
                if (\File::exists('uploads/page_image/' . $old_img_file)) {
                    unlink('uploads/page_image/' . $old_img_file);
                }
            }

            $data = Page::where('id', $id)->first();

            $input['page_slug'] = $slug;
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['images'] = !empty($filename) ? $filename : $old_img_file;
            $input['is_publish'] = !empty($request->get('is_publish')) ? $request->get('is_publish') : 'N';


            unset($input['id']);

            save_log('pages', 'id', $id, $input, 'Update');
            $update = \DB::table('pages')->where('id', $id)->update($input);
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
            $input['page_slug'] = $slug;
            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');
            $input['postby'] = $postby;
            $input['images'] = !empty($filename) ? $filename : $old_img_file;

            if ($data = Page::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }



    public function page_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');
        $data = Page::get_page_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {

            $current_date = strtotime(CURDATE_EN);

            $array[$i]['id'] = $row->id;
            $array[$i]['menuid'] = $row->menu_name;
            $array[$i]['page_title'] = $row->page_title;
            $array[$i]['images'] =  !empty($row->images) ? '<img src="' . asset("uploads/page_image/" . $row->images) . '" height="30px" width="30px">' : '';

            $array[$i]['short_content'] = $row->short_content;
            $array[$i]['is_publish'] = $row->is_publish;

            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/page/page_edit" data-id=' . $row->id . ' data-targetForm="pageForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            
            &nbsp
            <a href="javascript:void(0)" class="view" data-url="/api/page/page_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/page/page_delete" data-id=' . $row->id . ' data-targetForm="pageForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }
    public function page_view(Request $request)
    {
        $trans = check_permission('View');

        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = Page::get_all_page_data($id);

        $view = view("Page/PageView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function page_edit(Request $request)
    {

        $id = $request->get('id');
        $menu = \DB::table('menu')->where(['menu_isactive' => 'Y'])->get();
        $data = \DB::table('pages')->where('id', $id)->first();
        // echo "<pre>";
        // print_r($menu);
        // die();

        $view = view("Page/Page")
            ->with('data', $data)->with('menu', $menu);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function page_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('pages', 'id', $id, false, 'Delete');
        $data = Page::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}