<div class="displayReportDiv">
<div class="form-group general_info white-box pad-5">
        @if(!empty($data['personal_data']))
        {{-- @php($data=$data['personal_data'])
        @php($general_data=$data['general_examination'])
        @php($system_data=$data['system_examination'])
        @php($lab_data=$data['lab_examination']) --}}
        
        <div class="exam_detail">
        <ul class="personal-information">
            <li>
                <label>Personal ID :</label>
                <span>{{$data['personal_data']->personal_id}}</span>
            </li>
            <li>
                <label>Contact No :</label>
                <span>{{$data['personal_data']->mobile}}</span>
            </li>
           
            <li>
                <label>Posted Date:</label>
                <span>{{$data['personal_data']->postdatead}}(AD) / {{$data['personal_data']->postdatebs}}(BS)</span>
            </li>
           
            <li>
                <label>First Name :</label>
                <span>{{$data['personal_data']->first_name}} {{$data['personal_data']->middle_name}} {{$data['personal_data']->last_name}}</span>
            </li>
            <li>
                <label>Date of Birth:</label>
                <span>{{$data['personal_data']->birth_datead}}</span>
            </li>
        
            <li>
                <label>Nationality:</label>
                <span>{{$data['personal_data']->nationality}}</span>
            </li>
             <li>
                <label>Gender :</label>
                <span>{{$data['personal_data']->gend_name}} </span>
            </li>
            
            <li>
                <label>Source:</label>
                <span>{{$data['personal_data']->nature_title}}</span>
                
                @php($referrer_type_id=!empty($data['personal_data']->referrer_type_id)?$data['personal_data']->referrer_type_id:'')
                @php($referrer=!empty($data['personal_data']->rein_id)?$data['personal_data']->rein_id:'')
                @if(!empty($referrer) && $referrer!='0' )
                @php($result_reffer= get_tbl_data('rein_name','referrer_info',array('id'=>$referrer)))
                @php($co_referrer=!empty($data['personal_data']->rein_id)?$data['personal_data']->rein_id:'')
               
                @if(!empty($referrer_type_id) && ($referrer_type_id)=='1' )
                @if(!empty($referrer))
                   
                    <span>{{$result_reffer[0]->rein_name}}</span>
                @endif
                @endif
        
                @if(!empty($referrer_type_id) && ($referrer_type_id)=='2' )
                @if(!empty($co_referrer))
                @php($result_reffer= get_tbl_data('rein_name','referrer_info',array('id'=>$referrer)))
        
                @php($co_ref_result= get_tbl_data('rein_name','referrer_info',array('referrer_id'=>$referrer,'referrer_id'=>'<> 0')))
                    <span>{{$co_ref_result[0]->rein_name}}/{{$result_reffer[0]->rein_name}}</span>
                @endif
                @endif
        
                @endif
            
            </li>
            {{-- <li><a href="javascript:void(0)" class="btn btn-sm btn-success view" data-id={{$data['personal_data']->id}} data-url='api/examination/search_previous_data'>Checkup History</a></li> --}}
            
        </ul>
        </div>
        @endif
</div>
</div>

<a href="javascript:void(0)" id="btn_print_medical"><i class="fa fa-print"></i>Print</a>
<div class="printTable" style="display:none">
        {{-- @include('medical.Examination_info.Examination_Report_Generate')  --}}
        <?php
        $view = view("Medical/Examination_Info/Examination_Report_Generate")
        ->with('data', $data);
      // ->with('invoice',$invoice)
      // ->with('exam',$exam);
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