<div class="form-group general_info white-box pad-5">
<form method="post" class="form-horizontal" id="orientationForm" action="api/orientation/store">
   @if(!empty($data['personal_data']))
   @php($data=$data['personal_data'])
   <input
      type="hidden"
      name="per_id"
      id="per_id"
      value="{{$data->id}}"
      />
   <input
      type="hidden"
      name="person_id"
      id="person_id"
      value="{{$data->personal_id}}"
      />
   <div class="row exam_detail">
      <div class="col-md-4 col-sm-4">
         <label>Personal ID :</label>
         <span>{{$data->personal_id}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>First Name :</label>
         <span>{{$data->first_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Father Name :</label>
         <span>{{$data->father_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Mother Name:</label>
         <span>{{$data->mother_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Grandfather Name :</label>
         <span>{{$data->grandfather_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Date of Birth:</label>
         <span>{{$data->birth_datebs}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Nationality:</label>
         <span>{{$data->nationality}}</span>
      </div>
   </div>
   @endif
   <div class="row">
      <div class="col-md-4 col-sm-4">
         <label>Invoice No :</label>
         <input
            type="text"
            name="inovoice_no"
            value="{{$invoice}}"
            class="disabled"
            />
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Date:</label>
         <Input
            type="text"
            name="checkup_date"
            value="{{EngToNepDateConv(CURDATE_EN)}}"
            class="disabled"
            />
      </div>
   </div>
     <h5>Orientation</h5>
   <div class="row">
      <div class="col-md-4 col-sm-4">
         <label>Start Date:</label>
         <Input
            type="text"
            name="orientation_startdatebs"
            id="orientation_startdatebs"
            class="datepicker"
            value="{{EngToNepDateConv(CURDATE_EN)}}"
            />
      </div>
         <div class="col-md-4 col-sm-4">
         <label>End Date:</label>
         <Input
            type="text"
            name="orientation_enddatebs"
            id="orientation_enddatebs"
            class="datepicker"
            value="{{EngToNepDateConv(CURDATE_EN)}}"
            />
      </div>
      </div>
      <div class="row">
      <div class="col-md-4 col-sm-4">
         <label>Start Time:</label>
         <Input
            type="text"
            name="orientation_starttime"
            id="orientation_starttime"
            class="timepicker"
            value=""
            />
      </div>

      <div class="col-md-4 col-sm-4">
         <label>End Time:</label>
         <Input
            type="text"
            name="orientation_endtime"
            id="orientation_endtime"
            class="timepicker"
            value=""
            />
      </div>
   </div>
    <div class="row">
         <div class="col-md-4 col-sm-4">
            <Label>Duration:</Label>
            <input
               type="text"
               name="duration"
               placeholder="Duration"
               value=""
               />
         </div>
         </div>
   <div class="row input-custom">
    <label>Is Issue Certificate?:</label>
      <div class="col-md-4 col-sm-4">
         <div class="col-md-12 col-sm-12">
            1) Yes :
            <input
               type="radio"
               name="is_issue_certificate"
               id="is_issue_certificate"
               value="Y"
               />
            &nbsp;&nbsp; 2) No :
            <input
               type="radio"
               name="is_issue_certificate"
               id="is_issue_certificate"
               value="N"
               />
         </div>
      </div>
   </div>
      <div class="row">
      <div class="col-md-4 col-sm-4">
         <label>Issue Certificate Date:</label>
         <Input
            type="text"
            name="issue_certificate_datebs"
            id="issue_certificate_datebs"
            class="datepicker"
            value="{{EngToNepDateConv(CURDATE_EN)}}"
            />
      </div>
          <div class="col-md-4 col-sm-4">
         <label>Issue Certificate Time:</label>
         <Input
            type="text"
            name="issue_certificate_time"
            id="issue_certificate_time"
            class="timepicker"
            value=""
            />
      </div>
   </div>
   <div class="row">
   <table style="border:1,marginTop: -5px">
      <tbody>
         <tr>
            <td style="border:0, background: #dddddd">
               <div class="pull-right">
                  <label>Sub Total:</label>
                  <input type="text" name="sub_total" id="amount"  />
                  <label>Discount(In Amount):</label>
                  <input type="text" id="discount_amt_id" name="discount_amt_id" />
                  <label>Discount:</label>
                  <input type="text" id="discount_id" name="discount_id" />
                  <input type="hidden" id="amount_discount" name="amount_discount" />
                  <label>Vat(13%):</label>
                  <input type="text" name="vat_id" id="vat_id"/>
                  <input type="hidden" name="amount_vat" id="amount_vat" />
                  <label>Grand Total:</label>
                  <input type="text" id="grand_total" name="grand_total" onkeyup="word.innerHTML=convertNumberToWords(this.value)"/>
               </div>
            </td>
         </tr>
      </tbody>
   </table>
   </div>
    <h5>Amount In Word</h5>
    <div id="word"></div>
   <h5>Payment Mode</h5>
   <div class="row payment_mode input-custom">
      <div class="col-md-4 col-sm-4">
         <div class="col-md-12 col-sm-12">
            1) Cheque :
            <input
               type="radio"
               name="payment_mode"
               id="payment_mode"
               value="1"
               />
            &nbsp;&nbsp; 2) Cash :
            <input
               type="radio"
               name="payment_mode"
               id="payment_mode"
               value="2"
               />
         </div>
      </div>
   </div>
   <div class="cheque">
      <div class="row">
         <div class="col-md-4 col-sm-4">
            <Label>Bank Name:</Label>
            <input
               type="text"
               name="bank_name"
               placeholder="Bank Name"
               defaultValue=""
               />
         </div>
         <div class="col-md-4 col-sm-4">
            <Label>Bank Acc/no:</Label>
            <input
               type="text"
               name="bank_accountno"
               placeholder="Account Number"
               defaultValue=""
               />
         </div>
      </div>
   </div>
   <div class="cash">
      <div class="row">
         <div class="col-md-4 col-sm-4">
            <Label>Payment:</Label>
            <select
               type="select"
               name="payment_type"
               id="payment_type"
               >
               <option value=""> -- Select -- </option>
               <option value="1"> Full </option>
               <option value="2"> Partial</option>
            </select>
         </div>
      </div>
      <div>
         <div class="full_payment row">
            <div class="col-md-4 col-sm-4">
               <Label>Full Amount:</Label>
               <input
                  type="text"
                  name="full_payment"
                  id="full_amount"
                  />
            </div>
         </div>
      </div>
      <div>
         <div class="partial_payment row">
            <div class="col-md-4 col-sm-4">
               <Label>Partial Amount:</Label>
               <input
                  type="text"
                  name="partial_payment"
                  id="partial_amount"
                  placeholder="Partial Amount"
                  defaultValue=""
                  />
            </div>
         </div>
         <div class="remaining_amount row">
            <div class="col-md-4 col-sm-4">
               <Label>Remaining Amount:</Label>
               <input
                  type="text"
                  name="remaining_amount"
                  id="remaining_amount"
                  defaultValue=""
                  />
            </div>
         </div>
      </div>
   </div>
   <h5>Cash Payment</h5>
   <div>
   <div class="row">
      <div class="col-md-4 col-sm-4">
         <Label>Cash Paid:</Label>
         <input
            type="text"
            name="paid_cash"
            id="paid_cash"
            placeholder="Cash Paid"
            defaultValue=""
            />
      </div>
      <div class="col-md-4 col-sm-4">
         <Label>Cash Return:</Label>
         <input
            type="text"
            name="return_amount"
            id="return_amount"
            defaultValue=""
            />
      </div>
   </div>
   <div class="clearfix">
      <div class="float-left">
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
</form>
<div  id="printTable" class="print_report_section printTable">
<script>
   $(document).ready(function() {
       $('input:radio[name=payment_mode]').change(function() {
           if (this.value == '1') {
               $('.cheque').css('display','block');
               $('.cash').css('display','none');
           }
           else if (this.value == '2') {
               $('.cheque').css('display','none');
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
           $("#amount_in_word").html(total);
           $("#discount_id").val(total_dis_per);
   });
   
   $(document).off("keyup", "#vat_id");
   $(document).on("keyup", "#vat_id", function() {
          var amount = $("#amount_discount").val();
           if(amount=='0'&&amount==''){
             var amount_id = $("#amount").val();
             var amount = checkValidValue(amount_id, 'amount');
           }
           var vat_per =$('#vat_id').val();
           var vat = checkValidValue(vat_per, 'vat_id');
           var data = parseFloat(amount) + parseFloat((amount * vat/100));
           var total = parseFloat(data).toFixed(2);
           $("#amount_vat").val(total);
           $("#grand_total").val(total);
   });
   
   $(document).off("click", "#total_amount");
   $(document).on("click", "#total_amount", function() {
          setTimeout(function() {
          var amount_id = $("#amount").val();
          var amount = checkValidValue(amount_id, 'amount');
           var discount_amt =$('#discount_amt_id').val();
         if(discount_amt==''){
            discount_amt=0;
         }
           var discount_id =$('#discount_id').val();
         if(discount_id==''){
            discount_id=0;
         }
           var vat_per =$('#vat_id').val();
             if(vat_per==''){
            vat_per=0;
         }
           if(discount_amt==0 && discount_id==0 && vat_per==0){
             $("#grand_total").val(NumberToWord(amount));
           }
           }, 500);
   });
   
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
           var amount = checkValidValue(total, 'grand_total');
           var cash_paid = checkValidValue(paid, 'paid_cash');
           var data =  parseFloat(cash_paid) - parseFloat(amount);
           var return_amount = parseFloat(data).toFixed(2);
           $("#return_amount").val(return_amount);
   });

   $(document).ready(function(){
$('.timepicker').timepicker({
    timeFormat: 'h:mm p',
    interval: 60,
    minTime: '10',
    maxTime: '6:00pm',
    defaultTime: '11',
    startTime: '10:00',
    dynamic: false,
    dropdown: true,
    scrollbar: true
});
});
$(document).ready(function(){
    $(".datepicker").nepaliDatePicker({
    npdMonth: true,
    npdYear: true,
    npdYearCount: 10 // Options | Number of years to show
    });
});

function convertNumberToWords(amount) {
    var words = new Array();
    words[0] = '';
    words[1] = 'One';
    words[2] = 'Two';
    words[3] = 'Three';
    words[4] = 'Four';
    words[5] = 'Five';
    words[6] = 'Six';
    words[7] = 'Seven';
    words[8] = 'Eight';
    words[9] = 'Nine';
    words[10] = 'Ten';
    words[11] = 'Eleven';
    words[12] = 'Twelve';
    words[13] = 'Thirteen';
    words[14] = 'Fourteen';
    words[15] = 'Fifteen';
    words[16] = 'Sixteen';
    words[17] = 'Seventeen';
    words[18] = 'Eighteen';
    words[19] = 'Nineteen';
    words[20] = 'Twenty';
    words[30] = 'Thirty';
    words[40] = 'Forty';
    words[50] = 'Fifty';
    words[60] = 'Sixty';
    words[70] = 'Seventy';
    words[80] = 'Eighty';
    words[90] = 'Ninety';
    amount = amount.toString();
    var atemp = amount.split(".");
    var number = atemp[0].split(",").join("");
    var n_length = number.length;
    var words_string = "";
    if (n_length <= 9) {
        var n_array = new Array(0, 0, 0, 0, 0, 0, 0, 0, 0);
        var received_n_array = new Array();
        for (var i = 0; i < n_length; i++) {
            received_n_array[i] = number.substr(i, 1);
        }
        for (var i = 9 - n_length, j = 0; i < 9; i++, j++) {
            n_array[i] = received_n_array[j];
        }
        for (var i = 0, j = 1; i < 9; i++, j++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                if (n_array[i] == 1) {
                    n_array[j] = 10 + parseInt(n_array[j]);
                    n_array[i] = 0;
                }
            }
        }
        value = "";
        for (var i = 0; i < 9; i++) {
            if (i == 0 || i == 2 || i == 4 || i == 7) {
                value = n_array[i] * 10;
            } else {
                value = n_array[i];
            }
            if (value != 0) {
                words_string += words[value] + " ";
            }
            if ((i == 1 && value != 0) || (i == 0 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Crores ";
            }
            if ((i == 3 && value != 0) || (i == 2 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Lakhs ";
            }
            if ((i == 5 && value != 0) || (i == 4 && value != 0 && n_array[i + 1] == 0)) {
                words_string += "Thousand ";
            }
            if (i == 6 && value != 0 && (n_array[i + 1] != 0 && n_array[i + 2] != 0)) {
                words_string += "Hundred and ";
            } else if (i == 6 && value != 0) {
                words_string += "Hundred ";
            }
        }
        words_string = words_string.split("  ").join(" ").concat(' Only ');
    }
    return words_string;
}
</script>