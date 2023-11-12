<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Ticker Widget.
 *
 * Elementor widget that inserts Ticker messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Ticker_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		//wp_register_style( 'Ticker', EAA_PDU . 'includes/assets/css/widgets/Ticker.css' , array(), '1.0.0' );
		//wp_register_script( 'Ticker', EAA_PDU . 'includes/assets/js/widgets/Ticker.js', ['elementor-frontend'], '1.0.0', true );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Ticker widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	public function get_style_depends() {
		//return [ 'Ticker' ];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Ticker widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	public function get_script_depends() {
		//return [ 'Ticker' ];
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve Ticker widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Ticker';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Ticker widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Ticker', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Ticker widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-posts-ticker';
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
	 * Retrieve the Ticker of categories the Ticker widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'general' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the Ticker of keywords the Ticker widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Ticker'];
	}

	/**
	 * Register Ticker widget controls.
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
				'label' => esc_html__( 'Ticker Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'ticker_title',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'عنوان', 'elementor-widgets-direct' ),
			]
		);

        $this->add_control(
			'ticker_icon',
			[
				'label' => esc_html__( 'Icon', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-circle',
					'library' => 'fa-solid',
				],
			]
		);

        /* Start repeater */
		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'ticker_message',
			[
				'label' => esc_html__( 'Message', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'message...', 'elementor-widgets-direct' ),
				'default' => esc_html__( 'corrupti illo aperiam. Autem modi reprehenderit mollitia deleniti?', 'elementor-widgets-direct' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        /* End repeater */
		$this->add_control(
			'ticker_items',
			[
				'label' => esc_html__( 'Ticker Items', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

				'title_field' => '{{{ ticker_message }}}',
			]
		);

		$this->end_controls_section();


		/* General Style Tab */
		$this->start_controls_section(
			'ticker_general_style',
			[
				'label' => esc_html__( 'General', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'ticker_background',
				'types' => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .ticker',
			]
		);

		$this->end_controls_section();


		/* Title Style Tab */
		$this->start_controls_section(
			'ticker_title_style',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ticker_title_color',
			[
				'label' => esc_html__( 'Title Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'ticker_title_typography',
				'selector' => '{{WRAPPER}} h2',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();


		/* Items Style Tab */
		$this->start_controls_section(
			'ticker_item_style',
			[
				'label' => esc_html__( 'Items', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'ticker_item_color',
			[
				'label' => esc_html__( 'Items Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-slide p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'ticker_item_typography',
				'selector' => '{{WRAPPER}} .swiper-slide p',
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
        <!-- TICKER
        ================================================== -->
        <section class="ticker align-items-center px-7">
            <div class="row">
                <div class="ticker__title py-2 col-auto">
                    <?php \Elementor\Icons_Manager::render_icon( $settings['ticker_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                    <h2 class="font-pinar fs-4 fw-800 mx-6 d-inline"><?php echo $settings['ticker_title']; ?></h2>
                </div>
                <div class="ticker__carousel swiper me-9 col fw-500">
                    <div class="swiper-wrapper">
                        <?php
                            foreach ( $settings['ticker_items'] as $index => $item ) { 
                                $message = $settings['ticker_items'][$index]['ticker_message'];
                                ?>
                                <div class="swiper-slide font-pinar fs-4 w-auto d-flex align-items-center">
                                    <p class="m-0"><?php echo $message; ?></p>
                                </div>
                                <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php



    }


}
