    <div >
        <div class="pull-right pad-btm-5 reportGeneration">
            <a href="javascript:void(0)" class="btn btn-sm btn-success btn_print" title="Print"><i class="fa fa-print" aria-hidden="true"></i></a>
        </div>
   </div>
    <div id="printrpt">
    @include('Common.Report_Header')
    &nbsp;
    <table class="pop-distribution ">
        <thead>
            <tr>
            <th>S.n</th>
            <th>Date(AD)</th>
            <th>Date(BS)</th>
            <th>Description</th>
            <th>Income</th>
            <th>Expenses</th>
            </tr>
        </thead>
        @if(!empty($data['data_list']))
        <tbody>
            @php($i=1)
            @php($income_amt=0)
            @php($expenses_amt=0)
            @foreach($data['data_list'] as $dat)
            @php($income_amt+=$dat->income_amount)
            @php($expenses_amt+=$dat->exp_amt)
            <tr>
                <td>{{$i}}</td>
                <td>{{$dat->datead}}</td>
                <td>{{$dat->datebs}}</td>
                <td>{{$dat->remarks}}</td>
                <td>{{$dat->income_amount}}</td>
                <td>{{$dat->exp_amt}}</td> 
            </tr>
            @php($i++)
            @endforeach
    
        </tbody>
        <tfoot>
            <tr>
                <td colspan="4">Total</td>
                <td>{{$income_amt}}</td>
                <td>{{$expenses_amt}}</td>
               
            </tr>
        </tfoot>
        @endif
    </table>
    </div>