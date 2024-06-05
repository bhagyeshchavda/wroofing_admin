jQuery(document).ready(function ($) {

	// ----------------------
	// Video Model Popup
	// ----------------------
	$(".videobtn").on('click', function() {
        $("#bannervideomodel iframe").attr("src", $(this).attr("video-url"));
    });
    $('#bannervideomodel').on('hide.bs.modal', function (e) {
        $("#bannervideomodel iframe").attr("src", "");
    });

	// ----------------------
	// Desktop Hamburger
	// ----------------------
	$('.hamburger-icon').on('click', function() {
		$('.open-sidebar').toggleClass('open');
		$('.sidebar-menu').toggleClass('open');
		$('body').toggleClass('modal-open');
	});
	$('.sidebar-closed').on('click', function() {
		$('.open-sidebar').toggleClass('open');
		$('.sidebar-menu').toggleClass('open');
		$('body').toggleClass('modal-open');
	});

	// ----------------------
	// Membership Slider
	// ----------------------
	$('.membership-slider').owlCarousel({
		autoPlay: false,
	    loop:true,
	    dotsEach:true,
	    nav:true,
	    margin: 40,
	    navText: ["<img src='public/frontend-assets/images/slider-arrow.svg' alt='Arrow'>", "<img src='public/frontend-assets/images/slider-arrow.svg' alt='Arrow'>"],
	    dots:true,
	    responsive:{
	        0:{
	            items:1
	        },
	        768:{
	            items:2
	        },
	        1200:{
	            items:3
	        }
	    }
	});

	// ----------------------
	// Testimonial Slider
	// ----------------------
	$('.testimonial-slider').owlCarousel({
		autoPlay: false,
	 	center: true,
	    items:2,
	    nav:true,
	    navText: ["<img src='frontend-assets/images/slider-arrow.svg' alt='Arrow'>", "<img src='frontend-assets/images/slider-arrow.svg' alt='Arrow'>"],
	    loop:true,
	    margin:20,
	    dots:false,
	    responsive:{
	    	0:{
	            items:1,
	            center: false,
	        },
	        768:{
	            items:2,
	            center: true,
	        },
	    }
	});

	// ----------------------
	// Footer Mobile
	// ----------------------
	$(".footer-menu-item .footerlinks_toggle").on('click', function() {
        selfix = this;
        if ($(selfix).attr('aria-expanded') != 'true') {
            $('.footer-menu-item .footerlinks_toggle').removeClass('openfooter');
            $(".footer-menu-item .footerlinks_toggle").not($(selfix)).attr('aria-expanded', 'false');
            $(selfix).attr('aria-expanded', 'true');
            $(this).addClass('openfooter');
            drawer = $("#" + $(selfix).attr('aria-controls'));
            $('.footermenu-wrap').not(drawer).slideUp().promise().done(function() {
                $(this).removeAttr('aria-hidden');
                $(this).css('display', '');
            });
            drawer.slideDown().promise().done(function() {
                $(this).attr('aria-hidden', 'false');
                $(this).css('display', '');
            });
        } else {
            $(this).removeClass('openfooter');
            $(selfix).attr('aria-expanded', 'false');
            $('.footermenu-wrap').slideUp().promise().done(function() {
                $(this).removeAttr('aria-hidden');
                $(this).css('display', '');
            });
        }
    });

    // ----------------------
	// Workshop Tabs
	// ----------------------
	$(".tab_content").hide();
    $(".tab_content:first").show();

    $("ul.tabs li").click(function() {
      $(".tab_content").hide();
      var activeTab = $(this).attr("rel"); 
      $("#"+activeTab).fadeIn();		
      $("ul.tabs li").removeClass("active");
      $(this).addClass("active");
    });

    $(".tab_drawer_heading").click(function() {
      $(".tab_content").hide();
      var d_activeTab = $(this).attr("rel"); 
      $("#"+d_activeTab).fadeIn();
	  $(".tab_drawer_heading").removeClass("d_active");
      $(this).addClass("d_active");
	  $("ul.tabs li").removeClass("active");
	  $("ul.tabs li[rel^='"+d_activeTab+"']").addClass("active");
    });

});

$(window).scroll(function() {    
    var scroll = $(window).scrollTop();
    if (scroll >= 200) {
        $(".header-section").addClass("scrolled");
    } else {
        $(".header-section").removeClass("scrolled");
    }
});