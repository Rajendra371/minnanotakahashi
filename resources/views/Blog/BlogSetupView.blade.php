<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Blog Details</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Category Name:</label>
            <span>{{$data->cat_name}}</span>
         </div>
       <div class="col-md-4 col-sm-4">
          <label>Blog Title :</label>
          <span>{{$data->blog_title}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
        <label>Content:</label>
        <span>{{$data->content}}</span>
     </div>
       <div class="col-md-4 col-sm-4">
        <label>Image:</label>
        <span><img src="{{asset('uploads/blog_image/'.$data->image)}}" height="100px" width="100px">'</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Icon Name:</label>
        <span>{{$data->icon}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
      <label>Author Name:</label>
      <span>{{$data->author}}</span>
      </div>
     <div class="col-md-4 col-sm-4">
        <label>SEO Title:</label>
        <span>{{$data->seo_title}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>SEO Keyword:</label>
        <span>{{$data->seo_keyword}}</span>
     </div> 
     <div class="col-md-4 col-sm-4">
        <label>SEO Description:</label>
        <span>{{$data->seo_description}}</span>
     </div> 
     <div class="col-md-4 col-sm-4">
        <label>Order:</label>
        <span>{{$data->order}}</span>
     </div> 
     <div class="col-md-4 col-sm-4">
        <label>Is Publish:</label>
        <span>{{$data->is_publish}}</span>
     </div> 
     <div class="col-md-4 col-sm-4">
      <label>Is Popular:</label>
      <span>{{$data->is_popular}}</span>
   </div> 
       
       @endif
       
    </div>
   
      