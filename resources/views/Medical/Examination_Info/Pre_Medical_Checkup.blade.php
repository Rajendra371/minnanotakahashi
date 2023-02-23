@php($data=$data['data'])
<?php
if($data['gender']->gender_id=='1'){
      $male_checked="checked";
      $female_checked="disabled";
      $fullcash='';
}else{
      $male_checked="disabled";
      $female_checked="checked";
      $fullcash='';
}

?>
<form method="post" class="form-horizontal" id="general_checkupForm" action="api/examination/checkup_store" style="border: 1px solid #ddd;">
      <h5 class="navtab_header">Charge of Pre Medical Checkup </h5>
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
            value="4"
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
                  <h6>Male:</h6>
                  <input
                  type="radio"
                  name="male_amount"
                  id="male_amount"
                  value=""
                  {{$male_checked}}
                  />
            </div>
            <div class="col-md-3 col-sm-3">
                  <h6> Female:</h6>
                  <input
                  type="radio"
                  name="female_amount"
                  id="female_amount"
                  value=""
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
            </div>
            </div>
            <div class="credit">
            <div class="row">
                  <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                        <span style="font-size: 13px;font-weight: 600;margin-bottom:10px;display:block;">Paid Amount:</span>
                        <input
                        type="text"
                        name="person_paid_amount"
                        id="person_paid_amounts"
                        placeholder="Amount Paid By Person........."
                        value=""
                        class="form-control number_to_word "
                        data-targetdiv='number_to_word'
                        autocomplete="off"
                        />
                  </div>
                  </div>
                  <div class="col-md-6 col-sm-12">
                  <div class="form-group">
                    
                        <input
                        type="hidden"
                        name="person_due_amount"
                        id="person_due_amount0"
                        value="0"
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
