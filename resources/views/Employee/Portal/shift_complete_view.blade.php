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
        <label for="place">Place:</label>
        <span id="place">{{$detail->place}}</span>
    </div>
   
    <div class="col-md-3">
        <label for="remarks">Remarks:</label>
        <span id="remarks">{{$detail->remarks}}</span>
    </div>
</div>

<div class="row">
    <form action="{{route('shift-completed')}}" id="shiftCompleteForm">
        <input type="hidden" name="id" id="id" value="{{$detail->detailid}}">
    <div class="col-lg-12 col-md-12 col-12 form-group">
        <label for="work_details">Progress Note <code>*</code></label>
        <textarea name="work_details" class="form-control" id="work_details" cols="30" rows="5"></textarea>
    </div>
    <div class="col-lg-12 col-md-12 col-12 form-messages"></div>
    <div class="col-lg-6 col-md-6 col-12">
        <div class="form-group button">
            <button type="submit" class="btn btn-primary save">Complete Shift</button>
        </div>
    </div> 
    </form>
</div>
@endif