<?php

namespace CodeNestVentures\SchoolAddon\Widgets;


if (!defined('ABSPATH')) {
	exit;
}

use Elementor\{Controls_Manager,
	Group_Control_Background,
	Widget_Base,
	Group_Control_Typography,
	Group_Control_Box_Shadow,
	Group_Control_Border
};

class Pricing extends Widget_Base
{

	public function get_name()
	{
		return 'cnv-pricing';
	}

	public function get_title()
	{
		return __('CNV Pricing', 'cnv-school-addon');
	}

	public function get_icon()
	{
		return 'eicon-price-table';
	}

	public function get_categories()
	{
		return ['cnv-elements'];
	}

	protected function register_controls()
	{

		$this->start_controls_section('pricing', [
			'label' => __('Pricing', 'cnv-school-addon'),
		]);

		$this->add_control('layout', [
			'type'    => Controls_Manager::SELECT,
			'label'   => __('Layout', 'cnv-school-addon'),
			'default' => 'one',
			'options' => [
				'one'   => __('Style One', 'cnv-school-addon'),
				'two'   => __('Style Two', 'cnv-school-addon'),
				'three' => __('Style Three', 'cnv-school-addon'),
			],
		]);

		$this->end_controls_section();

		$this->start_controls_section('pricing_plane', [
			'label' => __('Pricing Plans', 'cnv-school-addon'),
			'tab'   => Controls_Manager::TAB_CONTENT,
		]);

		$this->add_control('featured_table', [
			'label'        => __('Do you want to feature it?', 'cnv-school-addon'),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __('Yes', 'your-plugin'),
			'label_off'    => __('No', 'your-plugin'),
			'return_value' => 'yes',
			'default'      => 'no',
		]);

		$this->add_control('table_title', [
			'label'       => __('Pricing Title', 'cnv-school-addon'),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => __('Standard', 'cnv-school-addon')
		]);

		$this->add_control('table_subtitle', [
			'label'       => __('Pricing Sub Title', 'cnv-school-addon'),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => __('Single User', 'cnv-school-addon'),
			'condition'   => [
				'layout' => 'one'
			]
		]);

		$this->add_control('table_price', [
			'label'       => __('Price', 'cnv-school-addon'),
			'type'        => Controls_Manager::TEXT,
			'label_block' => true,
			'default'     => __('19.00', 'cnv-school-addon')
		]);

		$this->add_control('currency', [
			'label'       => __('Currency', 'cnv-school-addon'),
			'type'        => Controls_Manager::TEXT,
			'label_block' => false,
			'default'     => '$'
		]);

		$this->add_control('period', [
			'label' => __('Period', 'cnv-school-addon'),
			'type'  => Controls_Manager::TEXT,
		]);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control('feature', [
			'label'       => __('Feature Title', 'cnv-school-addon'),
			'type'        => \Elementor\Controls_Manager::TEXT,
			'label_block' => true,
		]);

		$repeater->add_control('feature_before', [
			'label'   => __('Feature Before', 'cnv-school-addon'),
			'type'    => Controls_Manager::SELECT,
			'default' => 'include',
			'options' => [
				'include' => __('Include', 'cnv-school-addon'),
				'exclude' => __('Exclude', 'cnv-school-addon'),
				'bullet'  => __('Bullet', 'cnv-school-addon'),
			],
		]);

		$this->add_control('features', [
			'label'       => __('Repeater List', 'cnv-school-addon'),
			'type'        => \Elementor\Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default'     => [
				[
					'feature' => __('50 MB Disk Space', 'cnv-school-addon'),
				],
				[
					'feature' => __('2 Subdo Mains', 'cnv-school-addon'),
				],
				[
					'feature' => __(' 6 Email Accounts', 'cnv-school-addon'),
				],
				[
					'feature' => __('Analytics', 'cnv-school-addon'),
				],
				[
					'feature' => __('Phone & Mail Support', 'cnv-school-addon'),
				],
			],
			'title_field' => '{{{ feature }}}',
		]);

		$this->add_control('button_text', [
			'label'       => __('Button Text', 'cnv-school-addon'),
			'type'        => Controls_Manager::TEXT,
			'default'     => __('Get Started', 'cnv-school-addon'),
			'label_block' => true,
		]);

		$this->add_control('btn_url', [
			'label'       => __('Button URL', 'cnv-school-addon'),
			'type'        => Controls_Manager::URL,
			'placeholder' => __('https://your-link.com', 'cnv-school-addon'),
			'default'     => [
				'url' => '#',
			],
		]);

		$this->end_controls_section();


		/**
		 * Pricing Style
		 */
		$this->start_controls_section('section_title_style', [
			'label' => __('Pricing Header', 'cnv-school-addon'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		$this->add_control('title_color', [
			'label'     => __('Title Color', 'cnv-school-addon'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-pricing__title' => 'color: {{VALUE}};',
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __('Typography', 'cnv-school-addon'),
			'selector' => '{{WRAPPER}} .cnv-pricing__title',
		]);

		$this->add_responsive_control('title_space', [
			'label'     => esc_html__('Spacing', 'cnv-school-addon'),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 100,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .cnv-pricing__title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		]);

		$this->add_control('price_style', [
			'label'     => __('Price', 'cnv-school-addon'),
			'type'      => Controls_Manager::HEADING,
			'separator' => 'before',
		]);

		$this->add_control('price_color', [
			'label'     => __('Table Title Color', 'cnv-school-addon'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-pricing__price-wrap' => 'color: {{VALUE}} !important;',
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'price_typography',
			'label'    => __('Typography', 'cnv-school-addon'),
			'selector' => '{{WRAPPER}} .cnv-pricing__price-wrap',
		]);

		$this->add_control('period_color', [
			'label'     => __('Period Color', 'cnv-school-addon'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-pricing__period' => 'color: {{VALUE}} !important;',
			],
			'separator' => 'before'
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'period_typography',
			'label'    => __('Period Typography', 'cnv-school-addon'),
			'selector' => '{{WRAPPER}} .cnv-pricing__period',
		]);

		$this->end_controls_section();


		/**
		 * Feature Pricing Table Style
		 */
		$this->start_controls_section('section_fea_style', [
			'label' => __('Pricing Feature', 'cnv-school-addon'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		$this->add_control('feature_color', [
			'label'     => __('Color', 'cnv-school-addon'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-pricing__feature-list li' => 'color: {{VALUE}};',
			],
		]);

		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'     => 'feature_typography',
			'label'    => __('Typography', 'cnv-school-addon'),
			'selector' => '{{WRAPPER}} .cnv-pricing__feature-list li',
		]);

		$this->add_control('bullet_color', [
			'label'     => __('Bullet Color', 'cnv-school-addon'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .bullet' => 'background-color: {{VALUE}};',
			],
		]);

		$this->add_control('include_color', [
			'label'     => __('Include Icon Color', 'cnv-school-addon'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .ei-icon_check' => 'color: {{VALUE}};',
			],
		]);


		$this->add_control('include_bg_color', [
			'label'     => __('Include BG Color', 'cnv-school-addon'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-pricing__feature-list li i:not(.exclude)' => 'background: {{VALUE}};',
			],
			'condition' => [
				'layout' => 'three'
			]
		]);

		$this->add_control('exclude_color', [
			'label'     => __('Exclude Icon Color', 'cnv-school-addon'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .ei-icon_close, {{WRAPPER}} .exclude.ei-icon_check' => 'color: {{VALUE}};',
			],
		]);

		$this->add_control('exclude_bg_color', [
			'label'     => __('Exclude BG Color', 'cnv-school-addon'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .exclude.ei-icon_check' => 'background: {{VALUE}};',
			],
			'condition' => [
				'layout' => 'three'
			]
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'table_box_shadow_fea',
			'label'    => __('Box Shadow Hover', 'cnv-school-addon'),
			'selector' => '{{WRAPPER}} .single_pricing_plan.active:hover',
		]);

		$this->add_responsive_control('feature_space', [
			'label'     => esc_html__('Gap', 'cnv-school-addon'),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'min' => 0,
					'max' => 20,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .cnv-pricing__feature-list li:not(:last-child)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
			],
		]);

		$this->end_controls_section();

		// Button Style
		// =====================
		$this->start_controls_section('style_button', [
			'label' => __('Button', 'cnv-school-addon'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		$this->start_controls_tabs('tabs_button_style');

		$this->start_controls_tab('tab_button_normal', [
			'label' => __('Normal', 'cnv-school-addon'),
		]);

		$this->add_control('button_text_color', [
			'label'     => __('Text Color', 'cnv-school-addon'),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .gpt-btn' => 'color: {{VALUE}};',
			],
		]);

		$this->add_control('button_bg_color', [
			'label'     => __('Background Color', 'cnv-school-addon'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-btn, {{WRAPPER}} .gpt-btn.featured_btn' => 'background-color: {{VALUE}};',
			],
		]);

		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'button_border',
			'label'    => __('Border', 'cnv-school-addon'),
			'selector' => '{{WRAPPER}} .gpt-btn, {{WRAPPER}} .gpt-btn.featured_btn',
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow',
			'label'    => __('Box Shadow', 'cnv-school-addon'),
			'selector' => '{{WRAPPER}} .gpt-btn, {{WRAPPER}} .gpt-btn.featured_btn',
		]);

		$this->end_controls_tab();

		$this->start_controls_tab('tab_button_hover', [
			'label' => __('Hover', 'cnv-school-addon'),
		]);

		$this->add_control('hover_color', [
			'label'     => __('Color', 'cnv-school-addon'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-btn:hover, {{WRAPPER}} .gpt-btn.featured_btn:hover' => 'color: {{VALUE}};',
			],
		]);

		$this->add_control('button_hover_bg_color', [
			'label'     => __('Background Color', 'cnv-school-addon'),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .gpt-btn:hover, {{WRAPPER}} .gpt-btn.featured_btn:hover' => 'background-color: {{VALUE}};',
			]
		]);

		$this->add_group_control(Group_Control_Border::get_type(), [
			'name'     => 'button_hover_border',
			'label'    => __('Border', 'cnv-school-addon'),
			'selector' => '{{WRAPPER}} .gpt-btn:hover',
		]);

		$this->add_group_control(Group_Control_Box_Shadow::get_type(), [
			'name'     => 'button_box_shadow_hover',
			'label'    => __('Box Shadow', 'cnv-school-addon'),
			'selector' => '{{WRAPPER}} .gpt-btn:hover, {{WRAPPER}} .gpt-btn.featured_btn:hover',
		]);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control(Group_Control_Typography::get_type(), [
			'name'      => 'button_typography',
			'label'     => __('Typography', 'cnv-school-addon'),
			'selector'  => '{{WRAPPER}} .gpt-btn',
			'separator' => 'before'
		]);

		$this->add_control('padding', [
			'label'      => __('Padding', 'cnv-school-addon'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .gpt-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->add_control('border-radius', [
			'label'      => __('Border Radius', 'cnv-school-addon'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .gpt-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->end_controls_section();


		$this->start_controls_section('style_pricing_box', [
			'label' => __('Pricing Box', 'cnv-school-addon'),
			'tab'   => Controls_Manager::TAB_STYLE,
		]);

		$this->start_controls_tabs('tabs_pricing_style');

		$this->start_controls_tab('tab_pricing_normal', [
			'label' => __('Normal', 'cnv-school-addon'),
		]);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'pricing_background',
				'label'    => __('Background', 'cnv-school-addon'),
				'types'    => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .cnv-pricing',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'pricing_border',
				'selector' => '{{WRAPPER}} .cnv-pricing',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'pricing_box_shadow',
				'label'    => __('Box Shadow', 'cnv-school-addon'),
				'selector' => '{{WRAPPER}} .cnv-pricing',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab('tab_pricing_hover', [
			'label' => __('Hover', 'cnv-school-addon'),
		]);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'pricing_background_hover',
				'label'    => __('Background', 'cnv-school-addon'),
				'types'    => ['classic', 'gradient', 'video'],
				'selector' => '{{WRAPPER}} .cnv-pricing:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'pricing_border_hover',
				'selector' => '{{WRAPPER}} .cnv-pricing:hover',
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'pricing_hover_box_shadow',
				'label'    => __('Box Shadow', 'cnv-school-addon'),
				'selector' => '{{WRAPPER}} .cnv-pricing:hover',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_control('pricing_padding', [
			'label'      => __('Padding', 'cnv-school-addon'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .cnv-pricing' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->add_control('pricing_border-radius', [
			'label'      => __('Border Radius', 'cnv-school-addon'),
			'type'       => Controls_Manager::DIMENSIONS,
			'size_units' => ['px', '%', 'em'],
			'selectors'  => [
				'{{WRAPPER}} .cnv-pricing' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
		]);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings();

		$this->add_render_attribute('pricing', 'class', 'cnv-pricing');

		if (!empty($settings['layout'])) {
			$this->add_render_attribute('pricing', 'class', 'cnv-pricing-' . $settings['layout']);
		}

		if ($settings['featured_table'] == 'yes') {
			$this->add_render_attribute('pricing', 'class', 'cnv-pricing-featured');
		}

		?>
		<div <?php echo $this->get_render_attribute_string('pricing'); ?>>
			<div class="cnv-pricing__header">
				<?php if ($settings['layout'] == 'two' || $settings['layout'] == 'three') : ?>
					<?php if ($settings['table_title']): ?>
						<h2 class="cnv-pricing__title"><?php esc_html_e($settings['table_title']); ?></h2>
					<?php endif; ?>
				<?php endif; ?>

				<?php if ($settings['table_price']): ?>
					<h3 class="cnv-pricing__price">
						<?php if (!empty($settings['table_price'])): ?>
						<span class="cnv-pricing__price-wrap"><span class="currency"><?php esc_html_e($settings['currency']); ?></span><?php endif; ?><span><?php esc_html_e($settings['table_price']); ?></span><?php if ($settings['period']): ?></span><span
						class="cnv-pricing__period"><?php esc_html_e($settings['period']); ?></span>
					<?php endif; ?>
					</h3>
				<?php endif; ?>

				<?php if ($settings['layout'] == 'one') : ?>
					<?php if ($settings['table_title']): ?>
						<h2 class="cnv-pricing__title"><?php esc_html_e($settings['table_title']); ?></h2>
					<?php endif; ?>

					<?php if ($settings['table_subtitle']): ?>
						<h5 class="cnv-pricing__subtitle"><?php esc_html_e($settings['table_subtitle']); ?></h5>
					<?php endif; ?>
				<?php endif; ?>

			</div>

			<div class="cnv-pricing__feature-lists">
				<ul class="cnv-pricing__feature-list">
					<?php foreach ($settings['features'] as $item) : ?>
						<li>
							<?php if ($item['feature_before'] == 'include') : ?>
								<i class="ei ei-icon_check"></i>
							<?php elseif ($item['feature_before'] == 'exclude'): ?>
								<?php if ($settings['layout'] == 'three') : ?>
									<i class="ex ei ei-icon_check exclude"></i>
								<?php else: ?>
									<i class="ei ei-icon_close"></i>
								<?php endif; ?>
							<?php elseif ($item['feature_before'] == 'bullet') : ?>
								<span class="bullet"></span>
							<?php endif; ?>
							<?php esc_html_e($item['feature']); ?>
						</li>
					<?php endforeach; ?>
				</ul>
				<!-- /.cnv-pricing__feature-list -->
			</div>
			<!-- /.cnv-pricing__feature-lists -->

			<?php if ($settings['btn_url']['url']) : ?>
				<div class="cnv-pricing__action">
					<a href="<?php echo esc_url($settings['btn_url']['url']); ?>"
					   class="cnv-btn <?php echo $settings['featured_table'] == 'yes' ? 'featured_btn' : 'btn-outline' ?> ">
						<?php esc_html_e($settings['button_text']) ?>
					</a>
				</div>
				<!-- /.gp-pricing__action -->
			<?php endif; ?>
		</div>
		<!-- /.cnv-pricing -->
		<?php
	}
}