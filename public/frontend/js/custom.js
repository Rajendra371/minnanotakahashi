(function($) {
  "use strict";
  $(document).on("ready", function() {
    /*====================================
			Header Sticky JS
		======================================*/

    jQuery(window).on("scroll", function() {
      if ($(this).scrollTop() > 100) {
        $(".header").addClass("sticky");
      } else {
        $(".header").removeClass("sticky");
      }
    });

    /*====================================
			Team JS
		======================================*/

    $(".single-team").on("click", function() {
      $(this).toggleClass("active");
    });

    /*====================================
			home JS
		======================================*/

    $(".home-slider").owlCarousel({
      items: 1,
      autoplay: false,
      autoplayTimeout: 5000,
      smartSpeed: 400,
      autoplayHoverPause: true,
      loop: true,
      merge: true,
      nav: true,
      dots: false,
      navText: [
        '<i class="fa fa-angle-left"></i>',
        '<i class="fa fa-angle-right"></i>',
      ],
    });

    $(".service-slider").owlCarousel({
      items: 3,
      margin: 30,
      autoplay: true,
      autoplayTimeout: 5000,
      smartSpeed: 900,
      autoplayHoverPause: false,
      loop: true,
      merge: true,
      nav: false,
      dots: true,
      responsive: {
        300: {
          items: 1,
        },
        480: {
          items: 1,
        },
        768: {
          items: 2,
        },
        1170: {
          items: 3,
        },
      },
    });

    $(".destination-slider").owlCarousel({
      items: 4,
      margin: 30,
      autoplay: true,
      autoplayTimeout: 5000,
      smartSpeed: 900,
      autoplayHoverPause: false,
      loop: true,
      merge: true,
      nav: false,
      dots: true,
      responsive: {
        360: {
          items: 1,
        },
        480: {
          items: 2,
        },
        768: {
          items: 3,
        },
        1170: {
          items: 4,
        },
      },
    });


      $(document).ready(function(){
        $('[data-toggle="tooltip"]').tooltip();
      });


    /*====================================
			Portfolio Details JS
		======================================*/

    $(".pf-details-slider").owlCarousel({
      items: 1,
      autoplay: false,
      autoplayTimeout: 5000,
      smartSpeed: 400,
      autoplayHoverPause: true,
      loop: true,
      merge: true,
      nav: true,
      dots: false,
      navText: [
        '<i class="fa fa-angle-left"></i>',
        '<i class="fa fa-angle-right"></i>',
      ],
    });

    /*====================================
			Portfolio Details JS
		======================================*/

    $(".testimonial-slider").owlCarousel({
      items: 1,
      autoplay: false,
      autoplayTimeout: 5000,
      smartSpeed: 400,
      autoplayHoverPause: true,
      loop: true,
      merge: true,
      nav: false,
      dots: true,
    });

    /*====================================
			Portfolio Details JS
		======================================*/

    $(".team-slider").owlCarousel({
      items: 3,
      autoplay: false,
      autoplayTimeout: 5000,
      smartSpeed: 400,
      autoplayHoverPause: true,
      loop: true,
      merge: true,
      nav: false,
      dots: true,
      responsive: {
        300: {
          items: 1,
        },
        480: {
          items: 1,
        },
        768: {
          items: 2,
        },
        1170: {
          items: 3,
        },
      },
    });

    /*====================================
			Portfolio Details JS
		======================================*/

    $(".blog-latest-slider").owlCarousel({
      items: 3,
      autoplay: false,
      autoplayTimeout: 5000,
      smartSpeed: 400,
      autoplayHoverPause: true,
      loop: true,
      merge: true,
      nav: true,
      navText: [
        '<i class="fa fa-angle-left"></i>',
        '<i class="fa fa-angle-right"></i>',
      ],
      dots: false,
      responsive: {
        300: {
          items: 1,
        },
        480: {
          items: 1,
        },
        768: {
          items: 2,
        },
        992: {
          items: 2,
        },
        1199: {
          items: 3,
        },
      },
    });
    /*====================================
			Portfolio Details JS
		======================================*/

    $(".partner-slider").owlCarousel({
      items: 6,
      autoplay: false,
      autoplayTimeout: 5000,
      smartSpeed: 400,
      margin: 30,
      autoplayHoverPause: true,
      loop: true,
      merge: true,
      nav: true,
      navText: [
        '<i class="fa fa-angle-left"></i>',
        '<i class="fa fa-angle-right"></i>',
      ],
      dots: false,
      responsive: {
        300: {
          items: 2,
          nav: false,
        },
        480: {
          items: 3,
          nav: false,
        },
        768: {
          items: 4,
          nav: false,
        },
        1170: {
          items: 6,
        },
      },
    });

    /*=====================================
			Video Popup
		======================================*/

    $(".video-popup").magnificPopup({
      type: "iframe",
      removalDelay: 300,
      mainClass: "mfp-fade",
    });
  });

  /*====================================
			Scrool Up JS
		======================================*/

  $.scrollUp({
    scrollName: "scrollUp", // Element ID
    scrollDistance: 300, // Distance from top/bottom before showing element (px)
    scrollFrom: "top", // 'top' or 'bottom'
    scrollSpeed: 1000, // Speed back to top (ms)
    animationSpeed: 200, // Animation speed (ms)
    scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
    scrollTarget: false, // Set a custom target element for scrolling to. Can be element or number
    scrollText: ["<i class='fa fa-angle-up'></i>"], // Text for element, can contain HTML
    scrollTitle: false, // Set a custom <a> title if required.
    scrollImg: false, // Set true to use image
    activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
    zIndex: 2147483647, // Z-Index for the overlay
  });

  /*====================================
			Preloader JS
		======================================*/
  jQuery(window).load(function() {
    jQuery(".preeloader").fadeOut("slow", function() {
      jQuery(this).remove();
    });
  });

  $(document).off("click", ".save");
  $(document).on("click", ".save", function(e) {
    e.preventDefault();
    const button = $(this);
    this.disabled = true;
    var formid = $(this)
      .closest("form")
      .attr("id");
    var action = $("#" + formid).attr("action");
    var data = new FormData($("form#" + formid)[0]);

    axios
      .post(action, data)
      .then((response) => {
        var msg = response.data.message;
        if (response.data.status == "success") {
          $("#" + formid)
            .find(".form-messages")
            .html(msg);
          $("#" + formid)
            .find(".form-messages")
            .addClass("alert alert-success");
          setTimeout(() => {
            $(`#${formid}`).trigger("reset");
          }, 200);
        } else {
          if (!Array.isArray(msg)) {
            msg = [msg];
          }
          var errmsg = "";
          $.each(msg, function(key, value) {
            errmsg += "<li>" + value + "</li>";
          });
          $("#" + formid)
            .find(".form-messages")
            .html(errmsg);
          $("#" + formid)
            .find(".form-messages")
            .addClass("alert alert-danger");
        }
        setTimeout(function() {
          button.prop("disabled", false);
          $("#" + formid)
            .find(".form-messages")
            .html("");
          $("#" + formid)
            .find(".form-messages")
            .removeClass("alert alert-success alert-danger");
          if (response.data.redirect) {
            window.location.href = response.data.redirect;
          }
        }, 4500);
      })
      .catch((error) => {
        this.disabled = false;
        $("#" + formid)
          .find(".error")
          .html("Error: System error please refresh the browser");
        $("#" + formid)
          .find(".error")
          .addClass("alert alert-danger");
        console.log(error);
      });
  });
})(jQuery);
