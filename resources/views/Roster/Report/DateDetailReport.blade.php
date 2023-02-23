@if(!empty($report) && count($report) > 0)
<div id="printrpt" class="white-box pad-5 mtop_10 pdf-wrapper">
    <div>        
        <h4>Date Wise Roster Detail</h4>
        @foreach($report as $value)
            <table class="alt_table">
                <tr>
                    <td>Date:<span>{{$value['date']}}</span></td>
                </tr>
            </table>
            <table class="table table-hover alt_table">
                <thead>
                    <tr>
                        <th width="5%">S.n</th>
                        <th width="8%">Emp. Code</th>
                        <th width="10%">Emp. Name</th>
                        <th width="8%">Department</th>
                        <th width="8%">Designation</th>
                        <th width="10%">Start Date</th>
                        <th width="8%">Start Time</th>
                        <th width="10%">End Date</th>
                        <th width="8%">End Time</th>
                        <th width="10%">Hours</th>
                        <th width="15%">Place</th>
                        <th width="8%">Status</th>
                        <th width="8%">Check In</th>
                        <th width="8%">Check Out</th>
                        <th width="10%">Work Hour</th>
                        <th width="15%">Progress Note</th>
                        <th width="10%">Remarks</th>
                        
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $hour = array(); 
                        $total_work_hours = array(); 
                    @endphp
                    @if(!empty($value['details']))
                        @foreach($value['details'] as $i => $detail)
                        @php
                            $work_status = $detail->work_status;
                            if ($work_status == 'P') {
                                $status = 'Pending';
                            } elseif ($work_status == 'V') {
                                $status = 'Needs Verification';
                            } elseif ($work_status == 'CO') {
                                $status = 'Completed';
                            } elseif ($work_status == 'C') {
                                $status = 'Cancelled';
                            } else {
                                $status = 'NA';
                            }
                        @endphp
                            <tr>
                                <td>{{$i+1}}</td>
                                <td>{{$detail->empcode}}</td>
                                <td>{{$detail->first_name . ' ' . $detail->middle_name . ' ' . $detail->last_name}}</td>
                                <td>{{$detail->depname}}</td>
                                <td>{{$detail->designation_name}}</td>
                                <td>{{$detail->startdatead}}</td>
                                <td>{{$detail->start_time}}</td>
                                <td>{{$detail->enddatead}}</td>
                                <td>{{$detail->end_time}}</td>
                                <td>{{$detail->total_hrs}}</td>
                                <td>{{$detail->place}}</td>
                                <td>{{$status}}</td>
                                <td>{{ "$detail->checkin_date $detail->checkin_time" }}</td>
                                <td>{{ "$detail->complete_date $detail->complete_time" }}</td>
                                <td>
                                    @php
                                    $work_hour = '';
                                    if (!empty($detail->checkin_time) && !empty($detail->complete_time)) {
                                        $start = Carbon\Carbon::parse("$detail->checkin_date $detail->checkin_time");
                                        $end = Carbon\Carbon::parse("$detail->complete_date $detail->complete_time");
                                        $work_hour = $start->diffInHours($end) . ':' . $start->diff($end)->format('%I:%S');
                                        $total_work_hours[] = $work_hour;
                                    }      
                                    @endphp
                                    {{$work_hour}}
                                </td>
                                <td>{{$detail->work_details}}</td>
                                <td>{{$detail->detail_remarks}}</td>
                            </tr>
                            @php $hour[] = $detail->total_hrs; @endphp
                        @endforeach
                    @endif
                    <tfoot>
                        @php 
                            $grand_totalhrs = sum_of_times($hour); 
                            $grand_work_hours = sum_of_times($total_work_hours); 
                        @endphp
                        <tr>
                            <td colspan = "9"><strong>Total Hours</strong></td>
                            <td>{{$grand_totalhrs}}</td>
                            <td colspan = "4"></td>
                            <td>{{$grand_work_hours}}</td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tfoot>
                </tbody>
            </table>
        @endforeach 
    </div>
</div>
@endif