<?php

namespace App\Http\Controllers\Api\Inquiry;

use Illuminate\Http\Request;
use App\Models\Inquiry\Inquiry;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class InquiryController extends Controller
{
    public function index()
    {
        $data['product'] = \DB::table('our_product')->where(['is_publish'=>'Y'])->get();
        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Added Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function ourproduct_inquiry_list()
    {
        $data['product'] =\DB::table('our_product')->where(['is_publish'=>'Y'])->get();
        // print_r($product);
        // die;
        $data = Inquiry::get_inquiry_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $i => $row) {

            $array[$i]['id'] = $row->id;
            $array[$i]['fullname'] = $row->fullname;
            $array[$i]['company_name'] = $row->company_name;
            $array[$i]['email'] = $row->email;
            $array[$i]['mobile_no'] = $row->mobile_no;
            $array[$i]['product_name'] = $row->product_name;
            $array[$i]['subject'] = $row->subject;
            $array[$i]['message'] = str_limit($row->message, 50);
            $array[$i]['postdatead'] = $row->postdatead.' '.$row->posttime;
            $array[$i]['action'] = '
            <a href="javascript:void(0)" class="view" data-url="/api/inquiry/view" data-id=' . $row->id . '><i class="fa fa-eye" /></i></a>';
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function view(Request $request)
    {
        $data = DB::table('ourproduct_enquiry as pe')
            ->select('pe.id', 'pe.fullname', 'pe.mobile_no', 'pe.email', 'pe.product_name','pe.subject', 'pe.message')
            ->where('pe.id', $request->id)
            ->first();
        $view = view('Inquiry.view')->with('data', $data);
        $template = $view->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template]);
        }
        return response()->json(['status' => 'error', 'message' => 'Error']);
    }
    
}
