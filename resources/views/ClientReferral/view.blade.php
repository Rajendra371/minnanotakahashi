@if(!empty($data))
<div class="form-group general_info white-box pad-5">
    <div>
       <h5 class="form_title">Referral Details</h5>
    </div>
    <div class="row">
        <div class="col-md-3">
            <label>Full Name:</label>
            <span>{{ "$data->first_name $data->middle_name $data->last_name"}}</span>
        </div>
        <div class="col-md-3">
            <label>Age:</label>
            <span>{{ $data->age }}</span>
        </div>
        <div class="col-md-3">
            <label>Identity As:</label>
            <span>{{ stripos($data->identity_name, 'Other (Please specify)') !== false ? "Other ($data->identity_other)" : $data->identity_name }}</span>
        </div>
        <div class="col-md-3">
           <label>Preferred Language:</label>
           <span>{{$data->language}}</span>
        </div> 
        <div class="col-md-3">
           <label>Telephone:</label>
           <span>{{$data->telephone}}</span>
        </div> 
        <div class="col-md-3">
           <label>Mobile:</label>
           <span>{{$data->mobile}}</span>
        </div> 
        <div class="col-md-3">
           <label>Email:</label>
           <span>{{$data->email}}</span>
        </div>
        <div class="col-md-3">
            <label>Contact Method:</label>
            <span>{{ ucfirst($data->contact_method) }}</span>
        </div>
        <div class="col-md-3">
           <label>Current Address:</label>
           <span>{{$data->current_address}}</span>
        </div>
       <div class="col-md-12">
            <label>Guardian/Next of Kin</label>
            <div class="row">
                <div class="col-md-4">
                    <label>Telephone:</label>
                    <span>{{$data->gk_telephone}}</span>
                 </div>
                <div class="col-md-4">
                    <label>Mobile:</label>
                    <span>{{$data->gk_mobile}}</span>
                 </div>
                <div class="col-md-4">
                    <label>Email:</label>
                    <span>{{$data->gk_email}}</span>
                 </div>
            </div>
       </div>
       <div class="col-md-3">
            <label>Service:</label>
            <span>{{$data->service_name ?: 'Other'}}</span>
        </div>
       <div class="col-md-3">
            <label>Plan Management:</label>
            <span>{{$data->plan_management}}</span>
        </div>
        <div class="col-md-3">
            <label>Has NDIS Participant Number?</label>
            <span>{{$data->has_ndis == 'Y' ? 'Yes' : ($data->has_ndis == 'N' ? 'No' : '') }}</span>
        </div>
        <div class="col-md-3">
             <label>Plan Start Date:</label>
             <span>{{$data->start_date}}</span>
         </div>
        <div class="col-md-3">
             <label>Plan End Date:</label>
             <span>{{$data->end_date}}</span>
         </div>
        <div class="col-md-3">
             <label>NDIS approved diagnosis:</label>
             <span>{{$data->ndis_diagnosis}}</span>
         </div>
        <div class="col-md-3">
             <label>Referrer Name:</label>
             <span>{{$data->referrer_name}}</span>
         </div>
        <div class="col-md-3">
             <label>Relationship with client:</label>
             <span>{{$data->relation_with_client}}</span>
         </div>
        <div class="col-md-3">
             <label>Referral Position:</label>
             <span>{{$data->referral_position}}</span>
         </div>
         <div class="col-md-12">
            <label>Organisation</label>
            <div class="row">
                <div class="col-md-4">
                    <label>Telephone:</label>
                    <span>{{$data->org_telephone}}</span>
                 </div>
                 <div class="col-md-4">
                     <label>Email:</label>
                     <span>{{$data->org_email}}</span>
                  </div>
                <div class="col-md-4">
                    <label>Address:</label>
                    <span>{{$data->org_address}}</span>
                 </div>
            </div>
       </div>
       <div class="col-md-3">
            <label>Referral Reason:</label>
            <span>{{$data->referral_reason}}</span>
        </div>
       <div class="col-md-12">
        <label>Plan Attachment</label>
        @if (!empty($data->plan_attachment))
        @php
            $fileExtension = explode('.',$data->plan_attachment);
            $fileExtension = strtolower($fileExtension[1]);
            $extensions = ["jpg", "png", "gif", "jpeg"];
            if (in_array($fileExtension,$extensions)) {
                $template = "<img src=".asset("uploads/client_referrals/$data->plan_attachment")." height='100px' width='100px'>";
            }else{
                $template =  "<a href=".asset("uploads/client_referrals/$data->plan_attachment")." target='_blank'>$data->plan_attachment</a>";
            }
        @endphp
        <span>{!!$template!!}</span>
        @endif
     </div>
    </div>
    @endif   
   
      