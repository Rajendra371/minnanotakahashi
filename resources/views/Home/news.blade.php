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
							<li>Our News</li>
						</ul>
					</div>
					<!-- Bread Title -->
					<div class="bread-title"><h2>Our News</h2></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/ End Breadcrumb -->

@if ($news)
	
<!-- Start Services -->
<section class="services section-bg section-space">
	<div class="container">
		<div class="main-service">
			<div class="row">
				@foreach ($news as $new)
				<div class="col-lg-4 col-md-6 col-12">
					<!-- Single Service -->
					<div class="single-service">
                        <div class="service-head"> <img src="{{asset("uploads/nne_image/$new->image")}}" alt="{{$new->title}}">
                        </div>
                        <div class="service-content">
                            <h4><a href="{{route('event-details',"$new->slug-$new->id")}}">{{$new->title}}</a></h4>
                            <p>{{$new->short_content}}</p>
                            <a href="{{route('event-details',"$new->slug-$new->id")}}" class="icon-bg">
                                <i class="fa fa-arrow-circle-o-right"></i>
                            </a> 
                        </div>
                    </div>
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