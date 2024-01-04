<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Ticker Widget.
 *
 * Elementor widget that inserts Video messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Video_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Video widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Video widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	//public function get_script_depends() {}

	/**
	 * Get widget name.
	 *
	 * Retrieve Video widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Video';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Video widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Video', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Video widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-video-camera';
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
	 * Retrieve the Video of categories the Video widget belongs to.
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
	 * Retrieve the Video of keywords the Video widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Video'];
	}

	/**
	 * Register Video widget controls.
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
				'label' => esc_html__( 'Video Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'video_title',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

        $this->add_control(
			'video_description',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
			]
		);

        $this->add_control(
			'video_icon',
			[
				'label' => esc_html__( 'Icon Class Name', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
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
			'video_aparat',
			[
				'label' => esc_html__( 'Aparat Embed Code', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'condition' => [
					'video_type' => ['aparat']
				],
			]
		);

        $this->add_control(
			'video',
			[
				'label' => esc_html__( 'Choose Video File', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'media_types' => [ 'video' ],
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'video_type' => ['hosted']
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


		/* Title Style Tab */
		$this->start_controls_section(
			'video_style',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'video_title_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'video_title_color_light',
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
				'name' => 'video_title_typography',
				'selector' => '{{WRAPPER}} h2',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* Description Style Tab */
		$this->start_controls_section(
			'video_description_style',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'video_description_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'video_description_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'video_description_typography',
				'selector' => '{{WRAPPER}} p',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* Icon Style Tab */
		$this->start_controls_section(
			'video_icon_style',
			[
				'label' => esc_html__( 'Icon', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'video_icon_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .main-video__icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'video_icon_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .main-video__icon' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'video_icon_typography',
				'selector' => '{{WRAPPER}} .main-video__icon span[class*=" icon-"]',
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
        <!-- VIDEO
        ================================================== -->
        <section class="main-video" <?php echo !is_admin() ? 'data-aos-once="true" data-aos-delay="50" data-aos="fade-up"' : '' ; ?>>
            <div class="container">
                <div class="row align-items-center">

                    <!-- Title -->
                    <div class="col-12 col-xl-6 mb-10 mb-xl-0">

                        <!-- Icon -->
                        <div class="main-video__icon mb-7">
                            <span class="<?php echo $settings['video_icon']; ?>">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                                <span class="path6"></span>
                                <span class="path7"></span>
                                <span class="path8"></span>
                            </span>
                        </div>

                        <!-- Divider -->
                        <div class="divider bg-primary mb-9"></div>

                        <!-- Text -->
                        <div class="main-video__text">
                            <h2 class="mb-6"><?php echo $settings['video_title']; ?></h2>
                            <p class="mb-0"><?php echo $settings['video_description']; ?></p>
                        </div>

                    </div>

                    <!-- Video -->
					
                    <div class="col-12 col-xl-6">

						<?php if('hosted' == $settings['video_type']): ?>

						    <div class="video-container rounded-5 bg-gray-800 mt-5">
								<video class="w-100 rounded-5 direct_video" <?php echo $settings['auto_play'] ? 'autoplay="" muted="muted"' : 'controls' ?> playsinline="" controlslist="nodownload" style="object-fit: cover;">
									<source src="<?php echo esc_url($settings['video']['url']); ?>" type="video/mp4">
									Your browser does not support the video tag.
								</video>
							</div>

						<?php else: ?>

							<div class="direct_video">
								<?php echo $settings['video_aparat']; ?>
							</div>

						<?php endif; ?>

                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
