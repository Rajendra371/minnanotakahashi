<?php

namespace App\Http\Controllers\Api\Frontend;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Frontend\Home;
use App\Models\Blog\BlogSetup;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Career\Career;
use App\Models\Faq\FaqCategory;
use App\Models\Faq\FaqSetup;
use App\Models\Gallery\GallerySetup;
use App\Models\Gallery\GalleryCategory;
use App\Models\GeneralSetting\SiteSetting;
use App\Models\Home\ClientReferral;
use App\Models\Home\SupportReferral;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class HomeController extends Controller
{
    public function get_nav_menu()
    {
        $navBarData = '';

        $navBarData = $this->navbar_adjacency(0, 0, 0, 0);

        if ($navBarData) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'view_data' => $navBarData]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function navbar_adjacency($id, $parent, $parent_id, $level)
    {
        $query = DB::table('menu')
            ->where('menu_parent', '=', $parent_id)
            ->where('menu_isactive', 'Y')
            ->orderBy('menu_order', 'ASC')
            ->get();
        $nav_cat_data = array();
        $nav_cat_all = array();
        $oMenus = $query;
        foreach ($oMenus as $value) :
            $nav_cat_data['id'] = $value->id;
            $nav_cat_data['navItem'] = $value->menu_name;
            $nav_cat_data['link'] = $value->menu_slug;

            $child_cat_array = array();

            $children_menu = DB::table('menu')->where('menu_parent', $value->id)->where('menu_isactive', 'Y')
                ->orderBy('menu_order', 'ASC')->get();
            if (!empty($children_menu)) {
                foreach ($children_menu as $key => $cmenu) {
                    $child_cat_array[] = array(
                        'childNav' => $cmenu->menu_name,
                        'link' => $cmenu->menu_slug
                    );
                }
            }

            $nav_cat_data['childrenMenu'] = $child_cat_array;
            // $nav_cat_all[] = $nav_cat_data;
            $data['nav_cat_all'] = $nav_cat_data;
        endforeach;
        // return $nav_cat_all;
        return view('Layout.Header', compact('data'));
    }

    public function index()
    {
        $data['banners'] = Home::get_banner_data();
        $data['services'] = Home::get_service_data(false, 9);
        // $data['form_services'] = DB::table('services')->select('id', 'service_name')->where('is_publish', 'Y')->where('for_form', 'Y')->get();
        $data['testimonials'] = Home::get_testimonials(array(['type', '2']), 5);
        $data['about'] = DB::table('pages')
            ->select('id', 'page_title', 'page_slug', 'short_content', 'description', 'images')
            ->where('is_publish', 'Y')
            ->where('page_slug', 'about')
            ->first();
        $data['choose'] = DB::table('pages')
        ->select('id', 'page_title', 'page_slug', 'short_content', 'description', 'images')
        ->where('is_publish', 'Y')
        ->where('page_slug', 'choose')
        ->first();
        // $data['brief_information'] = DB::table('pages')
        //     ->select('id', 'page_title', 'page_slug', 'short_content', 'description', 'images')
        //     ->where('is_publish', 'Y')
        //     ->where('page_slug', 'brief-information')
        //     ->first();
        $data['video'] = Home::get_video_gallery(array(['is_home_display', 'Y']),1);
        // dd($data['video']);
        // $data['useful_links'] = Home::get_useful_link_data();
        $data['blogs'] = Home::get_blog_data(false, 4);
        // $data['body_tiles'] = Home::get_frontend_tiles(array(['for_body', 'Y']), 4);
        $data['faqs'] = FaqSetup::select('id', 'title', 'description')->where('is_publish', 'Y')->orderBy('order')->limit(3)->get();
        $data['destination'] = Home::get_destination_data();
        $data['news'] = Home::get_events_data(array(['nne_typeid', '1']));
        $data['events'] = Home::get_events_data(array(['nne_typeid', '3']));
        $data['advertisement'] = Home::get_advertisement();
        // dd($data['advertisement']);
        $data['organization'] = Home::get_organization_data();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 1));
        // dd($data['seo_data']);
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
            $data['schema1'] = !empty($data['seo_data'][0]->schema1) ? $data['seo_data'][0]->schema1 : '';
            $data['schema2'] = !empty($data['seo_data'][0]->schema2) ? $data['seo_data'][0]->schema2 : '';
        } else {
            $data['page_title'] = '';
            $data['meta_keys'] = '';
            $data['meta_desc'] = '';
            $data['schema1'] = '';
            $data['schema2'] = '';
        }
        // dd($data['organization']);
        return view('Home.Home', $data);
    }

    public function about(Request $request)
    {
        $data['about'] = DB::table('pages')
            ->select('id', 'page_title', 'page_slug', 'short_content', 'description', 'images')
            ->where('is_publish', 'Y')
            ->where('page_slug', 'about')
            ->first();
        $data['short_description'] = Home::get_short_description();
        $data['teams'] = Home::get_testimonials(array(['type', '1']));

        // $data['organization'] = Home::get_organization_data();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 2));
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
        }
        return view('Home.about', $data);
    }

    public function who_are_we(Request $request)
    {
        $data['about'] = DB::table('pages')
            ->select('id', 'page_title', 'page_slug', 'short_content', 'description', 'images')
            ->where('is_publish', 'Y')
            ->where('page_slug', 'who-are-we')
            ->first();
        $data['short_description'] = Home::get_short_description();
        $data['teams'] = Home::get_testimonials(array(['type', '1']));

        // $data['organization'] = Home::get_organization_data();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 2));
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
        }
        return view('Home.whoarewe', $data);
    }

    public function choose(Request $request)
    {
        $data['choose'] = DB::table('pages')
            ->select('id', 'page_title', 'page_slug', 'short_content', 'description', 'images')
            ->where('is_publish', 'Y')
            ->where('page_slug', 'choose')
            ->first();
        $data['short_description'] = Home::get_short_description();

        // $data['organization'] = Home::get_organization_data();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 16));
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
        }
        return view('Home.choose', $data);
    }

    public function team_details($team_slug)
    {
        $slugArr = [];
        $id = 0;
        if (!empty($team_slug)) {
            $slugArr = explode('-', $team_slug);
            $id = last($slugArr);
        }
        $data['team_detail'] = Home::get_team_data(array(['id', $id]));

        $data['useful_links'] = Home::get_useful_link_data();
        $data['organization'] = Home::get_organization_data();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 3));
        // dd($data['team_detail']);
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['team_detail'][0]->name) ? $data['team_detail'][0]->name : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
        }
        // dd($data['service']);
        return view('Home.Team', $data);
    }

    public function blog(Request $request)
    {
        $data['our_products'] = Home::get_product_data(false, 5);
        $data['our_services'] = Home::get_service_data(false, 5);
        $data['useful_links'] = Home::get_useful_link_data();
        $data['organization'] = Home::get_organization_data();
        $data['blog'] = Home::get_blog_data();
        $data['popular_blog'] = Home::get_blog_data(array('is_popular' => 'Y'));
        $data['recent_blog'] = Home::get_blog_data();
        $data['blog_categories'] = Home::get_blog_cat_data();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 6));
        // dd($data['seo_data']);
        if ($data['seo_data']) {
            //set SEO data
            $page_title = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $meta_keys = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $meta_desc = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $og_title = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $og_desc = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
        }
        // dd($data['blog_categories']);
        return view('Home.Blog', compact('data','page_title','meta_keys','meta_desc','og_title','og_desc'));
    }

    public function categories($cat_slug = false)
    {
        if (!empty($cat_slug)) {
            $slugArr = explode('-', $cat_slug);
        }
        $cntarr = 2;
        if (is_array($slugArr)) {
            $cntarr = sizeof($slugArr);
        }
        $id = $slugArr[$cntarr - 1];
        $data['our_products'] = Home::get_product_data(false, 5);
        $data['our_services'] = Home::get_service_data(false, 5);
        $data['useful_links'] = Home::get_useful_link_data();
        $data['organization'] = Home::get_organization_data();
        $data['blog'] = Home::get_blog_by_category(array(['bc.id', $id]));
        // dd($data['blog']);
        $data['popular_blog'] = Home::get_blog_data();
        $data['recent_blog'] = Home::get_blog_data();
        $data['blog_categories'] = Home::get_blog_cat_data();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 9));
        if ($data['seo_data']) {
            //set SEO data
            $page_title = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $meta_keys = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $meta_desc = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $og_title = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $og_desc = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
        }
        return view('Home.Category', compact('data','page_title','meta_keys','meta_desc','og_title','og_desc'));
    }

    public function blog_detail($slug = false)
    {
        $slugArr = [];
        $id = 0;
        if (!empty($slug)) {
            $slugArr = explode('-', $slug);
            $id = last($slugArr);
        }
        $data['blog_detail'] = $blog = BlogSetup::find($id);
        if ($blog) {
            $blog->view_count++;
            $blog->save();
        }
        // dd($data['blog_detail']);
        $data['next'] = BlogSetup::where('id', '>', $id)->where('is_publish', 'Y')->select('id', 'blog_slug')->first();
        $data['previous'] = BlogSetup::where('id', '<', $id)->where('is_publish', 'Y')->select('id', 'blog_slug')->orderBy('id', 'DESC')->first();

        $data['popular_blogs'] =  DB::table('blog')
            ->select('id', 'blog_slug', 'image', 'blog_categoryid', 'blog_title', 'view_count', 'postdatead')
            ->where('is_publish', 'Y')
            ->orderBy('view_count', 'DESC')
            ->limit(8)
            ->get();

        $data['organization'] = Home::get_organization_data();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 7));
        if(!empty($data['blog_detail']->image)){
            $og_blog_image = asset('uploads/blog_image/' . $data['blog_detail']->image);
        }
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] =!empty( $data['blog_detail']->blog_title)? $data['blog_detail']->blog_title:'' ;
			$data['meta_keys']= !empty( $data['blog_detail']->seo_keyword)? $data['blog_detail']->seo_keyword:'';
			$data['meta_desc']= !empty( $data['blog_detail']->seo_description)? $data['blog_detail']->seo_description:'';   
            $data['og_title'] = !empty( $data['blog_detail']->blog_title)? $data['blog_detail']->blog_title:'' ;
			$data['og_desc'] = !empty( $data['blog_detail']->seo_keyword)? $data['blog_detail']->seo_keyword:'';
			$data['og_blog_image']=!empty($og_blog_image)?$og_blog_image:'';
        }
        // dd($data['blog_detail']);
        return view('Home.BlogDetail', $data);
    }

    public function events(Request $request)
    {  
        $data['events'] = Home::get_events_data(array(['nne_typeid', '3']));
        // dd( $data['events'] );
        $data['seo_data']= Home::get_seo_list(array('sp.id'=> 17));
        // dd($data['team_detail']);
        if( $data['seo_data'])
		{
			//set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
		}
        // dd($data['service']);
        return view('Home.events', $data );
    }

    public function events_detail($events_slug)
    {     
        $slugArr = [];
        $id = 0;
        if (!empty($events_slug)) {
            $slugArr = explode('-', $events_slug);
            $id = last($slugArr);
        }
        $data['events_detail'] = Home::get_events_data(array(['id', $id]));
        // dd($data['events_detail']);
        // $data['blog_detail'] = Home::get_blog_data(array(['id', $id]));
        // $data['popular_blog'] = Home::get_blog_data(array('is_popular'=> 'Y'));
        $data['recent_event'] = Home::get_events_data(false,6);
        // dd($data['recent_event']);
        // $data['blog_categories'] = Home::get_blog_cat_data();
        $data['seo_data']= Home::get_seo_list(array('sp.id'=> 18));
        if(!empty($data['events_detail'][0]->image)){
            $og_blog_image = asset('uploads/nne_image/' . $data['events_detail'][0]->image);
        }
        // dd($data['team_detail']);
        if( $data['seo_data'])
		{
			//set SEO data
			$data['page_title'] =!empty( $data['events_detail'][0]->title)? $data['events_detail'][0]->title:'' ;
			$data['meta_keys']= !empty( $data['seo_data'][0]->seo_metakeyword)? $data['seo_data'][0]->seo_metakeyword:'';
			$data['meta_desc']= !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
            $data['og_title'] = !empty( $data['events_detail'][0]->title)? $data['events_detail'][0]->title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metakeyword)? $data['seo_data'][0]->seo_metakeyword:'';
			$data['og_blog_image']=!empty($og_blog_image)?$og_blog_image:'';
		}
        // dd($data['service']);
        return view('Home.eventsdetail', $data );
    }

    public function news(Request $request)
    {  
        $data['news'] = Home::get_events_data(array(['nne_typeid', '1']));
        // dd( $data['events'] );
        $data['seo_data']= Home::get_seo_list(array('sp.id'=> 19));
        // dd($data['team_detail']);
        if( $data['seo_data'])
		{
			//set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
		}
        // dd($data['service']);
        return view('Home.news', $data );
    }

    public function news_detail($events_slug)
    {     
        $slugArr = [];
        $id = 0;
        if (!empty($events_slug)) {
            $slugArr = explode('-', $events_slug);
            $id = last($slugArr);
        }
        $data['news_detail'] = Home::get_events_data(array(['id', $id]));
        // dd($data['events_detail']);
        // $data['blog_detail'] = Home::get_blog_data(array(['id', $id]));
        // $data['popular_blog'] = Home::get_blog_data(array('is_popular'=> 'Y'));
        $data['recent_event'] = Home::get_events_data(false,6);
        // dd($data['recent_event']);
        // $data['blog_categories'] = Home::get_blog_cat_data();
        $data['seo_data']= Home::get_seo_list(array('sp.id'=> 20));
        if(!empty($data['news_detail'][0]->image)){
            $og_image = asset('uploads/nne_image/' . $data['news_detail'][0]->image);
        }
        if( $data['seo_data'])
		{
			//set SEO data
			$data['page_title'] =!empty( $data['news_detail'][0]->title)? $data['news_detail'][0]->title:'' ;
			$data['meta_keys']= !empty( $data['seo_data'][0]->seo_metakeyword)? $data['seo_data'][0]->seo_metakeyword:'';
			$data['meta_desc']= !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
            $data['og_title'] = !empty( $data['news_detail'][0]->title)? $data['news_detail'][0]->title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metakeyword)? $data['seo_data'][0]->seo_metakeyword:'';
			$data['og_image']=!empty($og_image)?$og_image:'';
		}
        // dd($data['service']);
        return view('Home.newsdetail', $data );
    }

    public function services(Request $request)
    {
        $data['services'] = Home::get_service_data();
        $data['useful_links'] = Home::get_useful_link_data();
        $data['organization'] = Home::get_organization_data();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 21));
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
        }
        // dd($data['service']);
        return view('Home.Services', $data);
    }

    public function training(Request $request)
    {
        $data['training'] = Home::get_training_data();
        // dd($data['training']);
        $data['useful_links'] = Home::get_useful_link_data();
        $data['organization'] = Home::get_organization_data();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 5));
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
        }
        // dd($data['service']);
        return view('Home.Training', $data);
    }

    public function branch(Request $request)
    {
        $data['branch'] = Home::get_branch_data();
        $data['national_branch'] = Home::get_branch_data(array('branch_type' => 1)); 
        $data['international_branch'] = Home::get_branch_data(array('branch_type' => 2));
        // dd($data['branch']);
    //     $data['useful_links'] = Home::get_useful_link_data();
    //     $data['organization'] = Home::get_organization_data();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 15));
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
        }
        // dd($data['service']);
        return view('Home.Branch', $data);
    }

    public function service_details($slug = false)
    {
        $slugArr = [];
        $id = 0;
        if (!empty($slug)) {
            $slugArr = explode('-', $slug);
            $id = last($slugArr);
        }

        $data['service_details'] = Home::get_service_data(array('id' => $id));
        $data['organization'] = Home::get_organization_data();
        $data['other_services'] = Home::get_service_data(false, 8, "id != $id");
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 22));
        $og_blog_image = asset('uploads/service_image/' . $data['service_details'][0]->image);
        if ($data['seo_data']) {
            //set SEO data 
            $data['page_title'] = !empty($data['service_details'][0]->meta_title) ? $data['service_details'][0]->meta_title : '';
            $data['meta_keys'] = !empty($data['service_details'][0]->meta_keyword) ? $data['service_details'][0]->meta_keyword : '';
            $data['meta_desc'] = !empty($data['service_details'][0]->meta_description) ? $data['service_details'][0]->meta_description : '';
            $data['og_title'] = !empty( $data['service_details'][0]->meta_title)? $data['service_details'][0]->meta_title:'' ;
			$data['og_desc'] = !empty( $data['service_details'][0]->meta_description)? $data['service_details'][0]->meta_description:'';
			$data['og_blog_image']=$og_blog_image;
        }
        // dd($data['service_details']);
        return view('Home.Servicedetail', $data);
    }

    public function destination(Request $request)
    {
        $data['destination'] = Home::get_destination_data();
        // dd($data['destination']);
        $data['useful_links'] = Home::get_useful_link_data();
        $data['organization'] = Home::get_organization_data();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 14));
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
        }
        // dd($data['service']);
        return view('Home.Destination', $data);
    }

    public function country(Request $request)
    {
        $data['destination'] = Home::get_destination_data();
        // dd($data['destination']);
        $data['useful_links'] = Home::get_useful_link_data();
        $data['organization'] = Home::get_organization_data();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 14));
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
        }
        // dd($data['service']);
        return view('Home.Country', $data);
    }

    public function country_detail($slug = false)
    {
        $slugArr = [];
        $id = 0;
        if (!empty($slug)) {
            $slugArr = explode('-', $slug);
            $id = last($slugArr);
        }

        $data['university'] = Home::get_university_data(array('country_id' => $id));
        // dd($data['university']);
       
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 14));
        if ($data['seo_data']) {
            //set SEO data 
            $data['page_title'] = !empty($data['seo_data'][0]->meta_title) ? $data['seo_data'][0]->meta_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->meta_keyword) ? $data['seo_data'][0]->meta_keyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->meta_description) ? $data['seo_data'][0]->meta_description : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->meta_title)? $data['seo_data'][0]->meta_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->meta_description)? $data['seo_data'][0]->meta_description:'';
        }
        // dd($data['service_details']);
        return view('Home.Universities', $data);
    }

    public function destination_details($slug = false)
    {
        $slugArr = [];
        $id = 0;
        if (!empty($slug)) {
            $slugArr = explode('-', $slug);
            $id = last($slugArr);
        }

        $data['destination_details'] = Home::get_destination_data(array('id' => $id));
        // dd($data['destination_details'][0]->image);
        $data['organization'] = Home::get_organization_data();
        $data['other_services'] = Home::get_service_data(false, 8, "id != $id");
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 14));
        if(!empty($data['destination_details'][0]->image)){
            $og_blog_image = asset('uploads/study_destinations/' . $data['destination_details'][0]->image);
        }
        if ($data['seo_data']) {
            //set SEO data 
            $data['page_title'] = !empty($data['destination_details'][0]->title) ? $data['destination_details'][0]->title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['destination_details'][0]->title)? $data['destination_details'][0]->title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
			$data['og_blog_image']=!empty($og_blog_image)?$og_blog_image:'';
        }
        // dd($data['service_details']);
        return view('Home.Destinationdetail', $data);
    }


    public function training_details($slug = false)
    {
        $slugArr = [];
        $id = 0;
        if (!empty($slug)) {
            $slugArr = explode('-', $slug);
            $id = last($slugArr);
        }

        $data['training_details'] = Home::get_training_data(array('id' => $id));
        // dd( $data['training_details']);
        $data['organization'] = Home::get_organization_data();
        $data['other_services'] = Home::get_service_data(false, 8, "id != $id");
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 5));
        if(!empty($data['training_details'][0]->training_image)){
            $og_blog_image = asset('uploads/training_image/' . $data['training_details'][0]->training_image);
        }
        if ($data['seo_data']) {
            //set SEO data 
            $data['page_title'] = !empty($data['training_details'][0]->meta_title) ? $data['training_details'][0]->meta_title : '';
            $data['meta_keys'] = !empty($data['training_details'][0]->meta_keyword) ? $data['training_details'][0]->meta_keyword : '';
            $data['meta_desc'] = !empty($data['training_details'][0]->meta_description) ? $data['training_details'][0]->meta_description : '';
            $data['og_title'] = !empty( $data['training_details'][0]->meta_title)? $data['training_details'][0]->meta_title:'' ;
			$data['og_desc'] = !empty( $data['training_details'][0]->meta_description)? $data['training_details'][0]->meta_description:'';
			$data['og_blog_image']=!empty($og_blog_image)?$og_blog_image:'';
        }
        // dd($data['service_details']);
        return view('Home.Trainingdetail', $data);
    }

    public function gallery()
    {
        $data['categories'] = Home::get_gallery_category(false, 6);
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 10));
        if ($data['seo_data']) {
            //set SEO data 
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
        }
        return view('Home.gallery', $data);
    }

    public function gallery_details($id)
    {
        $data['photos'] = DB::table('galleries')->select('id', 'gly_title', 'gly_content', 'image_file')->where('gly_catid', $id)->where('is_display', 'Y')->get();
        // dd($data['photos']);
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 10));
        if ($data['seo_data']) {
            //set SEO data 
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty( $data['seo_data'][0]->seo_title)? $data['seo_data'][0]->seo_title:'' ;
			$data['og_desc'] = !empty( $data['seo_data'][0]->seo_metadescription)? $data['seo_data'][0]->seo_metadescription:'';
        }
        return view('Home.gallery_details', $data);
    }

    public function faqs()
    {
        $categories = FaqCategory::with('faqs')->where('is_publish', 'Y')->select('id', 'icon', 'category_name')->orderBy('order')->get();
        // dd($categories);
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 11));
        if ($data['seo_data']) {
            //set SEO data 
            $page_title = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $meta_keys = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $meta_desc = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $og_title = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $og_desc = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
        }
        return view('Home.faqs', compact('categories','page_title','meta_keys','meta_desc','og_title','og_desc'));
    }

    public function contact()
    {
        // $id = $request->get('id');
        $data['our_products'] = Home::get_product_data(false, 5);
        $data['our_services'] = Home::get_service_data(false, 5);
        $data['useful_links'] = Home::get_useful_link_data();
        $data['organization'] = Home::get_organization_data();
        $data['national_branch'] = Home::get_branch_data(array('branch_type' => 1));
       
        $data['international_branch'] = Home::get_branch_data(array('branch_type' => 2));
        //  dd($data['international_branch']);
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 8));
        if ($data['seo_data']) {
            //set SEO data
            $page_title = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : 'WEBSITE_NAME';
            $meta_keys = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : 'WEBSITE_NAME';
            $meta_desc = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : 'WEBSITE_NAME';
            $og_title = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $og_desc = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
        } else {
            $page_title = '';
            $meta_keys = '';
            $meta_desc = '';
        }
        // dd($data['service']);
        return view('Home.Contact', compact('data','page_title','meta_keys','meta_desc','og_title','og_desc'));
    }

    public function product()
    {
        $data['our_products'] = Home::get_product_data(false, 5);
        $data['our_services'] = Home::get_service_data(false, 5);
        $data['useful_links'] = Home::get_useful_link_data();
        $data['organization'] = Home::get_organization_data();
        $data['product_cat'] = Home::get_product_category();
        $data['product'] = Home::get_product_data();
        // dd($data['product_cat']);
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 4));
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
        }
        // dd($data['service']);
        return view('Home.Product', compact('data'));
    }

    public function product_detail($product_slug)
    {
        if (!empty($product_slug)) {
            $slugArr = explode('-', $product_slug);
        }
        $cntarr = 2;
        if (is_array($slugArr)) {
            $cntarr = sizeof($slugArr);
        }
        $id = $slugArr[$cntarr - 1];
        $data['our_products'] = Home::get_product_data(false, 5);
        $data['our_services'] = Home::get_service_data(false, 5);
        $data['useful_links'] = Home::get_useful_link_data();
        $data['organization'] = Home::get_organization_data();
        // $data['service'] = Home::get_service_data();
        $data['product_details'] = Home::get_product_data(array(['id', $id]));
        $data['related_product'] = Home::get_product_data(false, 3, "id != $id");
        // dd($data['product_details'][0]->title);
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 4));
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['product_details'][0]->title) ? $data['product_details'][0]->title : '';
            $data['meta_keys'] = !empty($data['product_details'][0]->meta_keyword) ? $data['product_details'][0]->meta_keyword : '';
            $data['meta_desc'] = !empty($data['product_details'][0]->meta_description) ? $data['product_details'][0]->meta_description : '';
        }
        // dd($data['service']);
        return view('Home.Productdetail', compact('data'));
    }

    public function universities(Request $request)
    {
        $data['university'] = DB::table('pages')
            ->select('id', 'page_title', 'page_slug', 'short_content', 'description', 'images')
            ->where('is_publish', 'Y')
            ->where('page_slug', 'universities')
            ->first();
            $data['destination'] = Home::get_destination_data();
        $data['categories'] = FaqCategory::with('faqs')->where('is_publish', 'Y')->select('id', 'icon', 'category_name')->orderBy('order')->get();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 13));
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['og_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
        }
        return view('Home.Universities', $data);
    }

    public function book_appointment(Request $request)
    {
        $data['university'] = DB::table('pages')
            ->select('id', 'page_title', 'page_slug', 'short_content', 'description', 'images')
            ->where('is_publish', 'Y')
            ->where('page_slug', 'universities')
            ->first();
        $data['categories'] = FaqCategory::with('faqs')->where('is_publish', 'Y')->select('id', 'icon', 'category_name')->orderBy('order')->get();
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 2));
        if ($data['seo_data']) {
            //set SEO data
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
            $data['og_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['og_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
        }
        return view('Home.appointment', $data);
    }

    public function message_from_founder(Request $request)
    {
        $data['foundermessage'] = Home::get_team_data(array(['type', '3']),false,"designation = 'Founder'");
        if ($data['foundermessage']) {
            //set SEO data
            $data['page_title'] = !empty($data['foundermessage'][0]->seo_meta_title) ? $data['foundermessage'][0]->seo_meta_title : '';
            $data['meta_keys'] = !empty($data['foundermessage'][0]->seo_meta_keyword) ? $data['foundermessage'][0]->seo_meta_keyword : '';
            $data['meta_desc'] = !empty($data['foundermessage'][0]->seo_meta_description) ? $data['foundermessage'][0]->seo_meta_description : '';
            $data['og_title'] = !empty($data['foundermessage'][0]->seo_meta_title) ? $data['foundermessage'][0]->seo_meta_title : '';
            $data['og_desc'] = !empty($data['foundermessage'][0]->seo_meta_description) ? $data['foundermessage'][0]->seo_meta_description : '';
        }
        return view('Home.messagefromfounder',$data);
    }

    public function message_from_ceo(Request $request)
    {
        $data['ceomessage'] = Home::get_team_data(array(['type', '3']),false,"designation = 'CEO'");
        if ($data['ceomessage']) {
            //set SEO data
            $data['page_title'] = !empty($data['ceomessage'][0]->seo_meta_title) ? $data['ceomessage'][0]->seo_meta_title : '';
            $data['meta_keys'] = !empty($data['ceomessage'][0]->seo_meta_keyword) ? $data['ceomessage'][0]->seo_meta_keyword : '';
            $data['meta_desc'] = !empty($data['ceomessage'][0]->seo_meta_description) ? $data['ceomessage'][0]->seo_meta_description : '';
            $data['og_title'] = !empty($data['ceomessage'][0]->seo_meta_title) ? $data['ceomessage'][0]->seo_meta_title : '';
            $data['og_desc'] = !empty($data['ceomessage'][0]->seo_meta_description) ? $data['ceomessage'][0]->seo_meta_description : '';
        }
        return view('Home.messagefromceo',$data);
    }

    public function video(Request $request)
    {
        $data['video_gallery'] = Home::get_video_gallery();
        // dd($data['video_gallery']);
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 10));
        if ($data['seo_data']) {
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
        }
        return view('Home.video', $data);
    }

    public function team(Request $request)
    {
        $data['teams'] = Home::get_testimonials(array(['type', '1']));
        $data['seo_data'] = Home::get_seo_list(array('sp.id' => 3));
        if ($data['seo_data']) {
            $data['page_title'] = !empty($data['seo_data'][0]->seo_title) ? $data['seo_data'][0]->seo_title : '';
            $data['meta_keys'] = !empty($data['seo_data'][0]->seo_metakeyword) ? $data['seo_data'][0]->seo_metakeyword : '';
            $data['meta_desc'] = !empty($data['seo_data'][0]->seo_metadescription) ? $data['seo_data'][0]->seo_metadescription : '';
        }
        return view('Home.teams', $data);
    }

    public function contact_us(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'contact_number' => 'nullable|numeric|digits_between:8,10'
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
        }
        $email = $request->email;
        $count = DB::table('contact_us_record')->where('email', $email)->where('status', '2')->count('email');
        if ($count >= 5) {
            return response()->json(['status' => 'error', 'message' => ['Too many attempts, we will get in touch soon. !!']]);
        }
        $input = $request->except('_token');
        $input['postip'] = get_real_ipaddr();
        $input['postmac'] = get_Mac_Address();
        $input['postdatead'] = CURDATE_EN;
        $input['postdatebs'] = EngToNepDateConv(CURDATE_EN);
        $input['posttime'] = date('H:i:s');
        if ($insert_id = DB::table('contact_us_record')->insertGetId($input)) {
            $data = DB::table('contact_us_record as cr')
                ->select('cr.id', 'cr.full_name', 'cr.contact_number', 'cr.email', 'cr.subject', 'cr.message', 'cr.postdatead', 'cr.posttime')
                ->where('cr.id', $insert_id)
                ->first();
            $template = view('Contact.view')->with('data', $data)->render();
            // $parseValues = array(
            //     'TITLE' => 'Contact Us Message',
            //     'TEMPLATE' => $template,
            // );
            // $mail_message = sendMail($parseValues, "form_submit", 'jharana07.jr@gmail.com', $data->email);
            return response()->json(['status' => 'success', 'message' => 'Thank you for contacting us!!', 'redirect' => route('home')]);
        }
        return response()->json(['status' => 'error', 'message' => 'Error, please try after few moments!!']);
    }

    public function appointment(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'full_name' => 'required',
            'email' => 'required|email',
            'contact_number' => 'nullable|numeric|digits_between:8,10'
        ]);

        if ($validation->fails()) {
            return response()->json(['status' => 'error', 'message' => $validation->errors()->all()]);
        }
        $email = $request->email;
        $count = DB::table('appointment')->where('email', $email)->where('status', '2')->count('email');
        if ($count >= 5) {
            return response()->json(['status' => 'error', 'message' => ['Too many attempts, we will get in touch soon. !!']]);
        }
        $input = $request->except('_token');
        $input['postip'] = get_real_ipaddr();
        $input['postmac'] = get_Mac_Address();
        $input['postdatead'] = CURDATE_EN;
        $input['postdatebs'] = EngToNepDateConv(CURDATE_EN);
        $input['posttime'] = date('H:i:s');
        if ($insert_id = DB::table('appointment')->insertGetId($input)) {
            $data = DB::table('appointment as cr')
                ->select('cr.id', 'cr.full_name', 'cr.contact_number', 'cr.email', 'cr.country', 'cr.address', 'cr.course', 'cr.subject', 'cr.message', 'cr.postdatead', 'cr.posttime')
                ->where('cr.id', $insert_id)
                ->first();
            $template = view('Contact.view')->with('data', $data)->render();
            $parseValues = array(
                'TITLE' => 'Appointment Message',
                'TEMPLATE' => $template,
            );
            $mail_message = sendMail($parseValues, "form_submit", 'jharana07.jr@gmail.com', $data->email);
            return response()->json(['status' => 'success', 'message' => 'Thank you for contacting us!!', 'redirect' => route('home')]);
        }
        return response()->json(['status' => 'error', 'message' => 'Error, please try after few moments!!']);
    }

    public static function header_footer()
    {
        $data['useful_links'] = Home::get_useful_link_data();
        $data['organization'] = Home::get_organization_data();
        $data['destination_menu'] = Home::get_destination_data();     
        $data['training_menu'] = Home::get_training_data();
        $data['blog'] = Home::get_blog_data(false, 2);
        return $data;
    }

    public function maintenance()
    {
        return view('Home.maintenance');
    }

    public function maintenance_submit(Request $request)
    {
        $key = SiteSetting::value('maintenance_key');
        if ($key == $request->key) {
            Session::put('maintenance_key', $key);
            return redirect()->route('home');
        }
        return back();
    }
}