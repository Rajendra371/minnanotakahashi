@if(!$report->isEmpty())
<div id="printrpt" class="white-box pad-5 mtop_10 pdf-wrapper">
    <div>        
        <h4>Date Wise Roster Summary</h4>
        <table class="table table-hover alt_table">
            <thead>
                <tr>
                    <th width="5%">S.n</th>
                    <th width="20%">Date</th>
                    <th width="20%">Emp. Count</th>
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
                            <td>{{$value->startdatead}}</td>
                            <td>{{$value->employees}}</td>
                            <td>{{$total_hours[] = sum_of_times($hours)}}</td>
                        </tr>
                    @endforeach
                <tfoot>
                    <tr>
                        <td colspan="3">Grand Total:</td>
                        <td>{{sum_of_times($total_hours)}}</td>
                    </tr>
                </tfoot>
            </tbody>
        </table>
    </div>
</div>
@endif