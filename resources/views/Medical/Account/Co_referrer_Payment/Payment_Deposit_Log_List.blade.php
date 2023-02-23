<div>
    
</div>
@php($referrer_id =$data['referrer_id'])
<div >
    <div class="pull-right pad-btm-5 reportGeneration"><a href="javascript:void(0)" class="btn btn-sm btn-success btn_print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a><a href="javascript:void(0)" class="btn btn-sm btn-success view" data-id="{{$referrer_id}}" data-url="/api/co_referrer_payment/payment" title="Pay to "><i class="fa fa-money" aria-hidden="true"></i></a></div>
@if(!empty($referrer_id ))

@endif


</div>


<div id="printrpt">
@include('Common.Report_Header')
&nbsp;
@if(!empty($referrer_id ))
<table class="pop-distribution ">
    <thead>
        <tr>
        <th>S.n</th>
        <th>Date(AD)</th>
        <th>Date(AD)</th>
        <th>Description</th>
        <th>Deposit</th>
        <th>Withdraw</th>
        <th>Balance</th>
        </tr>
    </thead>
    @if(!empty($data['list']))
    <tbody>
        @php($i=1)
        @php($depamt=0)
        @php($withamt=0)
        @php($remamt=0) 
        @foreach($data['list'] as $dat)
        @php($depamt+=$dat->dpamt)
        @php($withamt+=$dat->wamt)
        @php($remamt += ($dat->dpamt)-($dat->wamt))
        <tr>
            <td>{{$i}}</td>
            <td>{{$dat->datead}}</td>
            <td>{{$dat->datebs}}</td>
            <td>{{$dat->fullname.'-'.$dat->personal_id}}</td>
            <td>{{$dat->dpamt}}</td>
            <td>{{$dat->wamt}}</td>
            <td>{{$remamt}}</td>
            
        </tr>
        @php($i++)
        @endforeach

    </tbody>
    <tfoot>
        <tr>
            <td colspan="4">Total</td>
            <td>{{$depamt}}</td>
            <td>{{$withamt}}</td>
            <td></td>
            
           
        </tr>
    </tfoot>
    @endif

</table>
@endif
@if(empty($referrer_id ))
<table class="pop-distribution ">
    <thead>
        <tr>
        <th>S.n</th>
        <th>Co/Referrer</th>
        <th>Deposit</th>
        <th>Withdraw</th>
        <th>Balance</th>
        </tr>
    </thead>
    @if(!empty($data['list']))
    <tbody>
        @php($i=1)
        @php($depamt=0)
        @php($withamt=0)
        @php($remamt=0)
        @foreach($data['list'] as $dat)
        @php($depamt+=$dat->depamt)
        @php($withamt+=$dat->withamt)
        @php($remamt+=$dat->remamt)
        
        <tr>
           <td>{{$i}}.</td>
            <td>{{$dat->rein_name}}</td>
            <td style=" text-align: right;">{{$dat->depamt}}</td>
            <td style=" text-align: right;">{{$dat->withamt}}</td>
            <td style=" text-align: right;">{{$dat->remamt}}</td>
          
        </tr>
 
    @php($i++)
    @endforeach
</tbody>
<tfoot>
    <tr>
        <td colspan="2">Total</td>
        <td style=" text-align: right;">{{$depamt}}</td>
        <td style=" text-align: right;">{{$withamt}}</td>
        <td style=" text-align: right;">{{$remamt}}</td>
        <td></td>
    </tr>
</tfoot>
    @endif
</table>
@endif
</div>