<div class="form-group general_info white-box pad-5">
   @if(!empty($data))
   <div>
       <h5 class="form_title">Team/Testimonial Details</h5>
   </div>
   <div class="row">
      <div class="col-md-4 col-sm-4">
            <label>Name:</label>
            <span>{{$data->name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
          <label>Designation :</label>
          <span>{{$data->designation}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Contact:</label>
         <span>{{$data->contactno}}</span>
      </div> 
      <div class="col-md-4 col-sm-4">
         <label>Email:</label>
         <span>{{$data->email}}</span>
      </div> 
      <div class="col-md-4 col-sm-4">
         <label>Address:</label>
         <span>{{$data->address}}</span>
      </div>
   </div>
   <div class="row"> 
      <div class="col-md-6 col-sm-6">
         <label>Testimonial/About:</label>
         <span>{!!$data->description!!}</span>
      </div> 
      <div class="col-md-6 col-sm-6">
         <label>Experience:</label>
         <span>{!!$data->experience!!}</span>
      </div> 
      <div class="col-md-6 col-sm-6">
         <label>Skills:</label>
         <span>{!!$data->skills!!}</span>
      </div> 
      <div class="col-md-6 col-sm-6">
         <label>Image:</label>
         <span>
            <p>
            @if (!empty($data->image) && file_exists(public_path('uploads/testimonial_image/'.$data->image)))
            <img src="{{asset('uploads/testimonial_image/'.$data->image)}}" height="150" width="150px">
            @endif
            </p>
         </span>
      </div>
   </div>
   <div class="row"> 
     <div class="col-md-4 col-sm-4">
        <label>Facebook Link:</label>
        <span>{{$data->facebook_link}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Twitter Link:</label>
        <span>{{$data->twitter_link}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Linkedin Link:</label>
        <span>{{$data->linkedin_link}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Youtube Link:</label>
        <span>{{$data->youtube_link}}</span>
     </div> 
     <div class="col-md-4 col-sm-4">
        <label>Instagram Link:</label>
        <span>{{$data->instagram_link}}</span>
     </div> 
     <div class="col-md-4 col-sm-4">
        <label>Order:</label>
        <span>{{$data->order}}</span>
     </div> 
     <div class="col-md-4 col-sm-4">
        <label>Is Publish:</label>
        <span>{{$data->isactive}}</span>
     </div> 
   @endif
</div>
   
      