<div class="position-relative row form-group">
        <input name="id" type="hidden" class="form-control" value="{{$data['advance_payment_data']->id}}">
        <div class="col-4 col-sm-4 col-md-4">
            <label class="">Voucher No:</label><code>*</code>
        <input name="voucher_no" id="voucher_no" readonly="true" type="text" class="form-control" value="{{$data['advance_payment_data']->voucher_no}}">
        </div>
    </div>
    <div class="position-relative row form-group">
        <div class="col-4 col-sm-4 col-md-4">
            <label class="">Supplier:</label>
            <select name="supplierid" id="supplierid" class="select2 required_field form-control">
                <option value="">-- Select --</option>
                @if(!empty($data['supplier_list']))
                @foreach($data['supplier_list'] as $sup)
                <option value="{{$sup->id}}" @if($sup->id==$data['advance_payment_data']->supplierid) {{'selected=selected'}} @endif >{{$sup->supplier_name.' '.$sup->supplier_address}}</option>
                @endforeach
                @endif
            </select>
        </div>
        <div class="col-4 col-sm-4 col-md-4">
            <label class="">Payment Date:</label><code>*</code>
            <input name="paymentdate" id="paymentdate" placeholder="yyyy/mm/dd" autocomplete="off" type="text" class="datepicker required_field form-control" value="{{$data['advance_payment_data']->paymentdatead}}">
        </div>
        <div class="col-4 col-sm-4 col-md-4">
            <label class="">Payment Mode:</label><code>*</code>
            @php($pmode=$data['advance_payment_data']->payment_mode)
            <br>

        <input name="payment_mode" type="radio" class="form-check-input" value="CASH" @if($pmode=='CASH') {{'checked=checked'}} @endif >Cash &nbsp;&nbsp;&nbsp;
            <input name="payment_mode" type="radio" class="form-check-input" value="CHEQUE" @if($pmode=='CHEQUE') {{'checked=checked'}} @endif >Cheque &nbsp;&nbsp;&nbsp;</div>
    </div>
    @if($pmode=='CHEQUE')  
    <div>
        <div class="position-relative row form-group">
            <div class="col-4 col-sm-4 col-md-4">
                <label class="">Bank</label>
                <select name="bankid" id="bankid" class="form-control">
                    <option value="">-- Select --</option>
                    @if(!empty($data['bank_list']))
                    @foreach($data['bank_list'] as $ban)
                    <option value="{{$ban->id}}" @if($ban->id==$data['advance_payment_data']->bankid) {{'selected=selected'}} @endif>{{$ban->bank_name.' '.$ban->bank_account_no}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="col-4 col-sm-4 col-md-4">
                <label class="">Cheque Date:</label>
                <input name="chequedate" id="chequedate" placeholder="yyyy/mm/dd" autocomplete="off" type="text" class="datepicker form-control" value="{{$data['advance_payment_data']->chequedatead}}">
            </div>
            <div class="col-4 col-sm-4 col-md-4">
                <label class="">Cheque No:</label>
                <input name="chequeno" id="chequeno" placeholder="Enter Cheque No" autocomplete="off" type="text" class="form-control" value="{{$data['advance_payment_data']->chequeno}}">
            </div>
        </div>
    </div>
    @endif 
    <div class="position-relative row form-group">
        <div class="col-4 col-sm-4 col-md-4">
            <label class="">Amount:</label><code>*</code>
            <input name="amount" autocomplete="off" value="{{$data['advance_payment_data']->amount}}" data-targetdiv="number_to_word" type="textbox" class="float required_field number_to_word form-control">
            <div class="number_to_word"></div>
        </div>
        <div class="col-4 col-sm-4 col-md-4">
            <label class="">Receiver Name:</label><code>*</code>
            <input name="receiver_name" autocomplete="off" value="{{$data['advance_payment_data']->receiver_name}}" type="textbox" class="required_field form-control">
        </div>
        <div class="col-4 col-sm-4 col-md-4">
            <label class="">Receiver Contact No:</label>
            <input name="receiver_contactno" autocomplete="off" type="textbox" value="{{$data['advance_payment_data']->receiver_contactno}}" class="form-control">
        </div>
    </div>
    <div class="position-relative row form-group">
        <div class="col-12 col-sm-12 col-md-12">
            <label class="">Remarks:</label>
            <textarea name="remarks" placeholder="Remarks" class="form-control">{{$data['advance_payment_data']->remarks}}</textarea>
        </div>
    </div>
    <div class="card-footer">
        <div class="clearfix">
            <div class="float-right">
                <button type="submit" data-print="reloadid" data-targetid="voucher_no" class="save btn btn-primary btn-md"><i class="fa fa-dot-circle-o"></i> Update</button> &nbsp;&nbsp;&nbsp;
                <button type="submit" data-print="print,reloadid" data-targetid="voucher_no" class="save btn btn-primary btn-md"><i class="fa fa-print"></i> Update &amp; Print</button> &nbsp;&nbsp;&nbsp;
                <button type="button" class="btnreset btn btn-danger btn-md btn btn-secondary"><i class="fa fa-ban"></i> Reset</button>
            </div>
        </div>
        <div class="alert-success success"></div>
        <div class="alert-danger error"></div>
    </div>
<script>
load_datepicker();
</script>