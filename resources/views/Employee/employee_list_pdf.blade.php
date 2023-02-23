<h5 class="text-center" style="width: 100%; text-align:center;">Employee List</h5>
<div class="mobile_table">
<table  class="pop-distribution alt_table">
    <thead>
        <tr>
            <th width="3%">S.N.</th>
            <th width="10%">Emp. Code</th>
            <th width="10%">Name</th>
            <th width="10%">Department</th>
            <th width="10%">Designation </th>
            <th width="8%">Gender</th>
            <th width="10%">Mobile</th>
            <th width="10%">Email</th>
            <th width="10%">Emp. Type</th>
        </tr>
    </thead>
    @if(!empty($data))
    <tbody>
        @php($i=1)
        @foreach($data as $row)
        <tr>
        <td>{{$i}}</td>
        <td>{{!empty($row->empcode)?$row->empcode:''}}</td>
        <td>{{!empty($row->employee_name)?$row->employee_name:''}}</td>
        <td>{{!empty($row->depname)?$row->depname:''}}</td>
        <td>{{!empty($row->designation_name)?$row->designation_name:''}}</td>
        <td>{{!empty($row->gend_name)?$row->gend_name:''}}</td>
        <td>{{!empty($row->mobile1)?$row->mobile1:''}}</td>
        <td>{{!empty($row->email)?$row->email:''}}</td>
        <td>{{!empty($row->employee_type)?$row->employee_type:''}}</td>
        </tr>
        @php($i++)
        @endforeach
    </tbody>
    @endif
</table>
</div>
