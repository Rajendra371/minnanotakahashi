<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">University Details</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Title:</label>
            <span>{{$data->title}}</span>
        </div>
       <div class="col-md-4 col-sm-4">
        <label>Image:</label>
        @if (!empty($data->image))
        <span><img src="{{asset('uploads/university/'.$data->image)}}" height="100px" width="100px">'</span>
        @endif
     </div>
     <div class="col-md-12 col-sm-12">
        <label>Short Content:</label>
        <span>{{$data->short_content}}</span>
     </div>
     <div class="col-md-12 col-sm-12">
        <label>Content:</label>
        <span>{!!$data->content!!}</span>
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
   
      