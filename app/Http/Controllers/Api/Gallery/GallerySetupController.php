<?php

namespace App\Http\Controllers\Api\Gallery;

use Illuminate\Http\Request;
use App\Models\Banner\Banner;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Gallery\GallerySetup;
use Illuminate\Support\Facades\File;
use App\Models\Gallery\GalleryCategory;
use App\Models\Gallery\VideoGallerySetup;
use Illuminate\Support\Facades\Validator;
use Image;


class GallerySetupController extends Controller
{
    public function index()
    {
        $data['gallery_cat_name'] = DB::table('gallery_categories')->where('is_active', 'Y')->get();
        if ($data) {
            return response()->json(['data' => $data, 'status' => 'success', 'message' => 'Record Added Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function gallery_setup_form($html = false)
    {
        $data['categories'] = DB::table('gallery_categories')->where('is_active', 'Y')->get();
        $template = view('Gallery.gallery_setup_form', $data)->render();
        if ($html) {
            return $template;
        }
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template]);
        }
        return response()->json(['status' => 'error', 'message' => 'Error getting form.']);
    }

    public function store_video_gallery(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'link' => 'required',
            'image' => 'nullable|file|mimes:jpeg,png,gif,jpg|max:5120'
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
        }
        $postby = auth()->user()->id;
        $postdatead = CURDATE_EN;
        $postdatebs = EngToNepDateConv(CURDATE_EN);
        $postip = get_real_ipaddr();
        $postmac = get_Mac_Address();
        $input = $request->except('is_display', 'id', 'image', 'is_home_display');
        $id = $request->id;
        $input['is_display'] = $request->is_display ?? 'N';
        $input['is_home_display'] = $request->is_home_display ?? 'N';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            // 560*450
            $source = $image->getRealPath();
            $image_name = time() . rand() . '.' . $image->getClientOriginalExtension();
            $destination = public_path("uploads/video_gallery/$image_name");
            $image->move('uploads/video_gallery', $image_name);
            $input['image_url'] = $image_name;
        }

        if ($id) {
            $trans = check_permission('Update');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $data = VideoGallerySetup::where('id', $id)->first();
            if (!empty($input['image_url'])) {
                if (!empty($data->image_url) && File::exists('uploads/video_gallery/' . $data->image_url)) {
                    unlink('uploads/video_gallery/' . $data->image_url);
                }
            }
            $input['updated_at'] = datetime();
            $input['modifyip'] = $postip;
            $input['modifymac'] = $postmac;
            $input['modifyby'] = $postby;
            $input['modifydatead'] = $postdatead;
            $input['modifydatebs'] = $postdatead;
            $input['modifytime'] = date('H:i:s');
            save_log('video_galleries', 'id', $id, $input, 'Update');
            if ($data->update($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!!']);
            }
        } else {
            $trans = check_permission('Insert');
            if ($trans == 'error') {
                permission_message();
                exit;
            }
            $input['postip'] = $postip;
            $input['postmac'] = $postmac;
            $input['postdatead'] = $postdatead;
            $input['postdatebs'] = $postdatebs;
            $input['posttime'] = date('H:i:s');
            $input['postby'] = $postby;
            if (VideoGallerySetup::forceCreate($input)) {
                return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!']);
            }
        }
        return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
    }

    public function edit_video_gallery(Request $request)
    {
        $data = VideoGallerySetup::where('id', $request->id)->first();
        if ($data) {
            return response()->json(['status' => 'success', 'data' => $data, 'message' => 'Data Fetched Successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Fetching Data']);
        }
    }
    public function delete_video_gallery(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        $data = VideoGallerySetup::where('id', $request->id)->delete();
        if ($data) {
            return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Error Deleting Record']);
        }
    }

    public function video_gallery_list()
    {
        $data = VideoGallerySetup::get_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $i => $row) {
            $image = "";
            if (!empty($row->image_url) && File::exists('uploads/video_gallery/' . $row->image_url)) {
                $image = "<img src='" . asset('uploads/video_gallery/' . $row->image_url) . "' height='100px' width='100px'>";
            }
            $array[$i]['id'] = $row->id;
            $array[$i]['title'] = $row->title;
            $array[$i]['image_url'] = $image;
            // $array[$i]['content'] = str_limit($row->content, 50, '...');
            $array[$i]['link'] = $row->link;
            $array[$i]['homepage_video_link'] = $row->homepage_video_link;
            $array[$i]['order'] = $row->order;
            $array[$i]['is_display'] = $row->is_display;
            $array[$i]['is_home_display'] = $row->is_home_display;
            $array[$i]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/video_gallery/edit" data-id=' . $row->id . ' data-targetForm="videoGalleryForm"><i class="fa fa-edit"></i></a>
            &nbsp
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/video_gallery/delete" data-id=' . $row->id . ' data-targetForm="videoGalleryForm" data-edittype="template"><i class="fa fa-trash"></i></a>
            ';
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function store(Request $request)
    {
        try {
            $id = $request->id;

            if ($id) {
                $trans = check_permission('Update');
                if ($trans == 'error') {
                    permission_message();
                    exit;
                }
            } else {
                $trans = check_permission('Insert');
                if ($trans == 'error') {
                    permission_message();
                    exit;
                }
            }

            $validator = Validator::make($request->all(), [
                'gly_catid' => 'required',
                'gly_title' => 'required',
                'gly_content' => 'required',
                'images' => 'required|array',
                'images.*' => 'required',
            ]);
            if ($validator->fails()) {
                return response()->json(['status' => 'error', 'message' => $validator->errors()->all()]);
            }
            $postby = auth()->user()->id;
            $postdatead = CURDATE_EN;
            $postdatebs = EngToNepDateConv(CURDATE_EN);
            $postip = get_real_ipaddr();
            $postmac = get_Mac_Address();

            $category_id = $request->gly_catid;
            $title = $request->gly_title;
            $content = $request->gly_content;
            $order = $request->order;
            $is_display = $request->is_display ?? 'N';
            // echo "hi";
            // echo $is_display;
            // die();
            $images = $request->images;

            DB::beginTransaction();

            $masterData['gallery_category_id'] = $category_id;
            $masterData['is_display'] = $is_display;
            $masterData['title'] = $title;
            $masterData['content'] = $content;
            $masterData['order'] = $order;

            if ($id) {
                $master = DB::table('gallery_master')->where('id', $id)->first();
                if (empty($master)) {
                    return response()->json(['status' => 'error', 'message' => 'Record Not Found!!']);
                }
                $masterData['modifyip'] = $postip;
                $masterData['modifymac'] = $postmac;
                $masterData['modifydatead'] = $postdatead;
                $masterData['modifydatebs'] = $postdatebs;
                $masterData['modifytime'] = date('H:i:s');
                $masterData['modifyby'] = $postby;
                DB::table('gallery_master')->where('id', $id)->update($masterData);
                $old_images = GallerySetup::where('master_id', $id)->pluck('image_file')->toArray();
                $new_images = array_diff($images, $old_images);

                $details = [];
                $i = 1;
                if(!empty($new_images)){
                foreach ($new_images as $key => $image) {
                    if (!empty($image) && file_exists(public_path("tmp/uploads/$image"))) {
                        rename(public_path("tmp/uploads/$image"), public_path('uploads/gallery_image/' . $image));
                        $copy = Image::make(public_path('uploads/gallery_image/' . $image));
                        $copy->resize(null, 600, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        $size = $copy->filesize();
                        if ($size) {
                            $size_in_mb = floor($size * 0.000001);
                        }
                        if ($size_in_mb > 1) {
                            $copy->save(public_path('uploads/gallery_image/' . $image), 50);
                        } else {
                            $copy->save(public_path('uploads/gallery_image/' . $image), 60);
                        }
                    } else {
                        continue;
                    }

                    $details[] = array(
                        'master_id' => $id,
                        'image_file' => $image,
                        'gly_catid' => $category_id,
                        'gly_title' => $title,
                        'gly_content' => $content,
                        'is_display' => $is_display,
                        'order' => $i,
                        'postip' => $postip,
                        'postmac' => $postmac,
                        'postdatead' => $postdatead,
                        'postdatebs' => $postdatebs,
                        'posttime' => date('H:i:s'),
                        'postby' => $postby,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    );
                    $i++;
                }
                // dd($details);
                if (!empty($details)) {
                    DB::table('galleries')->insert($details);
                }
                }
                else{
                        $details['gly_title'] = $title;
                        $details['gly_content'] = $content;
                        $details['is_display'] = $is_display;
                        $details['postip'] = $postip;
                        $details['postmac'] = $postmac;
                        $details['postdatead'] = $postdatead;
                        $details['postdatebs'] = $postdatebs;
                        $details['posttime'] = date('H:i:s');
                        $details['postby'] = $postby;
                        $details['created_at'] = date('Y-m-d H:i:s');
                        $details['updated_at'] = date('Y-m-d H:i:s');
                    
                    if (!empty($details)) {
                        DB::table('galleries')->where('master_id',$id)->update($details);
                    }
                }
                DB::table('gallery_master')->where('id', $id)->update(['image_count' => count($images)]);
                GalleryCategory::where('id', $category_id)->update(['updated_at' => date('Y-m-d H:i:s')]);
                DB::commit();
                $template = $this->gallery_setup_form(true);
                return response()->json(['status' => 'success', 'message' => 'Record Updated Successfully!!', 'template' => $template]);
            } else {

                $masterData['postip'] = $postip;
                $masterData['postmac'] = $postmac;
                $masterData['postdatead'] = $postdatead;
                $masterData['postdatebs'] = $postdatebs;
                $masterData['posttime'] = date('H:i:s');
                $masterData['postby'] = $postby;

                $master_id = DB::table('gallery_master')->insertGetId($masterData);

                $details = [];
                foreach ($images as $key => $image) {
                    if (!empty($image) && file_exists(public_path("tmp/uploads/$image"))) {
                        rename(public_path("tmp/uploads/$image"), public_path('uploads/gallery_image/' . $image));
                        $copy = Image::make(public_path('uploads/gallery_image/' . $image));
                        $copy->resize(null, 600, function ($constraint) {
                            $constraint->aspectRatio();
                        });
                        $size = $copy->filesize();
                        if ($size) {
                            $size_in_mb = floor($size * 0.000001);
                        }
                        if ($size_in_mb > 1) {
                            $copy->save(public_path('uploads/gallery_image/' . $image), 50);
                        } else {
                            $copy->save(public_path('uploads/gallery_image/' . $image), 60);
                        }
                    } else {
                        continue;
                    }

                    $details[] = array(
                        'master_id' => $master_id,
                        'image_file' => $image,
                        'gly_catid' => $category_id,
                        'gly_title' => $title,
                        'order' => $key + 1,
                        'gly_content' => $content,
                        'is_display' => $is_display,
                        'postip' => $postip,
                        'postmac' => $postmac,
                        'postdatead' => $postdatead,
                        'postdatebs' => $postdatebs,
                        'posttime' => date('H:i:s'),
                        'postby' => $postby,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s'),
                    );
                }
                if (!empty($details)) {
                    DB::table('galleries')->insert($details);
                    DB::table('gallery_master')->where('id', $master_id)->update(['image_count' => count($details)]);
                    GalleryCategory::where('id', $category_id)->update(['updated_at' => date('Y-m-d H:i:s')]);
                    DB::commit();
                    $template = $this->gallery_setup_form(true);
                    return response()->json(['status' => 'success', 'message' => 'Record Saved Successfully!!', 'template' => $template]);
                }
            }
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => 'Cannot create record!!']);
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['status' => 'error', 'message' => $th->getMessage()]);
        }
    }


    public function gallery_list()
    {
        $data = GallerySetup::get_gallery_list();
        $filtereddata = ($data["totalfilteredrecs"] > 0 ? $data["totalfilteredrecs"] : $data["totalrecs"]);
        $totalrecs = $data["totalrecs"];
        unset($data["totalfilteredrecs"]);
        unset($data["totalrecs"]);

        $array = array();
        foreach ($data as $key => $row) {
            $array[$key]['id'] = $row->id;
            $array[$key]['title'] = $row->title;
            $array[$key]['content'] = $row->content;
            $array[$key]['category'] = $row->category_title;
            $array[$key]['image_count'] = $row->image_count;
            $array[$key]['posted_date'] = $row->postdatebs;
            $array[$key]['is_display'] = $row->is_display;

            $array[$key]['action'] = '<a href="javascript:void(0)" class="btnEdit" data-url="/api/gallery_setup/edit" data-id=' . $row->id . ' data-targetForm="gallerySetupFormDiv" data-edittype="template"><i class="fa fa-edit"></i></a> 
            &nbsp 
            <a href="javascript:void(0)" class="view" data-url="/api/gallery_setup/view" data-id=' . $row->id . '><i class="fa fa-eye"></i></a>
            &nbsp
            <a href="javascript:void(0)" class="btnDelete" data-url="/api/gallery_setup/delete" data-id=' . $row->id . '><i class="fa fa-trash"></i></a>
            ';
        }
        return response()->json(["recordsFiltered" => $filtereddata, "recordsTotal" => $totalrecs, 'data' => $array]);
    }

    public function gallery_view(Request $request)
    {
        $master_id = $request->id;
        $master = DB::table('gallery_master as gm')->leftJoin('gallery_categories as gc', 'gc.id', '=', 'gm.gallery_category_id')->select('gm.id', 'gm.title', 'gm.content', 'gm.is_display', 'gc.title as category_title', 'gm.postdatebs')->where('gm.id', $master_id)->first();
        if (empty($master)) {
            return response()->json(['status' => 'error', 'message' => 'Record Not Found']);
        }
        $details = DB::table('galleries as g')->where('master_id', $master_id)->get(['id', 'image_file']);
        $template = view('Gallery.gallery_view', compact('master', 'details'))->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template, 'message' => 'Record Selected Successfully!!']);
        } else {
            return response()->json(['status' => 'error', 'message' => 'Data not found']);
        }
    }

    public function gallery_edit(Request $request)
    {
        $id = $request->id;
        $categories = DB::table('gallery_categories')->where('is_active', 'Y')->get();

        $master = DB::table('gallery_master as gm')->leftJoin('gallery_categories as gc', 'gc.id', '=', 'gm.gallery_category_id', 'gm.is_display', 'gm.order')->select('gm.id', 'gm.gallery_category_id', 'gm.title', 'gm.content', 'gm.is_display', 'gc.title as category_title', 'gm.postdatebs')->where('gm.id', $id)->first();

        if (empty($master)) {
            return response()->json(['status' => 'error', 'message' => 'Record Not Found']);
        }
        $details = DB::table('galleries as g')->where('master_id', $id)->get(['id', 'image_file']);

        $template = view('Gallery.gallery_edit', compact('categories', 'master', 'details'))->render();
        if ($template) {
            return response()->json(['status' => 'success', 'template' => $template]);
        }
        return response()->json(['status' => 'error', 'message' => 'Error getting form.']);
    }

    public function delete_single_image(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }

        $id = $request->id;
        $master_id = $request->master_id;
        $data = GallerySetup::where('id', $id)->where('master_id', $master_id)->first();
        if ($data) {
            if ($data->image_file && File::exists(public_path('uploads/gallery_image/' . $data->image_file))) {
                unlink(public_path('uploads/gallery_image/' . $data->image_file));
            }
            save_log('galleries', 'id', $id, false, 'Delete');
            if ($data->delete()) {
                DB::table('gallery_master')->where('id', $master_id)->decrement('image_count', 1);
                return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }


    public function gallery_delete(Request $request)
    {
        $trans = check_permission('Delete');
        if ($trans == 'error') {
            permission_message();
            exit;
        }
        try {
            $id = $request->id;
            $master = DB::table('gallery_master')->where('id', $id)->first();
            if (empty($master)) {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
            $details = GallerySetup::where('master_id', $id)->get();
            if (!empty($details)) {
                foreach ($details as $key => $data) {
                    if ($data->image_file && File::exists(public_path('uploads/gallery_image/' . $data->image_file))) {
                        unlink(public_path('uploads/gallery_image/' . $data->image_file));
                    }
                }
            }
            $delete = DB::table('gallery_master')->where('id', $id)->delete();
            DB::table('galleries')->where('master_id', $id)->delete();
            if ($delete) {
                return response()->json(['status' => 'success', 'message' => 'Record Deleted !!']);
            }
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }

    public function upload_image(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'file' => 'required|file|mimes:png,jpg,jpeg,gif|max:5240',
        ]);

        if ($validation->fails()) {
            return response()->json(['success' => false, 'message' => $validation->errors()->all()], 422);
        }

        $path = public_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = generate_random_string(20) . '.' . $file->getClientOriginalExtension();

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }

    public function delete_temp_files(Request $request)
    {
        foreach ($request->temp_files as $file) {
            if (!empty($file) && file_exists(public_path('tmp/uploads/' . $file))) {
                unlink(public_path('tmp/uploads/' . $file));
            }
        }
        return response()->json(['status' => 'success']);
    }

    public function delete_uploaded_file(Request $request)
    {
        $id = $request->id;
        $master_id = $request->master_id;
        $data = GallerySetup::where('id', $id)->where('master_id', $master_id)->first();
        if ($data) {
            if ($data->image_file && File::exists(public_path('uploads/gallery_image/' . $data->image_file))) {
                unlink(public_path('uploads/gallery_image/' . $data->image_file));
            }
            if ($data->delete()) {
                DB::table('gallery_master')->where('id', $master_id)->decrement('image_count', 1);
                return response()->json(['status' => 'success', 'message' => 'Record Deleted Successfully!!']);
            } else {
                return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
            }
        } else {
            return response()->json(['status' => 'error', 'message' => 'Operation Unsuccessful !!']);
        }
    }


    public function compress_gallery_images()
    {
        ini_set('max_execution_time', 300);
        $path = public_path('uploads/gallery_image');
        $files = File::allFiles($path);
        if (!empty($files)) {
            foreach ($files as $key => $file) {
                $filePath = $file->getRealPath();
                $fileExtension = $file->getExtension();
                if (in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif'])) {
                    $image = Image::make($filePath);
                    $height = $image->height();
                    if ($height > 1000) {
                        $image->resize(null, 600, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($filePath);
                    }
                    $size = $image->filesize();
                    if ($size) {
                        $size_in_mb = floor($size * 0.000001);
                    }
                    if ($size_in_mb > 1) {
                        $image->save($filePath, 50);
                    }
                }
            }
        }
    }
}