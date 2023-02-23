<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">NNE Detail</h5>
    </div>
    <div class="row">
       <div class="col-md-4 col-sm-4">
          <label>NNE Category:</label>
          <span>{{$data->category_name}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
        <label>Title:</label>
        <span>{{$data->title}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Description :</label>
        <span>{{$data->description}}</span>
     </div>
       <div class="col-md-4 col-sm-4">
         <label>Image :</label>
         <span><img src="{{asset('uploads/nne_image/'.$data->image)}}" height="100px" width="100px">'</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Icon :</label>
         <span>{{$data->icon}}</span>
      </div>
   
      <div class="col-md-4 col-sm-4">
         <label>Start Date :</label>
         <span>{{$data->startdate}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>End Date :</label>
         <span>{{$data->enddate}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Order:</label>
         <span>{{$data->order}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Is Publish :</label>
         <span>{{$data->is_publish}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Is Unlimited :</label>
         <span>{{$data->is_unlimited}}</span>
      </div>
       
       @endif
       
    </div>
   
      