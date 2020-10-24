wow = new WOW(
	{
		boxClass:     'wow',      // default
		animateClass: 'animated', // default
		offset:       0,          // default
		mobile:       true,       // default
		live:         true        // default
	}
);
wow.init();

$(function(){	
		$(".owl-clients").owlCarousel({
			loop:true,
			margin:55,
			dots:false,
			autoWidth:true,
			lazyLoad:true,
			lazyLoadEager:1,
			autoplay:true,
			autoplayTimeout:2000,
			autoplayHoverPause:true,
			responsiveClass:true,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:3
				},
				1000:{
					items:6
				}
			}
		});
	
	
	$('.localscroll').localScroll({
		//target: '.xlocalscroll', // could be a selector or a jQuery object too.
		queue:true,
		duration:1000,
		lazy: true,
		//filter:'.scroll-link',
		//hash:true,
		onBefore:function( e, anchor, $target ){
			// The 'this' is the settings object, can be modified
		},
		onAfter:function( anchor, settings ){
			// The 'this' contains the scrolled element (#content)
		},
		offset: {top:-135}
	});
	
	var duration = 500; 
    $(window).scroll(function() {
		var $this = $(this);
		if ($this.scrollTop() > 220) {
			//alert('OK'); 
			$('.back-to-top').fadeIn(duration);
			$('.header').addClass('bg-header');
		} else {
			$('.back-to-top').fadeOut(duration);
			$('.header').removeClass('bg-header');
		}

	});
	
	$('.back-to-top').click(function(ev){
		ev.preventDefault();
		$('html, body').animate({scrollTop: 0}, duration);
		return false;
	});
});