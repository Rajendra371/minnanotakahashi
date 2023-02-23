<html>
<head>
	<title>PAYMENT VOUCHER</title>
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
	<style type="text/css">
		.top-wrapper:before {
			display: block;
			clear: both;
			content: '';
		}
		.top-wrapper:after {
			display: block;
			clear: both;
			content: '';
		}
	</style>
</head>
<body style="font-family: 'Roboto', sans-serif;">
<div class="table">
	<div style="text-align: center;">
		<h1 style="text-decoration: underline;margin: 0;font-size: 28px;">PAYMENT VOUCHER</h1>
		{{-- <p style="font-size: 21px;margin: 0;">The Incorporated Owners of XX Buliding</p> --}}
	</div>
	<div class="bottom-header">
		<p style="font-weight: bold;text-align: right;font-size: 16px;">
			No.:_________________
		</p>
		<p style="text-align: right;font-size: 16px;">
			Date:{{CURDATE_EN}}
		</p>
		<p style="text-align: left;font-size: 16px;">
			Pay To:{{$data['referrer_info']->rein_name.' '.$data['referrer_info']->address}}
		</p>
	</div>
	<table style="border: 1px solid;width: 100%;" cellspacing="0">
		<thead>
			<tr style="background: #cbcbea5e;padding:21px 0;">
				<td style="border-bottom: 1px solid;border-right: 1px solid;width: 150px;font-weight: bold;padding: 28px 0;padding-left: 10px;">S.n.</td>
				<td style="border-bottom: 1px solid;border-right: 1px solid;font-weight: bold;padding: 28px 0;padding-left: 10px;width: 485px;">Particulars</td>
				<td style="border-bottom: 1px solid;border-right: 1px solid;width: 120px;font-weight: bold;padding: 28px 0;padding-left: 10px;">Dr. Amount</td>
				<td style="border-bottom: 1px solid;width: 120px;font-weight: bold;padding: 28px 0;padding-left: 10px;">Cr. Amount</td>
			</tr>
			<tr>
				<td style="border-bottom: 1px solid;border-right: 1px solid;padding: 21px 0;">1.</td>
				<td style="border-bottom: 1px solid;border-right: 1px solid;padding: 21px 0;">Payment of Referrer</td>
				<td style="border-bottom: 1px solid;border-right: 1px solid;padding: 21px 0;">0.</td>
				<td style="border-bottom: 1px solid;padding: 21px 0;">{{$data['gamount']}}</td>
			</tr>		
			<tr>
				<td style="border-bottom: 1px solid;border-right: 1px solid;padding: 21px 0;"></td>
				<td style="border-bottom: 1px solid;border-right: 1px solid;padding: 21px 0;"></td>
				<td style="border-bottom: 1px solid;border-right: 1px solid;padding: 21px 0;"></td>
				<td style="border-bottom: 1px solid;padding: 21px 0;"></td>
			</tr>
			<tr>
				<td style="border-bottom: 1px solid;border-right: 1px solid;padding: 21px 0;"></td>
				<td style="border-bottom: 1px solid;border-right: 1px solid;padding: 21px 0;"></td>
				<td style="border-bottom: 1px solid;border-right: 1px solid;padding: 21px 0;"></td>
				<td style="border-bottom: 1px solid;padding: 21px 0;"></td>
			</tr>			
			<tr>
				<td style="border-bottom: 1px solid;border-right: 1px solid;padding: 21px 0;"></td>
				<td style="border-bottom: 1px solid;border-right: 1px solid;padding: 21px 0;"></td>
				<td style="border-bottom: 1px solid;border-right: 1px solid;padding: 21px 0;"></td>
				<td style="border-bottom: 1px solid;padding: 21px 0;"></td>
			</tr>			
			<tr>
				<td style="border-right: 1px solid;padding: 21px 0;"></td>
				<td style="border-right: 1px solid;text-align: right;font-weight: bold;padding-right: 12px;font-size: 24px;">TOTAL</td>
				<td style="border-right: 1px solid;padding: 21px 0;"></td>
				<td style="padding: 21px 0;">{{number_format($data['gamount'],2)}}</td>
            </tr>
            <tr>
                <td colspan="4">
                    In Word :{{convert_to_word($data['gamount'])}}
                </td>
            </tr>
		</thead>
	</table>

	<div class="footer">
		<div class="top-wrapper" style="position: relative;">
        <p style="float: left;">Bank Account:@if(!empty($data['bank_info'])) {{$data['bank_info']->bank_name.' '.$data['bank_info']->bank_account_no}} @endif</p>
        <p style="float: right;word-spacing: 2px;position: absolute;right: 173px;">Cheque No:{{$data['bank_cheque_no']}}</p>
		</div>
		<table style="width: 100%;page-break-after: avoid;"cellspacing="0">
			<tr>
				<td style="font-size: 18px;width:33%;    padding: 21px 0;">Prepared By:____________________________</td>
				<td style="font-size: 18px;width:30%;    padding: 21px 0;">Signature:___________________________________</td>
				<td style="font-size: 18px;width:30%;    padding: 21px 0;">Date:___________________________________</td>

			</tr>
			<tr>
				<td style="font-size: 18px;width:33%;    padding: 21px 0;">Approved By:____________________________</td>
				<td style="font-size: 18px;width:30%;    padding: 21px 0;">Signature:___________________________________</td>
				<td style="font-size: 18px;width:30%;    padding: 21px 0;">Date:___________________________________</td>
				
			</tr>
			<tr>
            <td style="font-size: 18px;width:33%;    padding: 21px 0;">Received By:{{$data['receiver_name']}}</td>
				<td style="font-size: 18px;width:30%;    padding: 21px 0;">Signature:___________________________________</td>
				<td style="font-size: 18px;width:30%;    padding: 21px 0;">Date:___________________________________</td>
				
			</tr>
		</table>
	</div>
</div>


</body>
</html>