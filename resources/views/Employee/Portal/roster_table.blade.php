<div class="table-responsive tbl">          
    <table class="table" id="employee_roster">
      <thead>
        <tr>
          <th class="text-center">S.N</th>
          <th>Shift Date/Day</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Total Hours</th>
          <th>Place</th>
          <th>Remarks</th>
          <th>Status</th>
          <th>Clock In</th>
          <th>Clock Out</th>
          <th>Progress Note</th>
          <th>Action &nbsp;<a href="javascript:;" class="btnRefresh" title="Refresh Table" data-id="your_roster" data-url="{{route('refresh-roster')}}" data-load_datatable="Y" data-table_id='employee_roster'><i class="fa fa-refresh"></i></a></th>
        </tr> 
      </thead>
      <tbody>
          @if (!$shifts->isEmpty())
          @foreach ($shifts as $shift)
          <tr class="{{$shift->work_status == 'CO' ? 'alert-success' : ($shift->work_status == 'V' ? 'alert-warning' : 'alert-info')}}">
              <td class="text-center">{{$loop->iteration}}</td>
              @if ($shift->startdatead == $shift->enddatead )
              <td>{{ $shift->startdatead }}&nbsp;({{date('D', strtotime($shift->startdatead))}})</td>
              @else
              <td>{{ "$shift->startdatead - $shift->enddatead" }}&nbsp;<br>({{date('D', strtotime($shift->startdatead))}}-{{date('D', strtotime($shift->enddatead))}})</td>   
              @endif
              <td>{{ $shift->start_time }}</td>
              <td>{{ $shift->end_time }}</td>
              <td>{{ $shift->total_hrs }}</td>
              <td>{{ $shift->place }}</td>
              <td>{{ $shift->remarks }}</td>
              <td>{{ $shift->work_status == 'CO' ? 'Completed' : ($shift->work_status == 'V' ? 'Verification Pending' : 'Pending')  }}</td>
              <td>
                @if ($shift->checkin_time)
                {{ $shift->checkin_date }} {{$shift->checkin_time}}
                @else
                  -
                @endif
              </td>
              <td>
                @if ($shift->complete_time)
                {{ $shift->complete_date }} {{$shift->complete_time}}
                @else
                  -
                @endif
              </td>
              <td title="{{$shift->work_details}}">
                {{ str_limit($shift->work_details, 20) }}
              </td>
              <td>
                <div style="display: flex; justify-content:space-between; gap:1rem;">
                  <a href="javascript:;" class="btnModal" title="Shift Detail" data-id="{{$shift->detailid}}" data-url="{{route('shift-view')}}"><i class="fa fa-eye"></i></a>
                  @if ($shift->work_status == 'P' && ($shift->startdatead <= Carbon\Carbon::today()->format('Y/m/d')))
                  @if (empty($shift->checkin_time))
                    <a href="javascript:;" class="clockIn" title="Clock In" data-id="{{$shift->detailid}}" data-url="{{route('shift-clockin')}}"><i class="fa fa-clock-o"> Clock In</i></a>  
                  @else
                    <a href="javascript:;" class="btnModal" title="Shift Completed" data-id="{{$shift->detailid}}" data-url="{{route('shift-complete-view')}}"><i class="fa fa-check"> Clock Out</i></a>
                    {{-- <a href="javascript:;" class="workStatus" title="Shift Completed" data-id="{{$shift->detailid}}" data-url="{{route('shift-completed')}}"><i class="fa fa-check"></i></a> --}}
                  @endif
                  @endif
                </div>
              </td> 
          </tr>
          @endforeach
          @else
          <tr>
              <td colspan="8" style="text-align: center; color:#a94442">No Shift Assigned !!</td>
          </tr>
          @endif
      </tbody>
   </table>
</div>

