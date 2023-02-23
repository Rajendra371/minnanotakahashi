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
.voucher{
margin:0 auto;
position:relative;
}

</style>
</head>
<body>
<div class="voucher" style=" margin-bottom:3rem">
	<table class="main-table">
			<tr>
				<td col style="width: 20%;">
				<img src="../../../public/images/nepolianlogo.png" width="150px" height="100px"style="margin-bottom:5px">
				<p>Invoice No :{{$data['billing_info']->invoice_no}}</p></td>
				<td class="top-title" col style="width: 40%; text-align:center;" >
					<h2 style="font-size: 26px;font-weight:700;text-transform: capitalize;margin:5px 0 !important;border-bottom:3px solid">नेपोलियन हेल्थ केयर सेन्टर (प्रा.) लि. </h2>
					<h2 style="font-size: 20px;font-weight:700;text-transform: capitalize;margin:5px 0 ;">NEPOLIAN HEALTH CARE CENTER (P.) LTD.</h2>
					<p class="main-tabl-02" style="margin: 5px 0 0 0;font-size:18px">Samakhusi-29, Townplanning, Kathmandu, Nepal</p>
					<h2 class="pay" style="font-size: 24px;font-weight:700;text-transform: capitalize;margin:5px 0 10px;">PAYMENT VOUCHER</h2>

					
				<td col style="width: 20%;position: relative;"><p style="position: absolute;top: 0;right: 0px;">Gov. Reg. No. 68047/066/067</p></td>
			</tr>
		</table>

		<table class="main-table" style="border: 1px solid; width: 100%;border-bottom: none;" cellspacing="0">
			<thead>
				<tr>
					<th style="border-right:1px solid;border-bottom: 1px solid;padding:15px 10px;text-align: left;font-size: 16px;">PersonID / Name :{{$data['billing_info']->personal_id}} / {{$data['billing_info']->first_name.' '.$data['billing_info']->middle_name.' '.$data['billing_info']->last_name}}</th>
                <th style="border-right:1px solid;border-bottom: 1px solid;padding:15px 10px;text-align: left;font-size: 16px;">Age/Gender :@php($db_age=$data['billing_info']->birth_datead) @php($age= calcutateAge($db_age)) {{$age}}/{{substr($data['billing_info']->gend_name, 0, 1)}}</th>
					<th style="padding:15px 10px;border-bottom: 1px solid;text-align: left;font-size: 16px;">Date :{{$data['billing_info']->paymentdatead}}</th>
				</tr>
				<tr>
					<th style="border-bottom: 1px solid;border-right:1px solid;padding:15px 10px;    text-align: left;font-size: 16px;">Apply Country /PP.No:{{$data['billing_info']->coun_name.'/'.$data['billing_info']->passport_no}}</th>
					<th style="border-bottom: 1px solid;border-right:1px solid;padding:15px 10px;    text-align: left;font-size: 16px;">Source Type:{{$data['billing_info']->nature_title}}</th>
					<th style="border-bottom: 1px solid;padding:15px 10px;    text-align: left;font-size: 16px;">Checkup Type:{{$data['billing_info']->chse_name}}</th>
				</tr>
			</thead>
			<tbody style="margin-top: 28px;">
				<tr>
					<th colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;padding: 20px 10px;font-size: 16px;">Examination</th>
					<th  style="border-bottom: 1px solid;padding: 20px 10px;font-size: 16px;">Amount</th>
                 </tr>
                 <tr>
				 <td colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;padding: 10px 10px;font-size: 16px;">
					@if($data['checkup_type_id']=='3') 
					@php($exmdata ='')
				
						@if(!empty($data['examinationdata']))
						
							@foreach($data['examinationdata'] as $exm)
								@php($exmdata .= $exm->examination_name.', ')
							@endforeach
						@endif
						<span>{{$exmdata}}</span>
						@else
						{{'All'}}
					@endif
				</td>
                 <td style="border-bottom: 1px solid;padding: 10px 10px;font-size: 16px;">{{number_format($data['billing_info']->person_paid_amount,2)}}</td>
                 </tr>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;font-size: 16px;padding: 10px 10px;">Sub Total</th>
					<th style="text-align: left;border-bottom: 1px solid;font-size: 16px;padding: 8px 0 3px 10px;">{{number_format($data['billing_info']->person_paid_amount,2)}}</th>
				</tr>
				<tr>
					<th colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;font-size: 16px;padding: 10px 10px;">Discount</th>
					<th style="text-align: left;border-bottom: 1px solid;font-size: 16px;padding: 8px 0 3px 10px;">-</th>
				</tr>
				<tr>
					<th colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;font-size: 16px;padding: 10px 10px;">Tax</th>
					<th style="text-align: left;border-bottom: 1px solid;font-size: 16px;padding: 8px 0 3px 10px;">-</th>
				</tr>
				<tr>
					<th colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;font-size: 16px;padding: 10px 10px;">Grand Total</th>
					<th style="font-size: 16px;border-bottom: 1px solid;text-align: left;padding: 8px 5px 3px 10px;">{{number_format($data['billing_info']->person_paid_amount,2)}}</th>
				</tr>
				<tr>
					<th colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;font-size: 16px;padding: 10px 10px;">Due Balance</th>
					<th style="font-size: 16px;text-align: left;padding: 8px 5px 3px 10px;">{{number_format($data['billing_info']->person_due_amount,2)}}</th>
                </tr>
                <tr>
                    <th colspan="3" style="font-size: 16px;text-align: left;padding: 20px 5px !important;">
                        In Word: {{ucwords(convert_to_word($data['billing_info']->person_paid_amount))}}
                    </th>
                </tr>
			</tfoot>
		</table>
		
		<div style="border: 1px solid;padding: 20px;background: #8080801f;">
			{{-- <h1 style="font-size: 20px;">Bill</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> --}}
			<li style="border-top: 1px dashed;width: 188px;list-style: none;margin: 50px 0 0 0;"></li>
			<span>Signature</span>
		
		</div>

	</div>


	<div class="voucher" style="margin-top:2rem">
	<table class="main-table">
			<tr>
				<td col style="width: 20%;">
				<img src="../../../public/images/nepolianlogo.png" width="150px" height="100px"style="margin-bottom:5px">
				<p>Invoice No :{{$data['billing_info']->invoice_no}}</p></td>
				<td class="top-title" col style="width: 40%; text-align:center;" >
					<h2 style="font-size: 26px;font-weight:700;text-transform: capitalize;margin:5px 0 !important;border-bottom:3px solid">नेपोलियन हेल्थ केयर सेन्टर (प्रा.) लि. </h2>
					<h2 style="font-size: 20px;font-weight:700;text-transform: capitalize;margin:5px 0 ;">NEPOLIAN HEALTH CARE CENTER (P.) LTD.</h2>
					<p class="main-tabl-02" style="margin: 5px 0 0 0;font-size:18px">Samakhusi-29, Townplanning, Kathmandu, Nepal</p>
					<h2 class="pay" style="font-size: 24px;font-weight:700;text-transform: capitalize;margin:5px 0 10px;">PAYMENT VOUCHER</h2>

					
				<td col style="width: 20%;position: relative;"><p style="position: absolute;top: 0;right: 0px;">Gov. Reg. No. 68047/066/067</p></td>
			</tr>
		</table>

		<table class="main-table" style="border: 1px solid; width: 100%;border-bottom: none;" cellspacing="0">
			<thead>
				<tr>
					<th style="border-right:1px solid;border-bottom: 1px solid;padding:15px 10px;text-align: left;font-size: 16px;">PersonID / Name :{{$data['billing_info']->personal_id}} / {{$data['billing_info']->first_name.' '.$data['billing_info']->middle_name.' '.$data['billing_info']->last_name}}</th>
                <th style="border-right:1px solid;border-bottom: 1px solid;padding:15px 10px;text-align: left;font-size: 16px;">Age/Gender :@php($db_age=$data['billing_info']->birth_datead) @php($age= calcutateAge($db_age)) {{$age}}/{{substr($data['billing_info']->gend_name, 0, 1)}}</th>
					<th style="padding:15px 10px;border-bottom: 1px solid;text-align: left;font-size: 16px;">Date :{{$data['billing_info']->paymentdatead}}</th>
				</tr>
				<tr>
					<th style="border-bottom: 1px solid;border-right:1px solid;padding:15px 10px;    text-align: left;font-size: 16px;">Apply Country /PP.No:{{$data['billing_info']->coun_name.'/'.$data['billing_info']->passport_no}}</th>
					<th style="border-bottom: 1px solid;border-right:1px solid;padding:15px 10px;    text-align: left;font-size: 16px;">Source Type:{{$data['billing_info']->nature_title}}</th>
					<th style="border-bottom: 1px solid;padding:15px 10px;    text-align: left;font-size: 16px;">Checkup Type:{{$data['billing_info']->chse_name}}</th>
				</tr>
			</thead>
			<tbody style="margin-top: 28px;">
				<tr>
					<th colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;padding: 20px 10px;font-size: 16px;">Examination</th>
					<th  style="border-bottom: 1px solid;padding: 20px 10px;font-size: 16px;">Amount</th>
                 </tr>
                 <tr>
				 <td colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;padding: 10px 10px;font-size: 16px;">
					@if($data['checkup_type_id']=='3') 
					@php($exmdata ='')
				
						@if(!empty($data['examinationdata']))
						
							@foreach($data['examinationdata'] as $exm)
								@php($exmdata .= $exm->examination_name.', ')
							@endforeach
						@endif
						<span>{{$exmdata}}</span>
						@else
						{{'All'}}
					@endif
				</td>
                 <td style="border-bottom: 1px solid;padding: 10px 10px;font-size: 16px;">{{number_format($data['billing_info']->person_paid_amount,2)}}</td>
                 </tr>
			</tbody>
			<tfoot>
				<tr>
					<th colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;font-size: 16px;padding: 10px 10px;">Sub Total</th>
					<th style="text-align: left;border-bottom: 1px solid;font-size: 16px;padding: 8px 0 3px 10px;">{{number_format($data['billing_info']->person_paid_amount,2)}}</th>
				</tr>
				<tr>
					<th colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;font-size: 16px;padding: 10px 10px;">Discount</th>
					<th style="text-align: left;border-bottom: 1px solid;font-size: 16px;padding: 8px 0 3px 10px;">-</th>
				</tr>
				<tr>
					<th colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;font-size: 16px;padding: 10px 10px;">Tax</th>
					<th style="text-align: left;border-bottom: 1px solid;font-size: 16px;padding: 8px 0 3px 10px;">-</th>
				</tr>
				<tr>
					<th colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;font-size: 16px;padding: 10px 10px;">Grand Total</th>
					<th style="font-size: 16px;border-bottom: 1px solid;text-align: left;padding: 8px 5px 3px 10px;">{{number_format($data['billing_info']->person_paid_amount,2)}}</th>
				</tr>
				<tr>
					<th colspan="2" style="border-right: 1px solid;border-bottom: 1px solid;font-size: 16px;padding: 10px 10px;">Due Balance</th>
					<th style="font-size: 16px;text-align: left;padding: 8px 5px 3px 10px;">{{number_format($data['billing_info']->person_due_amount,2)}}</th>
                </tr>
                <tr>
                    <th colspan="3" style="font-size: 16px;text-align: left;padding: 20px 5px !important;">
                        In Word: {{ucwords(convert_to_word($data['billing_info']->person_paid_amount))}}
                    </th>
                </tr>
			</tfoot>
		</table>

		<div style="border: 1px solid;padding: 20px;background: #8080801f;">
			{{-- <h1 style="font-size: 20px;">Bill</h1>
			<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p> --}}
			<li style="border-top: 1px dashed;width: 188px;list-style: none;margin: 50px 0 0 0;"></li>
			<span>Signature</span>
		</div>

	</div>


	

</body>
</html>