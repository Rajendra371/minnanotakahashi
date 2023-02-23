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
                            <li>Career</li>
                        </ul>
                    </div>
                    <!-- Bread Title -->
                    <div class="bread-title"><h2>Our Job Vacancy</h2></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

		
<!-- Career -->
<section class="career section-space">
    <div class="container">
        <div class="row">
            @if (!$careers->isEmpty())
                @foreach ($careers as $career)
                <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                    <a href="{{route('career-details',$career->id)}}" class="career-box">
                        <ul>
                            <li>
                                <b> <i class="fa fa-black-tie"></i>{{$career->job_title}}</b> 
                            </li>
                            <li>
                                @php
                                    $current_date = Carbon\Carbon::now();
                                    $apply_before = Carbon\Carbon::parse($career->apply_before);
                                @endphp 
                                <span> <i class="fa fa-clock-o"></i>Apply Before: {{ $apply_before->format('d F Y')}} ({{ ( $current_date->diffInDays($apply_before) + 1) ." Days"}})</span>
                            </li>
                        </ul>
                    </a>
                </div>
                @endforeach
            @else
                
            @endif
        <div class="clearfix"></div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            {{count($careers) ?  $careers->links() : ''}}
        </div>
    </div>

    </div>
</section>	
<!--/ End career -->
@endsection