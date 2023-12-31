<?php
namespace CodeNestVentures\SchoolAddon\Widgets;

use Elementor\{Controls_Manager,
	Group_Control_Background,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
	Repeater,
	Utils
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Testimonial
 * @package CodeNestVentures\SchoolAddon\Widgets
 */
class Testimonial extends Widget_Base {

	public function get_name() {
		return 'cnv-testimonial';
	}

	public function get_title() {
		return esc_html__( 'CNV Testimonial', 'cnv-school-addon' );
	}

	public function get_icon() {
		return 'eicon-testimonial';
	}

	public function get_categories() {
		return [ 'cnv-elements' ];
	}

	protected function register_controls() {
		// Testimonial
		//=========================
		$this->start_controls_section( 'section_tab_style', [
			'label' => esc_html__( 'Testimonial', 'cnv-school-addon' ),
		] );

		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'cnv-school-addon' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'one' => esc_html__( 'Layout 1', 'cnv-school-addon' ),
				'two' => esc_html__( 'Layout 2', 'cnv-school-addon' ),
			],
			'default' => 'one',
		] );

		$this->add_control( 'enable_separator', [
			'label'        => esc_html__( 'Show Separator', 'cnv-school-addon' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'cnv-school-addon' ),
			'label_off'    => esc_html__( 'Hide', 'cnv-school-addon' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		// Separator space
		$this->add_responsive_control( 'separator_space', [
			'label'      => esc_html__( 'Separator Space', 'cnv-school-addon' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
				'em' => [
					'min' => 0,
					'max' => 10,
				],
				'%'  => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .testimonial-separator' => 'margin-top: {{SIZE}}{{UNIT}}; margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		// Separator color
		$this->add_control( 'separator_color', [
			'label'     => esc_html__( 'Separator Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial-separator' => 'border-color: {{VALUE}};',
			],
			'condition' => [
				'enable_separator' => 'yes'
			]
		] );


		$repeater = new Repeater();


		$repeater->add_control( 'image', [
			'label'   => __( 'Author Image', 'cnv-school-addon' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			]
		] );

		$repeater->add_control( 'name', [
			'label'       => __( 'Name', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Mominul', 'cnv-school-addon' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'designation', [
			'label'       => __( 'Designation', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Full-Stack Developer', 'cnv-school-addon' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'rating', [
			'label'   => __( 'Rating Number', 'cnv-school-addon' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'default' => '50',
			'options' => [
				'10' => __( '1 Star', 'cnv-school-addon' ),
				'20' => __( '2 Star', 'cnv-school-addon' ),
				'30' => __( '3 Star', 'cnv-school-addon' ),
				'40' => __( '4 Star', 'cnv-school-addon' ),
				'50' => __( '5 Star', 'cnv-school-addon' ),
			],
		] );

		$repeater->add_control( 'review_content', [
			'label'      => __( 'Review Content', 'cnv-school-addon' ),
			'type'       => Controls_Manager::TEXTAREA,
			'default'    => __( '“If you need any help or assistance we\'d be happy to help. Just reply to this email. Trusted by Agency proud to work many well known brands”', 'cnv-school-addon' ),
			'show_label' => false,
		] );


		$this->add_control( 'testimonials', [
			'label'       => __( 'Testimonial Items', 'cnv-school-addon' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'image'          => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'name'           => __( 'Alexa Loverty', 'cnv-school-addon' ),
					'designation'    => __( 'Product Designer', 'cnv-school-addon' ),
					'review_content' => __( 'Pellentesque nec nam aliquam sem. Ultricies lacus sed turpis tincidunt id aliquet risus. Consequat nisl vel pretium lectus quam id. Velit scelerisque in dictum non of the ntconsectetur.', 'cnv-school-addon' ),
				],
				[
					'image'          => [
						'url' => Utils::get_placeholder_image_src( 'hexa_testimonial_three' ),
					],
					'name'           => __( 'Maxine Butler', 'cnv-school-addon' ),
					'designation'    => __( 'Product Designer', 'cnv-school-addon' ),
					'review_content' => __( 'Pellentesque nec nam aliquam sem. Ultricies lacus sed turpis tincidunt id aliquet risus. Consequat nisl vel pretium lectus quam id. Velit scelerisque in dictum non of the ntconsectetur.', 'cnv-school-addon' ),
				],
			],
			'title_field' => '{{{ name }}}',
		] );

		$this->end_controls_section();

		// Slider Control
		//=====================
		$this->start_controls_section( 'settingd_section', [
			'label' => esc_html__( 'Slider Control', 'cnv-school-addon' ),
		] );

		$this->add_control(
			'slides_per_view',
			[
				'label'   => esc_html__( 'Slider Per View', 'cnv-school-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '2',
				'options' => [
					'1' => esc_html__( '1', 'cnv-school-addon' ),
					'2' => esc_html__( '2', 'cnv-school-addon' ),
					'3' => esc_html__( '3', 'cnv-school-addon' ),
				],
			]
		);

		$this->add_control( 'navigation', [
			'label'        => esc_html__( 'Navigation', 'cnv-school-addon' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'cnv-school-addon' ),
			'label_off'    => esc_html__( 'Hide', 'cnv-school-addon' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		$this->add_control( 'pagination', [
			'label'        => esc_html__( 'Pagination', 'cnv-school-addon' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Show', 'cnv-school-addon' ),
			'label_off'    => esc_html__( 'Hide', 'cnv-school-addon' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		$this->add_control( 'centered_slides', [
			'label'        => esc_html__( 'Center Slide', 'cnv-school-addon' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'Yes', 'cnv-school-addon' ),
			'label_off'    => esc_html__( 'No', 'cnv-school-addon' ),
			'return_value' => 'yes',
			'default'      => 'no'
		] );


		$this->add_control( 'loop', [
			'label'        => esc_html__( 'Loop', 'cnv-school-addon' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'cnv-school-addon' ),
			'label_off'    => esc_html__( 'Off', 'cnv-school-addon' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		$this->add_control( 'speed', [
			'label'   => __( 'Speed', 'cnv-school-addon' ),
			'type'    => Controls_Manager::NUMBER,
			'default' => 700,
		] );

		$this->add_control( 'autoplay', [
			'label'        => esc_html__( 'Autoplay', 'cnv-school-addon' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => esc_html__( 'On', 'cnv-school-addon' ),
			'label_off'    => esc_html__( 'Off', 'cnv-school-addon' ),
			'return_value' => 'yes',
			'default'      => 'yes'
		] );

		$this->add_control( 'autoplay_time', [
			'label'     => __( 'Autoplay Time', 'cnv-school-addon' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 9000,
			'condition' => [
				'autoplay' => 'yes'
			]
		] );

		// Space Between
		$this->add_control(
			'space_between',
			[
				'label'   => esc_html__( 'Space Between', 'textdomain' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'min'     => 0,
				'max'     => 100,
				'step'    => 1,
				'default' => 30,
			]
		);

		$this->end_controls_section();


		// Style Sections
		//=====================

		// Avatar Style
		//=====================
		$this->start_controls_section( 'avatar_section', [
			'label'     => __( 'Avatar', 'cnv-school-addon' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'layout' => '2'
			]
		] );

		$this->add_control(
			'avatar_spacing',
			[
				'label'      => esc_html__( 'Spacing (Margin Bottom)', 'cnv-school-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 150,
					],
				],
				'default'    => [
					'unit' => 'px',
					'size' => 40,
				],

				'selectors' => [
					'{{WRAPPER}} .testimonial-fade .avatar' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'avatar_padding',
			[
				'label'      => esc_html__( 'Padding', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-fade .avatar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'avatar_border',
				'selector' => '{{WRAPPER}} .cnv-testimonial-wrapper-two .swiper-slide.swiper-slide-active .testimonial-fade .avatar',
			]
		);


		$this->end_controls_section();

		// Name Style
		//=====================
		$this->start_controls_section( 'name_section', [
			'label' => __( 'Name', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .name',
		] );

		$this->add_control( 'name_color', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .name' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Designation Style
		//=====================
		$this->start_controls_section( 'designation_section', [
			'label' => __( 'Designation', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'desi_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .designation',
		] );

		$this->add_control( 'desi_color', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .designation' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Separator

		//=====================
		$this->start_controls_section( 'separator_style_section', [
			'label' => __( 'Separator', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

			$this->add_control( 'sep_color', [
				'label'     => __( 'Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .testimonial-separator' => 'border-bottom-color: {{VALUE}}',
				],
			] );


		$this->end_controls_section();

		// Style Review Content
		//=========================
		$this->start_controls_section( 'review_section', [
			'label' => __( 'Review Content', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'review_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .testimonial p',
		] );

		$this->add_control( 'review_color', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial p' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();

		// Style Slider Control Section
		//================================
		$this->start_controls_section( 'control_section', [
			'label' => __( 'Slider  Control', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );


		$this->add_control(
			'nav_width',
			[
				'label'      => esc_html__( 'Nav Height/Width', 'cnv-school-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 20,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'nav_font_size',
			[
				'label'      => esc_html__( 'Nav Font Size', 'cnv-school-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min' => 10,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]

		);

		$this->add_control(
			'nav_border_radius',
			[
				'label'      => esc_html__( 'Nav Border Radius', 'cnv-school-addon' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em' ],
				'range'      => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
					'em' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs( 'tabs_nav_style' );
		$this->start_controls_tab(
			'tab_nav_normal',
			[
				'label' => __( 'Normal', 'cnv-school-addon' ),
			]
		);

		$this->add_control( 'slider_nav_color', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_bg_color', [
			'label'     => __( 'Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'slider_control_border',
				'selector' => '{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'nav_box_shadow',
				'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .testimonial-prev, {{WRAPPER}} .testimonial-next',
			]
		);

		$this->add_control( 'pagination_bg_color', [
			'label'     => __( 'Pagination BG Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background: {{VALUE}}',
			],
			'separator' => 'before',
		] );

		$this->end_controls_tab();


		$this->start_controls_tab(
			'tab_nav_hover',
			[
				'label' => __( 'Hover', 'cnv-school-addon' ),
			]
		);

		$this->add_control( 'nav_color_hover', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial-prev:hover, {{WRAPPER}} .testimonial-next:hover' => 'color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_color_bg_hover', [
			'label'     => __( 'Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial-prev:hover, {{WRAPPER}} .testimonial-next:hover' => 'background-color: {{VALUE}}',
			],
		] );

		$this->add_control( 'nav_control_hover', [
			'label'     => __( 'Border Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .testimonial-prev:hover, {{WRAPPER}} .testimonial-next:hover' => 'border-color: {{VALUE}}',
			],
		] );

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'nav_box_shadow_hover',
				'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .testimonial-prev:hover, {{WRAPPER}} .testimonial-next:hover',
			]
		);

		$this->add_control( 'slider_pagination_active_color', [
			'label'     => __( 'Pagination Active BG Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet:before' => 'background: {{VALUE}}',
			],
			'separator' => 'before',
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Style Slider Control Section
		//================================
		$this->start_controls_section( 'testimonial_section', [
			'label' => __( 'Testimonial Container', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'testimonial_background',
				'label'    => __( 'Background', 'cnv-school-addon' ),
				'types'    => [ 'classic', 'gradient' ],
				'exclude'  => [ 'image' ],
				'selector' => '{{WRAPPER}} .testimonial',
			]
		);

		$this->add_control(
			'testimonial_padding',
			[
				'label'      => __( 'Padding', 'cnv-school-addon' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'testimonial_border_radius',
			[
				'label'      => __( 'Padding', 'cnv-school-addon' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .testimonial' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'testimonial_shadow_hover',
				'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .testimonial',
			]
		);

		// Overflow
		$this->add_control(
			'testimonial_overflow',
			[
				'label'        => __( 'Overflow', 'cnv-school-addon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cnv-school-addon' ),
				'label_off'    => __( 'Hide', 'cnv-school-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'separator'    => 'before',
				'selectors'    => [
					'{{WRAPPER}} .cnv-testimonial' => 'overflow: visible !important;',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {

		$settings     = $this->get_settings_for_display();
		$testimonials = $settings['testimonials'];


		$this->add_render_attribute( 'wrapper', 'class', [
			'swiper-container',
			'cnv-testimonial',
		] );

		// Testimonial Style
		$this->add_render_attribute( 'testimonial', 'class', 'testimonial' );
		if( ! empty( $settings['layout'] ) ) {
			// Layout
			$this->add_render_attribute( 'wrapper', 'class', 'cnv-testimonial--' . $settings['layout'] );
			$this->add_render_attribute( 'testimonial', 'class', 'testimonial--' . $settings['layout'] );
		}

		$slider_options = $this->get_slider_options( $settings );
		$this->add_render_attribute( 'wrapper', 'data-testi', wp_json_encode( $slider_options ) );


		require __DIR__ . '/templates/testimonial/layout-' . $settings['layout'] . '.php';

	}

	protected function get_slider_options( array $settings ) {

		// Loop
		if ( $settings['loop'] == 'yes' ) {
			$slider_options['loop'] = true;
		}

		// Speed
		if ( ! empty( $settings['speed'] ) ) {
			$slider_options['speed'] = $settings['speed'];

		}

		// Centered Slides
		if( $settings['centered_slides'] == 'yes' ) {
			$slider_options['centeredSlides'] = true;
		}

		// Space Between
//        if ( ! empty( $settings['space_between'] ) ) {
//            $slider_options['spaceBetween'] = $settings['space_between'];
//        }


		// Breakpoints
		$slider_options['breakpoints'] = [
			'1024' => [
				'slidesPerView' => $settings['slides_per_view'],
				'spaceBetween'  => $settings['space_between'],
			],
			'991'  => [
				'slidesPerView' => 1,
				'spaceBetween'  => $settings['space_between'],
			],

			'320' => [
				'slidesPerView' => 1,
			],
		];


		// Auto Play
		if ( $settings['autoplay'] == 'yes' ) {
			$slider_options['autoplay'] = [
				'delay'                => $settings['autoplay_time'],
				'disableOnInteraction' => false
			];
		} else {
			$slider_options['autoplay'] = [
				'delay' => '99999999999',
			];
		}

		if ( $settings['navigation'] == 'yes' ) {
			$slider_options['navigation'] = [
				'nextEl' => '.testimonial-next',
				'prevEl' => '.testimonial-prev'
			];
		}

		if ( $settings['pagination'] == 'yes' ) {
			$slider_options['pagination'] = [
				'el'        => '.testimonial-pagination',
				'clickable' => true
			];
		}

		return $slider_options;
	}

}