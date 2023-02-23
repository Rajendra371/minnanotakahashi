<div class="payment_wrapper">
  @if(!empty($data))
      @if($payment_status=='F')
      <h5 class="navtab_header">Detail Account</h5>
      <div class="mobile_table">
      <table  class="pop-distribution reportTable">
            <thead>
            <tr>
                  <th width="5%">S.N</th>
                  <th width="15%">Amount</th>
                  <th width="15%">Paid</th>
                  <th width="10%">Due Balance</th>
                  <th width="15%">Date</th>
            </tr>
            </thead>
            <tbody>
            @php($i=1)
            <tr>
                  <td>{{$i}}</td>
                  <td>{{!empty($data->amount)?$data->amount:'0.00'}}</td>
                  <td>
                  {{!empty($data->person_full_paid_amount)?$data->person_full_paid_amount:'0.00'}}
                  </td>
                  <td>
                  {{!empty($data->person_due_amount)?$data->person_due_amount:'0.00'}}
                  </td>
                  <td>
                  {{!empty($data->postdatead)?$data->postdatead:''}}
                  </td>
                  @php($i++)
            </tr>
            </tbody>
      </table>
      <h6 class="pt-4"><b>Account is cleared</b></h6>
      @elseif($payment_status=='P' || $payment_status=='FPP')
      <h5 class="navtab_header">Detail Account</h5>
      <div class="mobile_table">
      <table  class="pop-distribution reportTable">
            <thead>
            <tr>
                  <th width="5%">S.N</th>
                  <th width="15%">Amount</th>
                  <th width="15%">Paid</th>
                  <th width="10%">Due Balance</th>
                  <th width="15%">Date</th>
            </tr>
            </thead>
            <tbody>
            @php($i=1)
            @foreach($data as $key=>$row)
            <tr>
                  <td>{{$i}}</td>
                  <td>{{!empty($row->person_due_amount)?$row->person_due_amount:'0.00'}}</td>
                  <td>{{!empty($row->person_paid_amount)?$row->person_paid_amount:'0.00'}}
                  </td>
                  <td>{{!empty($row->balance)?$row->balance:'0.00'}}</td>
                  <td>
                  {{!empty($row->postdatead)?$row->postdatead:''}}
                  </td>
                  @php($i++)
            </tr>
            @endforeach
            </tbody>
            
      </table>
            @if($payment_status=='P')
                  <h6>Account is not cleared!!Please clear it soon..</h6>
                  @else
                  <h6>Account has been cleared partially!!!</h6>
            @endif
      </div>
      @endif
@endif
</div>