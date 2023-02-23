<!-- <table border="1" style="border:1px solid #ddd;width:100%;border-collapase:collapase">
      <thead>
          <tr>
              <th>ID</th>
              <th>Amount</th>
              <th>Vat</th>
              <th>Grand Total</th>
        </tr>
    </thead>
        <tbody>
 @foreach($data['exam_master'] as $key=>$data)
            <tr>
                <td>{{$data->examination_masterid}}</td>
                <td>{{$data->amount}}</td>
                <td>{{$data->vat_per}}</td>
                <td>{{$data->grand_total}}</td>
            </tr>
       
@endforeach
 </tbody>
</table> -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&display=swap"
        rel="stylesheet">
    <title>Homepage</title>
</head>

<body style="font-family: 'Open Sans', sans-serif;background-color: #fff;height: 100%;padding-top: 30px;">
    <div class="wrapper"
        style="width: 700px;margin:0 auto;height: 100%;page-break-before: always">
        <table style="width: 100%;border-collapse:collapse;">
            <tr>
                <td style="padding: 0 15px;">
                    <table style="width: 100%;border-collapse:collapse;">
                        <tr>
                            <td style="width: 25%;">
                                <img src="logo.png" style="width: 100px;height: 100px;object-fit: contain;">
                            </td>
                            <td style="width: 50%;text-align: center;padding-bottom: 30px;">
                                <h3 style="font-size: 20px;text-transform:uppercase;margin: 0px;padding: 0px;">Paramount
                                    Medical</h3>
                                <p
                                    style="font-size: 14px;text-transform:uppercase;margin: 0px;padding: 0px;margin-top: 5px;font-weight: 600;">
                                    Address:Kathmandu, Nepal</p>
                                <p
                                    style="font-size: 14px;text-transform:uppercase;margin: 0px;padding: 0px;margin-top: 5px;font-weight: 600;">
                                    Phone:01 234 567890</p>
                            </td>
                            <td style="width: 25%;"></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding: 0 15px;">
                    <table style="width: 100%;border-collapse:collapse;">
                        <tr>
                            <td style="font-size: 14px;padding: 10px 0;">Bill No:<span
                                    style="max-width: 200px;display:inline-block;border-bottom:1px dotted #212121;width: 100%;margin-left: 10px;"></span>
                            </td>
                            <td style="text-align: right;white-space: nowrap;font-size: 14px;padding: 10px 0;">
                                Date:<span
                                    style="max-width: 200px;display:inline-block;border-bottom:1px dotted #212121;width: 100%;margin-left: 10px;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"
                                style="white-space: nowrap;font-size: 14px;overflow: hidden;padding: 5px 0;">
                                Name:<span
                                    style="display:inline-block;border-bottom:1px dotted #212121;width: 100%;margin-left: 5px;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;font-size: 14px;padding: 5px 0;">Roll No:<span
                                    style="max-width: 200px;display:inline-block;border-bottom:1px dotted #212121;width: 100%;margin-left: 10px;"></span>
                            </td>
                            <td style="padding-top: 10px;text-align: right;white-space: nowrap;font-size: 14px;padding: 5px 0;">
                                Class:<span
                                    style="max-width: 200px;display:inline-block;border-bottom:1px dotted #212121;width: 100%;margin-left: 10px;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2"
                                style="padding-top: 10px;white-space: nowrap;font-size: 14px;overflow: hidden;padding: 5px 0;">
                                Admission No:<span
                                    style="display:inline-block;border-bottom:1px dotted #212121;width: 100%;margin-left: 10px;"></span>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td style="padding-top: 40px;">
                    <table style="width: 100%;;border-collapse:collapse;height: 1200px">
                        <tbody>
                            <tr>
                                <td width="20%"
                                    style="padding: 10px 15px;border:1px solid #212121;font-size: 14px;">
                                    S.No.</td>
                                <td width="60%" style="padding: 10px 15px;border:1px solid #212121;font-size: 14px;">
                                    Praticulars</td>
                                <td width="20%"
                                    style="padding: 10px 15px;border: 1px solid #212121;font-size: 14px;">
                                    Amount</td>
                            </tr>
                      
                            <tr>
                                <td width="20%"
                                    style="padding: 10px 15px;border-right:1px solid #212121;font-size: 14px;border-left: 1px solid #212121;">S.No.
                                </td>
                                <td v="" style="padding: 10px 15px;border-right:1px solid #212121;font-size: 14px;">
                                    Praticulars</td>
                                <td width="20%" style="padding:10px 15px;font-size: 14px;border-right: 1px solid #212121;">Amount</td>
                            </tr>
                            <tr>
                                <td colspan=" 2"
                                    style="border-left: 1px solid #212121;padding:15px;text-align: right;border-bottom: 1px solid #212121;font-size: 16px;font-weight: 600;border-top: 1px solid #212121;">
                                    Total
                                </td>
                                <td
                                    style="padding:15px;border-left: 1px solid #212121;border-bottom: 1px solid #212121;font-size: 15px;font-weight: 600;border-right: 1px solid #212121;border-top: 1px solid #212121;">
                                    Rs 25000</td>
                            </tr>
                            <tr>
                                <td 
                                    style="border-top: 1px solid #212121;padding: 15px 15px 15px 5px;border-bottom: 1px solid #212121;border-left: 1px solid #212121;white-space: nowrap;">
                                    Amount in words:
                                </td>
                                <td colspan="2" style="border-right: 1px solid #212121;border-bottom: 1px solid #212121;overflow: hidden;padding: 15px 5px 15px 15px;">
                                     <span
                                    style="display:inline-block;border-bottom:1px dotted #212121;width: 100%;margin-left: 10px;padding-right: 15px;"></span>
                                </td>
                            </tr>
                             <tr>
                            <td style="font-size: 16px;font-weight:600;padding-top: 15px; ">Received By:<span
                                    style="max-width: 200px;display:inline-block;border-bottom:1px dotted #212121;width: 100%;margin-left: 10px;"></span>
                            </td>
                            <td></td>
                            <td style="font-size: 16px;font-weight:600;padding-top: 15px;">Signature :<span
                                    style="max-width: 200px;display:inline-block;border-bottom:1px dotted #212121;width: 100%;margin-left: 10px;"></span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
           
        </table>
    </div>
</body>

</html>