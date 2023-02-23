<div class="form-group general_info white-box pad-5">
        @if(!empty($data))

        <div>
           <h3 class="form_title">Detail Examination Information</h3>
        </div>
        <div class="row">
        <div class="col-md-4 col-sm-4">
              <label>Personal ID :</label>
              <span>{{$data->person_id}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>First Name :</label>
              @php($person=$data->person_id)
              @if(!empty($person))
              @php($result= get_tbl_data('first_name','personal_info',array('personal_id'=>$person)))
              <span>{{$result[0]->first_name}}</span>
              @else
              <span></span>
              @endif
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Inovoice No :</label>
              <span>{{$data->exma_inovoice_no}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Amount:</label>
              <span>{{$data->amount}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Discount(%):</label>
              <span>{{$data->dis_per}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Vat(%):</label>
              <span>{{$data->vat_per}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Grand Total:</label>
              <span>{{$data->grand_total}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Referrer :</label>
              <span>{{$data->referrer_id}}</span>
           </div>
        </div>
        <div>
           <h3 class="form_title">Payment Type</h3>
        </div>
        <div class="row">
           <div class="col-md-4 col-sm-4">
              <label>Payment Type :</label>
              <span>{{$data->payment_type}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Payment Mode :</label>
              <span>{{$data->payment_mode}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Bank Name :</label>
              <span>{{$data->bank_name}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Bank Account No. :</label>
              <span>{{$data->bank_accountno}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Partial Amount :</label>
              <span>{{$data->partial_payment}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Full Amount:</label>
              <span>{{$data->full_payment}}</span>
           </div>
        </div>
        @endif
</div>