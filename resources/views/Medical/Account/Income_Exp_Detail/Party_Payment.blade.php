<h5 class="navtab_header">Party Payment Entry</h5>
<div class="payment_form">
    <form method="post" class="form-horizontal" id="next_payment_form" action="api/income_exp_detail/store_payment_entry">
        <input type="hidden" name="id" value="{{!empty($data['supplier_id'])?$data['supplier_id']:''}}" />
        <div class="row">
            <div class="col-md-4">
                <label>Total Bill Amount</label>
                <input type="text" name="bill_amount" class="form-control float" value="{{!empty( $data['supplier_payment_history'][0]->bill_amount)? $data['supplier_payment_history'][0]->bill_amount:''}}" readonly/>
            </div>

            <div class="col-md-4">
                <label>Remaining Amount</label>
                <input type="text" name="amount_to_be_paid" class="form-control  float" value="{{!empty( $data['supplier_payment_history'][0]->rem_amount)? $data['supplier_payment_history'][0]->rem_amount:''}}" readonly/>
            </div>

            <div class="col-md-4">
                <label>Amount Paid</label>
                <input type="text" name="paid_amount" class="form-control required_field float" />
            </div>
        </div>

        <div class="clearfix"></div>
        <div class="float-left">
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
                    <label>Supplier Name :</label>
                    <span>{{!empty($data['supplier_data']->title)?$data['supplier_data']->title:''}}</span>
                </div>
            </div>
        </div>
    @endif
</div>