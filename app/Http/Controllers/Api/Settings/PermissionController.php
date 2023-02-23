<?php

namespace App\Http\Controllers\Api\Settings;

use App\Models\Settings\Permission;
use Illuminate\Http\Request;
use App\Models\Settings\Module;
use App\Http\Controllers\Controller;
use DB;
use Validator;

class PermissionController extends Controller
{
    public function __construct()
    {
        $this->adjacencyList="";
        $this->adjacencyCheckboxlist="";
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        //
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
//       try {
//   $this->buildXMLHeader;
// }
// catch (\Exception $e) {
//     return $e->getMessage();
// }
           

           $input = $request->all();
            $validator = Validator::make($request->all(), [
            'usergroupid'=>'required',]);
           if ($validator->fails()) {
        //    echo "test";
                return response()->json(['status'=>'error','message'=>$validator->errors()->all()]);
          }


            $usergroupid=$request->get('usergroupid');
            $moduleid=$request->get('moduleid');
            $insert=$request->get('insert');
            $view=$request->get('view');
            $delete=$request->get('delete');
            $update=$request->get('update');
            $approve=$request->get('approve');
            $postip=get_real_ipaddr();
            $postmac=get_Mac_Address();
            $postdatead=CURDATE_EN;
            $postdatebs=EngToNepDateConv($postdatead);
            $posttime=datetime('time');
            $postby=auth()->user()->id;
            $locationid=auth()->user()->locationid;
            $orgid=auth()->user()->orgid;
            $modifydatead=CURDATE_EN;
            $modifydatebs=EngToNepDateConv($postdatead);
            $modifytime=datetime('time');
            $modifyby=auth()->user()->id;
            $modifyip=get_real_ipaddr();
            $modifymac=get_Mac_Address();
            $db_permission_model=$this->get_permissionlist($usergroupid);
            // echo "DB Diff.<pre>";
            // print_r($db_permission_model);
            // die();

            // echo "Input Diff.<pre>";
            // print_r($moduleid);
            // die();
            
            if($db_permission_model)
            {
                $diffmodid = array_diff($db_permission_model, $moduleid);
                // echo "Diff.<pre>";
                // print_r($diffmodid);
                // die();
             if(!empty($diffmodid))
              {

                foreach($diffmodid  as $fmod){
                 $difmid=$fmod;
                    $dataArray=array(
                        'hasaccess'=>0,
                        'insert'=>'N',
                        'view'=>'N',
                        'update'=>'N',
                        'delete'=>'N',
                        'approve'=>'N',
                        'modifydatead'=>$modifydatead,
                        'modifydatebs'=>$modifydatebs,
                        'modifytime'=>$modifytime,
                        'modifyby'=>$modifyby,
                        'modifyip'=>$modifyip,
                        'modifymac'=>$modifymac);
                // echo "<pre></pre>";
                // print_r($dataArray);
                // die();
                // DB::enableQueryLog();
                 DB::table('modulespermission')
                                ->where('moduleid', $difmid)
                                ->where('usergroupid',$usergroupid)
                                ->where('orgid',$orgid)
                                // ->where('locationid',$locationid)
                                ->update($dataArray);
                                // $query = DB::getQueryLog();
                    // dd($query);
                }
                // die();
                }
            }
            $dataArray[]=array();
            if(!empty($moduleid))
            {
                foreach($moduleid  as $mod){
                    $modid=$mod;
                    // echo $modid;
                    // die();
                    $insert_st=!empty($insert[$mod])?$insert[$mod]:'N';

                    // echo $insert;
                    $view_st=!empty($view[$mod])?$view[$mod]:'N';
                    $update_st=!empty($update[$mod])?$update[$mod]:'N';
                    $delete_st=!empty($delete[$mod])?$delete[$mod]:'N';
                    $approve_st=!empty($approve[$mod])?$approve[$mod]:'N';
                    
                    if($insert_st=='N' &&  $view_st=='N' && $update_st=='N' &&  $delete_st=='N' && $approve_st=='N' )
                    {
                      $chk_child=$this->chek_module_child($modid);
                      if($chk_child)
                      {
                         $hasaccess=1;
                      }
                      else
                      {
                         $hasaccess=0;
                      }
                       
                    }
                    else
                    {
                        $hasaccess=1;
                    }
                    // echo $hasaccess;


                    if(in_array($modid,$db_permission_model))
                    {
                        $dataArray=array(
                            'usergroupid'=>$usergroupid,
                            'moduleid'=>$modid,
                            'hasaccess'=>$hasaccess,
                            'insert'=>$insert_st,
                            'view'=>$view_st,
                            'update'=>$update_st,
                            'delete'=>$delete_st,
                            'approve'=>$approve_st,
                            'modifydatead'=>$modifydatead,
                            'modifydatebs'=>$modifydatebs,
                            'modifytime'=>$modifytime,
                            'modifyby'=>$modifyby,
                            'modifyip'=>$modifyip,
                            'modifymac'=>$modifymac,
                        );
                         $dataArray=array_filter($dataArray);
                        if(!empty($dataArray))
                        {
                            DB::table('modulespermission')
                                ->where('moduleid', $modid)
                                ->where('usergroupid',$usergroupid)
                                ->where('orgid',$orgid)
                                // ->where('locationid',$locationid)
                                ->update($dataArray);
                        }
                    }

                    else
                    {
                        $dataArray=array(
                            'usergroupid'=>$usergroupid,
                            'moduleid'=>$modid,
                             'hasaccess'=>$hasaccess,
                            'insert'=>$insert_st,
                            'view'=>$view_st,
                            'update'=>$update_st,
                            'delete'=>$delete_st,
                            'approve'=>$approve_st,
                            'postip'=>$postip,
                            'postmac'=>$postmac,
                            'postdatead'=>$postdatead,
                            'postdatebs'=>$postdatebs,
                            'posttime'=>$posttime,
                            'postby'=>$postby,
                            'locationid'=>$locationid,
                            'orgid'=>$orgid
                        );
                         $dataArray=array_filter($dataArray);
                         if(!empty($dataArray))
                        {
                         DB::table('modulespermission')
                            ->insert($dataArray);
                        }

                    }
                }
            return response()->json(['status'=>'success','message'=>'Record Updated Successfully!!']);

        }



}


public function chek_module_child($modid)
{
    $query=DB::table('modules')
          ->where('parentmodule','=',$modid)
          ->get();
      if($query->count()>0)
      {
        return 1;
      }
      return 0;
}




    /**
     * Display the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        //
    }

    public function get_usergroup()
    {
        $data=Permission::where('accesstypes',1)
        ->get();
     }

     public function get_module(Request $request)
     {
          $this->groupArray=$this->get_permissionlist(0);

        $data='';
        $data .= $this->menu_premission_main(0,0,false,false,true,0);
    if($data)
        {
              return response()->json(['data'=>$data,'status'=>'success','message'=>'Record Selected Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }
     }

     public function get_permodule(Request $request)
     {
         $grpid=$request->get('groupid');
        //   echo $grpid;
        //  die();
             $this->groupArray=$this->get_permissionlist($grpid);
            //  echo "<pre>";
            //  print_r($this->groupArray);
            //  die();

        
        $data='';
        $data .= $this->menu_premission_main(0,0,false,false,true,$grpid);

        // echo $data;
        // die();
    if($data)
        {
              return response()->json(['data'=>$data,'status'=>'success','message'=>'Record Selected Successfully  !!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }
     }

     public function menu_premission_main($parent_id, $level, $location=false, $filename=false, $first_call = true,$groupid=false) {

        // echo "<pre>";
        // print_r($groupArray);
        // die();
        $softwareid=auth()->user()->softwareid;
         $headerlist=getallheaders();
          $lang=!empty($headerlist['language'])?$headerlist['language']:'en';
          
         if($first_call == true):
          $query=DB::table('modules')
          ->where('parentmodule','=',0)
          ->where('softwareid','=',$softwareid)
          ->get();
          $this->adjacencyCheckboxlist .= '<ul class="checktree">';
          else:
           $query=DB::table('modules')
          ->where('parentmodule','=',$parent_id)
          ->get();
          $this->adjacencyCheckboxlist .= "\n".'<ul>';
          endif;
          foreach ($query as $menu) :
              $query1=DB::table('modules')
              ->where('parentmodule','=',$menu->id)
              ->where('softwareid','=',$softwareid)
              ->get();
              $ckd='';
              if(!empty($this->groupArray)):
              if(in_array($menu->id,$this->groupArray))
              {
                $ckd='checked=checked';
              }
              else
              {
                $ckd='';
              }
            endif;
              $other_att='';
              //$menu_url = base_url($menu->modulelink);
              if($lang=='ne')
                {
                    $menu_name=$menu->displaytextnp;
                }
                else
                {
                    $menu_name=$menu->displaytext;
                }
              // $menu_name=$menu->displaytext;
              $active = "";
              $target = '';
              $sub_class='';
              $caret='';
                if(count($query1)>0)
                  {
                   $sub_class='chkmaster';
                }
                  foreach ($query1 as $ksm => $subtot) {
                  // echo $subtot->id."<br>";
                    $sub_sub_menu = $this->check_sub_menu($subtot->id);
                    if(count($sub_sub_menu) >0)
                    {
                      if($menu->parentmodule!=0)
                      {
                        $sub_class='dropdown-submenu';
                      }
                    }
                  }
              if($menu->parentmodule=='0')
              {
                $class_menu_item='';
              }
              else
              {
                $class_menu_item='';
              }
              if(count($query1) > 0):
                 $this->adjacencyCheckboxlist .= "\n".'<li class="'.$sub_class.' "><input name="moduleid[]" value="'.$menu->id.'" class="perm-check chkmaster_'.$parent_id.'"  type="checkbox" '.$ckd.' data-module_id='.$menu->id.'   />&nbsp;<strong>'.stripslashes($menu_name).'</strong>   ';
                      // if($menu->link=='login' && empty($this->session->userdata('loggedin')))
                      // {
                      $this->menu_premission_main($menu->id, $level+1, $location, $filename, false,$groupid);
                      // }
                      $this->adjacencyCheckboxlist .= '</li>'."\n";
              else:
                if($lang=='ne')
                {
                    $menu_name=$menu->displaytextnp;
                }
                else
                {
                    $menu_name=$menu->displaytext;
                }
                    $checkboxview='';
                    $chkview=$this->checkpermission($groupid,$menu->id,'view','Y');
                    if($chkview)
                    {
                      $checkboxview="checked=checked";
                    }
                    $checkboxinsert='';
                    $chkinsert=$this->checkpermission($groupid,$menu->id,'insert','Y');
                    if($chkinsert)
                    {
                      $checkboxinsert="checked=checked";
                    }
                    $checkboxupdate='';
                    $chkupdate=$this->checkpermission($groupid,$menu->id,'update','Y');
                    if($chkupdate)
                    {
                      $checkboxupdate="checked=checked";
                    }
                    $checkboxdelete='';
                    $chkdelete=$this->checkpermission($groupid,$menu->id,'delete','Y');
                    if($chkdelete)
                    {
                      $checkboxdelete="checked=checked";
                    }
                     $checkboxapproved='';
                    $chkapprove=$this->checkpermission($groupid,$menu->id,'approve','Y');
                    if($chkapprove)
                    {
                      $checkboxapproved="checked=checked";
                    }
                    $isinsert=$menu->isinsert;
                    if($isinsert=='Y')
                    {
                      $insrt='<span class="inline-check mw_100 chkbox_'.$menu->id.'"><input name="insert['.$menu->id.']" value="Y" class="operation chkbox_'.$menu->id.' chkmaster_'.$parent_id.'"   type="checkbox" '.$checkboxinsert.' data-operation="Insert" data-module_id='.$menu->id.' />&nbsp;Insert</span>';
                    }
                    else
                    {
                      $insrt='<span class="inline-check mw_100 chkbox_'.$menu->id.'"></span>';
                    }
                    $isview=$menu->isview;
                    if($isview=='Y')
                    {
                      $vwe='<span class="inline-check mw_100 chkbox_'.$menu->id.'" name="isview"  ><input  name="view['.$menu->id.']" value="Y" class="operation chkbox_'.$menu->id.' chkmaster_'.$parent_id.'"  data-operation="View" data-module_id='.$menu->id.'  type="checkbox" '.$checkboxview.' />&nbsp;View</span>';
                    }
                    else
                    {
                      $vwe='<span class="inline-check mw_100 chkbox_'.$menu->id.'"></span>';
                    }
                    $isupdate=$menu->isupdate;
                    if($isupdate=='Y')
                    {
                      $updat='<span class="inline-check mw_100 "><input name="update['.$menu->id.']"  class="operation chkbox_'.$menu->id.' chkmaster_'.$parent_id.'"   type="checkbox" '.$checkboxupdate.' data-operation="Update" data-module_id='.$menu->id.' value="Y" />&nbsp;Update</span>';
                    }
                    else
                    {
                      $updat='<span class="inline-check mw_100 chkbox_'.$menu->id.'"></span>';
                    }
                    $isdelete=$menu->isdelete;
                     if($isdelete=='Y')
                    {
                      $delt='<span class="inline-check mw_100"><input name="delete['.$menu->id.']" value="Y" class="operation chkbox_'.$menu->id.' chkmaster_'.$parent_id.'"  type="checkbox" '.$checkboxdelete.' data-operation="Delete" data-module_id='.$menu->id.' />&nbsp;Delete</span>';
                    }
                    else
                    {
                      $delt='<span class="inline-check mw_100 chkbox_'.$menu->id.'"></span>';
                    }
                    $isapproved=$menu->isapproved;
                    if($isapproved=='Y')
                    {
                      $approvd='<span class="inline-check mw_100"><input  name="approve['.$menu->id.']" value="Y" class="operation  chkbox_'.$menu->id.' chkmaster_'.$parent_id.'"  type="checkbox" '.$checkboxapproved.' data-operation="Approved" data-module_id='.$menu->id.' />&nbsp;Approved</span>';
                    }
                    else
                    {
                      $approvd='<span class="inline-check mw_100 chkbox_'.$menu->id.'"></span>';
                    }
                        $this->adjacencyCheckboxlist .= "\n".'<li class="checkli "><span class="inline-check"><input name="moduleid[]" value="'.$menu->id.'" class="perm-check chkmaster_'.$parent_id.'"  type="checkbox" '.$ckd.' data-module_id='.$menu->id.'  />&nbsp;'.stripslashes($menu_name).'</span><div class="checkbox-wrapper">'.$insrt.' '.$vwe.' '.$updat.' '.$delt.' '.$approvd.'</div></li>'."\n";
              endif;
          endforeach;
          $this->adjacencyCheckboxlist .= "</ul>\n";
            // var_dump( $this->adjacencyCheckboxlist);exit;
            return $this->adjacencyCheckboxlist;
         }
         public function get_permissionlist($groupid,$srcharr=false)
         {
          $arrayPer=array();
            // print_r($srcharr);
            // die();
          $orgid=auth()->user()->orgid;
          $vdata=DB::table('modulespermission');
            $vdata->where(['usergroupid'=>$groupid,'orgid'=>$orgid,'hasaccess'=>1]);
            if(!empty($srcharr))
            {
                $vdata->where($srcharr, null, false);
            }
           $permission_list= $vdata->get();
          if($permission_list)
          {
            foreach ($permission_list as $kp=>$per) {
             $arrayPer[]=$per->moduleid;
            }
            return $arrayPer;
          }
          return false;
         }

         public function checkpermission($groupid,$moduid,$column,$status)
         {
               $orgid=auth()->user()->orgid;
          $rows=DB::table('modulespermission')
          ->where('usergroupid',$groupid)
          ->where('hasaccess',1)
          ->where('moduleid',$moduid)
          ->where('orgid',$orgid)
          ->where($column,$status)
          ->count();
            if($rows)
            {
            return true;
            }
            return false;
         }


         public function check_sub_menu($id=false) {
          $softwareid=auth()->user()->softwareid;
          $rows=DB::table('modules')
          ->where('parentmodule',$id)
          ->where('softwareid',$softwareid)
          ->get();
          // echo $this->db->last_query();
          // die();
          //if(count($rows)>0)
          //{
            return $rows;
          //}
         // return false;
      }

}
