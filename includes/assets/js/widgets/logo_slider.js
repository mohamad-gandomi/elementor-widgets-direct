class Logo_Slider extends elementorModules.frontend.handlers.Base {

    bindEvents() {

        const customerLogoCarousel = new Swiper('.customer-logo-carousel', {
            slidesPerView: "auto",
            spaceBetween: 20,
            preventClicks: true,
            speed: 800,
            autoplay: {
                delay: 1500,
            },
        });

    }


}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Logo_Slider, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/Logo_Slider.default', addHandler);

});
