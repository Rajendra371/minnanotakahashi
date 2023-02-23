<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use DB;

class BlogSetup extends Model
{
    protected $table = 'blog';
    //  protected $fillable = ['id'];
    protected $guarded = [];



    public static function get_blogsetup_list()
    {
        $get = $_GET;
        $category = $_GET['category'];

        foreach ($get as $key => $value) {
            $get[$key] = strtolower(htmlspecialchars($get[$key], ENT_QUOTES));
        }

        $limit = 20;
        $offset = 0;
        if (!empty($_GET["iDisplayLength"])) {
            $limit = $_GET['iDisplayLength'];
            $offset = $_GET["iDisplayStart"];
        }

        $nquery = \DB::table('blog as ecl')
            ->leftjoin('blog_category as e', 'e.id', '=', 'ecl.blog_categoryid')
            ->select('ecl.id', 'ecl.blog_categoryid', 'ecl.icon', 'ecl.order', 'ecl.blog_title', 'ecl.short_description', 'ecl.image', 'ecl.is_publish', 'ecl.seo_title', 'ecl.seo_keyword', 'ecl.seo_description', 'e.cat_name');
        if (!empty($category)) {
            $nquery->where('ecl.blog_categoryid', '=', $category);
        }


        $defaultpicker = get_constant_value('DEFAULT_DATEPICKER');

        if (!empty($get['sSearch_1'])) {
            $nquery->where('e.cat_name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $nquery->where('ecl.blog_title', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $nquery->where('ecl.short_description', 'like', "%" . $get['sSearch_3'] . "%");
        }

        if (!empty($get['sSearch_4'])) {
            $nquery->where('ecl.is_publish', 'like', "%" . $get['sSearch_4'] . "%");
        }




        $query = \DB::table('blog as ecl')
            ->leftjoin('blog_category as e', 'e.id', '=', 'ecl.blog_categoryid')
            ->select('ecl.id', 'ecl.blog_categoryid', 'ecl.icon', 'ecl.order', 'ecl.blog_title', 'ecl.short_description', 'ecl.image', 'ecl.is_publish', 'ecl.seo_title', 'ecl.seo_keyword', 'ecl.seo_description', 'e.cat_name');
        if (!empty($category)) {
            $query->where('ecl.blog_categoryid', '=', $category);
        }



        if (!empty($get['sSearch_1'])) {
            $query->where('e.cat_name', 'like', "%" . $get['sSearch_1'] . "%");
        }
        if (!empty($get['sSearch_2'])) {
            $query->where('ecl.blog_title', 'like', "%" . $get['sSearch_2'] . "%");
        }
        if (!empty($get['sSearch_3'])) {
            $query->where('ecl.short_description', 'like', "%" . $get['sSearch_3'] . "%");
        }

        if (!empty($get['sSearch_4'])) {
            $query->where('ecl.is_publish', 'like', "%" . $get['sSearch_4'] . "%");
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

    public static function get_all_blogsetup_data($id = false)
    {
        $data = DB::table('blog as ecl')
            ->leftjoin('blog_category as e', 'e.id', '=', 'ecl.blog_categoryid')
            ->select('ecl.*', 'e.cat_name')
            ->where('ecl.id', $id)
            ->first();
        return $data;
    }
}