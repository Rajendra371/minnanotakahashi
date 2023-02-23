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
                            <li>Enter Password Reset Code</li>
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
                            An email has been sent to <a href="mailto:{{ Session::get('password_reset_email','') }}">{{ Session::get('password_reset_email','') }}</a> with password reset code.
                            Please enter the code below for verification.
                        </p>
                        <form class="form" method="post" id="verifyResetCode" action="{{route('verify-reset-code')}}">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Reset Code</label>
                                        <div class="icon"><i class="fa fa-cog"></i></div>
                                        <input type="text" name="reset_code">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12 form-messages"></div>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group button">
                                        <button type="submit" class="homes-btn theme-1 save">Verify Code</button>
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