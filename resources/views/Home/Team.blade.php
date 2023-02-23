@extends('Layout.Main')
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumbs" style="background-image:url('{{asset('frontend/img/breadcrumbs-bg.jpg')}}'">
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
							<li>Our Team</li>
						</ul>
					</div>
					<!-- Bread Title -->
					<div class="bread-title"><h2>Team Details</h2></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/ End Breadcrumb -->

@if (!empty($team_detail) && count($team_detail))
	
<section class="about-us section-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-5 col-md-5 col-12">
				<!-- team photo -->
				<div class="modern-img-feature">
					<div class="single-team">
						<div class="team-head">
							<img src="{{asset('uploads/testimonial_image/'.$team_detail[0]->image)}}" alt="{{$team_detail[0]->name}}">
							{{-- <ul class="team-social">
								<li><a href="{{$team_detail[0]->facebook_link}}" title="Facebook"><i class="fa fa-facebook-official"></i></a></li>
								<li><a href="{{$team_detail[0]->twitter_link}}" title="Twitter"><i class="fa fa-twitter-square"></i></a></li>
								<li><a href="{{$team_detail[0]->linkedin_link}}" title="Linkedin"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="{{$team_detail[0]->instagram_link}}" title="Instagram"><i class="fa fa-instagram"></i></a></li>	
							</ul>	 --}}
						</div>
						
					</div>
				</div>
				<!--/End team photo  -->
			</div>
			<div class="col-lg-7 col-md-7 col-12">
				<div class="about-content section-title default text-left">
					<div class="section-top">
						<h1><span>{{$team_detail[0]->designation}}</span><b>{{$team_detail[0]->name}}</b></h1>
					</div>
					<div class="section-bottom">
						<div class="text">
							{!! $team_detail[0]->description !!}
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>	
<!--/ End Team Us -->
@endif

@endsection