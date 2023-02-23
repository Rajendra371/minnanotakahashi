@if (!empty($detail))   
<div class="row">

    <div class="col-md-3">
        <label for="date">Shift Date:</label>
        <span id="date">{{$detail->startdatead}}</span>
    </div>
    
    <div class="col-md-3">
        <label for="day">Shift Day:</label>
        <span id="day">{{ date('l', strtotime($detail->startdatead)) }}</span>
    </div>
    
    <div class="col-md-3">
        <label for="start_time">Start Time:</label>
        <span id="start_time">{{$detail->start_time}}</span>
    </div>

    <div class="col-md-3">
        <label for="end_time">End Time:</label>
        <span id="end_time">{{$detail->end_time}}</span>
    </div>

</div>
<div class="row">
    <div class="col-md-3">
        <label for="total_hrs">Total Hour:</label>
        <span id="total_hrs">{{$detail->total_hrs}}</span>
    </div>
   
    <div class="col-md-3">
        <label for="place">Place:</label>
        <span id="place">{{$detail->place}}</span>
    </div>
   
    <div class="col-md-3">
        <label for="remarks">Remarks:</label>
        <span id="remarks">{{$detail->remarks}}</span>
    </div>
    
    <div class="col-md-12">
        <label for="work_details">Progress Note:</label>
        <span id="work_details">{{$detail->work_details}}</span>
    </div>
</div>
@endif