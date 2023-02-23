@if($data['tab_type']=='general_checkup')
    @include('Medical.Examination_Info.General_Checkup')
@endif
@if($data['tab_type']=='re_checkup')
     @include('Medical.Examination_Info.Re_Checkup')
@endif
@if($data['tab_type']=='partial_checkup')
    @include('Medical.Examination_Info.Partial_Checkup')
@endif

@if($data['tab_type']=='premedical_checkup')
    @include('Medical.Examination_Info.Pre_Medical_Checkup')
@endif
