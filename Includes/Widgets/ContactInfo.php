<?php

namespace CodeNestVentures\SchoolAddon\Widgets;

use Elementor\{Controls_Manager, Group_Control_Border, Group_Control_Box_Shadow, Widget_Base, Group_Control_Typography, Repeater};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class ContactInfo
 * @package CodeNestVentures\SchoolAddon\Widgets
 */
class ContactInfo extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Team widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'cnv-contact-info';
	}

	/**
	 * Get widget title.
	 * Retrieve Team widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'CNV Contact Info', 'cnv-school-addon' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Team widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-info-circle-o';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the Team widget belongs to.
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
		return [ 'Team', 'cnv member' ];
	}

	/**
	 * Register widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		//============================================
		// START Contact Info
		//============================================
		$this->start_controls_section( 'team_content', [
			'label' => __( 'Contact Info', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );


		$this->add_control(
			'icon',
			[
				'label'   => esc_html__( 'Icon', 'textdomain' ),
				'type'    => \Elementor\Controls_Manager::ICONS,
				'default' => [
					'value'   => 'far fa-envelope',
					'library' => 'fa-regular',
				],
			]
		);

		$this->add_control( 'title', [
			'label'       => __( 'Title', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Title', 'cnv-school-addon' ),
			'default'     => __( 'Email', 'cnv-school-addon' ),
			'label_block' => true,
		] );

		$this->add_control( 'contact_info', [
			'label'       => __( 'Contact Info', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXTAREA,
			'rows'        => 3,
			'placeholder' => __( 'Enter Contact Info', 'cnv-school-addon' ),
			'default'     => __( 'support@example.com', 'cnv-school-addon' ),
			'label_block' => true,
		] );

		// URL
		$this->add_control( 'link', [
			'label'       => __( 'URL', 'cnv-school-addon' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'Enter URL', 'cnv-school-addon' ),
			'label_block' => true,
		] );

		// URL Label
		$this->add_control( 'url_label', [
			'label'       => __( 'URL Label', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter URL Label', 'cnv-school-addon' ),
			'default'     => __( 'Contact', 'cnv-school-addon' ),
			'label_block' => true,
		] );

		// Extra Information
		$this->add_control( 'extra_info', [
			'label'       => __( 'Extra Information', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXTAREA,
			'rows'        => 2,
			'placeholder' => __( 'Enter Extra Information', 'cnv-school-addon' ),
			'default'     => __( '*extra information(optional)', 'cnv-school-addon' ),
			'label_block' => true,
		] );

		$this->end_controls_section();
		// End Contact Information
		// =====================


		//============================================
		// START TEAME STYLE
		//============================================

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
				'{{WRAPPER}} .cnv-contact-info__title' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .cnv-contact-info__title',
		] );


		$this->end_controls_section();
		// End Name Style
		// =====================

		// Start Position Style
		// =====================
		$this->start_controls_section( 'position_style', [
			'label' => __( 'Contact Info', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'contact_info_color', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-contact-info__info' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .cnv-contact-info__info',
		] );

		$this->end_controls_section();
		// End Position Style
		// =====================

		// Button Style
		// =====================
		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Button', 'cnv-school-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'typography',
				'label'    => __( 'Typography', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-btn',
			]
		);

		$this->add_control(
			'border_radius',
			[
				'label'      => __( 'Border Radius', 'cnv-school-addon' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.cnv-btn, {{WRAPPER}} .cnv-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->add_control(
			'btn_padding',
			[
				'label'      => __( 'Padding', 'cnv-school-addon' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} a.cnv-btn, {{WRAPPER}} .cnv-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'cnv-school-addon' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} a.cnv-btn, {{WRAPPER}} .cnv-btn' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color',
			[
				'label'     => __( 'Background Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cnv-btn' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'label'    => __( 'Border', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow',
				'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'cnv-school-addon' ),
			]
		);

		$this->add_control(
			'hover_color',
			[
				'label'     => __( 'Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cnv-btn:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'background_color_hover',
			[
				'label'     => __( 'Background Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cnv-btn:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'border_hover',
				'label'    => __( 'Border', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-btn:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'box_shadow_hover',
				'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-btn:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();

		// Extra Info Style Section
		// ================================
		$this->start_controls_section(
			'extra_info_style_section',
			[
				'label' => __( 'Extra Info', 'cnv-school-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'extra_info_typography',
				'label'    => __( 'Typography', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-contact-info__extra-info',
			]
		);

		$this->add_control(
			'extra_info_color',
			[
				'label'     => __( 'Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .cnv-contact-info__extra-info' => 'color: {{VALUE}};',
				],
			]
		);



		$this->end_controls_section();


		// Contact Container Style Section
		// ================================

		$this->start_controls_section( 'contact_container_style', [
			'label' => __( 'Contact Container', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'team_bg_color', [
			'label'     => __( 'Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-contact-info' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'team_border',
				'label'    => __( 'Border', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-contact-info',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'team_box_shadow',
				'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-contact-info',
			]
		);

		$this->add_control( 'team_padding', [
			'label'      => __( 'Padding', 'cnv-school-addon' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .cnv-contact-info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'team_border-radius', [
			'label'      => __( 'Border Radius', 'cnv-school-addon' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .cnv-contact-info' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		require __DIR__ . '/templates/contact/contact-info.php';
	}

}