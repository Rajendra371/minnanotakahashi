@include('common.Report_Header')
<div class="date" style="text-align: right; margin: 0; padding: 0; position: relative; line-height: 0px; height:2px; top: -20px;">
  <p style="margin: 0;padding: 0;"> Date:{{CURDATE_EN}} {{date('H:i:s')}} </p>
</div>
<h5 class="text-center reportTitle" style="text-align: center; margin-bottom: 14px; margin-top: 14px; text-decoration: underline;"> Check Up List</h5>
<div class="mobile_table">
<table  class="alt_table" style="border: 2px solid ; ">
    <thead>
      <tr>
        <th width="5%">S.N</th>
        <th width="8%%">Date(AD)</th>
        <th width="8%%">Date(BS)</th>
        <th width="10%">Invoice No. </th>
        <th width="10%">Personal ID </th>
        <th width="15%">Full Name</th>
        <th width="10%">Passport No</th>
        <th width="8%">Checkup</th>
        <th width="5%">P.Type</th>
        <th width="10%">Payment Status</th>
        <th width="8%">Total Amt.</th>
        <th width="8%">Paid Amt.</th>
        <th width="8%">Due Amt.</th>
      </tr>
    </thead>
    <tbody>
      @if(!empty($data))
      @php($i=1)
      @php($amtsum=0)
      @php($paidsum=0)
      @php($deusum=0)
      
        @foreach($data as $dat)
        @php($payment_status = $dat->payment_status)
         @php($amtsum +=$dat->amount)
        @php($paidsum +=$dat->person_paid_amount)
        @php($deusum +=$dat->person_due_amount)
        @if($payment_status == 'F') 
          @php($status = 'Full Paid')
        @elseif($payment_status == 'FPP') 
          @php($status = 'Full Paid(Partially)')
        @elseif($payment_status == 'P') 
          @php($status = 'Partial Paid')
          @else
          @php($status = '')
          @endif
        <tr>
          <td>{{$i}}.</td>
          <td>{{$dat->paymentdatead}}</td>
          <td>{{$dat->paymentdatebs}}</td>
          <td>{{$dat->invoice_no}}</td>
          <td>{{$dat->personal_id}}</td>
          <td>{{$dat->first_name . ' ' . $dat->middle_name . ' ' . $dat->last_name}}</td>
          <td>{{$dat->passport_no}}</td>
          <td>{{$dat->chse_name}}</td>
          <td>{{$dat->payment_mode_name}}</td>
          <td>{{$status}}</td>
          <td align="right">{{number_format($dat->amount,2)}}</td>
          <td align="right">{{number_format($dat->person_paid_amount,2)}}</td>
          <td align="right">{{number_format($dat->person_due_amount,2)}}</td>
        </tr>
        @php($i++)
        @endforeach
        <tr>
        <td colspan="10">Grand Total</td>
        <td align="right">{{number_format($amtsum,2)}}</td>
        <td align="right">{{number_format($paidsum,2)}}</td>
        <td align="right">{{number_format($deusum,2)}}</td>
        
        </tr>
      @endif
    </tbody>
    
  </table>

</div>  