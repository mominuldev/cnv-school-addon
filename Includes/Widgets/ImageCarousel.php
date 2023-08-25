<?php

namespace CodeNestVentures\SchoolAddon\Widgets;

use Elementor\{Controls_Manager, Group_Control_Typography, Repeater, Widget_Base, Utils};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class LogoCarousel
 * @package CodeNestVentures\SchoolAddon\Widgets
 */
class ImageCarousel extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Logo Carousel widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'rbt-image-carousel';
	}

	/**
	 * Get widget title.
	 * Retrieve Logo Carousel widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return esc_html__( 'CNV Image Carousel', 'cnv-school-addon' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Logo Carousel widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-carousel';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the Logo Carousel widget belongs to.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'cnv-elements' ];
	}

	/**
	 * Register Logo Carousel widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section(
			'section_image-slider',
			[
				'label' => esc_html__( 'Image Carousel', 'cnv-school-addon' ),
			]
		);


		$repeater = new Repeater();

		$repeater->add_control(
			'image-one',
			[
				'label'   => __( 'Image One', 'cnv-school-addon' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);

		$repeater->add_control(
			'image-two',
			[
				'label'   => __( 'Image Two', 'cnv-school-addon' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);

		$repeater->add_control(
			'image-three',
			[
				'label'   => __( 'Image Three', 'cnv-school-addon' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);

		$repeater->add_control(
			'title',
			[
				'label'       => __( 'Title', 'cnv-school-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Brand Name', 'cnv-school-addon' ),
				'placeholder' => __( 'Type brand name here', 'cnv-school-addon' ),
			]
		);


		$this->add_control(
			'images',
			[
				'label'       => __( 'Image List', 'cnv-school-addon' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'image-one' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'title-one'  => __( 'Quiet slide -1', 'cnv-school-addon' ),
						'image-two' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'title-two'  => __( 'Quiet slide -2', 'cnv-school-addon' ),
						'image-three' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'title-three'  => __( 'Quiet slide -3', 'cnv-school-addon' )

					],
					[
						'image-one' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'title-one'  => __( 'Quiet slide -1', 'cnv-school-addon' ),
						'image-two' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'title-two'  => __( 'Quiet slide -2', 'cnv-school-addon' ),
						'image-three' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'title-three'  => __( 'Quiet slide -3', 'cnv-school-addon' )
					],
					[
						'image-one' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'title-one'  => __( 'Quiet slide -1', 'cnv-school-addon' ),
						'image-two' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'title-two'  => __( 'Quiet slide -2', 'cnv-school-addon' ),
						'image-three' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'title-three'  => __( 'Quiet slide -3', 'cnv-school-addon' )
					],

				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();


		// Slider Control
		//=====================
		$this->start_controls_section( 'settingd_section', [
			'label' => esc_html__( 'Slider Control', 'cnv-school-addon' ),
		] );

		// Navigation
		$this->add_control(
			'navigation',
			[
				'label'        => esc_html__( 'Navigation', 'cnv-school-addon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cnv-school-addon' ),
				'label_off'    => esc_html__( 'Off', 'cnv-school-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'marquee!' => 'yes'
				]
			]
		);


		$this->add_control(
			'loop',
			[
				'label'        => esc_html__( 'Loop', 'cnv-school-addon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cnv-school-addon' ),
				'label_off'    => esc_html__( 'Off', 'cnv-school-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => __( 'Speed', 'cnv-school-addon' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 1000,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'        => esc_html__( 'Autoplay', 'cnv-school-addon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cnv-school-addon' ),
				'label_off'    => esc_html__( 'Off', 'cnv-school-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition'    => [
					'marquee!' => 'yes'
				]
			]
		);

		$this->add_control(
			'autoplay_time',
			[
				'label'     => __( 'Autoplay Time', 'cnv-school-addon' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 9000,
				'condition' => [
					'marquee!' => 'yes'
				]
			]
		);

		$this->end_controls_section();

		// Style Tab
		//=====================
		$this->start_controls_section( 'style_section', [
			'label' => esc_html__( 'Style', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		// Title
		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
				'selectors' => [
					'{{WRAPPER}} .rbt-image-carousel-title' => 'color: {{VALUE}}',
				],
			]
		);

		// Title typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .rbt-image-carousel-title',
			]
		);

		// Title Spacing
		$this->add_responsive_control(
			'title_spacing',
			[
				'label'      => __( 'Title Spacing', 'cnv-school-addon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', '%' ],
				'default'    => [
					'size' => 33,
				],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 10,
						'step' => 0.1,
					],
					'%'  => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .rbt-image-carousel-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Progress Bar
		//=====================
		$this->start_controls_section( 'progress_bar_section', [
			'label' => esc_html__( 'Progress Bar', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control(
			'progress_bar_color',
			[
				'label'     => __( 'Progress Bar Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-progress-bar' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'progress_bar_height',
			[
				'label'     => __( 'Progress Bar Height', 'cnv-school-addon' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 4,
				'selectors' => [
					'{{WRAPPER}} .swiper-progress-bar' => 'height: {{VALUE}}px',
				],
			]
		);

		// Active Progress Bar
		$this->add_control(
			'progress_bar_active_color',
			[
				'label'     => __( 'Active Progress Bar Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-progress-bar:after' => 'background: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'progress_bar_border_radius',
			[
				'label'     => __( 'Progress Bar Border Radius', 'cnv-school-addon' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 0,
				'selectors' => [
					'{{WRAPPER}} .slide_progress-bar' => 'border-radius: {{VALUE}}px',
				],
			]
		);

		// End Progress Bar
		//=====================
		$this->end_controls_section();


	}

	/**
	 * Render Logo Carousel widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$images    = $settings['images'];

		$this->add_render_attribute( 'container', 'class', [
			'swiper-container',
			'rbt-image-slider',
		] );
		$this->add_render_attribute( 'wrapper', 'class', 'rbt-image-carousel-wrapper' );


		$slider_options = $this->get_slider_options( $settings );
		$json = str_replace('"','', (string) wp_json_encode( $slider_options ) );

		$this->add_render_attribute( 'container', 'data-image-slider', wp_json_encode( $slider_options ) );
		?>

		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( ! empty( $settings['navigation'] == 'yes' ) ) : ?>
				<div class="image-slider-prev slider-nav">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
						<path d="M0.46967 5.46967C0.176777 5.76256 0.176777 6.23744 0.46967 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.46967 5.46967ZM1 6.75H18V5.25H1V6.75Z"
							fill="black"/>
					</svg>
				</div>
			<?php endif; ?>
			<div <?php $this->print_render_attribute_string( 'container' ); ?>>
				<div class="swiper-wrapper">
					<?php if ( is_array( $images ) ) :
						foreach ( $images as $item ) : ?>
							<div class="swiper-slide">
								<div class="row">
									<div class="col-lg-3 align-self-end">
										<div class="rbt-slider-image">
											<?php if( ! empty( $item['title-one'] )) : ?>
												<h3 class="rbt-image-carousel-title"><?php echo esc_html( $item['title-one'] ); ?></h3>
											<?php endif; ?>

											<?php if ( ! empty( $item['image-one']['url'] ) ): ?>
												<img src="<?php echo esc_url($item['image-one']['url']) ?>" alt="<?php echo esc_attr($item['title-one']); ?>" width="400" height="440">
											<?php endif; ?>
										</div>
									</div>

									<div class="col-lg-6">
										<div class="rbt-slider-image sbt-slider-image--center">
											<?php if( ! empty( $item['title-two'] )) : ?>
												<h3 class="rbt-image-carousel-title"><?php echo esc_html( $item['title-two'] ); ?></h3>
											<?php endif; ?>

											<?php if ( ! empty( $item['image-two']['url'] ) ): ?>
												<img src="<?php echo esc_url( $item['image-two']['url'] ) ?>" alt="<?php echo esc_attr( $item['title-two']) ?>" width="465" height="540">
											<?php endif; ?>
										</div>
									</div>

									<div class="col-lg-3">
										<div class="rbt-slider-image">
											<?php if( ! empty( $item['title-three'] )) : ?>
												<h3 class="rbt-image-carousel-title"><?php echo esc_html( $item['title-three'] ); ?></h3>
											<?php endif; ?>

											<?php if ( ! empty( $item['image-three']['url']) ): ?>
												<img src="<?php echo esc_url( $item['image-three']['url'] ) ?>" alt="<?php echo esc_attr( $item['title-three']) ?>">
											<?php endif; ?>
										</div>
									</div>
								</div>


							</div>
							<!-- /.swiper-slide -->
						<?php
						endforeach;
					endif;
					?>
				</div>


				<!-- Progressbar -->
				<div class="swiper-progress-bar-wrapper">
					<span class="js-current-slide">1</span>
					<span class="swiper-progress-bar">

					</span>
					<span class="js-all-slide">1</span>
				</div>

			</div>
			<!-- /.swiper-container -->

			<?php if ( ! empty( $settings['navigation'] == 'yes' ) ) : ?>
				<div class="image-slider-next slider-nav">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none">
						<path
							d="M17.5303 6.53033C17.8232 6.23744 17.8232 5.76256 17.5303 5.46967L12.7574 0.6967C12.4645 0.403806 11.9896 0.403806 11.6967 0.6967C11.4038 0.989593 11.4038 1.46447 11.6967 1.75736L15.9393 6L11.6967 10.2426C11.4038 10.5355 11.4038 11.0104 11.6967 11.3033C11.9896 11.5962 12.4645 11.5962 12.7574 11.3033L17.5303 6.53033ZM17 5.25L-6.55671e-08 5.25L6.55671e-08 6.75L17 6.75L17 5.25Z"
							fill="black"/>
					</svg>
				</div>
			<?php endif; ?>
		</div>
		<!-- /.at-image-slider-carousel -->
		<?php
	}

	/**
	 * Render Logo Carousel widget output in the editor.
	 * Written as a Backbone JavaScript template and used to generate the live preview.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function content_template() {
	}

	/**
	 * Get slider options.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function get_slider_options( array $settings ) {

		$slider_options['spaceBetween'] = 50;


		// Loop
		if ( $settings['loop'] == 'yes' ) {
			$slider_options['loop'] = true;
		}

		// Speed
		if ( ! empty( $settings['speed'] ) ) {
			$slider_options['speed'] = $settings['speed'];
		}

		// Auto Play
		if ( $settings['autoplay'] == 'yes' ) {
			$slider_options['autoplay'] = [
				'delay' => $settings['autoplay_time'],
//				'disableOnInteraction' => false
			];
		} else {
			$slider_options['autoplay'] = [
				'delay' => '99999999999',
			];
		}

		if ( 'yes' == $settings['navigation'] && $settings['marquee'] != 'yes' ) {
			$slider_options['navigation'] = [
				'nextEl' => '.image-slider-next',
				'prevEl' => '.image-slider-prev'
			];
		}

		// Pagination

			$slider_options['pagination'] = [
				'el'        => '.swiper-pagination',
				'type' => 'progressbar',
			];

		$slider_options['watchSlidesProgress'] = true;
		$slider_options['watchSlidesVisibility'] = true;
		$slider_options['roundLengths'] = true;



		return $slider_options;
	}
}