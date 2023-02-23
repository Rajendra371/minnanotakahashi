<div class="position-relative row form-group">
<input name="id" type="hidden" class="form-control" value="{{$data->id}}">
        <div class="col-6 col-sm-6 col-md-6">
            <div class="form-with-btn">
                <label class="">Choose Category:<code>*</code></label>
                <div>
                    <?=$data['cat_id']?>
                    
                </div><a href="javascript:void(0)" class="view" data-url="api/income_exp_detail/add_new_category"><span style="float: right; position: relative; top: -23px; height: 29px; padding: 7px 0px 0px 12px; width: 35px; background: rgb(32, 168, 216); color: rgb(255, 255, 255); margin-bottom: -20px;">+</span></a></div>
        </div>
        <div class="col-6 col-sm-6 col-md-6">
            <label class="">Supplier/ Source:</label>
            <select name="supplierid" id="supplierid_0" data-id="0" class="supplierid form-control">
                <option value="">-- Select --</option>
                @if(!empty( $data['supplier_list']))
                   @foreach($data['supplier_list'] as $sup)
                <option value="{{$sup->id}}"@php($selected='')  @if($sup->id==$data->supplierid) @php($selected="selected=selected") {{$selected}} @endif >{{$sup->title}}</option>
                   @endforeach
                @endif
            </select>
        </div>
        <div class="col-6 col-sm-6 col-md-6">
            <label class="">Invoice No:</label>
        <input name="invoice_billno" id="invoice_billno" readonly="" type="text" class="form-control" value="{{$data->invoice_billno}}">
        </div>
        <div class="col-6 col-sm-6 col-md-6">
            <label class="">Bill No:</label>
        <input name="bill_no" id="bill_no" placeholder="Bill No." type="text" class="form-control" value="{{$data->bill_no}}">
        </div>
        <div class="col-6 col-sm-6 col-md-6">
            <label class="">Bill Date:</label>
        <input name="billdate" id="billdate" placeholder="Bill Date" autocomplete="off" type="text" class="datepicker form-control"  value="{{$data->billdatead}}">
        </div>
        <div class="col-12 col-sm-12 col-md-12">
            <label class="">Payment Mode:</label>
            <br>
            @php($payment_mode=$data->payment_mode)
            @if($payment_mode=='CA')
            @php($chk_ca="checked")
            @php( $chk_cr="")
            @php($chk_display="display:block")
            @else
            @php($chk_ca="")
            @php( $chk_cr="checked")
            @php($chk_display="display:none")
            @endif
            <input name="payment_mode" id="payment_mode_ca" type="radio" class="form-check-input paymenttype" value="CA" {{$chk_ca}}>Cash &nbsp;&nbsp;&nbsp;
            <input name="payment_mode" id="payment_mode_cr" type="radio" class="form-check-input paymenttype" value="CR" {{$chk_cr}}>Credit &nbsp;&nbsp;&nbsp;</div>
        <div class="col-6 col-sm-6 col-md-6">
            <label class="">Total Bill:</label>
            <input name="bill_amount" id="bill_amount" placeholder="Total Bill Amount" type="text" class="float form-control" value="{{$data->bill_amount}}">
        </div>
    <div id="divamountpaid" style="{{$chk_display}}"><div class="row"><div class="col-12 col-sm-12 col-md-12"><label class="">Amount Paid:</label><input name="amount" id="amount" placeholder="Paid Amount" type="text" class="float form-control" value={{$data->amount}}></div></div></div>

        <div class="col-12 col-sm-12 col-md-12">
            <label class="">Remarks:</label>
            <textarea name="remarks" placeholder="Remarks/ Material Names" class="form-control">{{$data->remarks}}</textarea>
        </div>
    </div>
    <div class="card-footer">
            <div class="clearfix">
                <div class="float-right">
                    <button type="submit" data-print="reloadid" data-targetid="invoice_billno" class="save btn btn-primary btn-md"><i class="fa fa-dot-circle-o"></i> Save</button> &nbsp;&nbsp;&nbsp;
                    <button type="button" class="btnreset btn btn-danger btn-md"><i class="fa fa-ban"></i> Reset</button>
                </div>
            </div>
            <div class="alert-success success"></div>
            <div class="alert-danger error"></div>
        </div>

        <script>
        $(document).on('change','.paymenttype',function(e){
           var ptype= $(this).val();
        //    alert(ptype);
            if(ptype=='CR')
            {
                $('#divamountpaid').hide();
            }
            if(ptype=='CA')
            {
                $('#divamountpaid').show();
            }
        })

        load_datepicker();
        </script>