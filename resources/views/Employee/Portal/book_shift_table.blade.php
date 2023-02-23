<div class="table-responsive tbl">          
    <table class="table table-striped" id="book_extra_shifts">
      <thead>
        <tr>
          <th class="text-center">S.N</th>
          <th>Shift Date/Day</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Total Hours</th>
          <th>Place</th>
          <th>Action&nbsp;<a href="javascript:;" class="btnRefresh" title="Refresh Table" data-id="book_shifts" data-url="{{route('refresh-book-shifts')}}" data-load_datatable="Y" data-table_id='book_extra_shifts'><i class="fa fa-refresh"></i></a></th>
        </tr>
      </thead>
      <tbody>
          @if (!$book_shifts->isEmpty())
            @php
              $date = Carbon\Carbon::today();
            @endphp
              @foreach ($book_shifts as $shift)
              @php
                  $start_date = Carbon\Carbon::parse($shift->startdatead);
                  $days = $date->diffInDays($start_date,false);
              @endphp
              <tr>
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
                    {{-- <td>{{ $shift->quota }}</td> --}}
                    <td>
                        <a href="javascript:;" class="btnModal" title="Shift Detail" data-id="{{$shift->detailid}}" data-url="{{route('shift-view')}}"><i class="fa fa-eye"></i></a> 
                        @if ($days >= 0)
                        <a href="javascript:;" class="book_shift" title="Book Shift" data-id="{{$shift->detailid}}" data-url="{{route('shift-book')}}"><i class="fa fa-ticket"></i>Book</a>    
                            
                        @endif
                    </td> 
              </tr>
          @endforeach
          @else
          <tr>
              <td colspan="8" style="text-align: center; color:#a94442">No Extra Shifts Available</td>
          </tr>
          @endif
      </tbody>
   </table>   
</div>
