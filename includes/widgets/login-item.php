<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Login Widget.
 *
 * Elementor widget that show and special image with text for Login
 *
 * @since 1.0.0
 */
class Elementor_Login_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
        wp_register_script( 'Login', EAA_PDU . 'includes/assets/js/widgets/Login.js', ['elementor-frontend'], '1.0.0', true );
        wp_register_style( 'Login', EAA_PDU . 'includes/assets/css/widgets/Login.css', [], '1.0.0' );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Login widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	public function get_style_depends() {
        return ['Login'];
    }

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Login widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	public function get_script_depends() {
		return [ 'Login' ];
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve Login widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Login';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Login widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Login', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Login widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-exit';
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
	 * Retrieve the name of categories the Login widget belongs to.
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
	 * Retrieve the name of keywords the Login widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Login'];
	}

	/**
	 * Register Login widget controls.
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
			'button',
			[
				'label' => esc_html__( 'button', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

        $this->add_control(
			'link',
			[
				'label' => esc_html__( 'link', 'elementor-widgets-direct' ),
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
					'[data-bs-theme="dark"] {{WRAPPER}} .Login-title' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'title_light_color',
			[
				'label' => esc_html__( 'Light Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .Login-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .Login-title',
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
					'[data-bs-theme="dark"] {{WRAPPER}} .Login-description' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'description_light_color',
			[
				'label' => esc_html__( 'Light Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .Login-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .Login-description',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

	}

	/**
	 * Render Login widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

        ?>
        <div class="row bg-gray-100 p-7 rounded-6 Login-item">
            <div class="col-12">
                <img class="d-block me-auto mb-9" src="<?php echo $settings['image']['url']; ?>" alt="<?php echo $settings['image']['alt']; ?>">
                <h2 class="Login-title mb-6"><?php echo $settings['title']; ?></h2>
                <p class="mb-9 d-flex align-items-center">
                    <span class="icon-info-bulk text-gray-500 fs-1 ms-2">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </span>
                    <span class="Login-description"><?php echo $settings['description']; ?></span>
                </p>
                <a class="btn btn-primary Login-button" href="<?php echo $settings['link']; ?>">
                    <span class="icon-arrow-right-line ms-2"></span>
                    <?php echo $settings['button']; ?>
                </a>
            </div>
        </div>
        <?php



    }


}
