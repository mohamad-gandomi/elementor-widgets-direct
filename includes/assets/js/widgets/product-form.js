class Product_Form extends elementorModules.frontend.handlers.Base {

    bindEvents() {

        jQuery(document).ready(function ($) {
            // Initially show slider0
            $('#slider0').show();
            $('#slider1').hide();

            // Click event for slider0 button
            $('#sliderBtn0').on('click', function () {
                $(this).addClass('selected')
                $('#slider0').show();
                $('#slider1').hide();
                $('#sliderBtn1').removeClass('selected');
            });

            // Click event for slider1 button
            $('#sliderBtn1').on('click', function () {
                $(this).addClass('selected')
                $('#slider1').show();
                $('#slider0').hide();
                $('#sliderBtn0').removeClass('selected');
            });

            $('.color-btn').on('click', function () {
                var colorTitle = $(this).data('title');
                $('#colorInput').val(colorTitle);
            });

            $('#product_add_to_cart').on('click', function (event) {
                if ($('.color-btn').length && !$('.color-btn').hasClass('selected')) {
                    event.preventDefault(); // Prevent form submission
                    alert('لطفا رنگ محصول را انتخاب کنید');
                    // Scroll to the first element with class color-btn
                    $('html, body').animate({
                        scrollTop: $('.color-btn:first').offset().top - 200
                    }, 'slow');
                }
            });

            var stickySection = $('.product_form_sticky');
            var scrollOffset = 500; // Set the scroll offset to 800 pixels

            $(window).scroll(function () {
                var scroll = $(window).scrollTop();

                //-----------------------------------------------------
                // Show Fixed Div after 800px Scroll
                //-----------------------------------------------------

                if (scroll > 500) {
                    $('#yourFixedDiv').addClass('show');
                } else {
                    $('#yourFixedDiv').removeClass('show');
                }
            });

            $('#product_add_to_cart_sticky').on('click', function () {
                $('#product_add_to_cart').click();
            })
        });

    }


}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Product_Form, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/Product_Form.default', addHandler);

});
