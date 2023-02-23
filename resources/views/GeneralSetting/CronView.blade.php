<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h5 class="form_title">Cron Details</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Cron Title:</label>
            <span>{{$data->cron_name}}</span>
         </div>
       <div class="col-md-4 col-sm-4">
          <label>Cron Code :</label>
          <span>{{$data->cron_code}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
        <label>Cron Description:</label>
       <span>{{$data->cron_description}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Cron URL:</label>
        <span>{{$data->cron_url}}</span>
     </div>
     <div class="col-md-4 col-sm-4">
        <label>Order:</label>
        <span>{{$data->order}}</span>
     </div>
     
     <div class="col-md-4 col-sm-4">
        <label>Is Active:</label>
        <span>{{$data->is_active}}</span>
     </div> 
     
       
       @endif
       
    </div>
   
      