<?php

namespace App\Http\Controllers\Api\Home;

use Carbon\Carbon;
use App\Models\Home\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->adjacencyList = "";
        $this->adjacencyCheckboxlist = "";
        $this->menuList = "";
    }

    public function index()
    {
    }

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
            $nav_cat_all[] = $nav_cat_data;
        endforeach;
        return $nav_cat_all;
    }

    public function get_frontend_data()
    {
        $banner_data = Home::get_banner_data();
        $news_data = Home::get_news_data();
        $testimonial_data = Home::get_testimonial_data();
        $short_description = Home::get_short_description();
        $video_gallery = Home::get_video_gallery(3);
        $study_destinations = Home::get_study_destinations();
        $header_tiles = Home::get_frontend_tiles(array(['for_header', 'Y']), 4);
        $body_tiles = Home::get_frontend_tiles(array(['for_body', 'Y']), 3);
        $associated_colleges = Home::get_associated_college();
        $bannerArray = $newsArray = $testimonialArray = $studyDestinationArray = $bodyTiles = $headerTiles = $collegeArray = array();


        // Associated Colleges
        if (!empty($associated_colleges)) {
            foreach ($associated_colleges as $bval) {
                $image_url = !empty($bval->image) ? URL("uploads/associated_college/$bval->image") : "";
                $collegeArray[] = array(
                    'id' => $bval->id,
                    'imgUrl' => $image_url,
                    'title' => $bval->college_name,
                    'link' => $bval->college_url,
                );
            }
        }
        // Banner
        if (!empty($banner_data)) {
            foreach ($banner_data as $bval) {
                $image_url = !empty($bval->banner_img) ? URL("uploads/banner_image/$bval->banner_img") : "";
                $bannerArray[] = array(
                    'id' => $bval->id,
                    'imgUrl' => $image_url,
                    'title' => $bval->heading,
                    'content' => $bval->content,
                    'button_text' => $bval->button_text1,
                    'button_url' => $bval->button_url1
                );
            }
        }
        // Header Tile
        if (!empty($header_tiles)) {
            foreach ($header_tiles as $bval) {
                $image_url = !empty($bval->image) ? URL("uploads/frontend_tiles/$bval->image") : "";
                $headerTiles[] = array(
                    'id' => $bval->id,
                    'imgUrl' => $image_url,
                    'title' => $bval->title,
                    'content' => $bval->content,
                    'icon' => $bval->icon
                );
            }
        }
        // Body Tile
        if (!empty($body_tiles)) {
            foreach ($body_tiles as $bval) {
                $image_url = !empty($bval->image) ? URL("uploads/frontend_tiles/$bval->image") : "";
                $bodyTiles[] = array(
                    'id' => $bval->id,
                    'imgUrl' => $image_url,
                    'title' => $bval->title,
                    'content' => $bval->content,
                    'icon' => $bval->icon
                );
            }
        }

        // News 
        if (!empty($news_data)) {
            foreach ($news_data as $news) {
                $image_url = !empty($news->image) ? URL("uploads/nne_image/$news->image") : "";
                $newsArray[] = array(
                    'id' => $news->id,
                    'imgUrl' => $image_url,
                    'title' => $news->title,
                    'content' => str_limit($news->description, 200, '...')
                );
            }
        }

        // Testimonial 
        if (!empty($testimonial_data)) {
            foreach ($testimonial_data as $data) {
                $image_url = !empty($data->images) ? URL("uploads/testimonial_image/$data->images") : "http://via.placeholder.com/40";
                $testimonialArray[] = array(
                    'id' => $data->id,
                    'imgUrl' => $image_url,
                    'name' => $data->name,
                    'content' => $data->description
                );
            }
        }

        // Study Destinations 
        if (!empty($study_destinations)) {
            foreach ($study_destinations as $data) {
                $image_url = !empty($data->image) ? URL("uploads/study_destinations/$data->images") : URL("uploads/thedial.jpg");
                $studyDestinationArray[] = array(
                    'id' => $data->id,
                    'imgUrl' => $image_url,
                    'title' => $data->title,
                    'short_content' => str_limit($data->short_content, 100, '...')
                );
            }
        }

        $frontendData = array(
            'banner_data' => $bannerArray,
            'news_data' => $newsArray,
            'testimonial_data' => $testimonialArray,
            'short_description' => $short_description,
            'video_gallery' => $video_gallery,
            'study_destinations' => $studyDestinationArray,
            'header_tiles' => $headerTiles,
            'body_tiles' => $bodyTiles,
            'associated_college' => $collegeArray
        );


        if ($frontendData) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'data' => $frontendData]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function get_services()
    {
        $services_data = Home::get_services_data();
        if (!empty($services_data)) {
            foreach ($services_data as $service) {
                if (!empty($service->image)) {
                    $image_url = URL("uploads/service_image/$service->image");
                } else {
                    $image_url = "";
                }
                $data[] = array(
                    'id' => $service->id,
                    'imgUrl' => $image_url,
                    'title' => $service->service_name,
                    'content' => $service->content,
                    'short_content' => $service->short_content
                );
            }
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'data' => $data]);
        }
        return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
    }

    public function get_nav_category()
    {
        $parent_category_data = Home::get_parent_category();

        $nav_cat_data = array();
        $nav_cat_all = array();

        foreach ($parent_category_data as $pckey => $pcdata) {
            $nav_cat_data['id'] = $pcdata->id;
            $nav_cat_data['categoryName'] = $pcdata->category_name;
            $nav_cat_data['categorySlug'] = str_slug($pcdata->category_name, "-") . "-" . $pcdata->id;
            $nav_cat_data['description'] = str_limit($pcdata->category_description, $limit = 250, $end = '...');

            $image = DB::table('product')->where('category_id', $pcdata->id)->whereNotNull('image')->limit('1')->value('image');
            if (!empty($image)) {
                $nav_cat_data['image'] =  URL("/uploads/product_image/$image");
            } else {
                $nav_cat_data['image'] =  URL("/public/images/frontend/logo.png");
            }
            $child_category_data = DB::table('product_category')->where('parentid', '=', $pcdata->id)->get();

            if (!empty($child_category_data)) {
                $child_cat_array = array();
                foreach ($child_category_data as $cckey => $ccdata) {
                    $child_cat_array[] = array(
                        'id' => $ccdata->id,
                        'name' => $ccdata->category_name,
                        'slug' => str_slug($ccdata->category_name) . "-" . $ccdata->id,
                    );
                }
                $nav_cat_data['childrenMenu'] = $child_cat_array;
            }

            $nav_cat_all[] = $nav_cat_data;
        }

        $navData = array(
            'nav_data' => $nav_cat_all
        );

        if ($navData) {
            return response()->json(['status' => 'success', 'message' => 'Data Available', 'view_data' => $navData]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function about_us()
    {
        $data = DB::table('pages')->where('page_slug', 'about')->select('id', 'page_title', 'page_slug', 'short_content', 'description', 'images')->first();
        if ($data) {
            if (!empty($data->images)) {
                $image_url = URL("uploads/page_image/$data->images");
            } else {
                $image_url = "";
            }
            $result = array(
                'id' => $data->id,
                'page_title' => $data->page_title,
                'page_slug' => $data->page_slug,
                'short_content' => $data->short_content,
                'description' => $data->description,
                'imgUrl' => $image_url
            );
            return response()->json(['status' => 'success', 'data' => $result, 'message' => 'Data Fetched']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No Data Found']);
        }
    }
    public function get_faq()
    {
        $data = array();
        $faq_cat = DB::table('faq_category')->where('is_publish', 'Y')->select('id', 'category_name')->orderBy('order', 'ASC')->get();
        if (!empty($faq_cat)) {
            foreach ($faq_cat as $key => $faq) {
                $data[$key]['name'] = $faq->category_name;
                $result = DB::table('faq')->where('is_publish', 'Y')->where('faq_categoryid', $faq->id)->orderBy('order', 'ASC')->get();
                $sub_data = array();
                if ($result) {
                    foreach ($result as $id => $res) {
                        $sub_data[] = array(
                            'id' => $res->id,
                            'question' => $res->title,
                            'answer' => $res->description
                        );
                    }
                }
                $data[$key]['category_data'] = $sub_data;
            }
            if (!empty($data)) {
                return response()->json(['status' => 'success', 'data' => $data]);
            } else {
                return response()->json(['status' => 'error', 'message' => 'No Data']);
            }
        }
    }
    public function get_page_details(Request $request)
    {
        $slug = $request->get('slug');
        $result = DB::table('pages')->where('page_slug', $slug)->where('is_publish', 'Y')->select('id', 'page_title', 'page_slug', 'short_content', 'description', 'images')->first();

        if (!empty($result)) {
            return response()->json(['status' => 'success', 'data' => $result]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No Data']);
        }
    }

    public function get_blog_list($limit = false)
    {
        $qry = DB::table('blog')->where('is_publish', 'Y')->orderBy('order', 'ASC');
        if ($limit) {
            $qry->limit($limit);
        }
        $result =  $qry->get();
        $data = array();
        if ($result) {
            foreach ($result as $key => $res) {
                $image_url = !empty($res->image) ? URL("/uploads/blog_image/$res->image") : URL("/uploads/thedial.png");
                $data[] = array(
                    'id' => $res->id,
                    'title' => $res->blog_title,
                    'image' => $image_url,
                    'author' => '',
                    'created_at' => Carbon::parse($res->created_at)->toFormattedDateString(),
                );
            }
        }
        if (!empty($data)) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No Data']);
        }
    }

    public function get_news_list()
    {
        $result = DB::table('nne')->where('is_publish', 'Y')->orderBy('order', 'ASC')->get();
        $data = array();
        if ($result) {
            foreach ($result as $key => $res) {
                $image_url = !empty($res->image) ? URL("/uploads/nne_image/$res->image") : URL("/uploads/thedial.png");
                $data[] = array(
                    'id' => $res->id,
                    'title' => $res->title,
                    'image' => $image_url,
                    'author' => '',
                    'created_at' => Carbon::parse($res->created_at)->toFormattedDateString(),
                );
            }
        }
        if (!empty($data)) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No Data']);
        }
    }

    public function get_study_destination_list()
    {
        $result = Home::get_study_destinations();
        $data = array();
        if ($result) {
            foreach ($result as $res) {
                $image_url = !empty($res->image) ? URL("/uploads/study_destinations/$res->image") : URL("/uploads/thedial.jpg");
                $data[] = array(
                    'id' => $res->id,
                    'title' => $res->title,
                    'image' => $image_url,
                    'short_content' => str_limit($res->short_content, 100, '...')
                );
            }
        }
        if (!empty($data)) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No Data']);
        }
    }
    public function get_blog_detail(Request $request)
    {
        $id = $request->get('id');
        $result = DB::table('blog')->where('id', $id)->where('is_publish', 'Y')->first();
        $data = array();
        if ($result) {

            $data[] = array(
                'id' => $result->id,
                'title' => $result->blog_title,
                'content' => $result->content,
                'image' => URL("/uploads/blog_image/$result->image"),
                'author' => '',
                'created_at' => Carbon::parse($result->created_at)->toFormattedDateString(),
                'share_url' => URL("/blog/$result->id")
            );
        }
        if (!empty($data)) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No Data']);
        }
    }

    public function get_news_detail(Request $request)
    {
        $id = $request->id;
        $result =  DB::table('nne')->where('id', $id)->where('is_publish', 'Y')->first();
        $data = array();
        if ($result) {
            $image_url = !empty($result->image) ? URL("/uploads/nne_image/$result->image") : URL("/uploads/thedial.png");
            $data[] = array(
                'id' => $result->id,
                'title' => $result->title,
                'content' => $result->description,
                'image' => $image_url,
                'author' => '',
                'created_at' => Carbon::parse($result->created_at)->toFormattedDateString(),
                'share_url' => URL("/news/$result->id")
            );
        }
        if (!empty($data)) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No Data']);
        }
    }

    public function get_study_destination_detail(Request $request)
    {
        $id = $request->id;
        $result =  DB::table('study_destinations')->where('id', $id)->where('is_publish', 'Y')->first();
        $data = array();
        if ($result) {
            $image_url = !empty($result->image) ? URL("/uploads/study_destinations/$result->image") : URL("/uploads/thedial.png");
            $data[] = array(
                'id' => $result->id,
                'title' => $result->title,
                'content' => $result->content,
                'image' => $image_url,
                'share_url' => URL("/study_destination/$result->id")
            );
        }
        if (!empty($data)) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No Data']);
        }
    }

    public function get_video_list()
    {
        $data = Home::get_video_gallery();
        if (!empty($data)) {
            return response()->json(['status' => 'success', 'data' => $data]);
        } else {
            return response()->json(['status' => 'error', 'message' => 'No Data']);
        }
    }
}
