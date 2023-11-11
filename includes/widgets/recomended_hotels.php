<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor recomended_hotels Widget.
 *
 * Elementor widget that show Recomended Hotels
 *
 * @since 1.0.0
 */
class Elementor_Recomended_Hotels_Widget extends \Elementor\Widget_Base {

	public function get_query() {
		return $this->_query;
	}

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_register_style( 'recomended_hotels', EAA_PDU . 'includes/assets/css/widgets/recomended_hotels.css' , array(), '1.0.0' );
		wp_register_script( 'recomended_hotels', EAA_PDU . 'includes/assets/js/widgets/recomended_hotels.js', ['elementor-frontend'], '1.0.0', true );
	}


	/**
	 * Get widget styles.
	 *
	 * Retrieve recomended_hotels widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	public function get_style_depends() {
		return [ 'recomended_hotels' ];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve recomended_hotels widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	public function get_script_depends() {
		return [ 'recomended_hotels' ];
	}

	/**
	 * Get widget name.
	 *
	 * Retrieve recomended_hotels widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'recomended_hotels';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve recomended_hotels widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Recomended Hotel', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve recomended_hotels widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-gallery-grid';
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
	 * Retrieve the testimonials of categories the recomended_hotels widget belongs to.
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
	 * Retrieve keywords the recomended_hotels widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['recomended_hotels'];
	}

	public function get_cities() {

		// The product category taxonomy
		$taxonomy = 'product_cat';

		// Get the parent categories IDs
		$parent_cat_ids = get_terms( $taxonomy, array(
			'parent'     => 0,
			'hide_empty' => false,
			'fields'     => 'ids'
		) );

		// Get only "child" WP_Term Product categories
		$subcategories = get_terms( $taxonomy, array(
			'orderby'    => 'name',
			'order'      => 'asc',
			'hide_empty' => false,
			'meta_query' => [
                [   
                    'key' => 'zone',
                    'value' => 'city',
                    'compare' => '=',
                ]   
			],
		) );

		if( ! empty( $subcategories ) ){
			foreach ($subcategories as $subcategory) {
				//get_term_link($subcategory)//$subcategory->name//$subcategory->term_id
				$city_names[$subcategory->term_id] = esc_html__( $subcategory->name, 'plugin-name' );
			}
		}
		return $city_names ?? [];
	}

	public function get_hotels() {
		$hotel_names = [];
		$args     = array( 'post_type' => 'product', 'posts_per_page' => -1 );
		$products = get_posts( $args );
		if( ! empty( $products ) ){
			foreach ($products as $product) {
				$hotel_names[$product->ID] = esc_html__( $product->post_title, 'plugin-name' );
			}
		}
		return $hotel_names;
	}

	/**
	 * Register recomended_hotels widget controls.
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
				'label' => esc_html__( 'Recommended Hotel', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		/* Start repeater */
		
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'filter_title', [
				'label' => esc_html__( 'Filter Title', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'Title' , 'elementor-widgets-direct' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'city',
			[
				'label' => esc_html__( 'Select City', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => false,
				'options' => $this->get_cities(),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'hotel',
			[
				'label' => esc_html__( 'Select Hotel', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::SELECT2,
				'multiple' => true,
				'options' => $this->get_hotels(),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		/* End repeater */

		$this->add_control(
			'recommended_hotel_items',
			[
				'label' => esc_html__( 'Recommended Hotel Items', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),           /* Use our repeater */
				'title_field' => '{{{ filter_title }}}',
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
			<div class="container mplists">
				<h2>هتل‌ های پیشنهادی</h2>


				<div class="mplistsfilters">

					<?php

					if ( $settings['recommended_hotel_items'] ) {
						$i = 0;
						foreach (  $settings['recommended_hotel_items'] as $item ) {
							echo '<div class="mplistfilter">';
							if ($i == 0) {
								echo '<a href="#" class="selected" data-filter="' . esc_attr( $item['city'] ) . '" ><i class="fa fa-map-marker" aria-hidden="true"></i>' . $item['filter_title'] . '</a>';
							} else {
								echo '<a href="#" data-filter="' . esc_attr( $item['city'] ) . '" ><i class="fa fa-map-marker" aria-hidden="true"></i>' . $item['filter_title'] . '</a>';
							}
							echo '</div>';
							$i++;
						}
					}

					?>

				</div>

				<div class="mplistscontents">
					<?php
					if ( $settings['recommended_hotel_items'] ) {
						$e = 0;
						foreach ( $settings['recommended_hotel_items'] as $item ) {
							foreach ($item['hotel'] as $hotel_id ) {

								$hotel = wore_get_hotel($hotel_id);
								$hotel_categories = $hotel->get_hotel_categories();

								//echo $hotel->get_image_id();
								//$hotel_cities = $hotel->get_city();
								?>
									
										<div class="mplist <?php  echo ' ' . esc_attr( $item['city'] )  ?>" <?php if( $e != 0 ) { echo 'style="display: none;"';} ?>>
											<span class="badge">
												<img src="<?php echo get_template_directory_uri(); ?>/assets/images/dicount_badge_01.png" alt="" />
												<p><?php echo $hotel->get_meta('discount_percent'); ?> تخفیف</p>
											</span>
											<article>
												<a href="<?php echo get_site_url(); ?>/product/<?php echo $hotel->get_slug(); ?>"  style="background-image: url(<?php echo wp_get_attachment_url($hotel->get_image_id()); ?>)" ></a>
												<h3><a style="color: #292E61;" href="/product/<?php echo $hotel->get_slug(); ?>"><?php echo $hotel->get_name(); ?></a></h3>
												<span>
												<?php 
													if ($hotel_categories) {

														foreach ( $hotel_categories as $hotel_category ) {
															$category_type = $hotel_category->get_data('type');
															if ( 'degree' == $category_type ) {
																$count = @(int)$hotel_category->get_data('degree');
																if ($count) {
																	for ($x = 0; $x < $count; $x++) {
																		echo '<i class="fa fa-star active" aria-hidden="true"></i>';
																	}
																}
															}
														}

													}
												?>
												</span>
												<p><?php echo tikhotel_custom_excerpt(120 ,$hotel->get_description() ); ?></p>
												<br>
												<p><strong>آدرس : </strong> <?php echo $hotel->get_meta('address'); ?></p>
												<div class="mplistprice">
													<p>
														شروع قیمت برای یک شب از:<br />
														<span><?php echo @number_format( $hotel->get_meta('price_start')); ?> تومان</span>
													</p>
													<a href="<?php echo get_site_url(); ?>/product/<?php echo $hotel->get_slug(); ?>">رزرو هتل</a>
												</div>
											</article>
										</div>
								<?php
							}
							$e = $e + 1;
						}
					}
					?>
				</div>

				<?php
					if ( $settings['recommended_hotel_items'] ) {
						$t = 0;
						foreach ( $settings['recommended_hotel_items'] as $item ) {
							if ( 0 == $t ) {
								echo '<div class="ctacontainer ' .  esc_attr( $item['city'] ) . '"><a class="ctabutton" href="'.get_term_link(get_term(esc_attr( $item['city'] ))).'">مشاهده هتل‌های ' .  esc_attr( $item['filter_title'] ) . '</a></div>';
							} else {
								echo '<div class="ctacontainer ' .  esc_attr( $item['city'] ) . '" style="display: none;"><a class="ctabutton" href="'.get_term_link(get_term(esc_attr( $item['city'] ))).'">مشاهده هتل‌های ' .  esc_attr( $item['filter_title'] ) . '</a></div>';
							}
							$t++;
						}
					}
				?>


			</div>
		<?php
	}

}