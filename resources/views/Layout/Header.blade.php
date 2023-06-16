@php
   $dat = App\Http\Controllers\Api\Frontend\HomeController::header_footer(); 
  // dd($data);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Meta Tag -->
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="keywords" content="{{!empty($meta_keys)?strip_tags($meta_keys):''}}">
<meta name="description" content="{{!empty($meta_desc)?strip_tags($meta_desc):''}}">
<!-- Title Tag  -->
<title>
  {{!empty($page_title)?$page_title:''}} 
</title>
<?php if(!empty($og_title)):?>  
<meta property="og:title" content="<?php echo $og_title; ?>" />
<?php endif; ?>
<meta property="og:type" content="image" />
<?php if(!empty($og_desc)):?>
<meta property="og:description" content="<?php echo $og_desc; ?>" />
<?php endif; ?>
<?php if(!empty($og_blog_image)):?>
<meta property="og:image" content="<?php echo $og_blog_image; ?>" />
<?php else: ?>
<meta property="og:image" content="{{asset('uploads/main-logo.png')}}" alt="logo"> 
<?php endif; ?>
<meta property="og:image:width" content="600" /> 
<meta property="og:image:height" content="315" />
<!-- Favicon -->
<link rel="icon" type="image/favicon.png" href="{{asset('frontend/img/favicon.png')}}">

<!-- Web Font -->
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<!-- homes Plugins CSS -->
<link rel="stylesheet" href="{{asset('frontend/css/animate.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/font-awesome.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.min.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/owl-carousel.min.css')}}">

<!-- homes Stylesheet -->
<link rel="stylesheet" href="{{asset('frontend/css/reset.css')}}">
<link rel="stylesheet" href="{{asset('frontend/style.css')}}">
<link rel="stylesheet" href="{{asset('frontend/css/responsive.css')}}">

  {{-- Project Name: Global Eye Education Consultancy https://globaleye.edu.np/
	UI /UX  Developer: Bikash Bhandari
	Email: bikash.433@gmail.com
	URL: www.bhandaribikash.com.np
	Description: Global Eye Education Consultancy --}}

<!--[if lt IE 9]>
	 <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.2/html5shiv.min.js"></script>
	 <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->

</head>
<body>

<!-- Preloader -->
<div class="preeloader">
  <div class="preloader-spinner"></div>
</div>
<!--/ End Preloader --> 

<!-- Header -->
<header class="header"> 
  <!-- Topbar -->
  <div class="topbar">
    <div class="container">

      <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-4 col-sm-5 col-12  pad_right_0"> 
          <div class="logo"> 
            <div class="img-logo"> 
              <a href="{{route('home')}}">
              @if (!empty($dat['organization'][0]->logo) && file_exists(public_path('uploads/sitesetting_image/'.$dat['organization'][0]->logo)))
              <img src="{{asset('uploads/sitesetting_image/'.$dat['organization'][0]->logo)}}" alt="#"> 
              @endif
              </a> 
            </div>
          </div>
        </div>

        
        <div class="col-xl-9 col-lg-9 col-md-8 col-sm-7 col-12">
          <div class="row">
            <div class="col-lg-8 col-lg-8 col-md-12 col-sm-12 col-5"> 
              <!-- Top Contact -->
              <div class="top-contact text-right">
                @php
                    $contact = '';
                    if (!empty($dat['organization'][0])) {
                      $contact = $dat['organization'][0]->phone;
                    }
                    $phones = explode(",", $dat['organization'][0]->phone);
                   
                @endphp  
                {{-- <div class="single-contact"><i class="fa fa-phone"></i>Phone:{{trim($contact,',')}}</div> --}}
              
                @if(!empty($dat['organization'][0]))<div class="single-contact"><i class="fa fa-phone"></i><a href="tel:{{$phones[0]}}">{{$phones[0]}}</a>, <a href="tel:{{$phones[1]}}">{{$phones[1]}}</a></div>@endif
                @if(!empty($dat['organization'][0]))<div class="single-contact"><i class="fa fa-envelope"></i><a href="mailto:{{$dat['organization'][0]->email}}">{{$dat['organization'][0]->email}}</a></div>@endif
              </div>
              <!-- End Top Contact --> 
            </div>
            <div class="col-lg-4 col-lg-4 col-md-12 col-sm-12 col-7 pad_left_0">
              <div class="topbar-right">
                @auth('employee')
                <div class="dropdown">
                  <div class="button dropdown-toggle" id="userdetail" data-toggle="dropdown"> <a href="#" class="homes-btn"><i class="fa fa-user"></i> Welcome {{ Auth::guard('employee')->user()->first_name}}</a> </div>
                  <div class="dropdown-menu" aria-labelledby="userdetail">
                    <a class="dropdown-item" href="{{route('dashboard')}}">Dashboard</a>
                    <form action="{{route('logout')}}" method="post" id="logoutForm">
                      {{ csrf_field() }}
                      <button type="submit" class="dropdown-item">Logout</button>
                    </form>
                  </div>
                </div>
                  @endauth
                @guest('employee')
    
                <div class="button"> <a href="{{route('book-appointment')}}" class="homes-btn">Get an Appointment</a> </div>
                @endguest
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>
  <!--/ End Topbar --> 
  <!-- Middle Header -->
  <div class="middle-header">
    <div class="container">
      <div class="mobile-nav"></div>
      <div class="menu-area"> 
        <nav class="navbar navbar-expand-lg">
          <a class="navbar-brand" href="{{route('home')}}">
            <img src="{{ asset("uploads/favicon.png") }}" alt="logo" />
					</a>
          <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse" title="Main Menu">
              <span class="navbar-toggler-icon"></span>
          </button>
              <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="nav-inner">
                <!-- Naviagiton -->
                @php
                  $current_route = \Route::currentRouteName();
                @endphp
                <ul id="nav" class="nav main-menu menu navbar-nav">
                  <li 
                    @if ($current_route == 'home')
                    class="active"
                    @endif> 
                    <a href="{{route('home')}}">Home</a> 
                    
                  </li>

                  <li
                    @if ($current_route == 'about')
                      class="active icon-active"
                    @endif  class="icon-active"> 
                  <a href="javascript:void(0)">About Us</a> 
                    <ul class="sub-menu">                     
                      <li> <a href="{{route('who_are_we')}}">Who are we?</a></li>
                      <li> <a href="{{route('message-from-founder')}}">Message from Founder</a></li>  
                      <li> <a href="{{route('message-from-ceo')}}">Message from CEO</a></li>  
                      <li> <a href="{{route('choose')}}">Why us?</a></li>           
                      {{-- <li> <a href="{{route('team')}}">Our Team</a></li>            --}}
                    </ul>
                  </li>
                  <li 
                    @if ($current_route == 'services' || $current_route == 'service-details')
                      class="active icon-active"
                    @endif class="icon-active">
                     <a href="javascript:void(0)">Services</a>
                    <ul class="sub-menu">
                      @if (!empty($services_menu) && count($services_menu))
                      @foreach ($services_menu as $smenu)
                        <li> <a href="{{route('service-details',$smenu->slug.'-'.$smenu->id)}}">{{$smenu->service_name}}</a> </li>
                      @endforeach
                      @endif
                    </ul>
                  </li>
                  <li 
                    @if ($current_route == 'study-abroad' || $current_route == 'destination-details')
                      class="active icon-active"
                    @endif class="icon-active">
                     <a href="javascript:void(0)">Study Abroad</a>
                    <ul class="sub-menu">
                      @if (!empty($dat['destination_menu']) && count($dat['destination_menu']))
                      @foreach ($dat['destination_menu'] as $dmenu)
                        <li> <a href="{{route('destination-details',$dmenu->slug.'-'.$dmenu->id)}}">{{$dmenu->title}}</a> </li>
                      @endforeach
                      @endif
                    </ul>
                  </li>
                  {{-- <li
                    @if ($current_route == 'gallery')
                      class="active"
                    @endif> 
                    <a href="{{route('gallery')}}">Study Abroad</a>
                  </li> --}}
                  <li 
                    @if ($current_route == 'country')
                    class="active"
                    @endif> 
                    <a href="{{route('country')}}">Universities</a>
                    
                  </li>
                  <li
                    @if ($current_route == 'gallery'|| $current_route == 'video')
                      class="active icon-active"
                    @endif class="icon-active"> 
                    <a href="javascript:void(0)">Media</a>
                    <ul class="sub-menu">                     
                      <li> <a href="{{route('gallery')}}">Gallery</a></li>
                      <li> <a href="{{route('video')}}">Video</a></li>          
                    </ul>
                  </li>
                  {{-- <li
                  @if ($current_route == '#')
                    class="active"
                  @endif> 
                  <a href="{{route('referral-form')}}">Referral Form</a>
                  </li> --}}
                  <li 
                  @if ($current_route == 'training' || $current_route == 'training-details')
                    class="active icon-active"
                  @endif class="icon-active">
                   <a href="javascript:void(0)">Training</a>
                  <ul class="sub-menu">
                    @if (!empty($dat['training_menu']) && count($dat['training_menu']))
                    @foreach ($dat['training_menu'] as $tmenu)
                      <li> <a href="{{route('training-details',$tmenu->slug.'-'.$tmenu->id)}}">{{$tmenu->title}}</a> </li>
                    @endforeach
                    @endif
                  </ul>
                </li>
                  {{-- <li  
                    @if ($current_route == 'career')
                      class="active"
                    @endif> 
                  <a href="{{route('career')}}">Training</a> </li> --}}
                  <li  
                    @if ($current_route == 'contact')
                      class="active"
                    @endif> 
                  <a href="{{route('contact')}}">Contact Us </a> </li>
                </ul>
                <!--/ End Naviagiton --> 
              </div>
            </div>
        </nav> 
      </div>
    </div>
  </div>
  <!--/ End Middle Header --> 
  
</header>
<!--/ End Header -->  