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
							<li>Our Events</li>
						</ul>
					</div>
					<!-- Bread Title -->
					<div class="bread-title"><h2>Our Events</h2></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/ End Breadcrumb -->
<!-- Latest event -->
<section class="latest-blog section-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
				<div class="section-title default text-center">
					<div class="section-top">
						<h2>
							{{-- <span>Our Events</span>  --}}
							<b>Latest Events</b>
						</h2>
					</div>
				</div>
			</div>
		</div>
		@if ($events)
		  
				<div class="blog-latest">
					<div class="row">
						@foreach ($events as $event)
							<div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
								<!-- Single event -->
								<div class="single-news">
									<div class="news-head overlay">
										<figure>
											<img src="{{asset("uploads/nne_image/$event->image")}}" alt="{{$event->title}}"/>
										</figure>
										{{-- <span class="news-img"
											style="background-image:url('{{ asset('uploads/blog_image/' . $blog->image) }}')"></span> --}}
										<a href="{{route('event-details',"$event->slug-$event->id")}}"
											class="homes-btn theme-2">Read more <i class="fa fa-long-arrow-right"></i> </a>
									</div>
									<div class="news-body">
										<div class="news-content">
											<h3 class="news-title">
												<a href="{{route('event-details',"$event->slug-$event->id")}}">{{$event->title}}
												</a>
											</h3>
											<div class="news-text">
												<p>{{ Illuminate\Support\Str::limit(strip_tags($event->description), 200, '...') }}
												</p>
											</div>
											<ul class="news-meta">
												<li class="date"><i
														class="fa fa-calendar"></i>{{ date('j F, Y', strtotime($event->postdatead)) }}
												</li>
											</ul>
										</div>
									</div>
								</div>
								<!--/ End Single event -->
							</div>
						@endforeach
					</div>
				</div>
		  
		@endif
	</div>
</section>
<!--/ End Latest event -->
@endsection