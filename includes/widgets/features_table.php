<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Features_Table Widget.
 *
 * Elementor widget that inserts Features_Table messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Features_Table_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Features_Table widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Features_Table widget scripts.
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
	 * Retrieve Features_Table widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Features Table';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Features_Table widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Features Table', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Features_Table widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-table';
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
	 * Retrieve the Features_Table of categories the Features_Table widget belongs to.
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
	 * Retrieve the Features_Table of keywords the Features_Table widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Features Table'];
	}

	/**
	 * Register Features_Table widget controls.
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
				'label' => esc_html__( 'Features Table Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        /* Start repeater */
		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'features_table_icon',
			[
				'label' => esc_html__( 'Icon Class Name', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        $repeater->add_control(
			'features_table_title',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        $repeater->add_control(
			'features_table_description',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

        $repeater->add_control(
			'features_table_button_title',
			[
				'label' => esc_html__( 'Button Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
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
			'features_table_video',
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
			'features_table_items',
			[
				'label' => esc_html__( 'Features Table Items', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

				'title_field' => '{{{ features_table_button_title }}}',
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
        <div class="direct-product-tabs__content accordion-item bg-black-500 border-0">
            <ul class="direct-product-tabs__content__fetures rounded-6">
                <?php foreach ( $settings['features_table_items'] as $index => $item ) {  ?>
                    <li class="d-xxl-flex justify-content-between align-items-center p-7">
                        <span class="<?php echo $settings['features_table_items'][$index]['features_table_icon']; ?> display-3 text-primary ms-3 mb-4 mb-xxl-0">
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
                        <h5 class="font-yekanbakh text-gray-100 display-6 fw-800 ms-6 mb-4 mb-xxl-0"><?php echo $settings['features_table_items'][$index]['features_table_title']; ?></h5>
                        <p class="text-gray-200 ms-6 mb-0 mb-4 mb-xxl-0"><?php echo $settings['features_table_items'][$index]['features_table_description']; ?></p>
                        <button 
                            class="btn btn-warning-800 text-warning-300 p-3 rounded-4 d-flex align-items-center"
                            data-bs-toggle="modal" 
                            data-bs-target="#featureTable<?php echo $index; ?>"
                        >
                            <span class="icon-video-circle-bulk ms-3">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </span>
                            <span><?php echo $settings['features_table_items'][$index]['features_table_button_title']; ?></span>
                        </button>
                    </li>
                <?php } ?>
            </ul>
        </div>
        <?php foreach ( $settings['features_table_items'] as $index => $item ) {  ?>
            <!-- Modal -->
            <div class="modal fade" id="featureTable<?php echo $index; ?>" tabindex="-1" aria-labelledby="featureTableLabel<?php echo $index; ?>" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
					<?php if('hosted' == $settings['features_table_items'][$index]['video_type']): ?>
						<video class="w-100" controls>
							<source src="<?php echo $settings['features_table_items'][$index]['features_table_video']['url']; ?>" type="video/mp4">
							Your browser does not support the video tag.
						</video>
					<?php else: ?>
						<div class="w-100">
							<?php echo $settings['features_table_items'][$index]['video_aparat']; ?>
						</div>
					<?php endif; ?>
                    </div>
                    </div>
                </div>
            </div>
        <?php }
    }
}
