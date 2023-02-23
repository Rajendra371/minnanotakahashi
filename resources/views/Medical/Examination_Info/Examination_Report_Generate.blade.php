<html>
<head>

	<style type="text/css">
p {
    margin: 0px;
    font-size: 12px;
}
h3 {
    margin: 0;
    font-size: 13px;
}
span {
    display: block;
    text-transform: uppercase;
}
.div-table:before{
	clear: both;
	display: block;
	content: "";
}
.div-table:after{
	clear: both;
	display: block;
	content: "";
}

table td, table th{
	padding-left:5px
}


.letter:before {
    content: "";
    display: block;
    clear: both;
}
.letter:after {
    content: "";
    display: block;
    clear: both;
}
.table-02:before {
    content: "";
    display: block;
    clear: both;
}
.table-02:after {
    content: "";
    display: block;
    clear: both;
}
.clear:before {
    content: "";
    display: block;
    clear: both;
}
.clear:after {
    content: "";
    display: block;
    clear: both;
}
.clear-fix:before {
    content: "";
    display: block;
    clear: both;
}
.clear-fix:after {
    content: "";
    display: block;
    clear: both;
}
body:before {
    content: "";
    display: block;
    clear: both;
}
body:after {
    content: "";
    display: block;
    clear: both;
}
@media print {
body {-webkit-print-color-adjust: exact;}
}

</style>
</head>
	<body style="border: 1px solid;height: 1085px;border-right: none; padding: 14px;">
		<table>
			<tr>
				<td col style="width: 30%;">
				<img src="../../../public/images/nepolianlogo.png" width="150px" height="100px"style="margin-bottom:15px">
				<p style="font-weight: bolder;">S.NO:200212</p></td>
				<td class="top-title" col style="width: 45%; text-align:center;" >
					<h2 style="font-size: 24px;font-weight:700;text-transform: capitalize;margin:5px 0 !important;border-bottom:3px solid">नेपोलियन हेल्थ केयर सेन्टर (प्रा.) लि. </h2>
					<h2 style="font-size: 20px;font-weight:700;text-transform: capitalize;margin:5px 0 ;">NEPOLIAN HEALTH CARE CENTER (P.) LTD.</h2>
					<p class="main-tabl-02" style="margin: 5px 0 1rem 0;font-size:18px">Samakhusi-29, Townplanning, Kathmandu, Nepal</p>
					<span style="background: #000!important;color: #fff;word-spacing: 6px;margin: 0px 60px 0 60px;font-size: 16px;padding:2px 15px !important">medical examination report</span>
					<span style="font-weight: bolder;margin: 0 166px;padding: 7px 10px;border: 1px solid;
	margin-top: 7px;margin-bottom: 28px; ">
	@php($fit_unfit=!empty($data['personal_data']->result)?$data['personal_data']->result:'--')
	@if($fit_unfit=='F'){{'Fit'}} @endif @if($fit_unfit=='U'){{'unfit'}} @endif
	</span>
				</td>
				<td col style="width: 25%;position: relative;"><p style="position: absolute;top: 0;right: 0px;">Gov. Reg. No. 68047/066/067</p></td>
			</tr>
		</table>
		{{-- @php($data=$data); --}}
		<?php
	// 	 echo "<pre>";
    //   print_r( $data );
    //   die(); 
		?>
		<table class="table-02">
				<table style="width: 80%;border: 1px solid;text-align: left; float: left;margin-bottom: 1.5rem;" cellspacing="0">
					<tr>
						<td style="border-right: 1px solid; border-bottom: 1px solid;font-size: 18px;">Name</td>
						<th style="border-right: 1px solid; border-bottom: 1px solid;font-size: 18px;text-align: center;">{{ucwords($data['personal_data']->first_name.' '.$data['personal_data']->middle_name.' '.$data['personal_data']->last_name)}}</th>
						<td style="border-right: 1px solid; border-bottom: 1px solid;font-size: 18px;">Age(year):</td>
						<td style="border-right: 1px solid; border-bottom: 1px solid;font-size: 18px;">{{calcutateAge($data['personal_data']->birth_datead)}}</td>
						<td style="border-right: 1px solid; border-bottom: 1px solid;font-size: 18px;">Sex:</td>
					<td style="border-right: 1px solid; border-bottom: 1px solid;font-size: 18px;">{{substr($data['personal_data']->gend_name, 0, 1)}}</td>
						<td style="border-right: 1px solid; border-bottom: 1px solid;font-size: 13px;">Maritial Status:</td>
					<td style="border-bottom: 1px solid;font-size: 13px;">{{$data['personal_data']->maritial_status}}</td>
					</tr>
					<tr>
						<td style=" border-right: 1px solid; border-bottom: 1px solid; font-size: 18px;">Passport No.</td>
					<th style=" border-right: 1px solid; border-bottom: 1px solid; padding: 0 70px; font-size: 18px;text-align: center;">{{$data['personal_data']->passport_no}}</th>
						<td style=" border-right: 1px solid; border-bottom: 1px solid;  font-size: 18px;">Expired On:</td>
						<td style=" border-right: 1px solid; border-bottom: 1px solid; font-size: 13px;">{{$data['personal_data']->passport_expiry_datead}}</td>
						<td style=" border-right: 1px solid; border-bottom: 1px solid; font-size: 18px;" colspan="3">Passport issue place:</td>
						<td style="border-bottom: 1px solid; font-size: 13px;">{{$data['personal_data']->passport_issue_place}}</td>
					</tr>
					<tr>
					<td style="border-right: 1px solid; font-size: 9px;" colspan="" width="">Medical Exam. Date:</td>
					<th style="border-right: 1px solid; font-size: 18px;text-align: center;">{{$data['personal_data']->paymentdatead}}</th>
						<td style="border-right: 1px solid; font-size: 13px;">Job Applied for:</td>
					<th style="border-right: 1px solid; font-size: 18px;">{{$data['personal_data']->coun_name}}</th>
						<td style="border-right: 1px solid; font-size: 18px;" colspan="3">Nationality</td>
						<td style="font-size: 18px;">{{$data['personal_data']->nationality}}</td>
					</tr>
				</table>

			<div class="image" style="position: relative;float: right;margin: -75px 0 0 0;" >
				<img src="" width="150px" height="150px" style="">
			</div>
		</table>

		<div class="table-03" style="">
			<span style="font-size: 13px;width: 190px;text-align: center;background:#000 !important;display:block!important;color: white;clear: both;margin: 20px 25px 0px;">general information</span>
			<span style="font-size: 16px;margin: 0 0 5px 0;">1. Past history of serious illness,Major surgery,and significant psychological problem including Epilepsy: None </span>
			<span style="font-size: 16px;">2.Past history of allergy: None</span>

		</div>

		<table style="width: 100%;border: 1px solid;margin: 7px 0;" cellspacing="0">
			@if(!empty($data['general_examination']))
			@php($i=1)
			 @foreach($data['general_examination'] as  $gd)
			
			 @if($i%4 =='1')
			<tr>
			@endif
			<td style="border-right: 1px solid; border-bottom: 1px solid; font-size: 18px;">{{$gd->examination_name}}</td>
			<td style="border-right: 1px solid; border-bottom: 1px solid; font-size: 18px;">{{!empty($gd->chkdata)?$gd->chkdata:'No Data' }}</td>
			@php($i++)
			@endforeach
			@endif
			
		</table>
		<div class="clearfix">
				<div class="table-div" style="position: relative; margin: 0px 0 0 0;float:left;width:40%;margin-top: 30px;">
			<table style="position: relative;width: 100%;border: 1px solid; border-bottom: none;" cellspacing="0">
				<p style="background: #000!important;color: #fff;text-transform: uppercase;font-size: 13px;width: 200px;
    text-align: center;
    margin: 0 0 0 25px;margin-bottom:1px">Systematic Examination</p>
				<tr>
					<th style="border-right: 1px solid;border-bottom: 1px solid ;font-size: 18px;" colspan="2">Type of Medical Examination</th>
					<th style="font-size: 18px; border-bottom: 1px solid">Findings</th>
				</tr>
				@if(!empty($data['system_examination']))
				@php($i=1)
				 @foreach($data['system_examination'] as  $em)
				<tr>
					<td style=" border-bottom: 1px solid;   font-size: 18px;" colspan="2">{{$em->examination_name}}</td>
					<td style=" border-bottom: 1px solid;border-left: 1px solid;   font-size: 18px;" colspan="2">{{!empty($em->chkdata)?$em->chkdata:'No Data' }}</td>
				</tr>
				@php($i++)
				@endforeach
				@endif
			  <div style="width: 100%;position: absolute;top: 452px;border: 1px solid;padding: 140px 10px;" class="letter">
				<span style="padding: 0 0 30px 0;font-size: 10px;">DEAR SIR,</span>
				<p style="font-size: 11px;">THIS IS TO CERTIFY THAT MR. KRISHNA SINGH B K IS CLINICALLY AND MENTALLY FIT AND THERE IS NO EVIDENCE OF COMMUNICABLE DISEASE IN HIM</p>
				<div class="clear">
				<span style="float: left;margin: 100px 0 0 0;font-size: 9px;width: 50%;">(Stamp of Health Care Organisation)</span>
				<a href="" class="link" style="float: right;margin: 85px 0px 0 0;font-size: 9px;color: #000;text-decoration: none;">
					<li style="border-top: 1px dashed;text-decoration: none;list-style: none;margin: 0 0 14px 0;"></li>
					<span >
						(Stamp and Signature of Physician)
					</span>
				</a>
				</div>
			</div> 
			</table>
		</div><!-- .table-div-->

	<div class="float" style="float: right;width: 60%;position: relative;top: 20px;border: 1px solid;margin-top: 30px;" cellspacing="0">
		<p style="    width: 250px;background-color: #000;color: #fff;text-transform: uppercase;text-align: center;/* margin: 0px 170px; */position: absolute;top: -20px;left: 200px;">
		 		Laboratory Examination
		 	</p>
			 
					@if(!empty($data['lab_examination']))
					@php($j=1)
					@foreach($data['lab_examination'] as $lexm)
					<table class="first-rotate" cellspacing="0" style="width: 100%;">
		 			<tr>
					 <th rowspan="13" style="border-bottom: 1px solid;border-right:1px solid;width:1%"><p style="font-size: 16px;writing-mode: tb-rl; transform: rotate(-180deg);">{{$lexm->examination_name}}</p></th>
					 @if($j==1)
					 <th style="width:45%;font-size: 18px;border-bottom: 1px solid;border-right:1px solid;" colspan="2">Blood Examination</th>
		 			 <th style="width:25%;font-size: 18px;border-bottom: 1px solid;border-right:1px solid;" colspan="1">Result</th>
					 <th style="width:35%;font-size: 18px;border-bottom: 1px solid" colspan="1">Referance Ranges</th>
					 @endif
					</tr>
					 <?php 
					 $dat_per=$data['personal_data'];

					 $pc_labdata=\DB::select("SELECT pc.id as pcid,pc.pace_parent_id, pc.examination_name,pc.from_range,pc.to_range,
						(SELECT checkup_data FROM personal_medical_data pmd INNER JOIN examination_master em on em.id=pmd.examination_masterid
						WHERE pmd.examination_typeid=pc.id AND em.id=$dat_per->exmid ) as chkdata
							from partial_checkup pc WHERE pc.pace_parent_id=$lexm->pcid AND pc.isactive='Y'");
			
					//  $pc_labdata=\DB::table('partial_checkup')->where('pace_parent_id',$lexm->pcid)->where('isactive','Y')->get();

					 ?>

					 @if(!empty($pc_labdata))
					 @foreach($pc_labdata as $ldat)
					 <?php
					//  $chk_anotherchild=\DB::table('partial_checkup')->where('pace_parent_id',$ldat->id)->where('isactive','Y')->get();

					 $chk_anotherchild=\DB::select("SELECT pc.id as pcid,pc.pace_parent_id, pc.examination_name,pc.from_range,pc.to_range,
						(SELECT checkup_data FROM personal_medical_data pmd INNER JOIN examination_master em on em.id=pmd.examination_masterid
						WHERE pmd.examination_typeid=pc.id AND em.id=$dat_per->exmid ) as chkdata
							from partial_checkup pc WHERE pc.pace_parent_id=$ldat->pcid AND pc.isactive='Y'");

					 $cnt_anotherchild=count($chk_anotherchild);
					 ?>
					 @if($cnt_anotherchild>0)
					 <tr>
							<td style=" font-size: 18px;border-bottom: 1px solid;border-right:1px solid;" colspan="4"> {{$ldat->examination_name}}</td>
					 </tr>
					 @else
					 <tr>

							<td style="width:45%; font-size: 18px;border-bottom: 1px solid;border-right:1px solid;" colspan="2"> {{$ldat->examination_name}}</td>
							<td style="width:25%;font-size: 18px;border-bottom: 1px solid;border-right:1px solid;" colspan="1">{{!empty($ldat->chkdata)?$ldat->chkdata:'No Data'}}</td>
							<td style="width:35%; font-size: 18px;border-bottom: 1px solid;" colspan="1">{{$ldat->from_range.'-'.$ldat->to_range}}</td>
							</tr>
					 @endif
					
					@if($cnt_anotherchild>0)
						@foreach($chk_anotherchild as $cnc)
						<tr>

								<td style="width:45%;font-size: 18px;border-bottom: 1px solid;border-right:1px solid;" colspan="2"> {{$cnc->examination_name}}</td>
						<td style="width:25%; font-size: 18px;border-bottom: 1px solid;border-right:1px solid;" colspan="1">{{!empty($cnc->chkdata)?$cnc->chkdata:'No Data'}}</td>
							   <td style="width:35%; font-size: 18px;border-bottom: 1px solid;" colspan="1">{{$cnc->from_range.'-'.$cnc->to_range}}</td>
							   </tr>
						@endforeach
					@endif
		 			
					 @endforeach
					 @endif
					</table>
					@php($j++)
					@endforeach
					@endif
		 	 	<div style="padding: 8px 0;border-right: none;">
		 		<a href="#" style="text-align: right;
    text-decoration: none;
    color: #000;
    font-size: 12px;
       float: right;
    margin: 27px 30px 0 0;">
		 			<li style="list-style: none;border: 1px dashed;margin: 21px 0 7px 0;"></li>
		 			<span>(Signature of Lab Technician)</span>
		 		</a>
		 		<p style="clear: both;text-transform: capitalize;background: #808080a8;text-align: center;font-size: 10px;">this report is vaild for two months from the date of medical examination.</p>
		 	</div>


	</div>	<!-- .FLOAT  -->
	</div><!-- .clearfix  -->





		 	



	</body>
</html>