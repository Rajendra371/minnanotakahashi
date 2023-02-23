<div class="form-group general_info white-box pad-5">
        @if(!empty($data['master']))
        <div>
           <h3 class="form_title">Detail Examination Information</h3>
        </div>
        <div class="row">
        <div class="col-md-4 col-sm-4">
              <label>Personal ID :</label>
              <span>{{$data['master']->person_id}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>First Name :</label>
              @php($person=$data['master']->person_id)
              @if(!empty($person))
              @php($result= get_tbl_data('first_name','personal_info',array('personal_id'=>$person)))
              <span>{{$result[0]->first_name}}</span>
              @else
              <span></span>
              @endif
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Inovoice No :</label>
              <span>{{$data['master']->exma_inovoice_no}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Amount:</label>
              <span>{{$data['master']->amount}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Discount(%):</label>
              <span>{{$data['master']->dis_per}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Vat(%):</label>
              <span>{{$data['master']->vat_per}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Grand Total:</label>
              <span>{{$data['master']->grand_total}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Referrer :</label>
              <span>{{$data['master']->referrer_id}}</span>
           </div>
        </div>
        <div>
           <h3 class="form_title">Payment Type</h3>
        </div>
        <div class="row">
           <div class="col-md-4 col-sm-4">
              <label>Payment Type :</label>
              <span>{{$data['master']->payment_type}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Payment Mode :</label>
              <span>{{$data['master']->payment_mode}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Bank Name :</label>
              <span>{{$data['master']->bank_name}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Bank Account No. :</label>
              <span>{{$data['master']->bank_accountno}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Partial Amount :</label>
              <span>{{$data['master']->partial_payment}}</span>
           </div>
           <div class="col-md-4 col-sm-4">
              <label>Full Amount:</label>
              <span>{{$data['master']->full_payment}}</span>
           </div>
        </div>
        @endif
</div>
<div class="form-group general_info white-box pad-5">
        @if(!empty($data['detail']))
         <h3>Examination :</h3>
         <div style="overflow-y:scroll;height:250px;">
         <table border="1" style="width:100%">
          <thead>
          <tr>
               <th>S.N.</th>
               <th>Exam</th>
          </tr>
          </thead>
          <tbody>
        @foreach($data['detail'] as $key=>$data)
            <tr>
            <td>{{$key+1}}</td>
            <td>{{$data->examination_name}}</td>
           </tr>
         @endforeach
         </tbody>
        @endif
        </table>
        </div>
</div>