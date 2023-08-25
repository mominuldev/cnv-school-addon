<?php

namespace CodeNestVentures\SchoolAddon\Widgets;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Image_Size;
use Elementor\Plugin;

/**
 * Elementor button widget.
 * Elementor widget that displays a button with the ability to control every
 * aspect of the button design.
 * @since 1.0.0
 */
class TestimonialTabs extends Widget_Base
{

	/**
	 * Get widget name.
	 * Retrieve button widget name.
	 * @return string Widget name.
	 * @since  1.0.0
	 * @access public
	 */
	public function get_name()
	{
		return 'rbt_testimonial_tabs';
	}

	/**
	 * Get widget title.
	 * Retrieve button widget title.
	 * @return string Widget title.
	 * @since  1.0.0
	 * @access public
	 */
	public function get_title()
	{
		return esc_html__('CNV Testimonial Tabs', 'cnv-school-addon');
	}

	/**
	 * Get widget icon.
	 * Retrieve button widget icon.
	 * @return string Widget icon.
	 * @since  1.0.0
	 * @access public
	 */
	public function get_icon()
	{
		return 'eicon-library-open';
	}

	/**
	 * Get widget categories.
	 * Retrieve the list of categories the button widget belongs to.
	 * Used to determine where to display the widget in the editor.
	 * @return array Widget categories.
	 * @since  2.0.0
	 * @access public
	 */
	public function get_categories()
	{
		return ['cnv-elements'];
	}

	public function get_script_depends()
	{
		wp_register_script('testimonial-tab-script', CNV_PLUGIN_URL.'assets/js/testimonial-tab.js', ['elementor-frontend'], '1.0.0', true);
		return ['testimonial-tab-script'];
	}

	/**
	 * Register button widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since  1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{
		$this->start_controls_section(
			'testimonial_tabs',
			[
				'label' => esc_html__('Testimonial Tabs', 'cnv-school-addon'),
			]
		);

		$this->add_control(
			'anim_on',
			[
				'label'        => __('ON/OFF Animation', 'cnv-school-addon'),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('Show', 'cnv-school-addon'),
				'label_off'    => esc_html__('Hide', 'cnv-school-addon'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		//Our Tab Services
		$repeater = new Repeater();
		$repeater->add_control(
			'name',
			[
				'label'       => esc_html__('Name', 'cnv-school-addon'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
			]
		);
		$repeater->add_control(
			'designation',
			[
				'label'       => esc_html__('designation', 'cnv-school-addon'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXT,
			]
		);

		$repeater->add_control(
			'feature_image',
			[
				'label'   => __('Image', 'cnv-school-addon'),
				'type'    => Controls_Manager::MEDIA,
				'default' => ['url' => Utils::get_placeholder_image_src(),],
			]
		);


		$repeater->add_control( 'rating', [
			'label'   => __( 'Rating Number', 'cnv-school-addon' ),
			'type'    => \Elementor\Controls_Manager::SELECT,
			'default' => '45',
			'options' => [
				'10' => __( '1 Star', 'cnv-school-addon' ),
				'15' => __( '1.5 Star', 'cnv-school-addon' ),
				'20' => __( '2 Star', 'cnv-school-addon' ),
				'25' => __( '2.5 Star', 'cnv-school-addon' ),
				'30' => __( '3 Star', 'cnv-school-addon' ),
				'35' => __( '3.5 Star', 'cnv-school-addon' ),
				'40' => __( '4 Star', 'cnv-school-addon' ),
				'45' => __( '4.5 Star', 'cnv-school-addon' ),
				'50' => __( '5 Star', 'cnv-school-addon' ),
			],
		] );

		$repeater->add_control(
			'description',
			[
				'label'       => esc_html__('Review content', 'cnv-school-addon'),
				'label_block' => true,
				'type'        => Controls_Manager::TEXTAREA,
			]
		);

		$this->add_control('testimonials', [
			'label'       => esc_html__('Testimonials', 'cnv-school-addon'),
			'type'        => Controls_Manager::REPEATER,
			'fields'      => $repeater->get_controls(),
			'default' => [
				[
					'name' => esc_html__('Chris Johnson', 'cnv-school-addon'),
					'designation' => esc_html__('CEO, Company Name', 'cnv-school-addon'),
					'feature_image' => ['url' => Utils::get_placeholder_image_src()],
					'rating' => '50',
					'description' => esc_html__('CNV has an incredible Remote culture. It really makes working together easy”', 'cnv-school-addon'),
				],
				[
					'name' => esc_html__('Sean Vosler', 'cnv-school-addon'),
					'designation' => esc_html__('Author at Marketing', 'cnv-school-addon'),
					'feature_image' => ['url' => Utils::get_placeholder_image_src()],
					'rating' => '45',
					'description' => esc_html__('CNV has an incredible Remote culture. It really makes working together easy”', 'cnv-school-addon'),
				],
				[
					'name'          => esc_html__('Mitch Mauldin', 'cnv-school-addon'),
					'designation'   => esc_html__('CEO,at Retain', 'cnv-school-addon'),
					'feature_image' => ['url' => Utils::get_placeholder_image_src()],
					'rating'        => '45',
					'description'   => esc_html__('CNV has an incredible Remote culture. It really makes working together easy”', 'cnv-school-addon'),
				]
			]
		]);


		$this->end_controls_section();

	}


	/**
	 * Render button widget output on the frontend.
	 * Written in PHP and used to generate the final HTML.
	 * @since  1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$allowed_tags = wp_kses_allowed_html('post');
		$anim_on = $settings['anim_on'];

		if ($anim_on === 'yes') {
			$has__testimonial_animation = 'has__testimonial_animation';
			$animation_testimonial_page = 'animation__testimonial_page';
		} else {
			$has__testimonial_animation = '';
			$animation_testimonial_page = '';
		}
		if (!empty($settings['btn_link']['url'])) {
			$this->add_link_attributes('link', $settings['btn_link']);
		}
		?>



		<div class="rbt-tab-testimonial">
			<div class="rbt-tab-testimonial__left-content">
				<ul class="rbt-tab-testimonial__list">
					<?php $count = 1;
					foreach ($settings['testimonials'] as $key => $item): ?>
						<li class="<?php echo $count == 1 ? 'active' : ''; ?>">
							<a href="#testimonial_<?php echo esc_attr($count); ?>">
								<div class="rbt-tab-testimonial__image">
									<img src="<?php echo esc_url(wp_get_attachment_url($item['feature_image']['id'])); ?>"
										 alt="<?php esc_attr_e('Solution Image', 'cnv-school-addon'); ?>">
								</div>

								<div class="rbt-tab-testimonial__bio">
									<h4 class="rbt-tab-testimonial__name"><?php echo wp_kses_post($item['name']); ?></h4>
									<p class="rbt-tab-testimonial__designation"><?php echo wp_kses_post($item['designation']); ?></p>
								</div>
							</a>

						</li>
					<?php $count++; endforeach; ?>
				</ul>
			</div>
			<div class="rbt-tab-testimonial__right-content">
				<div class="rbt-tab-testimonial__items">
					<?php $counts = 1;
					foreach ($settings['testimonials'] as $key => $item): ?>
						<div class="rbt-tab-testimonial__item <?php echo $counts == 1 ? $has__testimonial_animation : ''; ?>" id="testimonial_<?php echo esc_attr($counts); ?>" data-secid="<?php echo esc_attr($counts); ?>">
							<div class="<?php echo esc_attr($animation_testimonial_page); ?>">

								<?php

								$rating = $item['rating'];
								$this->add_render_attribute('star-rating', 'class', 'rbt-stars');
								if($rating == '10'){
									$this->add_render_attribute('star-rating', 'class', 'rbt-stars--1 rbt-stars--1' );
								} elseif($rating == '15'){
									$this->add_render_attribute('star-rating', 'class', 'rbt-stars--1 rbt-stars--1--half' );
								} elseif($rating == '20'){
									$this->add_render_attribute('star-rating', 'class', 'rbt-stars--2 rbt-stars--2' );
								} elseif ($rating == '25') {
									$this->add_render_attribute('star-rating', 'class', 'rbt-stars--2 rbt-stars--2--half' );
								} elseif ($rating == '30') {
									$this->add_render_attribute('star-rating', 'class', 'rbt-stars--3 rbt-stars--3' );
								} elseif ($rating == '35') {
									$this->add_render_attribute('star-rating', 'class', 'rbt-stars--3 rbt-stars--3--half' );
								} elseif ($rating == '40') {
									$this->add_render_attribute('star-rating', 'class', 'rbt-stars--4 rbt-stars--4' );
								} elseif ($rating == '45') {
									$this->add_render_attribute('star-rating', 'class', 'rbt-stars--4 rbt-stars--4--half' );
								} elseif ($rating == '50') {
									$this->add_render_attribute('star-rating', 'class', 'rbt-stars--5 rbt-stars--5' );
								}

								?>

								<div class="rbt-widget-stars">
									<div <?php echo $this->get_render_attribute_string('star-rating'); ?> >
										<svg role="img" aria-labelledby="starRating" viewBox="0 0 251 46" xmlns="http://www.w3.org/2000/svg">
											<title id="starRating" lang="en">
												4.5 out of five star rating on
												Trustpilot
											</title>
											<g class="rbt-star">
												<path class="rbt-star__canvas" fill="#dcdce6" d="M0 46.330002h46.375586V0H0z"></path>
												<path class="rbt-star__shape" d="M39.533936 19.711433L13.230239 38.80065l3.838216-11.797827L7.02115 19.711433h12.418975l3.837417-11.798624 3.837418 11.798624h12.418975zM23.2785 31.510075l7.183595-1.509576 2.862114 8.800152L23.2785 31.510075z" fill="#FFF"></path>
											</g>
											<g class="rbt-star">
												<path class="rbt-star__canvas" fill="#dcdce6" d="M51.24816 46.330002h46.375587V0H51.248161z"></path>
												<path class="rbt-star__canvas--half" fill="#dcdce6" d="M51.24816 46.330002h23.187793V0H51.248161z"></path>
												<path class="rbt-star__shape" d="M74.990978 31.32991L81.150908 30 84 39l-9.660206-7.202786L64.30279 39l3.895636-11.840666L58 19.841466h12.605577L74.499595 8l3.895637 11.841466H91L74.990978 31.329909z" fill="#FFF"></path>
											</g>
											<g class="rbt-star">
												<path class="rbt-star__canvas" fill="#dcdce6" d="M102.532209 46.330002h46.375586V0h-46.375586z"></path>
												<path class="rbt-star__canvas--half" fill="#dcdce6" d="M102.532209 46.330002h23.187793V0h-23.187793z"></path>
												<path class="rbt-star__shape" d="M142.066994 19.711433L115.763298 38.80065l3.838215-11.797827-10.047304-7.291391h12.418975l3.837418-11.798624 3.837417 11.798624h12.418975zM125.81156 31.510075l7.183595-1.509576 2.862113 8.800152-10.045708-7.290576z"  fill="#FFF"></path>
											</g>
											<g class="rbt-star">
												<path class="rbt-star__canvas" fill="#dcdce6" d="M153.815458 46.330002h46.375586V0h-46.375586z"></path>
												<path class="rbt-star__canvas--half" fill="#dcdce6" d="M153.815458 46.330002h23.187793V0h-23.187793z"></path>
												<path class="rbt-star__shape" d="M193.348355 19.711433L167.045457 38.80065l3.837417-11.797827-10.047303-7.291391h12.418974l3.837418-11.798624 3.837418 11.798624h12.418974zM177.09292 31.510075l7.183595-1.509576 2.862114 8.800152-10.045709-7.290576z" fill="#FFF"></path>
											</g>
											<g class="rbt-star">
												<path class="rbt-star__canvas" fill="#dcdce6" d="M205.064416 46.330002h46.375587V0h-46.375587z"></path>
												<path class="rbt-star__canvas--half" fill="#dcdce6" d="M205.064416 46.330002h23.187793V0h-23.187793z"></path>
												<path class="rbt-star__shape" d="M244.597022 19.711433l-26.3029 19.089218 3.837419-11.797827-10.047304-7.291391h12.418974l3.837418-11.798624 3.837418 11.798624h12.418975zm-16.255436 11.798642l7.183595-1.509576 2.862114 8.800152-10.045709-7.290576z" fill="#FFF"></path>
											</g>
										</svg>
									</div>
								</div>

								<?php if( !empty($item['description']) ): ?>
									<div class="rbt-tab-testimonial__content">
										<p><?php echo wp_kses_post($item['description']); ?></p>
									</div>
								<?php endif; ?>
							</div>
						</div>
						<?php $counts++; endforeach ?>
				</div>
			</div>
		</div>
		<?php
	}
}
