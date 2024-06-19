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
							<li>Contact </li>
						</ul>
					</div>
					<!-- Bread Title -->
					<div class="bread-title"><h2>Contact Us</h2></div>
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
			<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
				<!-- Contact Form -->
				<div class="contact-form-area">
					<h4>Get In Touch</h4>
					<form class="form" id="contactForm" method="post" action="{{route('contact-us')}}">
						<div class="row">
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label>Full Name <span>*</span></label>
									<div class="icon"><i class="fa fa-user"></i></div>
									<input type="text" name="full_name" required>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label>Contact Number</label>
									<div class="icon"><i class="fa fa-phone"></i></div>
									<input type="number" name="contact_number">
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label>Email Address <span>*</span></label>
									<div class="icon"><i class="fa fa-envelope"></i></div>
									<input type="email" name="email" required>
								</div>
							</div>
							<div class="col-lg-6 col-md-6 col-12">
								<div class="form-group">
									<label>Subject </label>
									<div class="icon"><i class="fa fa-tag"></i></div>
									<input type="text" name="subject">
								</div>
							</div>
							<div class="col-12">
								<div class="form-group textarea">
									<label>Message <span>*</span></label>
									<div class="icon"><i class="fa fa-pencil"></i></div>
									<textarea type="textarea" name="message" rows="5" required></textarea>
								</div>
							</div>
							<div class="col-12 mt-2 py-2 form-messages"></div>
							<div class="col-12">
								<div class="form-group button">
									<button type="submit" class="homes-btn theme-1 save">Send Now</button>
								</div>
							</div>
						</div>
					</form>
				</div>
				<!--/ End contact Form -->
			</div>
			<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
				<div class="contact-box-main">
					<div class="contact-title">
						<h2>Contact Us</h2>
						<p>You can contact us at</p>
					</div>
					<!-- Single Contact -->
					<div class="single-contact-box">
						<div class="c-icon"><i class="fa fa-clock-o"></i></div>
						<div class="c-text">
							<h4>Opening Hour</h4>
							<p>
								{{$data['organization'][0]->opening_days ?? ''}}
								<br>
								{{$data['organization'][0]->opening_time ?? ''}}
							</p>
						</div>
					</div>
					<!--/ End Single Contact -->
					<!-- Single Contact -->
					@if(!empty($data['organization'][0]->phone) || !empty($data['organization'][0]->mobile))
					<div class="single-contact-box">
						<div class="c-icon"><i class="fa fa-phone"></i></div>
						<div class="c-text">
							<h4>Call Us Now</h4>
							<p>
								@if ($data['organization'][0]->phone)
								Tel.: {{$data['organization'][0]->phone}}  
								<br>
								@endif
								@if ($data['organization'][0]->mobile)
								Mob.: {{$data['organization'][0]->mobile}}
								@endif
							</p>
						</div>
					</div>
					@endif
					<!--/ End Single Contact -->
					<!-- Single Contact -->
					@if(!empty($data['organization'][0]->email))
					<div class="single-contact-box">
						<div class="c-icon"><i class="fa fa-envelope-o"></i></div>
						<div class="c-text">
							<h4>Email Us</h4>
							<p>{{$data['organization'][0]->email}}<br> </p>
						</div>
					</div>
					@endif
					<!--/ End Single Contact -->
					<!-- Single Contact -->
					@if(!empty($data['organization'][0]->address1))
					<div class="single-contact-box">
						<div class="c-icon"><i class="fa fa-map-marker"></i></div>
						<div class="c-text">
							<h4>Location:</h4>
							<p>{{$data['organization'][0]->address1}}</p>
						</div>
					</div>
					@endif
					<!--/ End Single Contact -->

				</div>
			</div>
		</div>
	</div>
</section>	
<!--/ End Contact Us -->

<section class="branches section-space">
    <div class="container">
		@if(!$data['national_branch']->isEmpty())
		<div class="section-title default text-center">
			<div class="section-top">
			<h2><b>Our National Branches</b></h2>
			</div>
		</div>
		<div class="row">
			
				@foreach($data['national_branch'] as $key=>$nbranch)
				<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
					<div class="b_box">
						<h5>{{!empty($nbranch->branch_name)?$nbranch->branch_name:''}}</h5>
						<ul>
							@if(!empty($nbranch->contact_person))
							<li>
								<i class="fa fa-user"></i> <span>{{!empty($nbranch->contact_person)?$nbranch->contact_person:''}}</span> 
							</li>
							@endif
							@if(!empty($nbranch->branch_location))
							<li>
								<i class="fa fa-map-marker"></i> <span>{{!empty($nbranch->branch_location)?$nbranch->branch_location:''}}</span> 
							</li>
							@endif
                            @if(!empty($nbranch->contact_number))
							<li>
								<i class="fa fa-phone"></i> <span>{{!empty($nbranch->contact_number)?$nbranch->contact_number:''}}</span>
							</li>
							@endif
							@if(!empty($nbranch->email))
							<li>
								<i class="fa fa-envelope"></i> <span>{{!empty($nbranch->email)?$nbranch->email:''}}</span>
							</li>
							@endif
						</ul>
					</div>
				</div>
				@endforeach
		</div>
		@endif
		@if(!$data['international_branch']->isEmpty())
		<div class="section-title default text-center">
			<div class="section-top">
			<h2><b>Our International Branches</b></h2>
			</div>
		</div>
		<div class="row">
			@foreach($data['international_branch'] as $key=>$inbranch)
				<div class="col-lg-4 col-md-6 col-sm-6">
					<div class="b_box">
						<h5>{{!empty($inbranch->branch_name)?$inbranch->branch_name:''}}</h5>
						<ul>
							@if(!empty($inbranch->contact_person))
							<li>
								<i class="fa fa-user"></i> <span>{{!empty($inbranch->contact_person)?$inbranch->contact_person:''}}</span> 
							</li>
							@endif
							@if(!empty($inbranch->branch_location))
							<li>
								<i class="fa fa-map-marker"></i> <span>{{!empty($inbranch->branch_location)?$inbranch->branch_location:''}}</span> 
							</li>
							@endif
                            @if(!empty($inbranch->contact_number))
							<li>
								<i class="fa fa-phone"></i> <span>{{!empty($inbranch->contact_number)?$inbranch->contact_number:''}}</span>
							</li>
							@endif
							@if(!empty($inbranch->email))
							<li>
								<i class="fa fa-envelope"></i> <span>{{!empty($inbranch->email)?$inbranch->email:''}}</span>
							</li>
							@endif
						</ul>
					</div>
				</div>
			@endforeach
		</div>
		@endif
	</div>
</section>

<!-- Google Map -->
<div class="contact-map">
	<div class="mapouter">
		<div class="gmap_canvas">
			<iframe id="gmap_canvas" src="{{$data['organization'][0]->google_map_code}}" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>
		</div>
	</div>
</div>
<!--/ End Google Map -->
@endsection