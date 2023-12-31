<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Hero Widget.
 *
 * Elementor widget that inserts Hero questions in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Hero_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		//wp_register_style( 'hero', EAA_PDU . 'includes/assets/css/widgets/hero.css' , array(), '1.0.0' );
		//wp_register_script( 'hero', EAA_PDU . 'includes/assets/js/widgets/hero.js', ['elementor-frontend'], '1.0.0', true );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Hero widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Hero widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	//public function get_script_depends() {}

	/**
	 * Get widget name.
	 *
	 * Retrieve Hero widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Hero';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Hero widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Hero', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Hero widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-header';
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
	 * Retrieve the Hero of categories the Hero widget belongs to.
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
	 * Retrieve the Hero of keywords the Hero widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Hero'];
	}

	/**
	 * Register Hero widget controls.
	 *
	 * Add input fields to allow the user to customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		/* ==========================================================================
			HERO CONTENTS
		========================================================================== */

		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Hero Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'hero_title',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'عنوان', 'elementor-widgets-direct' ),
			]
		);

        $this->add_control(
			'hero_description',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'default' => esc_html__( 'لورم اپسیوم متن ساختگی با تولید نامفهوم از محتوای داخلی', 'elementor-widgets-direct' ),
			]
		);

        $this->add_control(
			'hero_avatars',
			[
				'label' => esc_html__( 'Avatars Images', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'hero_arrow_dark',
			[
				'label' => esc_html__( 'Dark Arrow', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'hero_arrow_light',
			[
				'label' => esc_html__( 'Light Arrow', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'hero_link',
			[
				'label' => esc_html__( 'Link', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::URL,
				'options' => [ 'url', 'is_external', 'nofollow' ],
				'default' => [
					'url' => '',
					'is_external' => true,
					'nofollow' => true,
					// 'custom_attributes' => '',
				],
				'label_block' => true,
			]
		);

        $this->add_control(
			'hero_link_title',
			[
				'label' => esc_html__( 'Link Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'عنوان لینک', 'elementor-widgets-direct' ),
			]
		);

		$this->add_control(
			'video_type',
			[
				'label' => esc_html__( 'Video Source', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'hosted',
				'options' => [
					'aparat' => esc_html__( 'Aparat', 'elementor-widgets-direct' ),
					'hosted' => esc_html__( 'Self Hosted', 'elementor-widgets-direct' ),
				],
				'frontend_available' => true,
			]
		);

		$this->add_control(
			'hero_video_aparat',
			[
				'label' => esc_html__( 'Aparat Embed Code', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'condition' => [
					'video_type' => ['aparat']
				],
			]
		);

		$this->add_control(
			'hero_video',
			[
				'label' => esc_html__( 'Choose Video File', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_types' => [ 'video' ],
				'condition' => [
					'video_type' => ['hosted']
				],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'auto_play',
			[
				'label' => esc_html__( 'Auto Play', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'Yes', 'textdomain' ),
				'label_off' => esc_html__( 'No', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->end_controls_section();

		/* ==========================================================================
			TITLE STYLES
		========================================================================== */

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
				'label' => esc_html__( 'Title Dark Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fff',
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .hero-title' => 'color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'title_light_color',
			[
				'label' => esc_html__( 'Title Light Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#14161b',
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .hero-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_span_dark_color',
			[
				'label' => esc_html__( 'Span Dark Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffbe15',
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .hero-title span' => 'color: {{VALUE}} !important',
				],
			]
		);

        $this->add_control(
			'title_span_light_color',
			[
				'label' => esc_html__( 'Span Light Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#257cff',
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .hero-title span' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .hero-title',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* ==========================================================================
			DESCRIPTION STYLES
		========================================================================== */

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
				'label' => esc_html__( 'Title Dark Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#c2c6ce',
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .hero-description' => 'color: {{VALUE}} !important',
				],
			]
		);

        $this->add_control(
			'description_light_color',
			[
				'label' => esc_html__( 'Title Light Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#14161b',
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .hero-description' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .hero-description',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* ==========================================================================
			BUTTON STYLES
		========================================================================== */

		$this->start_controls_section(
			'button_style',
			[
				'label' => esc_html__( 'Button', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'button_dark_color',
			[
				'label' => esc_html__( 'Button Dark Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffbe15',
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .hero-button' => 'color: {{VALUE}} !important',
				],
			]
		);

        $this->add_control(
			'button_light_color',
			[
				'label' => esc_html__( 'Button Light Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#257cff',
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .hero-button' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'button_typography',
				'selector' => '{{WRAPPER}} .hero-button',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->add_control(
			'button_dark_background_color',
			[
				'label' => esc_html__( 'Button Dark Background Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#664c0854',
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .hero-button:hover' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'button_light_background_color',
			[
				'label' => esc_html__( 'Button Light Background Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#D3E5FF',
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .hero-button:hover' => 'background-color: {{VALUE}} !important',
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

		if ( 'hosted' == $settings['video_type'] ) {
			$video = esc_url($settings['hero_video']['url']);
		} else {
			$video = $settings['hero_video_aparat'];
		}

        ?>
        <!-- HERO
        ================================================== -->
        <section class="main-welcome py-14 pb-xl-16 pt-xl-14 text-light position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-6 text-center text-xl-end">
                        <div class="main-welcome__title mx-auto mx-xl-0">
                            <div class="mb-9">
                                <h1 class="mb-7 hero-title"><?php echo $settings["hero_title"]; ?></h1>
                                <p class="text-gray-200 hero-description"><?php echo $settings["hero_description"]; ?></p>
                            </div>
                            <div class="row">
                                <div class="col-12 col-xl-6 mb-5 mb-xl-0">
                                    <?php $hero_avatar_images = $settings['hero_avatars']; ?>
                                    <?php if( !empty( $hero_avatar_images ) ): ?>
                                        <img src="<?php echo esc_url($hero_avatar_images['url']); ?>" alt="<?php echo esc_attr($hero_avatar_images['alt']); ?>" />
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-xl-6 align-self-center position-relative d-flex justify-content-center">

                                    <a href="<?php echo $settings["hero_link"]['url']; ?>" class="hero-button btn text-secondary text-decoration-none d-flex align-items-center hover-link w-auto">
										<span class="text"><?php echo $settings["hero_link_title"]; ?></span>
										<span class="icon-arrow-left-line icon"></span>
									</a>

                                    <?php $hero_arrow_light = $settings['hero_arrow_light']; ?>
                                    <?php if( !empty( $hero_arrow_light ) ): ?>
                                        <img id="curveArrow" class="position-absolute d-none d-xl-block dark-show" src="<?php echo esc_url($hero_arrow_light['url']); ?>" alt="<?php echo esc_attr($hero_arrow_light['alt']); ?>" />
                                    <?php endif; ?>

                                    <?php $hero_arrow_dark = $settings['hero_arrow_dark']; ?>
                                    <?php if( !empty( $hero_arrow_dark ) ): ?>
                                        <img id="curveArrow" class="position-absolute d-none d-xl-block light-show" src="<?php echo esc_url($hero_arrow_dark['url']); ?>" alt="<?php echo esc_attr($hero_arrow_dark['alt']); ?>" />
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-xl-6">
						<?php if('hosted' == $settings['video_type']): ?>
						    <div class="video-container rounded-5 bg-gray-800 mt-5">
								<video class="w-100 rounded-5 hero_video" <?php echo $settings['auto_play'] ? 'autoplay="" muted="muted"' : 'controls' ?> loop="" playsinline="" controlslist="nodownload" style="object-fit: cover;">
									<source src="<?php echo $video; ?>" type="video/mp4">
									Your browser does not support the video tag.
								</video>
							</div>
						<?php else: ?>
							<div class="hero_video">
								<?php echo $video; ?>
							</div>
						<?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="light bg-primary position-absolute top-50 start-0 translate-middle"></div>
        </section>
        <?php



    }


}
