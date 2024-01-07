<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Product Form Widget.
 *
 * Elementor widget that inserts Product Form in the page and let tou select the product
 *
 * @since 1.0.0
 */
class Elementor_Product_Form_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_register_script( 'swiper-bundle', EAA_PDU . 'includes/assets/js/widgets/swiper-bundle.min.js', [], '1.0.0', true );
        wp_register_script( 'product-form', EAA_PDU . 'includes/assets/js/widgets/product-form.js', ['elementor-frontend'], '1.0.0', true );
		wp_register_style( 'product-form', EAA_PDU . 'includes/assets/css/widgets/product-form.css', [], '1.0.0' );
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Product Form widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	public function get_style_depends() {
		return [ 'product-form'];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Product Form widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	public function get_script_depends() {
		return [ 'product-form', 'swiper-bundle' ];
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve Product Form widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Product_Form';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Product Form widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Product Form', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Product Form widget icon.
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
	 * Retrieve the categories the Product Form widget belongs to.
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
	 * Retrieve keywords the Product Form widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Product Form'];
	}


    // Function to get WooCommerce products as an associative array of name => ID
    public function get_woocommerce_product_list() {
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => -1, // Retrieve all products
        );

        $products = get_posts($args);

        $options = array();

        foreach ($products as $product) {
            $product_id = $product->ID;
            $product_name = $product->post_title;

            // Add product name and ID to the options array
            $options[$product_id] = $product_name;
        }

        return $options;
    }

	/**
	 * Register Product Form widget controls.
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
				'label' => esc_html__( 'Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'product_id',
			[
				'label' => esc_html__( 'Select Product', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'label_block' => true,
				'multiple' => false,
				'options' => $this->get_woocommerce_product_list(),
				'default' => [ 'title', 'description' ],
			]
		);

		$this->add_control(
			'product_color',
			[
				'label' => esc_html__( 'Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .product_color' => 'color: {{VALUE}}',
					'{{WRAPPER}} .product_background_color' => 'background-color: {{VALUE}}',
				],
			]
		);

        $this->add_control(
			'product_icon',
			[
				'label' => esc_html__( 'Icon Class Name', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        $this->add_control(
			'product_subtitle',
			[
				'label' => esc_html__( 'Subtitle', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        $this->add_control(
			'product_description',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
			]
		);

        /* Start repeater */
		$repeater = new \Elementor\Repeater();

        $repeater->add_control(
			'product_color_title',
			[
				'label' => esc_html__( 'Product Color Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        $repeater->add_control(
			'product_color',
			[
				'label' => esc_html__( 'Product Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'product_image',
			[
				'label' => esc_html__( 'Choice Image', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'product_gallery',
			[
				'label' => esc_html__( 'Choice Black Images', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'show_label' => false,
				'default' => [],
			]
		);

        /* End repeater */
		$this->add_control(
			'product_variables',
			[
				'label' => esc_html__( 'Product Colors', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),

				'title_field' => '{{{ product_color_title }}}',
			]
		);

		/* Start Second Repeater */
		$second_repeater = new \Elementor\Repeater();

        $second_repeater->add_control(
			'icon_class_name',
			[
				'label' => esc_html__( 'Icon Class Name', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

        $second_repeater->add_control(
			'icon_color',
			[
				'label' => esc_html__( 'Icon Color', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
			]
		);

		$second_repeater->add_control(
			'feature_description',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

        /* End second_repeater */
		$this->add_control(
			'product_features',
			[
				'label' => esc_html__( 'Product Features', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $second_repeater->get_controls(),

				'title_field' => '{{{ icon_class_name }}}',
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
        global $woocommerce;
		$settings = $this->get_settings_for_display();
        $product_id = $settings['product_id'];
        $product = wc_get_product($product_id);

        ?>
        <!-- PRODUCT
        ================================================== -->
        <section class="product">
            <div class="container">
                <div class="row">
                    <!-- Product Gallery -->
                    <div class="col-12 col-xl-6">
                        <div class="product__gallery my-10">
                            <!-- Product Image -->
                            <div class="product__gallery__image d-inline-block d-flex align-items-center justify-content-center">

								<?php foreach ( $settings['product_variables'] as $index => $item ): ?>

									<?php if($settings['product_variables'][$index]['product_image']['url']): ?>

										<div id="slider<?php echo $index ?>" style="display:none">
											<img class="w-100 " src="<?php echo esc_url($settings['product_variables'][$index]['product_image']['url']); ?>" alt="<?php echo esc_url($settings['product_variables'][$index]['product_image']['alt']); ?>" >
										</div>

									<?php else: ?>

										<div id="slider<?php echo $index ?>" class="product-viewer"></div>
											<?php
											foreach ( $settings['product_variables'][$index]['product_gallery'] as $image ) {
												$image_path = pathinfo(parse_url($image['url'])['path'], PATHINFO_DIRNAME);
												$file_prefix = pathinfo(parse_url($image['url'])['path'], PATHINFO_FILENAME);
												$file_extension = pathinfo(parse_url($image['url'])['path'], PATHINFO_EXTENSION);
												break;
											}
											?>
										<script>
											jQuery(document).ready(function() {
												var productViewer<?php echo $index; ?> = new ProductViewer({
													element: document.getElementById('slider<?php echo $index; ?>'),
													imagePath: '<?php echo $image_path; ?>',
													filePrefix: '<?php echo substr($file_prefix, 0, -2); ?>',
													fileExtension: '.<?php echo $file_extension; ?>',
													numberOfImages: <?php echo count($settings['product_variables'][$index]['product_gallery']); ?>
												});

												// Once loaded, trigger a 360 spin
												productViewer<?php echo $index; ?>.once('loaded', function() {
													productViewer<?php echo $index; ?>.animate360();
												});
											});
										</script>

									<?php endif; ?>

								<?php endforeach; ?>


								<div class="product__gallery__image__blur product_background_color"></div>
                                <span class="icon-box-2-bulk display-1 position-absolute bottom-0 end-0 product_color">
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
                            </div>
                        </div>
                    </div>
                    <!-- Product Info -->
                    <div class="product__info col-12 col-xl-6">

                        <!-- Product Title -->
                        <div class="product__info__title mb-7">
                            <div class="d-flex align-items-center mb-5">
                                <span class="<?php echo $settings['product_icon']; ?> display-1 ms-5 product_color">
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
                                <h1 class="display-5 text-gray-50 mb-0 fw-800"><?php echo $product->get_title(); ?></h1>
                            </div>
                            <span class="font-pinar fw-500 text-gray-200"><?php echo $settings['product_subtitle']; ?></span>
                        </div>

                        <!-- Product Description -->
                        <div class="product__info__description text-gray-50 fw-light lh-lg mb-7">
                            <p><?php echo $settings['product_description']; ?></p>
                        </div>

                        <!-- Product Variables -->
                        <div class="product__info__variables d-flex align-items-center mb-7">

                        <?php foreach ( $settings['product_variables'] as $index => $item ) { ?>
							<?php if($settings['product_variables'][$index]['product_color_title']): ?>
                            <button class="color-btn btn btn-gray-700 text-white-500 rounded-3 p-3 d-flex ms-3" id="sliderBtn<?php echo $index; ?>" data-title="<?php echo $settings['product_variables'][$index]['product_color_title']; ?>">
                                <span style="background-color: <?php echo $settings['product_variables'][$index]['product_color']; ?>" class="product__info__variables__colorIndicator"></span>
                                <span><?php echo $settings['product_variables'][$index]['product_color_title']; ?></span>
                            </button>
							<?php endif; ?>
                        <?php } ?>


                        </div>

						<!-- Product Form -->
						<form id="product_add_to_cart_form" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="product__info__form align-items-center mb-7" method="post">

							<!-- Product Price -->
							<div class="product__info__form__price mb-7">
								<span class="font-pinar text-success-500 display-4 fw-800"><?php echo number_format($product->get_price()) . ' تومان'; ?></span>
							</div>

							<!-- Product Count -->
							<div class="product__info__form__count mb-7 user-select-none">
								<div class="quantity-input bg-gray-800 rounded-6 d-inline-block px-3">
									<a class="py-1 px-2 font-poppins quantity-button bg-gray-500 rounded-circle text-light quantity-button minus">-</a>
									<input class="display-5 text-light text-center" type="number" id="quantity" name="quantity" value="1">
									<a class="py-1 px-2 font-poppins quantity-button bg-gray-500 rounded-circle text-light quantity-button plus">+</a>
								</div>
							</div>

							<input id="colorInput" type="hidden" name="color" value="">
							<input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
							<button id="product_add_to_cart" type="submit" class="btn btn-primary w-100 text-white-500 p-4 rounded-4 w-50 fw-500">ثبت خرید</button>
						</form>

                        <!-- Product Bonus -->
                        <div class="product__info__bonus d-flex flex-wrap">

                            <?php foreach ( $settings['product_features'] as $index => $item ) { ?>
								<div class="d-flex align-items-center mb-3 ms-6">
									<span class="<?php echo $settings['product_features'][$index]['icon_class_name']; ?> <?php echo $settings['product_features'][$index]['icon_color']; ?> display-4 ms-2">
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
									<span class="text-gray-50 fw-light fs-4"><?php echo $settings['product_features'][$index]['feature_description']; ?></span>
								</div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>



		<div class="row" id="yourFixedDiv">

			<div class="col-12 col-xl-6">	
				<!-- Product Title -->
				<div class="product__info__title mb-4">
					<div class="d-flex align-items-center mb-5">
						<span class="fs-2 mb-0 fw-800"><?php echo $product->get_title(); ?></span>
					</div>
				</div>

				<div class="product__info__form__price">
					<span class="font-pinar text-success-500 fs-2 fw-800"><?php echo number_format($product->get_price()) . ' تومان'; ?></span>
				</div>

			</div>

			<div class="col-12 col-xl-6 d-flex align-items-center justify-content-end">
				<button id="product_add_to_cart_sticky" type="submit" class="btn btn-primary text-white-500 p-4 rounded-4 w-50 fw-500">ثبت خرید</button>
			</div>
		</div>



        <?php
    }
}
