<?php
    // dd($shift_data);
?>
<div class="white-box pad-5 mtop_10 pdf-wrapper">
    <div class="clearfix"></div>
    <form id="monthly_SalaryGenerator" name="" action="/api/save_employee_roster_bulk">
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-3 mb-2">
                    <label>Refno:</label>
                    <input type="text" class="form-control" name="refno" value="{{$refno}}" readonly>
                    <input type = "hidden" name = "gen_type" value = "B">
                </div>
                
            </div>
        </div>
        <div class="col-sm-12">
            <label>Generation Type: </label>
            <span>Bulk</span>
            @if($operation != "view")
                <div class = "pull-right mb-2 ">
                    <a href = "javascript:void(0)" class="btn btn-sm btn-success calc_all">Calculate Hours</a>
                </div>
            @endif
            <table class="table table-hover  alt_table">
                <thead>
                    {{-- original --}}
                <tr>
                    <th width = "2%">S.n</th>
                    <th width = "3%">Emp Code</th>
                    <th width = "11%">Emp Name</th>
                    <th width = "11%">Department</th>
                    <th width = "12%">Start Date</th>
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
                    <th width = "12%">Total Hrs</th>
                    <th width = "12%">Place</th>
                    <th width = "13%">Remark</th>
                    @if($operation != "view")
                        <th width = "2%">Action</th>
                    @endif
                </tr>
            </thead>
            <tbody id="tbodySchedule">
                @if($operation == "insert")
                    @if(!empty($employee_data))
                       <?php
                        $count = 1;
                        $length = count($employee_data);
                       ?>
                        @foreach($employee_data as $i =>$d)
                            <tr class="schedule" id="schedule_{{$i+1}}">
                                <input type = "hidden" name = "empid[]" value = {{$d->id ?? ''}}>
                                <input type = "hidden" name = "depid[]" value = {{$d->depid}}>
                                <input type = "hidden" name = "desgid[]" value = {{$d->desgid}}>
                                <td>{{$i+1}}</td>
                                <td><span>{{$d->empcode ?? ''}}</span></td>
                                <td><span>{{$d->first_name ?? ''}} {{$d->middle_name ?? ''}} {{$d->last_name ?? ''}}</span></td>
                                <td><span>{{$d->depname}}</span></td>
                                <td>
                                    <input type="text" class="form-control start_date datepicker required_field" id="startdate_{{$i+1}}" name="startdate[]" data-id= {{$count}} value="{{CURDATE_EN}}" readonly>
                                </td>
                                <td>
                                    <input type="time" class="time_field form-control required_field" id="starttime_{{$i+1}}" name="starttime[]" data-id={{$count}}>
                                </td>
                                <td>
                                    <input type="text" class="form-control end_date required_field" id="enddate_{{$i+1}}" name="enddate[]" data-id= {{$count}} value="{{CURDATE_EN}}" readonly>
                                </td>
                                <td>
                                    <input type="time" class="time_field form-control required_field" id="endtime_{{$i+1}}" name="endtime[]"  data-id= {{$count}}>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="totalhrs_{{$i+1}}" name="totalhrs[]"  data-id= {{$count}} readonly>
                                </td>
                                <td>
                                    <input type="text" class="form-control required_field" id="place_{{$i+1}}" name="place[]"  data-id= {{$count}}>
                                </td>
                                <td>
                                    <input type="text" class="form-control" id="remarks_{{$i+1}}" name="remarks[]"  data-id= {{$count}}>
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
                    @else
                    @if(!empty($shift_data))
                    <input type = "hidden" name = "shift_masterid" value = "{{$master_data->id ?? ''}}">
                        <?php
                            $count = 1;
                            $length = count($shift_data);
                        ?>
                        
                        @foreach($shift_data as $i => $d)
                            <tr class = "schedule" id = "schedule_{{$count}}">
                            <input type ="hidden" name = "sdid[]" value = {{$d->id ?? ''}}>
                            <input type = "hidden" name = "empid[]" value = {{$d->empid ?? ''}}>
                            <input type = "hidden" name = "depid[]" value = {{$d->depid ?? ''}}>
                                <td>{{$count}}</td>
                                <td>{{$d->empcode}}</td>
                                <td><span>{{$d->first_name ?? ''}} {{$d->middle_name ?? ''}} {{$d->last_name ?? ''}}</span></td>
                                <td><span>{{$d->depname ?? ''}}</span></td>
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
                                    <input type="text" class="form-control required_field" id="place_{{$count}}" name="place[]"  data-id= '{{$count}}' value = '{{$d->place ?? ''}}' {{$operation == "view"? "readonly":''}}>
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
            {{-- @if($operation != "view")
                <tfoot>
                    <tr>
                        <td colspan="12">
                            <a href="javascript:void(0)" class="btn btn-sm btn-primary pull-right btnAddmore" title="Add More"><i class="fa fa-plus" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                </tfoot>
            @endif --}}
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
    </form>
    <script>
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
    
        load_datepicker('N');
        // $('.datepicker').datepicker({
        //     format: 'yyyy/mm/dd',
        //     autoclose: true
        // });
    
    </script>