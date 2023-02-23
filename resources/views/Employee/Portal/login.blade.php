@extends('Layout.Main')
@section('content')
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
                            <li>Login</li>
                        </ul>
                    </div>
                    <!-- Bread Title -->
                    <div class="bread-title"><h2>Login to your Account.</h2></div>
                </div>
            </div>
        </div>
    </div>
</div>
<section class="contact-us account-sec section-space">
    <div class="container">
        <div class="row">
            <div class="offset-lg-2 col-lg-8 offset-lg-2 offset-md-1 col-md-10 offset-md-1 col-12">
                <!-- Contact Form -->
                <div class="contact-form-area m-top-30">
                    <h4>Login to your account!</h4>
                    <form class="form" id="loginForm" method="POST" action="{{route('login')}}">
                        <div class="row">  
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <div class="icon"><i class="fa fa-user"></i></div>
                                    <input type="email" name="email" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Password <span>*</span></label>
                                    <div class="icon"><i class="fa fa-key"></i></div>
                                    <input type="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group">
                                    <div class="agree-label">
                                        <input type="checkbox" id="gh" name="remember" value="on">
                                        <label for="gh">
                                            Remember Me 
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group text-right">
                                    Forgot Password? <a href="{{route('forgot-password')}}" class="gh-link"> Click Here </a>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12 form-messages"></div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group button">
                                    <button type="submit" class="homes-btn theme-1 save">Log In Now</button>
                                </div>
                            </div> 
                            {{-- <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group text-right">
                                    Not a member? <a href="register.html" class="gh-link"> Register </a>
                                </div>
                            </div> --}}
                        </div>
                    </form>
                </div>
                <!--/ End contact Form -->
            </div>
        </div>
    </div>
</section>
@endsection