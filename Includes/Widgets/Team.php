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
 * Class Team
 * @package CodeNestVentures\SchoolAddon\Widgets
 */
class Team extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Team widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'cnv-team';
	}

	/**
	 * Get widget title.
	 * Retrieve Team widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'CNV Team', 'cnv-school-addon' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Team widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_icon() {
		return 'eicon-person';
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
		// START TEAME CONTENT
		//============================================
		$this->start_controls_section( 'team_content', [
			'label' => __( 'Team Member', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		$this->add_control(
			'layout',
			[
				'label'   => esc_html__( 'Style', 'cnv-school-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'one',
				'options' => [
					'one'   => esc_html__( 'Administrator', 'cnv-school-addon' ),
					'two'   => esc_html__( 'Teacher', 'cnv-school-addon' ),
					'three' => esc_html__( 'Employee', 'cnv-school-addon' ),
				]
			]
		);


		$this->add_control( 'name', [
			'label'       => __( 'Name', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Name', 'cnv-school-addon' ),
			'default'     => __( 'Mashil Nanchy', 'cnv-school-addon' ),
		] );

		$this->add_control( 'position', [
			'label'       => __( 'Deaignation', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Position', 'cnv-school-addon' ),
			'default'     => __( 'Teacher', 'cnv-school-addon' ),
		] );
		// Mobile Number
		$this->add_control( 'mobile_number', [
			'label'       => __( 'Mobile Number', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Mobile Number', 'cnv-school-addon' ),
			'default'     => __( '01700000000', 'cnv-school-addon' ),
		] );

		// Description
		$this->add_control( 'short_info', [
			'label'       => __( 'Short Info', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXTAREA,
			'placeholder' => __( 'Enter Short Info', 'cnv-school-addon' ),
			'default'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
				'cnv-school-addon' ),
			'condition'   => [
				'layout' => 'one'
			]
		] );

		$this->add_control( 'image', [
			'label'   => __( 'Choose Image', 'cnv-school-addon' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/team1.jpg'
			],
		] );

		// Button Show/Hide
		$this->add_control(
			'show_button',
			[
				'label'        => __( 'Show Button', 'cnv-school-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cnv-school-addon' ),
				'label_off'    => __( 'Hide', 'cnv-school-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
				'condition' => [
					'layout' => 'one'
				]
			]
		);

		// Button
		$this->add_control( 'button_text', [
			'label'       => __( 'Button Text', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Enter Button Text', 'cnv-school-addon' ),
			'default'     => __( 'Learn More', 'cnv-school-addon' ),
			'condition' => [
				'layout' => 'one',
				'show_button' => 'yes',
			]
		] );

		// Button Link
		$this->add_control(
			'button_link',
			[
				'label'         => __( 'Button Link', 'cnv-school-addon' ),
				'type'          => Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'cnv-school-addon' ),
				'show_external' => true,
				'default'       => [
					'url' => '#',
				],
				'condition' => [
					'layout' => 'one',
					'show_button' => 'yes',
				]
			]
		);

		// Social Icons show/hide
		$this->add_control(
			'show_social_icons',
			[
				'label'        => __( 'Show Social Icons', 'cnv-school-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Show', 'cnv-school-addon' ),
				'label_off'    => __( 'Hide', 'cnv-school-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$repeater = new Repeater();

		$repeater->add_control( 'icon', [
			'label' => __( 'Icon', 'cnv-school-addon' ),
			'type'  => Controls_Manager::ICONS,
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

		$repeater->add_control( 'social_name', [
			'label'       => __( 'Name', 'cnv-school-addon' ),
			'description' => __( 'This name will be show in the item header', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => 'Facebook',
		] );

		$this->add_control( 'social_icons', [
			'label'       => __( 'Add Social Icon', 'cnv-school-addon' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'condition'   => [
				'show_social_icons' => 'yes',
			],
			'default'     => [
				[
					'icon'        => [
						'value'   => 'fab fa-facebook-f',
						'library' => 'solid',
					],
					'link'        => [
						'url' => '#',
					],
					'social_name' => __( 'Facebook', 'cnv-school-addon' ),
				],
				[
					'icon'        => [
						'value'   => 'fab fa-twitter',
						'library' => 'solid',
					],
					'link'        => [
						'url' => '#',
					],
					'social_name' => __( 'Twitter', 'cnv-school-addon' ),
				],
				[
					'icon'        => [
						'value'   => 'fab fa-linkedin-in',
						'library' => 'solid',
					],
					'link'        => [
						'url' => '#',
					],
					'social_name' => __( 'Linkedin', 'cnv-school-addon' ),
				],


			],
			'title_field' => '{{{ social_name }}}',
		] );

		// Content Alignment Vertical
		$this->add_responsive_control(
			'content_alignment_vertical',
			[
				'label'        => __( 'Vertical Alignment', 'cnv-school-addon' ),
				'type'         => Controls_Manager::CHOOSE,
				'options'      => [
					'flex-start'    => [
						'title' => __( 'Top', 'cnv-school-addon' ),
						'icon'  => 'eicon-v-align-top',
					],
					'center' => [
						'title' => __( 'Middle', 'cnv-school-addon' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'flex-end' => [
						'title' => __( 'Bottom', 'cnv-school-addon' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'default'      => 'middle',
				'selectors'    => [
					'{{WRAPPER}} .cnv-team' => 'align-items: {{VALUE}};',
				],
				'condition'   => [
					'layout' => 'one'
				]
			]
		);

		$this->end_controls_section();
		// End Team Content
		// =====================

		$this->start_controls_section( 'animation_effect', [
			'label' => __( 'Animation Effect', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_CONTENT,
		] );

		// Enable tilt Animation
		$this->add_control(
			'enable_tilt',
			[
				'label'        => __( 'Enable Tilt', 'cnv-school-addon' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => __( 'Enable', 'cnv-school-addon' ),
				'label_off'    => __( 'Disable', 'cnv-school-addon' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->end_controls_section();


		//============================================
		// START TEAME STYLE
		//============================================

		// Start Name Style
		// =====================
		$this->start_controls_section( 'name_style', [
			'label' => __( 'Name', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'name_color', [
			'label'     => __( 'Text Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-team__name' => 'color: {{VALUE}};',
			],
		] );


		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'name_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .cnv-team__name',
		] );


		$this->end_controls_section();
		// End Name Style
		// =====================

		// Start Position Style
		// =====================
		$this->start_controls_section( 'position_style', [
			'label' => __( 'Designation', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'position_color', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-team__designation' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'position_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .cnv-team__designation',
		] );

		$this->end_controls_section();
		// End Position Style
		// =====================


		// Start Description Style
		// =====================
		$this->start_controls_section( 'member_short_info', [
			'label' => __( 'Description', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_control( 'short_info_color', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-team__short-info' => 'color: {{VALUE}};',
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'short_info_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .cnv-team__short-info',
		] );

		$this->end_controls_section();
		// End Position Style
		// =====================


		// Start Icon Style
		// =====================
		$this->start_controls_section( 'icon_style', [
			'label' => __( 'Social Icon', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_responsive_control( 'font_size', [
			'label'      => __( 'Font Size', 'cnv-school-addon' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', 'em' ],
			'default'    => [
				'unit' => 'px',
			],
			'selectors'  => [
				'{{WRAPPER}} .cnv-team__social li a' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		] );

		$this->start_controls_tabs( 'team_icon_tabs' );

		$this->start_controls_tab( 'team_icon_normal', [
			'label' => __( 'Normal', 'cnv-school-addon' ),
		] );

		$this->add_control( 'team_icon_color', [
			'label'     => __( 'Icon Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-team__social li a' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->start_controls_tab( 'team_icon_hover', [
			'label' => __( 'Hover', 'cnv-school-addon' ),
		] );

		$this->add_control( 'team_icon_hover_color', [
			'label'     => __( 'Icon Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-team__social li a:hover' => 'color: {{VALUE}};',
			],
		] );

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();


		// Team Container Style Section
		// ================================

		$this->start_controls_section( 'team_container_style', [
			'label' => __( 'Team Container', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'team_wrapper_box_shadow',
				'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-team',
			]
		);

		// Background
		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'team_background',
				'label'    => __( 'Background', 'cnv-school-addon' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .cnv-team',
			]
		);

		// Border
		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'team_border',
				'label'    => __( 'Border', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-team',
			]
		);

		$this->add_control( 'team_padding', [
			'label'      => __( 'Padding', 'cnv-school-addon' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .cnv-team .cnv-team__info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		$this->add_control( 'team_border-radius', [
			'label'      => __( 'Border Radius', 'cnv-school-addon' ),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%', 'em' ],
			'selectors'  => [
				'{{WRAPPER}} .cnv-team' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		] );

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'team_box_shadow',
				'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-team',
			]
		);

		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		// Wrapper attributes
		$this->add_render_attribute( 'wrapper', 'class', 'cnv-team' );
		if ( $settings['enable_tilt'] == 'yes' ) {
			$this->add_render_attribute( 'wrapper', 'data-tilt', );
		}

		// Style
		$this->add_render_attribute( 'wrapper', 'class', 'cnv-team--' . $settings['layout'] );

		require __DIR__ . '/templates/team/style-' . $settings['layout'] . '.php';
	}

}