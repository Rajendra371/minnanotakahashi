<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Frontend Tiles</h5>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <label>Title:</label>
            <span>{{$data->title}}</span>
        </div>
       <div class="col-md-3 col-sm-3">
        <label>Image:</label>
        @if (!empty($data->image))
        <span><img src="{{asset('uploads/frontend_tiles/'.$data->image)}}" height="100px" width="100px">'</span>
        @endif
     </div>
     <div class="col-md-3 col-sm-3">
        <label>Icon:</label>
        <span>{{$data->icon}}</span>
     </div>
     <div class="col-md-3 col-sm-3">
        <label>Order:</label>
        <span>{{$data->order}}</span>
     </div> 
     <div class="col-md-12 col-sm-12">
        <label>Content:</label>
        <span>{{$data->content}}</span>
     </div>
     <div class="col-md-3 col-sm-3">
        <label>Is Publish:</label>
        <span>{{$data->is_publish}}</span>
     </div> 
     <div class="col-md-3 col-sm-3">
        <label>For Header:</label>
        <span>{{$data->for_header}}</span>
     </div> 
     <div class="col-md-3 col-sm-3">
        <label>For Body:</label>
        <span>{{$data->for_body}}</span>
     </div> 
     <div class="col-md-3 col-sm-3">
        <label>For Footer:</label>
        <span>{{$data->for_footer}}</span>
     </div> 
    @endif   
    </div>
   
      