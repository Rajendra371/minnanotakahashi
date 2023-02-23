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
         <label>Street Address:</label>
         <span>{{$data->address}}</span>
      </div> 
      <div class="col-md-3 col-sm-3">
         <label>Street Address 2:</label>
         <span>{{$data->address2}}</span>
      </div> 
        <div class="col-md-3 col-sm-3">
           <label>City:</label>
           <span>{{$data->city}}</span>
        </div>
        <div class="col-md-3 col-sm-3">
            <label>State/Region/Province:</label>
            <span>{{$data->state}}</span>
         </div>
         <div class="col-md-3 col-sm-3">
            <label>Applying Country:</label>
            <span>{{$data->country}}</span>
         </div>
         <div class="col-md-3 col-sm-3">
            <label>Appointment(Date & Time)</label>
            <span>{{$data->appointmentdate}}</span>
         </div>
         <div class="col-md-3 col-sm-3">
            <label>Time:</label>
            <span>{{$data->postdatead}} {{$data->posttime}}</span>
         </div>
    @endif   
    </div>
   
      