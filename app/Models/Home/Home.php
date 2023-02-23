<?php

namespace App\Models\Home;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class Home extends Model
{
    public static function get_banner_data()
    {
        $data = DB::table('banner')
            ->select('id', 'banner_img', 'heading', 'content', 'button_text1', 'button_url1')
            ->where('is_publish', 'Y')
            ->limit(1)
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_news_data()
    {
        $data = DB::table('nne')
            ->select('id', 'description', 'title', 'image')
            ->where('is_publish', 'Y')
            ->orderBy('postdatead', 'DESC')
            ->orderBy('order', 'ASC')
            ->limit(4)
            ->get();
        return $data;
    }

    public static function get_testimonial_data()
    {
        $data = DB::table('testimonial')
            ->select('id', 'name', 'description', 'images')
            ->where('is_publish', 'Y')
            ->orderBy('order', 'ASC')
            ->get();
        return $data;
    }

    public static function get_services_data()
    {
        $data = DB::table('services')
            ->select('id', 'service_name', 'short_content', 'content', 'image')
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
            ->whereIn('page_slug', ['about', 'message-from-founder'])
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

    public static function get_study_destinations()
    {
        $data = DB::table('study_destinations')
            ->select('id', 'title', 'short_content', 'image')
            ->where('is_publish', 'Y')
            ->orderBy('order', 'ASC')
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

  
}
