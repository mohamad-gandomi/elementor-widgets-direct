<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Ticker Widget.
 *
 * Elementor widget that inserts Counter messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Counter_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Counter widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Counter widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	//public function get_script_depends() {}

	/**
	 * Get widget name.
	 *
	 * Retrieve Counter widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Direct Counter';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Counter widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Direct Counter', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Counter widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-counter';
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
	 * Retrieve the Counter of categories the Counter widget belongs to.
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
	 * Retrieve the Counter of keywords the Counter widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Counter'];
	}

	/**
	 * Register Counter widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'counter_content',
			[
				'label' => esc_html__( 'Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'counter_title',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        /* Start repeater */
		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'counter_icon',
			[
				'label' => esc_html__( 'Icon Class Name', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $repeater->add_control(
			'counter_title',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        $repeater->add_control(
			'counter_sub_title',
			[
				'label' => esc_html__( 'Sub Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        /* End repeater */
		$this->add_control(
			'counter_items',
			[
				'label' => esc_html__( 'Counter Item', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

				'title_field' => '{{{ counter_title }}}',
			]
		);

		$this->end_controls_section();


		/* Title Style Tab */
		$this->start_controls_section(
			'counter_title_style',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'counter_title_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'counter_title_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'counter_typography',
				'selector' => '{{WRAPPER}} h2',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* Icons Style Tab */
		$this->start_controls_section(
			'counter_items_style',
			[
				'label' => esc_html__( 'Icons', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'counter_icon_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .section-title__icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'counter_icon_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .section-title__icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'counter_icon_typography',
				'selector' => '{{WRAPPER}} .section-title__icon',
                'default' => '52px',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* Numbers Style Tab */
		$this->start_controls_section(
			'items_number_style',
			[
				'label' => esc_html__( 'Numbers', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'items_number_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .section-title__text h4' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_number_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .section-title__text h4' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'items_number_typography',
				'selector' => '{{WRAPPER}} .section-title__text h4',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

        /* Sub Titles Style Tab */
		$this->start_controls_section(
			'items_subtitle_style',
			[
				'label' => esc_html__( 'Subtitles', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'items_subtitle_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .section-title__text p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'items_subtitle_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .section-title__text p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'items_subtitle_typography',
				'selector' => '{{WRAPPER}} .section-title__text p',
				'default' => '52px',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
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
        <!-- COUNTER
        ================================================== -->
        <section class="counter" <?php echo !is_admin() ? 'data-aos-once="true" data-aos-delay="50" data-aos="fade-up"' : '' ; ?>>
            <div class="container">

                <!-- Title -->
                <div class="row">
                    <div class="col-12 text-center mb-12">
                        <h2><?php echo $settings['counter_title'] ?></h2>
                    </div>
                </div>

                <!-- Counter -->
                <div class="row">

                    <?php
                    foreach ( $settings['counter_items'] as $index => $item ) {
                        ?>
                        <!-- Counter Item -->
                        <div class="col-12 col-xl-4 mb-10 mb-xl-0 d-flex align-items-center justify-content-center">
                            <!-- Section Title Icon -->
                            <div class="section-title__icon ms-6 d-flex align-items-center">
                                <span class="direct-icon-title  <?php echo $settings['counter_items'][$index]['counter_icon']; ?>">
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

                            <!-- Section Title Text -->
                            <div class="section-title__text">
                                <h4 class="font-pinar mb-6"><?php echo $settings['counter_items'][$index]['counter_title']; ?></h4>
                                <p class="mb-2"><?php echo $settings['counter_items'][$index]['counter_sub_title']; ?></p>
                            </div>
                        </div>
                        <?php
                    }
                    ?>




                </div>
            </div>
        </section>
        <?php
    }
}
