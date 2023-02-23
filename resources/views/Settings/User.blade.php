<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
        <h5 class="form_title">User Detail</h5>
    </div>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>User Name:</label>
            <span>{{$data->username ?? ''}}</span>
            </div>
        <div class="col-md-4 col-sm-4">
            <label>Email :</label>
            <span>{{$data->email ?? ''}}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>User Group:</label>
            <span>{{$data->groupname ?? ''}}</span>
        </div> 
        <div class="col-md-4 col-sm-4">
            <label>Location:</label> 
            <span>{{$data->locname ?? ''}}</span>
        </div> 
        @endif
    </div>
       
          