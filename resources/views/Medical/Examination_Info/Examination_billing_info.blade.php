<div class="form-group general_info white-box pad-5">
    @if(!empty($data['personal_data']))
    @php($data=$data['personal_data'])
    <div>
    <h3 class="form_title personal-info">Billing Information-{{$data->invoice_no}}</h3>
    </div>
    <div class="row first-row">
        <div class="col-md-4 col-sm-4">
            <label>Personal ID :</label>
            <span>{{$data->personal_id}}</span>
        </div>
        <div class="col-md-4 col-sm-4">
                <label>Full Name :</label>
                <span>{{$data->first_name}} {{$data->middle_name}} {{$data->last_name}}</span>
        </div>
        <div class="col-md-4 col-sm-4">
                <label>Gender :</label>
                <span>{{$data->gend_name}} </span>
        </div>
        <div class="col-md-4 col-sm-4">
                <label>Contact No  :</label>
                <span>{{$data->mobile}}</span>
        </div>
        <div class="col-md-4 col-sm-4">
                <label>Posted Date:</label>
                <span>{{$data->postdatead}}(AD) / {{$data->postdatebs}}(BS)</span>
        </div>
        
        <div class="col-md-4 col-sm-4">
                <label>Date of Birth:</label>
            <span>{{$data->birth_datead}}</span>
        </div>
        <div class="col-md-4 col-sm-4">
                <label>Nationality:</label>
                <span>{{$data->nationality}}</span>
        </div>
       
<div class="col-md-4 col-sm-4">
  
    <span>{{$data->nature_title}}</span>
    
    @php($referrer_type_id=!empty($data->referrer_type_id)?$data->referrer_type_id:'')
    @php($referrer=!empty($data->rein_id)?$data->rein_id:'')
    @if(!empty($referrer) && $referrer!='0' )
    @php($result_reffer= get_tbl_data('rein_name','referrer_info',array('id'=>$referrer)))
    @php($co_referrer=!empty($data->rein_id)?$data->rein_id:'')
    
    @if(!empty($referrer_type_id) && ($referrer_type_id)=='1' )
    @if(!empty($referrer))
        
        <span>{{$result_reffer[0]->rein_name}}</span>:
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
       
        </div>
        @endif

    </div>
    <div class="form-group general_info white-box pad-5">
            <div class="row first-row">
            <div class="col-md-4 col-sm-4">
               <label>Payment Date :</label>:{{$data->paymentdatead}}(AD) - {{$data->paymentdatebs}}(BS)
            </div>
            <div class="col-md-4 col-sm-4">
                <label>Checkup Type :</label>
                <span>{{$data->chse_name}}</span>
            </div>
            <div class="col-md-4 col-sm-4">
              <label>Payment Mode :</label>@if($data->payment_mode=='1') @php($pstatus='Cash') @else @php($pstatus='Credit') @endif {{$pstatus}}
            </div>
         
    
        </div>
           
    </div>
