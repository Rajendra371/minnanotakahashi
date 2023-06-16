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
                                    <li>Team</li>
                                </ul>
                            </div>
                            <div class="bread-title"><h2>Our Teams</h2></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/ End Breadcrumb -->

        <!-- Our Team -->
        @if(!empty($teams) && count($teams))
            <section class="team team-archive section-bg section-space">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <div class="section-title  style2 text-center">
                                    <h1>
                                        {{-- <span>Board Members</span>  --}}
                                        <b>Our Awesome Team</b>
                                    </h1>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($teams as $team)
                            <div class="col-lg-4 col-md-6 col-sm-6 col-12">
                                    
                                <!-- Single Team -->
                                <div class="single-team">
                                    <div class="team-head">
                                
                                            <img src="{{asset("uploads/testimonial_image/$team->image")}}" alt="{{$team->name}}">
                                    
                                        {{-- <ul class="team-social">
                                            @if(!empty($team->facebook_link))
                                            <li><a href="{{$team->facebook_link}}" title="Facebook" target="_blank"><i class="fa fa-facebook-official"></i></a></li>
                                            @endif
                                            @if(!empty($team->twitter_link))
                                            <li><a href="{{$team->twitter_link}}" title="Twitter" target="_blank"><i class="fa fa-twitter-square"></i></a></li>
                                            @endif
                                            @if(!empty($team->linkedin_link))
                                            <li><a href="{{$team->linkedin_link}}" title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                                            @endif
                                            @if(!empty($team->instagram_link))
                                            <li><a href="{{$team->instagram_link}}" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>
                                            @endif	
                                        </ul>	 --}}
                                    </div>
                                    <div class="t-content">
                                        
                                        <div class="content-inner">
                                            <h4 class="name"><a href="
                                                ">{{$team->name}}</a></h4>
                                            <span class="designation">{{$team->designation}}</span>
                                        </div>
                                    </div>
                                </div>
                                <!--/ End Single Team -->
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
            </section>
            <!--/ End Team -->
        @endif
<!-- Appointment -->
@include('Layout.includes.appointment')	
<!--/ End Appointment  -->	
@endsection