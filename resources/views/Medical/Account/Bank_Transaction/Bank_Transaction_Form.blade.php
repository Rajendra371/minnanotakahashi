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

<div class="card">
    <div class="card-header">
        <h5 class="card-title">Bank Transaction Form</h5>
    </div>

    <div class="card-body">
        <form action="/api/bank_transaction/store" id="bank_transactionForm" method="post" class="form-horizontal">
            <input type="hidden" name="bank_id" value="{{!empty($data->id)?$data->id:''}}" />
            <div class="row form-group">
                <div class="col-md-3 col-sm-3">
                    <label>Transaction Type:</label><br/>
                    <input type="radio" name="tran_type" id="tran_type" class="required_field" value="D" />
                    Deposit &nbsp;&nbsp;&nbsp;

                    <input type="radio" name="tran_type" id="tran_type" class="required_field" value="W" />
                    Withdraw &nbsp;&nbsp;&nbsp;
                </div>

                <div class="col-md-3 col-sm-3">
                    <label>Amount:</label>
                    <input type="text" class="form-control" name="amount" placeholder="amount" />
                </div>

                <div class="col-md-3 col-sm-3">
                    <label>Date:</label>
                <input type="text" class="form-control"  name="tran_date" placeholder="Transaction Date" value="{{date('Y/m/d')}}" />
                </div>

                <div class="col-md-3 col-sm-3">
                    <label>Time:</label>
                    <input type="text" class="form-control"  name="tran_time" placeholder="Transaction Time" value="{{date('H:i:s')}}" />
                </div>

                <div class="col-md-3 col-sm-3">
                    <label>Deposit By:</label>
                    <input type="text" class="form-control"  name="dep_with_by" placeholder="Deposit By" />
                </div>

                <div class="col-md-12 col-sm-12">
                    <label>Remarks :</label>
                    <textarea name="remarks"  class="form-control" ></textarea>
                </div>

                <div class="col-md-3 col-sm-3">
                    <button type="submit" class="btn btn-md btn-success save" data-isdismiss='Y' data-btnrefresh='Y' style="margin-top: 29px;">Save</button>
                    <!-- <button type="submit" class="btn btn-md btn-success save" data-isdismiss='Y' data-btnrefresh='Y' style="margin-top: 29px;">Save & Print</button> -->
                </div>
            </div>

            <div class="clearfix"></div>
            <div class="alert-success success"></div>
            <div class="alert-danger error"></div>
        </form>
    </div>
</div>