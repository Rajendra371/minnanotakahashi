<?php
    use App\Models\Constant;
    use App\Models\Date;
     $cur_date=date('Y/m/d');
     define('CURDATE_EN', $cur_date);
      $np_date=$this->EngToNepDateConv($cur_date);
      define('CURDATE_NP',$np_date);
      $np_date=explode('/', $np_date);
      $cur_year=$np_date[0];
      $cur_month=$np_date[1];
      $cur_days=$np_date[2];
      define('CURYEAR', $cur_year);
      define('CURMONTH', $cur_month);
      define('CURDAYS', $cur_days);
  
    function datetime($time=false)
    {
        if($time=='time')
        {
          return date('H:i:s');
        }
        return date('Y-m-d H:i:s');
    }

     function get_real_ipaddr()
     {
         if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
           $ip=$_SERVER['HTTP_CLIENT_IP'];
         elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
             $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
         else
           $ip=$_SERVER['REMOTE_ADDR'];
         return $ip;
       }

       function consts()
       {
           $cur_date=date('Y/m/d');
           $data=General::EngToNepDateConv($cur_date);
           return $data;
       }

       function get_Mac_Address(){
        ob_start();
        system('ipconfig-a');
        $mycomsys=ob_get_contents();
        ob_clean();
        $find_mac = "Physical";
        $pmac = strpos($mycomsys, $find_mac);
        $macaddress=substr($mycomsys,($pmac+37),18);
        return $macaddress;
    }

    function compute_data_for_edit($date=false,$time=false)
    {
        $concate_date_time=$date.' '.$time;
        // echo strtotime($concate_date_time);
        // die();
        $new_date_time = strtotime($concate_date_time . "+".EDIT_HOURS." hours");
        $current_date_time=time('now');
        // echo date('Y/m/d H:i:s',$current_date_time);
        // die();
        // echo $new_date_time;
        if($current_date_time >= $new_date_time )
        {
          return 0;
        }
        return 1;
    }

    function get_tbl_data($select=false,$table, $where = false, $order = false, $order_by = 'ASC') {
         $vdata=DB::table($table);
         if ($select) {
             $vdata ->select($select, null, false);
           }
         if ($where) {
           $vdata ->where($where, null, false);
         }
         if ($order) {
            $vdata->order_by($order, $order_by);
         }
         $result=$vdata->get();
         // echo $this->ci->db->last_query(); exit;
         // if ($result->num_rows() > 0) {
         // 	return $result->result();
         // }
         return $result;
     }
     function EngToNepDateConv($date=false)
     {
      try {
             $query=DB::where('addate',$date)
             ->select('bsdate')
             ->first();
            $result=$query->bsdate;
            return $result;
             } catch (Exception $e) {
                 return array();
             }
         }

         function NepToEngDateConv($date=false)
         {
         try {
                 $query=DB::table('nepequengdate')
                 ->select('addate')
                 ->where('bsdate',$date)
                 ->first();
                 $result=$query->addate;
                 return $result;
                 } catch (Exception $e) {
                     return array();
                 }
         }

         function load_db_constant()
         {
            $db_constant=Constant::where('isactive','Y')
            ->get();
        //    echo "<pre>";
        //    print_r($db_constant);
        //    die();
           if(!empty($db_constant))
           {
             foreach ($db_constant as $kcon => $const) {
               echo define($const->name,$const->value);
             }
           }
           // die();
         }


         // function check_permission($action=false)
         // {
         //   $groupid=auth()->user()->group_id;
         //   $softwareid=auth()->user()->softwareid;
         //   $base_url=\URL::to('/');
         //    $currenturl= $_SERVER['HTTP_REFERER'];
         //    //     die();
         //    $new_url=str_replace($base_url,"",$currenturl);
         //    $urlchk= $new_url;
         //     $result=DB::table('modules as m')
         //     ->leftJoin('modulespermission as mp','mp.id', '=', 'm.id')
         //    ->where('m.modulelink','=',$urlchk)
         //    ->where('mp.usergroupid','=',$groupid)
         //    ->where('m.softwareid','=',$softwareid)
         //    ->select('mp.*')
         //    ->first();
         //    if($result)
         //    {
         //         $insert_action=$result->insert;
         //         $view_action=$result->view;
         //         $update_action=$result->update;
         //         $delete_action=$result->delete;
         //         $approved_action=$result->approve;
         //        //  echo $insert_action;
         //        //  die();
         //         if($action=='Insert' && $insert_action=='N')
         //         {
         //            return 'error';
         //            exit;
         //          }
         //         if($action=='View' && $view_action=='N')
         //         { 
         //           return 'error';
         //           exit;
         //          }
         //        if($action=='Update' && $update_action=='N')
         //         {
         //           return 'error';
         //           exit;
         //          }
         //        if($action=='Delete' && $delete_action=='N')
         //         {
         //          return 'error';
         //           exit;
         //         }

         //         if($action=='Approved' && $approved_action=='N')
         //         {
         //            return 'error';
         //           exit;
         //         }
                 
         //    }
         //    else
         //    {
         //        return false;

         //    }
         // }

         function check_permission($action=false)
         {
           $groupid=auth()->user()->group_id;
           $softwareid=auth()->user()->softwareid;
           $base_url=\URL::to('/');
            $currenturl= $_SERVER['HTTP_REFERER'];
            //     die();
            $new_url=str_replace($base_url,"",$currenturl);
            $urlchk= $new_url;
             $nquery=\DB::table('modules as m')
             ->leftJoin('modulespermission as mp','mp.moduleid', '=', 'm.id')
            ->where('m.modulelink','=',$urlchk)
            ->where('mp.usergroupid','=',$groupid);
            // if($action=='hasaccess'){
            //   $nquery->where('mp.hasaccess','=','1');
            // }
            $result=$nquery->where('m.softwareid','=',$softwareid)
                    ->select('mp.*','m.*')
                    ->first();
            // echo "<pre>";
            // print_r($result);
            // die();
            if($result)
            {
                 $insert_action=$result->insert;
                 $view_action=$result->view;
                 $update_action=$result->update;
                 $delete_action=$result->delete;
                 $approved_action=$result->approve;
                 $hasaccess=$result->hasaccess;
                //  echo $insert_action;
                //  die();
                 if($action=='Insert' && $insert_action=='N')
                 {
                    return 'error';
                    exit;
                  }
                 if($action=='View' && $view_action=='N')
                 { 
                   return 'error';
                   exit;
                  }
                if($action=='Update' && $update_action=='N')
                 {
                   return 'error';
                   exit;
                  }
                if($action=='Delete' && $delete_action=='N')
                 {
                  return 'error';
                   exit;
                 }

                 if($action=='Approved' && $approved_action=='N')
                 {
                    return 'error';
                   exit;
                 }
                 if($action=='hasaccess' && $hasaccess=='0')
                 {
                    return 'error';
                   exit;
                 }
                 
            }
            else
            {
                return false;

            }
         }

        function permission_message()
        {
           echo json_encode(['status'=>'error','permission'=>'no','message'=>"You don't have permission"]);   
        }

        function save_log($tablename=false,$primarykey=false,$primaryid=false,$postdata=false,$action=false)
        {
            // echo "<pre>";
          $json_new_data= json_encode($postdata);
          // die();
          $old_rec=DB::table($tablename)->where($primarykey,'=',$primaryid)->first();
          // echo "<pre>";
          // print_r( $old_rec);
          // die();
          $json_old_data= json_encode($old_rec);
          // echo $json_old_data;
          // die();
          $log_insert=array();
          $log_insert=array(
            'tablename'=>$tablename,
            'primarykey'=>$primarykey,
            'primaryid'=>$primaryid,
            'action'=>$action,
            'datanew'=>$json_new_data,
            'dataold'=>$json_old_data,
            'postdatead'=>CURDATE_EN,
            'posttime'=>datetime('time'),
            'postby'=>auth()->user()->id,
            'postmac'=>get_Mac_Address(),
            'postip'=>get_real_ipaddr(),
            'locationid'=>auth()->user()->locationid,
            'orgid'=>auth()->user()->orgid
          );
          if(!empty($log_insert))
          {
            DB::table('commonlogtable')->insert( $log_insert);
          }
        
        }


        function english_to_nepali_number($str) {
          $strout = "";
          $strchar = "";
          for ($i = 0; $i < strlen($str); $i++) {
                $strchar = substr($str, $i, 1);
                if ($strchar == '1') {
                  $strout .= '१';
                }
                if ($strchar == '2') {
                  $strout .= '२';
                }
                if ($strchar == '3') {
                  $strout .= '३';
                }
                if ($strchar == '4') {
                  $strout .= '४';
                }
                if ($strchar == '5') {
                  $strout .= '५';
                }
                if ($strchar == '6') {
                  $strout .= '६';
                }

                if ($strchar == '7') {
                  $strout .= '७';
                }
                if ($strchar == '8') {
                  $strout .= '८';
                }
                if ($strchar == '9') {
                  $strout .= '९';
                }
                if ($strchar == '0') {
                $strout .= '०';
                }
          }
          return $strout;

}

function convert_date_format($date,$format='/')
{
  if($date)
  {
    $date=str_replace('/',$format, $date);
  }
  return $date;
}

function get_constant_value($name)
  {
  try {
          $query=\DB::table('constant')
          ->select('value')
          ->where('name',$name)
          ->first();
          $result=$query->value;
          return $result;
          } catch (Exception $e) {
              return array();
          }
  }


         if (!function_exists('includeRouteFiles')) {
          /**
           * Loops through a folder and requires all PHP files
           * Searches sub-directories as well.
           *
           * @param $folder
           */
          function includeRouteFiles($folder)
          {
              $directory = $folder;
              $handle = opendir($directory);
              $directory_list = [$directory];

              while (false !== ($filename = readdir($handle))) {
                  if ($filename != '.' && $filename != '..' && is_dir($directory.$filename)) {
                      array_push($directory_list, $directory.$filename.'/');
                  }
              }

              foreach ($directory_list as $directory) {
                  foreach (glob($directory.'*.php') as $filename) {
                      require $filename;
                  }
              }
          }
      }

    