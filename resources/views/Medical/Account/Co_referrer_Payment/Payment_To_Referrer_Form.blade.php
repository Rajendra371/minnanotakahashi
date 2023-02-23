<div class="card"><div class="card-header">
<h5 class="card-title">Payment Voucher</h5>
</div>
<div class="card-body">
    <div class="row form-group">
    <div class="col-md-12 col-sm-6">
      <h6 class="text-center">{{$data['referrer_info']->rein_name}}</h6> 
      <h6 class="text-center">{{$data['referrer_info']->address}}</h6> 
      <h6 class="text-center">{{$data['referrer_info']->primary_phone}}</h6> 
    </div>
    &nbsp;
    <div class="col-md-12 col-sm-6">
    <span class="pull-right text text-success" style="font-weight: bold;">To be Paid: <label id="tobepaid"> {{$data['prev_balance'][0]->remamt}}</label></span>
    </div>
    <div class="col-md-12 col-sm-6">
    <span class="pull-right text text-danger" style="font-weight: bold;">Rem. To be Paid: <label id="labelrem"> {{$data['prev_balance'][0]->remamt}} </label></span>
    </div>
    </div>
        <form action="/api/co_referrer_payment/save_referrer_payment_log" id="deliveryForm" method="post" class="form-horizontal">
        <input type="hidden" name="id" value="{{ $data['referrerid']}}">
                <div class="row form-group">
                <div class="col-md-1 col-sm-1">
                        <label>V.No.</label>
                <input type="text" name="payment_voucher_no" value="{{$data['p_voucherno']}}" class="form-control" readonly style="width: 51px;">
                </div>
                <div class="col-md-2 col-sm-2">
                <label>Payment Date</label>
                <input type="text" name="payment_date" class=" required_field form-control datepicker" value="{{date('Y/m/d')}}" />
               </div>
               <div class="col-md-3 col-sm-3">
                    <label>Payment time</label>
               <input type="time" name="payment_time" class="form-control required_field" value="{{date('H:i:s')}}" />
                   </div>
                   <div class="col-md-3 col-sm-3">
                       <label>Payment Type</label>
                       <select name="payment_type" class="form-control required_field" id="payment_type">
                           <option value="CASH">Cash</option>
                           <option value="CHEQUE">Cheque</option>
                       </select>
                   </div>
                   <div class="col-md-3 col-sm-3 divhide" style="display:none">
                        <label>Bank</label>
                        <select name="bankid" class="form-control" id="bank">
                        @if(!empty($data['bank_info']))
                        @foreach($data['bank_info'] as $bnk)
                        <option value="{{$bnk->id}}">{{$bnk->bank_name.' | '.$bnk->bank_account_no }}</option>
                        @endforeach
                        @endif   
                        </select>
                   </div>
                   <div class="col-md-3 col-sm-3 divhide" style="display:none">
                        <label>Cheque No.</label>
                        <input type="text" name="cheque_no" class="form-control">
                   </div>
                   <div class="col-md-3 col-sm-3 divhide" style="display:none">
                        <label>Cheque Date.</label>
                        <input type="text" name="cheque_date" class="form-control datepicker" value="{{date('Y/m/d')}}">
                   </div>
                   <div class="col-md-3 col-sm-3">
                       <label>Amount</label>
                       <input type="text" name="amount" class="float form-control required_field" id="paidamount">
                   </div>
               <div class="col-md-3 col-sm-3">
                <label>Receiver Name</label>
               <input type="text" name="receiver_name" class="form-control required_field" value="" />
                </div>
                <div class="col-md-3 col-sm-3">
                <label>Receiver Contact No.</label>
                <input type="text" name="receiver_number" class="form-control" value="" />
                </div>
               
                </div>
                <div class="row">
                <div class="col-md-3 col-sm-3">
                        <button type="submit" class="btn btn-md btn-success save" data-isdismiss='Y' data-btnrefresh='Y' style="margin-top: 29px;">Save</button>
                        <button type="submit" class="btn btn-md btn-success save" data-isdismiss='Y' data-btnrefresh='Y' data-print='print' style="margin-top: 29px;">Save & Print</button>
                </div>
                <div class="clearfix"></div>
                <div class="alert-success success"></div><div class="alert-danger error"></div></div>
                </div>
    </form>
    </div>
    <div class="printTable">
        <div class="print_report_section">
        </div>
    </div>
    
    <script>
    load_datepicker();
    </script>
    <script>
    $(document).off('change','#payment_type');
    $(document).on('change','#payment_type',function(e){
        var ptype=$(this).val();
        if(ptype=='CHEQUE')
        {
            $('.divhide').show();
        }
        else{
            $('.divhide').hide();
        }
    });

    $(document).off('keyup','#paidamount');
    $(document).on('keyup','#paidamount',function(e){
    var curval=parseFloat($(this).val());
    var tobepaid=parseFloat($('#tobepaid').text());
    var labelrem=parseFloat($('#labelrem').text());
    // alert(tobepaid);
    // return false;
    var subval=tobepaid-curval;
    $('#labelrem').html(subval);

    });
    
    </script>