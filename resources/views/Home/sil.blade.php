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
							<li>SIL Referral Form</li>
						</ul>
					</div>
					<!-- Bread Title -->
					<div class="bread-title"><h2>Support Independent Living</h2></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/ End Breadcrumb -->

<!-- Contact Us -->
<section class="contact-us section-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-12">
				<!-- Contact Form -->
				<div class="contact-form-area referral-form">
					<form class="form" id="silForm" method="post" action="{{route('support-form-save')}}">
						<div class="row">
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-7 col-12">
								<div class="form-group"> 
									<input type="hidden" name="type" value="SIL">
									<label>Full Name <span>*</span></label>
									<input type="text" name="full_name" required>
								</div>
							</div>
							<div class="col-xl-3 col-lg-3 col-md-3 col-sm-5 col-12">
								<div class="form-group">
									<label>Contact Number</label>
									<input type="number" name="contact_number" minlength="8" maxlength="10">
								</div>
							</div>
							<div class="col-xl-5 col-lg-5 col-md-5  col-sm-5 col-12">
								<div class="form-group">
									<label>Email Address <span>*</span></label>
									<input type="email" name="email" required>
								</div>
							</div>
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-7 col-12">
								<div class="form-group">
									<label>Subject</label>
									<input type="text" name="subject">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group textarea">
									<label>Message <span>*</span></label>
									<textarea type="textarea" name="message" rows="5" required></textarea>
								</div>
							</div>
							<div class="col-12 mt-2 py-2 form-messages"></div>
							<div class="col-12">
								<div class="form-group button">
									<button type="submit" class="homes-btn theme-1 save">Submit</button>
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
<!--/ End Contact Us -->
@endsection