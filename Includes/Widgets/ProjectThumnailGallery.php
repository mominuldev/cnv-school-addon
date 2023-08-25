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

class ProjectThumnailGallery extends Widget_Base {

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
		return 'cnv-project-thumbnail';
	}


	public function get_title() {
		return __( 'CNV Project Thumbnail', 'cnv-school-addon' );
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

	protected function register_controls() {

		$this->start_controls_section(
			'section_query',
			[
				'label' => __( 'Project Thumbnail Gallery', 'cnv-school-addon' ),
			]
		);

		$this->add_control( 'thumbnail_default_size', [
			'label'        => esc_html__( 'Use Default Thumbnail Size', 'cnv' ),
			'type'         => Controls_Manager::SWITCHER,
			'default'      => '1',
			'return_value' => '1',
			'separator'    => 'before',
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
	}

	protected function render() {
		$settings = $this->get_settings_for_display();


		$args = array(
			'post_type'      => 'project',
			'order'          => $settings['order'],
			'orderby'        => $settings['order_by'],
			'posts_per_page' => $settings['posts_per_page'],
			'post_status'    => 'publish',
		);

		$cnv_query = new \WP_Query( $args );

		$this->add_render_attribute( 'wrapper', 'class', [
			'cnv-project-thumnail__grid-wrapper',
		] );

		?>


		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

			<?php if ( $cnv_query->have_posts() ) : ?>
				<div class="cnv-project-grid-thumbnail">
					<?php while ( $cnv_query->have_posts() ) : $cnv_query->the_post(); ?>
						<div class="cnv-project-thumbnail-item">
							<a href="<?php the_permalink(); ?>">
								<?php the_post_thumbnail( 'cnv-thumbnail_90_90' ); ?>
							</a>
						</div>
					<?php endwhile; ?>
				</div>
				<?php wp_reset_postdata(); ?>
				<?php else : ?>
				<p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'cnv-school-addon' ); ?></p>

			<?php endif; ?>
		</div>
		<?php

	}

}