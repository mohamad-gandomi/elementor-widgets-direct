class Video_Slider extends elementorModules.frontend.handlers.Base {

    bindEvents() {

        const videoCarousel = new Swiper('.video-carousel', {
            slidesPerView: 1,
            spaceBetween: 20,
            preventClicks: true,
            speed: 800,
            autoplay: {
                delay: 3000,
            },
            breakpoints: {
                1200: {
                    slidesPerView: 4,
                },
                // when window width is >= 768px
                768: {
                    slidesPerView: 3,
                },
            }
        });

    }


}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Video_Slider, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/Video_Slider.default', addHandler);

});
