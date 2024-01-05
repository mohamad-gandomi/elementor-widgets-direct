<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor FAQ Widget.
 *
 * Elementor widget that inserts FAQ messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_FAQ_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve FAQ widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve FAQ widget scripts.
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
	 * Retrieve FAQ widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'FAQ';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve FAQ widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'FAQ', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve FAQ widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-help';
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
	 * Retrieve the FAQ of categories the FAQ widget belongs to.
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
	 * Retrieve the FAQ of keywords the FAQ widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['FAQ'];
	}

	/**
	 * Register FAQ widget controls.
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
				'label' => esc_html__( 'FAQ Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        /* Start repeater */
		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'faq_question',
			[
				'label' => esc_html__( 'Question', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

        $repeater->add_control(
			'faq_answere',
			[
				'label' => esc_html__( 'Answere', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

        /* End repeater */
		$this->add_control(
			'faq_items',
			[
				'label' => esc_html__( 'FAQ Items', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

				'title_field' => '{{{ faq_question }}}',
			]
		);

		$this->end_controls_section();

		/* ==========================================================================
			QUESTION STYLE
		========================================================================== */

		$this->start_controls_section(
			'question_style',
			[
				'label' => esc_html__( 'Question', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'question_dark_color',
			[
				'label' => esc_html__( 'Question Dark Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#f0f1f3',
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .faq-question' => 'color: {{VALUE}} !important',
				],
			]
		);

        $this->add_control(
			'question_light_color',
			[
				'label' => esc_html__( 'Question Light Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#3d4350',
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .faq-question' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'question_dark_background_color',
			[
				'label' => esc_html__( 'Dark Background Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#16161d',
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .faq-question' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'question_light_background_color',
			[
				'label' => esc_html__( 'Light Background Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .faq-question' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'question_typography',
				'selector' => '{{WRAPPER}} .faq-question',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* ==========================================================================
			ANSWERES STYLE
		========================================================================== */

		$this->start_controls_section(
			'answere_style',
			[
				'label' => esc_html__( 'Answer', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'answere_dark_color',
			[
				'label' => esc_html__( 'Answer Dark Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#ffffff',
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .faq-answere' => 'color: {{VALUE}} !important',
				],
			]
		);

        $this->add_control(
			'answere_light_color',
			[
				'label' => esc_html__( 'Answer Light Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#3d4350',
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .faq-answere' => 'color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'answer_dark_background_color',
			[
				'label' => esc_html__( 'Dark Background Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#16161d',
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .faq-answer' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_control(
			'answer_light_background_color',
			[
				'label' => esc_html__( 'Light Background Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'default' => '#fafafa',
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .faq-answer' => 'background-color: {{VALUE}} !important',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'answere_typography',
				'selector' => '{{WRAPPER}} .faq-answere',
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
        <!-- FAQs
        ================================================== -->
        <section class="direct-faqs">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="accordion accordion-flush px-0" id="accordionFlushExample">
                            <?php foreach ( $settings['faq_items'] as $index => $item ) { ?>
                                    <!-- Faq Item -->
                                    <div class="accordion-item bg-black-500 mb-9">
                                        <h2 class="accordion-header border-0" id="flush-headingOne-header">
                                            <button 
                                                class="faq-question accordion-button collapsed shadow-none pb-8 pt-0 px-0 text-end" 
                                                type="button" 
                                                data-bs-toggle="collapse" 
                                                data-bs-target="#flush-collapse<?php echo $settings['faq_items'][$index]['_id']; ?>" 
                                                aria-expanded="false" 
                                                aria-controls="flush-collapse<?php echo $settings['faq_items'][$index]['_id']; ?>"
                                            >
                                                <?php echo $settings['faq_items'][$index]['faq_question']; ?>
                                            </button>
                                        </h2>
                                        <div 
                                            id="flush-collapse<?php echo $settings['faq_items'][$index]['_id']; ?>" 
                                            class="accordion-collapse collapse faq-answere border-0" 
                                            data-bs-parent="#accordionFlushExample"
                                        >
                                            <div class="faq-answere accordion-body pb-6 pt-0 px-0"><?php echo $settings['faq_items'][$index]['faq_answere']; ?></div>
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
