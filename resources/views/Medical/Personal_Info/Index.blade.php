<div class="form-group general_info white-box pad-4">
   @if(!empty($data))
   <div>
      <h3 class="form_title personal-info">Detail Information-  <span>{{$data->personal_id}}</span></h3>
   </div>
   <div class="row first-row">
      <div class="col-md-4 col-sm-4">
         <label>First Name :</label>
         <span>{{$data->first_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Middle Name :</label>
         <span>{{$data->middle_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Last Name :</label>
         <span>{{$data->last_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Father Name :</label>
         <span>{{$data->father_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Mother Name :</label>
         <span>{{$data->mother_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Mobile:</label>
         <span>{{$data->mobile}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Citizenship No. :</label>
         <span>{{$data->cizitenship_no}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Gender :</label>
         @php($gender=$data->gender_id)
         @if(!empty($gender))
         @php($result= get_tbl_data('gend_name','gender',array('id'=>$gender)))
         <span>{{$result[0]->gend_name}}</span>
         @else
         <span></span>
         @endif
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Birth Date :</label>
         <span>{{$data->birth_datead}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Nationality :</label>
         <span>{{$data->nationality}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Passport No :</label>
         <span>{{$data->passport_no}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Passport Issue Date :</label>
         <span>{{$data->passport_issue_datead}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Passport Expiry Date :</label>
         <span>{{$data->passport_expiry_datead}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Passport Issue Place :</label>
         <span>{{$data->passport_issue_place}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Source :</label>
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
      </div>
   </div><!-- .first-row -->
   <div>
      <h3 class="form_title address-info">Permanent Address</h3>
   </div>
   <div class="row second-row">
      <div class="col-md-4 col-sm-4">
         <label>State :</label>
         @php($state=$data->perm_state_id)
         @if(!empty($state))
         @php($result= get_tbl_data('stat_name','state',array('id'=>$state)))
         <span>{{$result[0]->stat_name}}</span>
         @else
         <span></span>
         @endif
      </div>
      <div class="col-md-4 col-sm-4">
         <label>District :</label>
         @php($district=$data->perm_district_id)
         @if(!empty($district))
         @php($result= get_tbl_data('dist_name','district',array('id'=>$district)))
         <span>{{$result[0]->dist_name}}</span>
         @else
         <span></span>
         @endif
      </div>
      <div class="col-md-4 col-sm-4">
         <label>VDC :</label>
         @php($vdc=$data->perm_vdc_id)
         @if(!empty($vdc))
         @php($result= get_tbl_data('vdc_namenp','vdc',array('id'=>$vdc)))
         <span>{{$result[0]->vdc_namenp}}</span>
         @else
         <span></span>
      </div>

      @endif
   </div>
      <div class="col-md-4 col-sm-4">
         <label>Address :</label>
         <span>{{$data->perm_address}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Ward :</label>
         @php($ward=$data->perm_ward_id)
         @if(!empty($ward))
         @php($result= get_tbl_data('wase_name','ward_setup',array('id'=>$ward)))
         @else
         <span>{{$result[0]->wase_name}}</span>
         @endif
      </div>
      <div class="col-md-4 col-sm-4">
        
         
      </div>
   </div>
  </div><!-- .extra --> 
   <div >
      <h3 class="form_title address-info">Temporary Address</h3>
   </div>
   <div class="row row-last">
      <div class="col-md-4 col-sm-4">
         <label>State :</label>
         @php($state=$data->temp_state_id)
         @if(!empty($state))
         @php($result= get_tbl_data('stat_name','state',array('id'=>$state)))
         <span>{{$result[0]->stat_name}}</span>
         @else
         <span></span>
         @endif
      </div>
      <div class="col-md-4 col-sm-4">
         <label>District :</label>
         @php($district=$data->temp_district_id)
         @if(!empty($district))
         @php($result= get_tbl_data('dist_name','district',array('id'=>$district)))
         <span>{{$result[0]->dist_name}}</span>
         @else
         <span></span>
         @endif
      </div>
      <div class="col-md-4 col-sm-4">
         <label>VDC :</label>
         @php($vdc=$data->temp_vdc_id)
         @if(!empty($vdc))
         @php($result= get_tbl_data('vdc_namenp','vdc',array('id'=>$vdc)))
         <span>{{$result[0]->vdc_namenp}}</span>
         @else
         <span></span>
      </div>
   
      @endif
   </div>   
      <div class="col-md-4 col-sm-4">
         <label>Address :</label>
         <span>{{$data->temp_address}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Ward :</label>
         @php($ward=$data->temp_ward_id)
         @if(!empty($ward))
         @php($result= get_tbl_data('wase_name','ward_setup',array('id'=>$ward)))
         @else
         <span>{{$result[0]->wase_name}}</span>

         @endif

      </div>
      <div class="col-md-4 col-sm-4">
        
      </div>
   </div>
   {{-- <div>
      <h3 class="form_title last-info">Last Information</h3>
   </div>
   <div class="row first-row">
      <div class="col-md-4 col-sm-4">
         <label>First Name :</label>
         <span>{{$data->first_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Middle Name :</label>
         <span>{{$data->middle_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Last Name :</label>
         <span>{{$data->last_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Father Name :</label>
         <span>{{$data->father_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Mother Name :</label>
         <span>{{$data->mother_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Grandfather Name :</label>
         <span>{{$data->grandfather_name}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Citizenship No. :</label>
         <span>{{$data->cizitenship_no}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Gender :</label>
         @php($gender=$data->gender_id)
         @if(!empty($gender))
         @php($result= get_tbl_data('gend_name','gender',array('id'=>$gender)))
         <span>{{$result[0]->gend_name}}</span>
         @else
         <span></span>
         @endif
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Birth Date :</label>
         <span>{{$data->birth_datebs}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Nationality :</label>
         <span>{{$data->nationality}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Birth Date :</label>
         <span>{{$data->passport_no}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Passport Issue Date :</label>
         <span>{{$data->passport_issue_datebs}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Passport Expiry Date :</label>
         <span>{{$data->passport_expiry_datebs}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Passport Issue Place :</label>
         <span>{{$data->passport_issue_place}}</span>
      </div>
      <div class="col-md-4 col-sm-4">
         <label>Referrer :</label>
         <span></span>
      </div>
   </div><!-- .first-row -->

   </div> --}}
   @endif
</div>

<a href="javascript:void(0)" class="btn btn-sm btn-suceess" id="btn_print_personal"><i class="fa fa-print"></i> Print</a>

<div class="printTable" style="display:none">
        {{-- @include('medical.Examination_info.Examination_Report_Generate')  --}}
        <?php
        $view = view("Medical/Personal_Info/PersonalDetailPrint")
        ->with('data', $data);
        echo $template = $view->render();
        ?>
</div>





<script>

$(document).off('click','#btn_print_personal');
$(document).on('click','#btn_print_personal',function(){
    // alert('test');
$(".printTable").show()
$(".printTable").printThis();
setTimeout(function() {
         $(".printTable").hide();
   }, 1000);
})
</script>