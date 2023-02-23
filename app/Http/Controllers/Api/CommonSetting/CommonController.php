<?php

namespace App\Http\Controllers\Api\CommonSetting;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{

    public function getCommonFormData()
    {
        try {
            $data['location_option'] = location_option(2, 'location_id', 'location_id');
            return response()->json(['status' => 'success', 'data' => $data]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }

    public function check_site_status()
    {
        $data = DB::table('site_settings')->first();
        if ($data) {
            if ($data->site_status == 3) {
                return response()->json(['status' => 'success', 'data' => true]);
            } else {
                return response()->json(['status' => 'error', 'data' => false]);
            }
        }
    }

    public function maintenance_key_access(Request $request)
    {
        $key = $request->get('maintenance_key');
        $db_key = DB::table('site_settings')->value('maintenance_key');
        if ($db_key == $key) {
            session(['key' => true]);

            return response()->json(['status' => 'success']);
            // return redirect('/');
        } else {
            return response()->json(['status' => 'error']);
            // return view('maintenance')->with('error','Invalid Key');
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        // $page_size = $request->get('id');

        if (!empty($input)) {

            foreach ($input as $ki => $inp) {
                $list_inp[] = explode('@', $ki);
                $inp_val[] = $inp;
            }
            $dbtable = array();
            $i = 0;
            foreach ($list_inp as $field) {
                // $dbtable[$field[0]][]=$field[1];
                // echo $field[0];
                $dbtable[$field[0]][$field[1]] = !empty($inp_val[$i]) ? $inp_val[$i] : '';

                $i++;
            }
            foreach ($dbtable as $ktbl => $fval) {
                if ($data = DB::table($ktbl)->insert($fval)) {
                    // return response()->json(['status'=>'success','message'=>'Record Saved Successfully!!']);
                }
            }
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
    }

    public function load_current_date()
    {
        $current_date_en = CURDATE_EN;
        $current_date_np = EngToNepDateConv($current_date_en);
        $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');
        // echo $defaultpicker;
        // die();
        if ($defaultpicker == 'NP') {
            $current_date = $current_date_np;
        } else {
            $current_date = $current_date_en;
        }


        if ($current_date) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'current_date' => $current_date]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function load_system_info()
    {
        $data = DB::table('orgsoftware as os')
            ->join('software as  s', 's.id', '=', 'os.softwareid')
            ->join('organization as o', 'o.id', '=', 'os.locationid')
            ->join('location as l', 'l.id', '=', 'os.orgid')
            ->where('os.orgid', 1)
            ->where('os.locationid', 1)
            ->select('o.orgname', 'o.orgaddress1', 'o.orgaddress2', 'o.contact', 'o.email', 'o.website', 'o.logo', 's.softwarename', 'l.locname', 'l.ismain')
            ->first();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function num_to_word(Request $request)
    {
        $num = $request->get('num');
        // echo $num;
        // die();
        if ($num > 0) {
            $template = convert_to_word($num);

            // echo $template;
            if ($template) {
                return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => ucwords($template)]);
            }
        }
        return response()->json(['status' => 'success', 'message' => 'Data Available', 'template' => '']);
    }
}