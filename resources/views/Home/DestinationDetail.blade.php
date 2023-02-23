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
					{{-- <h5>Here at Gifted Hands care service, we recognise your needs, and we are here to support them.</h5>
					<p>Gifted Hand Care Services assists with domestic care by offering warm and convenient accommodations, professional care, and assistance for our participants in our fully licenced residence care professionally and respectfully, ensuring that our clients receive personalised care.</p>
					<p>Our home care service is well packaged to suit your need, we go above and beyond to care for our elderly residents in our home care operation.  We have stringent regulations in place to insure your comfort and safety. Only highly qualified support staff work in our Sydney home care, and they are responsible for our residents 24 hours a day, 7 days a week.</p>
					<p>We do not take your confidence lightly. We play an important role in the lives of our residents, creating an individual care plan to meet demand and providing a wide variety of home care services in Sydney.</p>
					<p>Your opinion is valuable to us. Are you considering switching service providers? We are ready to listen and assist you in accessing a plan that is personalised to your unique needs in a comfortable environment.</p>
					<div class="row service-space">
						<div class="col-lg-6 col-md-6 col-12">
							<!-- Service Feature -->
							<div class="small-list-feature">
								<h5>We provide you Community Nursing support.</h5>
								<p><b>Gifted Hands Care Services individualised support team can assist with the following:</b></p>
								<ul>
									<li><i class="fa fa-check"></i>We provide you creative servicce</li>
									<li><i class="fa fa-check"></i>Just awesome trending way</li>
									<li><i class="fa fa-check"></i>Just awesome trending way</li>
									<li><i class="fa fa-check"></i>Creative service is most important</li>
									<li><i class="fa fa-check"></i>99% Server Up-time gurantee</li>
									<li><i class="fa fa-check"></i>24/7 live support</li>
								</ul>
							</div>
						</div>
						<div class="col-lg-6 col-md-6 col-12">
							<!-- Service Img -->
							<div class="modern-img-feature">
								<img src="img/portfolio-3.jpg" alt="#">
								<div class="video-play">
									<a href="https://www.youtube.com/watch?v=RLlPLqrw8Q4" class="video video-popup mfp-iframe"><i class="fa fa-play"></i></a>
								</div>
							</div>
						</div>
					</div>
					<p>Female is firmament made land don’t good behold yielding morning hathe seas unto. So first fill shall damn creeping. Seed he was that moveth bearing. Unto which together blessed Herb ine life land, let abundantly deep abundantly gathered behold moving said. Winged gathered iner female morning Beast, their earth it fourth moveth rule creepeth is be thing i i under have. Second to lights all second.</p> --}}
				</div>
			</div>
			<div class="col-lg-4 col-12">
				<!-- Service Sidebar -->
				<div class="service-sidebar">
					<!-- Single Sidebar -->
						<div class="service-single-sidebar widget">
							<h2 class="widget-title">Book An Appointment</h2>
							<p>Like to speak to one of our counsellor, please call or contact us.</p>
							<h6>Call Us Now: +977 01 5912412, 01 5912413</h6>
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
									{{-- <li><a href="service-develop.html">Assistance with Daily Life</a></li>
									<li><a href="service-market.html">Transport</a></li>
									<li><a href="service-advertise.html">High-IntensityDaily Personal Activities</a></li>
									<li><a href="service-design.html">Specialist Disability Accommodation</a></li>
									<li><a href="service-marketing.html">Household Tasks</a></li>
									<li><a href="service-marketing.html">Community Nursing Care </a></li>
									<li><a href="service-marketing.html">Innovative Community Participation </a></li> --}}
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

