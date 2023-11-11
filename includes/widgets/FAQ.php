<?php
namespace Elementor_Widgets_Direct\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Elementor FAQ Widget.
 *
 * Elementor widget that inserts faq questions in a customize way with filters
 *
 * @since 1.0.0
 */
class Elementor_FAQ_Widget extends \Elementor\Widget_Base {

	public function __construct($data = [], $args = null) {
		parent::__construct($data, $args);
		wp_register_style( 'FAQ', EAA_PDU . 'includes/assets/css/widgets/FAQ.css' , array(), '1.0.0' );
		wp_register_script( 'FAQ', EAA_PDU . 'includes/assets/js/widgets/FAQ.js', ['elementor-frontend'], '1.0.0', true );
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
	public function get_style_depends() {
		return [ 'FAQ' ];
	}

	/**
	 * Get widget scripts.
	 *
	 * Retrieve FAQ widget scripts.
	 *
	 * @since 1.0.0
	 * @access public
	 * @return string Widget scripts.
	 */
	public function get_script_depends() {
		return [ 'FAQ' ];
	}

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
		return 'eicon-accordion';
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
		return [ 'general' ];
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
			'question',
			[
				'label' => esc_html__( 'Question', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'question...', 'elementor-widgets-direct' ),
				'default' => esc_html__( 'corrupti illo aperiam. Autem modi reprehenderit mollitia deleniti?', 'elementor-widgets-direct' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(
			'answere',
			[
				'label' => esc_html__( 'Answere', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'answere...', 'elementor-widgets-direct' ),
				'default' => esc_html__( 'pariatur molestias velit sit, corrupti illo aperiam. Autem modi reprehenderit mollitia deleniti?', 'elementor-widgets-direct' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$repeater->add_control(

			'gallery',
			[
				'label' => esc_html__( 'Add Images', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::GALLERY,
				'default' => [
					[
						'id' => 0,
						'url' => 'https://picsum.photos/600/360?random=1'
					],
					[
						'id' => 1,
						'url' => 'https://picsum.photos/600/360?random=2'
					],
					[
						'id' => 2,
						'url' => 'https://picsum.photos/600/360?random=3'
					],
					[
						'id' => 3,
						'url' => 'https://picsum.photos/600/360?random=4'
					],
					[
						'id' => 4,
						'url' => 'https://picsum.photos/600/360?random=5'
					],
					[
						'id' => 5,
						'url' => 'https://picsum.photos/600/360?random=6'
					],
					[
						'id' => 6,
						'url' => 'https://picsum.photos/600/360?random=7'
					],
					[
						'id' => 7,
						'url' => 'https://picsum.photos/600/360?random=8'
					],
				]
			]

		);

		$repeater->add_control(

			'item_description',
			[
				'label' => esc_html__( 'Description', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'rows' => 10,
				'default' => esc_html__( 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus ipsum nemo pariatur molestias velit sit excepturi consequuntur cupiditate optio sequi, recusandae sunt, corrupti illo aperiam. Autem modi reprehenderit mollitia deleniti?', 'elementor-widgets-direct' ),
				'placeholder' => esc_html__( 'Type your description here', 'elementor-widgets-direct' ),
			]

		);

		$repeater->add_control(
			'filter',
			[
				'label' => esc_html__( 'Filter_id', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'filter1', 'elementor-widgets-direct' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		/* End repeater */

		$this->add_control(
			'faq_items',
			[
				'label' => esc_html__( 'FAQ Items', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),           /* Use our repeater */
				'default' => [
					[
						'question' => esc_html__( 'corrupti illo aperiam. Autem modi reprehenderit mollitia deleniti?', 'elementor-widgets-direct' ),
						'answere' => esc_html__( 'pariatur molestias velit sit, corrupti illo aperiam. Autem modi reprehenderit mollitia deleniti?', 'elementor-widgets-direct' ),
						'gallery' => [
							[
								'id' => 0,
								'url' => 'https://picsum.photos/600/360?random=1'
							],
							[
								'id' => 1,
								'url' => 'https://picsum.photos/600/360?random=2'
							],
							[
								'id' => 2,
								'url' => 'https://picsum.photos/600/360?random=3'
							],
							[
								'id' => 3,
								'url' => 'https://picsum.photos/600/360?random=4'
							],
							[
								'id' => 4,
								'url' => 'https://picsum.photos/600/360?random=5'
							],
							[
								'id' => 5,
								'url' => 'https://picsum.photos/600/360?random=6'
							],
							[
								'id' => 6,
								'url' => 'https://picsum.photos/600/360?random=7'
							],
							[
								'id' => 7,
								'url' => 'https://picsum.photos/600/360?random=8'
							],
						],
						'item_description' => esc_html__('Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusamus ipsum nemo pariatur molestias velit sit excepturi consequuntur cupiditate optio sequi, recusandae sunt, corrupti illo aperiam. Autem modi reprehenderit mollitia deleniti?','elementor-widgets-direct')
					],
				],
				'title_field' => '{{{ question }}}',
			]
		);

		/* Start Second repeater */

		$second_repeater = new \Elementor\Repeater();

		$second_repeater->add_control(
			'filter_title',
			[
				'label' => esc_html__( 'Question', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'question...', 'elementor-widgets-direct' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$second_repeater->add_control(
			'filter_class',
			[
				'label' => esc_html__( 'Question', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'question...', 'elementor-widgets-direct' ),
				'label_block' => true,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		/* End Second repeater */

		$this->add_control(
			'faq_filters',
			[
				'label' => esc_html__( 'FAQ Items', 'elementor-widgets-direct' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $second_repeater->get_controls(),           /* Use our repeater */
				'title_field' => '{{{ filter_title }}}',
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

		?><div class="faq-filters"><?php
		foreach ( $settings['faq_filters'] as $index => $item ) {

			$filter_title = $settings['faq_filters'][$index]['filter_title'];
			$filter_class = $settings['faq_filters'][$index]['filter_class'];

			?>
                <div class="faq-filter">
                    <a href="#" class="<?php echo $filter_class; ?> "><i class="fa fa-circle"></i><?php echo $filter_title; ?></a>
                </div>
            
			<?php
			

		}
		?></div><?php

		foreach ( $settings['faq_items'] as $index => $item ) { 

			$question = $settings['faq_items'][$index]['question'];
			$answere = $settings['faq_items'][$index]['answere'];
			$item_description = $settings['faq_items'][$index]['item_description'];
			$gallery = $settings['faq_items'][$index]['gallery'];

			$filter = $settings['faq_items'][$index]['filter'];

		?>


            <div class="faq-container <?php echo $filter; ?>">

                <div class="faq-item">

                    <div class="faq-icons">
                        <i class="fa fa-question"></i>
                        <i class="fa fa-plus"></i>
                    </div>

                    <div class="faq-content">

                        <div class="questoin">
                            <i class="fa fa-question"></i>
                            <div><?php echo $question; ?></div>
                            <i class="fa fa-plus"></i>
                        </div>

                        <div class="answer">
                            <div class="show-question">
                                <i class="fa fa-question"></i>
                                <p>
                                   <?php echo $answere; ?>
                                </p>
                            </div>
                            <div class="about-box-slider">
                    
                                <div class="slider slider-faq">

									<?php foreach ( $gallery as $image ) { ?>
										<div>
											<div>
												<a href="<?php echo esc_attr( $image['url'] ); ?>" class="fresco" data-fresco-group="second-slider">
													<img src="<?php echo esc_attr( $image['url'] ); ?>">
												</a>
											</div>
										</div>
									<?php } ?>
            
                                </div>
            
                                <div class="slider slider-nav-faq">

									<?php foreach ( $gallery as $image ) { ?>
										<div>
                                        	<div><img src="<?php echo esc_attr( $image['url'] ); ?>"></div>
                                    	</div>
									<?php } ?>
            
                                </div>

                                <p><?php echo $item_description; ?></p>
                
                            </div>

                        </div>

                    </div>

                </div>

            </div>
  <?php }


	}
}