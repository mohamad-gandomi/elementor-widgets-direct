<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Testimonials Widget.
 *
 * Elementor widget that inserts Testimonials messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Testimonials_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_register_script( 'swiper-bundle', EAA_PDU . 'includes/assets/js/widgets/swiper-bundle.min.js', [], '1.0.0', true );
        wp_register_script( 'testimonials', EAA_PDU . 'includes/assets/js/widgets/testimonials.js', ['elementor-frontend'], '1.0.0', true );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Testimonials widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Testimonials widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	public function get_script_depends() {
        return [ 'testimonials', 'swiper-bundle' ];
    }

	/**
	 * Get widget name.
	 *
	 * Retrieve Testimonials widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Testimonials';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Testimonials widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Video Slider', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Testimonials widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-slider-video';
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
	 * Retrieve the Testimonials of categories the Testimonials widget belongs to.
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
	 * Retrieve the Testimonials of keywords the Testimonials widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Testimonials'];
	}

	/**
	 * Register Testimonials widget controls.
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
				'label' => esc_html__( 'Testimonials', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        /* Start repeater */
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Choose Image', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'message',
			[
				'label' => esc_html__( 'Message', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);


        /* End repeater */
		$this->add_control(
			'video_items',
			[
				'label' => esc_html__( 'Video Items', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
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

        ?>
        <!-- VIDEO CAROUSEL
        ================================================== -->
        <!-- Carousel main container -->
        <div class="video-carousel swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <?php
                    foreach ( $settings['video_items'] as $index => $item ) {
                        ?>
                        <!-- Slide -->
                        <div class="swiper-slide w-auto">
                            <img 
                                role="button" 
                                class="" 
                                src="<?php echo $settings['video_items'][$index]['video_poster']['url']; ?>"
                                alt="<?php echo $settings['video_items'][$index]['video_poster']['alt']; ?>"
								data-bs-toggle="modal" 
								data-bs-target="#exampleModal<?php echo $index; ?>"
                            >
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>

	   <?php
    }


}
