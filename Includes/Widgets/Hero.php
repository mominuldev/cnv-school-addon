<?php

namespace CodeNestVentures\SchoolAddon\Widgets;

use Elementor\{Group_Control_Border,
	Group_Control_Box_Shadow,
	Widget_Base,
	Controls_Manager,
	Group_Control_Typography,
	Group_Control_Background,
	Utils,
	Repeater
};

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Hero extends Widget_Base {

	/**
	 * Get widget name.
	 * Retrieve Hero widget name.
	 * @return string Widget name.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_name() {
		return 'cnv-hero-static';
	}


	/**
	 * Get widget title.
	 * Retrieve Hero widget title.
	 * @return string Widget title.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_title() {
		return __( 'CNV Hero', 'cnv-school-addon' );
	}

	/**
	 * Get widget icon.
	 * Retrieve Hero widget icon.
	 * @return string Widget icon.
	 * @since 1.0.0
	 * @access public
	 */
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

	/**
	 * Get widget keywords.
	 * Retrieve the widget keywords.
	 * @return array Widget keywords.
	 * @since 1.0.0
	 * @access public
	 */
	public function get_keywords() {
		return [ 'hero', 'hero static', 'hero static image' ];
	}

	/**
	 * @return string[]
	 */
	public function get_script_depends() {
		return [ 'marque' ];
	}


	/**
	 * Get button sizes.
	 * Retrieve an array of button sizes for the button widget.
	 * @return array An array containing button sizes.
	 * @since 1.0.0
	 * @access public
	 * @static
	 */
	public static function get_button_sizes() {
		return [
			'btn-xs' => __( 'Extra Small', 'cnv-school-addon' ),
			'btn-sm' => __( 'Small', 'cnv-school-addon' ),
			'btn-md' => __( 'Medium', 'cnv-school-addon' ),
			'btn-lg' => __( 'Large', 'cnv-school-addon' ),
			'btn-xl' => __( 'Extra Large', 'cnv-school-addon' ),
		];
	}

	/**
	 * Register Hero widget controls.
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 * @since 1.0.0
	 * @access protected
	 */

	protected function register_controls() {

		$this->start_controls_section( 'section_hero', [
			'label' => __( 'CNV Hero Static', 'cnv-school-addon' ),
		] );

		// Layout
		$this->add_control( 'layout', [
			'label'   => __( 'Layout', 'cnv-school-addon' ),
			'type'    => Controls_Manager::SELECT,
			'default' => 'one',
			'options' => [
				'one'   => __( 'Layout One', 'cnv-school-addon' ),
				'two'   => __( 'Layout Two', 'cnv-school-addon' ),
				'three' => __( 'Layout Three', 'cnv-school-addon' ),
				'four'  => __( 'Layout Four', 'cnv-school-addon' ),
			],
		] );


		$this->add_control( 'title', [
			'label'       => __( 'Title', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => __( 'Creative <br> Solution', 'cnv-school-addon' ),
			'label_block' => true,
			'rows'        => 2,
			'description' => __( "Type your title here.", 'cnv-school-addon' ),
		] );

		// Enable Animation
		$this->add_control( 'enable_animation', [
			'label'        => __( 'Enable Animation', 'cnv-school-addon' ),
			'type'         => Controls_Manager::SWITCHER,
			'label_on'     => __( 'Yes', 'cnv-school-addon' ),
			'label_off'    => __( 'No', 'cnv-school-addon' ),
			'return_value' => 'yes',
			'default'      => 'yes',
		] );

		// Animation Text Type
		$this->add_control( 'animation_text_type', [
			'label'     => __( 'Animation Text Type', 'cnv-school-addon' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'word',
			'options'   => [
				'chars' => __( 'Charterers', 'cnv-school-addon' ),
				'words' => __( 'Word', 'cnv-school-addon' ),
				'lines' => __( 'Lines', 'cnv-school-addon' ),
			],
			'condition' => [
				'enable_animation' => 'yes',
			],
		] );

		// Animation Style
		$this->add_control( 'animation_style', [
			'label'     => __( 'Animation Style', 'cnv-school-addon' ),
			'type'      => Controls_Manager::SELECT,
			'default'   => 'one',
			'options'   => [
				'one'   => __( 'One', 'cnv-school-addon' ),
				'two'   => __( 'Two', 'cnv-school-addon' ),
				'three' => __( 'Three', 'cnv-school-addon' ),
				'four'  => __( 'four', 'cnv-school-addon' ),
			],
			'condition' => [
				'enable_animation' => 'yes',
			],
		] );

		// Animation Duration
		$this->add_control( 'animation_duration', [
			'label'     => __( 'Animation Duration', 'cnv-school-addon' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 2,
			'step'      => 0.1,
			'min'       => 0.1,
			'condition' => [
				'enable_animation' => 'yes',
			],
		] );

		// Animation Delay
		$this->add_control( 'animation_delay', [
			'label'     => __( 'Animation Delay', 'cnv-school-addon' ),
			'type'      => Controls_Manager::NUMBER,
			'default'   => 0.1,
			'step'      => 0.1,
			'min'       => 0.1,
			'condition' => [
				'enable_animation' => 'yes',
			],
		] );


		$this->add_control( 'description', [
			'label'       => __( 'Description', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXTAREA,
			'default'     => __( 'We\'re an innovative global ui/ux design agency building high-end products ', 'cnv-school-addon' ),
			'label_block' => true,
		] );

		$this->end_controls_section();

		$this->start_controls_section( 'section_brand_logo', [
			'label'     => __( 'Brand Logos', 'cnv-school-addon' ),
			'condition' => [
				'layout' => 'three',
			],
		] );

		$this->add_control( 'brand_title', [
			'label'       => __( 'Brand Title', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'default'     => __( 'We are trust by', 'cnv-school-addon' ),
			'label_block' => true,
			'description' => __( "Type your title here.", 'cnv-school-addon' ),
			'condition'   => [
				'layout' => 'three',
			],
		] );

		$repeater = new Repeater();

		// Contact Info
		$repeater->add_control(
			'brand_name', [
				'label'       => __( 'Brand Name', 'cnv-school-addon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		// Brand Image
		$repeater->add_control(
			'brand_image', [
				'label'       => __( 'Brand Image', 'cnv-school-addon' ),
				'type'        => Controls_Manager::MEDIA,
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'brand_link', [
				'label'       => __( 'Link', 'cnv-school-addon' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'cnv-school-addon' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		$this->add_control(
			'brands_lists', [
				'label'       => __( 'Brands', 'cnv-school-addon' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'brand_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'brand_title' => __( 'Brand Title', 'cnv-school-addon' ),
					],
					[
						'brand_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'brand_title' => __( 'Brand Title', 'cnv-school-addon' ),
					],
					[
						'brand_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'brand_title' => __( 'Brand Title', 'cnv-school-addon' ),
					],
					[
						'brand_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'brand_title' => __( 'Brand Title', 'cnv-school-addon' ),
					],
					[
						'brand_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'brand_title' => __( 'Brand Title', 'cnv-school-addon' ),
					],
					[
						'brand_image' => [
							'url' => Utils::get_placeholder_image_src(),
						],
						'brand_title' => __( 'Brand Title', 'cnv-school-addon' ),
					],

				],
				'title_field' => '{{{ brand_title }}}',
			]
		);

		$this->end_controls_section();

		// Social Icons
		$this->start_controls_section( 'social_icons_section', [
			'label'     => esc_html__( 'Social Icons', 'cnv-school-addon' ),
			'condition' => [
				'layout' => 'three',
			],
		] );

		$repeater = new Repeater();

		// Social Icon
		$repeater->add_control(
			'social_icon',
			[
				'label'       => esc_html__( 'Icon', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::ICONS,
				'default'     => [
					'value'   => 'fas fa-circle',
					'library' => 'fa-solid',
				],
				'recommended' => [
					'fa-brands' => [
						'facebook-f',
						'twitter',
						'linkedin-in',
						'instagram',
						'youtube',
						'pinterest-p',
						'google-plus-g',
						'vimeo-v',
						'dribbble',
						'behance',
						'github',
						'gitlab',
						'wordpress',
						'flickr',
						'500px',
						'vk',
						'weibo',
						'xing',
						'rss',
						'foursquare',
						'quora',
						'skype',
						'soundcloud',
						'spotify',
						'tumblr',
						'viber',
						'whatsapp',
						'wechat',
						'xing',
						'yahoo',
						'paypal',
						'odnoklassniki'
					],
				],
			]
		);

		// Social Link
		$repeater->add_control(
			'social_link', [
				'label'       => __( 'Link', 'cnv-school-addon' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'cnv-school-addon' ),
				'default'     => [
					'url' => '#',
				],
			]
		);

		// Social Title
		$repeater->add_control(
			'social_title', [
				'label'       => __( 'Title', 'cnv-school-addon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'social_icons', [
				'label'       => __( 'Social Icons', 'cnv-school-addon' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'condition'   => [
					'layout' => 'three',
				],
				'default'     => [
					[
						'social_title' => __( 'Facebook', 'cnv-school-addon' ),
						'social_icon'  => [
							'value'   => 'fab fa-facebook-f',
							'library' => 'fa-brands',
						],
					],
					[
						'social_title' => __( 'Twitter', 'cnv-school-addon' ),
						'social_icon'  => [
							'value'   => 'fab fa-twitter',
							'library' => 'fa-brands',
						],
					],
					[
						'social_title' => __( 'Linkedin', 'cnv-school-addon' ),
						'social_icon'  => [
							'value'   => 'fab fa-linkedin-in',
							'library' => 'fa-brands',
						],
					],
					[
						'social_title' => __( 'Instagram', 'cnv-school-addon' ),
						'social_icon'  => [
							'value'   => 'fab fa-instagram',
							'library' => 'fa-brands',
						],
					],
				],
				'title_field' => '{{{ social_title }}}',
			]
		);

		$this->end_controls_section();


		$this->start_controls_section( 'marque_section', [
			'label'     => esc_html__( 'Marque', 'cnv-school-addon' ),
			'condition' => [
				'layout' => 'two',
			],
		] );

		// Enable Marque
		$this->add_control( 'enable_marque', [
			'label'   => __( 'Enable Marque', 'cnv-school-addon' ),
			'type'    => Controls_Manager::SWITCHER,
			'default' => 'yes',
		] );

		// Marque text lisr
		$repeater = new Repeater();

		$repeater->add_control(
			'marque_text', [
				'label'       => __( 'Marque Text', 'cnv-school-addon' ),
				'type'        => Controls_Manager::TEXT,
				'label_block' => true,
			]
		);

		$this->add_control(
			'marque_text', [
				'label'       => __( 'Marque Text List', 'cnv-school-addon' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'condition'   => [
					'enable_marque' => 'yes',
				],
				'default'     => [
					[
						'marque_text' => __( 'We are Creative Digital Agency', 'cnv-school-addon' ),
					],
					[
						'marque_text' => __( 'We Provide Best Solution', 'cnv-school-addon' ),
					],
					[
						'marque_text' => __( 'We are Creative Digital Agency', 'cnv-school-addon' ),
					],
				],
				'title_field' => '{{{ marque_text }}}',
			]
		);

		$this->end_controls_section();


		// Buttons
		// =====================

		$this->start_controls_section( 'button_section', [
			'label'     => esc_html__( 'Button', 'cnv-school-addon' ),
			'condition' => [
				'layout!' => 'three',
			],
		] );

		$this->add_control(
			'button_size',
			[
				'label'   => __( 'Size', 'cnv-school-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-md',
				'options' => $this->get_button_sizes(),
			]
		);

		$this->add_control(
			'button_shape',
			[
				'label'   => __( 'Shape', 'cnv-school-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-round',
				'options' => [
					'btn-square' => __( 'Square', 'cnv-school-addon' ),
					'btn-round'  => __( 'Round', 'cnv-school-addon' ),
					'btn-circle' => __( 'Circle', 'cnv-school-addon' ),
				],
			]
		);


		// Control Tabs
		$this->start_controls_tabs( 'button_tabs' );

		// Primary Button
		$this->start_controls_tab( 'button_primary_tab', [
			'label' => esc_html__( 'Primary', 'cnv-school-addon' ),
		] );

		$this->add_control( 'btn_text', [
			'label'       => __( 'Button Label', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Type your button label here', 'cnv-school-addon' ),
			'default'     => __( 'Let’s Talk 👋', 'cnv-school-addon' ),
			'label_block' => true
		] );

		$this->add_control( 'btn_link', [
			'label'       => __( 'Button Link', 'cnv-school-addon' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'cnv-school-addon' ),
			'default'     => [
				'url' => '#',
			],
		] );

		$this->add_control(
			'primary_button_style',
			[
				'label'   => __( 'Button Style', 'cnv-school-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-default',
				'options' => [
					'btn-default' => __( 'Default', 'cnv-school-addon' ),
					'btn-outline' => __( 'Outline', 'cnv-school-addon' ),
				],
			]
		);

		// Button Color
		$this->add_control(
			'primary_button_color',
			[
				'label'   => __( 'Fill Color', 'cnv-school-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-light',
				'options' => [
					'btn-light' => __( 'Light', 'cnv-school-addon' ),
					'btn-dark'  => __( 'Dark', 'cnv-school-addon' ),
				],
			]
		);

		$this->end_controls_tab();

		// Secondary Button
		$this->start_controls_tab( 'button_secondary_tab', [
			'label' => esc_html__( 'Secondary', 'cnv-school-addon' ),
		] );

		$this->add_control( 'sec_btn_text', [
			'label'       => __( 'Button Label', 'cnv-school-addon' ),
			'type'        => Controls_Manager::TEXT,
			'placeholder' => __( 'Type your button label here', 'cnv-school-addon' ),
			'default'     => __( 'Services', 'cnv-school-addon' ),
			'label_block' => true
		] );

		$this->add_control( 'sec_btn_link', [
			'label'       => __( 'Button Link', 'cnv-school-addon' ),
			'type'        => Controls_Manager::URL,
			'placeholder' => __( 'https://your-link.com', 'cnv-school-addon' ),
			'default'     => [
				'url' => '#',
			],
		] );

		// Secondary Button Style
		$this->add_control(
			'secondary_button_style',
			[
				'label'   => __( 'Shape', 'cnv-school-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-default',
				'options' => [
					'btn-default' => __( 'Default', 'cnv-school-addon' ),
					'btn-outline' => __( 'Outline', 'cnv-school-addon' ),
				],
			]
		);

		$this->add_control(
			'secondary_button_color',
			[
				'label'   => __( 'Fill Color', 'cnv-school-addon' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'btn-dark',
				'options' => [
					'btn-light' => __( 'Light', 'cnv-school-addon' ),
					'btn-dark'  => __( 'Dark', 'cnv-school-addon' ),
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		// Feature Image
		// =====================
		$this->start_controls_section( 'feature_image_section', [
			'label'     => __( 'Feature Image', 'cnv-school-addon' ),
			'tab'       => Controls_Manager::TAB_CONTENT,
			'condition' => [
				'layout!' => 'three',
			],
		] );

		$this->add_control( 'feature_image', [
			'label'     => __( 'Choose Image', 'cnv-school-addon' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/banner/banner.svg'
			],
			'condition' => [
				'layout' => 'one'
			]
		] );

		$this->add_control( 'feature_image_two', [
			'label'     => __( 'Choose Image', 'cnv-school-addon' ),
			'type'      => Controls_Manager::MEDIA,
			'default'   => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/banner/banner-two.svg'
			],
			'condition' => [
				'layout' => 'two'
			]
		] );


		$this->end_controls_section();

		// Banner Shape
		// =====================
		$this->start_controls_section( 'banner_shape_section', [
			'label'     => __( 'Banner Shape', 'cnv-school-addon' ),
			'tab'       => Controls_Manager::TAB_CONTENT,
			'condition' => [
				'layout' => 'two'
			]
		] );

		$this->add_control( 'banner_shape_circle', [
			'label'   => __( 'Choose Circle Shape', 'cnv-school-addon' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/banner/circle.svg'
			]
		] );

		$this->add_control( 'banner_shape_cube', [
			'label'   => __( 'Choose Cube Shape', 'cnv-school-addon' ),
			'type'    => Controls_Manager::MEDIA,
			'default' => [
				'url' => plugin_dir_url( __FILE__ ) . 'images/banner/cube.svg'
			]
		] );

		$this->end_controls_section();

		// Style Settings
		// =====================

		$this->start_controls_section( 'title_style', [
			'label' => __( 'Title', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'title_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .banner__title',
		] );


		$this->add_control( 'title_color', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__title' => 'color: {{VALUE}}',
			],
		] );

		$this->end_controls_section();


		// Description
		// =====================
		$this->start_controls_section( 'description_section', [
			'label' => __( 'Description', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,

		] );

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'     => 'des_typography',
			'label'    => __( 'Typography', 'cnv-school-addon' ),
			'selector' => '{{WRAPPER}} .banner__description',
		] );

		$this->add_control( 'des_color', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner__description' => 'color: {{VALUE}}',
			],

		] );

		$this->end_controls_section();


		// Button Style
		// =====================
		$this->start_controls_section( 'style_button', [
			'label' => __( 'Button', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->start_controls_tabs( 'tabs_button_style' );

		$this->start_controls_tab( 'tab_button_normal', [
			'label' => __( 'Normal', 'cnv-school-addon' ),
		] );

		$this->add_control( 'button_text_color', [
			'label'     => __( 'Text Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '',
			'selectors' => [
				'{{WRAPPER}} .banner-btn' => 'color: {{VALUE}};',
			],
		] );

		$this->add_control( 'button_bg_color', [
			'label'     => __( 'Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner-btn' => 'background-color: {{VALUE}};',
			],
		] );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_border',
				'label'    => __( 'Border', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .banner-btn',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow',
				'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .banner-btn',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'tab_button_hover', [
			'label' => __( 'Hover', 'cnv-school-addon' ),
		] );

		$this->add_control( 'hover_color', [
			'label'     => __( 'Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner-btn:hover' => 'color: {{VALUE}};',
			],

		] );

		$this->add_control( 'button_hover_bg_color', [
			'label'     => __( 'Background Color', 'cnv-school-addon' ),
			'type'      => Controls_Manager::COLOR,
			'selectors' => [
				'{{WRAPPER}} .banner-btn:hover' => 'background-color: {{VALUE}};',
			]
		] );

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'button_hover_border',
				'label'    => __( 'Border', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .banner-btn:hover',
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'button_box_shadow_hover',
				'label'    => __( 'Box Shadow', 'cnv-school-addon' ),
				'selector' => '{{WRAPPER}} .banner-btn',
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->add_group_control( Group_Control_Typography::get_type(), [
			'name'      => 'btn_typography',
			'label'     => __( 'Typography', 'cnv-school-addon' ),
			'selector'  => '{{WRAPPER}} .banner-btn',
			'separator' => 'before'
		] );

		$this->add_control(
			'padding',
			[
				'label'      => __( 'Padding', 'cnv-school-addon' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .banner-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'border-radius',
			[
				'label'      => __( 'Border Radius', 'cnv-school-addon' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .banner-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Background Settings
		// =====================
		$this->start_controls_section( 'style_background', [
			'label' => __( 'Background & Spacing', 'cnv-school-addon' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		] );

		$this->add_group_control( Group_Control_Background::get_type(), [
			'name'     => 'background',
			'label'    => __( 'Background', 'cnv-school-addon' ),
			'types'    => [ 'classic', 'gradient', 'video' ],
			'selector' => '{{WRAPPER}} .banner',
		] );

		$this->add_responsive_control(
			'hero_padding',
			[
				'label'      => __( 'Padding', 'cnv-school-addon' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors'  => [
					'{{WRAPPER}} .banner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}


	protected function render() {
		$settings = $this->get_settings_for_display();

		// Wrapper Classes
		// =====================
		$this->add_render_attribute( 'wrapper', 'class', 'banner' );

		if ( $settings['layout'] == 'one' ) {
			$this->add_render_attribute( 'wrapper', 'class', 'd-flex align-items-center' );
		}

		if ( ! empty( $settings['layout'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'banner--' . $settings['layout'] );
		}

		if ( ! empty( $settings['btn_link']['url'] ) ) {
			$this->add_link_attributes( 'button', $settings['btn_link'] );
			$this->add_render_attribute( 'button', 'class', 'cnv-btn banner-btn' );
			// Button Size
			if ( ! empty( $settings['button_size'] ) ) {
				$this->add_render_attribute( 'button', 'class', $settings['button_size'] );
			}

			// Button Shape
			if ( ! empty( $settings['button_shape'] ) ) {
				$this->add_render_attribute( 'button', 'class', $settings['button_shape'] );
			}

			// Button Style
			if ( ! empty( $settings['primary_button_style'] ) ) {
				$this->add_render_attribute( 'button', 'class', $settings['primary_button_style'] );
			}

			// Button Fill Color
			if ( ! empty( $settings['primary_button_color'] ) ) {
				$this->add_render_attribute( 'button', 'class', $settings['primary_button_color'] );
			}
		}


		// Secondary Button
		// =====================
		if ( ! empty( $settings['sec_btn_link']['url'] ) ) {
			$this->add_link_attributes( 'secondary_button', $settings['sec_btn_link'] );
			$this->add_render_attribute( 'secondary_button', 'class', 'cnv-btn banner-btn banner-btn--two btn-dark' );

			// Button Size
			if ( ! empty( $settings['button_size'] ) ) {
				$this->add_render_attribute( 'secondary_button', 'class', $settings['button_size'] );
			}

			// Button Shape
			if ( ! empty( $settings['button_shape'] ) ) {
				$this->add_render_attribute( 'secondary_button', 'class', $settings['button_shape'] );
			}

			// Button Style
			if ( ! empty( $settings['secondary_button_style'] ) ) {
				$this->add_render_attribute( 'secondary_button', 'class',  $settings['secondary_button_style'] );
			}

			// Button Fill Color
			if ( ! empty( $settings['secondary_button_color'] ) ) {
				$this->add_render_attribute( 'secondary_button', 'class', $settings['secondary_button_color'] );
			}
		}

		$this->add_render_attribute( 'title', 'class', 'banner__title' );

		// Title Animation Style
		// =====================
		if ( ! empty( $settings['animation_style'] ) ) {
			$this->add_render_attribute( 'title', [
				'data-animation' => $settings['animation_style'],
			] );
		}

//		$textAnimation = $this->textAnimation( $settings );
//		$json = str_replace('"','', (string) wp_json_encode( $textAnimation ) );
//		$this->add_render_attribute( 'title', 'data-anime', $json);

		require __DIR__ . '/templates/hero/layout-' . $settings['layout'] . '.php';

	}

	protected function textAnimation( array $settings ) {
		$animation = [];

		if ( ! empty( $settings['animation_style'] == 'one' ) ) {
			$animation['y']       = 90;
			$animation['opacity'] = 0;
			$animation['stagger'] = 0.1;
//			$animation['ease']  = 'Power4.easeOut';
			$animation['ease'] = 'Elastic.easeOut.config(1.2, 0.5)';
		}

		if ( ! empty( $settings['animation_delay'] ) ) {
			$animation['delay'] = $settings['animation_delay'];
		}

		if ( ! empty( $settings['animation_duration'] ) ) {
			$animation['duration'] = $settings['animation_duration'];
		}

		return $animation;
	}
}