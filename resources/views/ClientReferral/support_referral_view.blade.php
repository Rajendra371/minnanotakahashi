@if(!empty($data))
<div class="form-group general_info white-box pad-5">
    <div>
       <h5 class="form_title">Support Referral Details</h5>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>Full Name:</label>
            <span>{{ $data->full_name}}</span>
        </div>  
        <div class="col-md-4">
           <label>Type:</label>
           <span>{{$data->type}}</span>
        </div>
        <div class="col-md-4">
           <label>Email:</label>
           <span>{{$data->email}}</span>
        </div>
        <div class="col-md-2">
            <label>Contact:</label>
            <span>{{ $data->contact_number }}</span>
        </div>
        <div class="col-md-3">
           <label>Subject:</label>
           <span>{{$data->subject}}</span>
        </div>

        @if ($data->type == 'SDA')
        <div class="col-md-3">
            <label>State:</label>
            <span>
                @php
                    $state_name = '';
                    if(!empty($data->state_id)){
                        $state_name = DB::table('state')->where('id',$data->state_id)->value('name');
                    }
                    echo $state_name;
                @endphp
            </span>
        </div>

        <div class="col-md-3">
            <label>Suburb:</label>
            <span>{{$data->suburb}}</span>
        </div>
        
        @endif

        <div class="col-md-3">
            <label>Message:</label>
            <span>{{$data->message}}</span>
        </div>
        
        <div class="col-md-3">
             <label>Posted Date:</label>
             <span>{{$data->postdatead}}</span>
         </div>
    </div>       
</div>
@endif   
   
      