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
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => esc_html__( 'عنوان', 'elementor-widgets-direct' ),
			]
		);

        $this->add_control(
			'hero_description',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
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
        <!-- HERO
        ================================================== -->
        <section class="main-welcome py-14 py-xl-16 text-light position-relative">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-xl-6 text-center text-xl-end">
                        <div class="main-welcome__title mx-auto mx-xl-0">
                            <div class="mb-9">
                                <h1 class="fw-800 mb-7"><?php echo $settings["hero_title"]; ?></h1>
                                <p class="text-gray-200"><?php echo $settings["hero_description"]; ?></p>
                            </div>
                            <div class="row">
                                <div class="col-12 col-xl-6 mb-5 mb-xl-0">
                                    <?php $hero_avatar_images = $settings['hero_avatars']; ?>
                                    <?php if( !empty( $hero_avatar_images ) ): ?>
                                        <img src="<?php echo esc_url($hero_avatar_images['url']); ?>" alt="<?php echo esc_attr($hero_avatar_images['alt']); ?>" />
                                    <?php endif; ?>
                                </div>
                                <div class="col-12 col-xl-6 align-self-center position-relative">

                                    <a href="<?php echo $settings["hero_link"]['url']; ?>" class="text-secondary text-decoration-none"><?php echo $settings["hero_link_title"]; ?></a>

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
                    <div class="col-12 col-xl-6 d-none d-xl-block">
                        <?php $hero_image = get_field('hero_image'); ?>
                        <?php if( !empty( $hero_image ) ): ?>
                            <img class="w-100 mt-5" src="<?php echo esc_url($hero_image['url']); ?>" alt="<?php echo esc_attr($hero_image['alt']); ?>" />
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="light bg-primary position-absolute top-50 start-0 translate-middle"></div>
        </section>
        <?php



    }


}
