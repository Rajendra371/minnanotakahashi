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
                            <li>Forget Your Password</li>
                        </ul>
                    </div>
                    <!-- Bread Title -->
                    <div class="bread-title"><h2>Password Recover</h2></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

<!-- Start Password Recover Area -->
    <section class="contact-us account-sec section-space">
        <div class="container">
            <div class="row">
                <div class="offset-lg-2 col-lg-8 offset-lg-2 offset-md-1 col-md-10 offset-md-1 col-12">
                    <!-- Contact Form -->
                    <div class="contact-form-area m-top-30">
                        <h4>Reset Password!</h4>
                        <p>
                            Enter the email of your account to reset the password. Then you will receive a mail with a reset code. If you have any issue about reset password 
                            <a href="{{route('contact')}}" class="gh-link"> contact us</a>
                        </p>
                        <form class="form" method="post" id="forgetPassword" action="{{route('forgot-password')}}">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Enter Email Address</label>
                                        <div class="icon"><i class="fa fa-user"></i></div>
                                        <input type="text" name="email">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 form-messages mt-2"></div>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group button">
                                        <button type="submit" class="homes-btn theme-1 save">Reset Password</button>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-12 col-12">
                                    <div class="form-group text-left">
                                        Remember your Password? <a href="{{route('login')}}" class="gh-link"> Login </a>
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
<!-- End Password Recover Area -->
@endsection