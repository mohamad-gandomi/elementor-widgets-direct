class Product_Form extends elementorModules.frontend.handlers.Base {

    bindEvents() {

        jQuery(document).ready(function ($) {
            // Initially show slider0
            $('.slider0').show();
            $('.slider1').hide();

            // Click event for slider0 button
            $('#slider0').on('click', function () {
                $(this).addClass('selected')
                $('.slider0').show();
                $('.slider1').hide();
                $('#slider1').removeClass('selected');
            });

            // Click event for slider1 button
            $('#slider1').on('click', function () {
                $(this).addClass('selected')
                $('.slider1').show();
                $('.slider0').hide();
                $('#slider0').removeClass('selected');
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
        });

        class Slider {
            constructor(containerClassName) {
                this.slideIndex = 1;
                this.container = document.querySelector(`.${containerClassName}`);
                this.slides = this.container.getElementsByClassName("mySlides");
                this.showSlides(this.slideIndex);

                // this.container.addEventListener('wheel', (event) => {
                //     event.preventDefault();
                //     if (event.deltaY < 0) {
                //         this.plusSlides(-1);
                //     } else {
                //         this.plusSlides(1);
                //     }
                // });

                this.isDragging = false;
                this.startPosition = 0;
                this.pixelsToChangeSlide = 10;

                this.container.addEventListener('mousedown', (e) => {
                    this.isDragging = true;
                    this.startPosition = e.clientX;
                });

                this.container.addEventListener('mousemove', (e) => {
                    if (!this.isDragging) return;

                    const currentPosition = e.clientX;
                    const difference = currentPosition - this.startPosition;
                    const slidesToChange = Math.floor(difference / this.pixelsToChangeSlide);

                    if (slidesToChange !== 0) {
                        this.plusSlides(slidesToChange);
                        this.startPosition = currentPosition;
                    }
                });

                this.container.addEventListener('mouseup', () => {
                    this.isDragging = false;
                });

                this.container.addEventListener('mouseleave', () => {
                    this.isDragging = false;
                });

                this.container.addEventListener('touchstart', (e) => {
                    this.isDragging = true;
                    this.startPosition = e.touches[0].clientX;
                    e.preventDefault();
                });

                this.container.addEventListener('touchmove', (e) => {
                    if (!this.isDragging) return;

                    const currentPosition = e.touches[0].clientX;
                    const difference = currentPosition - this.startPosition;
                    const slidesToChange = Math.floor(difference / this.pixelsToChangeSlide);

                    if (slidesToChange !== 0) {
                        this.plusSlides(slidesToChange);
                        this.startPosition = currentPosition;
                    }
                    e.preventDefault();
                });

                this.container.addEventListener('touchend', () => {
                    this.isDragging = false;
                });
            }

            plusSlides(n) {
                this.showSlides(this.slideIndex += n);
            }

            currentSlide(n) {
                this.showSlides(this.slideIndex = n);
            }

            showSlides(n) {
                let i;
                if (n > this.slides.length) { this.slideIndex = 1; }
                if (n < 1) { this.slideIndex = this.slides.length; }
                for (i = 0; i < this.slides.length; i++) {
                    this.slides[i].style.display = "none";
                }
                this.slides[this.slideIndex - 1].style.display = "block";
            }
        }

        if ($('.slideshow-container').length) {
            const slider1 = new Slider('slider0');
            const slider2 = new Slider('slider1');
        }

        var stickySection = $('.product_form_sticky');
        var scrollOffset = 500; // Set the scroll offset to 800 pixels

        $(window).scroll(function () {
            var scrollPos = $(window).scrollTop();

            if (scrollPos >= scrollOffset) {
                stickySection.addClass('sticky');
            } else {
                stickySection.removeClass('sticky');
            }
        });

        $('#product_add_to_cart_sticky').on('click', function () {
            $('#product_add_to_cart').click();
        })

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
