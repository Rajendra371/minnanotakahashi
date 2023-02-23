<h5 class="navtab_header py-2">Next Payment</h5>
<div class="payment_form mx-2">
    <form method="post" class="form-horizontal" id="next_payment_form" action="api/income_exp_detail/store_next_payment">
        <input type="hidden" name="id" value="{{!empty($data[0]->id)?$data[0]->id:''}}" />
        <div class="row">
            <div class="col-md-4">
                <label>Total Bill Amount</label>
                <input type="text" name="bill_amount" class="form-control float" value="{{!empty($data[0]->bill_amount)?$data[0]->bill_amount:''}}" readonly/>
            </div>

            <div class="col-md-4">
                <label>Remaining Amount</label>
                <input type="text" name="amount_to_be_paid" class="form-control float" value="{{!empty($data[0]->rem_amount)?$data[0]->rem_amount:''}}" readonly/>
            </div>

            <div class="col-md-4">
                <label>Amount Paid</label>
                <input type="text" name="paid_amount" class="form-control float" />
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="float-left mt-2">
            <button
                type="submit"
                size="md"
                color="primary"
                class="save btn btn-primary btn-md"
            >
            <i class="fa fa-dot-circle-o"></i> Save
            </button>
        </div>
        <div class="clearfix"></div>
        </div>
        <div class="alert-success success"></div>
        <div class="alert-danger error" ></div>
    </form>
</div>

<div class="payment_wrapper">
    @if(!empty($data))
        <h5 class="navtab_header">Payment Details</h5>
        <div class="box-detail">
            <div class="row">
                <div class="col-md-4 col-sm-4">
                    <label>Category Name :</label>
                    <span>{{!empty($data[0]->catname)?$data[0]->catname:''}}</span>
                </div>

                <div class="col-md-4 col-sm-4">
                    <label>Supplier Name :</label>
                    <span>{{!empty($data[0]->suppliername)?$data[0]->suppliername:''}}</span>
                </div>

                <div class="col-md-4 col-sm-4">
                    <label>Invoice No. :</label>
                    <span>{{!empty($data[0]->invoice_billno)?$data[0]->invoice_billno:''}}</span>
                </div>

                <div class="col-md-4 col-sm-4">
                    <label>Bill No. :</label>
                    <span>{{!empty($data[0]->bill_no)?$data[0]->bill_no:''}}</span>
                </div>

                <div class="col-md-4 col-sm-4">
                    <label>Bill Date :</label>
                    <span>{{!empty($data[0]->billdatead)?$data[0]->billdatead:''}}</span>
                </div>

                <div class="col-md-4 col-sm-4">
                    <label>Payment Mode :</label>
                    <span>{{!empty($data[0]->payment_mode)?$data[0]->payment_mode:''}}</span>
                </div>

                <div class="col-md-4 col-sm-4">
                    <label>Total Bill :</label>
                    <span>{{!empty($data[0]->bill_amount)?$data[0]->bill_amount:''}}</span>
                </div>

                <div class="col-md-4 col-sm-4">
                    <label>Remaining Amount :</label>
                    <span>{{!empty($data[0]->rem_amount)?$data[0]->rem_amount:''}}</span>
                </div>

                <div class="col-md-4 col-sm-4">
                    <label>Remarks :</label>
                    <span>{{!empty($data[0]->remarks)?$data[0]->remarks:''}}</span>
                </div>

                <div class="col-md-4 col-sm-4">
                    <label>Payment Status :</label>
                    <span>{{!empty($data[0]->status)?$data[0]->status:''}}</span>
                </div>
            </div>
        </div>

        <h5 class="navtab_header">Payment History</h5>
        <div class="mobile_table">
            <table  class="pop-distribution reportTable">
                <thead>
                    <tr>
                        <th width="5%">S.N</th>
                        <th width="15%">Payment Date</th>
                        <th width="15%">Paid Amount</th>
                        <th width="15%">Remain Amount</th>
                    </tr>
                </thead>
                <tbody>
                @php($i=1)
                    @foreach($data as $key=>$row)
                    <tr>
                        <td>{{$i}}</td>
                        <td>
                        {{!empty($row->trans_datebs)?$row->trans_datebs:''}}
                        </td>
                        <td>{{!empty($row->paid_amount)?$row->paid_amount:'0.00'}}</td>
                        <td>{{!empty($row->remain_amount)?$row->remain_amount:'0.00'}}
                        </td>
                       
                        @php($i++)
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>