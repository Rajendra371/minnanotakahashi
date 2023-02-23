@php
  $user = auth()->guard('employee')->user();
@endphp
<!DOCTYPE html>
<html lang="en"> 
<head>
<!-- Meta Tag -->
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name='ACCOL' content='Bikash Bhandari'>
<meta name="ACCOL" content="Gifted Hands website Design By Bikash Bhandari">

<!-- Title Tag  -->
<title>GiftedHands - Website</title>

<!-- Favicon -->
<link rel="icon" type="image/favicon.png" href="{{asset('frontend/img/favicon.png')}}">

<!-- Plugins CSS -->

<link rel="stylesheet" href="{{asset('frontend/user/css/bootstrap.min.css')}}">
<link type="text/css" href="{{asset('frontend/user/font-awesome-4.7.0/css/font-awesome.min.css')}}" rel="stylesheet" />

<!-- Stylesheet -->
<link rel="stylesheet" href="{{asset('frontend/user/css/style.css')}}"> 
<link rel="stylesheet" href="{{asset('frontend/user/css/responsive.css')}}"> 
{{-- Datatable css --}}
<link rel="stylesheet" type="text/css" href="{{asset('frontend/DataTables/datatables.min.css')}}"/>
</head>
<body>

<!-- Preloader -->
<div class="preeloader">
  <div class="preloader-spinner"></div>
</div>
<!--/ End Preloader --> 

<!-- Header -->
<header class="header">
    <div class="container"> 
      
      <div class="style-chooser-inner profile-head">
        <div class="dropdown show">
          <a class="dropdown-toggle" href="javascript:void(0)" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           {{-- <img src="images/user.jpg" alt="user" />  --}}
           <i class="fa fa-user-circle fa-lg"></i>
           <i class="fa fa-angle-double-down"></i>
          </a>

          <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
             <div class="media">
                <div class="media-left">
                  {{-- <img src="images/user.jpg" alt="user" /> --}}
                  <i class="fa fa-user-circle fa-lg"></i>
                </div> 
                <div class="media-body">
                    <div class="text-uppercase">{{ "$user->first_name $user->middle_name $user->last_name" }}</div> 
                    <div class="text-muted">{{$user->email}}</div>
               </div>
            </div>
            <div class="dropdown-item"><a href="{{ route('change-password') }}"><i class="fa fa-key">&nbsp;</i> Change Password</a></div>
            <div class="dropdown-item">
              <form action="{{route('logout')}}" method="post" id="logoutForm">
                {{ csrf_field() }}
                <button type="submit" class="btn btn-danger" style="width: 100%; text-align:left;font-size:16px"><i class="fa fa-sign-out">&nbsp;</i> Logout</button>
              </form>
            </div>
          </div>
        </div>
      </div>

      <nav class="navbar">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
            <a class="navbar-brand"href="{{route('home')}}" title="Brand">
              <img src="{{asset('frontend/img/logo.jpg')}}" alt="#">
            </a> 
            </div>
          
         <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-left">
              <li><a href="{{route('dashboard')}}">Roster</a></li>
              <li><a href="{{route('trainings')}}">Training List</a></li>
            </ul>
          </div> 
          <!-- /.navbar-collapse -->
      </nav>
    </div>
    <div class="clearfix"></div>
  </header>
<!--/ End Header -->  
<div class="mid-part account-inner">
    @yield('content')
</div> 

<footer>
  <div class="footer-bottom">
    <div class="container">
      <div class="row">
        {{-- <div class="col-md-5 col-sm-12"> <span><a href="#" target="_blank">Roster List</a></span> <span><a href="#" target="_blank">Terms & Conditions</a></span> </div> --}}
        <div class="col-md-12 text-right col-sm-12">  
          <p>© Copyright <?php echo date("Y"); ?> <a href="{{route('home')}}"> GiftedHands Pvt.Ltd. Australia all right reserved</a>.</p> </div>
        <div class="clearfix"></div>
      </div>
    </div>
  </div>
</footer>
{{-- Modal --}}
<div class="modal fade" id="commonModal" tabindex="-1" role="dialog" aria-labelledby="commonModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="commonModalTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="commonModalBody">
      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        {{-- <button type="button" class="btn btn-primary">Save changes</button> --}}
      </div>
    </div>
  </div>
</div>
{{-- Modal Html Ends --}}
  <!-- Jquery JS --> 
  <script src="{{asset('frontend/user/js/jquery.min.js')}}"></script> 
  <!-- Bootstrap -->
  <script src="{{asset('frontend/user/js/bootstrap.min.js')}}"></script> 
  {{-- Datatable --}}
  <script type="text/javascript" src="{{asset('frontend/DataTables/datatables.min.js')}}"></script> 
  {{-- Axios --}}
  <script src="{{asset('frontend/user/js/axios.min.js')}}"></script> 
  <script src="{{asset('frontend/user/js/axios_setup.js')}}"></script> 
  <!-- Active JS --> 
  <script src="{{asset('frontend/user/js/custom.js')}}"></script>
  @yield('scripts') 
  </body>
  </html> 