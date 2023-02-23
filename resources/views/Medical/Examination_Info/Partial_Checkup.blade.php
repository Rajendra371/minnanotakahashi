@php($data=$data['data'])
<form method="post" class="form-horizontal" id="partail_checkupForm" action="api/examination/checkup_store">
  <h5 class="navtab_header">Partial Checkup </h5>
<div class="invoice-section">
        <input
        type="hidden"
        name="id"
        id="id"
        value=""
        />
        <input
        type="hidden"
        name="person_id"
        id="person_id"
        value="{{$data['person_id']}}"
        />
        <input
            type="hidden"
            name="checkup_type_id"
            id="checkup_type_id"
            value="3"
            />
    <div class="row">
       <div class="col-md-4 col-sm-4">
          <div class="form-group">
             <label>Invoice No :</label>
             <input
                type="text"
                name="invoice_no"
                value="{{$data['invoice']}}"
                class="form-control"
                readonly
                />
          </div>
       </div>
       <div class="col-md-4 col-sm-4">
          <div class="form-group">
             <label>Date:</label>
             <Input
                type="text"
                value="{{CURDATE_EN}}"
                class="form-control"
                name="paymentdatead"
                readonly
                />
          </div>
       </div>
    </div>
 </div>
 <div class="clear"></div>
 <div class="exam-table">
 <div class="row">
    <div class="col-md-6">
       <div class="exam-table-wrapper">
          <table class="" border="1">
             <?= $data['exam']; ?>
          </table>
          <div class="clear"></div>
       </div>
    </div>
    <div class="col-md-6">
       <div class="examTableResult-wrapper">
       <div class="row">
          <div class="col-md-12">
             <div class="form-group">
                Sub Total:
                <input type="text" name="sub_total" id="amount" class="form-control" readonly />
             </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
                <label>Discount(In Amount):</label>
                <input type="text" id="dis_amount" name="dis_amount" class="form-control" />
             </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
                <label>Discount(%):</label>
                <input type="text" id="dis_per" name="dis_per" class="form-control" tabindex="-1" max="100" min="0"/>
                <input type="hidden" id="amount_discount" name="amount_discount" />
             </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
                <label>Grand Total:</label>
                <input type="text" id="grand_total" class="form-control required_field" name="amount" readonly/>
                {{-- <input type="text" id="grand_total" class="form-control" name="grand_total" onChange="word.innerHTML=convertNumberToWords(this.value)" readonly/> --}}
             </div>
          </div>
       </div>
       <div class="information-item">
          {{-- <h4>Total Amount:</h4>
          <div id="word"></div> --}}
          <h5>Payment Mode</h5>
          <div class="row input-custom">
             <div class="col-md-12 col-sm-12">
                 Cash :
                <input
                   type="radio"
                   name="payment_mode"
                   id="payment_mode"
                   value="1"
                   />
                &nbsp;&nbsp;&nbsp;&nbsp; Credit :
                <input
                   type="radio"
                   name="payment_mode"
                   id="payment_mode"
                   value="2"
                   />
             </div>
          </div>
          <div class="cash" style="display:none">
             <div class="row">
                <div class="col-md-6 col-sm-12">
                    <div class="person_full_paid_amount">
                    <div class="form-group">
                        <Label>Full Amount:</Label>
                        <input
                            type="text"
                            name="person_full_paid_amount"
                            id="person_full_paid_amount"
                            class="form-control"
                            readonly
                            />
                        </div>
                    </div>
                </div>
             </div>
          </div>
          <div class="credit" style="display:none">
             <div class="row">
                <div class="col-md-6 col-sm-12">
                        <div class="person_paid_amount">
                    <div class="form-group">
                    <Label>Paid Amount:</Label>
                    <input
                        type="text"
                        name="person_paid_amount"
                        id="person_paid_amount"
                        placeholder="Amount Paid By Person........."
                        value=""
                        class="form-control"
                        />
                    </div>
                </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="person_due_amount">
                    <div class="form-group">
                        <Label>Due Amount:</Label>
                        <input
                            type="text"
                            name="person_due_amount"
                            id="person_due_amount"
                            value=""
                            class="form-control"
                            readonly
                            />
                    </div>
                        </div>
                    </div>
             </div>
             
             </div>
          </div>
          {{-- <h5>Cash Payment</h5> --}}
          <div>
              {{-- <div class="row">
               <div class="col-md-6 col-sm-12">
                   <div class="form-group">
                      <Label>Cash Paid:</Label>
                      <input
                         type="text"
                         name="cash_paid"
                         id="cash_paid"
                         placeholder="Cash Paid"
                         value=""
                         class="form-control"
                         />
                   </div>
                </div>
                <div class="col-md-6 col-sm-12">
                   <div class="form-group">
                      <Label>Cash Return:</Label>
                      <input
                         type="text"
                         name="return_amount"
                         id="return_amount"
                         value=""
                         class="form-control"
                         readonly
                         />
                   </div>
                </div>
             </div> --}}
             <div class="clearfix">
                <div class="examResult-submit">
                   <button
                      type="submit"
                      size="md"
                      color="primary"
                      class="save btn btn-primary btn-md"
                      >
                   <i class="fa fa-dot-circle-o"></i> Save
                   </button>
                   &nbsp;&nbsp;&nbsp;
                   <button
                      type="submit"
                      size="md"
                      color="primary"
                      class="save btn btn-primary btn-md"
                      data-operation='save' data-print="print"
                      >
                   <i class="fa fa-dot-circle-o"></i> Save & Print
                   </button>
                </div>
             </div>
          </div>
          </div>
       </div>
    </div>
 </div>
</div>
<div class="alert-success success"></div>
<div class="alert-danger error" ></div>
</form>
<div class="printTable">
   <div class="print_report_section"></div>
</div>
</div>
<script>
 $(document).ready(function() {
     $('input:radio[name=payment_mode]').change(function() {
         if (this.value == '1') {
            var total = $("#grand_total").val();
            $("#person_full_paid_amount").val(total);
            $('.credit').css('display','none');
             $('.cash').css('display','block');
         }
         else if (this.value == '2') {
            var total = $("#grand_total").val();
            $("#person_due_amount").val(total);
            $('.credit').css('display','block');
             $('.cash').css('display','none');
         }
     });
 });
 
 $(document).off("keyup", "#dis_per");
 $(document).on("keyup", "#dis_per", function() {
       var amount_id = $("#amount").val();
       var dis_per =$('#dis_per').val();
       var amount = checkValidValue(amount_id, 'amount');
       var discount = checkValidValue(dis_per, 'dis_per');
       var data = parseFloat(amount) - (parseFloat(amount) * parseFloat(discount) * 1) / 100;
       var total = parseFloat(data).toFixed(2);
       var discount_amt=(parseFloat(amount) * parseFloat(discount) * 1) / 100;
       var total_discount_amt = parseFloat(discount_amt).toFixed(2);
       $("#amount_discount").val(total);
       $("#grand_total").val(total);
       $("#dis_amount").val(total_discount_amt);
 });
 
 $(document).off("keyup", "#dis_amount");
 $(document).on("keyup", "#dis_amount", function() {
     var amount_id = $("#amount").val();
         var discount_amt =$('#dis_amount').val();
         var amount = checkValidValue(amount_id, 'amount');
         var discount= checkValidValue(discount_amt,'dis_amount');
         var data = parseFloat(amount) - parseFloat(discount);
         var total = parseFloat(data).toFixed(2);
         var dis_per=(parseFloat(discount)/parseFloat(amount))*100;
         var total_dis_per=parseFloat(dis_per).toFixed(2);
         $("#amount_discount").val(total);
         $("#grand_total").val(total);
         $("#dis_per").val(total_dis_per);
 });
 
//  $(document).off("keyup", "#vat_id");
//  $(document).on("keyup", "#vat_id", function() {
//        var amount_discount = $("#amount_discount").val();
//        var amount = checkValidValue(amount_discount, 'amount_discount');
//        if(amount=='0'&&amount==''){
//           var amount_id = $("#amount").val();
//           var amount = checkValidValue(amount_id, 'amount');
//        }
//        var vat_per =$('#vat_id').val();
//        var vat = checkValidValue(vat_per, 'vat_id');
//        if(vat!='0'){
//        var data = parseFloat(amount) + parseFloat((amount * vat/100));
//        var total = parseFloat(data).toFixed(2);
//        $("#amount_vat").val(total);
//        $("#grand_total").val(total);
//        }else{
//           $("#amount_vat").val(0);
//           $("#grand_total").val(amount);
//        }
//        // $('#dis_amount').keyup();
//  });
 
 $(document).off("click", "#total_amount,#checkall");
 $(document).on("click", "#total_amount,#checkall", function() {
        setTimeout(function() {
        var amount_id = $("#amount").val();
        var amount = checkValidValue(amount_id, 'amount');
        var discount_amt =$('#dis_amount').val();
       if(discount_amt=='' || discount_amt=='NaN'){
          discount_amt=0;
       }
        var dis_per =$('#dis_per').val();
       if(dis_per=='' || dis_per=='NaN'){
          dis_per=0;
       }
       $('#dis_amount').keyup();
       if(discount_amt==0 && dis_per==0){
          $("#grand_total").val(amount);
       }
       }, 500);
 });
 
 $(document).off("keyup", "#person_paid_amount");
 $(document).on("keyup", "#person_paid_amount", function() {
       $('.person_due_amount').css('display','block');
       var total = $("#grand_total").val();
       var partial =$('#person_paid_amount').val();
       var amount = checkValidValue(total, 'grand_total');
       var discount = checkValidValue(partial, 'person_paid_amount');
       var data = parseFloat(amount) - parseFloat(discount);
       var person_due_amount = parseFloat(data).toFixed(2);
       $("#person_due_amount").val(person_due_amount);
 });
 
 $(document).off("keyup", "#cash_paid");
 $(document).on("keyup", "#cash_paid", function() {
       var total = $("#grand_total").val();
       var paid =$('#cash_paid').val();
       var partial =$('#person_paid_amount').val();
       var person_paid_amount = checkValidValue(partial, 'person_paid_amount');
       var amount = checkValidValue(total, 'grand_total');
       var cash_paid = checkValidValue(paid, 'cash_paid');
       var data =parseFloat(cash_paid) - parseFloat(amount);
       var data1 =parseFloat(cash_paid) - parseFloat(person_paid_amount);
       var return_amount = parseFloat(data).toFixed(2);
       var return_amount1 = parseFloat(data1).toFixed(2);
       if(cash_paid=='0'){
             $("#return_amount").val(0);
       }else{
          if(partial!='0'){
             $("#return_amount").val(return_amount1);
          }else{
             $("#return_amount").val(return_amount);
          }
       }
 });

//  $(document).off('click','.chckparent');
//  $(document).on('click','.chckparent',function(e){
// var  pid=$(this).data('id');
// if (this.checked) {
//             $('.examination_'+pid).each(function() {
//                 this.checked=true;
//                //  $('.check_all').click();
//             });
//         } else {
//             $('.examination_'+pid).each(function() {
//                 this.checked=false;
//                //  $('.check_all').click();
//             });
//         }
//   });
</script>