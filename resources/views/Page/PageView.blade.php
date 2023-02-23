<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Page Details</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Page Menu:</label>
            <span>{{$data->menu_name}}</span>
         </div>
       <div class="col-md-4 col-sm-4">
          <label>Title :</label>
          <span>{{$data->page_title}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
        <label>Image:</label>
        <span><img src="{{asset('uploads/page_image/'.$data->images)}}" height="100px" width="100px">'</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Short Content:</label>
        <span>{{$data->short_content}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Description:</label>
        <span>{{$data->description}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Meta Title:</label>
        <span>{{$data->meta_title}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Meta Keyword:</label>
        <span>{{$data->meta_keyword}}</span>
     </div> 
     <div class="col-md-4 col-sm-4">
        <label>Meta Description:</label>
        <span>{{$data->meta_description}}</span>
     </div> 
     <div class="col-md-4 col-sm-4">
        <label>Is Publish:</label>
        <span>{{$data->is_publish}}</span>
     </div> 
     
       
       @endif
       
    </div>
   
      