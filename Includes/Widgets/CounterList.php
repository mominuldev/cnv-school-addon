<?php

namespace CodeNestVentures\SchoolAddon\Widgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use CodeNestVentures\SchoolAddon\IconsPack;
use Elementor\{Controls_Manager,
	Group_Control_Background,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
};


/**
 * Class Counter
 *
 * @package DesignMonks\AkijShipping\Widgets
 */
class CounterList extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve Counter widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'cnv-counter-list';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Counter widget title.
	 *
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_title() {
		return __( 'CNV Counter List', 'cnv-school-addon' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Counter widget icon.
	 *
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_icon() {
		return 'eicon-counter';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the widget categories.
	 *
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_categories() {
		return [ 'cnv-elements' ];
	}

	/**
	 * Get widget keywords.
	 *
	 * Retrieve the widget keywords.
	 *
	 * @return array Widget keywords.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_keywords() {
		return [ 'counter', 'count', 'number' ];
	}

	/**
	 * Get widget script dependences.
	 *
	 * Retrieve the widget script dependences.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	public function get_script_depends() {
		return [
			'countUp',
			'appear-js'
		];
	}

	/**
	 * Register Counter widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section( 'section_content', [
			'label' => __( 'Counter Content', 'cnv-school-addon' ),
		] );

		// Column Control
		$this->add_responsive_control(
			'column',
			[
				'label'          => __( 'Column', 'cnv-school-addon' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'options'        => [
					'3' => __( '4 Column', 'cnv-school-addon' ),
					'4' => __( '3 Column', 'cnv-school-addon' ),
					'6' => __( '2 Column', 'cnv-school-addon' ),
				],
				'selectors'      => [
					'{{WRAPPER}} .cnv-counter-list' => 'width: calc(100% / {{VALUE}});',
				],
			]
		);

		// Repeater for Counter List
		$repeater = new \Elementor\Repeater();

		$repeater->add_control( 'icon_type', [
			'label'       => esc_html__( 'Add Icon/Image', 'cnv-school-addon' ),
			'type'        => Controls_Manager::CHOOSE,
			'label_block' => false,
			'options'     => [
				'none'  => [
					'title' => esc_html__( 'None', 'cnv-school-addon' ),
					'icon'  => 'eicon-ban',
				],
				'icon'  => [
					'title' => esc_html__( 'Icon', 'cnv-school-addon' ),
					'icon'  => 'eicon-paint-brush',
				],
				'image' => [
					'title' => esc_html__( 'Image', 'cnv-school-addon' ),
					'icon'  => 'eicon-image-bold',
				]
			],
			'default'     => 'icon',
		] );

		$repeater->add_control( 'icon_pack', [
			'label'     => esc_html__( 'Icon Pack', 'cnv-school-addon' ),
			'type'      => Controls_Manager::SELECT,
			'options'   => [
				'fontawesome' => esc_html__( 'Fontawesome', 'cnv-school-addon' ),
				'feather'     => esc_html__( 'Feather', 'cnv-school-addon' ),
				'simpleline'  => esc_html__( 'Simple Line', 'cnv-school-addon' ),
			],
			'default'   => 'fontawesome',
			'condition' => [
				'icon_type' => 'icon',
			],
		] );

		$repeater->add_control( 'feather_icon', [
			'label'       => __( 'Choose Icon', 'cnv-school-addon' ),
			'type'        => Controls_Manager::ICON,
			'options'     => IconsPack::cnv_feather_icon(),
			'include'     => IconsPack::cnv_include_feather_icons(),
			'default'     => 'feather-box',
			'condition'   => [
				'icon_pack' => 'feather',
				'icon_type' => 'icon',
			],
			'label_block' => true,
		] );

		$repeater->add_control(
			'selected_icon',
			[
				'label'     => esc_html__( 'Icon', 'cnv-school-addon' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-star',
					'library' => 'solid',
				],
				'condition' => [
					'icon_type' => 'icon',
					'icon_pack' => 'fontawesome',
				]
			]
		);

		$repeater->add_control( 'simpleline_icon', [
			'label'       => __( 'Choose Icon', 'cnv-school-addon' ),
			'type'        => Controls_Manager::ICON,
			'options'     => IconsPack::cnv_simpleline_icons(),
			'include'     => IconsPack::cnv_include_simpleline_icons(),
			'default'     => 'icon-people',
			'condition'   => [
				'icon_pack' => 'simpleline',
				'icon_type' => 'icon',
			],
			'label_block' => true,
		] );

		$repeater->add_control(
			'icon_image',
			[
				'label'     => esc_html__( 'Choose Image', 'cnv-school-addon' ),
				'type'      => \Elementor\Controls_Manager::MEDIA,
				'default'   => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
				'condition' => [
					'icon_type' => 'image'
				]
			]
		);

		$repeater->add_control( 'count_number', [
			'label'       => __( 'Counting Number', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
		] );

		$repeater->add_control( 'suffix_before', [
			'label' => __( 'Suffix Before', 'cnv-school-addon' ),
			'type'  => Controls_Manager::TEXT,
		] );

		$repeater->add_control( 'suffix_after', [
			'label'   => __( 'Suffix After', 'cnv-school-addon' ),
			'type'    => Controls_Manager::TEXT,
			'default' => '+',
		] );

		$repeater->add_control( 'count_title', [
			'label'       => __( 'Title', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'Completed Projects', 'cnv-school-addon' ),
			'label_block' => true,
		] );

		$repeater->add_control( 'count_description', [
			'label'       => __( 'Description', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXTAREA,
			'label_block' => true,
		] );

		// Repeater for Counter List
		$this->add_control( 'counter_list', [
			'label'   => __( 'Counter List', 'cnv-school-addon' ),
			'type'    => Controls_Manager::REPEATER,
			'fields'  => $repeater->get_controls(),
			'default' => [
				[
					'icon_type'        => 'icon',
					'selected_icon'    => [
						'value'   => 'fas fa-star',
						'library' => 'solid',
					],
					'count_number'     => __( '5', 'cnv-school-addon' ),
					'suffix_after'     => '+',
					'count_title'      => __( 'Classes', 'cnv-school-addon' ),
				],
				[
					'icon_type'        => 'icon',
					'selected_icon'    => [
						'value'   => 'fas fa-star',
						'library' => 'solid',
					],
					'count_number'     => __( '1762', 'cnv-school-addon' ),
					'suffix_after'     => '+',
					'count_title'      => __( 'Students', 'cnv-school-addon' ),
				],
				[
					'icon_type'        => 'icon',
					'selected_icon'    => [
						'value'   => 'fas fa-star',
						'library' => 'solid',
					],
					'suffix_after'     => '+',
					'count_number'     => __( '21', 'cnv-school-addon' ),
					'count_title'      => __( 'Teachers', 'cnv-school-addon' ),
				],
				[
					'icon_type'        => 'icon',
					'selected_icon'    => [
						'value'   => 'fas fa-star',
						'library' => 'solid',
					],
					'suffix_after'     => '+',
					'count_number'     => __( '6', 'cnv-school-addon' ),
					'count_title'      => __( 'Staffs', 'cnv-school-addon' ),
				],
			],
			'title_field' => '{{{ count_title }}}',
		] );

		$this->end_controls_section();


		/**
		 * Style Sections
		 */

		$this->start_controls_section( 'section_icon_style', [
			'label'     => esc_html__( 'Icon and Image', 'cnv-school-addon' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'icon_type!' => 'none'
			]
		] );


		$this->start_controls_tabs( 'tabs_icon_style' );

		$this->start_controls_tab( 'tab_icon_normal', [
			'label' => __( 'Normal', 'cnv-school-addon' ),
		] );

		$this->add_control( 'icon_color', [
			'label'     => esc_html__( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .icon-container' => 'color: {{VALUE}};'
			],
		] );

		$this->add_control( 'icon_border_color', [
			'label'     => esc_html__( 'Border Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .icon-container' => 'border-color: {{VALUE}};'
			],
		] );

		$this->add_control( 'icon_color_bg', [
			'label'     => esc_html__( 'Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .icon-container' => 'background-color: {{VALUE}}; border-color: {{VALUE}};'
			],
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'icon_shadow',
			'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .icon-container',
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_icon_hover', [
			'label' => __( 'Hover', 'cnv-school-addon' ),
		] );

		$this->add_control( 'icon_color_hover', [
			'label'     => esc_html__( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .icon-container:hover' => 'color: {{VALUE}}; border-color: {{VALUE}};'
			],
		] );

		$this->add_control( 'icon_hover_border_color', [
			'label'     => esc_html__( 'Border Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .icon-container:hover' => 'border-color: {{VALUE}};'
			],
		] );

		$this->add_control( 'icon_hover_bg_color', [
			'label'     => esc_html__( 'Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .icon-container:hover' => 'background-color: {{VALUE}}'
			],
		] );

		$this->end_controls_tab();
		$this->end_controls_tabs();


		$this->add_responsive_control( 'icon_space', [
			'label'     => esc_html__( 'Spacing', 'cnv-school-addon' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .icon-container'         => 'margin-right: {{SIZE}}{{UNIT}};',
				'(mobile){{WRAPPER}} .icon-container' => 'margin-right: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'icon_size', [
			'label'     => esc_html__( 'Size', 'cnv-school-addon' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 6,
					'max' => 300,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .icon-container'     => 'font-size: {{SIZE}}{{UNIT}};',
				'{{WRAPPER}} .icon-container img' => 'width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		// Countdown Style
		//============================
		$this->start_controls_section( 'countdown_section', [
			'label' => __( 'Countdown Number', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'counter_color', [
			'label'     => esc_html__( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-counter__number' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'counter_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .cnv-counter__number',
		] );

		$this->end_controls_section();

		// Title Style
		//============================

		$this->start_controls_section( 'title_section', [
			'label' => __( 'Title', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'counter_title_color', [
			'label'     => esc_html__( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-counter__title' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'counter_title_typography',
			'label'    => __( 'Title Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .cnv-counter__title',
		] );

		$this->add_control(
			'title_bottom_spacing',
			[
				'label' => __( 'Width', 'plugin-domain' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					]
				],

				'selectors' => [
					'{{WRAPPER}} .cnv-counter__number' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Counter Container style
		// ============================
		$this->start_controls_section( 'section_style_box', [
			'label' => __( 'Box Container', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'background',
				'label'    => __( 'Background', 'cnv-school-addon' ),
				'types'    => [ 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .cnv-counter',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => __( 'Border', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-counter',
			]
		);

		$this->add_control(
			'box_border_radius',
			[
				'label'      => __( 'Border Radius', 'cnv-school-addon' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .cnv-counter' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-counter',
			]
		);

		$this->add_control(
			'padding',
			[
				'label'      => __( 'Padding', 'cnv-school-addon' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .cnv-counter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control( 'box_translate_hover', [
			'label'      => __( 'Hover Translate (Y)', 'cnv-school-addon' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => 'px',
			'range'      => [
				'px' => [
					'min'  => - 50,
					'max'  => 100,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .cnv-counter:hover' => 'transform: translateY({{SIZE}}{{UNIT}});',
			],
		] );

		$this->end_controls_section();

		// Wrapper Style
		// ============================
		$this->start_controls_section( 'section_style_wrapper', [
			'label' => __( 'Wrapper', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'wrapper_background',
				'label'    => __( 'Background', 'cnv-school-addon' ),
				'types'    => [ 'classic', 'gradient'],
				'selector' => '{{WRAPPER}} .counter-wrapper',
			]
		);

		$this->add_responsive_control( 'wrapper_padding', [
			'label'      => __( 'Padding', 'cnv-school-addon' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .counter-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'wrapper_margin', [
			'label'      => __( 'Margin', 'cnv-school-addon' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .counter-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

	}

	/**
	 * Render widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings    = $this->get_settings_for_display();
		$counerLists = $settings['counter_list'];

		$this->add_render_attribute( 'wrapper', 'class', 'counter-wrapper' );

		echo '<div ' . $this->get_render_attribute_string( 'wrapper' ) . '>';
		echo '<div class="row justify-content-center">';
		foreach ( $counerLists as $item ) : ?>
			<div class="col-sm-6 col-md-4 col-xl-<?php echo esc_attr($settings['column']); ?>">
			<div class="cnv-counter">
				<?php if ( ! empty( $item['icon_type'] == 'icon' ) ) : ?>
					<?php if ( $item['icon_pack'] == 'fontawesome' ) : ?>
						<div class="cnv-counter__icon-container">
							<?php \Elementor\Icons_Manager::render_icon( $item['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
						</div>
						<!-- /.icon-container -->
					<?php elseif ( $item['icon_pack'] == 'feather' ) : ?>
						<div class="cnv-counter__icon-container">
							<?php if ( ! empty( $item['feather_icon'] ) ) : ?>
								<i class="<?php echo esc_attr( $item['feather_icon'] ) ?>"></i>
							<?php endif; ?>
						</div>
					<?php elseif ( $item['icon_pack'] == 'simpleline' ) : ?>
						<div class="cnv-counter__icon-container">
							<?php if ( ! empty( $item['simpleline_icon'] ) ) : ?>
								<i class="<?php echo esc_attr( $item['simpleline_icon'] ) ?>"></i>
							<?php endif; ?>
						</div>
						<!-- /.icon-container -->
					<?php endif; ?>

				<?php elseif ( ! empty( $item['icon_type'] == 'image' ) ) : ?>
					<div class="cnv-counter__icon-container">
						<img src="<?php echo esc_url( $item['icon_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['count_title'] ); ?>">
					</div>
					<!-- /.icon-container -->
				<?php endif; ?>

				<div class="cnv-counter__content">
					<?php if ( ! empty( $item['count_number'] ) ) : ?>
						<div class="cnv-counter__number">
							<?php if ( ! empty( $item['suffix_before'] ) ): ?>
								<span class="suffix"><?php echo $item['suffix_before']; ?></span>
							<?php endif; ?>
							<span class="counter" data-counter="<?php echo esc_attr( $item['count_number'] ) ?>">
							<?php echo $item['count_number']; ?>
						</span>
							<?php if ( ! empty( $item['suffix_after'] ) ) : ?>
								<span class="suffix"><?php echo $item['suffix_after']; ?></span>
							<?php endif; ?>
						</div>
						<!-- /.counter-wrap -->
					<?php endif; ?>

					<?php if ( ! empty( $item['count_title'] ) ) : ?>
						<p class="cnv-counter__title"><?php echo $item['count_title']; ?></p>
					<?php endif; ?>
				</div>
			</div>
			</div>
		<?php
		endforeach;
		echo '</div>';
		echo '</div>';

	}
}

