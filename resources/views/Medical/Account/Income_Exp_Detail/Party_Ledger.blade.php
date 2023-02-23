
@php($supplier_id =$data['supplier_id'])
<div >
    <div class="pull-right pad-btm-5 reportGeneration"><a href="javascript:void(0)" class="btn btn-sm btn-success btn_print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a>
        @if($supplier_id!='all')
        <a href="javascript:void(0)" class="btn btn-sm btn-success view" data-id="{{$supplier_id}}" data-url="/api/income_exp_detail/party_payment" title="Pay to "><i class="fa fa-money" aria-hidden="true"></i></a>
        @endif
    </div>
</div>

<div id="printrpt">
@include('Common.Report_Header')
&nbsp;
@if($supplier_id!='all')

@if($data['rpt_type']=='detail' )
<table class="pop-distribution ">
    <thead>
        <tr>
        <th>S.n</th>
        <th>Date(AD)</th>
        <th>Date(AD)</th>
        <th>Invoice No.</th>
        <th>Bill No.</th>
        <th>Bill Amt.</th>
        <th>Paid Amt.</th>
        <th>Rem. Amt To be Paid </th>
        </tr>
    </thead>
    @if(!empty($data['supplier_ledger_data']))
    <tbody>
        @php($i=1)
        @php($billamount=0)
        @php($amount=0)
        @php($remamount=0) 
        @foreach($data['supplier_ledger_data'] as $dat)
        @php($billamount +=$dat->bill_amount)
        @php($amount +=$dat->amount)
        @php($remamount += ($dat->rem_amount))
        <tr>
            <td>{{$i}}</td>
            <td>{{$dat->billdatead}}</td>
            <td>{{$dat->billdatebs}}</td>
            <td>{{$dat->invoice_billno}}</td>
            <td>{{$dat->bill_no}}</td>
            <td>{{$dat->bill_amount}}</td>
            <td>{{$dat->amount}}</td>
            <td>{{$dat->rem_amount}}</td>
           
        </tr>
        @php($i++)
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="5">Total</td>
            <td>{{$billamount}}</td>
            <td>{{$amount}}</td>
            <td>{{$remamount}}</td>
            
        </tr>
    </tfoot>
    @endif

</table>
@endif

@if($data['rpt_type']=='summary' )
<table class="pop-distribution ">
    <thead>
        <tr>
        <th>S.n</th>
        <th>Bill Amt.</th>
        <th>Paid Amt.</th>
        <th>Rem. Amt To be Paid </th>
        </tr>
    </thead>
    @if(!empty($data['supplier_ledger_data']))
    <tbody>
        @php($i=1)
        @php($billamount=0)
        @php($amount=0)
        @php($remamount=0) 
        @foreach($data['supplier_ledger_data'] as $dat)
        @php($billamount +=$dat->bill_amount)
        @php($amount +=$dat->amount)
        @php($remamount += ($dat->rem_amount))
        <tr>
            <td>{{$i}}</td>
            <td>{{$dat->bill_amount}}</td>
            <td>{{$dat->amount}}</td>
            <td>{{$dat->rem_amount}}</td>
          
        </tr>
        @php($i++)
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="1">Total</td>
            <td>{{$billamount}}</td>
            <td>{{$amount}}</td>
            <td>{{$remamount}}</td>
            
        </tr>
    </tfoot>
    @endif

</table>
@endif

@endif

@if($supplier_id=='all')

@if($data['rpt_type']=='detail' )
<table class="pop-distribution ">
    <thead>
        <tr>
        <th>S.n</th>
        <th>Date(AD)</th>
        <th>Date(AD)</th>
        <th>Invoice No.</th>
        <th>Bill No.</th>
        <th>Party Name</th>
        <th>Bill Amt.</th>
        <th>Paid Amt.</th>
        <th>Rem. Amt To be Paid </th>
        </tr>
    </thead>
    @if(!empty($data['supplier_ledger_data']))
    <tbody>
        @php($i=1)
        @php($billamount=0)
        @php($amount=0)
        @php($remamount=0) 
        @foreach($data['supplier_ledger_data'] as $dat)
        @php($billamount +=$dat->bill_amount)
        @php($amount +=$dat->amount)
        @php($remamount += ($dat->rem_amount))
        <tr>
            <td>{{$i}}</td>
            <td>{{$dat->billdatead}}</td>
            <td>{{$dat->billdatebs}}</td>
            <td>{{$dat->invoice_billno}}</td>
            <td>{{$dat->bill_no}}</td>
            <td>{{$dat->title}}</td>
            <td>{{$dat->bill_amount}}</td>
            <td>{{$dat->amount}}</td>
            <td>{{$dat->rem_amount}}</td>
           
        </tr>
        @php($i++)
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="6 ">Total</td>
            <td>{{$billamount}}</td>
            <td>{{$amount}}</td>
            <td>{{$remamount}}</td>
            
        </tr>
    </tfoot>
    @endif

</table>
@endif

@if($data['rpt_type']=='summary' )
<table class="pop-distribution ">
    <thead>
        <tr>
        <th>S.n</th>
        <th>Party Name</th>
        <th>Bill Amt.</th>
        <th>Paid Amt.</th>
        <th>Rem. Amt To be Paid </th>
        </tr>
    </thead>
    @if(!empty($data['supplier_ledger_data']))
    <tbody>
        @php($i=1)
        @php($billamount=0)
        @php($amount=0)
        @php($remamount=0) 
        @foreach($data['supplier_ledger_data'] as $dat)
        @php($billamount +=$dat->bill_amount)
        @php($amount +=$dat->amount)
        @php($remamount += ($dat->rem_amount))
        <tr>
            <td>{{$i}}</td>
            <th>{{$dat->title}}</th>
            <td>{{$dat->bill_amount}}</td>
            <td>{{$dat->amount}}</td>
            <td>{{$dat->rem_amount}}</td>
          
        </tr>
        @php($i++)
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2">Total</td>
            <td>{{$billamount}}</td>
            <td>{{$amount}}</td>
            <td>{{$remamount}}</td>
            
        </tr>
    </tfoot>
    @endif

</table>
@endif
@endif
