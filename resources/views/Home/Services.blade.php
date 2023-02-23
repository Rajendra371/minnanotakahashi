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
							<li>Our Services</li>
						</ul>
					</div>
					<!-- Bread Title -->
					<div class="bread-title"><h2>Our Services</h2></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/ End Breadcrumb -->

@if ($services)
	
<!-- Start Services -->
<section class="services section-bg section-space">
	<div class="container">
		<div class="main-service">
			<div class="row">
				@foreach ($services as $service)
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Single Service -->
					@include('Layout.includes.single_service')
					<!--/ End Single Service -->
				</div>
				@endforeach
			</div>
		</div>
	</div>
</section>
@endif
<!--/ End Services -->
@endsection