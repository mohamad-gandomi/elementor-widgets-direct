<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Tabs Widget.
 *
 * Elementor widget that inserts Tabs messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Tabs_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Tabs widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Tabs widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	//public function get_script_depends() {}

	/**
	 * Get widget name.
	 *
	 * Retrieve Tabs widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Tabs';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Tabs widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Direct Tabs', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Tabs widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-tabs';
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
	 * Retrieve the Tabs of categories the Tabs widget belongs to.
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
	 * Retrieve the Tabs of keywords the Tabs widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Tabs'];
	}

    // Function to get Elementor Templates as an associative array of name => ID
    public function get_elementor_templates_list() {
        $args = array(
            'post_type'      => 'elementor_library', // Fetch Elementor templates
            'posts_per_page' => -1, // Retrieve all templates
            'post_status'    => 'publish', // Fetch only published templates
        );

        $templates = get_posts($args);

        $options = array();

        foreach ($templates as $template) {
            $template_id   = $template->ID;
            $template_name = $template->post_title;

            // Add template name and ID to the options array
            $options[$template_id] = $template_name;
        }

        return $options;
    }

	/**
	 * Register Tabs widget controls.
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
				'label' => esc_html__( 'Tabs', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);


        /* Start repeater */
		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'tab_btn_name',
			[
				'label' => esc_html__( 'Tab Name', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Tab Name', 'elementor-widgets-direct' ),
			]
		);

        $repeater->add_control(
			'tab_btn_icon',
			[
				'label' => esc_html__( 'Icon Class Name', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'icon-category-line ', 'elementor-widgets-direct' ),
			]
		);

        $repeater->add_control(
			'template_id',
			[
				'label' => esc_html__( 'Select Template', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => false,
				'options' => $this->get_elementor_templates_list(),
				'default' => [ 'title', 'description' ],
			]
		);

        /* End repeater */
		$this->add_control(
			'tab_contents',
			[
				'label' => esc_html__( 'Tab Item', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

				'title_field' => '{{{ tab_btn_name }}}',
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

		<!-- Tabs
		================================================== -->
		<section class="customer-club">
			<div class="container">
				<div class="row">
					<!-- Features Tabs -->
					<div class="col-12">
						<div class="accordion direct-tabs" id="accordionExampletop">

							<!-- Features Tabs Btns -->
							<div class="d-flex mx-auto">
								<div class="direct-tabs__btns p-1 bg-gray-800 rounded-3 d-inline-block mb-12 mx-auto d-inline-flex flex-wrap">
									<?php foreach ( $settings['tab_contents'] as $index => $item ) { ?>
											<button
												class="<?php echo $index !== 0 ? 'collapsed' : '' ; ?> fs-2 btn btn-gray-900 text-white-500 px-5 py-3 rounded-3 d-flex align-items-center collapsed"
												type="button"
												data-bs-toggle="collapse"
												data-bs-target="#collapse<?php echo $settings['tab_contents'][$index]['_id']; ?>"
												aria-expanded="false"
												aria-controls="collapse<?php echo $settings['tab_contents'][$index]['_id']; ?>"
											>
												<span class="<?php echo $settings['tab_contents'][$index]['tab_btn_icon']; ?> display-6 ms-5">
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
												<?php echo $settings['tab_contents'][$index]['tab_btn_name']; ?>
											</button>
								
								    <?php } ?>
								</div>
							</div>


							<?php foreach ( $settings['tab_contents'] as $index => $item ) { ?>

								<?php $selected_template_id = $settings['tab_contents'][$index]['template_id']; ?>

								<?php if (!$selected_template_id) {continue;} ?>

								<div class="direct-tabs__content accordion-item bg-black-500 border-0">
									<div id="collapse<?php echo $settings['tab_contents'][$index]['_id']; ?>" class="accordion-collapse collapse <?php echo $index == 0 ? 'show' : '' ; ?>" data-bs-parent="#accordionExampletop">
										<div class="row align-items-center flex-xl-row-reverse">
										<?php
											// Check if Elementor is active and the selected template ID is valid
											if ( \Elementor\Plugin::instance()->editor->is_edit_mode() || \Elementor\Plugin::instance()->preview->is_preview_mode() || $selected_template_id ) {
												// Use Elementor's frontend rendering method to display the template
												echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $selected_template_id );
											}
										?>
										</div>
									</div>
								</div>

                            <?php } ?>
						</div>
					</div>
				</div>
			</div>
		</section>

        <?php



    }


}
