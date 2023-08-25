<?php

namespace CodeNestVentures\SchoolAddon\Widgets;

use Elementor\{Controls_Manager,
	Widget_Base,
	Group_Control_Typography,
	Repeater,
	Group_Control_Box_Shadow,
	Utils,
	Group_Control_Background,
	Group_Control_Border,

};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Class LogoList
 * @package CodeNestVentures\SchoolAddon\Widgets
 */
class LogoList extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'cnv-logo-lists';
	}


	/**
	 * Get widget title.
	 * Retrieve alert widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'Logo List', 'cnv-school-addon' );
	}

	/**
	 * Get widget icon.
	 * Retrieve alert widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {

		return 'eicon-logo';
	}

	/**
	 * Get widget categories.
	 * Retrieve the widget categories.
	 * @return array Widget categories.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_categories() {
		return [ 'cnv-elements' ];
	}

	/**
	 * Register alert widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {

		$this->start_controls_section( 'logo_content', [
			'label' => __( 'Logo List', 'cnv-school-addon' ),
		] );


		$repeater = new Repeater();

		$repeater->add_control( 'logo_image', [
			'label'   => __( 'Choose Logo Image', 'cnv-school-addon' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => Utils::get_placeholder_image_src(),
			],
		] );

		$repeater->add_control( 'brand_name', [
			'label'       => __( 'Brand Name', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
		] );

		$repeater->add_control(
			'link',
			[
				'label'         => __( 'Link', 'cnv-school-addon' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'cnv-school-addon' ),
				'show_external' => true,
				'default'       => [
					'url' => '#',
				],
			]
		);

		$this->add_control( 'logo_lists', [
			'label'       => __( 'Logo List', 'cnv-school-addon' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'brand_name' => __( 'Brand Name', 'cnv-school-addon' ),
					'logo_image' => [
						'url' => plugin_dir_url( __DIR__ ) . '/widgets/images/client/logo1.png'
					]
				],
				[
					'brand_name' => __( 'Brand Name', 'cnv-school-addon' ),
					'logo_image' => [
						'url' => plugin_dir_url( __DIR__ ) . '/widgets/images/client/logo2.png'
					]
				],
				[
					'brand_name' => __( 'Brand Name', 'cnv-school-addon' ),
					'logo_image' => [
						'url' => plugin_dir_url( __DIR__ ) . '/widgets/images/client/logo3.png'
					]
				],
				[
					'brand_name' => __( 'Brand Name', 'cnv-school-addon' ),
					'logo_image' => [
						'url' => plugin_dir_url( __DIR__ ) . '/widgets/images/client/logo4.png'
					]
				],
				[
					'brand_name' => __( 'Brand Name', 'cnv-school-addon' ),
					'logo_image' => [
						'url' => plugin_dir_url( __DIR__ ) . '/widgets/images/client/logo5.png'
					]
				],
				[
					'brand_name' => __( 'Brand Name', 'cnv-school-addon' ),
					'logo_image' => [
						'url' => plugin_dir_url( __DIR__ ) . '/widgets/images/client/logo6.png'
					]
				],
				[
					'brand_name' => __( 'Brand Name', 'cnv-school-addon' ),
					'logo_image' => [
						'url' => plugin_dir_url( __DIR__ ) . '/widgets/images/client/logo7.png'
					]
				],
				[
					'brand_name' => __( 'Brand Name', 'cnv-school-addon' ),
					'logo_image' => [
						'url' => plugin_dir_url( __DIR__ ) . '/widgets/images/client/logo8.png'
					]
				]
			],
			'title_field' => '{{{ brand_name }}}',
		] );


		$this->end_controls_section();

		// Style Box  Container
		//==========================
		$this->start_controls_section( 'brand_container_section', [
			'label' => __( 'Box Container', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Box_Shadow::get_type(), [
			'name'     => 'info_box_shadow',
			'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .cnv-logo-list__item',
		] );


		// Padding
		$this->add_responsive_control( 'brand_container_padding', [
			'label'      => __( 'Padding', 'cnv-school-addon' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .cnv-logo-list__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_responsive_control( 'border-radius', [
			'label'      => __( 'Border Radius', 'cnv-school-addon' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .cnv-logo-list__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Gap Between Brand with display grid
		$this->add_responsive_control( 'brand_gap', [
			'label'      => __( 'Gap Between Brand', 'cnv-school-addon' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .cnv-logo-list' => 'column-gap: {{SIZE}}{{UNIT}}; gap: {{SIZE}}{{UNIT}};',
			],
		] );

		// Min Height
		$this->add_responsive_control( 'brand_min_height', [
			'label'      => __( 'Min Height', 'cnv-school-addon' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%', 'em' ],
			'range'      => [
				'px' => [
					'min' => 0,
					'max' => 400,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .cnv-logo-list__item' => 'min-height: {{SIZE}}{{UNIT}};',
			],
		] );

		// Tab Normal
		$this->start_controls_tabs(
			'style_tabs'
		);

		$this->start_controls_tab(
			'style_normal_tab',
			[
				'label' => esc_html__( 'Normal', 'textdomain' ),
			]
		);

		$this->add_control( 'brand_container_bg_color', [
			'label'     => __( 'Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-logo-list__item' => 'background-color: {{VALUE}};',
			],
		] );

		// Border
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'brand_container_border',
			'label'    => __( 'Border', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .cnv-logo-list__item',
		] );


		$this->end_controls_tab();

		$this->start_controls_tab(
			'style_hover_tab',
			[
				'label' => esc_html__( 'Hover', 'textdomain' ),
			]
		);


		$this->add_control( 'brand_container_hover_bg_color', [
			'label'     => __( 'Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-logo-list__item:hover' => 'background-color: {{VALUE}};',
			],
		] );

		// Border
		$this->add_group_control( Group_Control_Border::get_type(), [
			'name'     => 'brand_container_border_hover',
			'label'    => __( 'Border', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .cnv-logo-list__item:hover',
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();
		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['logo_lists'] ) { ?>
			<div class="client-logo-wrapper">
				<ul class="cnv-logo-list">
					<?php foreach ( $settings['logo_lists'] as $item ) { ?>
						<li class="cnv-logo-list__item wow fadeIn" data-bs-original-title="<?php echo esc_attr( $item['brand_name'] ) ?>">
							<a href="#">
								<img src="<?php echo esc_url( $item['logo_image']['url'] ); ?>" alt="<?php echo esc_attr( $item['brand_name'] ) ?>">
							</a>

						</li>
					<?php } ?>
				</ul>
			</div>
			<!-- /.client-logo-wrapper -->
			<?php
		}
	}
}