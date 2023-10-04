<?php

namespace App\Models\Frontend;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    public static function get_banner_data()
    {
        $data = DB::table('banner')
            ->select('id', 'banner_img', 'heading', 'content', 'button_text1', 'button_url1')
            ->where('is_publish', 'Y')
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_short_description()
    {
        $data = DB::table('pages')
            ->select('id', 'page_title', 'page_slug', 'short_content', 'description', 'images')
            ->where('is_publish', 'Y')
            ->whereIn('page_slug', ['who-we-are', 'aims-and-objectives', 'our-mission', 'our-vision'])
            ->orderBy('order')
            ->get();
        return $data;
    }

    public static function get_video_gallery($limit = 0)
    {
        $data = DB::table('video_galleries')
            ->select('id', 'title', 'link', 'content', 'image_url')
            ->where('is_display', 'Y')
            ->orderBy('order', 'ASC')
            ->when($limit, function ($query) use ($limit) {
                return $query->limit($limit);
            })
            ->get();
        return $data;
    }

    public static function get_service_data($where = false, $limit = false, $raw_where = false)
    {
        $data = DB::table('services')
            ->select('id', 'slug', 'service_name', 'icon', 'image', 'meta_title', 'meta_keyword', 'meta_description', 'short_content', 'content')
            ->where('is_publish', 'Y')
            ->where('for_form', 'N')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($raw_where, function ($query) use ($raw_where) {
                $query->whereRaw($raw_where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_destination_data($where = false, $limit = false, $raw_where = false)
    {
        $data = DB::table('study_destinations')
            ->select('id', 'title','slug', 'short_content', 'image','icon', 'content', 'is_publish','order')
            ->where('is_publish', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($raw_where, function ($query) use ($raw_where) {
                $query->whereRaw($raw_where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_university_data($where = false, $limit = false, $raw_where = false)
    {
        $data = DB::table('universities')
            ->select('id', 'title','slug', 'short_content', 'website','image','icon', 'content', 'is_publish','order')
            ->where('is_publish', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($raw_where, function ($query) use ($raw_where) {
                $query->whereRaw($raw_where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_product_data($where = false, $limit = false, $raw_where = false)
    {
        $data = DB::table('our_product')
            ->select('id', 'code', 'title', 'image', 'short_description', 'description', 'features', 'advantages', 'product_catid', 'customer', 'start_date', 'end_date', 'website', 'meta_title', 'meta_keyword', 'meta_description')
            ->where('is_publish', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($raw_where, function ($query) use ($raw_where) {
                $query->whereRaw($raw_where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_branch_data($where = false, $limit = false, $raw_where = false)
    {
        $data = DB::table('branch_setup')
            ->select('id', 'branch_name', 'branch_location', 'branch_address', 'contact_person', 'contact_number', 'email', 'is_main', 'is_active')
            ->where('is_active', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($raw_where, function ($query) use ($raw_where) {
                $query->whereRaw($raw_where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_training_data($where = false, $limit = false)
    {
        $data = DB::table('training')
            ->select('id','slug','title', 'icon_name', 'short_description','description','training_image','trainer_name','trainer_image','icon_image','start_date','end_date','class_start','postdatead','meta_description','meta_keyword','meta_title')
            ->where('is_publish', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_events_data($where = false, $limit = false,$raw_where = false)
    {
        $data = DB::table('nne')
            ->select('id', 'slug','description', 'title', 'short_content','icon','image', 'startdate', 'enddate','is_publish', 'is_unlimited','postdatead','meta_title','meta_keyword','meta_description')
            ->where('is_publish', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($raw_where, function ($query) use ($raw_where) {
                $query->whereRaw($raw_where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->orderBy('postdatead', 'DESC')
            ->get();
        return $data;
    }
    // public static function get_product_category($where = false, $limit = false)
    // {
    //     $data = DB::table('our_product as p')
    //         ->leftJoin('ourproduct_category as  pc', 'pc.id', '=', 'p.product_catid')
    //         ->select('p.id','pc.id','product_catid', 'title', 'ourproduct_cat','image')
    //         ->where('pc.is_active', 'Y')
    //         ->when($where, function ($query) use ($where) {
    //             $query->where($where);
    //         })
    //         ->when($limit, function ($query) use ($limit) {
    //             $query->limit($limit);
    //         })
    //         ->groupBy('p.id','pc.id','product_catid', 'title', 'ourproduct_cat','image')
    //         ->orderBy('pc.order', 'ASC')
    //         ->get();
    //     return $data;
    // }

    public static function get_product_category()
    {
        $data = DB::table('ourproduct_category')
            ->select('id', 'code', 'ourproduct_cat', 'slug', 'description')
            ->where('is_active', 'Y')
            ->limit(15)
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_technology_cat_data()
    {
        $data = DB::table('technology_category')
            ->select('id', 'code', 'cat_name', 'slug', 'description')
            ->where('is_active', 'Y')
            ->limit(15)
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_technology_data()
    {
        $data = DB::table('technology')
            ->select('id', 'technology_catid', 'code', 'title', 'image', 'description')
            ->where('is_publish', 'Y')
            ->limit(15)
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_testimonials($where = false, $limit = false)
    {
        $data = DB::table('our_team')
            ->select('id', 'name', 'designation', 'image', 'description', 'facebook_link', 'twitter_link', 'linkedin_link', 'youtube_link', 'google_link', 'instagram_link')
            ->where('isactive', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_advertisement($limit = 0)
    {
        $data = DB::table('advertisement')
            ->select('id', 'ad_locationid', 'title','adv_image', 'ad_page_id', 'content', 'order')
            ->where('is_publish', 'Y')
            ->orderBy('order', 'ASC')
            ->when($limit, function ($query) use ($limit) {
                return $query->limit($limit);
            })
            ->get();
        return $data;
    }

    public static function get_blog_data($where = false, $limit = false)
    {
        $data = DB::table('blog')
            ->select('id', 'blog_slug', 'blog_categoryid', 'blog_title', 'view_count', 'content', 'seo_title', 'seo_keyword', 'seo_description', 'image', 'author', 'postdatead')
            ->where('is_publish', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->orderBy('postdatead', 'DESC')
            ->get();
        return $data;
    }

    public static function get_team_data($where = false, $limit = false,$raw_where = false)
    {
        $data = DB::table('our_team')
            ->select('id', 'name', 'description', 'skills', 'experience', 'address', 'contactno', 'designation', 'image', 'facebook_link', 'twitter_link', 'linkedin_link', 'youtube_link', 'instagram_link', 'email')
            ->where('isactive', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($raw_where, function ($query) use ($raw_where) {
                $query->whereRaw($raw_where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_blog_by_category($where = false, $limit = false)
    {
        $data = DB::table('blog as b')
            ->leftJoin('blog_category as  bc', 'bc.id', '=', 'b.blog_categoryid')
            ->select('bc.id', 'b.id', 'blog_categoryid', 'blog_title', 'content', 'image', 'author')
            ->where('is_publish', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->orderBy('b.order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_blog_cat_data($where = false, $limit = false)
    {
        $data = DB::table('blog as b')
            ->leftJoin('blog_category as  bc', 'bc.id', '=', 'b.blog_categoryid')
            ->select("bc.id", "cat_name", "cat_slug", DB::raw("COUNT(blog_categoryid) as count_blog"))
            ->where('b.is_publish', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->groupBy('bc.id', 'cat_name', 'cat_slug')
            ->orderBy('bc.order', 'ASC')
            ->get();
        return $data;
    }


    public static function get_frontend_tiles($where = false, $limit = false)
    {
        $data = DB::table('frontend_tiles')
            ->select('id', 'title', 'content', 'image', 'icon')
            ->where('is_publish', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_organization_data()
    {
        $data = DB::table('site_settings')
            ->select('id', 'logo', 'organization_name', 'mobile', 'phone', 'address1', 'address2', 'email', 'facebook_link', 'google_link', 'linkedin_link', 'twitter_link', 'instagram_link', 'youtube_link', 'tiktok_link','google_map_code', 'opening_days', 'opening_time')
            ->limit(1)
            ->get();
        return $data;
    }

    public static function get_useful_link_data()
    {
        $data = DB::table('useful_link')
            ->select('id', 'title', 'designation', 'link_url')
            ->where('isactive', 'Y')
            ->limit(5)
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_seo_list($where = false, $limit = false)
    {
        $data = DB::table('seo as s')
            ->leftJoin('seo_page as sp', 'sp.id', '=', 's.seo_pageid')
            ->select('seo_title', 'seo_metakeyword', 'seo_metadescription', 'schema1', 'schema2', 'page_name')
            ->where('isactive', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->get();
        return $data;
    }

    public static function get_gallery_category($where = false, $limit = false)
    {
        $data = DB::table('gallery_categories as gc')
            ->select('gc.id', 'gc.title', 'gc.updated_at')
            ->selectRaw("(SELECT COUNT(*) as image_count from galleries as g where g.is_display = 'Y' and g.gly_catid = gc.id) as image_count,(SELECT MAX(g.gly_content) from galleries as g where g.gly_catid = gc.id )as gly_content,(SELECT g.image_file from galleries as g where g.is_display = 'Y' and g.gly_catid = gc.id and g.order = 1 ORDER BY id DESC LIMIT 1) as image_file")
            ->where('is_active', 'Y')
            ->when($where, function ($query) use ($where) {
                $query->where($where);
            })
            ->when($limit, function ($query) use ($limit) {
                $query->limit($limit);
            })
            ->having('image_count', '>', 0)
            ->orderBy('order', 'DESC')
            ->get();
        return $data;
    }
}