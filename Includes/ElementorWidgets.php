<?php
namespace CodeNestVentures\SchoolAddon;

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

//define( 'CNV_ELEMENTOR_CORE_URL', plugins_url( '/', __FILE__ ) );
//define( 'CNV_ELEMENTOR_CORE_PATH', plugin_dir_path( __FILE__ ) );
//define( 'CNV_ELEMENTOR_CORE_FILE', __FILE__ );


class ElementorWidgets {
	// Properties

	/**
	 * Instance
	 *
	 * @var ElementorWidgets
	 */
	private static $instance = null;

	/**
	 * Get instance
	 *
	 * @return ElementorWidgets
	 */

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * ElementorWidgets constructor.
	 */

	public function __construct() {
		add_action( 'plugins_loaded', [ $this, 'init_addons' ] );
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_categories' ] );
		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'before_enqueue_scripts' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'after_register_scripts' ] );
	}

	/**
	 * Register Categories for Elementor
	 * @param $elements_manager
	 */

	public function register_categories( $elements_manager ) {
		$elements_manager->add_category(
			'cnv-elements',
			[
				'title' => __( 'CNV Elements', 'cnv-school-addon' ),
				'icon' => 'fa fa-plug',
			]
		);
	}

	/**
	 * Register widgets
	 */

	public function register_widgets() {
		$widget_manager = Plugin::instance()->widgets_manager;

		foreach ( glob( CNV_PLUGIN_PATH . 'Includes/Widgets/*.php' ) as $file ) {
			$base  = basename( str_replace( '.php', '', $file ) );
			$class = ucwords( str_replace( '-', ' ', $base ) );
			$class = str_replace( ' ', '_', $class );
			$class = sprintf( '\CodeNestVentures\SchoolAddon\Widgets\%s', $class );

			if ( class_exists( $class ) ) {
				$widget_manager->register( new $class );
			}
		}
	}


	/**
	 * Register addon by file name
	 */
	public function register_modules_addon( ) {
		foreach ( glob( CNV_PLUGIN_PATH . 'Includes/Elementor/*.php' ) as $file ) {
			$base  = basename( str_replace( '.php', '', $file ) );
			$class = ucwords( str_replace( '-', ' ', $base ) );
			$class = str_replace( ' ', '_', $class );
			$class = sprintf( '\CodeNestVentures\SchoolAddon\Elementor\%s', $class );

			if ( class_exists( $class ) ) {
				new $class;
			}
		}
	}

	/**
	 * Init Addons
	 */

	public function init_addons() {
		/**
		 * Check if Elementor installed and activated
		 * @see https://developers.elementor.com/creating-an-extension-for-elementor/
		 */
		if ( ! did_action( 'elementor/loaded' ) ) {
			return;
		}

		add_action( 'elementor/widgets/widgets_registered', [ $this, 'register_widgets' ] );
		$this->register_modules_addon();
	}


	/**
	 * Enqueue scripts
	 */
	public function after_register_scripts() {
		wp_register_script( 'countUp', CNV_PLUGIN_SCRIPTS . '/countUp.min.js', array( 'jquery' ), CNV_PLUGIN_VERSION, true );
		wp_register_script( 'appear-js', CNV_PLUGIN_SCRIPTS . '/jquery.appear.js', array( 'jquery' ), CNV_PLUGIN_VERSION, true );
		wp_register_script( 'countTo', CNV_PLUGIN_SCRIPTS . '/jquery.countTo.js', array( 'jquery' ), CNV_PLUGIN_VERSION, true );
		wp_register_script( 'parallax-scroll', CNV_PLUGIN_SCRIPTS . '/jquery.parallax-scroll.js', array( 'jquery' ), CNV_PLUGIN_VERSION, true );
		wp_register_script( 'gmap3', CNV_PLUGIN_SCRIPTS . '/gmap.js', array( 'jquery' ), CNV_PLUGIN_VERSION, true );
		wp_register_script( 'isotope', CNV_PLUGIN_SCRIPTS . '/isotope.pkgd.min.js', array( 'jquery' ), CNV_PLUGIN_VERSION, true );
		wp_register_script( 'parallax', CNV_PLUGIN_SCRIPTS . '/parallax.min.js', array( 'jquery' ), CNV_PLUGIN_VERSION, true );
		wp_enqueue_script( 'marquee', CNV_PLUGIN_SCRIPTS . '/jquery.marquee.js', array('jquery'), CNV_PLUGIN_VERSION, true );
	}

	/**
	 * Enqueue Scripts
	 *
	 * @return void
	 */

	public function before_enqueue_scripts() {
		wp_enqueue_script( 'cnv-elementor', CNV_PLUGIN_SCRIPTS . '/elementor.js', array(
			'jquery',
			'elementor-frontend'
		), CNV_PLUGIN_VERSION, true );
	}
}
