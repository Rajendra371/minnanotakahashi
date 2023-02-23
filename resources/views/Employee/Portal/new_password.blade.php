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
                            <li>Reset Password</li>
                        </ul>
                    </div>
                    <!-- Bread Title -->
                    <div class="bread-title"><h2>Reset Password</h2></div>
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
                    <h4>Reset Password!</h4>
                    <form class="form" id="newPasswordForm" method="POST" action="{{route('new_password')}}">
                        <div class="row">  
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Password <span>*</span></label>
                                    <div class="icon"><i class="fa fa-key"></i></div>
                                    <input type="password" name="password" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12">
                                <div class="form-group">
                                    <label>Confirm Password <span>*</span></label>
                                    <div class="icon"><i class="fa fa-key"></i></div>
                                    <input type="password" name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-12 form-messages"></div>
                            <div class="col-lg-6 col-md-6 col-12">
                                <div class="form-group button">
                                    <button type="submit" class="homes-btn theme-1 save">Change Password</button>
                                </div>
                            </div> 
                        </div>
                    </form>
                </div>
                <!--/ End contact Form -->
            </div>
        </div>
    </div>
</section>
@endsection