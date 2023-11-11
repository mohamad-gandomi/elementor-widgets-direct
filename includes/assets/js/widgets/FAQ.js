class WidgetHandlerClass extends elementorModules.frontend.handlers.Base {
  
  getDefaultSettings() {
      return {
          selectors: {
              question: '.faq-item .questoin',
              icon: '.faq-item .faq-icons',
              answer: '.answer',
              filterButton: '.faq-filter',
          },
      };
  }

  getDefaultElements() {
      const selectors = this.getSettings( 'selectors' );
      return {
          $question: this.$element.find( selectors.question ),
          $icon: this.$element.find( selectors.icon ),
          $answer: this.$element.find( selectors.answer ),
          $filterButton: this.$element.find( selectors.filterButton ),
      };
  }

  bindEvents() {
      this.elements.$question.on( 'click', this.onQuestionClick );
      this.elements.$icon.on( 'click', this.onIconClick );
      this.elements.$filterButton.on( 'click', this.onfilterButtonClick );

      var numSlick = 0;
      jQuery('.slider-faq').each( function() {
        numSlick++;
        jQuery(this).addClass( 'slider-' + numSlick ).slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          rtl: true,
          arrows: true,
          fade: true,
          asNavFor: '.slider-nav-faq.slider-' + numSlick
        });
      });
      
      numSlick = 0;
      jQuery('.slider-nav-faq').each( function() {
        numSlick++;
        jQuery(this).addClass( 'slider-' + numSlick ).slick({
          slidesToShow: 5,
          arrows: false,
          rtl: true,
          slidesToScroll: 1,
          centerMode: true,
          focusOnSelect: true,
          asNavFor: '.slider-faq.slider-' + numSlick,
        });
      });

  }

  onQuestionClick( event ) {
      event.preventDefault();

      jQuery( this ).parent().find('.answer').toggleClass('show');
      jQuery( this ).find('.fa-plus, .fa-minus').toggleClass('fa-plus fa-minus');
 }

 onIconClick( event ) {
      event.preventDefault();

      jQuery(this).parent().find('.answer').toggleClass('show');
}

onfilterButtonClick( event ) {
      event.preventDefault();

      var filter = jQuery(this).find('a').attr('class');
      jQuery('.faq-container').hide();
      jQuery('.faq-container.'+filter).show('slow');
}

}

jQuery( window ).on( 'elementor/frontend/init', () => {
 const addHandler = ( $element ) => {
     elementorFrontend.elementsHandler.addHandler( WidgetHandlerClass, {
         $element,
     } );
 };

 elementorFrontend.hooks.addAction( 'frontend/element_ready/FAQ.default', addHandler );
} );
    