<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Post_Loop Widget.
 *
 * Elementor widget that inserts Post_Loop messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Post_Loop_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Post_Loop widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Post_Loop widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	//public function get_script_depends() {}

	/**
	 * Get widget name.
	 *
	 * Retrieve Post_Loop widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Post_Loop';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Post_Loop widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Post Loop', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Post_Loop widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-post-list';
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
	 * Retrieve the Post_Loop of categories the Post_Loop widget belongs to.
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
	 * Retrieve the Post_Loop of keywords the Post_Loop widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Post_Loop'];
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
	 * Register Post_Loop widget controls.
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
        ?>


        <div class="blog blog-archive">
            <?php if ($custom_query->have_posts()) : ?>
            <?php while ($custom_query->have_posts()) : $custom_query->the_post(); ?>

            <?php
            $post_title = get_the_title();
            $post_excerpt = get_the_excerpt();
            $excerpt = substr($post_excerpt, 0, $settings['excerp_length']);
            $excerpt_result = substr($excerpt, 0, strrpos($excerpt, ' '));
            $post_author = get_the_author();
            $post_date = get_the_date();
            $post_categories = get_the_category();
            $post_thumbnail = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : '';
            $post_comments_count = get_comments_number();
            $post_author_id = get_the_author_meta('ID');
            $post_author_avatar_url = get_avatar_url($post_author_id, array('size' => 32));
            $psot_permalink = get_post_permalink();
            $post_tags = get_the_tags();
            ?>

            <!-- Blog Post New -->
            <article class="post-item bg-gray-800 rounded-6 mb-6" <?php echo !is_admin() ? 'data-aos-once="true" data-aos-delay="50" data-aos="fade-up"' : '' ; ?>>
                <div class="image-container" style="background-image:url('<?php echo $post_thumbnail; ?>');"><a href="<?php echo $psot_permalink; ?>"></a></div>
                <div class="post-content py-4 px-6">
                    <h3 class="font-yekanbakh fs-3 fw-600 mb-3"><a class="text-decoration-none text-gray-50" href="<?php echo $psot_permalink; ?>"><?php echo $post_title; ?></a></h3>
                    <p class="text-gray-200 mb-3 fs-4"><?php echo $excerpt_result; ?></p>
                    <div class="post-tags">
                        <?php if ($post_tags): ?>
                        <?php  foreach ($post_tags as $tag): ?>
                        <a class="btn btn-primary-800 text-primary-400 fs-4 rounded-3 py-2 ms-1" href="<?php echo $psot_permalink; ?>"><?php echo esc_html($tag->name); ?></a>
                        <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </article>



            <?php endwhile; ?>
            <?php wp_reset_postdata(); ?>
            <?php else: ?>
            <?php endif; ?>
        </div>
        <?php



    }


}
