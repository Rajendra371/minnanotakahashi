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
                                <a href="{{route('gallery')}}">Gallery</a>
                            </li>
                            <li>Photos</li>
                        </ul>
                    </div>
                    <!-- Bread Title -->
                    <div class="bread-title"><h2>Photos</h2></div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ End Breadcrumb -->
@if (!empty($photos) && count($photos))
<section class="services section-bg section-space">
    <div class="container">
        <div id="gallery" class="gallery-img">
            <div id="image-gallery">
              <div class="row">
                @foreach ($photos as $photo)      
                <div class="col-lg-4 col-md-6 col-sm-6 col-12 image">
                    <div class="img-wrapper">
                        <a href="{{asset('uploads/gallery_image/'.$photo->image_file)}}"><img src="{{asset('uploads/gallery_image/'.$photo->image_file)}}" alt="Image" /></a>
                        <div class="img-overlay">
                            <a href="javascript:void(0)"><i class="fa fa-plus-circle" aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach   
              </div><!-- End row -->
            </div><!-- End image gallery -->
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

@section('scripts')
<script type="text/javascript">
			
    // Galery Lightbox Code By: Bikash Bhandari (bikash.433@gmail.com)
    // Gallery image hover
    $( ".img-wrapper" ).hover(
      function() {
        $(this).find(".img-overlay").animate({opacity: 1}, 600);
      }, function() {
        $(this).find(".img-overlay").animate({opacity: 0}, 600);
      }
    );

    // Lightbox
    var $overlay = $('<div id="overlay"></div>');
    var $image = $("<img>");
    var $prevButton = $('<div id="prevButton"><i class="fa fa-chevron-left"></i></div>');
    var $nextButton = $('<div id="nextButton"><i class="fa fa-chevron-right"></i></div>');
    var $exitButton = $('<div id="exitButton"><i class="fa fa-times"></i></div>');

    // Add overlay
    $overlay.append($image).prepend($prevButton).append($nextButton).append($exitButton);
    $("#gallery").append($overlay);

    // Hide overlay on default
    $overlay.hide();

    // When an image is clicked
    $(".img-overlay").click(function(event) {
      // Prevents default behavior
      event.preventDefault();
      // Adds href attribute to variable
      var imageLocation = $(this).prev().attr("href");
      // Add the image src to $image
      $image.attr("src", imageLocation);
      // Fade in the overlay
      $overlay.fadeIn("slow");
    });

    // When the overlay is clicked
    $overlay.click(function() {
      // Fade out the overlay
      $(this).fadeOut("slow");
    });

    // When next button is clicked
    $nextButton.click(function(event) {
      // Hide the current image
      $("#overlay img").hide();
      // Overlay image location
      var $currentImgSrc = $("#overlay img").attr("src");
      // Image with matching location of the overlay image
      var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
      // Finds the next image
      var $nextImg = $($currentImg.closest(".image").next().find("img"));
      // All of the images in the gallery
      var $images = $("#image-gallery img");
      // If there is a next image
      if ($nextImg.length > 0) { 
        // Fade in the next image
        $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
      } else {
        // Otherwise fade in the first image
        $("#overlay img").attr("src", $($images[0]).attr("src")).fadeIn(800);
      }
      // Prevents overlay from being hidden
      event.stopPropagation();
    });

    // When previous button is clicked
    $prevButton.click(function(event) {
      // Hide the current image
      $("#overlay img").hide();
      // Overlay image location
      var $currentImgSrc = $("#overlay img").attr("src");
      // Image with matching location of the overlay image
      var $currentImg = $('#image-gallery img[src="' + $currentImgSrc + '"]');
      // Finds the next image
      var $nextImg = $($currentImg.closest(".image").prev().find("img"));
      // Fade in the next image
      $("#overlay img").attr("src", $nextImg.attr("src")).fadeIn(800);
      // Prevents overlay from being hidden
      event.stopPropagation();
    });

    // When the exit button is clicked
    $exitButton.click(function() {
      // Fade out the overlay
      $("#overlay").fadeOut("slow");
    });
 
</script>
@endsection