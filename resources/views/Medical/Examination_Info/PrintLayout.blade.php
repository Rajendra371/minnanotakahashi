  <table style="border:1px solid #ddd;width:100%;border-collapase:collapase">
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
</table>