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
							<li>
								<a href="{{route('blog')}}">Blog</a>
							</li>
							<li>Blog Details</li>
						</ul>
					</div>
					<!-- Bread Title -->
					<div class="bread-title"><h2>Blog Details</h2></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/ End Breadcrumb -->
<!-- Blog -->
<section class="news-area archive blog-single section-padding">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-12">
				<div class="row">
					<div class="col-12">
						<div class="blog-single-main">
						@include('Layout.includes.blog_detail')	
						</div>
						</div>
					</div>						
				</div>	
				<div class="col-lg-4 col-12">
					<!-- Blog Sidebar -->
					<div class="blog-sidebar">
						<!-- Single Sidebar -->
						<div class="single-sidebar blog_search">
							<form class="searchform" action="#">
								<input type="text" placeholder="Search anything.." value="" name="s" id="s">
								<button type="submit" id="searchsubmit"><i class="fa fa-search"></i></button>
							</form>
						</div>
						<!--/ End Single Sidebar -->
						<!-- News Sidebar -->
						<div class="single-sidebar homes_latest_news_widget">
							<h2 class="sidebar-title">Popular Posts</h2>
							<!-- Single News -->
							@if (!empty($popular_blogs) && count($popular_blogs))
							@foreach ($popular_blogs as $blog)
							<div class="single-f-news">
								<div class="post-thumb"><a href="{{ route('blog-details',"$blog->blog_slug-$blog->id") }}"><img src="{{asset("uploads/blog_image/$blog->image")}}" alt="Blog Image"></a></div>
								<div class="content">
									<p class="post-meta"><time class="post-date"><i class="fa fa-clock-o"></i>{{date('j F, Y', strtotime($blog->postdatead)) }}</time></p>
									<h5 class="title"><a href="{{ route('blog-details',"$blog->blog_slug-$blog->id") }}">{{$blog->blog_title}}</a></h5>
								</div>
							</div>
							@endforeach
							@endif
							<!--/ End Single News -->
						</div>
						<!--/ End Single Sidebar -->
						<!-- News Tags -->
						<div class="single-sidebar tagcloud">
							<h2 class="sidebar-title">Tags</h2>
							<ul>
								<li><a href="#">Household</a></li>
								<li><a href="#">Community Nursing Care </a></li>
								<li><a href="#">Home Care</a></li>
								<li><a href="#">Social</a></li>
								<li><a href="#">Community</a></li>
								<li><a href="#">Transport</a></li>
								<li><a href="#">Daily Personal Activities</a></li>
								<li><a href="#">Innovative</a></li>
								<li><a href="#">Assist Daily Life</a></li>
							</ul>
						</div>
						<!--/ End News Tags -->
						<!-- News Tags -->
						<div class="single-sidebar subscribe-form">
							<h2 class="sidebar-title">Subscribe Form</h2>
							<form action="#" method="post">
								<input type="email" placeholder="Your email address">
								<button type="submit" value="send">Subscribe Now</button>
							</form>
						</div>
						<!--/ End News Tags -->
					</div>
					<!--/ End Blog Sidebar -->
				</div>
			</div>
		</div>
	</section>	
	<!--/ End Blog -->
@endsection