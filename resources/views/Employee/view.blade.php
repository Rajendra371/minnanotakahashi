<div class="form-group general_info white-box pad-5">
    <h5 class="form_title">General Information</h5>
    <h6>Personal Information</h6>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Emp. Code :</label>
            <span>{{ $employee->empcode }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>First Name :</label>
            <span>{{ $employee->first_name }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Middle Name :</label>
            <span>{{ $employee->middle_name }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Last Name :</label>
            <span>{{ $employee->last_name }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Gender :</label>
            <span>{{ $employee->gender->gend_name ?? '' }}</span>

        </div>
        <div class="col-md-4 col-sm-4">
            <label>Date of Birth :</label>
            <span>{{ $employee->birth_datead }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Blood Group :</label>
            @php
                $blood_group = $employee->blood_group_id;
            @endphp
            @if (!empty($blood_group))
                @php
                    $blood_group_name = \DB::table('blood_group')
                        ->where('id', $blood_group)
                        ->value('blgr_name');
                @endphp
                <span>{{ $blood_group_name }}</span>
            @else
                <span></span>
            @endif
        </div>
    </div>

    <h5 class="form_title">Address</h5>
    <h6>Permanent Address</h6>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>State :</label>
            <span>{{ $employee->perma_state }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>City :</label>
            <span>{{ $employee->perma_city }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Address :</label>
            <span>{{ "$employee->perma_address1, $employee->perma_address2" }}</span>
        </div>
    </div>
    <h6>Temporary Address</h6>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>State :</label>
            <span>{{ $employee->temp_state }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>City :</label>
            <span>{{ $employee->temp_city }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Address :</label>
            <span>{{ "$employee->temp_address1, $employee->temp_address2" }}</span>
        </div>
    </div>
    <h5 class="form_title">Contact Information</h5>
    <h6>Personal Contact</h6>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Mobile :</label>
            <span>{{ "$employee->mobile1, $employee->mobile2" }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Email :</label>
            <span>{{ $employee->email }}</span>
        </div>
    </div>
    <h6>Emergency Contact</h6>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Contact Person :</label>
            <span>{{ $employee->emerg_contact_name }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Mobile :</label>
            <span>{{ "$employee->emerg_mobile1, $employee->emerg_mobile2" }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Email :</label>
            <span>{{ $employee->emerg_email }}</span>
        </div>
    </div>

    <h5 class="form_title">Department Information</h5>
    <div class="row">

        <div class="col-md-4 col-sm-4">
            <label>Department Code :</label>
            <span>{{ $employee->department->depcode ?? '' }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Department Name :</label>
            <span>{{ $employee->department->depname ?? '' }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Designaton :</label>
            <span>{{ $employee->designation->designation_name ?? '' }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Emp. Type :</label>
            <span>{{ $employee->type->employee_type ?? '' }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Temporary Password :</label>
            <span>{{ $employee->emp_first_password }}</span>
        </div>
    </div>
</div>
