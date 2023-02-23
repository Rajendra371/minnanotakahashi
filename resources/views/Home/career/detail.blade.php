@extends('Layout.Main')
@section('content')

<!-- Breadcrumb -->
<div class="breadcrumbs" style="background-image:url('{{asset('frontend/img/breadcrumbs-bg.jpg')}}')">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="bread-inner">
                    <!-- Bread Menu -->
                    <div class="bread-menu">
                        <ul>
                            <li>
                                <a href="{{route('home')}}">Home</a>
                            </li>
                            <li>
                                <a href="{{route('career')}}">Career</a>
                            </li>
                            <li>Career Details</li>
                        </ul>
                    </div>
                    <!-- Bread Title -->
                    <div class="bread-title"><h2>Job Description</h2></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

		
<!-- Job Details -->
<section class="pf-details career-details section-space">
    <div class="container">
        <div class="row">
                <div class="col-12">
                    @if (!empty($career))
                    <!-- Career Content -->
                    <div class="single-content">
                        <div class="small-list-feature">
                            <h2>{{$career->job_title}}</h2>
                            <div class="row">
                                <div class="col-lg-8 col-md-9">
                                    <ul>
                                        <li> <b>Position  </b> : <span>{{$career->position}}</span> </li>
                                        <li> <b>No. of Vacancy/s  </b> : <span>[{{$career->no_of_vacancy}}]</span> </li>
                                        <li> <b>Apply Before(Deadline) </b>  : <span>
                                            @php
                                            $current_date = Carbon\Carbon::now();
                                            $apply_before = Carbon\Carbon::parse($career->apply_before);
                                            @endphp 
                                        {{ $apply_before->format('l jS \\of F Y')}} ({{ ( $current_date->diffInDays($apply_before) + 1) ." Days"}})
                                        </span></li>
                                        {{-- <li> <b>Job Type  </b> : <span>Full Time</span> </li>
                                        <li> <b>Job Level </b> : <span>Senior Level</span> </li> --}}
                                    </ul>
                                </div>
                                <div class="col-lg-4 col-md-3">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#applyNowModal">
                                        Apply Now
                                    </button>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            
                        </div>

                        @if ($career->purpose)
                        <h2>Summary:</h2>
                        <div class="small-list-feature">
                        {!! $career->purpose !!}
                        </div>
                        @endif
                        
                        <h2>Description:</h2>
                        <div class="small-list-feature">
                        {!! $career->job_description !!}
                        </div>

                        <h2>Specification:</h2>
                        <div class="small-list-feature">
                        {!! $career->job_specification !!}
                        </div>
                        
                        @if ($career->job_benefit)
                        <h2>Job Benefit:</h2>
                        <div class="small-list-feature">
                        {!! $career->job_benefit !!}
                        </div>
                        @endif

                        @if ($career->skills)
                        <h2>Skills Required:</h2>
                        <div class="small-list-feature">
                        {!! $career->skills !!}
                        </div>
                        @endif

                        <div class="small-list-feature">

                            <h2>Other Information:</h2>
                              <ul>
                                  @if ($career->experience_type)
                                    <li>
                                        @php
                                            if ($career->experience_type == 'E') {

                                                if (!empty($career->min_exp) && !empty($career->max_exp)) {
                                                    echo("$career->min_exp to $career->max_exp years of experience required.");
                                                }elseif(!empty($career->min_exp) && empty($career->max_exp)){
                                                    echo("At least $career->min_exp years of experience required.");                                    
                                                }elseif(empty($career->min_exp) && !empty($career->max_exp)){
                                                    echo("At most $career->max_exp years of experience required.");                                    
                                                }
                                            }elseif($career->experience_type == 'F'){
                                                echo("Fresher are encouraged to apply.");
                                            }else{
                                                echo("No prior experience required.");
                                            }
                                        @endphp 
                                    </li> 
                                  @endif
                                <li>Salary:
                                    @php
                                        $salary_type = $career->salary_type;
                                    @endphp 
                                    @if ($salary_type == 'F')
                                        Fixed ({{ $career->currency->symbol.' '.$career->minsalary.'/'. $career->salary_unit}})
                                    @elseif($salary_type == 'N')
                                        Negotiable
                                    @elseif($salary_type == 'R')
                                        {{$career->currency->symbol.' ('.$career->minsalary.' - '.$career->maxsalary.') / '.$career->salary_unit }}
                                    @endif
                                </li>
                                <li>Driving License: {{ $career->driving_license == 'Y' ? 'Required' : 'Not Required'}}</li>
                              </ul>
                         </div>

                    </div>
                    <!--/ End Career Cotnent -->
                    @else
                    Sorry No record found !!.
                    @endif
                </div>
            </div>
    </div>
</section>	
<!--/ End Job Details -->
@include('Home.career.job_apply_form')
@endsection