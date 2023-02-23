<?php

namespace App\Http\Controllers\Api\AssociatedCollege;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AssociatedCollege\AssociatedCollege;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AssociatedCollegeController extends Controller
{
    public function store(Request $request)
    {
        $validation =  Validator::make($request->all(), [
            'college_name' => 'required|string|max:255',
            'college_url' => 'nullable|string',
            'file' => 'nullable|file|mimes:jpeg,png,gif,jpg|max:5120'
        ]);
        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
        }
        $input = $request->except('file', 'is_publish');
        // $old_img_file = $request->get('old_img_file');
        $input['is_publish'] = $request->is_publish ?? 'N';
        if ($request->hasFile('file')) {
            $images = $request->file('file');
            $image_name = $images->getClientOriginalName();
            $image_name = rand() . '-' . $image_name;
            $filename = preg_replace('/\s+/', '', $image_name);
            $images->move(('uploads/associated_college/'), $filename);
            $input['image'] = $filename;
        }

        $id = $request->id;
        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $data = AssociatedCollege::where('id', $id)->first();

            if (!empty($filename) && !empty($data->image)) {
                if (File::exists('uploads/associated_college/' . $data->image)) {
                    unlink('uploads/associated_college/' . $data->image);
                }
            }
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            $input['is_publish'] = !empty($request->get('is_publish')) ? $request->get('is_publish') : 'N';

            save_log('associated_college', 'id', $id, $input, 'Update');
            $update = $data->update($input);
            if ($update) {
                return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } else {
            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');
            $input['postby'] = $postby;

            if ($data = AssociatedCollege::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function view(Request $request)
    {
        $id = $request->id;
        $data = AssociatedCollege::where('id', $id)->first();
        $view = view('AssociatedCollege.view')->with('data', $data);
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Data Fetched Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
    }
    public function edit(Request $request)
    {
        $id = $request->id;
        $data = AssociatedCollege::where('id', $id)->first();
        // $view = view('AssociatedCollege.edit')->with('data', $data);
        // $template = $view->render();
        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data, 'message' => 'Data Fetched Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
    }
    public function delete(Request $request)
    {
        $id = $request->id;
        $data = AssociatedCollege::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Data Deleted Successfully']);
        }
        return response()->json(['status' => 'error', 'message' => 'Error Deleting Data']);
    }

    public function list()
    {
        $data = AssociatedCollege::get_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $i => $row) {

            $array[$i]['id'] = $row->id;
            $array[$i]['college_name'] = $row->college_name;
            $array[$i]['image'] =  !empty($row->image) ? '<img src="' . asset("uploads/associated_college/" . $row->image) . '" height="30px" width="30px">' : '';
            $array[$i]['college_url'] = $row->college_url;
            $array[$i]['is_publish'] = $row->is_publish;
            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/associated_college/edit" data-id=' . $row->id . ' data-targetForm="associatedCollegeForm"><i class="fa fa-edit"></i></a>
            &nbsp
            <a href="javascript:void(0)" class="view" data-url="/api/associated_college/view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/associated_college/delete" data-id=' . $row->id . ' data-targetForm="associatedCollegeForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }
}
