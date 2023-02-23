<div >
    <div class="pull-right pad-btm-5 reportGeneration"><a href="javascript:void(0)" class="btn btn-sm btn-success btn_print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a>
    </div>
</div>

<div id="printrpt">
@include('Common.Report_Header')
&nbsp;

<table class="pop-distribution ">
    <thead>
        <tr>
        <th>S.n</th>
		<th>Category</th>
		<th>Amount</th>
        </tr>
    </thead>
    @if(!empty($data['rpt_list']))
    <tbody>
        @php($i=1)
        @php($amount=0)
        @foreach($data['rpt_list'] as $dat)
        @php($amount +=$dat->amount)
        <tr>
			<td>{{$i}}</td>
			<td>{{$dat->title}}</td>
            <td>{{$dat->amount}}</td>
           
        </tr>
        @php($i++)
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2">Total</td>
            <td>{{$amount}}</td> 
        </tr>
    </tfoot>
    @endif

</table>

