@if (!empty($applicant))
    <div class="form-group general_info white-box pad-5">
    <h5 class="form_title">Job Applicant Information</h5>
    <div class="row">
        <div class="col-md-4 col-sm-4">
            <label>Job Code :</label>
            <span>{{ $applicant->jobcode }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Job Title :</label>
            <span>{{ $applicant->job_title }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Applicant Name :</label>
            <span>{{ $applicant->full_name }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Contact Number :</label>
            <span>{{ $applicant->contact_number }}</span>
        </div>
        <div class="col-md-4 col-sm-4">
            <label>Email :</label>
            <span>{{ $applicant->email ?? '' }}</span>
        </div>
        <div class="col-md-6 col-sm-12">
            <label>Resume :</label>
            @if ($applicant->cv && file_exists(public_path('uploads/job_applicant/'.$applicant->cv)))
                @php
                    $file_type = last(explode('.',$applicant->cv));
                    if (in_array($file_type,['jpg','jpeg','png','gif'])) {
                       echo "<a href='".asset('uploads/job_applicant/'.$applicant->cv)."' target='_blank' ><img src='".asset('uploads/job_applicant/'.$applicant->cv)."' width='200px' height='200px'></a>";
                    }else{
                        echo "<a href='".asset('uploads/job_applicant/'.$applicant->cv)."' target='_blank' ><i  class='fa fa-download'></i> Resume</a>";
                    }
                @endphp
            @endif
        </div>
        <div class="col-md-6 col-sm-12">
            <label>Cover Letter :</label>
            @if ($applicant->cover_letter && file_exists(public_path('uploads/job_applicant/'.$applicant->cover_letter)))
                @php
                    $file_type = last(explode('.',$applicant->cover_letter));
                    if (in_array($file_type,['jpg','jpeg','png','gif'])) {
                       echo "<a href='".asset('uploads/job_applicant/'.$applicant->cover_letter)."' target='_blank' ><img src='".asset('uploads/job_applicant/'.$applicant->cover_letter)."' width='200px' height='200px'></a>";
                    }else{
                        echo "<a href='".asset('uploads/job_applicant/'.$applicant->cover_letter)."' target='_blank' ><i  class='fa fa-download'></i> Cover Letter</a>";
                    }
                @endphp
            @endif
        </div>
    </div>
</div>
@endif
