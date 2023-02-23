<?php

namespace App\Http\Controllers\Api\Api;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;


class SurveyController extends Controller
{
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

    public function get_servey_form()
    {
      $form_data= \DB::table('survery_form_fields as sff')
                        ->leftJoin('survey_form_section as sfs','sfs.id','=','sff.sectionid')
                        ->leftJoin('survey_form as sf','sf.id','=','sff.formid')
                        ->where('sff.isactive','=','Y')->get();
    //   echo "<pre>";
    //   print_r($form_data);
    //   die();
        // $data=array('A','B','C');
        if($data)
        {
            return response()->json(['status'=>'success','message'=>'Data Available', 'data'=>$data]);
        }
        else
        {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
        }


    }

    
    

  
}
