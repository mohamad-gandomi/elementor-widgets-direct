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
		return esc_html__( 'Testimonials', 'elementor-widgets-direct' );
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
		return 'eicon-global-settings';
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
			'testimonial_items',
			[
				'label' => esc_html__( 'Item', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();

		/* Title Style Tab */
		$this->start_controls_section(
			'title_style',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'testimonial_title_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} h4' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'testimonial_title_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} h4' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'testimonial_title_typography',
				'selector' => '{{WRAPPER}} h4',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* Subtitel Style Tab */
		$this->start_controls_section(
			'testimonials_subtitle_style',
			[
				'label' => esc_html__( 'Subtitle', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'testimonials_subtitle_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .customer-testimonials-carousel__card__subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'testimonials_subtitle_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .customer-testimonials-carousel__card__subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'testimonials_subtitle_typography',
				'selector' => '{{WRAPPER}} .customer-testimonials-carousel__card__subtitle',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		
		/* Text Style Tab */
		$this->start_controls_section(
			'testimonials_message_style',
			[
				'label' => esc_html__( 'Message', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'testimonials_message_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .customer-testimonials-carousel__card__message' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'testimonials_message_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .customer-testimonials-carousel__card__message' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'testimonials_message_typography',
				'selector' => '{{WRAPPER}} .customer-testimonials-carousel__card__message',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
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
        <!-- CUSTOMER TESTIMONIALS
        ================================================== -->
        <!-- Carousel main container -->
        <div class="customer-testimonials-carousel swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
				<?php foreach ( $settings['testimonial_items'] as $index => $item ) { ?>
					<!-- Slide -->
					<div class="swiper-slide">
						<div class="customer-testimonials-carousel__card bg-gray-800 rounded-3 p-6">
							<div class="mb-3 d-flex align-items-center justify-content-between">
								<div class="d-flex">
									<div class="ms-3 d-flex align-items-center">
										<img src="<?php echo $settings['testimonial_items'][$index]['image']['url']; ?>" alt="<?php echo $settings['testimonial_items'][$index]['image']['alt']; ?>" >
									</div>
									<div>
										<h4 class="mb-1"><?php echo $settings['testimonial_items'][$index]['title']; ?></h4>
										<span class="font-pinar customer-testimonials-carousel__card__subtitle"><?php echo $settings['testimonial_items'][$index]['subtitle']; ?></span>
									</div>
								</div>
								<span class="quote-mark text-gray-600">”</span>
							</div>
							<p class="customer-testimonials-carousel__card__message mb-0"><?php echo $settings['testimonial_items'][$index]['message']; ?></p>
						</div>
					</div>
				<?php } ?>
            </div>
        </div>
	   <?php
    }


}
