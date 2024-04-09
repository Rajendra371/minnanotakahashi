@extends('Layout.Main')
@section('content')
<style>
    .main-modal .modal-header .close {
    position: absolute;
    top: 25px;
    right: 15px;
    font-size: 16px;
    background: #e00c1b;
    color: #fff;
    padding: 5px 10px;
    opacity: 1;
    font-weight: normal;
}
</style>

<ul class="social_media">
    @if(!empty($organization[0]->facebook_link))
      <li>
        <a href="{{$organization[0]->facebook_link}}" target="_blank" data-toggle="tooltip" title="Facebook" data-placement="left">
          <i class="fa fa-facebook-f"></i>
        </a>
      </li>		
    @endif
    @if(!empty($organization[0]->instagram_link))						
      <li>
        <a href="{{$organization[0]->instagram_link}}" target="_blank" data-toggle="tooltip" title="Instagram" data-placement="left">
          <i class="fa fa-instagram"></i>
        </a>
      </li>		
    @endif	
    @if(!empty($organization[0]->linkedin_link))						
      <li>
        <a href="{{$organization[0]->linkedin_link}}" target="_blank"  data-toggle="tooltip" title="Linkedin" data-placement="left">
          <i class="fa fa-linkedin"></i>
        </a>
      </li>		
    @endif	
    @if(!empty($organization[0]->tiktok_link))					
      <li>
        <a href="{{$organization[0]->tiktok_link}}" target="_blank"  data-toggle="tooltip" title="TikTok" data-placement="left">
          <img src="{{ asset("uploads/tiktok-logo-4500.svg") }}" alt="TikTok icon" />
        </a>
      </li>	
    @endif
    @if(!empty($organization[0]->youtube_link))								
      <li>
        <a href="{{$organization[0]->youtube_link}}" target="_blank" data-toggle="tooltip" title="YouTube" data-placement="left">
          <i class="fa fa-youtube-play"></i>
        </a>
      </li>	
    @endif																							
  </ul>


    <!-- Hero Slider -->
    @if ($banners)
        <section class="hero-slider style1">
            <div class="home-slider">
                @foreach ($banners as $banner)
                    <!-- Single Slider -->
                    <div class="single-slider"
                        style="background-image:url('{{ asset("uploads/banner_image/$banner->banner_img") }}')">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-7 col-md-8 col-12">
                                    <div class="welcome-text">
                                        <div class="hero-text">
                                            <h4>{{ $banner->heading }}</h4>
                                            <h1>{!! strip_tags($banner->content) !!}</h1>
                                            <div class="button"> <a
                                                    @if (Route::has($banner->button_url1)) href="{{ route("$banner->button_url1") }}" 
                                                    @else
                                                    href="{{ url("$banner->button_url1") }}" @endif
                                                    class="homes-btn theme-1 effect">{{ $banner->button_text1 }}</a> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/ End Single Slider -->
                @endforeach
            </div>
        </section>
        <!--/ End Hero Slider -->
    @endif

    <!-- Features Area -->
    <section class="att-area section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-12">
                    {{-- @include('Home.evaluation_form') --}}
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12">
                        </div>
                        <div class="col-lg-8 col-md-8 col-12">
                            <div class="section-title default about-title">
                                <div class="section-top">
                                    <h1><span>About Us</span> <b>Global Eye Education Consultancy</b></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-4 col-12 about_img">
                            <img src="{{ asset('uploads/page_image/' . $about->images) }}" alt="About Us image">
                        </div>
                        <div class="col-lg-8 col-md-8 col-12">
                            <p>{!! str_limit($about->description,550) !!}</p>
                           {{-- {!! Illuminate\Support\Str::limit(strip_tags($about->description), 500) !!}  --}}
                            {{-- {{ Illuminate\Support\Str::limit($about->description, 550)}} --}}
                            {{-- <p>Global Eye Education Consultancy is one of the top resource providers for international
                                education at top Universities, which is based in Newplaza, Putalisadak, Kathmandu. We assist
                                students in receiving advice and counseling from an expert counselor who aids them in
                                selecting the ideal area, program, and university.</p>
                            <p>Global Eye Education Consultancy is one of the top resource providers for international
                                education at top Universities, which is based in Newplaza, Putalisadak, Kathmandu. We assist
                                students in receiving advice and counseling from an expert counselor.</p>
                            <p>
                                <b>Catch your flight to your dream with us.
                                    Australia | Canada | South Korea | Japan | UK</b>
                            </p> --}}
                            <a href="{{ route('about') }}" class="homes-btn theme-2">View More</a>
                        </div>
                        {{-- <div class="col-lg-3 col-md-3 col-12">
                            <div class="quick-links">
                                <h4>Expression Of Interest</h4>
                                <ul>
                                    <li>
                                    <a href="#">  IELTS/PTE/Languages Classes </a>
                                    </li>
                                    <li>
                                        <a href="#">  Free Counseling </a>
                                    </li>
                                    <li>
                                        <a href="#">   Visa Processing </a>
                                    </li>
                                    <li>
                                        <a href="#"> SOP / LOR </a>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}
                    </div>
                </div>
                {{-- <div class="col-lg-3 col-md-3 col-sm-12 col-12">
			@if (!empty($useful_links) && count($useful_links))	
			<div class="quick-links">
				<h4>Quick Links</h4>
				<ul>
					@foreach ($useful_links as $link) 
					<li>
						<a
						@if (Route::has($link->link_url))
						href="{{route("$link->link_url")}}"
						@else
						href="{{url("$link->link_url")}}"
						@endif 
						>{{$link->title}}</a></li>
					@endforeach
				</ul>
			</div>
			@endif
		</div> --}}
            </div>
        </div>
    </section>

    <!-- services -->
    @if ($services)
        <section class="services section-bg section-space">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="section-title default text-center">
                            <div class="section-top">
                                <h2><span>Browse</span><b>Service We Provide</b></h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="main-service service-slider">
                    @foreach ($services as $service)
                        @include('Layout.includes.single_service')
                    @endforeach
                </div>
                <div class="clearfix"></div>
            </div>
        </section>
    @endif
    <!--/ End services -->

    <!-- Video Feature -->
    <section class="video-feature side overlay section-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                    <div class="features-main">
                        <div class="section-title default about-title">
                            <div class="section-top">
                                <h2>
                                    {{-- {{ $about->page_title }} --}}
                                    <span>Why Us</span> <b>Why Choose Us</b>
                                </h2>
                            </div>
                        </div>

                        {{-- {!! $choose->description !!} --}}
                        <p>{!! str_limit($choose->description,300) !!}</p>
                        <div class="feature-btn"> <a href="{{ route('choose') }}" class="homes-btn theme-1">View More</a>
                        </div>
                    </div>
                </div>
                @if (!empty($video) && count($video))
                    <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                        <div class="img-feature"> <img src="{{ asset('uploads/video_gallery/' . $video[0]->image_url) }}"
                                alt="{{ $video[0]->title }}">
                            @if(!empty($video[0]->link))
                            <div class="video-play"> 
                                {{-- <a href="{{$video[0]->link ?? ''}}" class="video video-popup mfp-iframe">
                                    <i class="fa fa-play"></i> 
                                </a> --}}
                                <a href="{{$video[0]->link ?? ''}}" class="play-btn lightbox-image" data-fancybox="images" target="_blank">
                                    <i class="fa fa-play"></i> 
                                </a>
                                <div class="waves-block">
                                    <div class="waves wave-1"></div>
                                    <div class="waves wave-2"></div>
                                    <div class="waves wave-3"></div>
                                </div>
                            </div>
                            @endif
                            <span>Watch Our Video</span>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!--/ End Video Feature -->

    <!-- Features Area -->
    @if (!empty($destination) && count($destination))
        <section class="features-area section-bg">
            <div class="container">
                <div class="section-title default text-center mb-0">
                    <div class="section-top">
                        <h2 class="mb-0"><span>Browse Our</span><b>Top Destination</b></h2>
                    </div>
                </div>

                <div class="destination-slider">
                    @foreach ($destination as $tile)
                        <div class="single-feature">
                            @if ($tile->icon)
                                <div class="icon-head"><i class="{{ $tile->icon }}"></i></div>
                            @elseif($tile->image)
                                <div class="country-img">
                                    <a href="{{route('destination-details',"$tile->slug-$tile->id")}}">
                                        <figure> <img src="{{ asset("uploads/study_destinations/$tile->image") }}" />
                                        </figure>
                                    </a>
                                </div>
                            @endif

                            <h4><a href="{{route('destination-details',"$tile->slug-$tile->id")}}">{{ $tile->title }}</a>
                            </h4>
                            <p>{!! Illuminate\Support\Str::limit($tile->content, 120, '...') !!}</p>
                            <div class="button"> <a href="{{route('destination-details',"$tile->slug-$tile->id")}}" class="homes-btn"><i
                                        class="fa fa-long-arrow-right"></i>Learn More</a> </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!--/ End Features Area -->

    <!-- Appointment and Faqs -->
    <section class="faqs section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-12">
                    <div class="section-title default text-center">
                        <div class="section-top">
                            <h2><span>Get In Touch</span> <b>Get Appointment</b></h2>
                        </div>
                    </div>
                    <div class="contact-form-area">
                        <h6>Got a question? We would love to hear from you and we’ll respond as soon as possible.</h6>
                        <form class="form" id="appointmentForm" method="post" action="{{ route('appointment') }}">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Full Name</label>
                                        <div class="icon"><i class="fa fa-user"></i></div>
                                        <input type="text" name="full_name" placeholder="Full Name" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Applying Country</label>
                                        <div class="icon"><i class="fa fa-flag"></i></div>
                                        <select class="form-control" aria-placeholder="Choose Country" name="country">
                                            <option>Choose Country</option>
                                            <option value="Australia">Australia</option>
                                            <option value="Canada">Canada</option>
                                            <option value="Japan">Japan</option>
                                            <option value="South Korea">South Korea</option>
                                            <option value="United Kingdom">United Kingdom</option>
                                            <option value="New Zealand">New Zealand</option>
                                            <option value="Others">Others</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <div class="icon"><i class="fa fa-envelope"></i></div>
                                        <input type="email" name="email" placeholder="Enter E-Mail" required>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-12">
                                    <div class="form-group">
                                        <label>Mobile Number</label>
                                        <div class="icon"><i class="fa fa-phone"></i></div>
                                        <input type="number" name="contact_number" placeholder="Enter Number">
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group">
                                        <label>Applying Course</label>
                                        <div class="icon"><i class="fa fa-tag"></i></div>
                                        <input type="text" name="course" placeholder="Course you are interested in*">
                                    </div>
                                </div>
                                <ul class="col-lg-12 col-md-12 col-12 form-messages mt-2"></ul>
                                <div class="col-lg-12 col-md-12 col-12">
                                    <div class="form-group button">
                                        <button type="submit" class="homes-btn theme-1 save">Submit</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-12 faq_list">
                    <div class="section-title default text-center">
                        <div class="section-top">
                            <h2><span>FAQ's</span><b>Frequently Asked Questions</b></h2>
                        </div>
                    </div>
                    <div class="faqs-main m-top-30">
                        <div class="row">
                            <div class="col-12">
                                <div id="accordion" role="tablist">
                                    <!-- Single Faq -->
                                    @if (!empty($faqs) && count($faqs))
                                        @foreach ($faqs as $key => $faq)
                                            <div class="single-faq">
                                                <div class="faq-heading" role="tab" id="{{ "faq_$key" }}">
                                                    <h4 class="faq-title">
                                                        <a data-toggle="collapse" href="{{ "#collapse_$key" }}"
                                                            aria-expanded="true" aria-controls="{{ "collapse_$key" }}"
                                                            class="{{ $key == 0 ? '' : 'collapsed' }}">
                                                            <i class="fa fa-plus"></i>
                                                            <i class="fa fa-minus"></i>
                                                            {{ $faq->title }}
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="{{ "collapse_$key" }}"
                                                    class="{{ $key == 0 ? 'show' : '' }} collapse" role="tabpanel"
                                                    aria-labelledby="{{ "faq_$key" }}" data-parent="#accordion">
                                                    <div class="faq-body">
                                                        {!! $faq->description !!}
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="feature-btn"> <a href="{{ route('faqs') }}" class="homes-btn theme-1 btn-sm">View
                                More</a> </div>
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </section>
    <!--/ End Appointment and Faqs -->

    <!-- Latest New -->
    @if (!empty($news) && count($news))
    <section class="latest-blog news section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="section-title default text-center">
                        <div class="section-top">
                            <h2><span>Our News</span> <b>Latest News</b></h2>
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($news) && count($news))
                <div class="row">
                    <div class="col-12">
                        <div class="blog-latest blog-latest-slider">
                            @foreach ($news as $newsk)
                                <div class="single-slider">
                                    <!-- Single New -->
                                    <div class="single-news">
                                        <div class="news-head overlay">
                                            <figure>
                                                <img src="{{ asset('uploads/nne_image/' . $newsk->image) }}"/>
                                            </figure>
                                            {{-- <span class="news-img"
                                                style="background-image:url('{{ asset('uploads/blog_image/' . $newsk->image) }}')"></span> --}}
                                            <a href="{{route('news-details',"$newsk->slug-$newsk->id")}}"
                                                class="homes-btn theme-2">Read more <i class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                        <div class="news-body">
                                            <div class="news-content">
                                                <h3 class="news-title">
                                                    <a href="{{route('news-details',"$newsk->slug-$newsk->id")}}">{{ $newsk->title }}
                                                    </a>
                                                </h3>
                                                <div class="news-text">
                                                    <p>{{ Illuminate\Support\Str::limit(strip_tags($newsk->description), 200, '...') }}
                                                    </p>
                                                </div>
                                                <ul class="news-meta">
                                                    <li class="date"><i
                                                            class="fa fa-calendar"></i>{{ date('j F, Y', strtotime($newsk->postdatead)) }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Single News -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    @endif
    <!--/ End Latest News -->

    <!-- Latest blog -->
    <section class="latest-blog event section-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                    <div class="section-title default text-center">
                        <div class="section-top">
                            <h2><span>Our Blogs</span> <b>Latest Blogs</b></h2>
                        </div>
                    </div>
                </div>
            </div>
            @if (!empty($blogs) && count($blogs))
                <div class="row">
                    <div class="col-12">
                        <div class="blog-latest blog-latest-slider">
                            @foreach ($blogs as $blog)
                                <div class="single-slider">
                                    <!-- Single New -->
                                    <div class="single-news">
                                        <div class="news-head overlay">
                                            <figure>
                                                <img src="{{ asset('uploads/blog_image/' . $blog->image) }}"/>
                                            </figure>
                                            {{-- <span class="news-img"
                                                style="background-image:url('{{ asset('uploads/blog_image/' . $blog->image) }}')"></span> --}}
                                            <a href="{{ route('blog-details', "$blog->blog_slug-$blog->id") }}"
                                                class="homes-btn theme-2">Read more <i class="fa fa-long-arrow-right"></i> </a>
                                        </div>
                                        <div class="news-body">
                                            <div class="news-content">
                                                <h3 class="news-title">
                                                    <a href="{{ route('blog-details', "$blog->blog_slug-$blog->id") }}">{{ $blog->blog_title }}
                                                    </a>
                                                </h3>
                                                <div class="news-text">
                                                    <p>{{ Illuminate\Support\Str::limit(strip_tags($blog->content), 200, '...') }}
                                                    </p>
                                                </div>
                                                <ul class="news-meta">
                                                    <li class="date"><i
                                                            class="fa fa-calendar"></i>{{ date('j F, Y', strtotime($blog->postdatead)) }}
                                                    </li>
                                                    <li class="view" title="Total Views"><i
                                                            class="fa fa-eye"></i>{{ $blog->view_count ?: 0 }}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <!--/ End Single News -->
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </section>
    <!--/ End Latest blog -->

     <!-- Latest New -->
     @if (!empty($events) && count($events))
     <section class="latest-blog news section-space">
         <div class="container">
             <div class="row">
                 <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-12">
                     <div class="section-title default text-center">
                         <div class="section-top">
                             <h2><span>Our Events</span> <b>Latest Events</b></h2>
                         </div>
                     </div>
                 </div>
             </div>
             @if (!empty($events) && count($events))
                 <div class="row">
                     <div class="col-12">
                         <div class="blog-latest blog-latest-slider">
                             @foreach ($events as $eventk)
                                 <div class="single-slider">
                                     <!-- Single New -->
                                     <div class="single-news">
                                         <div class="news-head overlay">
                                             <figure>
                                                 <img src="{{ asset('uploads/nne_image/' . $eventk->image) }}"/>
                                             </figure>
                                             {{-- <span class="news-img"
                                                 style="background-image:url('{{ asset('uploads/blog_image/' . $eventk->image) }}')"></span> --}}
                                             <a href="{{route('event-details',"$eventk->slug-$eventk->id")}}"
                                                 class="homes-btn theme-2">Read more <i class="fa fa-long-arrow-right"></i> </a>
                                         </div>
                                         <div class="news-body">
                                             <div class="news-content">
                                                 <h3 class="news-title">
                                                     <a href="{{route('event-details',"$eventk->slug-$eventk->id")}}">{{ $eventk->title }}
                                                     </a>
                                                 </h3>
                                                 <div class="news-text">
                                                     <p>{{ Illuminate\Support\Str::limit(strip_tags($eventk->description), 200, '...') }}
                                                     </p>
                                                 </div>
                                                 <ul class="news-meta">
                                                     <li class="date"><i
                                                             class="fa fa-calendar"></i>{{ date('j F, Y', strtotime($eventk->postdatead)) }}
                                                     </li>
                                                 </ul>
                                             </div>
                                         </div>
                                     </div>
                                     <!--/ End Single News -->
                                 </div>
                             @endforeach
                         </div>
                     </div>
                 </div>
             @endif
         </div>
     </section>
     @endif
     <!--/ End Latest News -->

    <!-- Testimonials -->
    @if ($testimonials)
        <section class="testimonials section-space"
            style="background-image:url('{{ asset('frontend/img/testimonial-bg.jpg') }}')">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-9 col-12">
                        <div class="section-title default text-left">
                            <div class="section-top">
                                <h1><b>Our Success Stories</b></h1>
                            </div>
                            <div class="section-bottom">
                                <div class="text">
                                    <p>Some of our great Students and their review</p>
                                </div>
                            </div>
                        </div>
                        <div class="testimonial-inner">
                            <div class="testimonial-slider">
                                @foreach ($testimonials as $testimonial)
                                    <!-- Single Testimonial -->
                                    <div class="single-slider">
                                        {!! $testimonial->description !!}
                                        <!-- Client Info -->
                                        <div class="t-info">
                                            <div class="t-left">
                                                <div class="client-head"> <img
                                                        src="{{ asset("uploads/testimonial_image/$testimonial->image") }}"
                                                        alt="{{ $testimonial->name }}"> </div>
                                                <h2>{{ $testimonial->name }} <span> {{ $testimonial->designation }}
                                                    </span></h2>
                                            </div>
                                            <div class="t-right">
                                                <div class="quote"><i class="fa fa-quote-right"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- / End Single Testimonial -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!--/ End Testimonials -->
    @endif
    @if(!empty($advertisement))     
    <div id="myModal2" class="modal fade main-modal" role="dialog">
      
        <div class="modal-dialog modal-lg">
         
          <!-- Modal content-->
          <div class="modal-content">
            <div class="modal-header">
              <span>{{!empty($advertisement[0]->title)?$advertisement[0]->title:''}} </span>
              <button type="button" class="close" data-dismiss="modal"><i class="fa fa-times"></i> Skip This</button>
            </div>
            <div class="modal-body">
                <figure>
                  <img src="{{ URL::asset('uploads/advertisement/' . $advertisement[0]->adv_image) }}" alt="Image" class="img-responsive" />
                </figure>
            </div>
          </div>
         
        </div>
       
      </div>
    @endif
@endsection
