<?php

namespace CodeNestVentures\SchoolAddon\Widgets;


use Elementor\{Controls_Manager, Group_Control_Box_Shadow, Group_Control_Image_Size, Widget_Base, Group_Control_Typography, Group_Control_Background};
use CodeNestVentures\SchoolAddon\ImageSize;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class ProjectSlider extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'cnv-project-slider';
	}

	// public function get_id() {
	//    	return 'header-search';
	// }

	public function get_title() {
		return __( 'CNV Project Slider', 'cnv-school-addon' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-photo-library';
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

	protected function register_controls() {


		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Project Slider', 'cnv-school-addon' ),
			]
		);

		$this->add_control(
			'layout',
			[
				'label'   => __( 'Style', 'cnv-school-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'style-one',
				'options' => [
					'style-one' => __( 'Style One', 'cnv-school-addon' ),
					'style-two' => __( 'Style Two', 'cnv-school-addon' ),
				],
			]
		);

		// Overlay Link Text
		$this->add_control(
			'overlay_link_text',
			[
				'label'       => esc_html__( 'Overlay Link Text', 'cnv-school-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'Case<br> Studio',
				'placeholder' => esc_html__( 'Type your title here', 'cnv-school-addon' ),
				'label_block' => true,
				'condition'   => [
					'layout' => 'style-one',
				],
			]
		);

		$this->add_control( 'thumbnail_default_size', [
			'label'        => esc_html__( 'Use Default Thumbnail Size', 'cnv-school-addon' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '1',
			'return_value' => '1',
			'separator'    => 'before',
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'thumbnail_default_size!' => '1',
			],
		] );

		$this->add_control(
			'project_cat',
			[
				'label'       => esc_html__( 'Select category', 'cnv-school-addon' ),
				'type'        => Controls_Manager::SELECT2,
				'multiple'    => true,
				'label_block' => true,
				'options'     => \CNV_helper::cnv_category_list( 'project_category' ),
				'default'     => '0'
			]
		);


		$this->add_control(
			'ids',
			[
				'label'       => __( 'Enter Work IDs', 'cnv-school-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
				'description' => __( "Enter Work ids to show, separated by a comma. Leave empty to show all.", 'cnv-school-addon' )

			]
		);
		$this->add_control(
			'ids_not',
			[
				'label'       => __( 'Or Work IDs to Exclude', 'cnv-school-addon' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => '',
				'label_block' => true,
				'description' => __( "Enter Work ids to exclude, separated by a comma (,). Use if the field above is empty.", 'cnv-school-addon' )

			]
		);

		$this->add_control(
			'order_by',
			[
				'label'       => __( 'Order by', 'cnv-school-addon' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'date'          => esc_html__( 'Date', 'cnv-school-addon' ),
					'ID'            => esc_html__( 'ID', 'cnv-school-addon' ),
					'author'        => esc_html__( 'Author', 'cnv-school-addon' ),
					'title'         => esc_html__( 'Title', 'cnv-school-addon' ),
					'modified'      => esc_html__( 'Modified', 'cnv-school-addon' ),
					'rand'          => esc_html__( 'Random', 'cnv-school-addon' ),
					'comment_count' => esc_html__( 'Comment Count', 'cnv-school-addon' ),
					'menu_order'    => esc_html__( 'Menu Order', 'cnv-school-addon' ),
				],
				'default'     => 'date',
				'separator'   => 'before',
				'description' => esc_html__( "Select how to sort retrieved posts. More at ", 'cnv-school-addon' ) . '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.',
			]
		);

		$this->add_control(
			'order',
			[
				'label'       => __( 'Sort Order', 'cnv-school-addon' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'ASC'  => esc_html__( 'Ascending', 'cnv-school-addon' ),
					'DESC' => esc_html__( 'Descending', 'cnv-school-addon' ),
				],
				'default'     => 'DESC',
				'separator'   => 'before',
				'description' => esc_html__( "Select Ascending or Descending order. More at", 'cnv-school-addon' ) . '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.',
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'       => __( 'Work to show', 'cnv-school-addon' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '6',
				'description' => esc_html__( "Number of work to show (-1 for all).", 'cnv-school-addon' ),
				'min'         => - 1,
			]
		);


		$this->end_controls_section();

		$this->start_controls_section( 'settingd_section', [
			'label' => esc_html__( 'Slider Control', 'cnv-school-addon' ),
		] );

		$this->add_control(
			'slide_view',
			[
				'label'   => __( 'Slide Column', 'cnv-school-addon' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '3',
				'options' => [
					'2' => __( '2', 'cnv-school-addon' ),
					'3' => __( '3', 'cnv-school-addon' ),
					'4' => __( '4', 'cnv-school-addon' ),
				],
			]
		);

		$this->add_control(
			'slider_gap',
			[
				'label'   => __( 'Slider Gap', 'cnv-school-addon' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 43,
			]
		);

		$this->add_control(
			'slider_navigation',
			[
				'label'        => esc_html__( 'Navigation', 'cnv-school-addon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'cnv-school-addon' ),
				'label_off'    => esc_html__( 'Hide', 'cnv-school-addon' ),
				'return_value' => 'yes',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'loop',
			[
				'label'        => esc_html__( 'Loop', 'cnv-school-addon' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'cnv-school-addon' ),
				'label_off'    => esc_html__( 'Off', 'cnv-school-addon' ),
				'return_value' => 'true',
				'default'      => 'yes'
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
				'return_value' => 'true',
				'default'      => 'yes'
			]
		);

		$this->add_control(
			'autoplay_time',
			[
				'label'   => __( 'Autoplay Time', 'cnv-school-addon' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 9000,
			]
		);


		$this->end_controls_section();

		//Title Style Section
		//=========================
		$this->start_controls_section( 'title_project_style', [
			'label'     => esc_html__( 'Title', 'cnv-school-addon' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'layout' => 'style-two'
			]
		] );

		$this->add_control( 'project_title_color', [
			'label'     => esc_html__( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-project-slider__title a' => 'color: {{VALUE}};'
			],
		] );

		$this->add_control( 'project_title_color_hover', [
			'label'     => esc_html__( 'Hover color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-project-slider__title a:hover' => 'color: {{VALUE}};'
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'label'    => esc_html__( 'Title Typography', 'cnv-school-addon' ),
			'name'     => 'project_title_typography',
			'selector' => '{{WRAPPER}} .cnv-project-slider__title',
		] );

		$this->end_controls_section();

		// Hover overlay Link Style Section
		//=========================
		$this->start_controls_section( 'section_project_hover_style', [
			'label'     => esc_html__( 'Hover Overlay Link', 'cnv-school-addon' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'layout' => 'style-one'
			]
		] );

		$this->add_control( 'project_hover_link_color', [
			'label'     => esc_html__( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-project__permalink' => 'color: {{VALUE}};'
			],
		] );

		$this->add_control( 'project_hover_link_bg_color', [
			'label'     => esc_html__( 'Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-project__permalink' => 'background-color: {{VALUE}};'
			],
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'label'    => esc_html__( 'Typography', 'cnv-school-addon' ),
			'name'     => 'project_hover_link_typography',
			'selector' => '{{WRAPPER}} .cnv-project__permalink',
		] );

		//Height/Width
		$this->add_control( 'project_hover_link_height', [
			'label'      => esc_html__( 'Height', 'cnv-school-addon' ),
			'type'       => Controls_Manager::SLIDER,
			'size_units' => [ 'px', '%' ],
			'range'      => [
				'px' => [
					'min'  => 100,
					'max'  => 230,
					'step' => 1,
				],
				'%'  => [
					'min'  => 10,
					'max'  => 100,
					'step' => 1,
				],
			],
			'selectors'  => [
				'{{WRAPPER}} .cnv-project__permalink' => 'height: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
			],
		] );


		$this->end_controls_section();
		//Title Style Section
		//=========================
		$this->start_controls_section( 'section_project_style', [
			'label'     => esc_html__( 'Category', 'cnv-school-addon' ),
			'tab'       => Controls_Manager::TAB_STYLE,
			'condition' => [
				'layout' => 'style-two'
			]
		] );

		$this->add_control( 'project_cat_color', [
			'label'     => esc_html__( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-project-slider__cat-item' => 'color: {{VALUE}};'
			],
			'separator' => 'before'
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'label'    => esc_html__( 'Typography', 'cnv-school-addon' ),
			'name'     => 'project_cat_typography',
			'selector' => '{{WRAPPER}} .cnv-project-slider__cat-item',
		] );

		$this->add_control( 'project_image_overlay_color_hover', [
			'label'     => esc_html__( 'Image Overlay color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .cnv-project-slider__thumbnail a:before' => 'background-color: {{VALUE}};'
			],
			'separator' => 'before'
		] );

		$this->end_controls_section();

		// Portfolio
		//=========================
		$this->start_controls_section( 'section_portfolio_style', [
			'label' => esc_html__( 'Portfolio', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );


		// Portfolio Info Padding
		$this->add_responsive_control(
			'portfolio_info_padding',
			[
				'label'      => esc_html__( 'Padding Info', 'cnv-school-addon' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .cnv-project-slider__info' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition'  => [
					'layout' => 'style-two'
				]
			]
		);

		// Border Radius
		$this->add_control(
			'portfolio_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'cnv-school-addon' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .cnv-project-slider.style-one .cnv-project-slider__thumbnail, {{WRAPPER}} .cnv-project-slider.style-two' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		// Box Shadow
		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'label'     => esc_html__( 'Box Shadow', 'cnv-school-addon' ),
				'name'      => 'portfolio_box_shadow',
				'selector'  => '{{WRAPPER}} .cnv-project-slider.style-two',
				'condition' => [
					'layout' => 'style-two'
				]
			]
		);

	}

	protected function render() {

		$settings = $this->get_settings();

		$this->add_render_attribute( 'wrapper', 'class', [
			'swiper-container',
			'cnv-project__sliders'
		] );

		$slider_options = $this->get_slider_options( $settings );
		$this->add_render_attribute( 'wrapper', 'data-swiper', wp_json_encode( $slider_options ) );

		?>

		<div class="cnv-project-slider__wrapper">
			<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
				<?php if ( $settings['slider_navigation'] == 'yes' ) : ?>
					<div class="cnv-project__prev">
						<svg width="22" height="16" viewBox="0 0 22 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M1.04108 7.18181C0.650553 7.57233 0.650553 8.2055 1.04108 8.59602L7.40504 14.96C7.79556 15.3505 8.42873 15.3505 8.81925 14.96C9.20978 14.5695 9.20978 13.9363 8.81925 13.5458L3.1624 7.88892L8.81925 2.23206C9.20978 1.84154 9.20978 1.20837 8.81925 0.817848C8.42873 0.427324 7.79556 0.427324 7.40504 0.817848L1.04108 7.18181ZM21.5186 6.88892L1.74818 6.88892V8.88892L21.5186 8.88892V6.88892Z"
								fill="#000D44"/>
						</svg>

					</div>
				<?php endif; ?>
				<div class="swiper-wrapper">
					<?php

					$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
					$args  = array(
						'post_type'      => 'project',
						'paged'          => $paged,
						'order'          => $settings['order'],
						'orderby'        => $settings['order_by'],
						'posts_per_page' => $settings['posts_per_page'],
					);

					if ( ! empty( $settings['project_cat'] ) ) {
						$args['tax_query'] = array(
							array(
								'taxonomy' => 'project_category',
								'field'    => 'slug',
								'terms'    => $settings['project_cat'],
							),
						);
					}

					if ( ! empty( $settings['ids'] ) ) {
						$ids              = explode( ',', $settings['ids'] );
						$args['post__in'] = $ids;
					}

					if ( ! empty( $settings['ids_not'] ) ) {
						$ids_not              = explode( ',', $settings['ids_not'] );
						$args['post__not_in'] = $ids_not;
					}

					$project = new \WP_Query( $args );

					if ( $project->have_posts() ) :
						while ( $project->have_posts() ) : $project->the_post(); ?>
							<div <?php post_class( 'swiper-slide' ); ?>>
								<figure class="cnv-project-slider <?php echo $settings['layout']; ?>">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="cnv-project-slider__thumbnail">

											<?php $size = ImageSize::elementor_parse_image_size( $settings, 'cnv_project_slider' ); ?>
											<?php ImageSize::the_post_thumbnail( array( 'size' => $size ) ); ?>

											<?php if ( 'style-one' == $settings['layout'] && ! empty( $settings['overlay_link_text'] ) ) : ?>
												<a href="<?php the_permalink(); ?>" class="cnv-project__permalink">
													<span><?php echo $settings['overlay_link_text']; ?></span>
												</a>
											<?php endif; ?>

										</div>
									<?php } ?>

									<?php if ( 'style-two' == $settings['layout'] ) : ?>
										<div class="cnv-project-slider__info">
											<div class="cnv-project-slider__cat-wrapper">
												<?php
												$terms = get_the_terms( get_the_ID(), 'project_category' );
												if ( $terms && ! is_wp_error( $terms ) ) :
													foreach ( $terms as $term ) { ?>
														<span class="cnv-project-slider__cat-item"><?php echo $term->name; ?></span>
													<?php } ?>
												<?php endif; ?>
											</div>

											<h3 class="cnv-project-slider__title">
												<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
											</h3>
										</div>
									<?php endif; ?>
								</figure>
							</div>
						<?php endwhile;
						wp_reset_postdata();
					endif; ?>
				</div>
				<?php if ( $settings['slider_navigation'] == 'yes' ) : ?>
					<div class="cnv-project__next">
						<svg width="21" height="16" viewBox="0 0 21 16" fill="none" xmlns="http://www.w3.org/2000/svg">
							<path
								d="M20.7071 8.70711C21.0976 8.31658 21.0976 7.68342 20.7071 7.2929L14.3431 0.928933C13.9526 0.538409 13.3195 0.538409 12.9289 0.928933C12.5384 1.31946 12.5384 1.95262 12.9289 2.34315L18.5858 8L12.9289 13.6569C12.5384 14.0474 12.5384 14.6805 12.9289 15.0711C13.3195 15.4616 13.9526 15.4616 14.3431 15.0711L20.7071 8.70711ZM-8.74228e-08 9L20 9L20 7L8.74228e-08 7L-8.74228e-08 9Z"
								fill="#030A39"/>
						</svg>

					</div>

				<?php endif; ?>
			</div>


		</div>
		<!-- /.project-slider-wrap -->

	<?php }

	protected function get_slider_options( array $settings ) {

		// Loop
		if ( $settings['loop'] ) {
			$slider_options['loop'] = (bool) $settings['loop'];
		}

		if ( $settings['slider_gap'] ) {
			$slider_options['spaceBetween'] = (int) $settings['slider_gap'];
		}

		// Speed
		if ( ! empty( $settings['speed'] ) ) {
			$slider_options['speed'] = $settings['speed'];
		}
		if ( $settings['autoplay'] ) {
			$slider_options['autoplay'] = (bool) $settings['autoplay'];
		}

		if ( $settings['autoplay'] ) {
			$slider_options['autoplay'] = [
				'delay' => $settings['autoplay_time']
			];
		}

		$slider_options['breakpoints'] = [
			'992' => [
				'slidesPerView' => (int) $settings['slide_view'],
			],

			'767' => [
				'slidesPerView' => 2,
				'spaceBetween'  => '30',

			],

			'576' => [
				'slidesPerView' => 1,
				'spaceBetween'  => '25',
			],

			'320' => [
				'slidesPerView' => 1,
				'spaceBetween'  => '20',
			],
		];

		$slider_options['navigation'] = [
			'nextEl' => '.cnv-project__next',
			'prevEl' => '.cnv-project__prev',
		];

		if ( $settings['slider_gap'] ) {
			$slider_options['spaceBetween'] = (int) $settings['slider_gap'];
		}

		return $slider_options;
	}
}
