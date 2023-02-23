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
							<li>
								Blog
							</li>
						</ul>
					</div>
					<!-- Bread Title -->
					<div class="bread-title"><h2>Blog</h2></div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Blogs Area -->
<section class="services section-bg section-space">
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-12">
				<div class="main-service">
				<div class="row">
                    @if(!empty($data['blog']))
                    @foreach($data['blog'] as $key=>$blog)
					<div class="col-lg-6 col-md-12 col-12">
						<!-- Single Blog -->
						<div class="single-service ">
							<div class="service-head"> <img src="{{asset('uploads/blog_image/'.$blog->image)}}" alt="{{$blog->blog_title}}">
							</div>
							<div class="service-content" style="position:relative !important; bottom:0; left:0;width:100%; display:block;">
								<h4><a href="{{route('blog-details',"$blog->blog_slug-$blog->id")}}">{{$blog->blog_title}}</a></h4>
								<p>{{ Illuminate\Support\Str::limit(strip_tags($blog->content), 200, '...') }}</p>
								<a href="{{route('blog-details',"$blog->blog_slug-$blog->id")}}" class="icon-bg">
									<i class="fa fa-arrow-circle-o-right"></i>
								</a> 
							</div>
						</div> 

						{{-- <div class="single-news ">
							<div class="news-head overlay"> <span class="news-img" style="background-image:url('{{asset('uploads/blog_image/'.$blog->image)}}')"></span> <a href="{{route('blog-details',"$blog->blog_slug-$blog->id")}}" class="homes-btn theme-2">Read more</a> </div>
							<div class="news-body">
								<div class="news-content">
								  <h3 class="news-title"><a href="{{route('blog-details',"$blog->blog_slug-$blog->id")}}">{{$blog->blog_title}}</a></h3>
								  <div class="news-text">
									  <p>{{ Illuminate\Support\Str::limit(strip_tags($blog->content), 200, '...') }}</p>
								  </div>
								  <ul class="news-meta">
									  <li class="date"><i class="fa fa-calendar"></i>{{date('j F, Y', strtotime($blog->postdatead))}}</li>
									  <li class="view" title="Total Views"><i class="fa fa-eye"></i>{{$blog->view_count ?: 0}}</li>
								  </ul>
								  </div>
							  </div>
						  </div> --}}
						<!-- End Single Blog -->
                    </div>
                    @endforeach
                    @endif	
				</div>
				</div>
			</div>
			<div class="col-lg-4 col-12">
				<!-- Service Sidebar -->
				<div class="service-sidebar">
					<!-- Single Sidebar -->
						<div class="service-single-sidebar widget">
							<h2 class="widget-title">Any further questions?</h2>
							<p>Like to speak to one of our registered nurses, please call or contact us.</p>
							<h6>Call Us Now: +977-01-9810099062</h6>
							<div class="contact-form-area service">
								<!-- Service Form -->
								<form class="form" method="POST" id="contactForm" action="{{route('contact-us')}}">
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
				</div>
				<!--/ End Service Sidebar -->
			</div>
		</div>		
	</div>
</section>
<!--/ End Blogs Area -->
@endsection




