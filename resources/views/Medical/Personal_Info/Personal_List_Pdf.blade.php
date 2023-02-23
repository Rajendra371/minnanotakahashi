<h5 class="text-center reportTitle"> Personal List</h5>
<div class="mobile_table">
<table  class="alt_table ">
<thead>
      <tr>
        <th  width="7%">S.N</th>
        <th  width="20%">Personal Id</th>
        <th  width="25%">Name</th>
        <th  width="15%">Gender</th>
        <th  width="18%">Contact</th>
        <th  width="18%">Issue Date</th>
        <th  width="15%">Applied Country</th>
        <th  width="25%">Referrer</th>
</tr>
</thead>
@if(!empty($data))
<tbody>
    @php($i=1)
    @foreach($data as $key=>$row)
    <tr>
    <td>{{$i}}</td>
    <td>{{!empty($row->personal_id)?$row->personal_id:''}}</td>
    <td>{{!empty($row->first_name)?$row->first_name . ' ' . $row->middle_name . ' ' . $row->last_name:''}}</td>
    <td>{{!empty($row->gend_name)?$row->gend_name:''}}</td>
    <td>{{!empty($row->mobile)?$row->mobile:''}}</td>
    <td>{{!empty($row->postdatead)?$row->postdatead:''}}</td>
    <td>{{!empty($row->coun_name)?$row->coun_name:''}}</td>
    <td>{{!empty($row->rein_name)?$row->rein_name:''}}</td>
    @php($i++)
    </tr>
    @endforeach
</tbody>
@endif
</table>
</div>

