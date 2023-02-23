<?php

namespace App\Http\Controllers\Api\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Frontend\FrontendTiles;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class FrontendTilesController extends Controller
{
    public function store(Request $request)
    {
        $validation =  Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required',
            'file' => 'nullable|file|mimes:jpeg,png,jpg|max:2048'
        ]);
        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
        }
        $input = $request->except('old_img_file', 'file', 'is_publish', 'for_header', 'for_footer', 'for_body');
        $old_img_file = $request->get('old_img_file');
        $filename = '';
        if ($request->hasFile('file')) {
            $images = $request->file('file');
            $image_name = $images->getClientOriginalName();
            $image_name = rand() . '-' . $image_name;
            $filename = preg_replace('/\s+/', '', $image_name);
            $images->move(('uploads/frontend_tiles/'), $filename);
        }

        $id = $request->id;
        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();

        $input['is_publish'] = $request->is_publish ?? 'N';
        $input['for_header'] = $request->for_header ?? 'N';
        $input['for_footer'] = $request->for_footer ?? 'N';
        $input['for_body'] = $request->for_body ?? 'N';

        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            if (!empty($filename) && !empty($old_img_file)) {
                if (File::exists('uploads/frontend_tiles/' . $old_img_file)) {
                    unlink('uploads/frontend_tiles/' . $old_img_file);
                }
            }
            $data = FrontendTiles::where('id', $id)->first();
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['image'] = !empty($filename) ? $filename : $old_img_file;

            // save_log('study_destinations', 'id', $id, $input, 'Update');
            $update = $data->update($input);
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
            $input['image'] = !empty($filename) ? $filename : $old_img_file;

            if ($data = FrontendTiles::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function view(Request $request)
    {
        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->id;
        $data = FrontendTiles::where('id', $id)->first();
        $view = view('Frontend.FrontendTiles.view')->with('data', $data);
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Data Fetched Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = FrontendTiles::where('id', $id)->first();
        $view = view('Frontend.FrontendTiles.edit')->with('data', $data);
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Data Fetched Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
    }
    public function delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->id;
        $data = FrontendTiles::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Data Deleted Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Error Deleting Data']);
    }


    public function list()
    {
        $data = FrontendTiles::get_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $i => $row) {

            $array[$i]['id'] = $row->id;
            $array[$i]['title'] = $row->title;
            $array[$i]['image'] =  !empty($row->image) ? '<img src="' . asset("uploads/frontend_tiles/" . $row->image) . '" height="30px" width="30px">' : '';
            $array[$i]['content'] = str_limit($row->content, 50, '...');
            $array[$i]['icon'] = $row->icon;
            $array[$i]['is_publish'] = $row->is_publish;
            $array[$i]['for_header'] = $row->for_header;
            $array[$i]['for_footer'] = $row->for_footer;
            $array[$i]['for_body'] = $row->for_body;
            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/frontend_tiles/edit" data-id=' . $row->id . ' data-targetForm="frontendTiles" data-edittype="template"><i class="fa fa-edit"></i></a>
            &nbsp
            <a href="javascript:void(0)" class="view" data-url="/api/frontend_tiles/view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/frontend_tiles/delete" data-id=' . $row->id . ' data-targetForm="frontendTiles" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }
}