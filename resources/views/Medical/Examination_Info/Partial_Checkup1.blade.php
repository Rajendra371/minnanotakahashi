<style>
    .cash , .cheque, .full_payment, .partial_payment,.remaining_amount{
    display:none;
    }
</style>
@php($data=$data['data'])
<form method="post" class="form-horizontal" id="examinationForm" action="api/examination/store">
  <h5 class="navtab_header">Charge of Partial Checkup </h5>
<div class="invoice-section">
    <div class="row">
       <div class="col-md-4 col-sm-4">
          <div class="form-group">
             <label>Invoice No :</label>
             <input
                type="text"
                name="inovoice_no"
                value="{{$data['invoice']}}"
                class="disabled form-control"
                />
          </div>
       </div>
       <div class="col-md-4 col-sm-4">
          <div class="form-group">
             <label>Date:</label>
             <Input
                type="text"
                name="checkup_date"
                value="{{CURDATE_EN}}"
                class="disabled form-control"
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
       {{-- <div class="check inline">
             <div class="form-group">
                <input
                   class="form-check-input total_amount"
                   type="checkbox"
                   id="checkall"
                   value=""
                   />
                <label
                   class="form-check-label"
                   check
                   htmlFor="inline-checkbox"
                   >
                Select All
                </label>
             </div>
          </div> --}}
          <table class="exam_table" border="1">
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
                <input type="text" id="discount_amt_id" name="discount_amt_id" class="form-control" />
             </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
                <label>Discount:</label>
                <input type="text" id="discount_id" name="discount_id" class="form-control" tabindex="-1"/>
                <input type="hidden" id="amount_discount" name="amount_discount" />
             </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
                <label>Vat(13%):</label>
                <input type="text" name="vat_id" id="vat_id" class="form-control"/>
                <input type="hidden" name="amount_vat" id="amount_vat" />
             </div>
          </div>
          <div class="col-md-6">
             <div class="form-group">
                <label>Grand Total:</label>
                <input type="text" id="grand_total" class="form-control" name="grand_total" onChange="word.innerHTML=convertNumberToWords(this.value)" readonly/>
             </div>
          </div>
       </div>
       <div class="information-item">
          {{-- <h4>Total Amount:</h4>
          <div id="word"></div> --}}
          <h5>Payment Mode</h5>
          <div class="row payment_mode input-custom">
             <div class="col-md-12 col-sm-12">
                1) Cash :
                <input
                   type="radio"
                   name="payment_mode"
                   id="payment_mode"
                   value="1"
                   />
                &nbsp;&nbsp; 2) Credit :
                <input
                   type="radio"
                   name="payment_mode"
                   id="payment_mode"
                   value="2"
                   />
             </div>
          </div>
          {{-- <div class="creit">
             <div class="row">
                <div class="col-md-6 col-sm-12">
                   <div class="form-group">
                      <Label>Bank Name:</Label>
                      <input
                         type="text"
                         name="bank_name"
                         placeholder="Bank Name"
                         defaultValue=""
                         class="form-control"
                         />
                   </div>
                </div>
                <div class="col-md-6 col-sm-12">
                   <div class="form-group">
                      <Label>Bank Acc/no:</Label>
                      <input
                         type="text"
                         name="bank_accountno"
                         class="form-control"
                         placeholder="Account Number"
                         defaultValue=""
                         />
                   </div>
                </div>
             </div>
          </div> --}}
        
             {{-- <div class="row">
                <div class="col-md-6 col-sm-12">
                   <div class="form-group">
                      <Label>Payment:</Label>
                      <select
                         type="select"
                         name="payment_type"
                         id="payment_type"
                         class="form-control"
                         >
                         <option value=""> -- Select -- </option>
                         <option value="1"> Full </option>
                         <option value="2"> Partial</option>
                      </select>
                   </div>
                </div>
             </div> --}}
             <div class="cash">
                <div class="full_payment row">
                   <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                         <Label>Full Amount:</Label>
                         <input
                            type="text"
                            name="full_payment"
                            id="full_amount"
                            class="form-control"
                            readonly
                            />
                      </div>
                   </div>
                </div>
             </div>
                <div class="credit">
                <div class="partial_payment row">
                   <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                         <Label>Partial Amount:</Label>
                         <input
                            type="text"
                            name="partial_payment"
                            id="partial_amount"
                            placeholder="Partial Amount"
                            defaultValue=""
                            class="form-control"
                            />
                      </div>
                   </div>
                </div>
                <div class="remaining_amount row">
                   <div class="col-md-6 col-sm-12">
                      <div class="form-group">
                         <Label>Remaining Amount:</Label>
                         <input
                            type="text"
                            name="remaining_amount"
                            id="remaining_amount"
                            defaultValue=""
                            class="form-control"
                            readonly
                            />
                      </div>
                   </div>
                </div>
             </div>
             </div>
          <h5>Cash Payment</h5>
          <div>
             <div class="row">
                <div class="col-md-6 col-sm-12">
                   <div class="form-group">
                      <Label>Cash Paid:</Label>
                      <input
                         type="text"
                         name="paid_cash"
                         id="paid_cash"
                         placeholder="Cash Paid"
                         defaultValue=""
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
                         defaultValue=""
                         class="form-control"
                         readonly
                         />
                   </div>
                </div>
             </div>
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
</form>

<div  id="printTable" class="print_report_section printTable">
</div>
<script>
 $(document).ready(function() {
     $('input:radio[name=payment_mode]').change(function() {
         if (this.value == '1') {
            $('.credit').css('display','block');
             $('.cash').css('display','none');
         }
         else if (this.value == '2') {
            $('.credit').css('display','none');
             $('.cash').css('display','block');
         }
     });
 });
 
 $('select').on('change', function() {
    if (this.value == '1') {
             $('.full_payment').css('display','block');
             $('.partial_payment').css('display','none');
             $('.remaining_amount').css('display','none');
             var full_amount=$("#grand_total").val();
             $('#full_amount').val(full_amount);
              $("#partial_amount").val(0);
         }
         else if (this.value == '2') {
             $('.full_payment').css('display','none');
             $('.partial_payment').css('display','block');
         }
 });
 
 $(document).off("keyup", "#discount_id");
 $(document).on("keyup", "#discount_id", function() {
       var amount_id = $("#amount").val();
       var discount_id =$('#discount_id').val();
       var amount = checkValidValue(amount_id, 'amount');
       var discount = checkValidValue(discount_id, 'discount_id');
       var data = parseFloat(amount) - (parseFloat(amount) * parseFloat(discount) * 1) / 100;
       var total = parseFloat(data).toFixed(2);
       var discount_amt=(parseFloat(amount) * parseFloat(discount) * 1) / 100;
       var total_discount_amt = parseFloat(discount_amt).toFixed(2);
       $("#amount_discount").val(total);
       $("#grand_total").val(total);
       $("#discount_amt_id").val(total_discount_amt);
       $('#vat_id').keyup();
       $('#vat_id').select().focus();
 });
 
 $(document).off("keyup", "#discount_amt_id");
 $(document).on("keyup", "#discount_amt_id", function() {
     var amount_id = $("#amount").val();
         var discount_amt =$('#discount_amt_id').val();
         var amount = checkValidValue(amount_id, 'amount');
         var discount= checkValidValue(discount_amt,'discount_amt_id');
         var data = parseFloat(amount) - parseFloat(discount);
         var total = parseFloat(data).toFixed(2);
         var dis_per=(parseFloat(discount)/parseFloat(amount))*100;
         var total_dis_per=parseFloat(dis_per).toFixed(2);
         $("#amount_discount").val(total);
         $("#grand_total").val(total);
         $("#discount_id").val(total_dis_per);
         $('#vat_id').keyup();
 });
 
 $(document).off("keyup", "#vat_id");
 $(document).on("keyup", "#vat_id", function() {
       var amount_discount = $("#amount_discount").val();
       var amount = checkValidValue(amount_discount, 'amount_discount');
       if(amount=='0'&&amount==''){
          var amount_id = $("#amount").val();
          var amount = checkValidValue(amount_id, 'amount');
       }
       var vat_per =$('#vat_id').val();
       var vat = checkValidValue(vat_per, 'vat_id');
       if(vat!='0'){
       var data = parseFloat(amount) + parseFloat((amount * vat/100));
       var total = parseFloat(data).toFixed(2);
       $("#amount_vat").val(total);
       $("#grand_total").val(total);
       }else{
          $("#amount_vat").val(0);
          $("#grand_total").val(amount);
       }
       // $('#discount_amt_id').keyup();
 });
 
//  $(document).off("click", "#total_amount,#checkall");
//  $(document).on("click", "#total_amount,#checkall", function() {
//         setTimeout(function() {
//         var amount_id = $("#amount").val();
//         var amount = checkValidValue(amount_id, 'amount');
//          var discount_amt =$('#discount_amt_id').val();
//        if(discount_amt==''){
//           discount_amt=0;
//        }
//          var discount_id =$('#discount_id').val();
//        if(discount_id==''){
//           discount_id=0;
//        }
//          var vat_per =$('#vat_id').val();
//            if(vat_per==''){
//           vat_per=0;
//        }
//        $('#discount_amt_id').keyup();
//        $('#vat_id').keyup();
//        if(discount_amt==0 && discount_id==0 && vat_per==0){
//           $("#grand_total").val(amount);
//        }
//        }, 500);
//  });
 
 $(document).off("keyup", "#partial_amount");
 $(document).on("keyup", "#partial_amount", function() {
       $('.remaining_amount').css('display','block');
       var total = $("#grand_total").val();
       var partial =$('#partial_amount').val();
       var amount = checkValidValue(total, 'grand_total');
       var discount = checkValidValue(partial, 'partial_amount');
       var data = parseFloat(amount) - parseFloat(discount);
       var remaining_amount = parseFloat(data).toFixed(2);
       $("#remaining_amount").val(remaining_amount);
 });
 
 $(document).off("keyup", "#paid_cash");
 $(document).on("keyup", "#paid_cash", function() {
       var total = $("#grand_total").val();
       var paid =$('#paid_cash').val();
       var partial =$('#partial_amount').val();
       var partial_amount = checkValidValue(partial, 'partial_amount');
       var amount = checkValidValue(total, 'grand_total');
       var cash_paid = checkValidValue(paid, 'paid_cash');
       var data =parseFloat(cash_paid) - parseFloat(amount);
       var data1 =parseFloat(cash_paid) - parseFloat(partial_amount);
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
 
//  function convertNumberToWords(amount) {
//      var words = new Array();
//      words[0] = '';
//      words[1] = 'One';
//      words[2] = 'Two';
//      words[3] = 'Three';
//      words[4] = 'Four';
//      words[5] = 'Five';
//      words[6] = 'Six';
//      words[7] = 'Seven';
//      words[8] = 'Eight';
//      words[9] = 'Nine';
//      words[10] = 'Ten';
//      words[11] = 'Eleven';
//      words[12] = 'Twelve';
//      words[13] = 'Thirteen';
//      words[14] = 'Fourteen';
//      words[15] = 'Fifteen';
//      words[16] = 'Sixteen';
//      words[17] = 'Seventeen';
//      words[18] = 'Eighteen';
//      words[19] = 'Nineteen';
//      words[20] = 'Twenty';
//      words[30] = 'Thirty';
//      words[40] = 'Forty';
//      words[50] = 'Fifty';
//      words[60] = 'Sixty';
//      words[70] = 'Seventy';
//      words[80] = 'Eighty';
//      words[90] = 'Ninety';
//      amount = amount.toString();
//      var atemp = amount.split(".");
//      var number = atemp[0].split(",").join("");
//      var n_length = number.length;
//      var words_string = "";
//      if (n_length <= 9) {
//          var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
//          var received_n_array = new Array();
//          for (var i = 0; i < n_length; i++) {
//              received_n_array[i] = number.substr(i, 1);
//          }
//          for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
//              n_array[i] = received_n_array[j];
//          }
//          for (var i = 0, j = 1; i < 9; i++, j++) {
//              if (i == 0 || i == 2 || i == 4 || i == 7) {
//                  if (n_array[i] == 1) {
//                      n_array[j] = 10 + parseInt(n_array[j]);
//                      n_array[i] = 0;
//                  }
//              }
//          }
//          value = "";
//          for (var i = 0; i < 9; i++) {
//              if (i == 0 || i == 2 || i == 4 || i == 7) {
//                  value = n_array[i] * 10;
//              } else {
//                  value = n_array[i];
//              }
//              if (value != 0) {
//                  words_string += words[value] + " ";
//              }
//              if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
//                  words_string += "Crores ";
//              }
//              if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
//                  words_string += "Lakhs ";
//              }
//              if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
//                  words_string += "Thousand ";
//              }
//              if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
//                  words_string += "Hundred and ";
//              } else if (i == 6 && value != 0) {
//                  words_string += "Hundred ";
//              }
//          }
//          words_string = words_string.split("  ").join(" ").concat(' Only ');
//      }
//      return words_string;
//  }
</script>