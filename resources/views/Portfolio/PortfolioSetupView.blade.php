<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Portfolio Details</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Category Name:</label>
            <span>{{$data->category_name}}</span>
         </div>
       <div class="col-md-4 col-sm-4">
          <label>Name :</label>
          <span>{{$data->name}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
        <label>Image:</label>
        <span><img src="{{asset('uploads/portfolio_image/'.$data->image)}}" height="100px" width="100px">'</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Content:</label>
        <span>{{$data->content}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Website:</label>
        <span>{{$data->website}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Start Date:</label>
        <span>{{$data->startdate}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>End Date:</label>
        <span>{{$data->enddate}}</span>
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
        <label>Order:</label>
        <span>{{$data->order}}</span>
     </div> 
     <div class="col-md-4 col-sm-4">
        <label>Is Publish:</label>
        <span>{{$data->is_publish}}</span>
     </div> 
     
       
       @endif
       
    </div>
   
      