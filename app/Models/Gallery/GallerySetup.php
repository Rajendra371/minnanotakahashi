<?php

namespace App\Models\Gallery;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class GallerySetup extends Model
{
    protected $table = 'galleries';
    protected $guarded = [];

    public function category()
    {
        $this->belongsTo('App\Models\Gallery\GalleryCategory', 'gly_catid');
    }

    public static function get_gallery_list()
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

        $nquery = DB::table('gallery_master as gm')->leftJoin('gallery_categories as gc', 'gc.id', '=', 'gm.gallery_category_id')->select('gm.id');

        $query = DB::table('gallery_master as gm')->leftJoin('gallery_categories as gc', 'gc.id', '=', 'gm.gallery_category_id')->select('gm.id', 'gm.title', 'gm.content', 'gm.is_display', 'gc.title as category_title', 'gm.postdatebs', 'gm.image_count');


        if (!empty($get['sSearch_1'])) {
            $nquery->where('gc.title', 'like', "%" . $get['sSearch_1'] . "%");
            $query->where('gc.title', 'like', "%" . $get['sSearch_1'] . "%");
        }

        if (!empty($get['sSearch_2'])) {
            $nquery->where('gm.title', 'like', "%" . $get['sSearch_2'] . "%");
            $nquery->where('gm.title', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_4'])) {
            $nquery->where('gm.content', 'like', "%" . $get['sSearch_4'] . "%");
            $nquery->where('gm.content', 'like', "%" . $get['sSearch_4'] . "%");
        }

        if (!empty($get['sSearch_6'])) {
            $nquery->where('gm.postdatebs', 'like', "%" . $get['sSearch_6'] . "%");
            $nquery->where('gm.postdatebs', 'like', "%" . $get['sSearch_6'] . "%");
        }

        $order_by = 'postdatebs';
        $order = 'ASC';

        if ($get['sSortDir_0']) {
            $order = $get['sSortDir_0'];
        }

        if ($get['iSortCol_0'] == 1) {
            $order_by = 'gc.title';
        }

        if ($get['iSortCol_0'] == 2) {
            $order_by = 'gm.title';
        }

        if ($get['iSortCol_0'] == 4) {
            $order_by = 'gm.content';
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