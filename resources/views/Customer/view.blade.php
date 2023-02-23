<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">User Detail</h5>
    </div>
    <div class="row">
        <div class="col-md-3 col-sm-3">
            <label>Name:</label>
            <span>{{$data->fullname}}</span>
        </div>
        <div class="col-md-3 col-sm-3">
           <label>Email:</label>
           <span>{{$data->email}}</span>
        </div>
        <div class="col-md-3 col-sm-3">
           <label>Mobile No.:</label>
           <span>{{$data->mobile_no}}</span>
        </div> 
        <div class="col-md-3 col-sm-3">
           <label>DOB:</label>
           <span>{{$data->dob}}</span>
        </div>
       <div class="col-md-3 col-sm-3">
        <label>Attachment</label>
        @if (!empty($data->attachment))
        @php
            $fileExtension = explode('.',$data->attachment);
            $fileExtension = strtolower($fileExtension[1]);
            $extensions = ["jpg", "png", "gif", "jpeg"];
            if (in_array($fileExtension,$extensions)) {
                $template = "<img src=".asset("uploads/user_attachment/$data->attachment")." height='100px' width='100px'>";
            }else{
                $template =  "<a href=".asset("uploads/user_attachment/$data->attachment")." target='_blank'>$data->attachment</a>";
            }
        @endphp
        <span>{!!$template!!}</span>
        @endif
     </div>
    @endif   
    </div>
   
      