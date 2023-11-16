<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Logo_Slider Widget.
 *
 * Elementor widget that inserts Logo_Slider messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Logo_Slider_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_register_script( 'swiper-bundle', EAA_PDU . 'includes/assets/js/widgets/swiper-bundle.min.js', [], '1.0.0', true );
        wp_register_script( 'logo_slider', EAA_PDU . 'includes/assets/js/widgets/logo_slider.js', ['elementor-frontend'], '1.0.0', true );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Logo_Slider widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Logo_Slider widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	public function get_script_depends() {
		return [ 'logo_slider', 'swiper-bundle' ];
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve Logo_Slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Logo_Slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Logo_Slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Logo Slider', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Logo_Slider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-site-logo';
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
	 * Retrieve the Logo_Slider of categories the Logo_Slider widget belongs to.
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
	 * Retrieve the Logo_Slider of keywords the Logo_Slider widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Logo_Slider'];
	}

	/**
	 * Register Logo_Slider widget controls.
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
				'label' => esc_html__( 'Logo Slider Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        /* Start repeater */
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'logo_image',
			[
				'label' => esc_html__( 'Choose Image', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

        /* End repeater */
		$this->add_control(
			'logo_items',
			[
				'label' => esc_html__( 'Logo Items', 'elementor-widgets-direct' ),
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
        <!-- LOGO SLIDER
		================================================== -->
		<section class="testimonials">
			<div class="container-fluid">
				<!-- CUSTOMER LOGO CAROUSEL
				================================================== -->
				<!-- Carousel main container -->
				<div class="customer-logo-carousel swiper">
					<!-- Additional required wrapper -->
					<div class="swiper-wrapper">
					<?php
						foreach ( $settings['logo_items'] as $index => $item ) {
							?>
							<!-- Slide -->
							<div class="swiper-slide w-auto">
								<img role="button" class="w-100" src="<?php echo $settings['logo_items'][$index]['logo_image']['url']; ?>" alt="<?php echo $settings['logo_items'][$index]['logo_image']['alt']; ?>">
							</div>
							<?php
						}
					?>
					</div>
				</div>
			</div>
		</section>
        <?php



    }


}
