<div class="white-box pad-5 mtop_10 pdf-wrapper">
<div class="clearfix"></div>
<form id="monthly_SalaryGenerator" name="" action="/api/save_employee_roster_individual">
<div class="row">
    <div class="col-sm-12">
        <div class="row">
            <div class="col-sm-3">
                <label>Refno:</label>
                <input type="text" class="form-control" name="refno" value="{{$refno}}" readonly>
            </div>
            <div class="col-sm-9">
                <table class="table">
                    <tr style="
                    background: #e4fcff;
                    font-weight: bold;
                ">
                        <td>Emp Code</td>
                        <td>Emp. Name</td>
                        <td>Designation</td>
                        <td>Department </td>
                        <td>Email</td>
                        <td>Contact No </td>
                        <td>Joining Date </td>
                    </tr>
                    <tr>
                    <input type = "hidden" name = "empid" value = {{$emp_result->empid ?? ''}}>
                    <input type = "hidden" name = "depid" value = {{$emp_result->depid ?? ''}}>
                    <input type = "hidden" name = "desgid" value = {{$emp_result->desgid ?? ''}}>
                    <input type = "hidden" name = "gen_type" value = "S">
                    <input type = "hidden" name = "shift_masterid" value = {{$master_data->id ?? ''}}>
                        <td> @if($emp_result) {{$emp_result->empcode}} @endif</td>
                        <td> @if($emp_result) {{$emp_result->first_name.' '.$emp_result->middle_name.' '.$emp_result->last_name}} @endif</td>
                        <td> @if($emp_result) {{$emp_result->designation_name}} @endif</td>
                        <td> @if($emp_result) {{$emp_result->depname}} @endif</td>
                        <td> @if($emp_result) {{$emp_result->email}} @endif</td>
                        <td> @if($emp_result) {{$emp_result->mobile1}} @endif</td>
                        <td> @if($emp_result) {{$emp_result->joining_datead}} @endif</td>
                    </tr>
                    
                </table>
            </div>

            <div class="col-sm-12">
                <label>Generation Type: </label>
                <span>Single</span>
                @if($operation != "view")
                    <div class = "pull-right mb-2 ">
                        <a href = "javascript:void(0)" class="btn btn-sm btn-success calc_all">Calculate Hours</a>
                    </div>
                @endif
                <table class="table table-hover  alt_table">
                    <thead>
                    <tr>
                        <th>S.n</th>
                        <th>Start Date</th>
                        @if($operation != "view")
                        <th width = "5%">Start Time<input class = "form-control" type = "time" id = "bulk_starttime"></th>
                        @else
                            <th width = "5%">Start Time</th>
                        @endif
                        <th width = "12%">End Date</th>
                        @if($operation != "view")
                            <th width = "5%">End Time<input class = "form-control" type = "time" id = "bulk_endtime"></th>
                        @else
                            <th width = "5%">End Time</th>
                        @endif
                        <th>Total Hrs</th>
                        <th>Place</th>
                        <th>Remark</th>
                        @if($operation != "view") 
                            <th>Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody id="tbodySchedule">
                    @if($operation == "insert")
                    <tr class="schedule" id="schedule_1">
                        <td>1.</td>
                        <td>
                            <input type="text" class="form-control start_date datepicker required_field" id="startdate_1" name="startdate[]" data-id="1" value="{{CURDATE_EN}}">
                        </td>
                        <td>
                            <input type="time" class="time_field form-control required_field" id="starttime_1" name="starttime[]" data-id="1">
                        </td>
                        <td>
                            <input type="text" class="form-control end_date required_field" id="enddate_1" name="enddate[]" data-id="1" value="{{CURDATE_EN}}">
                        </td>
                        <td>
                            <input type="time" class="time_field form-control required_field" id="endtime_1" name="endtime[]"  data-id="1">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="totalhrs_1" name="totalhrs[]"  data-id="1" readonly>
                        </td>
                        <td>
                            <input type="text" class="form-control required_field" id="place_1" name="place[]"  data-id="1">
                        </td>
                        <td>
                            <input type="text" class="form-control" id="remarks_1" name="remarks[]"  data-id="1">
                        </td>
                    </tr>
                    @else
                        @if(!empty($shift_data))
                            
                            <?php
                                $count = 1;
                                $length = count($shift_data);
                            ?>
                                
                            
                            @foreach($shift_data as $i => $d)
                                <tr class = "schedule" id = "schedule_{{$count}}">
                                <input type ="hidden" name = "sdid[]" value = {{$d->id ?? ''}}>

                                    <td>{{$count}}</td>
                                    <td>
                                        <input type="text" class="form-control start_date datepicker required_field" id="startdate_{{$count}}" name="startdate[]" data-id= '{{$count}}' value= '{{$d->startdatead ?? CURDATE_EN}}' readonly>
                                    </td>
                                    <td>
                                        <input type="time" class="time_field form-control required_field" id="starttime_{{$count}}" name="starttime[]" data-id= '{{$count}}' value = '{{$d->start_time ?? ''}}' {{$operation == "view"? "readonly":''}}>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control end_date datepicker required_field" id="enddate_{{$count}}" name="enddate[]" data-id= '{{$count}}' value= '{{$d->enddatead ?? CURDATE_EN}}' readonly>
                                    </td>
                                    <td>
                                        <input type="time" class="time_field form-control required_field" id="endtime_{{$count}}" name="endtime[]"  data-id= '{{$count}}' value = '{{$d->end_time ?? ''}}' {{$operation == "view"? "readonly":''}}>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="totalhrs_{{$count}}" name="totalhrs[]"  data-id= '{{$count}}' value = '{{$d->total_hrs ?? ''}}' readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control required_field" id="place_{{$count}}" name="place[]"  data-id= '{{$count}}' value = '{{$d->place ?? ''}}' readonly>
                                    </td>
                                    <td>
                                        <input type="text" class="form-control" id="remarks_{{$count}}" name="remarks[]"  data-id= '{{$count}}' value = '{{$d->remarks ?? ''}}' {{$operation == "view"? "readonly":''}}>
                                    </td>
                                    @if($operation != "view")
                                        @if($length > 1)
                                            <td><a href="javascript:void(0)" class="btn btn-sm btn-danger btnremove" data-id={{$count}} id="removebtn_{{$count}}"><i class="fa fa-trash" aria-hidden="true" Title="Remove"></i></a></td>
                                        @endif
                                    @endif    
                                </tr>
                                @php($count++)
                            @endforeach
                        @endif
                    @endif
                </tbody>
                @if($operation != "view")
                    <tfoot>
                        <tr>
                            <td colspan="9">
                                <a href="javascript:void(0)" class="btn btn-sm btn-primary pull-right btnAddmore" title="Add More"><i class="fa fa-plus" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    </tfoot>
                @endif
                </table>
            </div>
            <div class="col-sm-4">
                <label>Remarks</label>
                <textarea name="shift_remarks" class="form-control" cols="3" rows="2" {{$operation == "view"? "readonly":''}}>{{$master_data->remarks ?? ''}}</textarea>
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

    $(document).off('click','.btnAddmore');
    $(document).on('click','.btnAddmore',function(e){
        
        var  length=$('.schedule').length;
        var lplusone=length+1;

        var scheduletemplate='<tr class="schedule" id="schedule_'+lplusone+'"><input type = "hidden" name = "sdid[]" value =""><td>'+lplusone+'.</td><td><input type="text" class="form-control start_date datepicker required_field" name="startdate[]" data-id="'+lplusone+'" id="startdate_'+lplusone+'" value="{{CURDATE_EN}}" readonly ></td><td><input type="time" class="time_field form-control required_field" id="starttime_'+lplusone+'" name="starttime[]"  data-id="'+lplusone+'"></td><td><input type="text" class="form-control end_date required_field" id="enddate_'+lplusone+'" name="enddate[]" data-id="'+lplusone+'"  value="{{CURDATE_EN}}" readonly ></td><td><input type="time" class="time_field form-control required_field" id="endtime_'+lplusone+'" name="endtime[]" data-id="'+lplusone+'"></td><td><input readonly type="text" class="form-control" id="totalhrs_'+lplusone+'" name="totalhrs[]" data-id="'+lplusone+'" ></td><td><input type="text" class="form-control required_field " id = "place_'+lplusone+'" name="place[]" data-id="'+lplusone+'"></td><td> <input type="text" class="form-control " id = "remarks_'+lplusone+'" name="remarks[]"  data-id="'+lplusone+'"></td><td><a href="javascript:void(0)" class="btn btn-sm btn-danger btnremove" data-id="'+lplusone+'" id="removebtn_'+lplusone+'"><i class="fa fa-trash" aria-hidden="true" Title="Remove"></i></a></td></tr>';

        $('#tbodySchedule').append(scheduletemplate);
        $(this).attr('data-id',length);        
        load_datepicker('N');
        
    });

    $(document).off('click','.btnremove');
    $(document).on('click','.btnremove',function(e){

        let bid=$(this).data('id');
        let length = $('.schedule').length;
        if(length>1){
            if(bid){
                $('#schedule_'+bid).remove();
                let new_length = $('.schedule').length;
                if(new_length <= 1){
                    console.log('hide');
                    $('.btnremove').hide();
                }
            }
        }
        else{
            $('.btnremove').hide();
        }
    });

    $(document).off('change','#bulk_starttime');
    $(document).on('change','#bulk_starttime',function(e){
        let value = $(this).val();
        $('.schedule').each(function(i){
            $('#starttime_'+(i+1)).val(value);
        });
    });

    $(document).off('change','#bulk_endtime');
    $(document).on('change','#bulk_endtime',function(e){
        let value = $(this).val();
        $('.schedule').each(function(i){
            $('#endtime_'+(i+1)).val(value);
        });
    });

    $(document).off('click','.calc_all');
    $(document).on('click','.calc_all', function(e){
        $('.time_field').change();
    });

    $(document).off('change','.start_date');
    $(document).on('change','.start_date', function(e){
        let id = $(this).data('id');
        let start_date = $(this).val();
        let startFrom = new Date(start_date)            
        // console.log({id,start_date,startFrom});
        $('#enddate_'+id).datepicker('destroy')
        $('#enddate_'+id).datepicker({
            format: 'yyyy/mm/dd',
            autoclose: true, 
            startDate : startFrom,
            setDate : startFrom
        })
        $('#enddate_'+id).datepicker('setDate',startFrom)
    }); 


    $(document).off('change','.time_field');
    $(document).on('change','.time_field', function(e){
        let id = $(this).data('id');
        console.log(id);
        // let length = $('.schedule').length;
        if(id){
            let start_time = $('#starttime_'+id).val();
            let end_time = $('#endtime_'+id).val();
            let start_date = $('#startdate_'+id).val();
            let end_date = $('#enddate_'+id).val();
            // let start = start_date + ' ' + start_time;
            // let end = end_date + ' ' + end_time;
            // console.log(start, end);
            let url = constvar.api_url + "roster/get_total_hours";
            let postdata = {start_time: start_time, end_time: end_time, start_date: start_date, end_date: end_date};
            axios
                .post(url, postdata)
                .then((res) =>{
                    if(res.data.status == "success"){
                        $('#totalhrs_'+id).val(res.data.time);
                    }
                    else{
                        console.log('fail');
                    }
                });
        }
    });

    load_datepicker('N');
    // $('.datepicker').datepicker({
    //     format: 'yyyy/mm/dd',
    //     autoclose: true
    // });

</script>