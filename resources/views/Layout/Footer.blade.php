@php
  $dat = App\Http\Controllers\Api\Frontend\HomeController::header_footer();   
@endphp
<!-- Footer -->
<footer class="footer" style="background-image:url({{asset('frontend/img/map.png')}})"> 
    <!-- Footer Top -->
    <div class="footer-top">
      <div class="container"> 
        <div class="row">
          {{-- <div class="col-lg-12 col-md-12 col-12">
            <p>
              We acknowledge the traditional custodians of the land on which we live and work and pay our respect to Elders past, present and future.
              <span><img src="{{asset('uploads/aborginal-flag.png')}}" alt="Aborginal Flag" height="50px" width="50px" title="Aborginal Flag"></span>
              <span><img src="{{asset('uploads/torres-strait-islander.png')}}" alt="Torres Strait Islander Flag" height="50px" width="50px" title="Torres Strait Islander Flag"></span>
              <span><img src="{{asset('uploads/lgbtqia.jpg')}}" alt="LGBTQIA+ Flag" height="50px" width="50px" title="LGBTQIA+ Flag"></span>
            </p>
          </div> --}}
          <div class="col-lg-2 col-md-6 col-12"> 
              <!-- Footer Links -->
              <div class="single-widget f-link widget">
                <h3 class="widget-title">Company</h3>
                <ul>
                  @if(!empty($dat['useful_links']))
                    @foreach($dat['useful_links'] as $useful)
                      <li><a href="{{route("$useful->link_url")}}" target="_blank">{{!empty($useful->title)?$useful->title:''}}</a></li>
                    @endforeach
                  @endif
                </ul>
              </div>
              <!--/ End Footer Links --> 
          </div>
          <div class="col-lg-3 col-md-6 col-12"> 
            <!-- Footer Links -->
            <div class="single-widget f-link widget">
              <h3 class="widget-title">Services</h3>
              <ul>
                @if(!empty($services_menu))
                  @foreach($services_menu as $ser)
                    @if ($loop->iteration > 5)
                        @break
                    @endif
                    <li><a href="{{route('service-details',"$ser->slug-$ser->id")}}">{{$ser->service_name}}</a></li>
                  @endforeach
                @endif
              </ul>
            </div>
            <!--/ End Footer Links --> 
          </div>
          <div class="col-lg-4 col-md-6 col-12"> 
            <!-- Footer News -->
            <div class="single-widget footer-news widget">
              <h3 class="widget-title">Recent Blog</h3>
              <!-- Single News -->
              @if(!empty($dat['blog']))
                @foreach($dat['blog'] as $blg)
                  <div class="single-f-news">
                    <div class="post-thumb"> <a href="{{route('blog-details',"$blg->blog_slug-$blg->id")}}"> <img src="{{ URL::asset('uploads/blog_image/' . $blg->image) }}" alt="#"> </a> </div>
                    <div class="content">
                      <p class="post-meta">
                        <time class="post-date"><i class="fa fa-clock-o"></i>{{date('j F, Y', strtotime($blg->postdatead))}}</time>
                      </p>
                      <h4 class="title"><a href="{{route('blog-details',"$blg->blog_slug-$blg->id")}}">{{!empty($blg->blog_title)?$blg->blog_title:''}}</a></h4>
                    </div>
                  </div>
                @endforeach
              @endif
            </div>
            <!--/ End Footer News --> 
          </div>
          <div class="col-lg-3 col-md-6 col-12"> 
            <!-- Footer Contact -->
            <div class="single-widget footer_contact widget">
              <h3 class="widget-title">Contact</h3>
              <p>You can contact us at</p>
              <ul class="address-widget-list">
                @php
                  $contact = '';
                  if (!empty($dat['organization'][0])) {
                    $contact = ($dat['organization'][0]->phone ?? '').','.($dat['organization'][0]->mobile ?? '');
                  }
                  $phones = explode(",", $dat['organization'][0]->phone);
                @endphp
                @if(!empty($contact))
                  <li class="footer-mobile-number"><i class="fa fa-phone"></i><a href="tel:{{$phones[0]}}">{{$phones[0]}}</a>,<a href="tel:{{$phones[1]}}">{{$phones[1]}}</a>,<a href="tel:{{$dat['organization'][0]->mobile}}">{{$dat['organization'][0]->mobile}}</a>
                  </li>
                @endif
                @if(!empty($dat['organization'][0]->email))
                  <li class="footer-mobile-number"><i class="fa fa-envelope"></i><a href="mailto:{{$dat['organization'][0]->email}}">{{$dat['organization'][0]->email}}</a></li>
                @endif
                @if(!empty($dat['organization'][0]->address1))
                  <li class="footer-mobile-number"><i class="fa fa-map-marker"></i>{{$dat['organization'][0]->address1}}</li>
                @endif
              </ul>
            </div>
            <!--/ End Footer Contact --> 
          </div>
        </div>
      </div>
    </div>
    <!-- Copyright -->
    <div class="copyright">
      <div class="container">
        <div class="row">
          <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
              <div class="social"> 
                <!-- Social Icons -->
                <ul class="social-icons">
                  @if(!empty($dat['organization'][0]->facebook_link))
                    <li><a href="{{$dat['organization'][0]->facebook_link}}" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
                  @endif
                  @if(!empty($dat['organization'][0]->instagram_link))
                     <li><a href="{{$dat['organization'][0]->instagram_link}}" title="Instagram" target="_blank"><i class="fa fa-instagram"></i></a></li>
                  @endif
                  @if(!empty($dat['organization'][0]->linkedin_link))
                    <li><a href="{{$dat['organization'][0]->linkedin_link}}" title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>
                  @endif
                  @if(!empty($dat['organization'][0]->tiktok_link))		
                    <li>
                        <a href="{{$dat['organization'][0]->tiktok_link}}" title="TikTok" target="_blank">
                          <img src="{{ asset("uploads/tiktok-logo-4500.svg") }}" alt="TikTok icon" />
                      </a>
                    </li>
                  @endif
                  @if(!empty($dat['organization'][0]->youtube_link))
                    <li><a href="{{$dat['organization'][0]->youtube_link}}" title="YouTube" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
                  @endif
                </ul>
              </div>
          </div>
          <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
            <div class="copyright-content lext-left"> 
              <!-- Copyright Text -->
              <p>© Copyright <?php echo date("Y"); ?> <a href="{{route('home')}}"> {{$dat['organization'][0]->organization_name}} </a> Powered by <a href="https://globaliotnepal.com.np/" target="_blank">Global IOT Nepal</a></p>
            
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--/ End Copyright --> 
  </footer>

  {{-- <!-- Messenger Chat Plugin Code -->
  <div id="fb-root"></div>

  <!-- Your Chat Plugin code -->
  <div id="fb-customer-chat" class="fb-customerchat">
  </div> --}}

  <!-- Jquery JS --> 
  <script src="{{asset('frontend/js/jquery.min.js')}}"></script> 
  <script src="{{asset('frontend/js/jquery-migrate-3.0.0.js')}}"></script> 
  <!-- Popper JS --> 
  <script src="{{asset('frontend/js/popper.min.js')}}"></script> 
  <!-- Bootstrap JS --> 
  <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script> 
  <!-- ScrollUp JS --> 
  <script src="{{asset('frontend/js/scrollup.js')}}"></script> 
  <!-- Slick Slider JS --> 
  <script src="{{asset('frontend/js/owl-carousel.min.js')}}"></script> 
  <!-- Magnipic Popup JS --> 
  <script src="{{asset('frontend/js/magnific-popup.min.js')}}"></script> 
  {{-- Axios --}}
  <script src="{{asset('frontend/js/axios.min.js')}}"></script> 
  <script src="{{asset('frontend/js/axios_setup.js')}}"></script> 
  <!-- Active JS --> 
  <script src="{{asset('frontend/js/custom.js')}}"></script>

  {{-- Project Name: Global Eye Education Consultancy https://globaleye.edu.np/
	UI /UX  Developer: Bikash Bhandari
	Email: bikash.433@gmail.com
	URL: www.bhandaribikash.com.np
	Description: Global Eye Education Consultancy --}}

  {{-- <script>
    var chatbox = document.getElementById('fb-customer-chat');
    chatbox.setAttribute("page_id", "100672739031491");
    chatbox.setAttribute("attribution", "biz_inbox");
  </script>

  <!-- Your SDK code -->
  <script>
    window.fbAsyncInit = function() {
      FB.init({
        xfbml            : true,
        version          : 'v13.0'
      });
    };

    (function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_GB/sdk/xfbml.customerchat.js';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
  </script> --}}
 
  @yield('scripts') 
  @stack('script') 
  <!-- Messenger Chat Plugin Code -->
   <div id="fb-root"></div>

   <!-- Your Chat Plugin code -->
   <div id="fb-customer-chat" class="fb-customerchat">
   </div>
 
   <script>
     var chatbox = document.getElementById('fb-customer-chat');
     chatbox.setAttribute("page_id", "104862838917662");
     chatbox.setAttribute("attribution", "biz_inbox");
   </script>
 
   <!-- Your SDK code -->
   <script>
     window.fbAsyncInit = function() {
       FB.init({
         xfbml            : true,
         version          : 'v16.0'
       });
     };
 
     (function(d, s, id) {
       var js, fjs = d.getElementsByTagName(s)[0];
       if (d.getElementById(id)) return;
       js = d.createElement(s); js.id = id;
       js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js';
       fjs.parentNode.insertBefore(js, fjs);
     }(document, 'script', 'facebook-jssdk'));
   </script> 

  </body>
  </html>