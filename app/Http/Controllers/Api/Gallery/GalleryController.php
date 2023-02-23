<?php
namespace App\Http\Controllers\Api\Gallery;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use App\Models\CommonSetting\Gallery;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(Request $request)
    {
         
    }
    public function index()
    {
        $data['gallery_cat_name'] = DB::table('gallery_categories')->where('is_active','Y')->get();
         // echo"<pre>";      
         // print_r($data);
         // die();

        if($data)
        {
            return response()->json(['data'=>$data,'status'=>'success','message'=>'Record Added Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, Post $post) {
        $data = [];
        if ($request->get('image_file')) {
            foreach ($request->get('image_file') as $file) {
                $name = time() . '.' . explode('/', explode(':', substr($file, 0, strpos($file, ';')))[1])[1];
                Gallery::make($file)->save(public_path('images/') . $name);
                array_push($data, $name);
            }
        }
        $image = json_encode($data);
        // create post
        $createdPost = $request->user()->posts()->create([
            'gly_content' => $request->gly_content,
            'image_file' => $image
        ]);
        // echo"<pre>";
        // print_r($createdPost);
        // die();
        // return the response
        return response()->json($post->with('user')->find($createdPost->id));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'groupname'=>'required',
            'locationid'=>'required'
        ]);
       if ($validator->fails()) {
                return response()->json(['status'=>'error','message'=>$validator->errors()->all()]);
        }
        $input = $request->all();
        $id=$request->get('id');
        unset($input['id']);
        $softwareid=auth()->user()->softwareid;
        $createdby=auth()->user()->id;
        $orgid=auth()->user()->orgid;
        if($id)
        {
             $trans=check_permission('Update');
            if($trans=='error')
            {
                permission_message();
                 exit;
            }
        
        $data = UserGroup::where('id', $id)->first();
        $input['updated_at']=datetime();
        $input['updatedip']=get_real_ipaddr();
        $input['updatedmac']=get_Mac_Address();
        $input['updatedby']=$createdby;
        save_log('usergroup','id',$id,$input,'Update');
        if($data->update($input))
        {
            return response()->json(['status'=>'success','message'=>'Record Updated Successfully!!']);
        }
        else
        {
        return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
        }
        }
        else
        {
        $trans=check_permission('Insert');
        if($trans=='error')
        {
            permission_message();
                exit;
        }
        $input['createdip']=get_real_ipaddr();
        $input['createdmac']=get_Mac_Address();
        $input['softwareid']=$softwareid;
        $input['createdby']=$createdby;
        $input['orgid']=$orgid;           
        if($data=UserGroup:: forceCreate($input)){
            return response()->json(['status'=>'success','message'=>'Record Saved Successfully!!']);
          }
           return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function show(Users $users)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
         $trans=check_permission('Update');
            if($trans=='error')
            {
                permission_message();
                exit;
            }

        $id=$request->get('id');
        $data = UserGroup::where('id', $id)->first();
       if($data)
        {
            return response()->json(['status'=>'success','data'=> $data,'message'=>'Record Selected Successfully!!']);
         }
         else
         {
           return response()->json(['status'=>'error','data'=> '','message'=>'Unable to Edit']);
         }

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Users  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
          $trans=check_permission('Delete');
            if($trans=='error')
            {
                permission_message();
                exit;
            }
       
        $id=$request->get('id');
          save_log('usergroup','id',$id,false,'Delete');
        $data=UserGroup::where('id', $id)->delete();
        if($data)
        {
              return response()->json(['status'=>'success','message'=>'Record Deleted Successfully!!']);
         }
         else
         {
            return response()->json(['status'=>'error','message'=>'Operation Unsuccessful !!']);
         }

    }

    public function getTableData(Request $request){
         $trans=check_permission('View');
            if($trans=='error')
            {
                permission_message();
                exit;
            }
            
        $page_size = $request->get('pageSize');
        $page = $request->get('page');
        $sorted = $request->get('sorted');
        $filtered = $request->get('filtered');

        $data = UserGroup::getTableData($page_size, $page, $sorted, $filtered);

        return response()->json($data);
    }
}
