class Testimonials extends elementorModules.frontend.handlers.Base {
    bindEvents() {
        const customerTestimonialsCarousel = new Swiper('.customer-testimonials-carousel', {
            slidesPerView: "auto",
            spaceBetween: 20,
            preventClicks: true,
            speed: 800,
            autoplay: {
                delay: 3000,
            },
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
