<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Blog Widget.
 *
 * Elementor widget that inserts Blog messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Blog_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_register_style( 'blog', EAA_PDU . 'includes/assets/css/widgets/blog.css', [], '1.0.0' );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Blog widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	public function get_style_depends() {
		return ['blog'];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Blog widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	//public function get_script_depends() {}

	/**
	 * Get widget name.
	 *
	 * Retrieve Blog widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Blog';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Blog widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Blog', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Blog widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-post';
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
	 * Retrieve the Blog of categories the Blog widget belongs to.
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
	 * Retrieve the Blog of keywords the Blog widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Blog'];
	}

	// Function to get categories as an associative array of name => ID
    public function get_categories_list() {
        $args = array(
            'taxonomy'   => 'category', // Fetch categories
            'hide_empty' => false, // Include categories with no posts
        );

        $categories = get_categories($args);

        $options = array();

        foreach ($categories as $category) {
            $cat_id   = $category->term_id;
            $cat_name = $category->name;

            // Add category name and ID to the options array
            $options[$cat_id] = $cat_name;
        }

        return $options;
    }

	/**
	 * Register Blog widget controls.
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
				'label' => esc_html__( 'Post Loop Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'excerp_length',
			[
				'label' => esc_html__( 'Excerpt Length', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 100
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Posts Per Page', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3
			]
		);

		$this->add_control(
			'design',
			[
				'label' => esc_html__( 'Design', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'main',
				'options' => [
					'main' => esc_html__( 'Main', 'elementor-widgets-direct' ),
					'blog' => esc_html__( 'Blog', 'elementor-widgets-direct' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'query',
			[
				'label' => esc_html__( 'Posts Query', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'last_posts',
				'options' => [
					'last_posts' => esc_html__( 'Last Posts', 'elementor-widgets-direct' ),
					'category_id' => esc_html__( 'Category', 'elementor-widgets-direct' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'category_id',
			[
				'label' => esc_html__( 'Select Category', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
                'condition' => [
					'query' => ['category_id']
				],
				'label_block' => true,
				'multiple' => false,
				'options' => $this->get_categories_list(),
			]
		);

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

        ?>
        <!-- BLOG
        ================================================== -->
        <section class="blog <?php echo 'blog' == $settings['design'] ? 'blog-archive' : '' ; ?>">
            <div class="container">

                <!-- Blog Posts -->
                <div class="blog row">

                <?php

					$settings = $this->get_settings_for_display();
					$args = array(
						'post_type' => 'post', 
						'posts_per_page' => $settings['posts_per_page'],
						'orderby'        => 'date',
						'order'          => 'DESC',
					);

					if ('category_id' == $settings['query']) {
						$args['cat'] = $settings['category_id'];
					}

					$custom_query = new \WP_Query($args);

                    // Check if there are posts to display
                    if ($custom_query->have_posts()) :
                        while ($custom_query->have_posts()) : $custom_query->the_post();

                            $post_title = get_the_title();
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
                                <!-- Blog Post -->
                                <div class="col-12 mb-6 mb-xxl-0 col-xl-6 col-xxl-4">
                                    <div class="blog__card rounded-6 bg-gray-800">
                                        <div class="blog__card__image" style="background-image: url(<?php echo $post_thumbnail; ?>)">
                                            <div class="blog__card__image__icons">
                                                <span class="icon-heart-bulk text-black-200 display-5 ms-3">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </span>
                                                <span class="icon-archive-bulk text-black-200 display-5">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </span>
                                            </div>
                                            <div class="blog__card__image__info d-flex align-items-center">
                                                <div class="blog__card__image__category p-3 text-secondary me-3 d-flex align-items-center rounded-2">
                                                    <span class="display-5 icon-folder-open-line ms-3"></span>
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
                                                <div class="blog__card__image__comments-no p-3 text-gray-50 me-3 d-flex align-items-center rounded-2">
                                                    <span class="display-5 icon-message-text-line ms-1"></span>
                                                    <span class="fs-4"><?php echo $post_comments_count ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="blog__card__text p-6">
                                            <h3 class="font-yekanbakh text-gray-50 fs-2 fw-600 mb-2"><a class="text-decoration-none text-gray-50" href="<?php echo $psot_permalink; ?>"><?php echo $post_title; ?></a></h3>
                                            <p class="text-gray-200 fs-4 mb-6"><?php echo $excerpt_result; ?></p>
                                            <div class="d-flex align-items-center justify-content-between">
                                                <div>
                                                    <img class="ms-1 rounded-circle" src="<?php echo $post_author_avatar_url; ?>" alt="<?php echo $post_author; ?> profile image">
                                                    <span class="text-white-500 fs-4"><?php echo $post_author; ?></span>
                                                </div>
                                                <div class="blog__card__text__date d-flex align-items-center">
                                                    <span class="icon-calendar-bulk text-gray-500 display-4 ms-1">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                        <span class="path4"></span>
                                                        <span class="path5"></span>
                                                        <span class="path6"></span>
                                                        <span class="path7"></span>
                                                        <span class="path8"></span>
                                                    </span>
                                                    <span class="text-gray-500 fs-4"><?php echo $post_date; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php

                        endwhile;

                        // Restore the global post data
                        wp_reset_postdata();

                    else :
                        echo 'No posts found';
                    endif;
                ?>


                </div>
            </div>
        </section>
        <?php
    }
}
