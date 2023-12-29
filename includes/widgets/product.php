<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Ticker Widget.
 *
 * Elementor widget that inserts Product messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Product_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Product widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Product widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	//public function get_script_depends() {}

	/**
	 * Get widget name.
	 *
	 * Retrieve Product widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Product';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Product widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Product', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Product widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-single-product';
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
	 * Retrieve the Product of categories the Product widget belongs to.
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
	 * Retrieve the Product of keywords the Product widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Product'];
	}

	/**
	 * Register Product widget controls.
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
				'label' => esc_html__( 'Product Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'product_image',
			[
				'label' => esc_html__( 'Choice Image', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

        $this->add_control(
			'product_title',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        $this->add_control(
			'product_description',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control(
			'product_link_title',
			[
				'label' => esc_html__( 'Button', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        $this->add_control(
			'product_link',
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

        /* Start repeater */
		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'product_info',
			[
				'label' => esc_html__( 'Item', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

        /* End repeater */
		$this->add_control(
			'product_items',
			[
				'label' => esc_html__( 'Product Items', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

				'title_field' => '{{{ product_info }}}',
			]
		);

        $this->end_controls_section();


		/* Title Style Tab */
		$this->start_controls_section(
			'product_style',
			[
				'label' => esc_html__( 'Title', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} h3' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_light',
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
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} h3',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* Description Style Tab */
		$this->start_controls_section(
			'product_description_style',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'product_description_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} p' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'product_description_color_light',
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
				'name' => 'product_description_typography',
				'selector' => '{{WRAPPER}} p',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

		/* Items Style Tab */
		$this->start_controls_section(
			'product_item_style',
			[
				'label' => esc_html__( 'Items', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'product_item_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} ul' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'product_item_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} ul' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'product_item_typography',
				'selector' => '{{WRAPPER}} ul',
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
        <!-- PRODUCTS
        ================================================== -->
        <section class="direct-products" <?php echo !is_admin() ? 'data-aos-once="true" data-aos-delay="50" data-aos="fade-up"' : '' ; ?>>
            <div class="container">
                <!-- Products Cards -->
                <div class="row">

                    <!-- Product Card -->
                    <div class="direct-card d-flex flex-column flex-md-row bg-gray-800 rounded-6 p-6">
                        <div class="mx-auto mb-7 mb-md-0 ms-md-9 d-flex align-items-center">
                            <img class="p-2" src="<?php echo $settings['product_image']['url']; ?>" alt="<?php echo $settings['product_image']['alt']; ?>" >
                        </div>
                        <div>
                            <h3 class="mb-4 fw-700"><?php echo $settings['product_title']; ?></h3>
                            <p class="mb-7"><?php echo $settings['product_description']; ?></p>
                            <ul class="mb-7">
								<?php
								foreach ( $settings['product_items'] as $index => $item ) {
									?>
									<li class="mb-5 d-flex align-items-center">
										<span class="icon-tick-bulk fs-3 text-success ms-3">
											<span class="path1"></span>
											<span class="path2"></span>
										</span>
										<span><?php echo $settings['product_items'][$index]['product_info']; ?></span>
									</li>
									<?php
								}
								?>
                            </ul>
                            <a href="<?php echo $settings['product_link']['url']; ?>" rel="<?php echo $settings['product_link']['nofollow'] == 'on' ? 'nofollow': ''; ?>" class="btn btn-primary w-100 text-white-500 p-3 fw-500 rounded-3"><?php echo $settings['product_link_title']; ?></a>
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <?php
    }
}
