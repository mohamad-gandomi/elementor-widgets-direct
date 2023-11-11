class RecomendedHotels extends elementorModules.frontend.handlers.Base {
	bindEvents() {
    (function($) {

      //console.log('init...');
      var btns = $('.mplistfilter a');

      btns.on('click', function(e){

        e.preventDefault();
        btns.removeClass('selected');
        $(this).addClass('selected');

        var filter = $(this).attr('data-filter');

		if (filter == 'All') {

			$('.mplistscontents .mplist').show();

		} else {

			$('.mplistscontents .mplist').hide();
			console.log($('.mplist .ctacontainer'))
			$('.mplists .ctacontainer').hide();
			$('.ctacontainer.' + filter ).show();
			$('.mplistscontents .' + filter ).show();

		}

      });

    })(jQuery);
	}
}

jQuery( window ).on( 'elementor/frontend/init', () => {
 const addHandler = ( $element ) => {
     elementorFrontend.elementsHandler.addHandler( RecomendedHotels, {
         $element,
     } );
 };

 elementorFrontend.hooks.addAction( 'frontend/element_ready/recomended_hotels.default', addHandler );

} );
    