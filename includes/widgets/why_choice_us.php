<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Why Choice Us Widget.
 *
 * Elementor widget that inserts Why_Choice_Us messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Why_Choice_Us_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Why_Choice_Us widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Why_Choice_Us widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	//public function get_script_depends() {}

	/**
	 * Get widget name.
	 *
	 * Retrieve Why_Choice_Us widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Why Choice Us';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Why Choice Us widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Why Choice Us', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Why Choice Us widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-banner';
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
	 * Retrieve the Why Choice Us of categories the Why Choice Us widget belongs to.
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
	 * Retrieve the Why Choice Us of keywords the Why Choice Us widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Why Choice Us'];
	}

	/**
	 * Register Why Choice Us widget controls.
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
				'label' => esc_html__( 'Why Choice Us Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        /* Start repeater */
		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'why_choice_us_number',
			[
				'label' => esc_html__( 'Number', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
			]
		);

        $repeater->add_control(
			'why_choice_us_title',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        $repeater->add_control(
			'why_choice_us_description',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

        $repeater->add_control(
			'why_choice_us_image',
			[
				'label' => esc_html__( 'Choose Image', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        /* End repeater */
		$this->add_control(
			'why_choice_us_items',
			[
				'label' => esc_html__( 'Items', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

				'title_field' => '{{{ why_choice_us_title }}}',
			]
		);

		$this->end_controls_section();


		/* Number Style Tab */
		$this->start_controls_section(
			'wcu_number_style',
			[
				'label' => esc_html__( 'Number', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'wcu_number_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .direct-card__number' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wcu_number_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .direct-card__number' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'wcu_number_typography',
				'selector' => '{{WRAPPER}} .direct-card__number',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* Title Style Tab */
		$this->start_controls_section(
			'wcu_title_style',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'wcu_title_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wcu_title_color_light',
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
				'name' => 'wcu_title_typography',
				'selector' => '{{WRAPPER}} h3',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		
		/* Text Style Tab */
		$this->start_controls_section(
			'wcu_text_style',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'wcu_text_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .direct-card__text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'wcu_text_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .direct-card__text' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'wcu_text_typography',
				'selector' => '{{WRAPPER}} .direct-card__text',
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
        <!-- WHY CHOICE US
        ================================================== -->
        <section class="why-choose-us mb-14 mb-xl-16 position-relative">
            <div class="container">



                <!-- Cards -->
                <div class="row">
                    <?php
                    foreach ( $settings['why_choice_us_items'] as $index => $item ) {
                        $number = $settings['why_choice_us_items'][$index]['why_choice_us_number'];
                        $title = $settings['why_choice_us_items'][$index]['why_choice_us_title'];
                        $description = $settings['why_choice_us_items'][$index]['why_choice_us_description'];
                        $image = $settings['why_choice_us_items'][$index]['why_choice_us_image'];
                    ?>
                        <!-- Card -->
                        <div class="col-12 col-xl-4 mb-8 mb-xl-0">
                            <div class="direct-card rounded-6 px-7 pb-7 pt-10">
                                <div class="d-flex mb-10">
                                    <span class="font-pinar ms-6 direct-card__number"><?php echo $number; ?></span>
                                    <div>
                                        <h3 class="mb-4"><?php echo $title; ?></h3>
                                        <p class="mb-2 direct-card__text"><?php echo $description; ?></p>
                                    </div>
                                </div>
                                <div>
                                    <img class="w-100" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" >
                                </div>
                            </div>
                        </div>
                    <?php
                    }    
                    ?>
                </div>
            </div>
            <div class="light bg-secondary position-absolute top-100 start-100 translate-middle"></div>
        </section>
        <?php



    }


}
