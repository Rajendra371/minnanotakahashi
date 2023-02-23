<!DOCTYPE html>
<html>
<head>
    <style type="text/css">
    .pay {
 border: 1px solid;
 border-radius: 10px;
 box-shadow: 5px 5px black;
 width:fit-content;
 display: inline-block;
 padding:5px 10px;

}
     .alt_table{
         margin-bottom:3rem
     }
 .alt_table tbody tr td label {
     font-size:18px;
     padding:15px;
     font-weight:600
 }

 .alt_table tbody tr td span{
    font-weight:600;
    font-size:18px;
 }
</style>
</head>
<body>

        <table class="main-table">
        
			<tr>
				<td col style="width: 20%;">
				<img src="../../../public/images/nepolianlogo.png" width="150px" height="100px"style="margin-bottom:2rem">
				<p style="font-weight:700;font-size:18px">Personal ID: <span>{{$data->personal_id}}</span></p></td>
				<td class="top-title" col style="width: 40%; text-align:center;" >
					<h2 style="font-size: 26px;font-weight:700;text-transform: capitalize;margin:5px 0 !important;border-bottom:3px solid">नेपोलियन हेल्थ केयर सेन्टर (प्रा.) लि. </h2>
					<h2 style="font-size: 20px;font-weight:700;text-transform: capitalize;margin:5px 0 ;">NEPOLIAN HEALTH CARE CENTER (P.) LTD.</h2>
					<p class="main-tabl-02" style="margin: 5px 0 2rem 0;font-size:18px">Samakhusi-29, Townplanning, Kathmandu, Nepal</p>
					<h2 class="pay" style="font-size: 24px;font-weight:700;text-transform: capitalize;margin:5px 0 10px;">PERSONAL INFORMATION</h2>

					
                <td col style="width: 20%;position: relative;"><p style="position: absolute;top: 0;right: 0px;">Gov. Reg. No. 68047/066/067</p>
                <div class="image" style="position: relative;float: right;margin: 30px 0 0 0 ;" >
				<img src="" width="150px" height="150px" style="">
			</div>
		</table></td>
			</tr>
        </table>
        <p style="background: #000!important;color: #fff;text-transform: uppercase;font-size: 18px;width: 250px;
    text-align: center;
    margin: 0 0 0 25px;margin-bottom:3px;">detail information</p>
        <table  class="alt_table ">
        <tbody>
        <tr>
            <td><label>Full Name :</label> <span>{{$data->first_name}} {{$data->middle_name}} {{$data->last_name}}</span></td>
            <td><label>Birth Date :</label> <span>{{$data->birth_datead}}</span></td>
            <td><label>Gender :</label>  
        @php($gender=$data->gender_id)
         @if(!empty($gender))
         @php($result= get_tbl_data('gend_name','gender',array('id'=>$gender)))
         <span>{{$result[0]->gend_name}}</span>
         @else
         <span></span>
         @endif</td>
        </tr>

        <tr>
            <td><label>Father Name :</label>
         <span>{{$data->father_name}}</span></td>
            <td><label>Mother Name :</label>
         <span>{{$data->mother_name}}</span></td>
            <td><label>Nationality :</label>
         <span>{{$data->nationality}}</span></td>
        </tr>

        <tr>
            <td><label>Citizenship No. :</label>
         <span>{{$data->cizitenship_no}}</span></td>
         <td><label>Mobile:</label>
         <span>{{$data->mobile}}</span></td>
            <td><label>Passport No :</label>
         <span>{{$data->passport_no}}</span></td>
            
        </tr>
        <td><label>Passport Issue Date :</label>
         <span>{{$data->passport_issue_datead}}</span></td>
         <td><label>Passport Expiry Date :</label>
         <span>{{$data->passport_expiry_datead}}</span></td>
            <td><label>Passport Issue Place :</label>
         <span>{{$data->passport_issue_place}}</span></td>
            
        </tr>

        <tr>
            <td colspan="3">
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
        </td>
        </tr>
        </tbody>

        </table>

        <p style="background: #000!important;color: #fff;text-transform: uppercase;font-size: 18px;width: 250px;
    text-align: center;
    margin: 0 0 0 25px;margin-bottom:3px;">temporary address</p>
        <table  class="alt_table ">
       
        <tbody>
        <tr>
            <td><label>State :</label>
         @php($state=$data->perm_state_id)
         @if(!empty($state))
         @php($result= get_tbl_data('stat_name','state',array('id'=>$state)))
         <span>{{$result[0]->stat_name}}</span>
         @else
         <span></span>
         @endif</td>

            <td>  <label>District :</label>
         @php($district=$data->perm_district_id)
         @if(!empty($district))
         @php($result= get_tbl_data('dist_name','district',array('id'=>$district)))
         <span>{{$result[0]->dist_name}}</span>
         @else
         <span></span>
         @endif</td>

            <td><label>VDC :</label>
         @php($vdc=$data->perm_vdc_id)
         @if(!empty($vdc))
         @php($result= get_tbl_data('vdc_namenp','vdc',array('id'=>$vdc)))
         <span>{{$result[0]->vdc_namenp}}</span>
         @else
         <span></span>
         @endif</td>
        </tr>

        <tr>
            <td colspan="2"><label>Address :</label>
         <span>{{$data->perm_address}}</span></td>


            <td><label>Ward :</label>
         @php($ward=$data->perm_ward_id)
         @if(!empty($ward))
         @php($result= get_tbl_data('wase_name','ward_setup',array('id'=>$ward)))
         @else
         <span>{{$result[0]->wase_name}}</span>
         @endif</td>
            
        </tr>

     
        </tbody>

        </table>
        <p style="background: #000!important;color: #fff;text-transform: uppercase;font-size: 18px;width: 250px;
    text-align: center;
    margin: 0 0 0 25px;margin-bottom:3px;">temporary address</p>
        <table  class="alt_table ">
        
        <tbody>
        <tr>
            <td><label>State :</label>
         @php($state=$data->temp_state_id)
         @if(!empty($state))
         @php($result= get_tbl_data('stat_name','state',array('id'=>$state)))
         <span>{{$result[0]->stat_name}}</span>
         @else
         <span></span>
         @endif</td>

            <td> <label>District :</label>
         @php($district=$data->temp_district_id)
         @if(!empty($district))
         @php($result= get_tbl_data('dist_name','district',array('id'=>$district)))
         <span>{{$result[0]->dist_name}}</span>
         @else
         <span></span>
         @endif</td>

            <td><label>VDC :</label>
         @php($vdc=$data->temp_vdc_id)
         @if(!empty($vdc))
         @php($result= get_tbl_data('vdc_namenp','vdc',array('id'=>$vdc)))
         <span>{{$result[0]->vdc_namenp}}</span>
         @else
         <span></span> @endif</td>
        </tr>

        <tr>
            <td colspan="2"><label>Address :</label>
         <span>{{$data->temp_address}}</span></td>
            <td><label>Ward :</label>
         @php($ward=$data->temp_ward_id)
         @if(!empty($ward))
         @php($result= get_tbl_data('wase_name','ward_setup',array('id'=>$ward)))
         @else
         <span>{{$result[0]->wase_name}}</span>

         @endif</td>
            
        </tr>

     
        </tbody>

        </table>


</body>
</html>