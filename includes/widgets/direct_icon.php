<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Direct_Icon Widget.
 *
 * Elementor widget that inserts Direct_Icon messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Direct_Icon_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
        wp_register_style( 'direct-icon', EAA_PDU . 'includes/assets/css/widgets/direct_icon.css', [], '1.0.0' );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Direct_Icon widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	public function get_style_depends() {
        return ['direct-icon'];
    }

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Direct_Icon widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	// public function get_script_depends() {
	// 	return [ 'ticker', 'swiper-bundle' ];
	// }

	/**
	 * Get widget name.
	 *
	 * Retrieve Direct_Icon widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'direct-icon';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Direct_Icon widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Direct Social Icon', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Direct_Icon widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-social-icons';
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
	 * Retrieve the Direct_Icon of categories the Direct_Icon widget belongs to.
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
	 * Retrieve the Direct_Icon of keywords the Direct_Icon widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['direct_icon'];
	}

	/**
	 * Register Direct_Icon widget controls.
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
				'label' => esc_html__( 'Text Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        /* Start repeater */
		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'icon_class_name',
			[
				'label' => esc_html__( 'Icon Class Name', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        $repeater->add_control(
			'icon_class',
			[
				'label' => esc_html__( 'Icon Class', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        $repeater->add_control(
			'icon_link',
			[
				'label' => esc_html__( 'Icon Link', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        /* End repeater */
		$this->add_control(
			'direct_social_icons',
			[
				'label' => esc_html__( 'Social Icons', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

				'title_field' => '{{{ icon_class_name }}}',
			]
		);

		$this->end_controls_section();


        /* General Style Tab */
		$this->start_controls_section(
			'direct_icon_general_style',
			[
				'label' => esc_html__( 'General', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

        $this->add_control(
			'direct_icon_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .direct-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'direct_icon_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .direct-icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'direct_icon_typography',
				'selector' => '{{WRAPPER}} .direct-icon',
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

        <?php foreach ( $settings['direct_social_icons'] as $index => $item ) { ?>
            <?php if ($settings['direct_social_icons'][$index]['icon_link']) { echo '<a href="' . $settings['direct_social_icons'][$index]['icon_link'] . '" rel="nofollow">'; } ?>
            <span class="<?php echo $settings['direct_social_icons'][$index]['icon_class_name'] ?> <?php echo $settings['direct_social_icons'][$index]['icon_class'] ?> direct-icon">
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
            <?php if ($settings['direct_social_icons'][$index]['icon_link']) { echo '</a>'; } ?>
        <?php } ?>

        <?php
    }
}
