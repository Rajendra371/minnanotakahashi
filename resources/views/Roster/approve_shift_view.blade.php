@if (!empty($data))
<div class="white-box pad-5 mtop_10 pdf-wrapper">
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-4">
            <label>Ref. No.:</label>
            <span>{{$data->refno}}</span>
        </div>
        <div class="col-md-4">
            <label>Designation:</label>
            <span>{{$data->designation_id}}</span>
        </div>
        <div class="col-md-4">
            <label>Start Date:</label>
            <span>{{$data->details[0]->startdatead}}</span>
        </div>
        <div class="col-md-4">
            <label>Start Time:</label>
            <span>{{$data->details[0]->start_time}}</span>
        </div>
        <div class="col-md-4">
            <label>End Date:</label>
            <span>{{$data->details[0]->enddatead}}</span>
        </div>
        <div class="col-md-4">
            <label>End Time:</label>
            <span>{{$data->details[0]->end_time}}</span>
        </div>
        <div class="col-md-4">
            <label>Total Hours:</label>
            <span>{{$data->details[0]->total_hrs}}</span>
        </div>
        <div class="col-md-4">
            <label>Place:</label>
            <span>{{$data->details[0]->place}}</span>
        </div>
        <div class="col-md-4">
            <label>Remarks:</label>
            <span>{{$data->details[0]->remarks}}</span>
        </div>
    </div>
    @if ($data->details[0]->empid)
    <div class="row">
        <div class="col-md-12">
            <h4>Shift Bookings</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Employee Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" id="shift_detailid" value="{{$data->details[0]->id}}">
                    <tr>
                        <td>1</td>
                        <td>{{$data->details[0]->employee->first_name.' '.$data->details[0]->employee->middle_name.' '.$data->details[0]->employee->last_name}}</td>
                        <td>
                        <a href="javascript:;" class="approve-shift" data-empid="{{$data->details[0]->employee->id}}" data-bookid="{{''}}" title="Cancel Booking"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    @else  
        <div class="alert alert-danger">No Bookings Yet!!</div>
    @endif
    {{-- If multiple booking is used --}}
    {{-- @if ($data->details[0]->shift_book()->count())
    <div class="row">
        <div class="col-md-12">
            <h4>Shift Bookings</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th>Employee Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <input type="hidden" id="shift_detailid" value="{{$data->details[0]->id}}">
                    @foreach ($data->details[0]->shift_book as $book)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$book->employee->first_name.' '.$book->employee->middle_name.' '.$book->employee->last_name}}</td>
                            <td>
                                @if (empty($data->details[0]->empid))
                                <a href="javascript:;" class="approve-shift" data-empid="{{$book->employee->id}}" data-bookid="{{$book->id}}" title="Approve Shift"><i class="fa fa-check"></i></a>
                                @endif
                                @if ($book->status == 'A')
                                    <span class="badge badge-success">Approved</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @else --}}
    
</div>
<script>
    $(document).off('click','.approve-shift');
    $(document).on('click','.approve-shift',function () {
        if (confirm('Do you want to cancel this booking ?')) {
            var detailid = $('#shift_detailid').val();
            var empid = $(this).data('empid');
            var bookid = $(this).data('bookid');
            axios.post('api/roster/approve_shift',{detailid,empid,bookid})
            .then(response => {
                alert(response.data.message)
                if (response.data.status == 'success') {
                    setTimeout(() => {
                        $('.searchReport').trigger('click'); 
                    }, 10);
                }
            })
            .catch(error=>{
                console.log(error);
            })
        }
        return false
    });
</script>
@endif
