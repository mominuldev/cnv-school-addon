<?php

namespace CodeNestVentures\SchoolAddon\Widgets;

use Elementor\{Group_Control_Image_Size,
	Plugin,
	Controls_Manager,
	Group_Control_Box_Shadow,
	Widget_Base,
	Group_Control_Typography,
	Repeater,
	Utils
};

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Project extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve alert widget name.
	 *
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 *
	 */
	public function get_name() {
		return 'cnv-project';
	}

	public function get_title() {
		return __( 'CNV Project', 'cnv-school-addon' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'eicon-photo-library';
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

	public function get_script_depends() {
		wp_register_script( 'cnv-portfolio', CNV_PLUGIN_URL . 'assets/js/portfolio.js', [ 'elementor-frontend' ], '1.0.0', true );
		return ['cnv-portfolio' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Project', 'cnv-school-addon' ),
			]
		);

		// Layout
		// =====================

		$this->add_control( 'layout', [
			'label'   => esc_html__( 'Layout', 'cnv-school-addon' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'grid'    => esc_html__( 'Grid', 'cnv-school-addon' ),
				'masonry' => esc_html__( 'Masonry', 'cnv-school-addon' ),
				'metro'   => esc_html__( 'Metro', 'cnv-school-addon' ),
			],
			'default' => 'grid',
		] );


		$this->add_control( 'filter', [
			'label'        => esc_html__( 'Filter', 'cnv-school-addon' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'cnv-school-addon' ),
			'label_off'    => __( 'No', 'cnv-school-addon' ),
			'return_value' => 'yes',
			'default'      => true,
		] );

		$this->add_control( 'filter_button_style', [
			'label'   => esc_html__( 'Filter Style', 'cnv-school-addon' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				'style_one'    => esc_html__( 'Style One', 'cnv-school-addon' ),
				'style_two' => esc_html__( 'Style Two', 'cnv-school-addon' ),
				'style_three'   => esc_html__( 'Style Three', 'cnv-school-addon' ),
			],
			'default' => 'style_one',
			'condition' => [
				'filter' => 'yes',
			],
		] );


		$this->add_responsive_control('list_align', [
			'label'   => __('Filter Alignment', 'cnv-school-addon'),
			'type'    => Controls_Manager::CHOOSE,
			'options' => [
				'left'  => [
					'title' => __('Left', 'cnv-school-addon'),
					'icon'  => 'eicon-text-align-left',
				],
				'center'   => [
					'title' => __('Center', 'cnv-school-addon'),
					'icon'  => 'eicon-text-align-center',
				],
				'right' => [
					'title' => __('Right', 'cnv-school-addon'),
					'icon'  => 'eicon-text-align-right',
				],
			],
			'toggle'  => false,
			'default' => 'center',
			'selectors' => [
				'{{WRAPPER}} .cnv-filter-buttons' => 'text-align: {{VALUE}};'
			],
			'condition' => [
				'filter' => 'yes',
			],
			'separator' => 'after',
		]);

		// More Options
		// =====================
		$this->add_control( 'more_options', [
			'label'        => esc_html__( 'More Options', 'cnv-school-addon' ),
			'type'         => Controls_Manager::HEADING,
		] );

		$this->add_responsive_control( 'zigzag_height', [
			'label'     => esc_html__( 'Zigzag Height', 'cnv-school-addon' ),
			'type'      => Controls_Manager::NUMBER,
			'step'      => 1,
			'condition' => [
				'layout' => 'masonry',
			],
		] );

		$this->add_control( 'zigzag_reversed', [
			'label'     => esc_html__( 'Zigzag Reversed?', 'cnv-school-addon' ),
			'type'      => Controls_Manager::SWITCHER,
			'condition' => [
				'layout' => 'masonry',
			],
		] );

		$this->add_control( 'reveal_animation', [
			'label'        => esc_html__( 'Scroll Reveal Animation', 'cnv-school-addon' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'cnv-school-addon' ),
			'label_off'    => __( 'No', 'cnv-school-addon' ),
			'return_value' => 'yes',
			'default'      => false,

		] );

		$this->add_control( 'hover_effect', [
			'label'        => esc_html__( 'Hover Effect', 'cnv-school-addon' ),
			'type'         => Controls_Manager::SELECT,
			'options'      => [
				''         => esc_html__( 'None', 'cnv-school-addon' ),
				'zoom-in'  => esc_html__( 'Zoom In', 'cnv-school-addon' ),
				'zoom-out' => esc_html__( 'Zoom Out', 'cnv-school-addon' ),
			],
			'default'      => '',
			'prefix_class' => 'cnv-animation-',
		] );

		$this->add_control( 'overlay_style', [
			'label'   => esc_html__( 'Overlay', 'cnv-school-addon' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				''              => esc_html__( 'None', 'cnv-school-addon' ),
				'cnv-project--overlay-one'   => esc_html__( 'Style One', 'cnv-school-addon' ),
				'cnv-project--overlay-two'   => esc_html__( 'Style Two', 'cnv-school-addon' ),
				'cnv-project--overlay-three' => esc_html__( 'Style Three', 'cnv-school-addon' ),
			],
			'default' => 'overlay-one',
		] );


		$this->add_control( 'grid_animation', [
			'label'   => esc_html__( 'Grid Animation', 'cnv-school-addon' ),
			'type'    => Controls_Manager::SELECT,
			'options' => [
				''           => esc_html__( 'None', 'cnv-school-addon' ),
				'dtZoom'     => esc_html__( 'Zoom', 'cnv-school-addon' ),
				'fadeInUp'   => esc_html__( 'Fade In Up', 'cnv-school-addon' ),
				'fadeInDown' => esc_html__( 'Fade In Down', 'cnv-school-addon' ),
			],
			'default' => '',
		] );

		$this->add_control( 'show_caption', [
			'label'     => esc_html__( 'Show Caption?', 'cnv-school-addon' ),
			'type'      => Controls_Manager::SWITCHER,
			'condition' => [
				'layout' => 'masonry',
			],
		] );

		$this->add_control( 'tilt-effect', [
			'label'   => esc_html__( 'Enable Tilt Effect', 'cnv-school-addon' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => false
		] );


		$this->add_control( 'metro_image_size_width', [
			'label'     => esc_html__( 'Image Size', 'cnv-school-addon' ),
			'type'      => Controls_Manager::NUMBER,
			'step'      => 1,
			'default'   => 480,
			'condition' => [
				'layout' => 'metro',
			],
		] );

		$this->add_control( 'metro_image_ratio', [
			'label'     => esc_html__( 'Image Ratio', 'cnv-school-addon' ),
			'type'      => Controls_Manager::SLIDER,
			'range'     => [
				'px' => [
					'max'  => 2,
					'min'  => 0.10,
					'step' => 0.01,
				],
			],
			'default'   => [
				'size' => 0.8,
			],
			'condition' => [
				'layout' => 'metro',
			],
		] );

		$this->add_control( 'thumbnail_default_size', [
			'label'        => esc_html__( 'Use Default Thumbnail Size', 'billey' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '1',
			'return_value' => '1',
			'separator'    => 'before',
			'condition'    => [
				'layout!' => 'metro',
			],
		] );

		$this->add_group_control( Group_Control_Image_Size::get_type(), [
			'name'      => 'thumbnail',
			'default'   => 'full',
			'condition' => [
				'layout!'                 => 'metro',
				'thumbnail_default_size!' => '1',
			],
		] );


		$this->end_controls_section();

		// Grid Settings
		// =====================

		$this->start_controls_section( 'grid_options_section', [
			'label' => esc_html__( 'Grid Options', 'cnv-school-addon' ),
		] );

		$this->add_responsive_control( 'grid_columns', [
			'label'          => esc_html__( 'Columns', 'cnv-school-addon' ),
			'type'           => Controls_Manager::NUMBER,
			'min'            => 1,
			'max'            => 12,
			'step'           => 1,
			'default'        => 3,
			'tablet_default' => 2,
			'mobile_default' => 1,
		] );

		$this->add_control( 'grid_columns_tablet', [
			'label'          => esc_html__( 'Columns Tablet', 'cnv-school-addon' ),
			'type'           => Controls_Manager::NUMBER,
			'min'            => 1,
			'max'            => 12,
			'step'           => 1,
			'default'        => 2,
//			'tablet_default' => 2,
//			'mobile_default' => 1,
		] );

		$this->add_control( 'grid_columns_mobile', [
			'label'          => esc_html__( 'Columns Tablet', 'cnv-school-addon' ),
			'type'           => Controls_Manager::NUMBER,
			'min'            => 1,
			'max'            => 12,
			'step'           => 1,
			'default'        => 1,
//			'tablet_default' => 2,
//			'mobile_default' => 1,
		] );

		$this->add_responsive_control( 'grid_gutter', [
			'label'   => esc_html__( 'Gutter', 'cnv-school-addon' ),
			'type'    => Controls_Manager::NUMBER,
			'min'     => 0,
			'max'     => 200,
			'step'    => 1,
			'default' => 30,
		] );

		$metro_layout_repeater = new Repeater();

		$metro_layout_repeater->add_control( 'size', [
			'label'   => esc_html__( 'Item Size', 'cnv-school-addon' ),
			'type'    => Controls_Manager::SELECT,
			'default' => '1:1',
			'options' => \CNV_Helper::get_grid_metro_size(),
		] );

		$this->add_control( 'grid_metro_layout', [
			'label'       => esc_html__( 'Metro Layout', 'cnv-school-addon' ),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $metro_layout_repeater->get_controls(),
			'default'     => [
				[ 'size' => '1:1' ],
				[ 'size' => '1:1' ],
				[ 'size' => '1:1' ],
				[ 'size' => '1:1' ],
				[ 'size' => '2:1' ],
				[ 'size' => '1:1' ],
				[ 'size' => '1:2' ],
				[ 'size' => '1:2' ],
				[ 'size' => '1:1' ],
			],
			'title_field' => '{{{ size }}}',
			'condition'   => [
				'layout' => 'metro',
			],
		] );

		$this->end_controls_section();


		// Pagination Settings
		// =====================
		$this->start_controls_section( 'pagination_section', [
			'label' => esc_html__( 'Pagination', 'cnv-school-addon' ),
		] );

		$this->add_control( 'pagination_type', [
			'label'   => esc_html__( 'Pagination', 'cnv-school-addon' ),
			'type'    => Controls_Manager::SELECT,
			'options' => array(
				''          => esc_html__( 'None', 'cnv-school-addon' ),
				'numbers'   => esc_html__( 'Numbers', 'cnv-school-addon' ),
				'load-more' => esc_html__( 'Button', 'cnv-school-addon' ),

			),
			'default' => '',
		] );

		$this->add_control( 'load_more_text', [
			'label'       => esc_html__( 'Load More Button Text', 'cnv-school-addon' ),
			'description' => esc_html__( 'Input custom text to load more button', 'cnv-school-addon' ),
			'default'     => __( 'Load More', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'condition'   => [
				'pagination_type' => 'load-more',
			],
		] );

		$this->add_responsive_control(
			'load_btn_margin',
			[
				'label'      => __( 'Margin', 'cnv-school-addon' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .project-pagination-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],

			]
		);

		$this->end_controls_section();


		// Query Settings
		// =====================
		$this->start_controls_section( 'query_section', [
			'label' => esc_html__( 'Query', 'cnv-school-addon' ),
		] );

		$this->add_control(
			'posts_per_page',
			[
				'label'       => esc_html__( 'Items per page', 'cnv-school-addon' ),
				'description' => esc_html__( 'Number of items to show per page. Input "-1" to show all posts. Leave blank to use global setting.', 'cnv-school-addon' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '6',
				'min'         => - 1,
				'max'         => 100,
				'step'        => 1,
			]
		);
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
			'order_by',
			[
				'label'       => __( 'Order by', 'cnv-school-addon' ),
				'type'        => Controls_Manager::SELECT,
				'options'     => [
					'date'           => esc_html__( 'Date', 'cnv-school-addon' ),
					'ID'             => esc_html__( 'Post ID', 'cnv-school-addon' ),
					'author'         => esc_html__( 'Author', 'cnv-school-addon' ),
					'title'          => esc_html__( 'Title', 'cnv-school-addon' ),
					'modified'       => esc_html__( 'Last modified date', 'cnv-school-addon' ),
					'parent'         => esc_html__( 'Post/page parent ID', 'cnv-school-addon' ),
					'comment_count'  => esc_html__( 'Number of comments', 'cnv-school-addon' ),
					'menu_order'     => esc_html__( 'Menu order/Page Order', 'cnv-school-addon' ),
					'meta_value'     => esc_html__( 'Meta value', 'cnv-school-addon' ),
					'meta_value_num' => esc_html__( 'Meta value number', 'cnv-school-addon' ),
					'rand'           => esc_html__( 'Random order', 'cnv-school-addon' ),
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

		$this->end_controls_section();


		// Style Settings
		// =====================

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Portfolio Style', 'cnv-school-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Title Typography', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-project-item .post-wrapper .project-info .project-title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Title Color', 'cnv-school-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cnv-project-item .post-wrapper .project-info .project-title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'cat_typography',
				'label'    => __( 'Category Typography', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-project-item .post-wrapper .project-info .project-cat .cat',
			]
		);

		$this->add_control(
			'cat_color',
			[
				'label'     => __( 'Category Color', 'cnv-school-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cnv-project-item .post-wrapper .project-info .project-cat .cat' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'overlay_background',
			[
				'label'     => __( 'Overlay Background', 'cnv-school-addon' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cnv-project-item .post-wrapper .post-thumbnail-wrapper a:before' => 'background: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

		// Style Settings
		// =====================

		$this->start_controls_section(
			'filter_style_section',
			[
				'label' => __( 'Filter', 'cnv-school-addon' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'filter_typography',
				'label'    => __( 'Title Typography', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .cnv-filter-buttons li a',
			]
		);

		$this->add_control(
			'filter_color',
			[
				'label'     => __( 'Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cnv-filter-buttons li:not(.current) a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'filter_active_color',
			[
				'label'     => __( 'Active Color', 'cnv-school-addon' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cnv-filter-buttons li.current a' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$layout   = $settings['layout'];
		$cat_list = $settings['project_cat'];


		$_tax_query = array();

//		if ( $settings['project_cat'] ) {
//			$_tax_query = array(
//				array(
//					'taxonomy' => 'project_category',
//					'field'    => 'slug',
//					'terms'    => $cat_list
//				)
//			);
//		}

		$paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;

		$args = array(
			'post_type'      => 'project',
			'paged'          => $paged,
			'order'          => $settings['order'],
			'orderby'        => $settings['order_by'],
			'posts_per_page' => $settings['posts_per_page'],
			'post_status'    => 'publish',
		);

		if ( $settings['project_cat'] ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'project_category',
					'field'    => 'slug',
					'terms'    => $cat_list
				)
			);
		}

		$cnv_query = new \WP_Query( $args );

		$this->add_render_attribute( 'wrapper', 'class', [
			'cnv-project__grid-wrapper cnv-projects',
			'style-' . $settings['layout'],
		] );

		if ( 'metro' === $settings['layout'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'cnv-grid-metro' );
		}

		if ( $this->is_grid() ) {
			$grid_options = $this->get_grid_options( $settings );

			$this->add_render_attribute( 'wrapper', 'data-grid', wp_json_encode( $grid_options ) );
		}

		if ( ! empty( $settings['pagination_type'] ) && $cnv_query->found_posts > $settings['posts_per_page'] ) {
			$this->add_render_attribute( 'wrapper', 'data-pagination', $settings['pagination_type'] );
		}

		if ( ! empty( $settings['caption_style'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'project-caption-style-' . $settings['caption_style'] );
		}

		$args = array(
			'hide_empty' => true,
			'taxonomy'   => 'project_category',
		);

		if ( $settings['project_cat'] ) {
			$args['slug'] = $cat_list;
		}

		$terms = get_terms( $args );

		if ( 'yes' === $settings['filter'] ) { ?>
			<div class="cnv-filter-wrapper">
				<ul class="cnv-filter-buttons <?php echo $settings['filter_button_style']; ?>" role="tablist" id="gallerytab">
					<li class="current site-info">
						<a href="javascript:void(0)" class="btn-filter"
						   data-filter="*"><?php esc_html_e( 'Show All', 'cnv-school-addon' ) ?></a>
					</li>
					<?php foreach ( $terms as $term ) { ?>
						<li>
							<a href="javascript:void(0)" data-filter="<?php echo '.project_category-' . $term->slug; ?>"><?php echo $term->name; ?></a>
						</li>
					<?php } ?>

				</ul>
			</div>
		<?php } ?>

		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

			<?php if ( $cnv_query->have_posts() ) : ?>
				<div class="cnv-grid project_ajax">
					<?php if ( $this->is_grid() ) { ?>
						<div class="grid-sizer"></div>
					<?php } ?>

					<?php  require __DIR__ . '/templates/project/style-' . $layout . '.php'; ?>

				</div>
				<?php $this->print_pagination( $cnv_query, $settings ); ?>
				<?php wp_reset_postdata(); ?>
				<?php else : ?>
				<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'cnv-school-addon' ); ?></p>

			<?php endif; ?>
		</div>
		<?php
//
//		if ( Plugin::instance()->editor->is_edit_mode() ) {
//			$this->render_editor_script();
//		}

//		if(is_admin()) {
//			$this->render_editor_script();
//		}
	}


	protected function print_pagination( $cnv_query, $settings ) {
		$number          = $settings['posts_per_page'];
		$pagination_type = $settings['pagination_type'];
		$load_text       = $settings['load_more_text'];

		if ( $pagination_type !== '' && $cnv_query->found_posts > $number ) {
			?>
			<div class="container text-center">
				<div class="project-pagination-wrapper">
					<?php if ( in_array( $pagination_type, array(
						'load-more',
						'load-more-alt',
						'infinite',
						'navigation',
					), true ) ) { ?>
						<div class="inner">
							<?php if ( $pagination_type === 'load-more' ) { ?>
								<?php $this->cnv_ajax_more_project_post_init( $cnv_query, $settings ); ?>
								<div id="cnv-load-more-btn" class="cnv-load-more">
									<a href="#0" class="dt-btn"><?php echo esc_html( $load_text ); ?></a>
								</div>
							<?php } ?>
						</div>
					<?php } elseif ( $pagination_type === 'numbers' ) { ?>
						<?php \CNV_Helper::paging_nav( $cnv_query ); ?>
					<?php } ?>

				</div>
			</div>
			<!-- /.container -->
			<?php
		}
	}

	protected function print_pagination_type_navigation() {
		?>
		<div class="navigation-buttons">
			<div class="nav-link prev-link disabled" data-action="prev">
				<?php esc_html_e( 'Prev Projects', 'cnv-school-addon' ); ?>
			</div>
			<div class="nav-line"></div>
			<div class="nav-link next-link" data-action="next">
				<?php esc_html_e( 'Next Projects', 'cnv-school-addon' ); ?>
			</div>
		</div>
		<?php
	}

	protected function get_grid_options( array $settings ) {
		$grid_options = [
			'type' => $settings['layout'],
			'ratio' => $settings['metro_image_ratio'],
		];

		// Columns.
		if ( ! empty( $settings['grid_columns'] ) ) {
			$grid_options['columns'] = $settings['grid_columns'];
		}

		if ( ! empty( $settings['grid_columns_tablet'] ) ) {
			$grid_options['columnsTablet'] = $settings['grid_columns_tablet'];
		}

		if ( ! empty( $settings['grid_columns_mobile'] ) ) {
			$grid_options['columnsMobile'] = $settings['grid_columns_mobile'];
		}

		// Gutter
		if ( ! empty( $settings['grid_gutter'] ) ) {
			$grid_options['gutter'] = $settings['grid_gutter'];
		}

		if ( ! empty( $settings['grid_gutter_tablet'] ) ) {
			$grid_options['gutterTablet'] = $settings['grid_gutter_tablet'];
		}

		if ( ! empty( $settings['grid_gutter_mobile'] ) ) {
			$grid_options['gutterMobile'] = $settings['grid_gutter_mobile'];
		}

		// Zigzag height.
		if ( ! empty( $settings['zigzag_height'] ) ) {
			$grid_options['zigzagHeight'] = $settings['zigzag_height'];
		}

		if ( ! empty( $settings['zigzag_height_tablet'] ) ) {
			$grid_options['zigzagHeightTablet'] = $settings['zigzag_height_tablet'];
		}

		if ( ! empty( $settings['zigzag_height_mobile'] ) ) {
			$grid_options['zigzagHeightMobile'] = $settings['zigzag_height_mobile'];
		}

		if ( ! empty( $settings['zigzag_reversed'] ) && 'yes' === $settings['zigzag_reversed'] ) {
			$grid_options['zigzagReversed'] = 1;
		}

		return $grid_options;
	}

	/**
	 * Check if layout is grid|metro|masonry
	 *
	 * @return bool
	 */
	protected function is_grid() {
		$settings = $this->get_settings_for_display();
		if ( ! empty( $settings['layout'] ) &&
		     in_array( $settings['layout'], array(
			     'grid',
			     'metro',
			     'masonry',
		     ), true ) ) {
			return true;
		}

		return false;
	}

	protected function render_editor_script() {
		?>
		<script type="text/javascript">
			(function ($) {
				'use strict';
				$.fn.CNVlGridLayout = function () {
					var $el, $grid, resizeTimer;

					/**
					 * Calculate size for grid items
					 */
					function calculateMasonrySize(isotopeOptions) {
						var tabletBreakPoint = 1025,
							mobileBreakPoint = 768,
							windowWidth = window.innerWidth,
							gridWidth = $grid[0].getBoundingClientRect().width,
							gridColumns = 1,
							gridGutter = 0,
							zigzagHeight = 0,
							settings = $el.data('grid'),
							lgGutter = settings.gutter ? settings.gutter : 0,
							mdGutter = settings.gutterTablet ? settings.gutterTablet : lgGutter,
							smGutter = settings.gutterMobile ? settings.gutterMobile : mdGutter,
							lgColumns = settings.columns ? settings.columns : 1,
							mdColumns = settings.columnsTablet ? settings.columnsTablet : lgColumns,
							smColumns = settings.columnsMobile ? settings.columnsMobile : mdColumns,
							lgZigzagHeight = settings.zigzagHeight ? settings.zigzagHeight : 0,
							mdZigzagHeight = settings.zigzagHeightTablet ? settings.zigzagHeightTablet : lgZigzagHeight,
							smZigzagHeight = settings.zigzagHeightMobile ? settings.zigzagHeightMobile : mdZigzagHeight,
							zigzagReversed = settings.zigzagReversed && settings.zigzagReversed === 1 ? true : false;

						if (typeof elementorFrontendConfig !== 'undefined') {
							tabletBreakPoint = elementorFrontendConfig.breakpoints.lg;
							mobileBreakPoint = elementorFrontendConfig.breakpoints.md;
						}

						if (windowWidth >= tabletBreakPoint) {
							gridColumns = lgColumns;
							gridGutter = lgGutter;
							zigzagHeight = lgZigzagHeight;
						} else if (windowWidth >= mobileBreakPoint) {
							gridColumns = mdColumns;
							gridGutter = mdGutter;
							zigzagHeight = mdZigzagHeight;
						} else {
							gridColumns = smColumns;
							gridGutter = smGutter;
							zigzagHeight = smZigzagHeight;
						}

						var totalGutterPerRow = (
							gridColumns - 1
						) * gridGutter;

						var columnWidth = (
							gridWidth - totalGutterPerRow
						) / gridColumns;

						columnWidth = Math.floor(columnWidth);

						var columnWidth2 = columnWidth;
						if (gridColumns > 1) {
							columnWidth2 = columnWidth * 2 + gridGutter;
						}

						$grid.children('.grid-sizer').css({
							'width': columnWidth + 'px'
						});

						var columnHeight = 0,
							columnHeight2 = 0, // 200%.
							columnHeight7 = 0, // 70%.
							columnHeight13 = 0, // 130%.
							isMetro = false,
							ratioW = 1,
							ratioH = 1;

						if (settings.ratio) {
							ratioH = settings.ratio;
							isMetro = true;
						}

						// Calculate item height for only metro type.
						if (isMetro) {
							columnHeight = columnWidth * ratioH / ratioW;
							columnHeight = Math.floor(columnHeight);

							if (gridColumns > 1) {
								columnHeight2 = columnHeight * 2 + gridGutter;
								columnHeight13 = parseInt(columnHeight * 1.3);
								columnHeight7 = columnHeight2 - gridGutter - columnHeight13;
							} else {
								columnHeight2 = columnHeight7 = columnHeight13 = columnHeight;
							}
						}

						$grid.children('.grid-item').each(function (index) {
							var gridItem = $(this);

							// Zigzag.
							if (
								zigzagHeight > 0 // Has zigzag.
								&&
								gridColumns > 1 // More than 1 column.
								&&
								index + 1 <= gridColumns // On top items.
							) {
								if (zigzagReversed === false) { // Is odd item.
									if (index % 2 === 0) {
										gridItem.css({
											'marginTop': zigzagHeight + 'px'
										});
									} else {
										gridItem.css({
											'marginTop': '0px'
										});
									}
								} else {
									if (index % 2 !== 0) {
										gridItem.css({
											'marginTop': zigzagHeight + 'px'
										});
									} else {
										gridItem.css({
											'marginTop': '0px'
										});
									}
								}

							} else {
								gridItem.css({
									'marginTop': '0px'
								});
							}

							if (gridItem.data('width') === 2) {
								gridItem.css({
									'width': columnWidth2 + 'px'
								});
							} else {
								gridItem.css({
									'width': columnWidth + 'px'
								});
							}

							if ('grid' === settings.type) {
								gridItem.css({
									'marginBottom': gridGutter + 'px'
								});
							}

							if (isMetro) {
								var $itemHeight;

								if (gridItem.hasClass('grid-item-height')) {
									$itemHeight = gridItem;
								} else {
									$itemHeight = gridItem.find('.grid-item-height');
								}

								if (gridItem.data('height') === 2) {
									$itemHeight.css({
										'height': columnHeight2 + 'px'
									});
								} else if (gridItem.data('height') === 1.3) {
									$itemHeight.css({
										'height': columnHeight13 + 'px'
									});
								} else if (gridItem.data('height') === 0.7) {
									$itemHeight.css({
										'height': columnHeight7 + 'px'
									});
								} else {
									$itemHeight.css({
										'height': columnHeight + 'px'
									});
								}
							}
						});

						if (isotopeOptions) {
							isotopeOptions.packery.gutter = gridGutter;
							isotopeOptions.fitRows.gutter = gridGutter;
							$grid.isotope(isotopeOptions);
						}

						$grid.isotope('layout');
					}


					return this.each(function () {
						$el = $(this);
						$grid = $el.find('.cnv-grid');

						var settings = $el.data('grid');
						var gridData;

						if ($grid.length > 0 && settings && typeof settings.type !== 'undefined') {
							var isotopeOptions = {
								itemSelector: '.grid-item',
								percentPosition: true,
								// transitionDuration: 0,
								packery: {
									columnWidth: '.grid-sizer',
								},
								fitRows: {
									gutter: 10
								}
							};

							if ('masonry' === settings.type || 'metro' === settings.type) {
								isotopeOptions.layoutMode = 'packery';
							} else {
								isotopeOptions.layoutMode = 'fitRows';
							}

							gridData = $grid.imagesLoaded(function () {
								calculateMasonrySize(isotopeOptions);
								$grid.addClass('loaded');
							});

							$(window).resize(function () {
								calculateMasonrySize(isotopeOptions);

								// Sometimes layout can be overlap. then re-cal layout one time.
								clearTimeout(resizeTimer);
								resizeTimer = setTimeout(function () {
									// Run code here, resizing has "stopped"
									calculateMasonrySize(isotopeOptions);
								}, 500); // DO NOT decrease the time. Sometime, It'll make layout overlay on resize.
							});
						}


						$('.cnv-filter-buttons li a').on('click', function () {
							$('.cnv-filter-buttons').find('.current').removeClass('current');
							$(this).parent().addClass('current');

							var selector = $(this).attr("data-filter");
							$(".cnv-grid").isotope({
								filter: selector
							});

							return false;
						});
					});

				};

				$('.cnv-project__grid-wrapper').CNVlGridLayout();

				var wow = new WOW({
					boxClass: 'wow',
					animateClass: 'animated',
					offset: 0,
					mobile: false,
					live: true,
					scrollContainer: null
				});
				wow.init();


				var $single_project_img = $('.overlay_effect');
				var $window = $(window);

				function scroll_addclass() {
					var window_height = $(window).height() - 200;
					var window_top_position = $window.scrollTop();
					var window_bottom_position = (window_top_position + window_height);

					$.each($single_project_img, function () {
						var $element = $(this);
						var element_height = $element.outerHeight();
						var element_top_position = $element.offset().top;
						var element_bottom_position = (element_top_position + element_height);

						//check to see if this current container is within viewport
						if ((element_bottom_position >= window_top_position) &&
							(element_top_position <= window_bottom_position)) {
							$element.addClass('is_show');
						}
					});
				}

				$window.on('scroll resize', scroll_addclass);
				$window.trigger('scroll');

			}(jQuery));
		</script>
		<?php
	}

	/**
	 * Generates ajax pagination html with Load more button and localizes required script.
	 *
	 * @return string pagination html
	 */
	protected function cnv_ajax_more_project_post_init( $cnv_query, $settings ) {
		global $wp_query;

		// Queue JS
		wp_enqueue_script( 'load-more', UNIALUMNI_SCRIPTS . '/load-more.js', array( 'jquery' ), UNIALUMNI_CORE_VERSION, true );

		// What page are we on? And what is the pages limit?
		$paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;


		if ( is_tax( 'project_category' ) ) {
			$max = $wp_query->max_num_pages;
		} else {
			$loop = $cnv_query;
			$max  = $loop->max_num_pages;
		}

		$more_text    = 'Load More';
		$loading_text = 'Loading...';
		$end_text     = 'All items displayed';

		// Add some parameters for the JS.
		wp_localize_script(
			'load-more',
			'cnv_load_project',
			array(
				'startPage'    => $paged,
				'maxPages'     => $max,
				// 'nextLink'      => next_posts($max, false),
				'more_text'    => $more_text,
				'loading_text' => $loading_text,
				'end_text'     => $end_text
			)
		);

	}

	protected function cnv_ajax_lazy_project_post_init( $cnv_query, $settings ) {
		global $wp_query;

		// Queue JS
		wp_enqueue_script( 'lazy-load', UNIALUMNI_SCRIPTS . '/ajax-lazy-load.js', array( 'jquery' ), UNIALUMNI_CORE_VERSION, true );

		// What page are we on? And what is the pages limit?
		$paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;


		if ( is_tax( 'project_category' ) ) {
			$max = $wp_query->max_num_pages;
		} else {
			$loop = $cnv_query;
			$max  = $loop->max_num_pages;
		}

		$more_text    = 'Load More';
		$loading_text = 'Loding';
		$end_text     = 'All items displayed';

		// Add some parameters for the JS.
		wp_localize_script(
			'lazy-load',
			'cnv_load_project',
			array(
				'startPage'    => $paged,
				'maxPages'     => $max,
				'nextLink'     => next_posts( $max, false ),
				'more_text'    => $more_text,
				'loading_text' => $loading_text,
				'end_text'     => $end_text
			)
		);

	}
}