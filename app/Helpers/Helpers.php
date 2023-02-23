<?php

use Carbon\Carbon;
use App\Models\Date;
use App\Helpers\General;
use App\Models\Constant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

$cur_date = date('Y/m/d');
define('CURDATE_EN', $cur_date);
$cur_date = explode('/', $cur_date);
$cur_year = $cur_date[0];
$cur_month = $cur_date[1];
$cur_days = $cur_date[2];
define('CURYEAR', $cur_year);
define('CURMONTH', $cur_month);
define('CURDAYS', $cur_days);
define('BILL_NO', 'BI');
set_default_currency();

// $site_info = get_site_settings_info();
// define('FACEBOOK_LINK',$site_info['facebook_link']);
// define('TWITTER_LINK',$site_info['twitter_link']);
// define('INSTAGRAM_LINK',$site_info['instagram_link']);
// define('YOUTUBE_LINK',$site_info['youtube_link']);
// define('LINKEDIN_LINK',$site_info['linkedin_link']);
// define('GOOGLEPLUS_LINK',$site_info['google_link']);

function datetime($time = false)
{
  if ($time == 'time') {
    return date('H:i:s');
  }
  return date('Y-m-d H:i:s');
}

// function get_site_settings_info()
// {
//   $query = DB::table('site_settings')->first();
//   if ($query->num_rows() > 0) 
// 	{
// 		$data=$query->row_array();				
// 	}		
//   $query->free_result();
// 	return $data;
// }

function get_real_ipaddr()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  else
    $ip = $_SERVER['REMOTE_ADDR'];
  return $ip;
}

function clean_url($str, $replace = array(), $delimiter = '-')
{

  if (!empty($replace)) {
    $str = str_replace((array) $replace, ' ', $str);
  }

  //    $clean = iconv('UTF-8', 'ASCII//TRANSLIT', $str);

  $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $str);

  $clean = strtolower(trim($clean, '-'));

  $clean = preg_replace("/[\/_|+ -]+/", $delimiter, $clean);

  return $clean;
}

function consts()
{
  $cur_date = date('Y/m/d');
  $data = General::EngToNepDateConv($cur_date);
  return $data;
}

function get_Mac_Address()
{
  // ob_start();
  // system('ipconfig-a');
  // $mycomsys = ob_get_contents();
  // ob_clean();
  // $find_mac = "Physical";
  // $pmac = strpos($mycomsys, $find_mac);
  // $macaddress = substr($mycomsys, ($pmac + 37), 18);
  // return $macaddress;
  return 0;
}


function compute_data_for_edit($date = false, $time = false)
{
  $concate_date_time = $date . ' ' . $time;
  // echo strtotime($concate_date_time);
  // die();
  $new_date_time = strtotime($concate_date_time . "+" . EDIT_HOURS . " hours");
  $current_date_time = time('now');
  // echo date('Y/m/d H:i:s',$current_date_time);
  // die();
  // echo $new_date_time;
  if ($current_date_time >= $new_date_time) {
    return 0;
  }
  return 1;
}


function increase_product_view_count($id)
{
  if (!empty($id)) {
    $data = DB::table('product_views_count')->where('product_id', $id)->first();
    if ($data) {
      $new_count = $data->view_count + 1;
      DB::table('product_views_count')->where('product_id', $id)->update(['view_count' => $new_count]);
    } else {
      DB::table('product_views_count')->insert([
        'product_id' => $id,
        'view_count' => 1
      ]);
    }
  }
}

function get_tbl_data($select = false, $table, $where = false, $order = false, $order_by = 'ASC', $group_by = false)
{
  $vdata = DB::table($table);
  if ($select) {
    $vdata->select($select);
  }
  if ($where) {
    $vdata->where($where, null, false);
  }
  if ($order) {
    $vdata->OrderBy($order, $order_by);
  }
  if ($group_by) {
    $vdata->groupBy($group_by);
  }
  $result = $vdata->get();
  // echo $this->ci->db->last_query(); exit;
  // if ($result->num_rows() > 0) {
  // 	return $result->result();
  // }
  return $result;
}

function set_default_currency()
{
  // $host = explode('.', $_SERVER['HTTP_HOST']);
  // if (end($host) == 'np') {
  //   define('CURRENCY', 'NRs');
  // } else {
  //   define('CURRENCY', 'USD');
  // }
}

function set_product_price($price = 0)
{
  $host = explode('.', $_SERVER['HTTP_HOST']);
  if (end($host) == 'np') {
    return round(($price * 100) / 100, 2);
  } else {
    $date = Carbon::today()->toDateString();
    $rate = DB::table('exchange_rate')->orderBy('id', 'DESC')->value('rate');
    if (!empty($rate)) {
      return round($price / $rate, 2);
    }
    return "0.00";
  }
}

function EngToNepDateConv($date = false)
{
  try {
    $query = DB::table('nepequengdate')
      ->select('bsdate')
      ->where('addate', $date)
      ->first();
    $result = $query->bsdate;
    return $result;
  } catch (Exception $e) {
    return '';
  }
}

function NepToEngDateConv($date = false)
{
  try {
    $query = DB::table('nepequengdate')
      ->select('addate')
      ->where('bsdate', $date)
      ->first();
    $result = $query->addate;
    return $result;
  } catch (Exception $e) {
    return '';
  }
}

function load_db_constant()
{
  $db_constant = Constant::where('isactive', 'Y')
    ->get();
  //    echo "<pre>";
  //    print_r($db_constant);
  //    die();
  if (!empty($db_constant)) {
    foreach ($db_constant as $kcon => $const) {
      echo define($const->name, $const->value);
    }
  }
  // die();
}

function sendMail($parseValues, $templateCode, $emailAddress, $alias = false, $print = false)
{
  if (!empty($parseValues) && !empty($templateCode) && !empty($emailAddress)) {
    General::setMailConfig();
    $template_header = DB::table('email_template')->where('template_code', 'template_header')->value('body');
    $template_footer = DB::table('email_template')->where('template_code', 'template_footer')->value('body');

    $email = DB::table('email_template')->where('template_code', $templateCode)->first();
    $templateContent = $email->body;
    $emailSubject = $email->subject;
    foreach ($parseValues as $name => $value) {
      $templateContent = str_replace("[$name]", $value, $templateContent);
    }

    $html = $template_header . $templateContent . $template_footer;
    if ($print == 'Y') {
      return $template_header . $templateContent;
    }

    try {
      \Mail::send([], [], function ($message) use ($emailAddress, $emailSubject, $html, $alias) {
        $message->to($emailAddress)
          ->subject($emailSubject)
          ->setBody($html, 'text/html');
        if ($alias) {
          $message->from($alias);
        }
      });
      return "Message Send to $emailAddress";
    } catch (\Throwable $th) {
      if (Schema::hasTable('error_logs')) {
        \DB::table('error_logs')->insert([
          'message' => $th->getMessage(),
          'created_at' => datetime(),
        ]);
      }
      return $th->getMessage();
    }
  }
}

function generate_random_string($n)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';
  for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
  }
  return $randomString;
}

function check_permission($action = false)
{
  $groupid = auth()->user()->group_id;
  $softwareid = auth()->user()->softwareid;
  $base_url = \URL::to('/');
  $currenturl = $_SERVER['HTTP_REFERER'];
  $new_url = str_replace($base_url, "", $currenturl);
  $urlchk = str_replace('/badministrator', '', $new_url);

  $nquery = \DB::table('modules as m')
    ->leftJoin('modulespermission as mp', 'mp.moduleid', '=', 'm.id')
    ->where('m.modulelink', '=', $urlchk)
    ->where('mp.usergroupid', '=', $groupid);

  $result = $nquery->where('m.softwareid', '=', $softwareid)
    ->select('mp.*', 'm.*')
    ->first();
  if ($result) {
    $insert_action = $result->insert;
    $view_action = $result->view;
    $update_action = $result->update;
    $delete_action = $result->delete;
    $approved_action = $result->approve;
    $hasaccess = $result->hasaccess;

    if ($action == 'Insert' && $insert_action == 'N') {
      return 'error';
      exit;
    }
    if ($action == 'View' && $view_action == 'N') {
      return 'error';
      exit;
    }
    if ($action == 'Update' && $update_action == 'N') {
      return 'error';
      exit;
    }
    if ($action == 'Delete' && $delete_action == 'N') {
      return 'error';
      exit;
    }

    if ($action == 'Approved' && $approved_action == 'N') {
      return 'error';
      exit;
    }
    if ($action == 'hasaccess' && $hasaccess == '0') {
      return 'error';
      exit;
    }
  } else {
    return false;
  }
}

function permission_message()
{
  echo json_encode(['status' => 'error', 'permission' => 'no', 'message' => "You don't have permission"]);
}

function save_log($tablename = false, $primarykey = false, $primaryid = false, $postdata = false, $action = false)
{
  // echo "<pre>";
  $json_new_data = json_encode($postdata);
  // die();
  $old_rec = DB::table($tablename)->where($primarykey, '=', $primaryid)->first();
  // echo "<pre>";
  // print_r( $old_rec);
  // die();
  $json_old_data = json_encode($old_rec);
  // echo $json_old_data;
  // die();
  $log_insert = array();
  $log_insert = array(
    'tablename' => $tablename,
    'primarykey' => $primarykey,
    'primaryid' => $primaryid,
    'action' => $action,
    'datanew' => $json_new_data,
    'dataold' => $json_old_data,
    'postdatead' => CURDATE_EN,
    'posttime' => datetime('time'),
    'postby' => auth()->user()->id,
    'postmac' => get_Mac_Address(),
    'postip' => get_real_ipaddr(),
    'locationid' => auth()->user()->locationid,
    'orgid' => auth()->user()->orgid
  );
  if (!empty($log_insert)) {
    DB::table('commonlogtable')->insert($log_insert);
  }
}

function countVisitsTableValue ( $unique = false, $unique_today=false,$unique_total=false){
  $site_url = url('/');           
  $site_url = str_replace('http://', '', $site_url);
  $pieces = explode("/", $site_url);          
  $removeFirst = array_shift($pieces);
  $pieces = implode("/", $pieces);
  $pieces = strlen($pieces) > 0 ? '/'.$pieces.'/' : '/';
  if($unique_today && $unique) 
  {
    $query = DB::table('ip2visits')->count(DB::raw('DISTINCT ip_adr'));
      if($query)
      {
       
        return $query;
      }
       return false;
  }
  // if($unique_total)
  // {
  //   $query = DB::table('ip2visits')
  //   ->select('id')
  //   ->groupBy('ip_adr');

  //     $qry=$query->count();
  //         // echo $query();
  //         // die;
  //     if($qry)
  //     {
  //       return $qry;
  //     }
  //     return false;

  // }
  if($unique_today) 
  {
    // $query = DB::table('ip2visits')
    //   ->select('id')
    //   ->where(array('visit_date'=> date('Y-m-d')))
    //   ->groupBy('ip_adr');
    //   // echo $this->db->last_query();die;
      $query = DB::table('ip2visits')->where(array('visit_date'=> date('Y-m-d')))->count(DB::raw('DISTINCT ip_adr')); 
        
      // $qry=$query->count();
      if($query)
      {
       
        return $query;
      }
       return false;
  }
  if(!$unique)
  {
    $query = DB::table('ip2visits')
    ->select('id');

      $qry=$query->count();
      if($qry)
      {
        return $qry;
      }
      return false;

  }
  else
  {
    $query = DB::table('ip2visits')
    ->select('id')
    ->where(array('visit_date'=> date('Y-m-d')));

      $qry=$query->count();
      if($qry)
      {
        return $qry;
      }
       return false;
  }

  return false;
}

function english_to_nepali_number($str)
{
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

function convert_date_format($date, $format = '/')
{
  if ($date) {
    $date = str_replace('/', $format, $date);
  }
  return $date;
}


function get_constant_value($name)
{
  try {
    $value = \DB::table('constant')
      ->where('name', $name)
      ->value('value');
    return $value;
  } catch (Exception $e) {
    return false;
  }
}


//SUum of N Number of times
function sum_of_times($times)
{
  $seconds = 0; //declare minutes either it gives Notice: Undefined variable
  // loop throught all the times
  foreach ($times as $time) {
    if (!empty($time)) {
      list($hour, $minute, $second) = explode(':', $time);
      $seconds += $hour * 60 * 60;
      $seconds += $minute * 60;
      $seconds += $second;
    }
  }
  return  sprintf('%02d:%02d:%02d', ($seconds / 3600), ($seconds / 60 % 60), $seconds % 60);
}

function timezone_list($name, $default = '')
{
  static $timezones = null;

  if ($timezones === null) {
    $timezones = [];
    $offsets = [];
    $now = new \DateTime();

    foreach (\DateTimeZone::listIdentifiers() as $timezone) {
      $now->setTimezone(new \DateTimeZone($timezone));
      $offsets[] = $offset = $now->getOffset();

      $hours = intval($offset / 3600);
      $minutes = abs(intval($offset % 3600 / 60));
      $gmt_ofset = 'GMT' . ($offset ? sprintf('%+03d:%02d', $hours, $minutes) : '');

      $timezone_name = str_replace('/', ', ', $timezone);
      $timezone_name = str_replace('_', ' ', $timezone_name);
      $timezone_name = str_replace('St ', 'St. ', $timezone_name);

      $timezones[$timezone] = $timezone_name . ' (' . $gmt_ofset . ')';
    }

    array_multisort($offsets, $timezones);
  }

  $formdropdown = form_dropdown($name, $timezones, trim($default));

  return $formdropdown;
}

function form_dropdown($name = '', $options = array(), $selected = array(), $extra = '')
{
  if (!is_array($selected)) {
    $selected = array($selected);
  }

  // If no selected state was submitted we will attempt to set it automatically
  if (count($selected) === 0) {
    // If the form name appears in the $_POST array we have a winner!
    if (isset($_POST[$name])) {
      $selected = array($_POST[$name]);
    }
  }

  if ($extra != '') $extra = ' ' . $extra;

  $multiple = (count($selected) > 1 && strpos($extra, 'multiple') === FALSE) ? ' multiple="multiple"' : '';

  $form = '<select name="' . $name . '"' . $extra . $multiple . ">\n";

  foreach ($options as $key => $val) {
    $key = (string) $key;

    if (is_array($val) && !empty($val)) {
      $form .= '<optgroup label="' . $key . '">' . "\n";

      foreach ($val as $optgroup_key => $optgroup_val) {
        $sel = (in_array($optgroup_key, $selected)) ? ' selected="selected"' : '';

        $form .= '<option value="' . $optgroup_key . '"' . $sel . '>' . (string) $optgroup_val . "</option>\n";
      }

      $form .= '</optgroup>' . "\n";
    } else {
      $sel = (in_array($key, $selected)) ? ' selected="selected"' : '';

      $form .= '<option value="' . $key . '"' . $sel . '>' . (string) $val . "</option>\n";
    }
  }

  $form .= '</select>';

  return $form;
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
      if ($filename != '.' && $filename != '..' && is_dir($directory . $filename)) {
        array_push($directory_list, $directory . $filename . '/');
      }
    }

    foreach ($directory_list as $directory) {
      foreach (glob($directory . '*.php') as $filename) {
        require $filename;
      }
    }
  }
}

function generate_invoiceno($fieldname, $invoice_fieldname, $tablename, $prefix_no, $length, $cond = false, $type = false, $sub_prefix = false)
{
  $curday = CURDAYS;
  $curmnth = CURMONTH;
  $curyear = substr(CURYEAR, -2);
  if ($curmnth == 1) {
    $prefix = 'A';
  }
  if ($curmnth == 2) {
    $prefix = 'B';
  }
  if ($curmnth == 3) {
    $prefix = 'C';
  }
  if ($curmnth == 4) {
    $prefix = 'D';
  }
  if ($curmnth == 5) {
    $prefix = 'E';
  }
  if ($curmnth == 6) {
    $prefix = 'F';
  }
  if ($curmnth == 7) {
    $prefix = 'G';
  }
  if ($curmnth == 8) {
    $prefix = 'H';
  }
  if ($curmnth == 9) {
    $prefix = 'I';
  }
  if ($curmnth == 10) {
    $prefix = 'J';
  }
  if ($curmnth == 11) {
    $prefix = 'K';
  }
  if ($curmnth == 12) {
    $prefix = 'L';
  }
  if ($type == 'invoice') {
    $query = \DB::table($tablename)
      ->where($invoice_fieldname, 'LIKE', '%' . $curyear . '%')
      ->limit(1)
      ->orderBy($invoice_fieldname, 'desc')
      ->select($fieldname)
      ->get();
  } else if ($type == 'personid') {
    $query = \DB::table($tablename)
      ->where($invoice_fieldname, 'LIKE', '%' . $prefix . $curyear . $prefix_no . '%')
      ->limit(1)
      ->orderBy($invoice_fieldname, 'desc')
      ->select($fieldname)
      ->get();
  } else {
    $query = \DB::table($tablename)
      ->where($invoice_fieldname, 'LIKE', '%' . $prefix_no . $prefix . '%')
      ->limit(1)
      ->orderBy($invoice_fieldname, 'desc')
      ->select($fieldname)
      ->get();
  }
  if ($cond) {
    $query->where($cond);
  }

  $dbinvoiceno = '0';
  if (count($query) > 0) {
    $dbinvoiceno = $query[0]->$fieldname;
  }
  if ($type == 'invoice') {
    $invoiceno = stringseperator($dbinvoiceno, 'number');
    $new_invoice = substr($invoiceno, 0, 4);
    $nw_invoice = str_pad($new_invoice + 1, $length, 0, STR_PAD_LEFT);
    return $prefix_no . $nw_invoice . $sub_prefix . $curday . $prefix . $curyear;
  } else if ($type == 'personid') {
    $invoiceno = stringseperator($dbinvoiceno, 'number');
    $new_invoice = substr($invoiceno, 4);
    $nw_invoice = str_pad($new_invoice + 1, $length, 0, STR_PAD_LEFT);
    return $curday . $prefix . $curyear . $prefix_no . $nw_invoice;
  } else {
    $invoiceno = stringseperator($dbinvoiceno, 'number');
    $nw_invoice = str_pad($invoiceno + 1, $length, 0, STR_PAD_LEFT);
    return $prefix_no . $prefix . $nw_invoice;
  }
}



function generate_invoiceno_new($fieldname, $invoice_fieldname, $tablename, $prefix_no, $length, $cond = false, $location_fieldname = false, $order_by = false, $order_type = 'S', $order = 'DESC')
{

  $locationid = '';
  if (Auth::check()) {
    $locationid = auth()->user()->locationid;
    $orgid = auth()->user()->orgid;
  }
  // \DB::enableQueryLog();
  $nquery = \DB::table($tablename)
    ->select($fieldname)
    ->where($invoice_fieldname, 'like', '%' . $prefix_no . '%');
  if ($location_fieldname) {
    $nquery->where($location_fieldname, $locationid);
  }
  if ($cond) {
    $nquery->where($cond);
  }
  if ($order_type == 'M' && $order_by) {
    $nquery->orderByRaw(DB::raw($order_by));
  } else if ($order_type == 'S' && $order_by) {
    $nquery->OrderBy($order_by, $order);
  } else {
    $nquery->OrderBy($fieldname, 'DESC');
  }
  $data = $nquery->first();
  $dbinvoiceno = 0;
  if (!empty($data)) {
    $dbinvoiceno = $data->orderno;
  }

  $invoiceno = str_replace($prefix_no, ' ', $dbinvoiceno);
  $nw_invoice = str_pad($invoiceno + 1, $length, 0, STR_PAD_LEFT);
  // return $nw_invoice;

  return $prefix_no . $nw_invoice;
}

function location_option($colno = 2, $optionname = 'locationid', $id = 'locationid', $dfl_select = false, $addfield = false, $all = false)
{
  $location_id = auth()->user()->locationid;
  $location_ismain = session()->get('MAIN_LOCATION');
  $groupcode = auth()->user()->group_id;
  // dump($location_ismain);
  $option = '';
  $show_location_group = array(1);

  if ($location_ismain == 'Y' && in_array($groupcode, $show_location_group)) {
    $db_location = get_tbl_data('*', 'location', false, 'id', 'ASC');
  } else {
    $db_location = get_tbl_data('*', 'location', array('id' => $location_id), 'id', 'ASC');
  }

  if ($addfield == 'all' || $all == 'all') {
    $db_location = get_tbl_data('*', 'location', false, 'id', 'ASC');
  }

  if ($addfield != 'all' && $addfield != '') {
    $addfield = $addfield;
  }

  $option .= '<label> Location' . $addfield . ':</label>';
  if ($db_location) :
    $option .= '<select name="' . $optionname . '" id="' . $id . '" class="form-control"> ';
    if ($location_ismain == 'Y' && $groupcode == 1) {
      $option .= '<option value="">--All--</option>';
    }
    if ($addfield == 'all' || $all == 'all') {
      $option .= '<option value="">--All--</option>';
    }

    foreach ($db_location as $km => $loca) :
      if ($dfl_select) {
        if ($loca->id == $dfl_select) {
          $select_opt = 'selected=selected';
        } else {
          $select_opt = '';
        }
      } else if ($location_ismain == 'Y') {
        if ($loca->id == $location_id) {
          $select_opt = 'selected=selected';
        } else {
          $select_opt = '';
        }
      } else {
        $select_opt = '';
      }
      $option .= '<option value="' . $loca->id . '" ' . $select_opt . '>' . $loca->locname . '</option>';
    endforeach;
    $option .= '</select>';
  endif;
  return $option;
}

function stringseperator($string, $type_return)
{
  $numbers = array();
  $alpha = array();
  $array = str_split($string);
  for ($x = 0; $x < count($array); $x++) {
    if (is_numeric($array[$x]))
      array_push($numbers, $array[$x]);
    else
      array_push($alpha, $array[$x]);
  } // end for         
  $alpha = implode($alpha);
  $numbers = implode($numbers);
  if ($type_return == 'number')
    return $numbers;
  elseif ($type_return == 'alpha')
    return $alpha;
}

function convert_to_word(float $number)
{
  $decimal = round($number - ($no = floor($number)), 2) * 100;
  $hundred = null;
  $digits_length = strlen($no);
  $i = 0;
  $str = array();
  $words = array(
    0 => '', 1 => 'one', 2 => 'two',
    3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
    7 => 'seven', 8 => 'eight', 9 => 'nine',
    10 => 'ten', 11 => 'eleven', 12 => 'twelve',
    13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
    16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
    19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
    40 => 'forty', 50 => 'fifty', 60 => 'sixty',
    70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
  );
  $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
  while ($i < $digits_length) {
    $divider = ($i == 2) ? 10 : 100;
    $number = floor($no % $divider);
    $no = floor($no / $divider);
    $i += $divider == 10 ? 1 : 2;
    if ($number) {
      $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
      $hundred = ($counter == 1 && $str[0]) ? ' And ' : null;
      $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
    } else $str[] = null;
  }
  $Rupees = implode('', array_reverse($str));
  $paise = ($decimal > 0) ? " And " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
  return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise . ' Only';
}


function calcutateAge($dob)
{
  $dob = date("Y-m-d", strtotime($dob));
  $dobObject = new DateTime($dob);
  $nowObject = new DateTime();
  $diff = $dobObject->diff($nowObject);
  return $diff->y;
}


function resizeAndCompressImage($src, $dest, $width, $height, $percentage = 60)
{
  try {
    $img = \Image::make($src);
    $img->resize($width, $height, function ($constraint) {
      $constraint->aspectRatio();
    });
    $img->save($dest, $percentage);
  } catch (\Throwable $th) {
    return '';
  }
}

/**
 * @param $src - a valid file location
 * @param $dest - a valid file target
 * @param $targetWidth - desired output width
 * @param $targetHeight - desired output height or null
 */
function createThumbnails($src, $dest, $targetWidth, $targetHeight = null)
{
  $IMAGE_HANDLERS = [
    [],
    [
      'load' => 'imagecreatefromgif',
      'save' => 'imagegif',
      'quality' => 0
    ],
    [
      'load' => 'imagecreatefromjpeg',
      'save' => 'imagejpeg',
      'quality' => 100
    ],
    [
      'load' => 'imagecreatefrompng',
      'save' => 'imagepng',
      'quality' => 0
    ]

  ];

  // 1. Load the image from the given $src
  // - see if the file actually exists
  // - check if it's of a valid image type
  // - load the image resource

  // get the type of the image
  // we need the type to determine the correct loader
  $type = exif_imagetype($src);
  // dd( $src, $dest,$IMAGE_HANDLERS,$type);

  // if no valid type or no handler found -> exit
  if (!$type || !$IMAGE_HANDLERS[$type]) {
    return null;
  }

  // load the image with the correct loader
  $image = call_user_func($IMAGE_HANDLERS[$type]['load'], $src);

  // dd($image);
  // no image found at supplied location -> exit
  if (!$image) {
    return null;
  }

  // 2. Create a thumbnail and resize the loaded $image
  // - get the image dimensions
  // - define the output size appropriately
  // - create a thumbnail based on that size
  // - set alpha transparency for GIFs and PNGs
  // - draw the final thumbnail

  // get original image width and height
  $width = imagesx($image);
  $height = imagesy($image);

  // maintain aspect ratio when no height set
  if ($targetHeight == null) {

    // get width to height ratio
    $ratio = $width / $height;

    // if is portrait
    // use ratio to scale height to fit in square
    if ($width > $height) {
      $targetHeight = floor($targetWidth / $ratio);
    }
    // if is landscape
    // use ratio to scale width to fit in square
    else {
      $targetHeight = $targetWidth;
      $targetWidth = floor($targetWidth * $ratio);
    }
  }

  // create duplicate image based on calculated target size
  $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);
  // dd($thumbnail);

  // set transparency options for GIFs and PNGs
  if ($type == 1 || $type == 3) {

    // make image transparent
    imagecolortransparent(
      $thumbnail,
      imagecolorallocate($thumbnail, 0, 0, 0)
    );

    // additional settings for PNGs
    if ($type == 3) {
      imagealphablending($thumbnail, false);
      imagesavealpha($thumbnail, true);
    }
  }

  // copy entire source image to duplicate image and resize
  imagecopyresampled(
    $thumbnail,
    $image,
    0,
    0,
    0,
    0,
    $targetWidth,
    $targetHeight,
    $width,
    $height
  );


  // 3. Save the $thumbnail to disk
  // - call the correct save method
  // - set the correct quality level

  // save the duplicate version of the image to disk
  return call_user_func(
    $IMAGE_HANDLERS[$type]['save'],
    $thumbnail,
    $dest,
    $IMAGE_HANDLERS[$type]['quality']
  );
}
