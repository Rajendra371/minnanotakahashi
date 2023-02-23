@if(!$report->isEmpty())
<div id="printrpt" class="white-box pad-5 mtop_10 pdf-wrapper">
    <div>        
        <h4>Employee Roster Summary</h4>
        <table class="table table-hover alt_table">
            <thead>
                <tr>
                    <th width="5%">S.n</th>
                    <th width="10%">Emp. Code</th>
                    <th width="15%">Emp. Name</th>
                    <th width="10%">Designation</th>
                    <th width="10%">Department</th>
                    <th width="20%">Total Hours</th>
                </tr>
            </thead>
            <tbody>
                    @foreach($report as $i => $value)
                    @php
                        $hours = !empty($value->work_hours) ? explode(',',$value->work_hours) : []; 
                    @endphp
                        <tr>
                            <td>{{$i+1}}</td>
                            <td>{{$value->empcode}}</td>
                            <td>{{$value->first_name}} {{$value->middle_name}} {{$value->last_name}}</td>
                            <td>{{$value->designation_name}}</td>
                            <td>{{$value->depname}}</td>
                            <td>{{$total_hours[] = sum_of_times($hours)}}</td>
                        </tr>
                    @endforeach
                <tfoot>
                    <tr>
                        <td colspan="5">Grand Total:</td>
                        <td>{{sum_of_times($total_hours)}}</td>
                    </tr>
                </tfoot>
            </tbody>
        </table>
    </div>
</div>
@endif