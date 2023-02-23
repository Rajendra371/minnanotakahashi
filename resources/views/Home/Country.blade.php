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
							<li>Country</li>
						</ul>
					</div>
					<!-- Bread Title -->
					<div class="bread-title"><h2>Country</h2></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/ End Breadcrumb -->


<!-- country Area -->
@if (!empty($destination) && count($destination))
<section class="features-area section-bg">
	<div class="container">
		<div class="section-title default text-center mb-0">
			<div class="section-top">
				<h2 class="mb-0"><span>Browse Our</span><b>Top Countries</b></h2>
			</div>
		</div>

		<div class="row">
			@foreach ($destination as $tile)
			<div class="col-xl-3 col-lg-3 col-md-4 col-sm-4 col-6">
				<div class="single-feature country">
					@if ($tile->icon)
						<div class="icon-head"><i class="{{ $tile->icon }}"></i></div>
					@elseif($tile->image)
						<div class="country-img">
							<a href="{{route('country-details',"$tile->slug-$tile->id")}}">
								<figure> <img src="{{ asset("uploads/study_destinations/$tile->image") }}" />
								</figure>
							</a>
						</div>
					@endif

					<h4><a href="{{route('country-details',"$tile->slug-$tile->id")}}">{{ $tile->title }}</a>
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
<!--/ End country Area -->


@endsection