<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Single Post Widget.
 *
 * Elementor widget that show and special image with text for single_post
 *
 * @since 1.0.0
 */
class Elementor_Single_Post_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
        wp_register_script( 'single_post', EAA_PDU . 'includes/assets/js/widgets/single_post.js', ['elementor-frontend'], '1.0.0', true );
        wp_register_style( 'single_post', EAA_PDU . 'includes/assets/css/widgets/single_post.css', [], '1.0.0' );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Single Post widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	public function get_style_depends() {
        return ['single_post'];
    }

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Single Post widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	public function get_script_depends() {
		return [ 'single_post' ];
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve Single Post widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Single Post';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Single Post widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Single Post', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Single Post widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-single-post';
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
	 * Retrieve the name of categories the Single Post widget belongs to.
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
	 * Retrieve the name of keywords the Single Post widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['single_post'];
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
	 * Register Single Post widget controls.
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
				'label' => esc_html__( 'Single Post Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
	 * Render Single Post widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

        ?>
        
        <?php



    }


}
