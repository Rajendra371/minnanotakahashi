<?php

namespace App\Models\GeneralSetting;

use Illuminate\Database\Eloquent\Model;
use DB;

class EmailIntegration extends Model
{
    protected $table = 'email_configuration';
    protected $guarded = [];

    public function protocol()
    {
        return $this->belongsTo('App\Models\Settings\EmailProtocol', 'email_protocol_typeid');
    }
    public function encryption()
    {
        return $this->belongsTo('App\Models\Settings\EmailEncryption', 'email_encryption_typeid');
    }

    public static function get_emailintegration_list()
    {
        $get = $_GET;

        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }

        $limit = 20;
        $offset = 0;
        if (!empty($_GET["iDisplayLength"])) {
            $limit = $_GET['iDisplayLength'];
            $offset = $_GET["iDisplayStart"];
        }

        $nquery = DB::table('email_configuration as ecl')
            ->leftjoin('email_protocol_type as e', 'e.id', '=', 'ecl.email_protocol_typeid')
            ->leftjoin('email_encryption_type as ee', 'ee.id', '=', 'ecl.email_encryption_typeid')
            ->select('ecl.id', 'ecl.email_protocol_typeid', 'ecl.mail_from_address', 'ecl.smtp_host', 'ecl.smtp_user', 'ecl.smtp_port', 'ecl.email_encryption_typeid', 'ecl.smtp_password', 'e.protocal_name', 'ee.encryption_name', 'ecl.is_active');

        $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('ecl.mail_from_address', 'like', "%" . $get['sSearch_1'] . "%");
        }

        if (!empty($get['sSearch_2'])) {
            $nquery->where('e.protocal_name', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('ecl.smtp_host', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $nquery->where('ecl.smtp_user', 'like', "%" . $get['sSearch_4'] . "%");
        }
        if (!empty($get['sSearch_5'])) {
            $nquery->where('ecl.smtp_port', 'like', "%" . $get['sSearch_5'] . "%");
        }
        if (!empty($get['sSearch_6'])) {
            $nquery->where('ecl.encryption_name', 'like', "%" . $get['sSearch_6'] . "%");
        }


        $query = DB::table('email_configuration as ecl')
            ->leftjoin('email_protocol_type as e', 'e.id', '=', 'ecl.email_protocol_typeid')
            ->leftjoin('email_encryption_type as ee', 'ee.id', '=', 'ecl.email_encryption_typeid')
            ->select('ecl.id', 'ecl.email_protocol_typeid', 'ecl.mail_from_address', 'ecl.smtp_host', 'ecl.smtp_user', 'ecl.smtp_port', 'ecl.email_encryption_typeid', 'ecl.smtp_password', 'e.protocal_name', 'ee.encryption_name', 'ecl.is_active');

        if (!empty($get['sSearch_1'])) {
            $query->where('ecl.mail_from_address', 'like', "%" . $get['sSearch_1'] . "%");
        }

        if (!empty($get['sSearch_2'])) {
            $query->where('e.protocal_name', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $query->where('ecl.smtp_host', 'like', "%" . $get['sSearch_3'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $query->where('ecl.smtp_user', 'like', "%" . $get['sSearch_4'] . "%");
        }
        if (!empty($get['sSearch_5'])) {
            $query->where('ecl.smtp_port', 'like', "%" . $get['sSearch_5'] . "%");
        }
        if (!empty($get['sSearch_6'])) {
            $query->where('ecl.encryption_name', 'like', "%" . $get['sSearch_6'] . "%");
        }
        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'ecl.id';
        }

        if ($get['iSortCol_0'] == 2) {
            $order_by = 'ecl.id';
        }
        // if($get['iSortCol_0']==3)
        //  {
        //      $order_by='tole_name';
        //  }
        // if($get['iSortCol_0']==4)
        //  {
        //      $order_by='road_name';
        //  }


        // $query->orderBy($order_by,$order);
        if (!empty($offset)) {
            $query->offset($offset);
        }

        if ($limit) {
            $query->limit($limit);
        }

        $data = $query->get();


        // $all_filtered_data = $nquery->get();
        $count = $nquery->count();

        $no_of_pages = ceil($count / $limit);

        if ($count > 0) {
            $ndata = $data;
            $ndata['totalrecs'] = $count;
            $ndata['totalfilteredrecs'] = $count;
        } else {
            $ndata = array();
            $ndata['totalrecs'] = 0;
            $ndata['totalfilteredrecs'] = 0;
        }
        return $ndata;
    }
}