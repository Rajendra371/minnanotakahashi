<?php

namespace App\Helpers;

use Exception;
use Illuminate\Support\Facades\DB;
use App\Models\GeneralSetting\EmailIntegration;

class General
{

    public function __construct()
    {
        // parent::__construct();
        $this->referer = (isset($_SERVER['HTTP_REFERER'])) ? $_SERVER['HTTP_REFERER'] : "";
        $this->onpage = $_SERVER['REQUEST_URI'];
    }


    public static function get_real_ipaddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else
            $ip = $_SERVER['REMOTE_ADDR'];
        return $ip;
    }

    public static function get_Mac_Address()
    {
        ob_start();
        system('ipconfig-a');
        $mycomsys = ob_get_contents();
        ob_clean();
        $find_mac = "Physical";
        $pmac = strpos($mycomsys, $find_mac);
        $macaddress = substr($mycomsys, ($pmac + 37), 18);
        return $macaddress;
    }

    public static function compute_data_for_edit($date = false, $time = false)
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

    public static function get_tbl_data($table, $select = false, $where = false, $order = false, $order_by = 'ASC', $limit = false, $offset = false)
    {
        $vdata = DB::table($table);
        if ($select) {
            $vdata->select($select, null, false);
        }
        if ($where) {
            $vdata->where($where, null, false);
        }
        if ($order) {
            $vdata->order_by($order, $order_by);
        }
        if ($limit) {
            $vdata->limit($limit);
        }
        if ($offset) {
            $vdata->offset($offset);
        }


        $result = $vdata->get();
        // echo $this->ci->db->last_query(); exit;
        // if ($result->num_rows() > 0) {
        // 	return $result->result();
        // }
        return $result;
    }

    public static function EngToNepDateConv($date = false)
    {
        try {
            $query = DB::table('nepequengdate')
                ->select('bsdate')
                ->where('addate', $date)
                ->first();
            $result = $query->bsdate;
            return $result;
        } catch (Exception $e) {
            return array();
        }
    }

    public static function NepToEngDateConv($date = false)
    {
        try {
            $query = DB::table('nepequengdate')
                ->select('addate')
                ->where('bsdate', $date)
                ->first();
            $result = $query->addate;
            return $result;
        } catch (Exception $e) {
            return array();
        }
    }

    public static function curdatetime()
    {
        return date('Y-m-d H:i:s');
    }

    public static function get_template_data($segment)
    {
        $getParseData = DB::table('template')->where('segment', $segment)->get()->first();
        // echo "<pre>";
        // print_r($getParseData);
        // die();
        if (!empty($getParseData)) {
            $db_query = $getParseData->query;
            // echo $db_query;
            // die();
            $parseValues = array();
            if (!empty($db_query)) {
                $parseValues = collect(DB::select($db_query))->first();
            }

            $templateContent = !empty($getParseData->descriptionnp) ? $getParseData->descriptionnp : '';
            $template_id = !empty($getParseData->template_id) ? number_conversion($getParseData->template_id) : '';
            $title = !empty($getParseData->templatenamenp) ? $template_id . ' ' . $getParseData->templatenamenp : '';
            $page_layout = !empty($getParseData->layout) ? $getParseData->layout : '';

            if (!empty($parseValues)) {
                foreach ($parseValues as $name => $value) {
                    $parseName = $name;
                    $parseValue = is_numeric($value) ? number_conversion($value) : $value;
                    $templateContent = str_replace("[$parseName]", $parseValue, $templateContent);
                }
            }


            return array($title, $templateContent, $page_layout);
        }
    }
    public static function get_parse_data($segment)
    {
        $getParseData = DB::table('template')->where('segment', $segment)->get()->first();
        // echo "<pre>";
        // print_r($getParseData);
        // die();
        if (!empty($getParseData)) {
            $db_query = $getParseData->query;
            // echo $db_query;
            // die();
            if (!empty($db_query)) {
                $data = collect(DB::select($db_query))->first();
                if (!empty($data)) {
                    return $data;
                }
                return false;
            }
        }

        return false;
    }

    public static function get_pdf($html, $title, $page_layout)
    {
        error_reporting(0);
        $mpdf = new \Mpdf\Mpdf([
            'allow_charset_conversion' => true,
            'mode' => 'utf-8',
            'format' => $page_layout
        ]);


        $pdf_css = view("Common.PdfCss");
        $css_path = $pdf_css->render();
        // echo ($css_path . $html);
        // die();
        $mpdf->SetTitle($title);
        $mpdf->setFooter('|{PAGENO}|');
        $mpdf->autoScriptToLang = true;
        $mpdf->autoLangToFont   = true;
        $mpdf->shrink_tables_to_fit = 0;
        $mpdf->keep_table_proportions = true;
        $mpdf->allow_charset_conversion = true;
        $mpdf->WriteHTML($css_path, 1);
        $mpdf->WriteHTML($html, 0);

        $mpdf->Output($title, 'I');
    }


    public static function get_excel($html, $title, $page_layout)
    {
        error_reporting(0);
        $filename = $title . date('Ymd') . ".xls";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => $page_layout]);

        $css_path = file_get_contents('../public/css/pdf.css');
        $mpdf->SetTitle($title);
        $mpdf->setHTMLFooter('{PAGENO}');

        $mpdf->shrink_tables_to_fit = 0;
        $mpdf->keep_table_proportions = true;
        $mpdf->WriteHTML($css_path, 1);
        echo $html;
    }

    public static function get_word($html, $title, $page_layout)
    {
        error_reporting(0);
        $filename = $title . date('Ymd') . ".doc";
        header("Content-Disposition: attachment; filename=\"$filename\"");
        header("Content-Type: application/vnd.ms-excel");

        $mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8', 'format' => $page_layout]);

        $css_path = file_get_contents('../public/css/pdf.css');

        $mpdf->SetTitle($title);
        $mpdf->setHTMLFooter('{PAGENO}');

        $mpdf->shrink_tables_to_fit = 0;
        $mpdf->keep_table_proportions = true;


        $mpdf->WriteHTML($css_path, 1);
        echo $html;
    }

    public static function setMailConfig()
    {
        //Get the data from settings table
        $settings = EmailIntegration::with('protocol', 'encryption')->where('is_active', 'Y')->first();
        // dd($settings);
        if ($settings) {
            //Set the data in an array variable from settings table
            $mailConfig = [
                'driver' => $settings->protocol->protocol_code,
                'host' => $settings->smtp_host,
                'port' => $settings->smtp_port,
                'encryption' => $settings->encryption->encryption_code,
                'username' => $settings->smtp_user,
                'password' => $settings->smtp_password,
                'from' => [
                    'address' => $settings->mail_from_address,
                    'name' => $settings->mail_from_name,
                ]
            ];
            //To set configuration values at runtime, pass an array to the config helper
            config(['mail' => $mailConfig]);
        }
    }

    //Ip visit log functions
    public function insert_new_visit()
    {
        if ($this->check_last_visit()) {
            $adminfolder = 'badministrator';

            $brwurl = url(($_SERVER['REQUEST_URI']));

            if (stripos($brwurl, $adminfolder) !== false) {
            } else {

                $dataarray1 = $this->ip_info(NULL, "location", TRUE);
                $insertdataarray = array(
                    'ip_adr' => $_SERVER['REMOTE_ADDR'],
                    'referer' => $this->referer,
                    'client' => $_SERVER['HTTP_USER_AGENT'],
                    'visit_date' => date("Y-m-d"),
                    'time' => date("H:i:s"),
                    'on_page' => $this->onpage,
                    'city' =>  !empty($dataarray1['city']) ? $dataarray1['city'] : 'Nepal',
                    'state' => !empty($dataarray1['state']) ? $dataarray1['state'] : 'Kathmandu',
                    'country' => !empty($dataarray1['country']) ? $dataarray1['country'] : 'Nepal',
                    'country_code' => !empty($dataarray1['country_code']) ? $dataarray1['country_code'] : 'NP',
                    'continent' => !empty($dataarray1['continent']) ? $dataarray1['continent'] : 'Asia',
                    'continent_code' => !empty($dataarray1['continent_code']) ? $dataarray1['continent_code'] : 'AS',
                );
                DB::table('ip2visits')->insert($insertdataarray);
            }
        }
    }


    public function check_last_visit()
    {
        $result = DB::table('ip2visits')->select(DB::raw('time + 0 as times'))->where(array('ip_adr' => $_SERVER['REMOTE_ADDR'], 'visit_date' => date("Y-m-d"), 'on_page' => $this->onpage))->orderBy('time', 'DESC')->first();

        if (!empty($result)) {
            $last_hour = date("H") - 0;
            $check_time = date($last_hour . "is");
            if ($result->times < $check_time)
                return true;
            else
                return false;
        } else {
            return true;
        }
    }

    function ip_info($ip = NULL, $purpose = "location", $deep_detect = TRUE)
    {
        $output = NULL;
        if (filter_var($ip, FILTER_VALIDATE_IP) === FALSE) {
            $ip = $_SERVER["REMOTE_ADDR"];
            if ($deep_detect) {
                if (filter_var(@$_SERVER['HTTP_X_FORWARDED_FOR'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
                if (filter_var(@$_SERVER['HTTP_CLIENT_IP'], FILTER_VALIDATE_IP))
                    $ip = $_SERVER['HTTP_CLIENT_IP'];
            }
        }
        $purpose    = str_replace(array("name", "\n", "\t", " ", "-", "_"), NULL, strtolower(trim($purpose)));
        $support    = array("country", "countrycode", "state", "region", "city", "location", "address");
        $continents = array(
            "AF" => "Africa",
            "AN" => "Antarctica",
            "AS" => "Asia",
            "EU" => "Europe",
            "OC" => "Australia (Oceania)",
            "NA" => "North America",
            "SA" => "South America",

        );
        if (filter_var($ip, FILTER_VALIDATE_IP) && in_array($purpose, $support)) {
            $ipdat = @json_decode(file_get_contents("http://www.geoplugin.net/json.gp?ip=" . $ip));
            if (@strlen(trim($ipdat->geoplugin_countryCode)) == 2) {
                switch ($purpose) {
                    case "location":
                        $output = array(
                            "city"           => @$ipdat->geoplugin_city,
                            "state"          => @$ipdat->geoplugin_regionName,
                            "country"        => @$ipdat->geoplugin_countryName,
                            "country_code"   => @$ipdat->geoplugin_countryCode,
                            "continent"      => @$continents[strtoupper($ipdat->geoplugin_continentCode)],
                            "continent_code" => @$ipdat->geoplugin_continentCode
                        );
                        break;
                    case "address":
                        $address = array($ipdat->geoplugin_countryName);
                        if (@strlen($ipdat->geoplugin_regionName) >= 1)
                            $address[] = $ipdat->geoplugin_regionName;
                        if (@strlen($ipdat->geoplugin_city) >= 1)
                            $address[] = $ipdat->geoplugin_city;
                        $output = implode(", ", array_reverse($address));
                        break;
                    case "city":
                        $output = @$ipdat->geoplugin_city;
                        break;
                    case "state":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "region":
                        $output = @$ipdat->geoplugin_regionName;
                        break;
                    case "country":
                        $output = @$ipdat->geoplugin_countryName;
                        break;
                    case "countrycode":
                        $output = @$ipdat->geoplugin_countryCode;
                        break;
                }
            }
        }
        return $output;
    }
}
