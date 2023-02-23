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
                            <li>Gallery Album</li>
                        </ul>
                    </div>
                    <!-- Bread Title -->
                    <div class="bread-title"><h2>Our Album</h2></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->

@if(!empty($categories) && count($categories))
<section class="services section-bg section-space">
    <div class="container">
        <div id="gallery" class="gallery-album">
              <div class="row">
                @foreach ($categories as $category)
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 image">
                  <div class="img-wrapper">
                    <a href="{{route('gallery-details',$category->id)}}"><img src="{{asset('uploads/gallery_image/'.$category->image_file)}}" alt="" /></a>
                    <div class="caption">
                      <h6><a href="{{route('gallery-details',$category->id)}}">{{$category->title}}</a></h6>
                       <span> <b>Total:</b> {{ $category->image_count ?: 0 }} Images</span> 
                    </div> 
                  </div>
                </div>
                @endforeach
                {{-- <div class="col-lg-4 col-md-6 col-sm-6 col-12 image">
                  <div class="img-wrapper">
                    <a href="gallery-details.html"><img src="{{asset('frontend/img/portfolio-6.jpg')}}" alt="" /></a>
                    <div class="caption">
                        <h6><a href="gallery-details.html">Social & Community Supports Programme</a></h6>
                        <span>Monday, August 26, 2021</span> <span> <b>Total:</b> 9 Images</span> 
                    </div>

                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 image">
                  <div class="img-wrapper">
                    <a href="gallery-details.html"><img src="{{asset('frontend/img/portfolio-5.jpg')}}" alt="" /></a>
                    <div class="caption">
                        <h6><a href="gallery-details.html">Gifted Hands Supports Programme</a></h6>
                        <span>Saturday, September 18, 2021</span> <span> <b>Total:</b> 24 Images</span> 
                    </div>

                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 image">
                  <div class="img-wrapper">
                    <a href="gallery-details.html"><img src="{{asset('frontend/img/portfolio-7.jpg')}}" alt="" /></a>
                    <div class="caption">
                        <h6><a href="gallery-details.html">Family Health Care Programme</a></h6>
                        <span>Sunaday, June 20, 2021</span> <span><b>Total:</b> 15 Images</span> 
                    </div>

                  </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 image">
                  <div class="img-wrapper">
                    <a href="gallery-details.html"><img src="{{asset('frontend/img/portfolio-2.jpg')}}" alt="" /></a>
                    <div class="caption">
                        <h6><a href="gallery-details.html">Nursing Care Programme</a></h6>
                        <span>Thursday, July 14, 2021</span> <span>
                            <b>Total:</b> 12 Images</span> 
                    </div>

                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 image">
                  <div class="img-wrapper">
                    <a href="gallery-details.html"><img src="{{asset('frontend/img/portfolio-8.jpg')}}" alt="" /></a>
                    <div class="caption">
                        <h6><a href="gallery-details.html">Nursing Care Programme</a></h6>
                        <span>Thursday, July 14, 2021</span> <span> <b>Total:</b> 12</span> 
                    </div>

                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 image">
                  <div class="img-wrapper">
                    <a href="gallery-details.html"><img src="{{asset('frontend/img/portfolio-3.jpg')}}" alt="" /></a>
                    <div class="caption">
                        <h6><a href="gallery-details.html">Nursing Care Programme</a></h6>
                        <span>Thursday, July 14, 2021</span> <span> <b>Total:</b> 12</span> 
                    </div>

                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 image">
                  <div class="img-wrapper">
                    <a href="gallery-details.html"><img src="{{asset('frontend/img/portfolio-7.jpg')}}" alt="" /></a>
                    <div class="caption">
                        <h6><a href="gallery-details.html">Nursing Care Programme</a></h6>
                        <span>Thursday, July 14, 2021</span> <span> <b>Total:</b> 12</span> 
                    </div>

                  </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 image">
                  <div class="img-wrapper">
                    <a href="gallery-details.html"><img src="{{asset('frontend/img/portfolio-4.jpg')}}" alt="" /></a>
                    <div class="caption">
                        <h6><a href="gallery-details.html">Write Your Gallery Album Name Here</a></h6>
                        <span>Thursday, July 14, 2021</span> <span> <b>Total:</b> 12</span> 
                    </div>

                  </div>
                </div>  --}}
              </div><!-- End row -->
        </div>

        
        {{-- <div class="row">
            <div class="col-12">
                <!-- Pagination -->
                <div class="pagination-plugin">
                    <ul class="pagination-list text-center">
                        <li class="prev"><a href="#">Prev</a></li>
                        <li class="page-numbers current"><a href="#">1</a></li>
                        <li class="page-numbers"><a href="#">2</a></li>
                        <li class="page-numbers"><a href="#">3</a></li>
                        <li class="next"><a href="#">Next</a></li>
                    </ul>
                </div>
                <!--/ End Pagination -->
            </div>
        </div> --}}
    </div>
</section>
@endif
@endsection