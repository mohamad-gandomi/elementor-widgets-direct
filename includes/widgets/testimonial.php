<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Testimonial Widget.
 *
 * Elementor widget that show customers testimonials in a customize way
 *
 * @since 1.0.0
 */
class Elementor_Testimonial_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_register_style( 'testimonials', EAA_PDU . 'includes/assets/css/widgets/testimonials.css' , array(), '1.0.0' );
		wp_register_script( 'testimonials', EAA_PDU . 'includes/assets/js/widgets/testimonials.js', ['elementor-frontend'], '1.0.0', true );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve testimonials widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	public function get_style_depends() {
		return [ 'testimonials' ];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve testimonials widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	public function get_script_depends() {
		return [ 'testimonials' ];
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve testimonials widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Testimonial';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve testimonials widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Testimonial', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve testimonials widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-testimonial';
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
	 * Retrieve the testimonials of categories the testimonials widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve keywords the testimonials widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['testimonials'];
	}

	/**
	 * Register testimonials widget controls.
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
				'label' => esc_html__( 'Testimonial Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		/* Start repeater */

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'image',
			[
				'label' => esc_html__( 'Customer Image', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'placeholder' => esc_html__( 'customer feedback text...', 'elementor-widgets-direct' ),
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'feedback',
			[
				'label' => esc_html__( 'Feedback Text', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'customer feedback text...', 'elementor-widgets-direct' ),
				'default' => esc_html__( 'corrupti illo aperiam. Autem modi reprehenderit mollitia deleniti', 'elementor-widgets-direct' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'name',
			[
				'label' => esc_html__( 'Name', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Name...', 'elementor-widgets-direct' ),
				'default' => esc_html__( 'John Doe', 'elementor-widgets-direct' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'occupation',
			[
				'label' => esc_html__( 'Occupation', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'Occupation...', 'elementor-widgets-direct' ),
				'default' => esc_html__( 'Scientist', 'elementor-widgets-direct' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		/* End repeater */

		$this->add_control(
			'testimonial_items',
			[
				'label' => esc_html__( 'Testimonial Items', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),           /* Use our repeater */
				'title_field' => '{{{ name }}}',
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
			<div class="rev_slider">
				<?php
					foreach ( $settings['testimonial_items'] as $index => $item ) {

						$image = $settings['testimonial_items'][$index]['image'];
						$feedback = $settings['testimonial_items'][$index]['feedback'];
						$name = $settings['testimonial_items'][$index]['name'];
						$occupation = $settings['testimonial_items'][$index]['occupation'];

						?>
						<div class="rev_slide">
							<div class="testimonial">
								<img src="<?php echo $image['url']; ?>" alt="" class="customer-img" />
								<div class="testimonials-box">
									<img src="<?php echo get_template_directory_uri(); ?>/assets/images/noun_Quote.png" alt="" class="testimonials-icon" />
									<div class="testimonials-text">
										<p class="testimonials-description"><?php echo $feedback; ?></p>
										<p class="testimonials-name"><?php echo $name; ?></p>
										<p class="testimonials-position"><?php echo $occupation; ?></p>
									</div>
								</div>
							</div>
						</div>
						<?php
					}
				?>

			</div>
		<?php
		
	}

}