@extends('Layout.Main')
@section('content')
<section class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2><i class="fa fa-pencil"></i>Our Product</h2>
				<ul>
					<li><a href="{{url('/')}}"><i class="fa fa-home"></i>Home</a></li>
					<li><a href="{{url('/product')}}"><i class="fa fa-clone"></i>Product</a></li>
					<li class="active"><i class="fa fa-clone"></i> Products Details</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<!-- Start portfolio -->
	<section id="portfolio" class="portfolio single section">
			<div class="container">
				<div class="row">	
					<div class="col-lg-8 col-12">	
						<div class="portfolio-single">
							<div class="portfolio-head">
								<div class="stand">
						        <div class="monitor">
						            <img src="{{ URL::asset('uploads/product_image/' . $data['product_details'][0]->image) }}" alt="Project Image"/>
						        </div>
						    </div>
							</div>
						</div>
					</div>
					<div class="col-lg-4 col-12">
						<div class="portfolio-widget">
							<!-- Single Widget -->
							@if(!empty($data['product_details'][0]->customer))
								<div class="single-widget">
									<i class="fa fa-user"></i>
									<h4>Customer</h4>
									<a href="#">{{$data['product_details'][0]->customer}}</a>
								</div>
							@endif
						    <!--/ End Single Widget -->
							<!-- Single Widget -->
							
						    {{-- <div class="single-widget">
								<i class="fa fa-tags "></i>
								<h4>Category</h4>
								<a href="#">Mobile Application</a>
							</div> --}}
						
							<!--/ End Single Widget -->
							<!-- Single Widget -->
							@if(!empty($data['product_details'][0]->start_date))
						    <div class="single-widget">
								<i class="fa fa-calendar"></i>
								<h4>Start Date</h4>
								<a href="#">{{date('j F, Y', strtotime($data['product_details'][0]->start_date))}}</a>
							</div>
							@endif
							<!--/ End Single Widget -->
							<!-- Single Widget -->
							@if(!empty($data['product_details'][0]->end_date))
						    <div class="single-widget">
								<i class="fa fa-calendar"></i>
								<h4>End Date</h4>
								<a href="#">{{date('j F, Y', strtotime($data['product_details'][0]->end_date))}}</a>
							</div>
							@endif
							<!--/ End Single Widget -->
							<!-- Single Widget -->
							@if(!empty($data['product_details'][0]->website))
						    <div class="single-widget">
								<i class="fa fa-globe"></i>
								<h4>Website</h4>
								<a href="#">{{$data['product_details'][0]->website}}</a>
						   </div>
						   @endif
						    <!--/ End Single Widget -->
						</div>
					</div>
					<div class="col-12">
						<div class="portfolio-content">
							<h2>{{$data['product_details'][0]->title}}</h2>
							<p>{{strip_tags($data['product_details'][0]->description)}} </p>
							@if(!empty($data['product_details'][0]->features))
								<h2>Key Features</h2>
							@endif
							<div class="row">
								{{-- {{$data['product_details'][0]->features}} --}}
								{!!$data['product_details'][0]->features!!}
								{{-- <div class="col-lg-4">
									<div class="single-sidebar category dtl-sidebar">
										<h4><span><i class="fa fa-pencil"></i>Corporate Management</span></h4>
										<ul>
											<li><i class="fa fa-caret-right"></i>Member/Share Detail</li>			
											<li><i class="fa fa-caret-right"></i>Saving/Recurring Deposit Detail<li>			
											<li><i class="fa fa-caret-right"></i>Fixed Deposit Detail</li>			
											<li><i class="fa fa-caret-right"></i>Daily Purchase List</li>			
											<li><i class="fa fa-caret-right"></i>Loan Detail</li>			
											<li><i class="fa fa-caret-right"></i>Finance Detail</li>			
											<li><i class="fa fa-caret-right"></i>Reports</li>			
										</ul>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="single-sidebar category dtl-sidebar">
										<h4><span><i class="fa fa-star"></i>Revenue Management</span></h4>
										<ul>
											<li><i class="fa fa-caret-right"></i>Bill generation, payment & Print</li>			
											<li><i class="fa fa-caret-right"></i>Day Book, Daily Collection Report<li>			
											<li><i class="fa fa-caret-right"></i>Student Transaction</li>			
											<li><i class="fa fa-caret-right"></i>Daily Purchase List</li>			
											<li><i class="fa fa-caret-right"></i>Due Bill, Due Report</li>			
											<li><i class="fa fa-caret-right"></i>Income Detail</li>			
											<li><i class="fa fa-caret-right"></i>Parent & Guardian’s details</li>			
										</ul>
									</div>
								</div>
								<div class="col-lg-4">
									<div class="single-sidebar category dtl-sidebar">
										<h4><span><i class="fa fa-book"></i>Academic Managementt</span></h4>
										<ul>
											<li><i class="fa fa-caret-right"></i>Individual mark/Grade sheet</li>			
											<li><i class="fa fa-caret-right"></i>Mark ledger, Mark entry<li>			
											<li><i class="fa fa-caret-right"></i>Attendance</li>			
											<li><i class="fa fa-caret-right"></i>Daily Purchase List</li>			
											<li><i class="fa fa-caret-right"></i>Remarks entry</li>			
											<li><i class="fa fa-caret-right"></i>Mark verification, Mark derivation</li>			
											<li><i class="fa fa-caret-right"></i>Top 10, Passed, Failure students list</li>			
										</ul>
									</div>
								</div> --}}
								<div class="clearfix"></div>
							</div>

							<div class="request-form">
							<h2 class="title">Demo Request Form</h2>
							<h6>Check Our Demo</h6>
							<p>Our team will send you Demo Username and Password after you fill up this form.</p>
							<!-- Contact Form -->
							<form id="enquiry-form" class="form" method="post" action="">
								<div class="row">
									<div class="col-lg-4 col-12">
										<div class="form-group">
											<input type="text" name="fullname" id="fullname" class="form-control" placeholder="Your Full Name">
											<span class="text-danger" id="fullname-error"></span>
										</div>
									</div>
									<div class="col-lg-4 col-12">
										<div class="form-group">
											<input type="text" name="company_name" id="company_name" class="form-control" placeholder="Your Company Name">
											<span class="text-danger" id="company_name-error"></span>
										</div>
									</div>
									<div class="col-lg-4 col-12">
										<div class="form-group">
											<input type="email" name="email" id="email" class="form-control" placeholder="Your Email">
											<span class="text-danger" id="email-error"></span>
										</div>
									</div>
									<div class="col-lg-4 col-12">
										<div class="form-group">
											<input type="text" name="mobile_no" id="mobile_no" class="form-control" placeholder="Your Number">
											<span class="text-danger" id="mobile_no-error"></span>
										</div>
									</div>
									<div class="col-lg-4 col-12">
										<div class="form-group">
											<input type="text" name="product_name" id="product_name" class="form-control" value="{{$data['product_details'][0]->title}}" readonly>
										</div>
									</div>
									<div class="col-lg-4 col-12">
										<div class="form-group">
											<input type="text" name="subject" id="subject" class="form-control" placeholder="Subject">
											<span class="text-danger" id="subject-error"></span>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">
											<textarea name="message" rows="5" id="message" class="form-control" placeholder="Type Your Message Here"></textarea>
											<span class="text-danger" id="message-error"></span>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group button">	
											<button type="submit" class="btn primary">Submit Request</button>
										</div>
									</div>
									<div class="col-12">
										<div class="form-group">	
											<span class="text-success" id="success-message"> </span>
										</div>
									</div>
								</div>
							</form>
							<!--/ End Contact Form -->
						</div>


						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-12">
						<div class="related-portfolio">
							<h2 class="title">Related Portfolio / Products </h2>
							<div class="row">
								@if(!empty($data['related_product']))
								@foreach($data['related_product'] as $keys=>$rp)
								@php
									$productname=$rp->title;
									$pid=$rp->id;
									$compstr=$productname.' '.$pid;
									$product_slug= clean_url($compstr);
								@endphp
								<div class="col-lg-4 col-12">
									<div class="portfolio-single">
										<div class="portfolio-head">
											<img src="{{ URL::asset('uploads/product_image/' . $rp->image) }}" alt="#"/>
										</div>
										<div class="portfolio-hover">
											<h4><a href="{{ url("/product_detail/{$product_slug}")}}">{{!empty($rp->title)?$rp->title:''}}</a></h4>
											<p>{{!empty($rp->short_description)?$rp->short_description:''}}</p>
											<div class="button">
												<a href="{{ url("/product_detail/{$product_slug}")}}"><i class="fa fa-link"></i> View Details </a> 
											</div>
										</div>
									</div>
								</div>
								@endforeach
								@endif
								{{-- <div class="col-lg-4 col-12">
									<div class="portfolio-single">
										<div class="portfolio-head">
											<img src="public/frontend/images/portfolio/p2.jpg" alt="#"/>
										</div>
										<div class="portfolio-hover">
											<h4><a href="portfolio-single.html">Responsive Design</a></h4>
											<p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim</p>
											<div class="button">
		                  	<a href="product-details.html"><i class="fa fa-link"></i> View Details </a> 
		                  </div>
										</div>
									</div>
								</div> --}}
								{{-- <div class="col-lg-4 col-12">
									<div class="portfolio-single">
										<div class="portfolio-head">
											<img src="public/frontend/images/portfolio/p3.jpg" alt="#"/>
										</div>
										<div class="portfolio-hover">
											<h4><a href="portfolio-single.html">Bootstrap Based</a></h4>
											<p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim</p>
											<div class="button">
		                  	<a href="product-details.html"><i class="fa fa-link"></i> View Details </a> 
		                  </div>
										</div>
									</div>
								</div> --}}
							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!--/ End portfolio -->
		<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
		<script type="text/javascript">
	 
	 
		 $('#enquiry-form').on('submit', function(event){
			 event.preventDefault();
			 $('#fullname-error').text('');
			 $('#company_name-error').text('');
			 $('#email-error').text('');
			 $('#mobile_no-error').text('');
			 $('#subject-error').text('');
			 $('#message-error').text('');
	 
			 fullname = $('#fullname').val();
			 company_name = $('#company_name').val();
			 email = $('#email').val();
			 mobile_no = $('#mobile_no').val();	 
			 product_name = $('#product_name').val();
			 subject = $('#subject').val();
			 message = $('#message').val();
	 
			 $.ajax({
				 headers: {
			   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			   },
			   url: "/enquiry",
			   type: "POST",
			   data:{
				 _token: '{{csrf_token()}}', 
				   fullname:fullname,
				   company_name:company_name,
				   email:email,
				   mobile_no:mobile_no,
				   product_name:product_name,
				   subject:subject,
				   message:message,
			   },
			   success:function(response){
				 console.log(response);
				 if (response) {
				   $('#success-message').text(response.message);
				   $("#enquiry-form")[0].reset();
				 }
			   },
			   error: function(response) {
				   $('#fullname-error').text(response.responseJSON.errors.fullname);
				   $('#company_name-error').text(response.responseJSON.errors.company_name);
				   $('#email-error').text(response.responseJSON.errors.email);
				   $('#mobile_no-error').text(response.responseJSON.errors.mobile_no);
				   $('#subject-error').text(response.responseJSON.errors.subject);
				   $('#message-error').text(response.responseJSON.errors.message);
			   }
			  });
			 });
		   </script>

@endsection