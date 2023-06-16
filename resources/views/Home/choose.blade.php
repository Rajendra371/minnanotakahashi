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
								<li>Why Us</li>
							</ul>
						</div>
						<div class="bread-title"><h2>Why Us</h2></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Breadcrumb -->

	<!-- About Us -->
	@if ($choose)
	<section class="about-us section-space">
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-6 col-12">
					<!-- About Video -->
					<div class="modern-img-feature">
						<img src="{{asset("uploads/page_image/$choose->images")}}" alt="{{$choose->page_title}}">
					</div>
					<!--/End About Video  -->
				</div>
				<div class="col-lg-7 col-md-6 col-12">
					<div class="about-content section-title default text-left">
						<div class="section-top">
							<h1>
								{{-- <span>{{$choose->page_title}}</span> --}}
								<b>Why Choose us ?</b>
							</h1>
						</div>
						<div class="section-bottom">
							<div class="text">
								{!! $choose->description !!}
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	
	<!--/ End About Us -->
	@endif

	@if(!empty($short_description) && count($short_description))
	<section class="pf-details  section-space">
		<div class="container">
			<div class="single-content">
				@foreach ($short_description as $content)
					
				<h2>{{$content->page_title}}</h2>

				{!! $content->description !!}

				@endforeach
			</div>
		</section>
	@endif
    @include('Layout.includes.appointment')	
@endsection