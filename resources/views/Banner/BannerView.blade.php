<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Banner Detail</h5>
    </div>
    <div class="row">
       <div class="col-md-4 col-sm-4">
          <label>Banner Heading :</label>
          <span>{{$data->heading}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
         <label>Banner Image :</label>
         <span><img src="{{asset('uploads/banner_image/'.$data->banner_img)}}" height="100px" width="100px">'</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Banner Content :</label>
         <span>{{$data->content}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Button 1 Text :</label>
         <span>{{$data->button_text1}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Button 1 URL :</label>
         <span>{{$data->button_url1}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Button 2 Text :</label>
         <span>{{$data->button_text2}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Button 2 URL :</label>
         <span>{{$data->button_url1}}</span>
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
   
      