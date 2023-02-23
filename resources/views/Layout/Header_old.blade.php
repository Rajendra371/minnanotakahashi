<!DOCTYPE html>
<html class="no-js" lang="zxx">
    <head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <!-- Meta tag -->
		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta name="keywords" content="{{!empty($data['meta_keys'])?strip_tags($data['meta_keys']):''}}">
		<meta name="description" content="{{!empty($data['meta_desc'])?strip_tags($data['meta_desc']):''}}">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">	
		<!-- Title Tag -->
        <title>{{!empty($data['page_title'])?$data['page_title']:'WEBSITE_NAME'}}</title>
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="{{asset('uploads/favicon.png')}}">	
		<!-- Google Font -->
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:400,400i,600,700,800" rel="stylesheet">
		<!-- Bootstrap Css -->
        <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
		<!-- Font Awesome CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}">
		<!-- Slick Nav CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}">
        <!-- Cube Portfolio CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/cubeportfolio.min.css') }}">
        <link rel="stylesheet"href="{{ asset('frontend/css/magnific-popup.min.css') }}">
		<!-- Owl Carousel CSS -->
		<link rel="stylesheet" href="{{ asset('frontend/css/owl.theme.default.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}">
		<!-- Slick Slider CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/slickslider.min.css') }}">
		<!-- Animate CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/animate.min.css') }}">
		<!-- blue-bird StyleShet CSS -->
        <link rel="stylesheet" href="{{ asset('frontend/css/reset.css') }}">	
        <link rel="stylesheet" href="{{ asset('frontend/style.css') }}">
		<link rel="stylesheet" href="{{ asset('frontend/css/responsive.css') }}">
		{{-- <link rel="stylesheet" href="public/plugin/ckeditor/contents.css" type="text/css">		 --}}
    </head>
    <body>
		<!-- Preloader -->
		 <div class="preloader">
		  <div class="preloader-inner">
			<div class="single-loader one"></div>
			<div class="single-loader two"></div>
			<div class="single-loader three"></div>
			<div class="single-loader four"></div>
			<div class="single-loader five"></div>
			<div class="single-loader six"></div>
			<div class="single-loader seven"></div>
			<div class="single-loader eight"></div>
			<div class="single-loader nine"></div>
		  </div>
		</div>
		<!-- End Preloader -->
<!-- Start Header -->
	<header id="header" class="header">
			<!-- Middle Bar -->
			<div class="middle-bar">
				<div class="container">
					<div class="row">
						<div class="col-lg-2 col-12">
							<!-- Logo -->
							<div class="logo">
								<a href="{{ url('/') }}"><img src="{{asset('uploads/main-logo.png')}}" alt="logo"></a>
							</div>
							<div class="link"><a href="{{ url('/') }}">
							<img src="{{asset('uploads/fixed-logo.png')}}" alt="logo">
							</a></div>
							<!--/ End Logo -->
							<button class="mobile-arrow"><i class="fa fa-bars"></i></button>
							<div class="mobile-menu"></div>
						</div>
						<div class="col-lg-10 col-12">
							<!-- Main Menu -->
							<div class="mainmenu">
								<nav class="navigation">
									<ul class="nav menu">
										<li class="active">
											<a href="{{ url('/') }}">Home</a>
										</li>
										
										<li class="menu-large"><a href="{{ url('/about') }}">Methodology<i class="fa fa-caret-down"></i></a>

					<ul class="dropdown megamenu">
					      <li>
					        <ul class="row">
					          <li class="col-md-4">
					          	<h5>By Company</h5>
					            <ul>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-university"></i>
					                	</span>
					                	<b>Start Ups</b>
					                	<small> Software for start-ups </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-file-powerpoint-o"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                  
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-compass"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-floppy-o"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					            </ul>
					          </li>
					          <li class="col-md-4">
					            <h5>Products</h5>
					            <ul>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-television"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-user-o"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-star-o"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-bell-o"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              
					            </ul>
					          </li>
					          <li class="col-md-4">
					            <h5>Products</h5>
					            <ul>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-cog"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-briefcase"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-bar-chart"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-pie-chart"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					            </ul>
					          </li>

					        </ul>
					      </li>
					    </ul>


			</li>
			<li><a href="{{ url('/product') }}">Products</a></li>
										
			<li class="menu-large"><a href="{{ url('/service') }}">Services<i class="fa fa-caret-down"></i></a>
				<ul class="dropdown megamenu">
					<li>
						<ul class="row">
							<li class="col-md-4">
					          	<h5>By Company</h5>
					            <ul>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-university"></i>
					                	</span>
					                	<b>Start Ups</b>
					                	<small> Software for start-ups </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-file-powerpoint-o"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                  
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-compass"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-floppy-o"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					            </ul>
					          </li>
					          <li class="col-md-4">
					            <h5>Products</h5>
					            <ul>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-television"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-user-o"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-star-o"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-bell-o"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              
					            </ul>
					          </li>
					          <li class="col-md-4">
					            <h5>Products</h5>
					            <ul>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-cog"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-briefcase"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-bar-chart"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					              <li>
					                <a href="#">
					                	<span class="icon product-icon">
					                		<i class="fa fa-pie-chart"></i>
					                	</span>
					                	<b>Government Software</b>
					                	<small> Quick & empowering solutions </small>
					                </a>
					              </li>
					            </ul>
					          </li>
							</ul>
						</li>
						</ul>
					</li>

					<li><a href="{{ url('/blog') }}">Blog's</a></li>	
					<li><a href="{{ url('/contact') }}">Contact</a></li>
				</ul>
			</nav>
								<!-- Button -->
								<!-- <div class="button">
									<a href="#" class="btn">Get a quote</a>
								</div> -->
								<!--/ End Button -->
							</div>
							<!--/ End Main Menu -->
						</div>
					</div>
				</div>
			</div>
			<!--/ End Middle Bar -->
	</header>
<!--/ End Header -->