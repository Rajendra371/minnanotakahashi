<div class="payment_wrapper">
    @if(!empty($data))
        <h5 class="navtab_header">Payment Details</h5>
        <div class="box-detail">
            <div class="row">
                    <div class="col-md-4 col-sm-4">
                    <label>Supplier Name :</label>
                    <span>{{!empty($data->supplier_name)?$data->supplier_name:''}}</span>
                </div>
                <div class="col-md-4 col-sm-4">
                    <label>Voucher No. :</label>
                    <span>{{!empty($data->voucher_no)?$data->voucher_no:''}}</span>
                </div>

                <div class="col-md-4 col-sm-4">
                    <label>Payment Date :</label>
                    <span>{{!empty($data->paymentdatead)?$data->paymentdatead:''}}(AD)-{{!empty($data->paymentdatebs)?$data->paymentdatebs:''}}(BS)</span>
                </div>

                <div class="col-md-4 col-sm-4">
                    <label>Payment Mode :</label>
                    <span>{{!empty($data->payment_mode)?$data->payment_mode:''}}</span>
                </div>

                <div class="col-md-4 col-sm-4">
                    <label>Bank :</label>
                    <span>{{!empty($data->bank_name)?$data->bank_name:''}}-{{!empty($data->bank_account_no)?$data->bank_account_no:''}}</span>
                </div>

                <div class="col-md-4 col-sm-4">
                    <label>Cheque Date :</label>
                    <span>{{!empty($data->chequedatead)?$data->chequedatead:''}}(AD)-{{!empty($data->chequedatebs)?$data->chequedatebs:''}}(BS)</span>
                </div>
                
                <div class="col-md-4 col-sm-4">
                    <label>Cheque No :</label>
                    <span>{{!empty($data->chequeno)?$data->chequeno:''}}</span>
                </div>
                <div class="col-md-4 col-sm-4">
                    <label>Amount :</label>
                    <span>{{!empty($data->amount)?$data->amount:''}}</span>
                </div>
                <div class="col-md-4 col-sm-4">
                    <label>Receiver Name :</label>
                    <span>{{!empty($data->receiver_name)?$data->receiver_name:''}}</span>
                </div>
                <div class="col-md-4 col-sm-4">
                    <label>Receiver Number :</label>
                    <span>{{!empty($data->receiver_contactno)?$data->receiver_contactno:''}}</span>
                </div>
                <div class="col-md-4 col-sm-4">
                    <label>Remarks :</label>
                    <span>{{!empty($data->remarks)?$data->remarks:''}}</span>
                </div>
            </div>
            <div class="pull-right">
                <a href="javascript:void(0)" class="btn btn-sm btn-danger btncancel" data-url="/api/advance_payment/cancel" data-id={{$data->id}} >Cancel</a>
            </div>
        </div>        
    @endif
</div>

<script>
$(document).off('click','.btncancel');
$(document).on('click','.btncancel',function(e){
alert('asd');
return false;
})
</script>