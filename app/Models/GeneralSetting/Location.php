<?php

namespace App\Models\GeneralSetting;

use Illuminate\Database\Eloquent\Model;
use DB;

class Location extends Model
{
    protected $table = 'location';
    protected $guarded = [];

    public static function get_location_list()
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

        $nquery = DB::table('location as l')
            ->select('l.id', 'l.parentloc_id', 'l.locname', 'l.loccode', 'l.ismain', 'l.isactive');

        $query = DB::table('location as l')
            ->select('l.id', 'l.parentloc_id', 'l.locname', 'l.loccode', 'l.ismain', 'l.isactive');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('l.loccode', 'like', "%" . $get['sSearch_1'] . "%");
            $query->where('l.loccode', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('l.locname', 'like', "%" . $get['sSearch_2'] . "%");
            $query->where('l.locname', 'like', "%" . $get['sSearch_2'] . "%");
        }

        $order_by = '';
        $order = '';
        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'loccode';
        }

        if ($get['iSortCol_0'] == 2) {
            $order_by = 'locname';
        }

        if ($get['iSortCol_0'] == 3) {
            $order_by = 'ismain';
        }

        if ($get['iSortCol_0'] == 2) {
            $order_by = 'isactive';
        }

        if (!empty($order_by) && !empty($order)) {
            $query->orderBy($order_by, $order);
        }

        if (!empty($offset)) {
            $query->offset($offset);
        }

        if ($limit) {
            $query->limit($limit);
        }

        $data = $query->get();
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