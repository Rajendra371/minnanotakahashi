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
				<h2 class="mb-0">
					{{-- <span>Browse Our</span> --}}
					<b>Top Countries</b>
				</h2>
			</div>
		</div>

		<div class="row">
			@foreach ($destination as $tile)
			<div class="col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 u_list">
				<a href="{{route('country-details',"$tile->slug-$tile->id")}}" style="text-decoration: none; color: inherit; display: block;">
					<div class="single-feature country" style="height: 300px; display: flex; flex-direction: column; border: 1px solid #e0e0e0; border-radius: 10px; overflow: hidden; background: #fff; box-shadow: 0 2px 8px rgba(0,0,0,0.1); transition: transform 0.2s ease, box-shadow 0.2s ease; cursor: pointer;" 
						 onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.15)'" 
						 onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 2px 8px rgba(0,0,0,0.1)'">
						@if ($tile->icon)
							<div class="icon-head" style="flex: 1; display: flex; align-items: center; justify-content: center;"><i class="{{ $tile->icon }}"></i></div>
						@elseif($tile->image)
							<div class="country-img" style="height: 200px; overflow: hidden;">
								<figure style="margin: 0; height: 100%;"> 
									<img src="{{ asset("uploads/study_destinations/$tile->image") }}" 
										 style="width: 100%; height: 100%; object-fit: cover; object-position: center; transition: transform 0.3s ease;" />
								</figure>
							</div>
						@endif

						<div class="country-content" style="height: 100px; display: flex; align-items: center; justify-content: center; padding: 15px; text-align: center;">
							<h4 style="margin: 0; font-size: 16px; line-height: 1.3; font-weight: 600; color: #333; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical;">
								{{ $tile->title }}
							</h4>
						</div>
					</div>
				</a>
			</div>
			@endforeach
		</div>
	</div>
</section>
@endif
<!--/ End country Area -->


@endsection