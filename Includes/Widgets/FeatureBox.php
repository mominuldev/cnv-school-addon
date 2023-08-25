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
 * Class Feature
 * @package CodeNestVentures\SchoolAddon\Widgets
 */
class FeatureBox extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Feature widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'rbt-feature-box';
	}

	/**
	 * Get widget title.
	 * Retrieve Feature widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'CNV Feature Box', 'cnv-school-addon' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Feature widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-custom';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the Feature widget belongs to.
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
		return [ 'Feature', 'Box' ];
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
		$this->start_controls_section( 'feature_content', [
			'label' => __( 'Feature Member', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		// Column
		$this->add_control( 'column', [
			'label'   => __( 'Column', 'cnv-school-addon' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '4',
			'options' => [
				'6' => __( '2 Column', 'cnv-school-addon' ),
				'3' => __( '3 Column', 'cnv-school-addon' ),
				'4' => __( '4 Column', 'cnv-school-addon' ),
			],
		] );

		// Repeater List
		$repeater = new Repeater();

		$repeater->add_control( 'subtitle', [
			'label'       => __( 'Top Title', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter top  Title', 'cnv-school-addon' ),
			'default'     => __( 'Core Features', 'cnv-school-addon' ),
			'label_block' => true,
		] );

		// Title
		$repeater->add_control( 'title', [
			'label'       => __( 'Title', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Title', 'cnv-school-addon' ),
			'default'     => __( 'Advertising and Scale', 'cnv-school-addon' ),
			'label_block' => true,
		] );

		// Button Link
		$repeater->add_control( 'button_link', [
			'label'       => __( 'Button Link', 'cnv-school-addon' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'cnv-school-addon' ),
			'default'     => [
				'url' => '#'
			]
		] );

		$this->add_control( 'feature_lists',
			[
				'label'       => esc_html__( 'Feature Lists', 'cnv-school-addon' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title'       => 'Data-Driven Strategies',
						'subtitle'    => 'Core Feature'
					],
					[
						'title'       => 'Creative Excellence',
						'subtitle'    => 'Core Feature'
					],
					[
						'title'       => ' Marketing Solutions',
						'subtitle'    => 'Core Feature'
					],

				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
		// End Feature Content
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
				'{{WRAPPER}} .rbt-feature-box__title' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .rbt-feature-box__title',
		] );


		$this->end_controls_section();
		// End Name Style
		// =====================


		// Feature Container Style Section
		// ================================

		$this->start_controls_section( 'feature_container_style', [
			'label' => __( 'Feature Container', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'      => 'feature_background',
				'label'     => __( 'Background Color', 'cnv-school-addon' ),
				'types'     => [ 'classic', 'gradient' ],
				'selector'  => '{{WRAPPER}} .rbt-feature-box',
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'feature_border',
				'label'    => __( 'Border', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .rbt-feature-box:not(:hover)',
			]
		);

		// Hover Border Color
		$this->add_control( 'feature_hover_border_color', [
			'label'     => __( 'Hover Border Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .rbt-feature-box:hover' => 'border-color: {{VALUE}};',
			],
		] );

		$this->add_responsive_control( 'feature_padding', [
			'label'      => __( 'Padding', 'cnv-school-addon' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .rbt-feature-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );


		$this->add_responsive_control( 'feature_border-radius', [
			'label'      => __( 'Border Radius', 'cnv-school-addon' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .rbt-feature-box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'feature_box_shadow',
				'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .rbt-feature-box',
			]
		);

		// Hover Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'feature_hover_box_shadow',
				'label'    => __( 'Hover Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .rbt-feature-box:hover',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		$ant   = 0.3;
		$count = 0;

		// Wrapper attributes
		$this->add_render_attribute( 'wrapper', 'class', 'rbt-feature-box wow fadeInUp' );
		$this->add_render_attribute( 'wrapper', 'data-wow-delay', $ant . 's' );

		echo '<div class="row">';
			if ( ! empty( $settings['feature_lists'] ) ) {
				foreach ( $settings['feature_lists'] as $item ) {
					require __DIR__ . '/templates/feature/feature.php';
					$ant = $ant + 0.2;
				}
			}
		echo '</div>';
	}
}