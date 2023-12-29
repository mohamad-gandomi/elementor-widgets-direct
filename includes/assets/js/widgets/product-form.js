class Product_Form extends elementorModules.frontend.handlers.Base {

    bindEvents() {

        let slideIndex = 1;
        showSlides(slideIndex);

        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            let i;
            let slides = document.getElementsByClassName("mySlides");

            if (n > slides.length) { slideIndex = 1 }
            if (n < 1) { slideIndex = slides.length }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slides[slideIndex - 1].style.display = "block";
        }

        // Add an event listener for the mouse wheel
        document.querySelector('.slideshow-container').addEventListener('wheel', function (event) {
            event.preventDefault();
            // Check if the mouse wheel scrolled up or down
            if (event.deltaY < 0) {
                plusSlides(-1); // Scroll up: Show previous slide
            } else {
                plusSlides(1); // Scroll down: Show next slide
            }
        });

        //======================================================================
        // JavaScript to Handle Continuous Slide Change on Drag
        //======================================================================

        let isDragging = false;
        let startPosition = 0;
        const pixelsToChangeSlide = 10; // Adjust this value to change sensitivity

        // Event listener for mouse down
        document.querySelector('.slideshow-container').addEventListener('mousedown', function (e) {
            isDragging = true;
            startPosition = e.clientX;
        });

        // Event listener for mouse move
        document.querySelector('.slideshow-container').addEventListener('mousemove', function (e) {
            if (!isDragging) return;

            const currentPosition = e.clientX;
            const difference = currentPosition - startPosition;
            const slidesToChange = Math.floor(difference / pixelsToChangeSlide);

            if (slidesToChange !== 0) {
                plusSlides(slidesToChange); // Change slides based on the drag distance
                startPosition = currentPosition; // Update start position for continuous dragging
            }
        });

        // Event listener for mouse up
        document.querySelector('.slideshow-container').addEventListener('mouseup', function () {
            isDragging = false;
        });

        // Event listener for mouse leave
        document.querySelector('.slideshow-container').addEventListener('mouseleave', function () {
            isDragging = false;
        });

        //======================================================================
        // JavaScript to Handle Continuous Slide Change on Drag (for Touch Devices)
        //======================================================================

        // Event listener for touch start
        document.querySelector('.slideshow-container').addEventListener('touchstart', function (e) {
            isDragging = true;
            startPosition = e.touches[0].clientX;
            startX = startPosition;
            e.preventDefault(); // Prevent default touch behavior
        });

        // Event listener for touch move
        document.querySelector('.slideshow-container').addEventListener('touchmove', function (e) {
            if (!isDragging) return;

            const currentPosition = e.touches[0].clientX;
            const difference = currentPosition - startPosition;
            const slidesToChange = Math.floor(difference / pixelsToChangeSlide);

            if (slidesToChange !== 0) {
                plusSlides(slidesToChange); // Change slides based on the drag distance
                startPosition = currentPosition; // Update start position for continuous dragging
            }
            e.preventDefault(); // Prevent default touch behavior
        });

        // Event listener for touch end
        document.querySelector('.slideshow-container').addEventListener('touchend', function () {
            isDragging = false;
            // Determine if it was a swipe or just a tap
            if (Math.abs(startX - startPosition) < 5) {
                // Handle tap or click event here if needed
            }
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
