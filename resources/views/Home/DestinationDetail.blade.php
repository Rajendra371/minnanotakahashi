@extends('Layout.Main')
@section('content')
<!-- Breadcrumb -->
<div class="breadcrumbs" style="background-image:url('{{asset('frontend/img/breadcrumbs-bg.jpg')}}'">
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
								<a href="{{route('study-abroad')}}">Study Abroad</a>
							</li>
							
						</ul>
					</div>
					<!-- Bread Title -->
					<div class="bread-title"><h2>Study Abroad</h2></div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--/ End Breadcrumb -->

<!-- Service Single -->
@if (!empty($destination_details) && count($destination_details))
<section class="service-single section-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-12">
				<div class="service-main-box">
					<h3>{{$destination_details[0]->title}}</h3>
					{{-- <h5>
						Community Nursing support you can count on.
					</h5> --}}
					<p>
						{{$destination_details[0]->short_content}}
					</p>
				</div>
				<!-- Service Image -->
				<div class="service-img">
					<figure><img src="{{ asset('uploads/study_destinations/'.$destination_details[0]->image) }}" alt="{{$destination_details[0]->title}}"></figure>
				</div>
				<!-- Service Content -->
				<div class="service-content">
					{!! $destination_details[0]->content !!}
				</div>
			</div>
			<div class="col-lg-4 col-12">
				<!-- Service Sidebar -->
				<div class="service-sidebar">
					<!-- Single Sidebar -->
						<div class="service-single-sidebar widget">
							<h2 class="widget-title">Get an Appointment</h2>
							<p>Like to speak to one of our counsellor, please call or contact us.</p>
							<h6>Call Us Now: +977-1-4975530,  9743900536</h6>
							<div class="contact-form-area service">
								<!-- Service Form -->
								<form class="form" method="POST" id="appointmentForm" action="{{route('appointment')}}">
									<div class="row">
										<div class="col-12">
											<div class="form-group">
												<label>Full Name <span>*</span></label>
												<div class="icon"><i class="fa fa-user"></i></div>
												<input type="text" name="full_name" required>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>Address </label>
												<div class="icon"><i class="fa fa-map"></i></div>
												<input type="text" name="address" required>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>Your Email <span>*</span></label>
												<div class="icon"><i class="fa fa-envelope"></i></div>
												<input type="email" name="email" required>
											</div>
										</div>
										<div class="col-12">
											<div class="form-group">
												<label>Contact Number</label>
												<div class="icon"><i class="fa fa-phone"></i></div>
												<input type="number" name="contact_number">
											</div>
										</div>
									   <div class="col-12">
										   <div class="form-group">
											   <label>Subject</label>
												<div class="icon"><i class="fa fa-tag"></i></div>
												<input type="text" name="subject">
										   </div>
									   </div>
									   <div class="col-12">
											<div class="form-group">
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
								<!--/ End Service Form -->
							</div>
						</div>	
					<!-- Single Sidebar -->
					@if ($services_menu)
						<div class="service-single-sidebar widget">
							<h2 class="widget-title">Service Menu</h2>
							<div class="menu-service-menu-container">
								<!-- Service Menu -->
								<ul id="menu-service-menu" class="menu">
									@foreach ($services_menu as $service)
									@if ($loop->iteration > 8)
									@break
									@endif
									<li><a href="{{route('service-details',"$service->slug-$service->id")}}">{{$service->service_name}}</a></li>
									@endforeach
								</ul>
							</div>
						</div>
						@endif
				</div>
				<!--/ End Service Sidebar -->
			</div>
		</div>
	</div>
</section>	
<!--/ End Services -->
@endif
@endsection

