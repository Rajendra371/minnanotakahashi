<?php

namespace App\Http\Controllers\Api\Api;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;


class TestController extends Controller
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

   
    public function product_color_manage(){
        $tbl_data=\DB::table('merorug_product_final')->select('*')->get();

        // echo "<pre>";
        // print_r($tbl_data);
        // die();
        if(!empty($tbl_data)){
            foreach($tbl_data as $k=>$tdata){
                $carr=array();
                $id=$tdata->id;
                $color=$tdata->color;
                if(!empty($color)){
                    $colarr=explode(',',$color);
                    if(!empty($colarr) && is_array($colarr)){
                        $cnt_color=sizeof($colarr);
                            for($i=0;$i<$cnt_color;$i++){
                                
                               $cid= \DB::table('product_color')->where('color_name','=',$colarr[$i])->select('id')->first();
                               $carr[]= $cid->id;
                            }   
                            $coloridarray=implode(',',$carr);

                            \DB::table('merorug_product_final')->where('id','=',$id)->update(['colorid'=>$coloridarray]);

                        
                        
                    }

                }
            }
        }
    }

    public function product_material_manage(){
        $tbl_data=\DB::table('merorug_product_final')->select('*')->get();

        // echo "<pre>";
        // print_r($tbl_data);
        // die();
        if(!empty($tbl_data)){
            foreach($tbl_data as $k=>$tdata){
                $marr=array();
                $id=$tdata->id;
                $material=$tdata->material;
                if(!empty($material)){
                    $materialarr=explode(',',$material);
                    if(!empty($materialarr) && is_array($materialarr)){
                        $cnt_mat=sizeof($materialarr);
                            for($i=0;$i<$cnt_mat;$i++){     
                               $cid= \DB::table('product_material')->where('material_name','=',$materialarr[$i])->select('id')->first();
                               $marr[]= $cid->id;
                            }   
                            $materialidarray=implode(',',$marr);

                            \DB::table('merorug_product_final')->where('id','=',$id)->update(['materialid'=>$materialidarray]);     
                    }

                }
            }
        }
    }

    public function product_manage_image(){
        $tbl_data=\DB::table('merorug_product_final')->select('*')->get();

        // echo "<pre>";
        // print_r($tbl_data);
        // die();
        if(!empty($tbl_data)){
            foreach($tbl_data as $k=>$tdata){
                $marr=array();
                $id=$tdata->id;
                $img_data=$tdata->picture_no;
                if(!empty($img_data)){
                    $img_final='9Z4A'.sprintf('%04d', $img_data).'.jpg';
                    \DB::table('merorug_product_final')->where('id','=',$id)->update(['images'=>$img_final]);     
                }
                
               

               
            }
        }
    }


}

    
    

  

