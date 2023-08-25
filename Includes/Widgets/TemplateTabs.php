<?php

namespace CodeNestVentures\SchoolAddon\Widgets;

use Elementor\{
	Controls_Manager,
	Group_Control_Typography,
	Repeater,
	Widget_Base
};

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * CNV Tab
 * CNV widget.
 * @since 1.0.0
 */
class TemplateTabs extends Widget_Base {

	public function get_name() {
		return 'cnv-dynamic-tabs';
	}

	public function get_title() {
		return __( 'CNV Dynamic Tabs', 'cnv-school-addon' );
	}

	public function get_icon() {
		return 'eicon-tabs';
	}

	public function get_categories() {
		return [ 'cnv-elements' ];
	}

	protected function register_controls() {

		// ------------------------------ Feature list ------------------------------
		$this->start_controls_section(
			'section_tab', [
				'label' => __( 'CNV Tabs', 'cnv-school-addon' ),
			]
		);

		// Layout
		$this->add_control(
			'tab_layout', [
				'label'   => __( 'Layout', 'cnv-school-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'horizontal',
				'options' => [
					'horizontal' => __( 'Horizontal', 'cnv-school-addon' ),
					'vertical'   => __( 'Vertical', 'cnv-school-addon' ),
				],
			]
		);

		// Tab Style
		$this->add_control(
			'tab_style', [
				'label'   => __( 'Tab Style', 'cnv-school-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'style-one',
				'options' => [
					'style-one'   => __( 'Style 1', 'cnv-school-addon' ),
					'style-two'   => __( 'Style 2', 'cnv-school-addon' ),
					'style-three' => __( 'Style 3', 'cnv-school-addon' ),

				],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tab_label', [
				'label'       => __( 'Tab Label', 'cnv-school-addon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'tab_badge_text', [
				'label'       => __( 'Badge', 'cnv-school-addon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		// Icon Type Choose Control
		$repeater->add_control(
			'tab_icon_type',
			[
				'label'   => __( 'Icon Type', 'cnv-school-addon' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'none' => [
						'title' => __( 'None', 'cnv-school-addon' ),
						'icon'  => 'eicon-ban',
					],
					'icon' => [
						'title' => __( 'Icon', 'cnv-school-addon' ),
						'icon'  => 'eicon-star',
					],
				],
				'default' => 'none',
				'toggle'  => false,
			]
		);

		// Icon Type Select Control
		$repeater->add_control(
			'tab_icon_pack',
			[
				'label'     => __( 'Icon Select', 'cnv-school-addon' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'font_awesome',
				'options'   => [
					'font_awesome' => __( 'Font Awesome', 'cnv-school-addon' ),
					'elegant_icon' => __( 'Elegant Icon', 'cnv-school-addon' ),
				],
				'condition' => [
					'tab_icon_type' => 'icon',
				],

			]
		);

		// Icon Control
		$repeater->add_control(
			'nav_icon',
			[
				'label'     => esc_html__( 'Icon', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::ICONS,
				'default'   => [
					'value'   => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'condition' => [
					'tab_icon_type' => 'icon',
					'tab_icon_pack' => 'font_awesome',
				],
			]
		);


		$repeater->add_control(
			'tab_icon',
			[
				'label'       => __( 'Choose Icon', 'cnv-school-addon' ),
				'type'        => Controls_Manager::ICON,
				'options'     => cnv_simpleline_icons(),
				'include'     => cnv_include_simpleline_icons(),
				'default'     => 'icon-user',
				'label_block' => true,
				'condition'   => [
					'tab_icon_type' => 'icon',
					'tab_icon_pack' => 'elegant_icon',
				],
			]
		);

		// Get Template Library
		$templates = get_posts( array(
			'post_type'      => 'elementor_library',
			'posts_per_page' => - 1,
		) );

		$options = array();
		if ( ! empty( $templates ) && ! is_wp_error( $templates ) ) {
			foreach ( $templates as $template ) {
				$options[ $template->ID ] = $template->post_title;
			}
		}

		$repeater->add_control(
			'template_id',
			[
				'label'   => __( 'Choose Template', 'cnv-school-addon' ),
				'type'    => Controls_Manager::SELECT,
				'options' => $options,
				'default' => '0',
			]
		);


		$this->add_control(
			'advance_tab',
			[
				'label'       => __( 'Tab Lists', 'cnv-school-addon' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'tab_label' => __( 'Tab #1', 'cnv-school-addon' ),
					],
					[
						'tab_label' => __( 'Tab #2', 'cnv-school-addon' ),
					],
					[
						'tab_label' => __( 'Tab #3', 'cnv-school-addon' ),
					],
				],
				'title_field' => '{{{ tab_label }}}',
			]
		);

		// Alignment
		$this->add_responsive_control(
			'tab_align',
			[
				'label'     => __( 'Alignment', 'cnv-school-addon' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Left', 'cnv-school-addon' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'cnv-school-addon' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'cnv-school-addon' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .cnv-dynamic-tabs-nav-wrapper' => 'text-align: {{VALUE}};',
				],
			]
		);

		// Spacing
		$this->add_responsive_control(
			'tab_spacing',
			[
				'label'      => __( 'Tabs Spacing', 'cnv-school-addon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 10,
						'step' => 0.1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} #cnv-dynamic-tabs.horizontal .cnv-dynamic-tabs-contents ' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section(); // End Buttons


		// Tab Label Style
		// =========================
		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Tab Label', 'cnv-school-addon' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		// Spacing
		$this->add_responsive_control(
			'tab_label_spacing',
			[
				'label'      => __( 'Tabs Spacing', 'cnv-school-addon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 150,
						'step' => 1,
					],
					'em' => [
						'min'  => 0,
						'max'  => 10,
						'step' => 0.1,
					],
				],
				'selectors'  => [
					'{{WRAPPER}} #cnv-dynamic-tabs.horizontal #cnv-dynamic-tabs-nav.style-one li:not(:last-child)' => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #cnv-dynamic-tabs.horizontal #cnv-dynamic-tabs-nav.style-two li:nth-child(-n+2)'  => 'margin-right: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} #cnv-dynamic-tabs.vertical #cnv-dynamic-tabs-nav li:not(:last-child)'             => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'tab_icon_spacing',
			[
				'label'      => __( 'Icon Spacing', 'cnv-school-addon' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em' ],
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
				],
				'selectors'  => [
					'{{WRAPPER}} #cnv-dynamic-tabs #cnv-dynamic-tabs-nav li .nav-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
				],
			]
		);

		// Typography
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'tab_label_typography',
				'label'    => __( 'Typography', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} #cnv-dynamic-tabs #cnv-dynamic-tabs-nav li a',
			]
		);

		// Padding
		$this->add_responsive_control(
			'tab_label_padding',
			[
				'label'      => __( 'Padding', 'cnv-school-addon' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} #cnv-dynamic-tabs #cnv-dynamic-tabs-nav li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Normal
		$this->start_controls_tabs( 'tab_label_style_tabs' );

		// Normal
		$this->start_controls_tab( 'tab_label_style_normal_tab', [ 'label' => __( 'Normal', 'cnv-school-addon' ) ] );

		$this->add_control(
			'tab_label_color',
			[
				'label'     => __( 'Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #cnv-dynamic-tabs #cnv-dynamic-tabs-nav li a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tab_label_bg_color',
			[
				'label'     => __( 'Background Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #cnv-dynamic-tabs #cnv-dynamic-tabs-nav li a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		// Hover

		$this->start_controls_tab( 'tab_label_style_hover_tab', [ 'label' => __( 'Hover', 'cnv-school-addon' ) ] );

		$this->add_control(
			'tab_label_hover_color',
			[
				'label'     => __( 'Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #cnv-dynamic-tabs #cnv-dynamic-tabs-nav li a:hover' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tab_label_hover_bg_color',
			[
				'label'     => __( 'Background Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #cnv-dynamic-tabs #cnv-dynamic-tabs-nav li a:hover' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();

		// Active
		$this->start_controls_tab( 'tab_label_style_active_tab', [ 'label' => __( 'Active', 'cnv-school-addon' ) ] );

		$this->add_control(
			'tab_label_active_color',
			[
				'label'     => __( 'Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #cnv-dynamic-tabs #cnv-dynamic-tabs-nav li.active a' => 'color: {{VALUE}}',
					'{{WRAPPER}} .tab-swipe-line'                                     => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'tab_label_active_bg_color',
			[
				'label'     => __( 'Background Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #cnv-dynamic-tabs #cnv-dynamic-tabs-nav li.active a' => 'background-color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();
		$this->end_controls_section();
	}

	protected function render() {

		$settings    = $this->get_settings();
		$advance_tab = isset( $settings['advance_tab'] ) ? $settings['advance_tab'] : '';

		// Tab Nav render attributes
		$this->add_render_attribute( 'tab_nav', 'class', 'cnv-dynamic-tabs-nav' );
		$this->add_render_attribute( 'tab_nav', 'id', 'cnv-dynamic-tabs-nav' );

		if ( ! empty( $settings['tab_style'] ) ) {
			$this->add_render_attribute( 'tab_nav', 'class', $settings['tab_style'] );
		}

		if ( $settings['tab_style'] == 'style-two' ) {
			$this->add_render_attribute( 'tab_nav', 'class', 'tab-swipe' );
		}

		// Tab Content render attributes
		$this->add_render_attribute( 'tab_wrapper', 'class', 'cnv-dynamic-tabs' );
		$this->add_render_attribute( 'tab_wrapper', 'id', 'cnv-dynamic-tabs' );

		if ( $settings['tab_layout'] == 'vertical' ) {
			$this->add_render_attribute( 'tab_wrapper', 'class', 'vertical' );
		}

		if ( $settings['tab_layout'] == 'horizontal' ) {
			$this->add_render_attribute( 'tab_wrapper', 'class', 'horizontal' );
		}

		?>


		<div <?php echo $this->get_render_attribute_string( 'tab_wrapper' ) ?>>
			<div class="cnv-dynamic-tabs-nav-wrapper">
			<ul <?php echo $this->get_render_attribute_string( 'tab_nav' ) ?>>
				<?php
				$id_int = 'cnv-tabs-id-' . substr( $this->get_id_int(), 0, 3 );
				foreach ( $advance_tab as $key => $tabitem ) : ?>
					<li class="elementor-repeater-item-<?php echo esc_attr( $tabitem['_id'] ); ?>">
						<a href="#<?php echo esc_attr( $id_int . '-' . $key ); ?>">

							<?php if ( $tabitem['tab_icon_type'] == 'icon' ) : ?>
								<?php if ( $tabitem['tab_icon_pack'] == 'font_awesome' ) : ?>
									<span class="nav-icon">
                                    <?php \Elementor\Icons_Manager::render_icon( $tabitem['nav_icon'], [ 'aria-hidden' => 'true' ] ); ?>
                                </span>
								<?php else: ?>
									<span class="nav-icon">
                                       <?php if ( ! empty( $tabitem['tab_icon'] ) ) : ?>
										   <i class="<?php echo esc_attr( $tabitem['tab_icon'] ); ?>"></i>
                                       <?php endif; ?>
                                    </span>
								<?php endif; ?>
							<?php endif; ?>
							<span><?php echo esc_html( $tabitem['tab_label'] ); ?></span>

							<?php if ( ! empty( $tabitem['tab_badge_text']) ) : ?>
								<span class="tab-badge"><?php echo esc_html( $tabitem['tab_badge_text'] ); ?></span>
							<?php endif; ?>
						</a>
					</li>
				<?php endforeach; ?>

				<?php if ( $settings['tab_style'] == 'style-two' ) : ?>
					<li class="tab-swipe-line"></li>
				<?php endif; ?>
			</ul>
			</div>

			<div id="cnv-dynamic-tabs-content" class="cnv-dynamic-tabs-wrapper">
				<?php foreach ( $advance_tab as $key => $tabitem ) : ?>
					<div id="<?php echo esc_attr( $id_int . '-' . $key ); ?>" class="content">
						<div class="cnv-dynamic-tabs-contents">
							<?php if ( ! empty( $tabitem['template_id'] ) ) {
								$template_id      = $tabitem['template_id'];
								$template_content = \Elementor\Plugin::$instance->frontend->get_builder_content_for_display( $template_id );
								echo $template_content;
							} ?>

						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<!-- cnv-dynamic-tabs-content -->
		</div>

		<?php
	}
}

// Applying upwork job message
	// job description: ave a site on WordPress that needs to be updated to meet SEO standards and improve the speed\performance.
		// replay: I can do this job. I have 5 years of experience in WordPress. I have done more than 100 projects in WordPress. I am expert in WordPress theme development, plugin development, theme customization, plugin customization, WordPress SEO, WordPress speed optimization, WordPress security, WordPress bug fixing, WordPress site migration, WordPress site backup, WordPress site restore, WordPress site transfer, WordPress site cloning, WordPress site staging, WordPress site hosting, WordPress site maintenance, WordPress site management, WordPress site security, WordPress site speed optimization, WordPress site SEO, WordPress site backup, WordPress site restore, WordPress site transfer, WordPress site cloning, WordPress site staging, WordPress site hosting, WordPress site maintenance, WordPress site management, WordPress site security, WordPress site speed optimization, WordPress site SEO, WordPress site backup, WordPress site restore, WordPress site transfer, WordPress site cloning, WordPress site staging, WordPress site hosting, WordPress site maintenance, WordPress site management, WordPress site security, WordPress site speed optimization, WordPress site SEO, WordPress site backup, WordPress site restore, WordPress site transfer, WordPress site cloning, WordPress site staging, WordPress site hosting, WordPress site maintenance, WordPress site management, WordPress site security, WordPress site speed optimization, WordPress site SEO, WordPress site backup, WordPress site restore, WordPress site transfer, WordPress site cloning, WordPress site staging, WordPress site hosting, WordPress site maintenance, WordPress site management, WordPress site security, WordPress site speed optimization, WordPress site SEO, WordPress site backup, WordPress site restore, WordPress site transfer, WordPress site cloning, WordPress site staging, WordPress site hosting, WordPress site maintenance, WordPress site management, WordPress site security, WordPress site speed optimization, WordPress site SEO, WordPress site backup, WordPress site restore, WordPress site transfer, WordPress site cloning, WordPress site staging, WordPress site hosting, WordPress site maintenance, WordPress site management, WordPress site security, WordPress site speed optimization, WordPress site SEO, WordPress site backup, WordPress site restore, WordPress site transfer, WordPress site cloning, WordPress site staging, WordPress site hosting, WordPress site maintenance, WordPress site management, WordPress site security, WordPress site speed optimization, WordPress site SEO, WordPress site backup, WordPress site restore, WordPress site transfer, WordPress site cloning, WordPress site staging, WordPress site hosting, WordPress site maintenance, WordPress site management, WordPress site security, WordPress site speed optimization, WordPress site SEO, WordPress site backup, WordPress site restore, WordPress site transfer, WordPress site cloning, WordPress site staging, WordPress site hosting, WordPress site maintenance, WordPress site management, WordPress