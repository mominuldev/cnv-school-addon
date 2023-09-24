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

class Gallery extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve alert widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'cnv-gallery';
	}


	public function get_title() {
		return __( 'CNV Gallery', 'cnv-school-addon' );
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

		// Query Settings
		// =====================
		$this->start_controls_section( 'query_section', [
			'label' => esc_html__( 'Query', 'cnv-school-addon' ),
		] );

		// Column
		$this->add_control(
			'column',
			[
				'label'   => __( 'Column', 'cnv-school-addon' ),
				'type'    => Controls_Manager::SELECT,
				'options' => [
					'col-lg-12' => esc_html__( '1', 'cnv-school-addon' ),
					'col-lg-6'  => esc_html__( '2', 'cnv-school-addon' ),
					'col-lg-4'  => esc_html__( '3', 'cnv-school-addon' ),
					'col-lg-3'  => esc_html__( '4', 'cnv-school-addon' ),
				],
				'default' => 'col-lg-4',
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label'       => esc_html__( 'Items per page', 'cnv-school-addon' ),
				'description' => esc_html__( 'Number of items to show per page. Input "-1" to show all posts. Leave blank to use global setting.',
					'cnv-school-addon' ),
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
				'description' => esc_html__( "Select how to sort retrieved posts. More at ",
						'cnv-school-addon' ) . '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.',
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
				'description' => esc_html__( "Select Ascending or Descending order. More at",
						'cnv-school-addon' ) . '<a href="http://codex.wordpress.org/Class_Reference/WP_Query#Order_.26_Orderby_Parameters" target="_blank">WordPress codex</a>.',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();


		$args = array(
			'post_type'      => 'gallery',
			'order'          => $settings['order'],
			'orderby'        => $settings['order_by'],
			'posts_per_page' => $settings['posts_per_page'],
			'post_status'    => 'publish',
		);

		$cnv_query = new \WP_Query( $args );

		$this->add_render_attribute( 'wrapper', 'class', [
			'cnv-gallery-wrapper row',
		] );

		?>


        <div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>

			<?php if ( $cnv_query->have_posts() ) : ?>

				<?php while ( $cnv_query->have_posts() ) : $cnv_query->the_post(); ?>
                    <div class="<?php echo esc_attr( $settings['column'] ) ?> col-md-6 col-sm-6">
                        <div class="cnv-gallery">
                            <div class="cnv-gallery__img">
                                <a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'medium' ); ?>
                                </a>
                            </div>

                          <div class="cnv-gallery__content">
                              <h3 class="cnv-gallery__title">
                                  <a href="<?php echo esc_url( the_permalink() ); ?>"><?php the_title(); ?></a>
                              </h3>
                          </div>
                        </div>
                    </div>
				<?php endwhile; ?>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
                <p><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'cnv-school-addon' ); ?></p>

			<?php endif; ?>
        </div>
		<?php

	}

}