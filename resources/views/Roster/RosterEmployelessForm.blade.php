<?php
    // dd($shift_data);
?>
<div class="white-box pad-5 mtop_10 pdf-wrapper">
    <div class="clearfix"></div>
    <form id="monthly_SalaryGenerator" name="" action="/api/save_employeeless_roster">
    <div class="row">
        <div class="col-sm-12 mb-2">
            <div class="row">
                @if($operation != "insert" )
                    <div class = "col-sm-12">
                        <label>Generation Type: </label>
                        <span>Employeless</span>
                        {{-- <input type = "text" class = "form-control" value = '{{$gen_type_name}}' disabled> --}}
                    </div>
                @endif
                <div class="col-sm-3">
                    <label>Refno:</label>
                    <input type="text" class="form-control" name="refno" value="{{$refno}}" readonly>
                    <input type = "hidden" name = "designationid" value = {{($designation_data->id) ?? ''}}> 
                    <input type = "hidden" name = "gen_type" value = "E">
                    <input type = "hidden" name=  "shift_masterid" value = {{$shift_masterid  ?? ''}}>
                </div>
                @if(!empty($designation_data))
                    <div class = "col-sm-3">
                        <label>Designation:</label>
                        <input class = "form-control" type = 'text' 
                         value = '{{$designation_data->name ?? ""}}' disabled >
                    </div>
                @endif
            </div>
        </div>
        <div class="col-sm-12 mt-4">
            <div class = "row">
                <div class = "col-sm-6 mb-2">
                    <label>Start Date</label>
                    <input class = "datepicker form-control" type = "text" name = "startdate" readonly value =  {{$operation == "insert"?CURDATE_EN:$shift_data->startdatead}} id='startdate'>
                </div>
                    <div class = "col-sm-6 mb-2">
                        <label>Start Time</label>
                        <input type="time" class="time_field form-control required_field" id="starttime" name="starttime" {{$operation == "view"? "readonly":''}} value = {{$shift_data->start_time ?? ''}}>
                    </div>
                <div class = "col-sm-6 mb-2">
                    <label>End Date</label>
                    <input class = "datepicker form-control" type = "text" name = "enddate" readonly value =  {{$operation == "insert"?CURDATE_EN:$shift_data->enddatead}} id='enddate'>
                </div>
                <div class = "col-sm-6 mb-2">
                    <label>End Time</label>
                    <input type = "time" class = "time_field form-control required_field" id = "endtime" name= "endtime" {{$operation == "view"?"readonly":''}} value = {{$shift_data->end_time ?? ''}}>
                </div>
                <div class = "col-sm-6 mb-2">
                    <label>Total Hours</label>
                    <input type = "text" class = "form-control required_field" name = "total_hrs" id = "totalhrs" value = "{{$shift_data->total_hrs ?? ''}}" readonly>
                </div>
                {{-- <div class = "col-sm-6 mb-2">
                    <label>Total Quota</label>
                    <input type = "text" class = "form-control required_field" name = "quota" {{$operation == "view"?"readonly":''}} value = {{$shift_data->quota ?? ''}}>
                </div> --}}
                <div class = "col-sm-6 mb-2">
                    <label>Place</label>
                    <input type = "text" class = "form-control required_field" name = "place" {{$operation == "view"?"readonly":''}} value = "{{$shift_data->place ?? ''}}" >
                </div>
            </div>

        </div>
        <div class="col-sm-4">
            <label>Remarks</label>
            <textarea name="shift_remarks" class="form-control" cols="3" rows="2" {{$operation == "view"?"readonly":''}}>{{$shift_data->remarks ?? ''}}</textarea>
        </div>
        <div class="col-sm-9">
        </div>
        <div class="clear-fix"></div>
        @if($operation != "view")
            <div class="col-sm-6">
                <button type="submit" class="btn btn-sm btn-success save">Save & Close</button>
            </div>
        @endif
    </div>
</div>
<div class="col-sm-2"></div>

</div>
</form>
</div>

<script>

$(document).off('change','.time_field');
$(document).on('change','.time_field', function(e){
    // let id = $(this).data('id');
    // console.log(id); 
    // let length = $('.schedule').length;
    let start_time = $('#starttime').val();
    let end_time = $('#endtime').val();
    let start_date = $('#startdate').val();
    let end_date = $('#enddate').val();
    // let start = start_date + ' ' + start_time;
    // let end = end_date + ' ' + end_time;
    // console.log(start, end);
    let url = constvar.api_url + "roster/get_total_hours";
    let postdata = {start_time: start_time, end_time: end_time, start_date: start_date, end_date: end_date};
    axios
        .post(url, postdata,{ hide_loader: "Y" })
        .then((res) =>{
            if(res.data.status == "success"){
                $('#totalhrs').val(res.data.time);
            }
            else{
                console.log('fail');
            }
        });
});

$(document).off('click','.btnAddmore');
$(document).on('click','.btnAddmore',function(e){
    var  length=$('.schedule').length;
    var lplusone=length+1;
    // if()
    var scheduletemplate=
    '<tr class="schedule" id="schedule_'+lplusone+'"><td>'+lplusone+'.</td><td><input type="text" class="form-control datepicker required_field" name="startdate[]" data-id="'+lplusone+'"  value="{{CURDATE_EN}}" readonly ></td><td><input type="time" class="form-control required_field" name="starttime[]"  data-id="'+lplusone+'"></td><td><input type="text" class="form-control datepicker required_field" name="enddate[]" data-id="'+lplusone+'"  value="{{CURDATE_EN}}" readonly ></td><td><input type="time" class="form-control required_field" name="endtime[]" data-id="'+lplusone+'"></td><td><input type="text" class="form-control" name="totalhrs[]" data-id="'+lplusone+'" ></td><td><input type="text" class="form-control required_field " name="place[]" data-id="'+lplusone+'"></td><td> <input type="text" class="form-control " name="remarks[]"  data-id="'+lplusone+'"></td><td><input type = "text" class = "form-control" name = "quota[]" data-id="'+lplusone+'"></td><td><a href="javascript:void(0)" class="btn btn-sm btn-danger btnremove" data-id="'+lplusone+'" id="removebtn_'+lplusone+'"><i class="fa fa-trash" aria-hidden="true" Title="Remove"></i></a></td></tr>';
    $('#tbodySchedule').append(scheduletemplate);
    $(this).attr('data-id',length);        
    load_datepicker('N');
    
});

$(document).off('change','#startdate');
$(document).on('change','#startdate', function(e){
    let start_date = $(this).val();
    let startFrom = new Date(start_date)            
    // console.log({id,start_date,startFrom});
    $('#enddate').datepicker('destroy')
    $('#enddate').datepicker({
        format: 'yyyy/mm/dd',
        autoclose: true, 
        startDate : startFrom,
        setDate : startFrom  
    })
    $('#enddate').datepicker('setDate',startFrom)
});


$(document).off('click','.btnremove');
$(document).on('click','.btnremove',function(e){
    var bid=$(this).data('id');
    if(bid){
        $('#schedule_'+bid).remove();
    }
});

load_datepicker('N');
// $('.datepicker').datepicker({
//     format: 'yyyy/mm/dd',
//     autoclose: true
// });

</script>