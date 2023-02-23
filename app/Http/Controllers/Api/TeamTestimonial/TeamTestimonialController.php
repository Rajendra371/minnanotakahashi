<?php

namespace App\Http\Controllers\Api\TeamTestimonial;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\TeamTestimonial\TeamTestimonial;


class TeamTestimonialController extends Controller
{
    public function store(Request $request)
    {
        $id = $request->id;

        if ($id) {
            $image_validation = "nullable|file|mimes:jpeg,png,jpg|max:2048";
        } else {
            $image_validation = "required|file|mimes:jpeg,png,jpg|max:2048";
        }
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:50',
            'designation' => 'required|string|max:50',
            'description' => 'required',
            // 'contactno' => 'required|numeric|digits_between:8,10',
            // 'email' => 'required|email|max:50',
            'file' => $image_validation,
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('id', 'file', 'isactive');
        $input['isactive'] = $request->isactive ?? 'N';

        if ($request->hasFile('file')) {
            $image = $request->file('file');
            $team_image_name =  rand() . $image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '', $team_image_name);
            $image->move(('uploads/testimonial_image/'), $filename);
            $input['image'] = $filename;
        }

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

            $data = TeamTestimonial::where('id', $id)->first();

            if (!empty($input['filename']) && !empty($data->image)) {
                if (File::exists('uploads/testimonial_image/' . $data->image)) {
                    unlink('uploads/testimonial_image/' . $data->image);
                }
            }

            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');

            save_log('our_team', 'id', $id, $input, 'Update');

            if ($data->update($input)) {
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

            if (TeamTestimonial::create($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function teamtestimonial_list()
    {

        $data = TeamTestimonial::get_team_list();

        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $i => $row) {
            if (!empty($row->image) && file_exists(public_path('uploads/testimonial_image/' . $row->image))) {
                $image = '<img src="' . asset("uploads/testimonial_image/" . $row->image) . '" height="30px" width="30px">';
            } else {
                $image = '';
            }
            $array[$i]['id'] = $row->id;
            $array[$i]['name'] = $row->name;
            $array[$i]['designation'] = $row->designation;
            $array[$i]['type'] = $row->type;
            $array[$i]['contactno'] = $row->contactno;
            $array[$i]['email'] = $row->email;
            $array[$i]['image'] = $image;

            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/teamtestimonial/teamtestimonial_edit" data-id=' . $row->id . ' data-targetForm="teamForm" data-edittype="template"><i class="fa fa-edit"></i></a>
            
            <a href="javascript:void(0)" class="view" data-url="/api/teamtestimonial/teamtestimonial_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>
    
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/teamtestimonial/teamtestimonial_delete" data-id=' . $row->id . ' data-targetForm="pageForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function teamtestimonial_view(Request $request)
    {
        $trans = check_permission('View');

        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $id = $request->get('id');
        $data = TeamTestimonial::get_all_testimonial_data($id);

        $view = view("TeamTestimonial/TeamTestimonialView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
    public function teamtestimonial_edit(Request $request)
    {
        $id = $request->get('id');
        $data = TeamTestimonial::where('id', $id)->first();
        $view = view("TeamTestimonial/TeamTestimonial")
            ->with('data', $data);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function teamtestimonial_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('our_team', 'id', $id, false, 'Delete');
        $data = TeamTestimonial::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}