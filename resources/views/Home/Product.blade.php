@extends('Layout.Main')
@section('content')
<section class="breadcrumbs">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h2><i class="fa fa-pencil"></i>Our Product</h2>
				<ul>
					<li><a href="{{url('/')}}"><i class="fa fa-home"></i>Home</a></li>
					<li><a href="{{url('/product')}}"><i class="fa fa-clone"></i>Portfolio</a></li>
					<li class="active"><i class="fa fa-clone"></i>Our Products</li>
				</ul>
			</div>
		</div>
	</div>
</section>


<!-- Portfolio -->
<section id="portfolio" class="portfolio section">
  <div class="container">
    <div class="row">
      <div class="col-12"> 
        <!-- portfolio Nav -->
        <div class="portfolio-nav">
          <ul class="tr-list list-inline" id="portfolio-menu">
            @if(!empty($data['product_cat']))
            @foreach($data['product_cat'] as $key1=>$procat)
            <li data-filter=".{{$procat->id}}" class="cbp-filter-item @if($key1=='0') {{"active"}} @endif">
              {{!empty($procat->ourproduct_cat)?$procat->ourproduct_cat:''}}
              <div class="cbp-filter-counter"></div>
            </li>
            @endforeach
            @endif
            {{-- <li data-filter=".animation" class="cbp-filter-item">Web Application
              <div class="cbp-filter-counter"></div>
            </li>
            <li data-filter=".website" class="cbp-filter-item">Web Design
              <div class="cbp-filter-counter"></div>
            </li>
            <li data-filter=".package" class="cbp-filter-item">Mobile Application
              <div class="cbp-filter-counter"></div>
            </li>
            <li data-filter=".development" class="cbp-filter-item">Development
              <div class="cbp-filter-counter"></div>
            </li>
            <li data-filter=".printing" class="cbp-filter-item">Web Solutions
              <div class="cbp-filter-counter"></div>
            </li> --}}
          </ul>
        </div>
        <!--/ End portfolio Nav --> 
      </div>
    </div>
    <div class="portfolio-inner">
      <div class="row">
        <div class="col-12">
          <div id="portfolio-item"> 
            <!-- Single portfolio -->
            @if(!empty($data['product']))
            @foreach($data['product'] as $key2=>$prod)
            @php
              $productname=$prod->title;
              $pid=$prod->id;
              $compstr=$productname.' '.$pid;
              $product_slug= clean_url($compstr);
					  @endphp
            <div class="cbp-item {{$prod->product_catid}}">
              <div class="portfolio-single">
              @if(!empty($prod->image))
                <div class="portfolio-head"> <img src="{{ URL::asset('uploads/product_image/' .$prod->image) }}" alt="#"/> </div>
              @endif
                <div class="portfolio-hover">
                  <h4><a href="{{ url("/product_detail/{$product_slug}")}}">{{!empty($prod->title)?$prod->title:''}}</a></h4>
                  <p>{{!empty($prod->short_description)?$prod->short_description:''}}</p>
                  <div class="button">
                  	<a href="{{ url("/product_detail/{$product_slug}")}}"><i class="fa fa-link"></i> View Details </a> 
                  </div>
                </div>
              </div>
            </div>
            @endforeach
            @endif
            <!--/ End portfolio --> 
            <!-- Single portfolio -->
            {{-- <div class="cbp-item website package development">
              <div class="portfolio-single">
                <div class="portfolio-head"> <img src="public/frontend/images/portfolio/p2.jpg" alt="#"/> </div>
                <div class="portfolio-hover">
                  <h4><a href="{{url('/product_detail')}}">Responsive Design</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim</p>
                  <div class="button">
                  	<a href="{{url('/product_detail')}}"><i class="fa fa-link"></i> View Details </a> 
                  </div>
                </div>
              </div>
            </div> --}}
            <!--/ End portfolio --> 
            <!-- Single portfolio -->
            {{-- <div class="cbp-item website animation">
              <div class="portfolio-single">
                <div class="portfolio-head"> <img src="public/frontend/images/portfolio/p3.jpg" alt="#"/> </div>
                <div class="portfolio-hover">
                  <h4><a href="{{url('/product_detail')}}">Bootstrap Based</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim</p>
                  <div class="button">
                  	<a href="{{url('/product_detail')}}"><i class="fa fa-link"></i> View Details </a> 
                  </div>
                </div>
              </div>
            </div> --}}
            <!--/ End portfolio --> 
            <!-- Single portfolio -->
            {{-- <div class="cbp-item development printing">
              <div class="portfolio-single">
                <div class="portfolio-head"> <img src="public/frontend/images/portfolio/p4.jpg" alt="#"/> </div>
                <div class="portfolio-hover">
                  <h4><a href="{{url('/product_detail')}}">Clean Design</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim</p>
                  <div class="button">
                  	<a href="{{url('/product_detail')}}"><i class="fa fa-link"></i> View Details </a> 
                  </div>
                </div>
              </div>
            </div> --}}
            <!--/ End portfolio --> 
            <!-- Single portfolio -->
            {{-- <div class="cbp-item development package">
              <div class="portfolio-single">
                <div class="portfolio-head"> <img src="public/frontend/images/portfolio/p5.jpg" alt="#"/> </div>
                <div class="portfolio-hover">
                  <h4><a href="{{url('/product_detail')}}">Animation</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim</p>
                  <div class="button">
                  	<a href="{{url('/product_detail')}}"><i class="fa fa-link"></i> View Details </a> 
                  </div>
                </div>
              </div>
            </div> --}}
            <!--/ End portfolio --> 
            <!-- Single portfolio -->
            {{-- <div class="cbp-item website animation printing">
              <div class="portfolio-single">
                <div class="portfolio-head"> <img src="public/frontend/images/portfolio/p6.jpg" alt="#"/> </div>
                <div class="portfolio-hover">
                  <h4><a href="{{url('/product_detail')}}">Parallax</a></h4>
                  <p>Maecenas sapien erat, porta non porttitor non, dignissim et enim. Aenean ac enim</p>
                  <div class="button">
                  	<a href="{{url('/product_detail')}}"><i class="fa fa-link"></i> View Details </a> 
                  </div>
                </div>
              </div>
            </div> --}}
            <!--/ End portfolio --> 
          </div>
          <br/>
						<!-- Start Pagination -->
						{{-- <div class="pagination-main">
							<ul class="pagination">
								<li class="prev"><a href="#"><i class="fa fa-angle-double-left"></i></a></li>
								<li><a href="#">1</a></li>
								<li class="active"><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">4</a></li>
								<li><a href="#">5</a></li>
								<li class="next"><a href="#"><i class="fa fa-angle-double-right"></i></a></li>
							</ul>
						</div> --}}
						<!--/ End Pagination -->

        </div>
      </div>

    </div>
  </div>
</section>
<!--/ End portfolio --> 
@endsection


