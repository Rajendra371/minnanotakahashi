@php($data=$data['data'])
<?php
if($data['gender']->gender_id=='1'){
      $male_checked="checked";
      $female_checked="disabled";
      $fullcash=$data['checkup']->male_price;
}else{
      $male_checked="disabled";
      $female_checked="checked";
      $fullcash=$data['checkup']->female_price;
}

?>
<form method="post" class="form-horizontal" id="general_checkupForm" action="api/examination/checkup_store" style="border: 1px solid #ddd;">
      <h5 class="navtab_header">Charge of General Checkup </h5>
      <div class="invoice-section">
      <input
            type="hidden"
            name="id"
            id="id"
            value=""
            />
      <input
            type="hidden"
            name="checkup_type_id"
            id="checkup_type_id"
            value="1"
            />
      <input
            type="hidden"
            name="person_id"
            id="person_id"
            value="{{$data['person_id']}}"
            />
      <input
            type="hidden"
            id="gender"
            value="{{$data['gender']->gender_id}}"
            disabled
            />
      <div class="row">
            <div class="col-md-3 col-sm-3">
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
            <div class="col-md-3 col-sm-3">
            <div class="form-group">
                  <label>Date:</label>
                  <Input
                  type="text"
                  name="paymentdatead"
                  value="{{CURDATE_EN}}"
                  class="form-control"
                  readonly
                  />
            </div>
            </div>
            <div class="col-md-3 col-sm-3">
                  <h6>Male(Price:{{$data['checkup']->male_price}})</h6>
                  <input
                  type="radio"
                  name="male_amount"
                  id="male_amount"
                  value="{{$data['checkup']->male_price}}"
                  {{$male_checked}}
                  />
                  </div>
                  <div class="col-md-3 col-sm-3">
                  <h6> Female(Price:{{$data['checkup']->female_price}})</h6>
                  <input
                  type="radio"
                  name="female_amount"
                  id="female_amount"
                  value="{{$data['checkup']->female_price}}"
                  {{$female_checked}}
                  />
                  </div>

      </div>
      </div>
      <div class="payment_wrapper">
            <h5>Payment Mode</h5>
            <div class="row input-custom">
            <div class="col-md-12 col-sm-12" style="margin-bottom:10px;">
                  <span style="font-size: 13px;font-weight: 600;">Cash :<span>
                  <input
                  type="radio"
                  name="payment_mode"
                  value="1"
                  class="required_field payment_mode"
                  checked
                  />
                  &nbsp;&nbsp;&nbsp;&nbsp; 
                  <span style="font-size: 13px;font-weight: 600;">Credit :</span>
                  <input
                  type="radio"
                  name="payment_mode"
                  class="required_field payment_mode"
                  value="2"
                  />
            </div>
            </div>
            <div class="cash">
            <div class="row">
                  <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                        <span style="font-size: 13px;font-weight: 600;margin-bottom:10px;display:block;">Full Paid Amount:</span>
                        <input
                        type="text"
                        name="person_full_paid_amount"
                        id="person_full_paid_amount"
                        placeholder="Amount Paid By Person........."
                        value="{{$fullcash}}"
                        class="form-control"
                        readonly
                        />
                  </div>
                  </div>
            </div>
            </div>
            <div class="credit" style="display:none">
            <div class="row">
                  <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                        <span style="font-size: 13px;font-weight: 600;margin-bottom:10px;display:block;">Paid Amount:</span>
                        <input
                        type="text"
                        name="person_paid_amount"
                        id="person_paid_amount"
                        placeholder="Amount Paid By Person........."
                        value=""
                        class="form-control number_to_word"
                        data-targetdiv='number_to_word'
                        autocomplete="off"
                        />
                  </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                        <span style="font-size: 13px;font-weight: 600;margin-bottom:10px;display:block;">Due Amount:</span>
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
            <div><span class="number_to_word"></span></div>
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
      <div class="alert-success success"></div>
      <div class="alert-danger error" ></div>
</form>
<div class="printTable">
      <div class="print_report_section"></div>
</div>
</div>
<script>
$(document).off("keyup", "#person_paid_amount");
      $(document).on("keyup", "#person_paid_amount", function() {
            $('.person_due_amount').css('display','block');
            var total_male = $("#male_amount").val();
            var total_female = $("#female_amount").val();
            var partial =$('#person_paid_amount').val();
            var gender = $("#gender").val();
            if(gender=='1'){
            var amount = checkValidValue(total_male, 'male_amount');
            }else{
            var amount = checkValidValue(total_female, 'female_amount');
            }
            var discount = checkValidValue(partial, 'person_paid_amount');
            var data = parseFloat(amount) - parseFloat(discount);
            var person_due_amount = parseFloat(data).toFixed(2);
            $("#person_due_amount").val(person_due_amount);
      });
      $(document).off('change','.payment_mode');
      $(document).on('change','.payment_mode',function(e) {
            if (this.value == '1') {
                  var total_male = $("#male_amount").val();
                  var total_female = $("#female_amount").val();
                  var gender = $("#gender").val();
                  if(gender=='1'){
                        var total = checkValidValue(total_male, 'male_amount');
                  }else{
                        var total = checkValidValue(total_female, 'female_amount');
                  }
                  $("#person_full_paid_amount").val(total);
                  $('.credit').hide();
                  $('.cash').show();
            }
            else if (this.value == '2') {
                  var total_male = $("#male_amount").val();
                  var total_female = $("#female_amount").val();
                  var gender = $("#gender").val();
                  if(gender=='1'){
                        var total = checkValidValue(total_male, 'male_amount');
                  }else{
                        var total = checkValidValue(total_female, 'female_amount');
                  }
                  $("#person_due_amount").val(total);
                  $('#person_paid_amount').focus();
                  $('.credit').show();
                  $('.cash').hide();
            
            }
      });
      
</script>