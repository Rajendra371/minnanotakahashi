<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Useful Link Details</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Title:</label>
            <span>{{$data->title}}</span>
         </div>
       <div class="col-md-4 col-sm-4">
          <label>Designation :</label>
          <span>{{$data->designation}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
        <label>Contact No:</label>
       <span>{{$data->contact}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Email:</label>
        <span>{{$data->email}}</span>
     </div>
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
        <label>Is Active:</label>
        <span>{{$data->isactive}}</span>
     </div> 
     
       
       @endif
       
    </div>
   
      