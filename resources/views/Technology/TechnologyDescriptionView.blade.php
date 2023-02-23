<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Technology Description</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Category Name:</label>
            <span>{{$data->cat_name}}</span>
         </div>
         <div class="col-md-4 col-sm-4">
            <label>Code:</label>
            <span>{{$data->code}}</span>
         </div>
       <div class="col-md-4 col-sm-4">
          <label>Technology Title :</label>
          <span>{{$data->title}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
        <label>Slug :</label>
        <span>{{$data->slug}}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Icon :</label>
            <span>{{$data->icon}}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Icon Type:</label>
            <span>{{$data->icon_type}}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Short Description:</label>
            <span>{{$data->short_description}}</span>
        </div>
       <div class="col-md-4 col-sm-4">
        <label>Content:</label>
        <span>{{$data->description}}</span>
     </div>
       <div class="col-md-4 col-sm-4">
        <label>Image:</label>
        @if(!empty($data->image))
            <span><img src="{{asset('uploads/technology_image/'.$data->image)}}" height="100px" width="100px">'</span>
        @endif
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
     
       
       @endif
       
    </div>
   
      