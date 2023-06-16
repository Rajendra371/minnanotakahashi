<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Appointment Detail</h5>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <label>Name:</label>
            <span>{{$data->full_name}}</span>
        </div>
        <div class="col-md-3 col-sm-3">
           <label>Email:</label>
           <span>{{$data->email}}</span>
        </div>
        <div class="col-md-3 col-sm-3">
           <label>Mobile No.:</label>
           <span>{{$data->contact_number}}</span>
        </div> 
        <div class="col-md-3 col-sm-3">
         <label>Address:</label>
         <span>{{$data->address}}</span>
      </div> 
      <div class="col-md-3 col-sm-3">
         <label>Country:</label>
         <span>{{$data->country}}</span>
      </div> 
        <div class="col-md-3 col-sm-3">
           <label>Level:</label>
           <span>{{$data->level}}</span>
        </div>
        <div class="col-md-3 col-sm-3">
            <label>Nearest Branch:</label>
            <span>{{$data->nearest_branch}}</span>
         </div>
         <div class="col-md-3 col-sm-3">
            <label>Appointment(Date & Time)</label>
            <span>{{$data->appointmentdate}}</span>
         </div>
         <div class="col-md-12 col-sm-12">
            <label>Message</label>
            <span>{{$data->message}}</span>
         </div>
         <div class="col-md-12 col-sm-12">
            <label>Submmission Time:</label>
            <span>{{$data->postdatead}} {{$data->posttime}}</span>
         </div>
    @endif   
    </div>
   
      