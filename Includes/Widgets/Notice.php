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

class Notice extends Widget_Base {

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
		return 'cnv-notice';
	}

	public function get_title() {
		return __( 'CNV Notice', 'cnv-school-addon' );
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
				'label' => __( 'Notice', 'cnv-school-addon' ),
			]
		);

	    // Title
        $this->add_control(
            'notice_title',
            [
                'label' => __( 'Title', 'cnv-school-addon' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Notice', 'cnv-school-addon' ),
                'label_block' => true,
            ]
        );

        // Notice Button
        $this->add_control(
            'notice_btn_text',
            [
                'label' => __( 'Button Text', 'cnv-school-addon' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'View All', 'cnv-school-addon' ),
                'label_block' => true,
            ]
        );

        // Notice Button Link
        $this->add_control(
            'notice_btn_link',
            [
                'label' => __( 'Button Link', 'cnv-school-addon' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://your-link.com', 'cnv-school-addon' ),
                'show_external' => true,
                'default' => [
                    'url' => '#',
                ],
            ]
        );

	    // Heading Control more options
        $this->add_control(
            'heading',
            [
                'label' => __( 'Heading', 'cnv-school-addon' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'posts_per_page',
			[
				'label'       => esc_html__( 'Items per page', 'cnv-school-addon' ),
				'description' => esc_html__( 'Number of items to show per page. Input "-1" to show all posts. Leave blank to use global setting.', 'cnv-school-addon' ),
				'type'        => Controls_Manager::NUMBER,
				'default'     => '6',
				'min'         => -1,
				'max'         => 20,
				'step'        => 1,
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


	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$args = array(
			'post_type'      => 'notice',
			'order'          => $settings['order'],
			'posts_per_page' => -1,
			'post_status'    => 'publish',
		);

		$cnv_query = new \WP_Query( $args );

		$this->add_render_attribute( 'wrapper', 'class', [
			'cnv-notice__list-wrapper',
		] );
        ?>

		<div <?php $this->print_render_attribute_string( 'wrapper' ); ?>>
           <?php if( !empty(  $settings['notice_title']  )) : ?>
               <h2 class="cnv-notice__heading"><?php echo esc_html( $settings['notice_title'] ); ?></h2>
           <?php endif; ?>

            <div class="cnv-notice__list-inner">
                <?php if ( $cnv_query->have_posts() ) :
                    while ( $cnv_query->have_posts() ) :
	                $cnv_query->the_post();
                    require __DIR__ . '/templates/notice/notice.php';
                    endwhile;
                    else : ?>
                    <p><?php esc_html_e( 'Sorry, no notices matched your criteria.', 'cnv-school-addon' ); ?></p>
                <?php endif; ?>
            </div>
		</div>
		<?php
	}
}