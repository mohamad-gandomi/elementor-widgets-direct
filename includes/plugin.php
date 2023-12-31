<?php

namespace Elementor_Widgets_Direct;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Plugin class.
 *
 * The main class that initiates and runs the addon.
 *
 * @since 1.0.0
 */
final class Plugin {

	/**
	 * Addon Version
	 *
	 * @since 1.0.0
	 * @var string The addon version.
	 */
	const VERSION = '1.0.0';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 * @var string Minimum Elementor version required to run the addon.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '3.5.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 * @var string Minimum PHP version required to run the addon.
	 */
	const MINIMUM_PHP_VERSION = '7.3';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 * @access private
	 * @static
	 * @var \Elementor_Widgets_Direct\Plugin The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 * @access public
	 * @static
	 * @return \Elementor_Widgets_Direct\Plugin An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * Perform some compatibility checks to make sure basic requirements are meet.
	 * If all compatibility checks pass, initialize the functionality.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function __construct() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	/**
	 * Compatibility Checks
	 *
	 * Checks whether the site meets the addon requirement.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'elementor-widgets-direct' ),
			'<strong>' . esc_html__( 'Elementor Widgets Direct', 'elementor-widgets-direct' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-widgets-direct' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-widgets-direct' ),
			'<strong>' . esc_html__( 'Elementor Widgets Direct', 'elementor-widgets-direct' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'elementor-widgets-direct' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'elementor-widgets-direct' ),
			'<strong>' . esc_html__( 'Elementor Widgets Direct', 'elementor-widgets-direct' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'elementor-widgets-direct' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Initialize
	 *
	 * Load the addons functionality only after Elementor is initialized.
	 *
	 * Fired by `elementor/init` action hook.
	 *
	 * @since 1.0.0
	 * @access public
	 */
	public function init() {

		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'add_elementor_widget_categories' ] );

	}


	public function add_elementor_widget_categories( $elements_manager ) {

		$elements_manager->add_category(
			'direct-category',
			[
				'title' => esc_html__( 'Direct Elements', 'elementor-widgets-direct' ),
				'icon' => 'fa fa-plug',
			]
		);

	}

	/**
	 * Register Widgets
	 *
	 * Load widgets files and register new Elementor widgets.
	 *
	 * Fired by `elementor/widgets/register` action hook.
	 *
	 * @param \Elementor\Widgets_Manager $widgets_manager Elementor widgets manager.
	 */
	public function register_widgets( $widgets_manager ) {

		require_once( __DIR__ . '/widgets/hero.php' );
		require_once( __DIR__ . '/widgets/ticker.php' );
		require_once( __DIR__ . '/widgets/why_choice_us.php' );
		require_once( __DIR__ . '/widgets/special_title.php' );
		require_once( __DIR__ . '/widgets/product.php' );
		require_once( __DIR__ . '/widgets/video.php' );
		require_once( __DIR__ . '/widgets/counter.php' );
		require_once( __DIR__ . '/widgets/customer.php' );
		require_once( __DIR__ . '/widgets/blog.php' );
		require_once( __DIR__ . '/widgets/logo_slider.php' );
		require_once( __DIR__ . '/widgets/video_slider.php' );
		require_once( __DIR__ . '/widgets/testimonials.php' );
		require_once( __DIR__ . '/widgets/contact_us.php' );
		require_once( __DIR__ . '/widgets/product_form.php' );
		require_once( __DIR__ . '/widgets/tabs.php' );
		require_once( __DIR__ . '/widgets/direct_text.php' );
		require_once( __DIR__ . '/widgets/features_table.php' );
		require_once( __DIR__ . '/widgets/FAQ.php' );
		require_once( __DIR__ . '/widgets/dwp_item.php' );
		require_once( __DIR__ . '/widgets/woocommerce_shop.php' );
		require_once( __DIR__ . '/widgets/direct_icon.php' );
		require_once( __DIR__ . '/widgets/blog_post_item.php' );
		require_once( __DIR__ . '/widgets/posts_loop.php' );
		require_once( __DIR__ . '/widgets/article_blog_tab.php' );
		require_once( __DIR__ . '/widgets/newsletter.php' );
		require_once( __DIR__ . '/widgets/single_post.php' );
		require_once( __DIR__ . '/widgets/login-item.php' );

		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Hero_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Ticker_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Why_Choice_Us_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Special_Title_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Product_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Video_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Counter_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Customer_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Blog_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Logo_Slider_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Video_Slider_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Testimonials_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Contact_Us_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Product_Form_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Tabs_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Direct_Text_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Features_Table_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_FAQ_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Product_Item_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Wocommerce_Shop_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Direct_Icon_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Blog_Post_Item_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Post_Loop_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Article_Blog_Tab_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Newsletter_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Single_Post_Widget() );
		$widgets_manager->register( new \Elementor_Widgets_Direct\Widgets\Elementor_Login_Widget() );

	}

	/**
	 * Register Controls
	 *
	 * Load controls files and register new Elementor controls.
	 *
	 * Fired by `elementor/controls/register` action hook.
	 *
	 * @param \Elementor\Controls_Manager $controls_manager Elementor controls manager.
	 */
	public function register_controls( $controls_manager ) {

		require_once( __DIR__ . '/includes/controls/control-1.php' );
		require_once( __DIR__ . '/includes/controls/control-2.php' );

		$controls_manager->register( new \Elementor_Widgets_Direct\Control_1() );

	}

}