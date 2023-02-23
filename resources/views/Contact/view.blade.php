<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Contact Us Detail</h5>
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
           <label>Subject:</label>
           <span>{{$data->subject}}</span>
        </div>
        <div class="col-md-3 col-sm-3">
            <label>Message:</label>
            <span>{{$data->message}}</span>
         </div>
         <div class="col-md-3 col-sm-3">
            <label>Time:</label>
            <span>{{$data->postdatead}} {{$data->posttime}}</span>
         </div>
    @endif   
    </div>
   
      