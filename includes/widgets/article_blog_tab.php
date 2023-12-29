<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Article Blog Tab Widget.
 *
 * Elementor widget that inserts Article Blog Tab messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Article_Blog_Tab_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
        wp_register_script( 'article-blog-tab', EAA_PDU . 'includes/assets/js/widgets/article-blog-tab.js', ['elementor-frontend'], '1.0.0', true );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Article_Blog_Tab widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Article_Blog_Tab widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	public function get_script_depends() {
        return [ 'article-blog-tab'];
    }

	/**
	 * Get widget name.
	 *
	 * Retrieve Article_Blog_Tab widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Article_Blog_Tab';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Article_Blog_Tab widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Article Blog Tab', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Article Blog_ ab widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-group';
	}

	/**
	 * Get custom help URL.
	 *
	 * Retrieve a URL where the user can get more information about the widget.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget help URL.
	 */
	public function get_custom_help_url() {
		return '';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the Article Blog Tab of categories
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'direct-category' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the Article Blog Tab of keywords the Article Blog Tab widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['article blog tab'];
	}

	/**
	 * Register Article Blog Tab widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Article Blog Tab Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render faq widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
        $categories = get_categories(['taxonomy'   => 'category','hide_empty' => true]);

        $args = array(
            'post_type' => 'post', 
            'posts_per_page' => 9,
            'orderby'        => 'date',
            'order'          => 'DESC',
        );

        $custom_query = new \WP_Query($args);

        ?>
        <div class="container" <?php echo !is_admin() ? 'data-aos-once="true" data-aos-delay="50" data-aos="fade-up"' : '' ; ?>>
            <div class="row mb-9 bta-buttons">
                <div class="col-12">
                    <button class="category-btn btn btn-primary-800 text-primary-400 fs-4 rounded-3 py-2 ms-1 mb-2" href="related-link1">همه مقالات</button>
                    <?php
                    foreach ($categories as $category) {
                        echo '<button data-category="'. $category->term_id .'" class="category-btn btn btn-gray-500 text-gray-800 fs-4 rounded-3 py-2 ms-1 mb-2" href="related-link1">' . $category->name . '</button>';
                    }
                    ?>
                </div>
            </div>
            <div class="article_blog_tab row flex-row-reverse flex-xl-row mb-6">

                <div class="blog col-12 col-xl-8 ps-xl-1">
                    <div class="posts-container">
                        <?php

                        // Check if the user is logged in
                        if (is_user_logged_in()) {
                            // Get the current user ID
                            $user_id = get_current_user_id();

                            // Get the liked posts for the current user
                            $liked_posts = get_user_meta($user_id, 'liked_posts', true);
                        } else {
                            // If the user is not logged in, check if a cookie exists for liked posts
                            $liked_posts = isset($_COOKIE['liked_posts']) ? json_decode(stripslashes($_COOKIE['liked_posts']), true) : array();
                        }


                        // Check if there are posts to display
                        if ($custom_query->have_posts()) :
                            while ($custom_query->have_posts()) : $custom_query->the_post();

                                $post_title = get_the_title();
                                $post_id = get_the_ID();
							    $liked_class = (in_array($post_id, $liked_posts)) ? 'text-danger-500' : 'text-black-200';
                                $post_excerpt = get_the_excerpt();
                                $excerpt = substr($post_excerpt, 0, 200);
                                $excerpt_result = substr($excerpt, 0, strrpos($excerpt, ' '));
                                $post_author = get_the_author();
                                $post_date = get_the_date();
                                $post_categories = get_the_category();
                                $post_thumbnail = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : '';
                                $post_comments_count = get_comments_number();
                                $post_author_id = get_the_author_meta('ID');
                                $post_author_avatar_url = get_avatar_url($post_author_id, array('size' => 32));
                                $psot_permalink = get_post_permalink();
                                
                                ?>
                                <article class="bta-cart bg-gray-800 rounded-6 overflow-hidden mb-6 post-wrapper">
                                    <div class="row">

                                        <div class="bta-cart__image col-12 col-md-4 position-relative top-0 start-0" style="background-image: url('<?php echo $post_thumbnail; ?>');">
                                            <div class="bta-cart__image__top">
                                                <span class="icon-heart-bulk <?php echo $liked_class; ?> display-5 ms-3 post-like" data-post-id="<?php echo get_the_ID(); ?>" type="button">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </span>
                                                <!-- <span class="icon-saved-bulk text-black-200 display-4">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </span> -->
                                            </div>
                                            <div class="d-flex align-items-center bta-cart__image__bottom">
                                                <div class="p-3 text-secondary me-3 d-flex align-items-center rounded-2 bta-cart__image__bottom__category">
                                                    <span class="display-5 ms-2 icon-archive-line"></span>
                                                    <span class="fs-4">
                                                        <?php
                                                        if (isset($post_categories) && !empty($post_categories)) {
                                                            foreach ($post_categories as $category) {
                                                                echo $category->name;
                                                                break; 
                                                            }
                                                        }
                                                        ?>
                                                    </span>
                                                </div>
                                                <div class="p-3 text-gray-50 me-3 d-flex align-items-center rounded-2 bta-cart__image__bottom__comments">
                                                    <span class="display-5 ms-2 icon-message-text-line"></span>
                                                    <span class="fs-4"><?php echo $post_comments_count ?></span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-8">

                                            <div class="py-7 px-2 px-xl-6">
                                                <h3 class="font-yekanbakh display-5 text-gray-50 fw-700 mb-3"><?php echo $post_title; ?></h3>
                                                <p class="fs-4 text-gray-200"><?php echo $post_excerpt; ?></p>
                                                <div class="d-flex align-items-center">
                                                    <div class="ms-2 ms-xl-8 bta-cart__author">
                                                        <img class="ms-1 ms-xl-3 rounded-circle" src="<?php echo $post_author_avatar_url; ?>" alt="author profile image">
                                                        <span class="text-white-500"><?php echo $post_author; ?></span>
                                                    </div>
                                                    <div class="d-flex align-items-center bta-cart__date">
                                                        <span class="icon-calendar-bulk text-gray-500 display-4 ms-1 ms-xl-3">
                                                            <span class="path1"></span>
                                                            <span class="path2"></span>
                                                            <span class="path3"></span>
                                                            <span class="path4"></span>
                                                            <span class="path5"></span>
                                                            <span class="path6"></span>
                                                            <span class="path7"></span>
                                                            <span class="path8"></span>
                                                        </span>
                                                        <span class="text-gray-500"><?php echo $post_date; ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </article>
                                <?php

                            endwhile;
                            
                            // Restore the global post data
                            wp_reset_postdata();

                        else :
                            echo 'No posts found';
                        endif;
                        ?>
                    </div>
                    <div class="text-center"><button class="load-more-btn btn btn-primary-800 text-white-100 mx-auto fs-4 mb-6">نمایش بیشتر</button></div>
                </div>

                <aside class="blog-aside col-12 col-xl-4 mx-auto me-xl-auto">
                    <div class="row">
                        <div class="col-12 p-0">
                            <div class="direct-search-input input-group mb-3 flex-row-reverse">
                                <input class="form-control shadow-none border-0 bg-gray-800 text-gray-500 pe-2 py-5" type="search" id="search-input" placeholder="جستجو...">
                                <span class="input-group-text search-icon icon-search-normal-line bg-gray-800 border-0 text-gray-500 ps-1 pe-4"></span>
                            </div>
                        </div>
                        <hr class="text-gray-700 my-7">
                        <div class="col-12 d-flex post-item p-0">
                            <div class="post-tags">
                                <a class="btn btn-primary-800 text-primary-400 rounded-3 p-3 ms-4 mb-4" href="related-link1">ایران خودرو</a>
                                <a class="btn btn-primary-800 text-primary-400 rounded-3 p-3 ms-4 mb-4" href="related-link1">ایران خودرو</a>
                                <a class="btn btn-primary-800 text-primary-400 rounded-3 p-3 ms-4 mb-4" href="related-link1">ایران خودرو</a>
                                <a class="btn btn-primary-800 text-primary-400 rounded-3 p-3 ms-4 mb-4" href="related-link1">ایران خودرو</a>
                                <a class="btn btn-primary-800 text-primary-400 rounded-3 p-3 ms-4 mb-4" href="related-link1">ایران خودرو</a>
                            </div>
                        </div>
                        <hr class="text-gray-700 my-7">
                        <div class="col-12 d-flex post-item p-0">
                            <div class="post-tags">
                                <a class="btn btn-primary-800 text-primary-400 rounded-3 p-3 ms-4 mb-4" href="related-link1">ایران خودرو</a>
                                <a class="btn btn-primary-800 text-primary-400 rounded-3 p-3 ms-4 mb-4" href="related-link1">ایران خودرو</a>
                                <a class="btn btn-primary-800 text-primary-400 rounded-3 p-3 ms-4 mb-4" href="related-link1">ایران خودرو</a>
                                <a class="btn btn-primary-800 text-primary-400 rounded-3 p-3 ms-4 mb-4" href="related-link1">ایران خودرو</a>
                                <a class="btn btn-primary-800 text-primary-400 rounded-3 p-3 ms-4 mb-4" href="related-link1">ایران خودرو</a>
                            </div>
                        </div>
                        <hr class="text-gray-700 my-7">
                    </div>

                </aside>

            </div>
        </div>
        <?php



    }


}
