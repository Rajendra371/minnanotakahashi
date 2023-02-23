<?php

namespace App\Http\Controllers\Api\Settings;

use DB;
use App\Models\Settings\Organization;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Organization::all();

        // return $result;
        if($data)
        {
              return response()->json(['data'=>$data,'status'=>'success','message'=>'Record Deleted Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }
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
        $storeName = "Null";

        // if($request->get('logo') != null){
        //     $image = $request->get('logo').getClientOriginalName();
        //     $storeName = time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
        //     \Image::make($request->get('logo'))->save(public_path('images/').$storeName);
        // }

        $data = new organization();
            $data->organame = $request->organame;
            $data->orgaddress1 = $request->address1;
            $data->orgaddress2 = $request->address2;
            $data->contactno = $request->contact;
            $data->website = $request->website;
            $data->email = $request->email;
            $data->qrurl = $request->QrUrl;
            $data->isactive = $request->isActive;
            $data->image = $storeName;
        $data->save();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = organization::where('orgaid', $id)->first();

        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = organization::where('orgaid', $id)
        ->update([
            'organame' => $request->organame,
            'orgaddress1' => $request->address1,
            'orgaddress2' => $request->address2,
            'contactno' => $request->contact,
            'website' => $request->website,
            'email' => $request->email,
            'qrurl' => $request->QrUrl,
            'isactive' => $request->isActive,
            'image' => $request->logo,
        ]);
        return $data;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        organization::where('orgaid', $id)->delete();
    }
}
