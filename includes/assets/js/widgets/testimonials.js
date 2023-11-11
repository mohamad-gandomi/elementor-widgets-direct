class Testimonials extends elementorModules.frontend.handlers.Base {
  
	bindEvents() {

	(function($) {
		
		$(document).ready(function(){
			var rev = $('.rev_slider');
			rev.on('init', function(event, slick, currentSlide) {
			var
				cur = $(slick.$slides[slick.currentSlide]),
				next = cur.next(),
				prev = cur.prev();
			prev.addClass('slick-sprev');
			next.addClass('slick-snext');
			cur.removeClass('slick-snext').removeClass('slick-sprev');
			slick.$prev = prev;
			slick.$next = next;
			}).on('beforeChange', function(event, slick, currentSlide, nextSlide) {
			//console.log('beforeChange');
			var
				cur = $(slick.$slides[nextSlide]);
			//console.log(slick.$prev, slick.$next);
			slick.$prev.removeClass('slick-sprev');
			slick.$next.removeClass('slick-snext');
			var
				next = cur.next(),
				prev = cur.prev();
			prev.prev();
			prev.next();
			prev.addClass('slick-sprev');
			next.addClass('slick-snext');
			slick.$prev = prev;
			slick.$next = next;
			cur.removeClass('slick-next').removeClass('slick-sprev');
			});
			
			rev.slick({
			speed: 1000,
			arrows: false,
			dots: true,
			focusOnSelect: true,
			//prevArrow: '<button> prev</button>',
			//nextArrow: '<button> next</button>',
			infinite: true,
			centerMode: true,
			slidesPerRow: 1,
			slidesToShow: 1,
			slidesToScroll: 1,
			centerPadding: '0',
			swipe: true,
			customPaging: function(slider, i) {
				return '';
			},
			infinite: true,
			});
		});
		
		
	})( jQuery );

	}


}

jQuery( window ).on( 'elementor/frontend/init', () => {
 const addHandler = ( $element ) => {
     elementorFrontend.elementsHandler.addHandler( Testimonials, {
         $element,
     } );
 };

 elementorFrontend.hooks.addAction( 'frontend/element_ready/Testimonial.default', addHandler );

} );
    