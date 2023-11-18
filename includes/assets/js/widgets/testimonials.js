class Testimonials extends elementorModules.frontend.handlers.Base {
    bindEvents() {
        const customerTestimonialsCarousel = new Swiper('.customer-testimonials-carousel', {
            slidesPerView: 1,
            spaceBetween: 20,
            preventClicks: true,
            speed: 800,
            autoplay: {
                delay: 3000,
            },
            breakpoints: {
                1300: {
                    slidesPerView: 4,
                },
                // when window width is >= 768px
                768: {
                    slidesPerView: 2,
                },
            }
        });

    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Testimonials, {
            $element,
        });
    };
    elementorFrontend.hooks.addAction('frontend/element_ready/Testimonials.default', addHandler);
});
