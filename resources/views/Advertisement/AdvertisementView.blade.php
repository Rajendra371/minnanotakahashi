<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Advertisement Detail</h5>
    </div>
    <div class="row">
      <div class="col-md-4 col-sm-4">
         <label>Menu Page :</label>
         <span>{{$data->menu_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Location :</label>
         <span>{{$data->location_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Content :</label>
         <span>{{$data->content}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Start Date:</label>
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
   
      