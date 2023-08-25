<?php
/**
 * Plugin Name: CNV School Addon
 * Plugin URI: https://codenestventures.com
 * Description: This plugin adds the core features to the CNV School WordPress theme. You must have to install this plugin to get all the features included with the theme.
 * Version: 1.0.0
 * Author: CondNest Ventures
 * Author URI: https://codenestventures.com
 * Text domain: cnv-school-addon
 */

use CodeNestVentures\SchoolAddon\Admin\PostType\Gallery;
use CodeNestVentures\SchoolAddon\DemoImport;

if (!defined('ABSPATH'))
	die('-1');

/**
 * Currently plugin version.
 * Start at version 2.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('CNV_PLUGIN_VERSION', '2.0.0');

/**
 * Constant for the plugins
 */


define('CNV_PLUGIN_URL', plugins_url() . '/cnv-school-addon/' );
define('CNV_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('CNV_PLUGIN_ASSETS_URL', plugins_url() . '/cnv-school-addon/assets/' );
define('CNV_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('CNV_PLUGIN_SCRIPTS', CNV_PLUGIN_URL . 'assets/js');

// Include comoposer autoload
require_once CNV_PLUGIN_DIR . 'vendor/autoload.php';

// Make sure the same class is not loaded twice in free/premium versions.
if (!class_exists('CNV_School_Addon')) {
	/**
	 * Main CNV School Addon Class
	 *
	 * The main class that initiates and runs the CNV School Addon plugin.
	 *
	 * @since 1.0.0
	 */
	final class CNV_School_Addon
	{
		/**
		 * CNV School Addon Version
		 *
		 * Holds the version of the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @var string The plugin version.
		 */
		const VERSION = '1.0';

		/**
		 * Minimum Elementor Version
		 *
		 * Holds the minimum Elementor version required to run the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @var string Minimum Elementor version required to run the plugin.
		 */
		const MINIMUM_ELEMENTOR_VERSION = '3.3.0';

		/**
		 * Minimum PHP Version
		 *
		 * Holds the minimum PHP version required to run the plugin.
		 *
		 * @since 2.0.0
		 *
		 * @var string Minimum PHP version required to run the plugin.
		 */
		const  MINIMUM_PHP_VERSION = '5.6';

		/**
		 * Instance
		 *
		 * Holds a single instance of the `CNV_School_Addon` class.
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 * @static
		 *
		 * @var CNV_School_Addon A single instance of the class.
		 */
		private static $_instance = null;

		/**
		 * The loader that's responsible for maintaining and registering all hooks that power
		 * the plugin.
		 *
		 * @since    1.0.0
		 * @access   protected
		 * @var      CNV_School_Addon $loader Maintains and registers all hooks for the plugin.
		 */
		protected $loader;

		/**
		 * Instance
		 *
		 * Ensures only one instance of the class is loaded or can be loaded.
		 *
		 * @return CNV_School_Addon An instance of the class.
		 * @since 1.0.0
		 *
		 * @access public
		 * @static
		 *
		 */
		public static function instance()
		{
			if (is_null(self::$_instance)) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * Clone
		 *
		 * Disable class cloning.
		 *
		 * @return void
		 * @since 1.0.0
		 *
		 * @access protected
		 *
		 */
		public function __clone()
		{
			// Cloning instances of the class is forbidden
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'cnv-school-addon'), '2.0.0');
		}

		/**
		 * Wakeup
		 *
		 * Disable unserializing the class.
		 *
		 * @return void
		 * @since 1.0.0
		 *
		 * @access protected
		 *
		 */
		public function __wakeup()
		{
			// Unserializing instances of the class is forbidden.
			_doing_it_wrong(__FUNCTION__, esc_html__('Cheatin&#8217; huh?', 'cnv-school-addon'), '2.0.0');
		}

		/**
		 * Constructor
		 *
		 * Initialize the CNV School Addon plugins.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function __construct()
		{
			$this->core_includes();
			$this->init_hooks();
			do_action('cng_school_addon_loaded');

		}

		/**
		 * Include Files
		 *
		 * Load core files required to run the plugin.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function core_includes()
		{
			// Extra
			require_once __DIR__ . '/Includes/mailchimp.php';

			// Elementor custom field icons
			require_once __DIR__ . '/Includes/Icons/icons.php';
			require_once __DIR__ . '/Includes/Helper.php';

			// Aq Resizer
			require_once __DIR__ . '/Includes/Aq_Resize.php';
			// Image Sizes
			require_once __DIR__ . '/Includes/ImageSize.php';

			// Admin
			new CodeNestVentures\SchoolAddon\Admin();
			new DemoImport();
			new Gallery();

			// Elementor Widgets
			CodeNestVentures\SchoolAddon\ElementorWidgets::get_instance();

		}

		/**
		 * Init Hooks
		 *
		 * Hook into actions and filters.
		 *
		 * @since 1.0.0
		 *
		 * @access private
		 */
		private function init_hooks()
		{
			add_action('init', [$this, 'i18n']);
			add_action('plugins_loaded', [$this, 'init']);
		}

		/**
		 * Load Textdomain
		 *
		 * Load plugin localization files.
		 *
		 * @since 1.0.0
		 *
		 * @access public
		 */
		public function i18n()
		{
			load_plugin_textdomain('cnv-school-addon', false, plugin_basename(dirname(__FILE__)) . '/languages');
		}

		/**
		 * Init CNV School Addon
		 *
		 * Load the plugin after Elementor (and other plugins) are loaded.
		 *
		 * @since 1.0.0
		 * @since 2.0.0 The logic moved from a standalone function to this class method.
		 *
		 * @access public
		 */
		public function init()
		{

			if (!did_action('elementor/loaded')) {
				add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
				return;
			}

			// Check for required Elementor version
			if (!version_compare(ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=')) {
				add_action('admin_notices', [$this, 'admin_notice_minimum_elementor_version']);
				return;
			}

			// Check for required PHP version
			if (version_compare(PHP_VERSION, self::MINIMUM_PHP_VERSION, '<')) {
				add_action('admin_notices', [$this, 'admin_notice_minimum_php_version']);
				return;
			}

			// Register Widget Scripts
			add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_widget_styles']);
			add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_widget_styles']);
			add_action('wp_enqueue_scripts', [$this, 'cnv_enqueue_style']);
			add_action('wp_enqueue_scripts', [$this, 'cnv_dequeue'], 100);
			add_action('admin_enqueue_scripts', [$this, 'cnv_admin_enqueue_scripts']);
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have Elementor installed or activated.
		 *
		 * @since 1.1.0
		 * @since 2.0.0 Moved from a standalone function to a class method.
		 *
		 * @access public
		 */
		public function admin_notice_missing_main_plugin()
		{
			$message = sprintf(
			/* translators: 1: CNV School Addon: Elementor */
				esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'cnv-school-addon'),
				'<strong>' . esc_html__('CNV School Addon', 'cnv-school-addon') . '</strong>',
				'<strong>' . esc_html__('Elementor', 'cnv-school-addon') . '</strong>'
			);
			printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required Elementor version.
		 *
		 * @since 1.1.0
		 * @since 2.0.0 Moved from a standalone function to a class method.
		 *
		 * @access public
		 */
		public function admin_notice_minimum_elementor_version()
		{
			$message = sprintf(
			/* translators: 1: CNV School Addon: Elementor 3: Required Elementor version */
				esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'cnv-school-addon'),
				'<strong>' . esc_html__('CNV School Addon', 'cnv-school-addon') . '</strong>',
				'<strong>' . esc_html__('Elementor', 'cnv-school-addon') . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);
			printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
		}

		/**
		 * Admin notice
		 *
		 * Warning when the site doesn't have a minimum required PHP version.
		 *
		 * @since 2.0.0
		 *
		 * @access public
		 */
		public function admin_notice_minimum_php_version()
		{
			$message = sprintf(
			/* translators: 1: CNV School Addon 2: PHP 3: Required PHP version */
				esc_html__('"%1$s" requires "%2$s" version %3$s or greater.', 'cnv-school-addon'),
				'<strong>' . esc_html__('CNV Elements', 'cnv-school-addon') . '</strong>',
				'<strong>' . esc_html__('PHP', 'cnv-school-addon') . '</strong>',
				self::MINIMUM_PHP_VERSION
			);
			printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
		}

		public function cnv_enqueue_style()
		{
			wp_enqueue_style('simpleline', plugins_url('assets/vendors/simple-line-icons//css/simple-line-icons.css', __FILE__));
			wp_enqueue_style('cnv-school-addon-css', plugins_url('assets/css/app.css', __FILE__));
		}

		/**
		 * Register Widget Styles
		 *
		 * Register custom styles required to run CNV School Addon.
		 *
		 * @since 2.0.0
		 * @since 1.7.1 The method moved to this class.
		 *
		 * @access public
		 */

		public function enqueue_widget_styles()
		{
			wp_enqueue_style('simpleline', plugins_url('assets/vendors/simple-line-icons//css/simple-line-icons.css', __FILE__));
			wp_enqueue_style('feather', plugins_url('assets/vendors/feather/css/feather.css', __FILE__));
		}

		public function cnv_admin_enqueue_scripts()
		{
			wp_enqueue_style('feather', plugins_url('assets/vendors/feather/css/feather.css', __FILE__));
			wp_enqueue_style('admin', plugins_url('assets/css/admin.css', __FILE__));
		}


		/**
		 * Dequeue the Elementor Animation CSS.
		 *
		 * Hooked to the wp_print_scripts action, with a late priority (100),
		 * so that it is after the script was enqueued.
		 */

		function cnv_dequeue()
		{
			add_action('wp_footer', [$this, 'remove_elementor_animations_css']);
		}

		function remove_elementor_animations_css()
		{
			wp_dequeue_style('e-animations');
			wp_deregister_style('e-animations');
		}

	}
}
// Make sure the same function is not loaded twice in free/premium versions.

if (!function_exists('cnv_core_load')) {
	/**
	 * Load CNV School Addon
	 *
	 * Main instance of CNV_School_Addon.
	 *
	 * @since 1.0.0
	 * @since 1.0.0 The logic moved from this function to a class method.
	 */
	function cnv_core_load()
	{
		return CNV_School_Addon::instance();
	}

	// Run CNV School Addon
	cnv_core_load();
}
