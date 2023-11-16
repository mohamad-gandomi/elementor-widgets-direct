class Ticker extends elementorModules.frontend.handlers.Base {
    bindEvents() {
        const TICKER = new Swiper('.ticker__carousel', {
            loop: true,
            spaceBetween: 20,
            preventClicks: true,
            autoplay: {
                delay: 5,
                disableOnInteraction: false
            },
            slidesPerView: 'auto',
            speed: 15000,
            grabCursor: true,
        });
    }
}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Ticker, {
            $element,
        });
    };
    elementorFrontend.hooks.addAction('frontend/element_ready/Ticker.default', addHandler);
});
