<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Newsletter Widget.
 *
 * Elementor widget that show and special image with text for newsletter
 *
 * @since 1.0.0
 */
class Elementor_Newsletter_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
        wp_register_script( 'newsletter', EAA_PDU . 'includes/assets/js/widgets/newsletter.js', ['elementor-frontend'], '1.0.0', true );
        wp_register_style( 'newsletter', EAA_PDU . 'includes/assets/css/widgets/newsletter.css', [], '1.0.0' );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Newsletter widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	public function get_style_depends() {
        return ['newsletter'];
    }

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Newsletter widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	public function get_script_depends() {
		return [ 'newsletter' ];
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve Newsletter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Newsletter';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Newsletter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Newsletter', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Newsletter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-image-hotspot';
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
	 * Retrieve the name of categories the Newsletter widget belongs to.
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
	 * Retrieve the name of keywords the Newsletter widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['newsletter'];
	}

	/**
	 * Register Newsletter widget controls.
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
				'label' => esc_html__( 'Ticker Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'image',
			[
				'label' => esc_html__( 'Choice Image', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

        $this->add_control(
			'title',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        $this->add_control(
			'description',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

        $this->add_control(
			'caption',
			[
				'label' => esc_html__( 'Caption', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
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
			'title_dark_color',
			[
				'label' => esc_html__( 'Dark Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .newsletter-title' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'title_light_color',
			[
				'label' => esc_html__( 'Light Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .newsletter-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .newsletter-title',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

        /* Description Style Tab */
		$this->start_controls_section(
			'description_style',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_dark_color',
			[
				'label' => esc_html__( 'Dark Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .newsletter-description' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'description_light_color',
			[
				'label' => esc_html__( 'Light Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .newsletter-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .newsletter-description',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

        /* Caption Style Tab */
		$this->start_controls_section(
			'caption_style',
			[
				'label' => esc_html__( 'Caption', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'caption_dark_color',
			[
				'label' => esc_html__( 'Dark Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .newsletter-caption' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'caption_light_color',
			[
				'label' => esc_html__( 'Light Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .newsletter-caption' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'caption_dark_background',
			[
				'label' => esc_html__( 'Dark Background', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .newsletter-caption' => 'background: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'caption_light_background',
			[
				'label' => esc_html__( 'Light Background', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .newsletter-caption' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'caption_typography',
				'selector' => '{{WRAPPER}} .newsletter-caption',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Newsletter widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

        ?>
        <div class="row">
            <div class="col-12 col-xl-6 position-relative">
                <img class="newsletter-img position-absolute bottom-0" src="<?php echo $settings['image']['url']; ?>" alt="<?php echo $settings['image']['alt']; ?>">
            </div>
            <div class="newsletter-text-container col-12 col-xl-6 py-9 position-relative">
                <h3 class="newsletter-title"><?php echo $settings['title']; ?></h3>
                <p class="newsletter-description mb-6"><?php echo $settings['description']; ?></p>
                <div class="position-absolute caption-container">
                    <p class="newsletter-caption p-3 m-0 rounded-6"><?php echo $settings['caption']; ?></p>
                </div>
            </div>
        </div>
        <?php



    }


}
