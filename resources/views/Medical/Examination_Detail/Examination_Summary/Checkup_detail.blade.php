<div class="form-group general_info white-box pad-5">
    @if(!empty($data))
    <div>
       <h3 class="form_title personal-info">Invoice Info-  <span>{{$data['billing_info']->invoice_no}}</span></h3>
    </div>
    <div class="row first-row">
       <div class="col-md-4 col-sm-4">
          <label>Full Name :</label>
          <span>{{$data['billing_info']->first_name.' '.$data['billing_info']->middle_name.' '.$data['billing_info']->last_name}}</span>
       </div>
       
       <div class="col-md-4 col-sm-4">
          <label>Age / Gender :</label>
           <span>@php($db_age=$data['billing_info']->birth_datead) @php($age= calcutateAge($db_age)) {{$age}} / {{substr($data['billing_info']->gend_name, 0, 1)}}</span>
         
       </div>
     
       <div class="col-md-4 col-sm-4">
          <label>Apply Country /  PP.No :</label>
          <span>{{$data['billing_info']->coun_name.'/'.$data['billing_info']->passport_no}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
          <label>Checkup Type:</label>
          <span>{{$data['billing_info']->chse_name}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
           <label>Bill Date(AD)-(BS)</label>
           <span>{{$data['billing_info']->paymentdatead.'-'.$data['billing_info']->paymentdatebs}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
           <label>Payment Status</label>
            @if($data['billing_info']->payment_status == 'F')
            @php($status = 'Full Paid')
            @elseif($data['billing_info']->payment_status == 'FPP')
            @php( $status = 'Full Paid(Partially)')
            @elseif($data['billing_info']->payment_status == 'P') 
            @php( $status = 'Partial Paid')
            @endif
            <span>{{$status}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
          <label>Total Amt.</label>
          <span>{{number_format($data['billing_info']->amount,2)}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
            <label>Paid Amt.</label>
            <span class="text-success">{{number_format($data['billing_info']->person_paid_amount,2)}}</span>
       </div>
       <div class="col-md-4 col-sm-4">
            <label>Due  Amt.</label>
            <span class="text-danger">{{number_format($data['billing_info']->person_due_amount,2)}}</span>
       </div>
    @endif
 </div>
 <div>
      <h3 class="form_title personal-info">Referrer Payment Log</span></h3>
      <div class="row first-row">
            <div class="col-md-6 col-sm-6">
               <label>Referrer:</label>
               <span>
                  @if(!empty( $data['referrer_data']))
                  {{ $data['referrer_data'][0]->rein_name.' -'.$data['referrer_data'][0]->address}}
                  @endif
               </span>
            </div>
            <div class="col-md-4 col-sm-4">
                  <label>Referrer Amount:</label>
                  <span>{{number_format($data['billing_info']->referrer_amount,2)}}</span>
               </div>
               <div class="col-md-2 col-sm-2">
                 
               </div>
               <div class="col-md-6 col-sm-6">
                     <label>Co-Referrer:</label>
                     <span>
                           @if(!empty( $data['co_referrer_data']))
                           {{ $data['co_referrer_data'][0]->rein_name.' -'.$data['co_referrer_data'][0]->address}}
                           @endif
                        </span>
               </div>
               <div class="col-md-4 col-sm-4">
                     <label>Co-Referrer Amount:</label>
                     <span>{{number_format($data['billing_info']->co_referrer_amount,2)}}</span>
               </div>
      </div>
   </div>


 
<a href="javascript:void(0)" class="btn btn-sm btn-suceess" id="btn_print_medical"><i class="fa fa-print"></i> Re-Print</a>
@if($data['billing_info']->status=='O')
<a href="javascript:void(0)" class="pull-right btn btn-sm btn-danger" id="btnCancel" data-id="{{$data['pmid']}}" data-url="api/examination_summary/cancel"><i class="fa fa-window-close" aria-hidden="true"></i> Cancel</a>
@endif
<div class="printTable" style="display:none">
        {{-- @include('medical.Examination_info.Examination_Report_Generate')  --}}
        <?php
        $view = view("Medical/Examination_Info/BillingPrint")
        ->with('data', $data);
        echo $template = $view->render();
        ?>
</div>

<script>

$(document).off('click','#btn_print_medical');
$(document).on('click','#btn_print_medical',function(){
    // alert('test');
$(".printTable").show()
$(".printTable").printThis();
setTimeout(function() {
         $(".printTable").hide();
   }, 1000);
})
</script>
 
 <script>

$(document).off('click','#btnCancel');
$(document).on('click','#btnCancel',function(){
   
  var conf = confirm("Are Your Want to Sure to Cancel?");
  if (conf) {
    var cancelurl = $(this).data("url");
    var id = $(this).data("id");
    axios
      .post(cancelurl, { id: id })
      .then(response => {
        var resp = response.data;
        // console.log(resp);
        // return false;
        if (resp.status == "error") {
          alert(resp.message);
          return false;
        }

        if (resp.status == "success") {
         $('#btnCancel').hide();
         alert(response.data.message);
        } else {
          alert(response.data.message);
        }
      })
      .catch(error => {
        console.log(error);
      });
  }
})
 </script>