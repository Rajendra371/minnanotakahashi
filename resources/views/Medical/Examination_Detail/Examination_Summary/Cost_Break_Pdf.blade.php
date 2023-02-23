@include('common.Report_Header')
<div style="text-align:right;">
Date:{{CURDATE_EN}} {{date('H:i:s')}}
</div>
<h5 class="text-center reportTitle" style="text-align: center; text-decoration: underline;margin-top: 0;"> Cost Break Analysis</h5>
<div class="mobile_table">
<table  class="alt_table ">
    <thead>
      <tr>
        <th width="5%">S.N</th>
        <th width="8%">Date(AD)</th>
        <th width="8%">Date(BS)</th>
        <th width="8%">Invoice No. </th>
        <th width="8%">Personal ID </th>
        <th width="8%">Full Name</th>
        <th width="7%">Checkup</th>
        <th width="7%">P.Mode</th>
        <th width="7%">P.Status</th>
        <th width="7%">Total Amt.</th>
        <th width="7%">Paid Amt.</th>
        <th width="7%">Due Amt.</th>
        <th width="7%">Org Amt.</th>
        <th width="7%">Re Amt.</th>
        <th width="7%">Co-ref Amt.</th>
      </tr>
    </thead>
    <tbody>
      @if(!empty($data))
      @php($i=1)
      @php($amtsum=0)
      @php($paidsum=0)
      @php($duesum=0)
      @php($orgsum=0)
      @php($resum=0)
      @php($oresum=0)
      
        @foreach($data as $dat)
        @php($payment_status = $dat->payment_status)
         @php($amtsum +=$dat->amount)
        @php($paidsum +=$dat->person_paid_amount)
        @php($duesum +=$dat->person_due_amount)
        @php($orgsum +=$dat->org_amount)
        @php($resum +=$dat->referrer_amount)
        @php($oresum +=$dat->co_referrer_amount)

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
          <td>{{$dat->chse_name}}</td>
          <td>{{$dat->payment_mode_name}}</td>
          <td>{{$status}}</td>
          <td align="right">{{number_format($dat->amount,2)}}</td>
          <td align="right">{{number_format($dat->person_paid_amount,2)}}</td>
          <td align="right">{{number_format($dat->person_due_amount,2)}}</td>
          <td align="right">{{number_format($dat->org_amount,2)}}</td>
          <td align="right">{{number_format($dat->referrer_amount,2)}}</td>
          <td align="right">{{number_format($dat->co_referrer_amount,2)}}</td>
        </tr>
        @php($i++)
        @endforeach
        <tr>
        <td colspan="9">Grand Total</td>
        <td align="right">{{number_format($amtsum,2)}}</td>
        <td align="right">{{number_format($paidsum,2)}}</td>
        <td align="right">{{number_format($duesum,2)}}</td>
        <td align="right">{{number_format($orgsum,2)}}</td>
        <td align="right">{{number_format($resum,2)}}</td>
        <td align="right">{{number_format($oresum,2)}}</td>
        
        </tr>
      @endif
    </tbody>
    
  </table>