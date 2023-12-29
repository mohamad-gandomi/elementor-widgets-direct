<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor Contact_Us Widget.
 *
 * Elementor widget that inserts Contact_Us messages in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_Contact_Us_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
	}

	/**
	 * Get widget styles.
	 *
	 * Retrieve Contact_Us widget styles.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget styles.
	 */
	//public function get_style_depends() {}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve Contact_Us widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	// public function get_script_depends() {}

	/**
	 * Get widget name.
	 *
	 * Retrieve Contact_Us widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'Contact Us';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Contact_Us widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'Contact Us', 'elementor-widgets-direct' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Contact_Us widget icon.
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
	 * Retrieve the Contact_Us of categories the Contact_Us widget belongs to.
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
	 * Retrieve the Contact_Us of keywords the Contact_Us widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return ['Contact_Us'];
	}

	/**
	 * Register Contact_Us widget controls.
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
				'label' => esc_html__( 'Contact Us Content', 'elementor-widgets-direct' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'first_image',
			[
				'label' => esc_html__( 'First Image', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'first_message',
			[
				'label' => esc_html__( 'First Message', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);

        $this->add_control(
			'second_image',
			[
				'label' => esc_html__( 'Second Image', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::MEDIA,
			]
		);

		$this->add_control(
			'second_message',
			[
				'label' => esc_html__( 'Second Message', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
			]
		);


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
        <!-- CONTACT US
        ================================================== -->
        <section class="main-contact-us" <?php echo !is_admin() ? 'data-aos-once="true" data-aos-delay="50" data-aos="fade-up"' : '' ; ?>>
            <div class="container">
                <div class="row align-items-center">
                    <!-- Images -->
                    <div class="col-12">
                        <div class="row">

                            <div class="col-12 col-xl-6 main-contact-us__image text-center text-xl-start">
                                <img src="<?php echo $settings['first_image']['url']; ?>" alt="<?php echo $settings['first_image']['alt']; ?>" >
								<?php if($settings['first_message']): ?>
                                <div class="bg-gray-800 text-gray-100 d-inline-block main-contact-us__image__text main-contact-us__image__text--female text-end">
                                    <p class="m-0"><?php echo $settings['first_message']; ?></p>
                                </div>
								<?php endif; ?>
                            </div>

                            <div class="col-12 col-xl-6 main-contact-us__image mt-8 mt-xl-12 text-center text-xl-end">
                                <img src="<?php echo $settings['second_image']['url']; ?>" alt="<?php echo $settings['second_image']['alt']; ?>" >
								<?php if($settings['second_message']): ?>
                                <div class="bg-gray-800 text-gray-100 d-inline-block main-contact-us__image__text main-contact-us__image__text--male">
                                    <p class="m-0"><?php echo $settings['second_message']; ?></p>
                                </div>
								<?php endif; ?>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php



    }


}
