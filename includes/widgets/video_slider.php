<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Video_Slider Widget.
 *
 * Elementor widget that inserts Video_Slider messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Video_Slider_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_register_script( 'swiper-bundle', EAA_PDU . 'includes/assets/js/widgets/swiper-bundle.min.js', [], '1.0.0', true );
        wp_register_script( 'video_slider', EAA_PDU . 'includes/assets/js/widgets/video_slider.js', ['elementor-frontend'], '1.0.0', true );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Video_Slider widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Video_Slider widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	public function get_script_depends() {
        return [ 'video_slider', 'swiper-bundle' ];
    }

	/**
	 * Get widget name.
	 *
	 * Retrieve Video_Slider widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Video_Slider';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Video_Slider widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Video Slider', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Video_Slider widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-slider-video';
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
	 * Retrieve the Video_Slider of categories the Video_Slider widget belongs to.
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
	 * Retrieve the Video_Slider of keywords the Video_Slider widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Video_Slider'];
	}

	/**
	 * Register Video_Slider widget controls.
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
				'label' => esc_html__( 'Video Slider Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        /* Start repeater */
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'video_poster',
			[
				'label' => esc_html__( 'Choose Image', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$repeater->add_control(
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

		$repeater->add_control(
			'video_aparat',
			[
				'label' => esc_html__( 'Aparat Embed Code', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'condition' => [
					'video_type' => ['aparat']
				],
			]
		);

        $repeater->add_control(
			'video_file',
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

        /* End repeater */
		$this->add_control(
			'video_items',
			[
				'label' => esc_html__( 'Video Items', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
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
        <!-- VIDEO CAROUSEL
        ================================================== -->
        <!-- Carousel main container -->
        <div class="video-carousel swiper">
            <!-- Additional required wrapper -->
            <div class="swiper-wrapper">
                <?php
                    foreach ( $settings['video_items'] as $index => $item ) {
                        ?>
                        <!-- Slide -->
                        <div class="swiper-slide w-auto">
                            <img 
                                role="button" 
                                class="" 
                                src="<?php echo $settings['video_items'][$index]['video_poster']['url']; ?>"
                                alt="<?php echo $settings['video_items'][$index]['video_poster']['alt']; ?>"
								data-bs-toggle="modal" 
								data-bs-target="#exampleModal<?php echo $index; ?>"
                            >
                        </div>
                        <?php
                    }
                ?>
            </div>
        </div>

	    <?php foreach ( $settings['video_items'] as $index => $item ) { ?>
		<!-- Modal -->
		<div class="modal fade" id="exampleModal<?php echo $index; ?>" tabindex="-1" aria-labelledby="exampleModalLabel<?php echo $index; ?>" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered modal-lg">
				<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="javascript::player.api('pause')"></button>
				</div>
				<div class="modal-body">
					<?php if('hosted' == $settings['video_items'][$index]['video_type']): ?>
						<video class="w-100" controls>
							<source src="<?php echo $settings['video_items'][$index]['video_file']['url']; ?>" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					<?php else: ?>
						<div class="w-100">
							<?php echo $settings['video_items'][$index]['video_aparat']; ?>
						</div>
					<?php endif; ?>
				</div>
				</div>
			</div>
		</div>
        <?php }
    }


}
