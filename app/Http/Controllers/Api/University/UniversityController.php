<?php

namespace App\Http\Controllers\Api\University;
use DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\University\University;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class UniversityController extends Controller
{
    public function index()
    {
        $data['country'] = DB::table('study_destinations')->get();
        // dd($data['country']);
        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Added Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function store(Request $request)
    {
        $validation =  Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'short_content' => 'required',
            'content' => 'required',
            'file' => 'nullable|file|mimes:jpeg,png,gif,jpg|max:5120'
        ]);
        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
        }
        $input = $request->except('old_img_file', 'file', 'is_publish');
        $old_img_file = $request->get('old_img_file');
        $input['is_publish'] = $request->is_publish ?? 'N';
        if ($request->hasFile('file')) {
            $images = $request->file('file');
            $image_name = $images->getClientOriginalName();
            $image_name = rand() . '-' . $image_name;
            $filename = preg_replace('/\s+/', '', $image_name);
            $images->move(('uploads/university/'), $filename);
        }

        $id = $request->id;
        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();
        $title = $request->get('title');
        $slug =  Str::slug($title);
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            if (!empty($filename) ) {
                if (File::exists('uploads/university/' . $old_img_file)) {
                    if(!empty($old_img_file)){
                    unlink('uploads/university/' . $old_img_file);
                }
                }
            }
            $data = University::where('id', $id)->first();
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

            save_log('universities', 'id', $id, $input, 'Update');
            $update = $data->update($input);
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

            if ($data = University::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function view(Request $request)
    {
        $id = $request->id;
        $data = University::where('id', $id)->first();
        $view = view('University.view')->with('data', $data);
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Data Fetched Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = University::where('id', $id)->first();
        $country = DB::table('study_destinations')->get();
        $view = view('University.edit')->with('data', $data)->with('country', $country);
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Data Fetched Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $data = University::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Data Deleted Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Error Deleting Data']);
    }

    public function list()
    {
        $data = University::get_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $i => $row) {

            $array[$i]['id'] = $row->id;
            $array[$i]['title'] = $row->title;
            $array[$i]['image'] =  !empty($row->images) ? '<img src="' . asset("uploads/university/" . $row->images) . '" height="30px" width="30px">' : '';
            $array[$i]['short_content'] = str_limit($row->short_content, 50, '...');
            $array[$i]['is_publish'] = $row->is_publish;
            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/university/edit" data-id=' . $row->id . ' data-targetForm="universityForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            &nbsp
            <a href="javascript:void(0)" class="view" data-url="/api/university/view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/university/delete" data-id=' . $row->id . ' data-targetForm="universityForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }
}
