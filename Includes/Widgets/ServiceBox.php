<?php

namespace CodeNestVentures\SchoolAddon\Widgets;

use Elementor\{Controls_Manager,
	Group_Control_Background,
	Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
	Repeater
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class Service
 * @package CodeNestVentures\SchoolAddon\Widgets
 */
class ServiceBox extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Service widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'cnv-service-box';
	}

	/**
	 * Get widget title.
	 * Retrieve Service widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'CNV Service Box', 'cnv-school-addon' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Service widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-custom';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the Service widget belongs to.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'cnv-elements' ];
	}

	/**
	 * Get widget keywords.
	 * Retrieve the list of keywords the widget belongs to.
	 * @since 1.0.0
	 */
	public function get_keywords() {
		return [ 'Service', 'cnv member' ];
	}

	/**
	 * Register widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//============================================
		// START TEAME CONTENT
		//============================================
		$this->start_controls_section( 'service_content', [
			'label' => __( 'Service Member', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'cnv-school-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one'   => esc_html__( 'Style One', 'cnv-school-addon' ),
					'two'   => esc_html__( 'Style Two', 'cnv-school-addon' ),
				]
			]
		);

		// Icon Type
		$this->add_control( 'icon_type', [
			'label'   => __( 'Icon Type', 'cnv-school-addon' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'image',
			'options' => [
				'icon'  => __( 'Icon', 'cnv-school-addon' ),
				'image' => __( 'Image', 'cnv-school-addon' ),
			],
		] );

		// Icon
		$this->add_control( 'icon', [
			'label'     => __( 'Icon', 'cnv-school-addon' ),
			'type'      => Controls_Manager::ICONS,
			'condition' => [
				'icon_type' => 'icon'
			]
		] );

		// Image
		$this->add_control( 'image', [
			'label'     => __( 'Choose Image', 'cnv-school-addon' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/service.png'
			],
			'condition' => [
				'icon_type' => 'image'
			]
		] );

		$this->add_control( 'title', [
			'label'       => __( 'Title', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Title', 'cnv-school-addon' ),
			'default'     => __( 'Advertising and Scale', 'cnv-school-addon' ),
			'label_block' => true,
		] );

		// Description
		$this->add_control( 'description', [
			'label'       => __( 'Description', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXTAREA,
			'placeholder' => __( 'Enter Description', 'cnv-school-addon' ),
			'default'     => __( 'An effective business strategy provides clarity and direction', 'cnv-school-addon' ),
			'condition'   => [
				'layout' => 'three'
			]
		] );

		// Button Link
		$this->add_control( 'button_link', [
			'label'       => __( 'Button Link', 'cnv-school-addon' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'cnv-school-addon' ),
			'default'     => [
				'url' => '#'
			]
		] );

		// Button Text
		$this->add_control( 'button_text', [
			'label'       => __( 'Button Text', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Button Text', 'cnv-school-addon' ),
			'default'     => __( 'Read More', 'cnv-school-addon' ),
			'condition'   => [
				'button_link[url]!' => '',
				'layout'            => 'one'
			]
		] );


		$this->end_controls_section();
		// End Service Content
		// =====================


		// Start Name Style
		// =====================
		$this->start_controls_section( 'name_style', [
			'label' => __( 'Title', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'title_color', [
			'label'     => __( 'Text Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-service__title' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .cnv-service__title',
		] );


		$this->end_controls_section();
		// End Name Style
		// =====================

		// Start Position Style
		// =====================
		$this->start_controls_section( 'btn_arrow_style', [
			'label'     => __( 'Button', 'cnv-school-addon' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'layout' => 'two'
			]
		] );

		$this->add_control( 'btn_arrow_color', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-service__arrow svg path' => 'fill: {{VALUE}};',
			],
		] );

		$this->end_controls_section();

		// Start Position Style
		// =====================
		$this->start_controls_section( 'position_style', [
			'label'     => __( 'Button', 'cnv-school-addon' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'layout' => 'one'
			]
		] );

		$this->add_control( 'btn_color', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-service__btn' => 'color: {{VALUE}};',
			],
		] );

		// Hover Color
		$this->add_control( 'btn_hover_color', [
			'label'     => __( 'Hover Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-service__btn:hover' => 'color: {{VALUE}};',
			],
		] );

		// Background Color
		$this->add_control( 'btn_bg_color', [
			'label'     => __( 'Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-service__btn' => 'background-color: {{VALUE}};',
			],
		] );

		// Hover Background Color
		$this->add_control( 'btn_hover_bg_color', [
			'label'     => __( 'Hover Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-service__btn:hover' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .cnv-service__btn',
		] );

		// Height and Width
		$this->add_responsive_control( 'btn_height_width', [
			'label'      => __( 'Height & Width', 'cnv-school-addon' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 300,
				],
				'em' => [
					'min' => 0,
					'max' => 20,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .cnv-service__btn' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		// Icon Style
		// =====================
		$this->start_controls_section( 'icon_container_style', [
			'label' => __( 'Icon', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		// Icon Color
		$this->add_control( 'icon_color', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-service__icon' => 'color: {{VALUE}};',
			],
		] );

		// Icon Hover Color
		$this->add_control( 'icon_hover_color', [
			'label'     => __( 'Hover Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-service__icon:hover' => 'color: {{VALUE}};',
			],
		] );

		// Icon Background Color
		$this->add_control( 'icon_bg_color', [
			'label'     => __( 'Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-service__icon' => 'background-color: {{VALUE}};',
			],
		] );

		// Icon Hover Background Color
		$this->add_control( 'icon_hover_bg_color', [
			'label'     => __( 'Hover Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-service__icon:hover' => 'background-color: {{VALUE}};',
			],
		] );

		// Height and Width
		$this->add_responsive_control( 'icon_size', [
			'label'      => __( 'Size', 'cnv-school-addon' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em', '%' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 300,
				],
				'em' => [
					'min' => 0,
					'max' => 20,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .cnv-service__icon' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		// Padding slider control
		// Height and Width
		$this->add_responsive_control( 'icon_padding', [
			'label'     => __( 'Padding', 'cnv-school-addon' ),
			'type'      => Controls_Manager::SLIDER,
			'selectors' => [
				'{{WRAPPER}} .cnv-service__icon' => 'padding: {{SIZE}}{{UNIT}};',
			],
		] );

		// Space Between Icon and Title
		$this->add_responsive_control( 'icon_title_space', [
			'label'     => __( 'Space Between Icon and Title', 'cnv-school-addon' ),
			'type'      => Controls_Manager::SLIDER,
			'selectors' => [
				'{{WRAPPER}} .cnv-service__icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		] );

		// Icon Border Radius
		$this->add_responsive_control( 'icon_border_radius', [
			'label'      => __( 'Border Radius', 'cnv-school-addon' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', 'em', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .cnv-service__icon' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();

		// Service Container Style Section
		// ================================

		$this->start_controls_section( 'service_container_style', [
			'label' => __( 'Service Container', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'service_background',
				'label'    => __( 'Background Color', 'cnv-school-addon' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .cnv-service',
			]
		);

		// Hover Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'service_hover_background',
				'label'    => __( 'Hover Background Color', 'cnv-school-addon' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .cnv-service:hover',
			]
		);

		// Overlay Background
		$this->add_control( 'service_overlay_bg', [
			'label'     => __( 'Overlay BG Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-service:after' => 'background-color: {{VALUE}};',
			],
			'condition' => [
				'layout' => 'one'
			]
		] );

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'service_border',
				'label'    => __( 'Border', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-service:not(:hover)',
			]
		);

		// Hover Border Color
		$this->add_control( 'service_hover_border_color', [
			'label'     => __( 'Hover Border Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-service:hover' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'service_padding', [
			'label'      => __( 'Padding', 'cnv-school-addon' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .cnv-service' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->add_responsive_control( 'service_border-radius', [
			'label'      => __( 'Border Radius', 'cnv-school-addon' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .cnv-service' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'service_box_shadow',
				'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-service',
			]
		);

		// Hover Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'service_hover_box_shadow',
				'label'    => __( 'Hover Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-service:hover',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		// Wrapper attributes
		$this->add_render_attribute( 'wrapper', 'class', 'cnv-service' );

		// Style
		$this->add_render_attribute( 'wrapper', 'class', 'cnv-service--' . $settings['layout'] );

		require __DIR__ . '/templates/service/service-one.php';
	}

}