<div class="form-group general_info white-box pad-5">
@if(!empty($data))
<div>
    <h5 class="form_title">Branch Details</h5>
</div>
<div class="row">
    <div class="col-md-4 col-sm-4">
    <label>Branch Name:</label>
    <span>{{$data->branch_name}}</span>
    </div>
    <div class="col-md-4 col-sm-4">
    <label>Branch Address:</label>
    <span>{{$data->branch_address}}</span>
    </div>
    <div class="col-md-4 col-sm-4">
    <label>Branch Location:</label>
    <span>{{$data->branch_location}}</span>
    </div> 
    <div class="col-md-4 col-sm-4">
    <label>Is Main:</label>
    <span>{{$data->is_main}}</span>
    </div> 
    <div class="col-md-4 col-sm-4">
    <label>Is Publish:</label>
    <span>{{$data->is_active}}</span>
    </div> 
@endif
</div>
   
      