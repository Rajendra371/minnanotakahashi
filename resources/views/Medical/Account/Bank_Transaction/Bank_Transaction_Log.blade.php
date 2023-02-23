<div class="text-right">
    <a href="javascript:void(0)" class="btn btn-sm btn-success view" data-id="{{!empty($data->id)?$data->id:''}}" data-url="/api/bank_transaction/add_new_transaction" title="Add New Bank Transaction">
        <i class="fa fa-money" aria-hidden="true"></i> Add New Transaction
    </a>
</div>

<h5 class="navtab_header">Bank Account Details</h5>
<div class="box-detail">
    <div class="row ">
        <div class="col-md-4 col-sm-4">
            <label>Bank Name: </label>
            <span>{{!empty($data->bank_name)?$data->bank_name:''}}</span>
        </div>

        <div class="col-md-4 col-sm-4">
            <label>Account Name: </label>
            <span>{{!empty($data->bank_account_name)?$data->bank_account_name:''}}</span>
        </div>

        <div class="col-md-4 col-sm-4">
            <label>Account Number:</label>
            <span>{{!empty($data->bank_account_no)?$data->bank_account_no:''}}</span>
        </div>

        <div class="col-md-4 col-sm-4">
            <label>Authorized Person:</label>
            <span>{{!empty($data->authorize_person)?$data->authorize_person:''}}</span>
        </div>

        <div class="col-md-4 col-sm-4">
            <label>Address:</label>
            <span>{{!empty($data->address)?$data->address:''}}</span>
        </div>

        <div class="col-md-4 col-sm-4">
            <label>Contact No.:</label>
            <span>{{!empty($data->contact_no)?$data->contact_no:''}}</span>
        </div>

        <div class="col-md-4 col-sm-4">
            <label>Balance Amount:</label>
            <span>{{!empty($data->bal_amount)?$data->bal_amount:''}}</span>
        </div>
    </div>
</div>

<h5 class="navtab_header">Bank Transaction Log</h5>
<table class="table table-striped">
    <thead>
    <tr>
        <th>S.No.</th>
        <th>Trans Date/Time</th>
        <th>Deposit</th>
        <th>Withdraw</th>
        <th>Balance</th>
        <th>Dep./With. By</th>
    </tr>
    </thead>

    <tbody>
    @if(!empty($tran_data))
        @foreach($tran_data as $dat)  
    <tr>
    @php($i=1)
        <td>{{$i}}</td>
        <td>{{ $dat->tran_datead }} {{ $dat->tran_time }}</td>
        <td>{{ $dat->dep_amount }} </td>
        <td>{{ $dat->with_amount }} </td>
        <td>{{ $dat->bal_amount }} </td>
        <td>{{ $dat->dep_with_by }} </td>
    </tr>
    @php($i++)
        @endforeach
    @endif
    </tbody>
</table>