
<div class="form-group general_info white-box pad-5">
@if(!empty($data['personal_data']))
@php($data=$data['personal_data'])
<div class="exam_detail pt-0">
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
        <label>First Name :</label>
        <span>{{$data->first_name}} {{$data->middle_name}} {{$data->last_name}}</span>
    </li>
    <li>
        <label>Date of Birth:</label>
        <span>{{$data->birth_datead}}</span>
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
    <label>Checkup Type :</label>
    <span>{{$data->chse_name}}</span>
    &nbsp;&nbsp;&nbsp;<a href="javascript:void(0)" title="View Billing Information" class="btn btn-sm btn-primary view" data-id="{{$data->paymentid}}" data-url="/api/examination/billing_info" >Billing Info</a>
    </li>
    {{-- <li><a href="javascript:void(0)" class="btn btn-sm btn-success view" data-id={{$data->id}} data-url='api/examination/search_previous_data'>Checkup History</a></li> --}}
    
</ul>
</div>

<div class="blood_sample_success"> </div>
<div class="row" style="margin-bottom: 25px;">
  
    <div class="col-md-3">
    <input type="checkbox" class="isblood_sample"  value="Y" {{$data->isbloodsample == "Y"? "checked": " " }} >Blood Sample<br>
    
    </div>
    <div class="col-md-9" id="otherinfodiv" style= {{ $data->isbloodsample == "Y"? "display:block":"display:none"}}>
      <div class="row clearfix">
      <div class="col-md-3 ">
        <label>Sample Date</label>
      <input type="text" class="form-control" id="sampledate" name="sampledate" value="{{ $data->isbloodsample == "Y"? $data->sampledatead: date('Y/m/d') }}">
        </div>
        <div class="col-md-3 ">
          <label>Sample Time</label>
          <input type="text" class="form-control" id="sampletime" name="sampletime" value="{{ $data->isbloodsample == "Y"? $data->sampletime: date('H:i:s') }}">
        </div>
        <div class="col-md-4 ">
          <label>Sample By</label>
          <input type="text" class="form-control" id="sampleby" name="sampleby" value="{{ $data->isbloodsample == "Y"? $data->sampleby  :"" }}">
        </div>
        <div class="col-md-1 ">
        
        <a href="javascript:void(0)" id="submit" data-url="api/examination/save_bloodsample"  class="btnbloodsave btn btn-sm btn-primary" style="margin-top: 36px;{{ $data->isbloodsample == "Y"? "display:none":"display:block"}} " >Save</a>
        </div>
      </div>
    </div>

</div>
<form method="post" id="medicaldataForm" class="form-horizontal" action="api/examination/medical_data_store">
<div class="row">
<div class="col-md-12">
  <?php 
  echo $template;
  ?>
</div>
</div>      
        <div class="row">
        <div class="col-md-8">
                <button type="submit" size="md" color="primary" class="save btn btn-primary btn-md">
                        <i class="fa fa-dot-circle-o"></i> Save
                        </button>
                        <div class="clearfix"></div>
                        <div class="alert-success success"></div>
                        <div class="alert-danger error"></div> 
        </div>
        </div>
</form>
@endif


<script type="text/javascript">
  $(document).off("click", ".btnbloodsave");
  $(document).on("click", ".btnbloodsave", function() {
    var conf = confirm("Do you confirm this sample test?");    
    if (conf) {
      var posturl = $(this).data("url");
      var id = $('#exmmasterid').val();
      var issample = $('.isblood_sample:checked').val();
      var sampledate=$('#sampledate').val();
      var sampletime= $('#sampletime').val();
      var sampleby= $('#sampleby').val();
      // alert(id);
      // alert(issample);
      axios
        .post(posturl, { examination_masterid: id, isblood_sample:issample,sampledate:sampledate,sampletime:sampletime,sampleby:sampleby })
        .then(response => {
          var resp = response.data;
          // console.log(resp);
          // return false;
          if (resp.status == "error") {
            alert(resp.message);
            return false;
          }
  
          if (resp.status == "success") {
            $('.blood_sample_success').addClass("alert alert-primary");
           $('.blood_sample_success').html(resp.message);
           $('.btnbloodsave').css("display","none");
           setTimeout(() => {
            $('.blood_sample_success').hide();
           }, 1000);
           
             
          } else {
            alert(response.data.message);
          }
        })
        .catch(error => {
          console.log(error);
        });
    }
  });
  </script>
  <script>
  $(document).off('click','.isblood_sample');
  $(document).on('click','.isblood_sample',function(e){
    if ($('.isblood_sample').is(":checked")){
      $('#otherinfodiv').show();
    }else{
      $('#otherinfodiv').hide();
    }
  });
  </script>
