<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Blog_Post_Item Widget.
 *
 * Elementor widget that inserts Blog_Post_Item messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Blog_Post_Item_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Blog_Post_Item widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Blog_Post_Item widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	//public function get_script_depends() {}

	/**
	 * Get widget name.
	 *
	 * Retrieve Blog_Post_Item widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Blog_Post_Item';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Blog_Post_Item widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Blog Post Item', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Blog_Post_Item widget icon.
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
	 * Retrieve the Blog_Post_Item of categories the Blog_Post_Item widget belongs to.
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
	 * Retrieve the Blog_Post_Item of keywords the Blog_Post_Item widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Blog_Post_Item'];
	}

    // Function to get Elementor Templates as an associative array of name => ID
    public function get_posts_list() {
        $args = array(
            'post_type'      => 'post', // Fetch Elementor templates
            'posts_per_page' => -1, // Retrieve all templates
            'post_status'    => 'publish', // Fetch only published templates
        );

        $posts = get_posts($args);

        $options = array();

        foreach ($posts as $post) {
            $post_id   = $post->ID;
            $post_name = $post->post_title;

            // Add post name and ID to the options array
            $options[$post_id] = $post_name;
        }

        return $options;
    }
	

	/**
	 * Register Blog_Post_Item widget controls.
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
				'label' => esc_html__( 'Blog_Post_Item Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'excerpt_length',
			[
				'label' => esc_html__( 'Excerpt Length', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 400
			]
		);

        $this->add_control(
			'post_id',
			[
				'label' => esc_html__( 'Select Post', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => false,
				'options' => $this->get_posts_list(),
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

        $post_id = $settings['post_id'];
		$liked_class = (in_array($post_id, $liked_posts)) ? 'text-danger-500' : 'text-black-200';
        $post_title = get_the_title( $post_id );
        $post_excerpt = get_the_excerpt( $post_id );
        $excerpt = substr($post_excerpt, 0, $settings['excerpt_length']);
        $excerpt_result = substr($excerpt, 0, strrpos($excerpt, ' '));
        $post_author = get_the_author( $post_id );
        $post_date = get_the_date('F j, Y', $post_id);
        $post_categories = get_the_category( $post_id );
        $post_thumbnail = (has_post_thumbnail( $post_id )) ? get_the_post_thumbnail_url( $post_id ) : '';
        $post_comments_count = get_comments_number( $post_id );
        $psot_permalink = get_post_permalink( $post_id );
        $post_author_id = get_post_field('post_author', $post_id);
        $post_author_avatar_url = get_avatar_url($post_author_id, array('size' => 32));




        ?>
        <div class="blog blog-archive" <?php echo !is_admin() ? 'data-aos-once="true" data-aos-delay="50" data-aos="fade-up"' : '' ; ?>>
            <!-- Blog Post -->
            <div class="blog__card rounded-6 bg-gray-800">
                <div class="blog__card__image">
                    <img class="w-100" src="<?php echo $post_thumbnail; ?>" alt="<?php echo $post_title; ?>">
                    <div class="blog__card__image__icons">
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
                    <div class="blog__card__image__info d-flex align-items-center">
                        <div class="blog__card__image__category p-3 text-secondary ms-3 d-flex align-items-center rounded-2">
                            <span class="display-5 ms-3 icon-archive-line"></span>
                            <span>
                                <?php
                                if (isset($post_categories) && !empty($post_categories)) {
                                    foreach ($post_categories as $category) {
                                        echo $category->name;
                                    }
                                }
                                ?>
                            </span>
                        </div>
                        <div class="blog__card__image__comments-no p-3 text-gray-50 ms-3 d-flex align-items-center rounded-2">
                            <span class="display-5 ms-3 icon-message-text-line"></span>
                            <span><?php echo $post_comments_count ?></span>
                        </div>
                    </div>
                </div>
                <div class="blog__card__text p-6">
                    <h3 class="font-yekanbakh text-gray-50 display-5 fw-600 mb-2"><a class="text-decoration-none text-gray-50" href="<?php echo $psot_permalink; ?>"><?php echo $post_title; ?></a></h3>
                    <p class="text-gray-200 fs-4 mb-6"><?php echo $excerpt_result; ?></p>
                    <div class="d-flex align-items-center">
                        <div class="ms-8">
                            <img class="ms-3 rounded-circle" src="<?php echo $post_author_avatar_url; ?>" alt="<?php echo $post_author; ?> profile image">
                            <span class="text-white-500"><?php echo $post_author; ?></span>
                        </div>
                        <div class="blog__card__text__date d-flex align-items-center">
                            <span class="icon-calendar-bulk text-gray-500 display-4 ms-3">
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
        <?php



    }


}
