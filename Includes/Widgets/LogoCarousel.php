<?php

namespace CodeNestVentures\SchoolAddon\Widgets;

use Elementor\{
	Controls_Manager,
	Repeater,
	Widget_Base,
	Utils
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class LogoCarousel
 * @package CodeNestVentures\SchoolAddon\Widgets
 */
class LogoCarousel extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Logo Carousel widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'cnv-logo-carousel';
	}

	/**
	 * Get widget title.
	 * Retrieve Logo Carousel widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return esc_html__( 'CNV Logo Carousel', 'cnv-school-addon' );
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
			'section_logo',
			[
				'label' => esc_html__( 'Logo Carousel', 'cnv-school-addon' ),
			]
		);

		$this->add_control( 'layout', [
			'type'    => Controls_Manager::SELECT,
			'label'   => __( 'Layout', 'cnv-school-addon' ),
			'default' => 'style-one',
			'options' => [
				'style-one' => __( 'Style One', 'cnv-school-addon' ),
				'style-two' => __( 'Style Two', 'cnv-school-addon' ),
			],
		] );

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Logo', 'cnv-school-addon' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],

			]
		);

		$repeater->add_control(
			'link',
			[
				'label'         => __( 'Link', 'cnv-school-addon' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'cnv-school-addon' ),
				'show_external' => true,
				'default'       => [
					'url'         => '#',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);

		$repeater->add_control(
			'name',
			[
				'label'       => __( 'Title', 'cnv-school-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Brand Name', 'cnv-school-addon' ),
				'placeholder' => __( 'Type brand name here', 'cnv-school-addon' ),
			]
		);


		$this->add_control(
			'logos',
			[
				'label'       => __( 'Logo List', 'cnv-school-addon' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'name'  => __( 'Brand Name', 'cnv-school-addon' )

					],
					[
						'image' => [
							'url'  => Utils::get_placeholder_image_src(),
							'name' => __( 'Brand Name', 'cnv-school-addon' )
						]
					],
					[
						'image' => [
							'url'  => Utils::get_placeholder_image_src(),
							'name' => __( 'Brand Name', 'cnv-school-addon' )
						]
					],
					[
						'image' => [
							'url'  => Utils::get_placeholder_image_src(),
							'name' => __( 'Brand Name', 'cnv-school-addon' )
						]
					],
					[
						'image' => [
							'url'  => Utils::get_placeholder_image_src(),
							'name' => __( 'Brand Name', 'cnv-school-addon' )
						]
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->end_controls_section();


		// Slider Control
		//=====================
		$this->start_controls_section( 'settingd_section', [
			'label' => esc_html__( 'Slider Control', 'cnv-school-addon' ),
		] );

		// Enable Marquee Effect
		$this->add_control(
			'marquee',
			[
				'label'        => esc_html__( 'Marquee', 'cnv-school-addon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cnv-school-addon' ),
				'label_off'    => esc_html__( 'Off', 'cnv-school-addon' ),
				'return_value' => 'yes',
				'default'      => 'no'
			]
		);

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
			'rtl_mode',
			[
				'label'        => esc_html__( 'RTL On/Off', 'cnv-school-addon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cnv-school-addon' ),
				'label_off'    => esc_html__( 'Off', 'cnv-school-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
				'condition'    => [
					'marquee' => 'yes'
				]
			]
		);

		$this->add_control(
			'perview',
			[
				'label'   => __( 'Desktop Per View', 'cnv-school-addon' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5,
			]
		);

		$this->add_control(
			'perview_tablet',
			[
				'label'   => __( 'Tablet Per View', 'cnv-school-addon' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 3,
			]
		);

		$this->add_control(
			'perview_mobile',
			[
				'label'   => __( 'Mobile Per View', 'cnv-school-addon' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 2,
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
				'default' => 700,
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

	}

	/**
	 * Render Logo Carousel widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();
		$logos    = $settings['logos'];

		$this->add_render_attribute( 'container', 'class', [
			'swiper-container',
			'cnv-client-logo',
		] );
		$this->add_render_attribute( 'wrapper', 'class', 'cnv-logo-carousel' );

		if ( $settings['layout'] == 'style-two' ) {
			$this->add_render_attribute( 'wrapper', 'class', 'cnv-client-logo--marquee' );

			if( $settings['rtl_mode'] == 'yes') {
				$this->add_render_attribute( 'wrapper', 'dir', 'rtl' );
			}

		}

		$slider_options = $this->get_slider_options( $settings );
		$json = str_replace('"','', (string) wp_json_encode( $slider_options ) );

		$this->add_render_attribute( 'container', 'data-logo', wp_json_encode( $slider_options ) );
		?>

		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( ! empty( $settings['navigation'] == 'yes' ) ) : ?>
				<div class="logo-prev slider-nav">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="14" viewBox="0 0 18 14" fill="none">
						<path
							d="M0.46967 5.46967C0.176777 5.76256 0.176777 6.23744 0.46967 6.53033L5.24264 11.3033C5.53553 11.5962 6.01041 11.5962 6.3033 11.3033C6.59619 11.0104 6.59619 10.5355 6.3033 10.2426L2.06066 6L6.3033 1.75736C6.59619 1.46447 6.59619 0.989593 6.3033 0.696699C6.01041 0.403806 5.53553 0.403806 5.24264 0.696699L0.46967 5.46967ZM1 6.75H18V5.25H1V6.75Z"
							fill="black"/>
					</svg>
				</div>
			<?php endif; ?>
			<div <?php $this->print_render_attribute_string( 'container' ); ?>>
				<div class="swiper-wrapper">
					<?php if ( is_array( $logos ) ) :
						foreach ( $logos as $logo ) : ?>
							<?php if ( $logo['image'] != '' ) {
								$img = $logo['image']['url'];
							} ?>
							<div class="swiper-slide">
								<div class="client-logo text-center" title="<?php echo esc_attr( $logo['name'] ); ?>">
									<?php if ( ! empty( $img ) ): ?>
										<?php if ( ! empty( $logo['link']['url'] ) ) : ?>
											<a href="<?php echo esc_url( $logo['link']['url'] ); ?>">
										<?php endif; ?>
										<img src="<?php echo esc_url( $img ) ?>" alt="<?php echo esc_attr__( 'Brand logo', 'cnv-school-addon' ) ?>">
										<?php if ( ! empty( $logo['link']['url'] ) ) : ?>
											</a>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
							<!-- /.swiper-slide -->
						<?php
						endforeach;
					endif;
					?>
				</div>
				<!-- /.swiper-wrapper -->
			</div>
			<!-- /.swiper-container -->

			<?php if ( ! empty( $settings['navigation'] == 'yes' ) ) : ?>
				<div class="logo-next slider-nav">
					<svg xmlns="http://www.w3.org/2000/svg" width="18" height="12" viewBox="0 0 18 12" fill="none">
						<path
							d="M17.5303 6.53033C17.8232 6.23744 17.8232 5.76256 17.5303 5.46967L12.7574 0.6967C12.4645 0.403806 11.9896 0.403806 11.6967 0.6967C11.4038 0.989593 11.4038 1.46447 11.6967 1.75736L15.9393 6L11.6967 10.2426C11.4038 10.5355 11.4038 11.0104 11.6967 11.3033C11.9896 11.5962 12.4645 11.5962 12.7574 11.3033L17.5303 6.53033ZM17 5.25L-6.55671e-08 5.25L6.55671e-08 6.75L17 6.75L17 5.25Z"
							fill="black"/>
					</svg>
				</div>
			<?php endif; ?>
		</div>
		<!-- /.at-logo-carousel -->
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

		// Per View.

		$slider_options['breakpoints'] = [
			'992' => [
				'slidesPerView' => $settings['perview'],
				'spaceBetween'  => '30'
			],

			'620' => [
				'slidesPerView' => $settings['perview_tablet'],
				'spaceBetween'  => '30'
			],

			'320' => [
				'slidesPerView' => $settings['perview_mobile'],
				'spaceBetween'  => '20'
			],
		];


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

		if ( $settings['marquee'] == 'yes' ) {
			$slider_options['allowTouchMove'] = false;
			$slider_options['centeredSlides'] = true;

			$slider_options['autoplay'] = [
				'delay'                => 1,
				'disableOnInteraction' => true
			];
		}

		// Free Mode
		$slider_options['freeMode'] = true;

		// Centered Slides
		$slider_options['centeredSlides'] = true;

		// Slide per view auto
//		$slider_options['slidesPerView'] = 'auto';


		if ( 'yes' == $settings['navigation'] && $settings['marquee'] != 'yes' ) {
			$slider_options['navigation'] = [
				'nextEl' => '.logo-next',
				'prevEl' => '.logo-prev'
			];
		}

		return $slider_options;
	}
}