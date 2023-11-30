class Article_Blog_Tab extends elementorModules.frontend.handlers.Base {

    bindEvents() {
        jQuery(document).ready(function ($) {
            var postsToShow = 9; // Number of posts to display initially
            var postsOffset = 0; // Offset for loading more posts
            var categoryId = ''; // Current category ID

            $('.category-btn').on('click', function () {
                categoryId = $(this).data('category');
                $('.category-btn').removeClass('btn-primary-800 text-primary-400').addClass('btn-gray-500 text-gray-800');
                $(this).removeClass('btn-gray-500 text-gray-800').addClass('btn-primary-800 text-primary-400');
                loadPosts();
            });

            $('.load-more-btn').on('click', function () {
                postsToShow += 9; // Increase the number of posts to display
                loadPosts();
            });

            $('#search-input').on('input', function () {
                loadPosts();
            });

            function loadPosts() {

                var searchQuery = $('#search-input').val();

                // AJAX call to fetch posts
                $.ajax({
                    url: 'http://localhost/wordpress/wp-admin/admin-ajax.php', // AJAX URL
                    type: 'POST',
                    data: {
                        action: 'fetch_posts_by_category_id', // Action hook
                        category_id: categoryId, // Category ID to fetch posts from
                        posts_per_page: postsToShow,
                        offset: postsOffset,
                        search_query: searchQuery
                    },
                    success: function (response) {
                        // Display posts in the container
                        $('.posts-container').html(response);
                    },
                    error: function (errorThrown) {
                        console.log(errorThrown);
                    }
                });
            }
        });
    }


}

jQuery(window).on('elementor/frontend/init', () => {
    const addHandler = ($element) => {
        elementorFrontend.elementsHandler.addHandler(Article_Blog_Tab, {
            $element,
        });
    };

    elementorFrontend.hooks.addAction('frontend/element_ready/Article_Blog_Tab.default', addHandler);

});
