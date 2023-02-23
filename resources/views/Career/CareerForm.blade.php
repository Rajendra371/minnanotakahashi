<?php
  $jobdata = $data['jobdata'] ?? '';
?>
<div class="card">
    <div class="row">
        <div class="col-md-12 mx-auto">
            <form class="card-body form-horizontal" id="careerForm" method="post" action="api/career_setup/store" enctype="multipart/form-data">
                <input type = "hidden" name = "id" value = "{{$jobdata->id ?? ''}}">
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class = "row">
                            <div class= "col-sm-3">
                                <label>Job Code</label>
                                <input type="text" class="form-control" id="jobcode" name = "jobcode" placeholder="Code" value = "{{$data['jobcode'] ?? ''}}" readonly>
                            </div>
                            <div class = "col-sm-3">
                                <label>Job Title: <code>*</code></label>
                                <input type="text" class="form-control required_field" id="job_title" name = "job_title" placeholder="Title" value = "{{$jobdata->job_title ?? ''}}">
                            </div>
                            <div class = "col-sm-3">
                                <label>No. of Vaccancy:  <code>*</code></label>
                                <input type="number" name = "no_of_vacancy" class="form-control required_field" id="no_of_vacancy" placeholder="Vaccancy" value = "{{$jobdata->no_of_vacancy ?? ''}}">
                            </div>
                            <div class= "col-sm-3">
                                <label>Apply Before : <code>*</code></label><br>
                                <input  type= "text" name = "apply_before" class = "required_field datepicker form-control" value = "{{$jobdata->apply_before ?? ''}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Purpose:</label>
                        <textarea class="form-control ckeditor" id="purpose" name = "purpose" placeholder="Enter purpose here">{{$jobdata->purpose ?? ''}}</textarea>
                    </div>
                    <div class = "col-sm-6">
                        <label>Job Description: <code>*</code></label>
                        <textarea class="form-control ckeditor" id="job_description" name = "job_description" placeholder="Job Description">{{$jobdata->job_description ?? ''}}</textarea>
                    </div>
                    <div class = "col-sm-6">
                        <label>Job Benefits:</label><br>
                        <textarea class="form-control ckeditor" id = "job_benefits" name="job_benefit">{{$jobdata->job_benefit ?? ''}}</textarea>
                    </div>
                    <div class = "col-sm-6">
                        <label>Job Specification:<code>*</code></label><br>
                        <textarea class="form-control ckeditor" id = "job_specification" name="job_specification">{{$jobdata->job_specification ?? ''}}</textarea>
                    </div>
                
                    <div class = "col-sm-6">
                        <div class = "row">
                            <div class = "col-sm-4">
                                @php
                                    $exp_type = $jobdata->experience_type ?? '';
                                @endphp
                                <label>Experience Type:<code>*</code></label>
                                <select name = "experience_type" class = "form-control required_field" id = "experience_type">
                                    <option value = "N" {{$exp_type == "N" ? "selected":''}}>No Experience</option>
                                    <option value = "F" {{$exp_type == "F" ? "selected":''}}>Fresher</option>
                                    <option value = "E" {{$exp_type == "E" ? "selected":''}}>Experienced</option>
                                </select>
                            </div>    
                            <div class = "col-sm-4 exp_dur_div" style = "display:none;">
                                <label>Minimum :</label>
                                <input class = "form-control" type = "number" name = "min_exp" placeholder = "" value = "{{$jobdata->min_exp ?? ''}}">
                            </div>
                            <div class = "col-sm-4 exp_dur_div" style = "display:none;">
                                <label>Maximum :</label>
                                <input class = "form-control" type = "number" name = "max_exp" placeholder = "" value = "{{$jobdata->max_exp ?? ''}}">
                            </div>
                        </div>
                    </div>
                    <div class = "col-sm-6">
                        <div class = "row">
                            <div class = "col-sm-6">
                                <label>Req Driving License:</label>
                                @php
                                    $license = $jobdata->driving_license ?? '';
                                @endphp
                                <select name = "driving_license" class = "form-control" id = "driving_license">
                                    <option value = "Y" {{$license == "Y" ? "selected":''}}>Yes</option>
                                    <option value = "N"  {{$license == "N" ? "selected":''}}>No</option>
                                </select>
                            </div>
                            <div class = "col-sm-6"> 
                                <label>Start Date:</label>
                                <input type = "text" class = "datepicker form-control" name = "start_date" value = "{{$jobdata->start_date ?? ''}}">
                            </div> 
                        </div>
                    </div>
                    <div class = "col-sm-12">
                        <div class = "row">
                            <div class = "col-sm-3">
                                <label>Salary<code>*</code>:</label>
                                @php
                                    $salary = $jobdata->salary_type ?? '';
                                @endphp
                                <select class = "form-control" name = "salary_type" id = "salary_type">
                                    <option value = "N" {{$salary == "N" ? "selected":''}}>Negotiable</option>
                                    <option value = "F" {{$salary == "F"? "selected" :''}}>Fixed</option>
                                    <option value = "R" {{$salary == "R" ? "selected":''}}>Range</option>
                                </select> 
                            </div>
                            <div class = "sal_div col-sm-3 sal_fixed" style = "display:none">
                                <label>Currency</label>
                                <select name = "currency_id"class =  "form-control">
                                    <option value  = "">--Select--</option>
                                    @php
                                        $currency = $jobdata->currency_id ?? '';
                                    @endphp
                                    @if(!empty($data['currency']))
                                        @foreach($data['currency'] as $i => $d)
                                            <option value = {{$d->id}} {{$currency == $d->id ? "selected" :''}}>{{$d->currency_code.'('.$d->symbol.')'}}</option>
                                        @endforeach 
                                    @endif 
                                </select>
                            </div>
                                @php
                                    $salut = $jobdata->salary_unit ?? '';
                                @endphp
                            <div class = "sal_div col-sm-3 sal_fixed" style = "display:none">
                                <label>Salary Unit</label>
                                <select name = "salary_unit" class="form-control">
                                    <option value="">--Select--</option>
                                    <option value="Hourly" {{$salut == 'Hourly' ? "selected" :''}}>Hourly</option>
                                    <option value="Daily" {{$salut == 'Daily' ? "selected" :''}}>Daily</option>
                                    <option value="Weekly" {{$salut == 'Weekly' ? "selected" :''}}>Weekly</option>
                                    <option value="Monthly" {{$salut == 'Monthly' ? "selected" :''}}>Monthly</option>
                                    <option value="Yearly" {{$salut == 'Yearly' ? "selected" :''}}>Yearly</option>
                                </select>
                            </div>
                            <div class = "col-sm-3 sal_div sal_fixed" style = "display:none;">
                                <label>Minimum Salary:</label>
                                <input class = "form-control" type = "number" name = "minsalary" placeholder = "" value  = "{{$jobdata->minsalary ?? ''}}">
                            </div>
                            <div class = "col-sm-3 sal_div" style = "display:none;">
                                <label>Maximum Salary:</label>
                                <input class = "form-control" type = "number" name = "maxsalary" placeholder = "" value = "{{$jobdata->maxsalary ?? ''}}">
                            </div>
                        </div>
                    </div>
                    <div class = "col-sm-6">
                        <div class = "row">
                            <div class = "col-sm-4">
                                <label>Position: <code>*</code></label>
                                <input type="text" class="form-control required_field" id="position" name = "position" placeholder="Title" value = "{{$jobdata->position ?? ''}}">
                            </div>
                            <div class = "col-sm-4">
                                <label>Job Level:</label>
                                <select class = "form-control" name = "level_id" id = "job_level">
                                    <option value = "">--Select--</option>
                                    @php
                                    $job_level = $jobdata->level_id ?? '';
                                    @endphp
                                    @if(!empty($data['job_level']))
                                        @foreach($data['job_level'] as $i => $jl)
                                            <option value ="{{$jl->id}}" {{$job_level == $jl->id ? "selected" :''}}>{{$jl->title}}</option>
                                        @endforeach 
                                    @endif 
                                </select>
                            </div>
                            <div class="col-sm-4">
                                <label>Gender:</label>
                                <select class = "form-control" name = "gender">
                                    <option value = "">--Select--</option>
                                    @php
                                        $db_gender = $jobdata->gender ?? '';
                                    @endphp
                                    @if(!empty($data['gender']))
                                        @foreach($data['gender'] as $i => $g)
                                            <option value = {{$g->id}} {{$db_gender == $g->id ? "selected":''}}>{{$g->gend_name}} </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class = "col-sm-4">
                                <label>Apply Online ? :</label><br>
                                @if($jobdata)
                                    <input  type="radio" id="online_yes" name="apply_online" value="Y" {{$jobdata->apply_online == "Y" ? "checked": ''}}>
                                @else
                                    <input  type="radio" id="online_yes" name="apply_online" value="Y">
                                @endif
                                <label class = "radio-inline"> Yes</label>
                                @if($jobdata)
                                    <input  type="radio" id="online_no" name="apply_online" value="N" {{$jobdata->apply_online == "N" ? "checked" :''}}>
                                @else
                                    <input  type="radio" id="online_no" name="apply_online" value="N">
                                @endif
                                <label class = "radio-inline"> No</label>
                            </div>
                            <div class = "col-sm-4">
                                <label>Apply Direct ? :</label><br>
                                @if($jobdata)
                                    <input  type="radio" id="online_yes" name="apply_direct" value="Y" {{$jobdata->apply_direct == "Y" ?"checked" : ''}}>
                                @else
                                    <input  type="radio" id="online_yes" name="apply_direct" value="Y">
                                @endif
                                <label class = "radio-inline"> Yes</label>
                                @if($jobdata)
                                    <input  type="radio" id="online_no" name="apply_direct" value="N" {{$jobdata->apply_direct == "N" ? "checked" :''}}>
                                @else
                                    <input  type="radio" id="online_no" name="apply_direct" value="N">
                                @endif
                                <label class = "radio-inline"> No</label>
                            </div>
                             
                            <div class = "col-sm-4">
                                <label>Apply Instruction ? :</label><br>
                                @if($jobdata)
                                    <input  type="radio" id="instr_yes" name="apply_instruction" value="Y" {{$jobdata->apply_instruction == "Y" ? "checked" :''}}>
                                @else
                                    <input  type="radio" id="instr_yes" name="apply_instruction" value="Y">
                                @endif
                                <label class = "apply_inst radio-inline"> Yes</label>
                                @if($jobdata)
                                    <input  type="radio" id="instr_no" name="apply_instruction" value="N" {{$jobdata->apply_instruction == "N" ? "checked" :''}}>
                                @else
                                    <input  type="radio" id="instr_no" name="apply_instruction" value="N">
                                @endif
                                <label class = "apply_inst radio-inline"> No</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label>Skills:</label>
                        <textarea type="text" class="form-control ckeditor" id="skills" name = "skills" placeholder="List of skills">{{$jobdata->skills ?? ''}}</textarea>
                    </div>
                    
                    <div class="col-sm-6" id = "instr_div" style = "display:none; margin-top: -111px;">
                        <label>Instruction:</label>
                        <textarea class="form-control ckeditor" id="instruction" name = "instruction" placeholder="Enter instruction">{{$jobdata->instruction ?? ''}}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-sm-12">
                        <div class="float-right">
                            <button type="submit" size="md" color="primary" class= "save btn btn-primary btn-md">
                                <i class="fa fa-dot-circle-o">Save</i>
                            </button>
                        </div>
                    </div>
                    <div class="alert-success success"></div>
                    <div class="alert-danger error"></div>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    @if($jobdata)
        load_datepicker('N');
    @else
        load_datepicker();
    @endif
    load_ckeditor();
    $(document).ready(function(e){
       edit();
    });
    function edit(){
        let exp_type = $('#experience_type').val();
        let salary = $('#salary_type').val();
        console.log($('#instr_no').is(':checked'));
        if(exp_type == "E"){
            $('.exp_dur_div').show(500);
        }
        else{
            $('.exp_dur_div').hide(500);
        }

        if (salary == "F"){
            $('.sal_div').hide(250);
            $('.sal_fixed').show(500);
        }
        else if(salary == 'R'){
            $('.sal_div').show(500);
        }else{
            $('.sal_div').hide(500);
        }

        if ($('#instr_no').attr('checked')){
            $('#instr_div').hide(500);
        }
        else{
            $('#instr_div').show(500);
        }
    }
    $(document).off('click','#instr_yes');
    $(document).on('click','#instr_yes',function(){
        $('#instr_div').show(500);
    });

    $(document).off('click','#instr_no');
    $(document).on('click','#instr_no',function(){
        $('#instr_div').hide(500);
    });

    $(document).off('change','#experience_type');
    $(document).on('change','#experience_type', function(e){
        let value = $(this).val();
        if(value == "E"){
            $('.exp_dur_div').show(500);
        }
        else{
            $('.exp_dur_div').hide(500);
        }
    });

    $(document).off('change', '#salary_type');
    $(document).on('change', '#salary_type', function(e){
        let value = $(this).val();
        if (value == "F"){
            $('.sal_div').hide(250);
            $('.sal_fixed').show(500);
        }
        else if(value == 'R'){
            $('.sal_div').show(500);
        }else{
            $('.sal_div').hide(500);
        }
    });

</script>