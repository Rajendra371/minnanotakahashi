<div class="form-group general_info white-box pad-5">
@if(!empty($vdata))
<div>
    <h5 class="form_title">UserGroup Detail</h5>
</div>
<div class="row">
    <div class="col-md-4 col-sm-4">
        <label>Group Code:</label>
        <span>{{$vdata->groupcode}}</span>
        </div>
    <div class="col-md-4 col-sm-4">
        <label>Group Name :</label>
        <span>{{$vdata->groupname}}</span>
    </div>
    <div class="col-md-4 col-sm-4">
        <label>Remarks:</label>
        <span>{{$vdata->remarks}}</span>
    </div> 
    <div class="col-md-4 col-sm-4">
        <label>Post Date:</label> 
        <span>{{$vdata->created_at}}</span>
    </div> 
    @endif
</div>
   
      