<?php

namespace App\Http\Controllers\Api\Advertisement;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use App\Models\Advertisement\Advertisement;



class AdvertisementController extends Controller
{
    public function index()
    {

        $data['adv_loc'] = DB::table('advertisement_location as als')->select(DB::raw("concat(al.location_name,'-',als.location_name) as locname"), 'als.id')->leftJoin('advertisement_location as al', 'als.parent_location', '=', 'al.id')->where('als.parent_location', '!=', 0)->get();

        $data['menu'] = DB::table('menu')->get();
        // echo"<pre>";      
        // print_r($data);
        // die();

        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Added Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }



    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'ad_page_id' => 'required',
            'content' => 'required',
            'file' => 'file|mimes:jpeg,png,gif,jpg|max:5120',
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $input = $request->except('old_img_file');

        if ($request->hasFile('file')) {
            $adv_image = $request->file('file');
            $adv_image_name = time() . rand() .$adv_image->getClientOriginalName();
            $filename = preg_replace('/\s+/', '', $adv_image_name);
            $adv_image->move(('uploads/advertisement/'), $filename);
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
        $old_img_file = $request->get('old_img_file');
        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            if (!empty($filename)) {
                if (File::exists('uploads/advertisement/' . $old_img_file)) {
                    unlink('uploads/advertisement/' . $old_img_file);
                }
            }
            $data = Advertisement::where('id', $id)->first();


            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['adv_image'] = !empty($filename) ? $filename : $old_img_file;
            $input['modifytime'] = date('H:i:s');
            $input['is_publish'] = !empty($request->get('is_publish')) ? $request->get('is_publish') : 'N';
            $input['is_unlimited'] = !empty($request->get('is_unlimited')) ? $request->get('is_unlimited') : 'N';

            unset($input['id']);
            unset($input['file']);
            unset($input['old_img_file']);

            save_log('advertisement', 'id', $id, $input, 'Update');
            $update = DB::table('advertisement')->where('id', $id)->update($input);
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
            $input['adv_image'] = !empty($filename) ? $filename : $old_img_file;
            unset($input['file']);
            if ($data = Advertisement::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }




    public function advertisement_list(Request $request)
    {
        $date_type = get_constant_value('DEFAULT_DATEPICKER');

        $data = Advertisement::get_advertisement_list();

        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $i = 0;
        $array = array();
        foreach ($data as $key => $row) {

            $current_date = strtotime(CURDATE_EN);
            if ($date_type == 'NP') {
                $start_date = $row->startdate;
                $end_date = $row->enddate;
            } else {
                $start_date = $row->startdate;
                $end_date = $row->enddate;
            }

            $array[$i]['id'] = $row->id;
            $array[$i]['ad_page_id'] = $row->menu_name;
            $array[$i]['ad_locationid'] = $row->location_name;
            $array[$i]['startdate'] = $start_date;
            $array[$i]['enddate'] =  $end_date;
            $array[$i]['is_publish'] =  $row->is_publish;
            $array[$i]['is_unlimited'] =  $row->is_unlimited;
            $array[$i]['order'] = $row->order;
            $array[$i]['content'] = $row->content;

            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/advertisement/advertisement_edit" data-id=' . $row->id . ' data-targetForm="contractForm" data-edittype="template"><i class="fa fa-edit"></i></a>

            <a href="javascript:void(0)" class="view" data-url="/api/advertisement/advertisement_view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>

            <a href="javascript:void(0)" class="btnDelete" data-url="/api/advertisement/advertisement_delete" data-id=' . $row->id . ' data-targetForm="contractForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';

            $i++;
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }
    public function advertisement_view(Request $request)
    {

        $trans = check_permission('View');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        $data = Advertisement::get_all_advertisement_data($id);


        $view = view("Advertisement/AdvertisementView")
            ->with('data', $data);

        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => $template]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function advertisement_edit(Request $request)
    {

        $id = $request->get('id');

        $menu = DB::table('menu')->where(['menu_isactive' => 'Y'])->get();
        $location = DB::table('advertisement_location')->where(['is_active' => 'Y'])->get();
        $data = DB::table('advertisement')->where('id', $id)->first();
        // dd($data);
        // die();
        $view = view("Advertisement/Advertisement")
            ->with('data', $data)->with('location', $location)->with('menu', $menu);

        $template = $view->render();

        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'data' => '', 'message' => 'Unable to Edit']);
        }
    }

    public function advertisement_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->get('id');
        save_log('advertisement', 'id', $id, false, 'Delete');
        $data = Advertisement::where('id', $id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }
}
