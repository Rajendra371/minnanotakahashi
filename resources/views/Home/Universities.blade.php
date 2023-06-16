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
								<li>Universities</li>
							</ul>
						</div>
						<div class="bread-title"><h2>Universities</h2></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!--/ End Breadcrumb -->


	<!-- University Area -->
	@if (!empty($university) && count($university))
	<section class="features-area section-bg">
		<div class="container">
			<div class="section-title default text-center mb-0">
				<div class="section-top">
					<h2 class="mb-0">
						{{-- <span>Browse Our</span> --}}
						<b>Top Universities</b>
					</h2>
				</div>
			</div>
	
			<div class="row">
				@foreach ($university as $tile)
				<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 u_list">
					<div class="single-feature country">
						@if ($tile->icon)
							<div class="icon-head"><i class="{{ $tile->icon }}"></i></div>
						@elseif($tile->image)
							<div class="country-img">
								<a href="{{!empty($tile->website)?$tile->website:''}}" target="_blank">
									<figure> <img src="{{ asset("uploads/university/$tile->image") }}" />
									</figure>
								</a>
							</div>
						@endif
	
						<h4><a href="{{!empty($tile->website)?$tile->website:''}}" target="_blank">{{ $tile->title }}</a>
						</h4>
						{{-- <p>{!! Illuminate\Support\Str::limit($tile->content, 120, '...') !!}</p>
						<div class="button"> <a href="{{route('destination-details',"$tile->slug-$tile->id")}}" class="homes-btn"><i
									class="fa fa-long-arrow-right"></i>Learn More</a> </div> --}}
					</div>
				</div>
				@endforeach
			</div>
		</div>
	</section>
	@endif
<!--/ End University Area -->
	

@endsection



		