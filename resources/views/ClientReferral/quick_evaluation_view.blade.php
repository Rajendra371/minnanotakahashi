@if(!empty($data))
<div class="form-group general_info white-box pad-5">
    <div>
       <h5 class="form_title">Evaluation Details</h5>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>Full Name:</label>
            <span>{{ "$data->first_name $data->last_name"}}</span>
        </div>  
        <div class="col-md-4">
           <label>Email:</label>
           <span>{{$data->email}}</span>
        </div>
        <div class="col-md-2">
            <label>Postcode:</label>
            <span>{{ $data->postcode }}</span>
        </div>
        <div class="col-md-3">
           <label>Service For:</label>
           <span>{{ucfirst($data->care_for)}}</span>
        </div>
       <div class="col-md-6">
            <label>Interested Services:</label>
            <span>
            @php
            $services = '';
            if (!empty($data->interested_services)) {
                $services = DB::table('services')->selectRaw("GROUP_CONCAT(service_name) as services")->whereIn('id', explode(',', $data->interested_services))->value('services');
            }
            echo $services
            @endphp
            </span>
        </div>
        <div class="col-md-3">
            <label>NDIS Registered?</label>
            <span>{{ucfirst($data->ndis_registered)}}</span>
        </div>
        <div class="col-md-3">
             <label>Duration:</label>
             <span>{{$data->duration}}</span>
         </div>
        <div class="col-md-3">
             <label>Support Days:</label>
             <span>{{$data->days}}</span>
         </div>
        <div class="col-md-3">
             <label>Support Hour:</label>
             <span>{{$data->hours}}</span>
         </div>
        <div class="col-md-3">
             <label>Start Period:</label>
             <span>{{$data->start_period}}</span>
         </div>
        <div class="col-md-3">
             <label>Posted Date:</label>
             <span>{{$data->postdatead}}</span>
         </div>
    </div>       
</div>
@endif   
   
      