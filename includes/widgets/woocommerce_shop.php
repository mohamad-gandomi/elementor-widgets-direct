<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Wocommerce_Shop Widget.
 *
 * Elementor widget that inserts Wocommerce_Shop messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Wocommerce_Shop_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Wocommerce_Shop widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Wocommerce_Shop widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	//public function get_script_depends() {}

	/**
	 * Get widget name.
	 *
	 * Retrieve Wocommerce_Shop widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Woocommerce Shop';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Wocommerce_Shop widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Woocommerce Shop', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Wocommerce_Shop widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-basket-medium';
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
	 * Retrieve the Wocommerce_Shop of categories the Wocommerce_Shop widget belongs to.
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
	 * Retrieve the Wocommerce_Shop of keywords the Wocommerce_Shop widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Wocommerce_Shop'];
	}

	/**
	 * Register Wocommerce_Shop widget controls.
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
				'label' => esc_html__( 'Wocommerce Shop Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'posts_per_page',
			[
				'label' => esc_html__( 'Posts Per Page', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'min' => 1,
				'step' => 1,
                'default' => 9,
			]
		);

		$this->end_controls_section();

        /* Title Style Tab */
		$this->start_controls_section(
			'title_style',
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
					'[data-bs-theme="dark"] {{WRAPPER}} .dwp-item__title h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'title_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .dwp-item__title h2' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'title_typography',
				'selector' => '{{WRAPPER}} .dwp-item__title h2',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();


        /* Description Style Tab */
		$this->start_controls_section(
			'description_style',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .dwp-item__description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'description_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .dwp-item__description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'description_typography',
				'selector' => '{{WRAPPER}} .dwp-item__description',
				'global' => [
					'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
				],
			]
		);

		$this->end_controls_section();

        /* Price Style Tab */
		$this->start_controls_section(
			'price_style',
			[
				'label' => esc_html__( 'Price', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'price_color_dark',
			[
				'label' => esc_html__( 'Dark Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="dark"] {{WRAPPER}} .dwp-item__price' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'price_color_light',
			[
				'label' => esc_html__( 'Light Mode Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'[data-bs-theme="light"] {{WRAPPER}} .dwp-item__price' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'price_typography',
				'selector' => '{{WRAPPER}} .dwp-item__price',
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

        // Get WooCommerce products
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => $settings['posts_per_page'], // Retrieve all products
        );
        $products = get_posts($args);

        if ($products) {
            ?><div class='row'><?php
            foreach ($products as $product) {

                $title = get_the_title($product->ID);
                $description = get_post_field('post_excerpt', $product->ID);
                $price = get_post_meta($product->ID, '_regular_price', true);
                $product_image_id = get_post_thumbnail_id($product->ID);
                $product_image_url = wp_get_attachment_image_src($product_image_id, 'full');
                $product_image_alt = get_post_meta($product_image_id, '_wp_attachment_image_alt', TRUE);
                $product_url = get_permalink($product->ID);

                // Output HTML for each product
                ?>
                <div class="col-12 col-xl-4">
                    <div class="dwp-item p-7 rounded-5 mb-7">
                        <div class="row">
                            <div class="col-12 mb-7">
                                <div class="dwo-item__image rounded-5">
                                    <img class="w-100" src="<?php echo $product_image_url[0]; ?>" alt="<?php echo $product_image_alt; ?>">
                                </div>
                            </div>
                            <div class="col-12 d-flex flex-column justify-content-end">
                                <div class="dwp-item__title">
                                    <h2 class="mb-4"><?php echo $title; ?></h2>
                                </div>
                                <div class="dwp-item__description">
                                    <p><?php echo $description; ?></p>
                                </div>
                                <div class="dwp-item__price mb-9">
                                    <span class="font-pinar"><?php echo number_format($price); ?> تومان</span>
                                </div>
                                <div class="dwp-item__link">
                                    <a href="<?php echo $product_url; ?>" type="button" class="btn btn-primary w-100 text-white-500 p-3 fw-500 rounded-3">ثبت خرید</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            wp_reset_postdata(); // Reset the global post data
        } else {
            echo 'No products found';
        }
        ?></div><?php

    }


}
