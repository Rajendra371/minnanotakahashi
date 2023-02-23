@include('common.Report_Header')
<div style="text-align:right;">
Date:{{CURDATE_EN}} {{date('H:i:s')}}
</div>
<h5 class="text-center reportTitle" style="text-align: center; text-decoration: underline;margin-top: 0;"> Medical Data Report List</h5>
<h6 style="text-align: center; text-decoration: underline;margin-top: 0;">From:{{$_GET['from_date']}} -{{$_GET['to_date']}}</h6>
<div class="mobile_table">
<table  class="alt_table ">
    <thead>
      <tr>
        <th width="5%">S.N</th>
        <th width="8%">Personal ID </th>
        <th width="8%">Full Name</th>
        <th width="8%">Invoice No. </th>
        <th width="8%">Invoice Date(AD). </th>
        <th width="8%">Report Date/Time</th>
        <th width="8%">Report Completed</th>
        <th width="8%">Report By</th>
        <th width="8%">Is Delivery</th>
        <th width="8%">Delivery Date/Time</th>
        <th width="8%">Result</th>
        </tr>
    </thead>
    <tbody>
        @if(!empty($data))
        @php($i=1)
            @foreach($data as $row)
            <tr>
                @php($result= !empty($row->result)?$row->result:'')
                @php($iscomplete= !empty($row->report_iscompleted)?$row->report_iscompleted:'N')
            
                @php($rslt='--')
                @if($result=='F')
                    @php($rslt='Fit');
                @endif
                @if($result=='U')
                @php($rslt='UnFit');
            @endif
            
                
                @if($iscomplete=='Y')
                    @php($iscomp='Yes');
                @endif
                @if($iscomplete=='N')
                    @php($iscomp='No');
                @endif
                <td>{{$i}}</td>
                <td>{{$row->person_id}}</td>
                 <td>{{$row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name}}</td>
                 <td>{{$row->exma_invoice_no}}</td>
                 <td>{{$row->paymentdatead}}</td>
                 <td>{{!empty( $row->report_datead)? ($row->report_datead.'/'.$row->report_time):''}}</td>
                 <td>{{$iscomp}}</td>
                 <td>{{$row->username}}</td>
                 <td>{{$row->is_delivered}}</td>
                 <td>{{!empty( $row->delivered_datead)? ($row->delivered_datead.'/'.$row->delivered_time):''}}</td>
                 <td>{{$rslt}}</td>
            </tr>
            @php($i++)
            @endforeach
        @endif
         
    </tbody>
    
  </table>