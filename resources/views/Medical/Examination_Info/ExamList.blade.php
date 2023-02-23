
<div class="form-group general_info white-box pad-5">
@if(!empty($data['personal_data']))
@php($data=$data['personal_data'])
<div class="exam_detail">
<ul class="personal-information">
    <li>
        <label>Personal ID :</label>
        <span>{{$data->personal_id}}</span>
    </li>
    <li>
        <label>Contact No :</label>
        <span>{{$data->mobile}}</span>
    </li>
   
    <li>
        <label>Posted Date:</label>
        <span>{{$data->postdatead}}(AD) / {{$data->postdatebs}}(BS)</span>
    </li>
   
    <li>
        <label>Name :</label>
        <span>{{ucwords($data->first_name.' '.$data->middle_name.' '.$data->last_name)}}</span>
    </li>
    <li>
        <label>Date of Birth:</label>
        <span>{{$data->birth_datead.' ('.calcutateAge($data->birth_datead).' Y) '}}</span>
    </li>

    <li>
        <label>Nationality:</label>
        <span>{{$data->nationality}}</span>
    </li>
     <li>
        <label>Gender :</label>
        <span>{{$data->gend_name}} </span>
    </li>
    
    <li>
        <label>Source:</label>
        {{-- <span>{{$data->nature_title}}</span> --}}
        
        @php($referrer_type_id=!empty($data->referrer_type_id)?$data->referrer_type_id:'')
        @php($referrer=!empty($data->rein_id)?$data->rein_id:'')
        @if(!empty($referrer) && $referrer!='0' )
        @php($result_reffer= get_tbl_data('rein_name','referrer_info',array('id'=>$referrer)))
        @php($co_referrer=!empty($data->rein_id)?$data->rein_id:'')
       
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
    <li>
        <label>Passport No.:</label>
        <span>{{$data->passport_no}}</span>
    </li>
    {{-- <li><a href="javascript:void(0)" class="btn btn-sm btn-success view" data-id={{$data->id}} data-url='api/examination/search_previous_data'>Checkup History</a></li> --}}
    
</ul>
</div>
<div class="row">
<div class="col-md-2">
    <div class="page_tabs vertical_tabs">
        <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item">
            <a class="nav-link active tabclick" id="firsttab" data-id="{{$data->id}}" data-description="general_checkup">General Checkup</a>
        </li>
        <li class="nav-item">
            <a class="nav-link tabclick" data-id="{{$data->id}}" data-description="re_checkup">Re-Checkup</a>
        </li>
        <li class="nav-item">
            <a class="nav-link tabclick" data-id="{{$data->id}}" data-description="partial_checkup">Partial Checkup</a>
        </li>
        <li class="nav-item">
            <a class="nav-link tabclick" data-id="{{$data->id}}" data-description="premedical_checkup">Pre Medical Checkup</a>
        </li>
        {{-- <li class="nav-item">
            <a class="nav-link tabclick" data-id="{{$data->id}}" data-description="pre_medical_checkup">Pre-Medical Checkup</a>
        </li> --}}
        </ul>
    </div>
</div>
<div class="col-md-10">
    <div class="tab-content">
        <div
        id="tab_action"
        data-action="api/get_exam_detail"
        ></div>
        <div id="tab_result" class="container tab-pane active">
        </div>
    </div>
</div>
</div>
@endif

<script>

$(document).off("click", ".tabclick");
$(document).on("click", ".tabclick", function() {
  // alert('test');
  var tab_type = $(this).data("description");
  var id = $(this).data("id");
  var postdata = { tab_type: tab_type, id: id };
  var action = $("#tab_action").data("action");
  $(".vertical_tabs .nav-link").removeClass("active");
  $(this).addClass("active");
  // $(this).removeClass('active').not($(this));
  axios.post(action, postdata).then(response => {
    var resp = response.data;
    if (resp.status == "success") {
      $("#tab_result").html(resp.template);
    } else {
      $("#tab_result").html("");
    }
  });
});

    setTimeout(function(){
       $('#firsttab').click();
      },500);


</script>