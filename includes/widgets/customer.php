<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Customer Widget.
 *
 * Elementor widget that inserts Customer messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Customer_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Customer widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Customer widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	//public function get_script_depends() {}

	/**
	 * Get widget name.
	 *
	 * Retrieve Customer widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Direct Customer';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Customer widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Direct Customer', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Customer widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-user-circle-o';
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
	 * Retrieve the Customer of categories the Customer widget belongs to.
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
	 * Retrieve the Customer of keywords the Customer widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Customer'];
	}

	/**
	 * Register Customer widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'customer_content',
			[
				'label' => esc_html__( 'Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'customer_icon',
			[
				'label' => esc_html__( 'Icon Class Name', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $this->add_control(
			'customer_title',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $this->add_control(
			'customer_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $this->add_control(
			'customer_description',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        /* Start repeater */
		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'customer_tag_title',
			[
				'label' => esc_html__( 'Tag Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        /* End repeater */
		$this->add_control(
			'customer_items',
			[
				'label' => esc_html__( 'Customer Item', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

				'title_field' => '{{{ customer_tag_title }}}',
			]
		);

		$this->end_controls_section();


		/* General Style Tab */
		$this->start_controls_section(
			'customer_general_style',
			[
				'label' => esc_html__( 'General', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'general_dark_mode_background',
			[
				'label' => esc_html__( 'Dark Mode Background', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' =>  'general_dark_mode_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '[data-bs-theme="dark"] {{WRAPPER}} .customers__card',
			]
		);

		$this->add_control(
			'general_light_mode_background',
			[
				'label' => esc_html__( 'Light Mode Background', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' =>  'general_light_mode_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '[data-bs-theme="light"] {{WRAPPER}} .customers__card',
			]
		);


		$this->end_controls_section();


		/* Title Style Tab */
		$this->start_controls_section(
			'customer_title_style',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'customer_title_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'customer_title_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'customer_typography',
				'selector' => '{{WRAPPER}} h3',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* Sub Title Style Tab */
		$this->start_controls_section(
			'customer_sub_title_style',
			[
				'label' => esc_html__( 'Sub Title', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'customer_sub_title_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .customers__card__subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'customer_sub_title_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .customers__card__subtitle' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'customer_subtitle_typography',
				'selector' => '{{WRAPPER}} .customers__card__subtitle',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* Description Style Tab */
		$this->start_controls_section(
			'customer_description_style',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'customer_description_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .customers__card__description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'customer_description_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .customers__card__description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'customer_description_typography',
				'selector' => '{{WRAPPER}} .customers__card__description',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* Icons Style Tab */
		$this->start_controls_section(
			'customer_items_style',
			[
				'label' => esc_html__( 'Icon', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'customer_icon_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .customers-icon-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'customer_icon_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .customers-icon-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'customer_icon_typography',
				'selector' => '{{WRAPPER}} .customers-icon-title',
                'default' => '48px',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_control(
			'icon_dark_mode_background_title',
			[
				'label' => esc_html__( 'Dark Mode Background', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' =>  'icon_dark_mode_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '[data-bs-theme="dark"] {{WRAPPER}} .customers__card__icon-wrapper',
			]
		);

		$this->add_control(
			'icon_light_mode_background_title',
			[
				'label' => esc_html__( 'Light Mode Background', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' =>  'icon_light_mode_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '[data-bs-theme="light"] {{WRAPPER}} .customers__card__icon-wrapper',
			]
		);

		$this->end_controls_section();

		/* Buttons Style Tab */
		$this->start_controls_section(
			'customer_buttons_style',
			[
				'label' => esc_html__( 'Buttons', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'customer_buttons_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .customers__card__tags button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'customer_buttons_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .customers__card__tags button' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'customer_buttons_typography',
				'selector' => '{{WRAPPER}} .customers__card__tags button',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_control(
			'buttons_dark_mode_background_title',
			[
				'label' => esc_html__( 'Dark Mode Background', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' =>  'buttons_dark_mode_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '[data-bs-theme="dark"] {{WRAPPER}} .customers__card__tags button',
			]
		);

		$this->add_control(
			'buttons_light_mode_background_title',
			[
				'label' => esc_html__( 'Light Mode Background', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' =>  'buttons_light_mode_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '[data-bs-theme="light"] {{WRAPPER}} .customers__card__tags button',
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
        <!-- CUSTOMERS
        ================================================== -->
        <section class="customers" <?php echo !is_admin() ? 'data-aos-once="true" data-aos-delay="50" data-aos="fade-up"' : '' ; ?>>
            <div class="container">

                <div class="row">
                    <!-- customer Cart -->
                    <div class="col-12">
                        <div class="customers__card p-7 rounded-6">

                            <!-- customer Cart Ttile -->
                            <div class="customers__card__title d-flex align-items-center mb-6">
                                <div class="customers__card__icon-wrapper d-flex align-items-center justify-content-center rounded-2 ms-3">
                                    <span class="customers-icon-title <?php echo $settings['customer_icon']; ?>">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                    </span>
                                </div>
                                <div class="customers__card__subtitle">
                                    <h3><?php echo $settings['customer_title']; ?></h3>
                                    <span class="font-pinar"><?php echo $settings['customer_sub_title']; ?></span>
                                </div>
                            </div>

                            <!-- customer Cart's customer -->
                            <h4 class="mb-6 customers__card__description"><?php echo $settings['customer_description']; ?></h4>
                            <div class="customers__card__tags">
                                <?php
                                foreach ( $settings['customer_items'] as $index => $item ) { 
                                ?>
                                    <button class="font-pinar btn p-2 ms-1 mb-2 rounded-3"><?php echo $settings['customer_items'][$index]['customer_tag_title']; ?></button>
                                <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
