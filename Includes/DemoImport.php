<?php

namespace CodeNestVentures\SchoolAddon;

class DemoImport {
	public function __construct() {
		add_filter( 'ocdi/plugin_page_setup', [ $this, 'ocdi_plugin_page_setup' ] );
		add_action( 'ocdi/after_import', [ $this, 'cnv_after_import' ] );
		add_action( 'ocdi/after_content_import_execution', [$this, 'cnv_after_content_import_execution'	], 3, 99 );
		add_filter( 'pt-ocdi/import_files', [ $this, 'cnv_ocdi_import_files' ] );
		add_filter( 'ocdi/register_plugins', [$this, 'ocdi_register_plugins'] );
	}

	function ocdi_plugin_page_setup( $default_settings ) {
		$default_settings['parent_slug'] = 'themes.php';
		$default_settings['page_title']  = esc_html__( 'One Click Demo Import', 'cnv-school-addon' );
		$default_settings['menu_title']  = esc_html__( 'Import Demo Data', 'cnv-school-addon' );
		$default_settings['capability']  = 'import';
		$default_settings['menu_slug']   = 'cnv-demo-import';

		return $default_settings;
	}

	/**
	 * Adding local_import_json and import_json param supports.
	 */

	public function cnv_after_content_import_execution( $selected_import_files, $import_files, $selected_index ) {

		$downloader = new \OCDI\Downloader();

		if ( ! empty( $import_files[ $selected_index ]['import_json'] ) ) {

			foreach ( $import_files[ $selected_index ]['import_json'] as $index => $import ) {
				$file_path = $downloader->download_file( $import['file_url'], 'demo-import-file-' . $index . '-' . date( 'Y-m-d__H-i-s' ) . '.json' );
				$file_raw  = \OCDI\Helpers::data_from_file( $file_path );
				update_option( $import['option_name'], json_decode( $file_raw, true ) );
			}

		} else if ( ! empty( $import_files[ $selected_index ]['local_import_json'] ) ) {

			foreach ( $import_files[ $selected_index ]['local_import_json'] as $index => $import ) {
				$file_path = $import['file_path'];
				$file_raw  = \OCDI\Helpers::data_from_file( $file_path );
				update_option( $import['option_name'], json_decode( $file_raw, true ) );
			}

		}

	}

	public function cnv_ocdi_import_files() {
		return array(

			array(
				'import_file_name'         => 'Home Startup Business Agency',
				'local_import_file'        => CNV_PLUGIN_DIR . 'demo-data/content.xml',
				'local_import_widget_file' => CNV_PLUGIN_DIR . 'demo-data/widgets.wie',
				'local_import_json'        => array(
					array(
						'file_path'   => CNV_PLUGIN_DIR . 'demo-data/options.json',
						'option_name' => 'cnv_framework',
					)
				),
				'import_preview_image_url' => CNV_PLUGIN_URL . 'demo-data/thumbnail/home-one.jpg',
				'preview_url'              => 'https://codeboxr.net/themedemo/wpcnv2/',
			),

			array(
				'import_file_name'         => 'Home Two',
				'local_import_file'        => CNV_PLUGIN_URL . 'demo-data/content.xml',
				'local_import_widget_file' => CNV_PLUGIN_URL . 'demo-data/widgets.wie',
				'local_import_json'        => array(
					array(
						'file_path'   => CNV_PLUGIN_DIR . 'demo-data/options.json',
						'option_name' => 'cnv_framework',
					)
				),
				'import_preview_image_url' => CNV_PLUGIN_URL . 'demo-data/thumbnail/home-two.png',
				'preview_url'              => 'https://codeboxr.net/themedemo/wpcnv2/',
			)
		);
	}

	/**
	 * Set Menu and font page
	 *
	 * @param $selected_import
	 */
	public function cnv_after_import( $selected_import ) {
		echo "This will be displayed on all after imports!";

		wp_delete_post( 1 );

		if ( 'Home One' === $selected_import['import_file_name'] ) {
			$main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
			set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			) );

			$front_page_id = get_page_by_title( str_replace( esc_html( '&' ), 'n', $selected_import['import_file_name'] ) );

			$blog_page_id = get_page_by_title( 'Blog' );
			update_option( 'page_for_posts', $blog_page_id->ID );

			if ( isset( $front_page_id ) and is_object( $front_page_id ) ) {
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $front_page_id->ID );
			}
		} elseif ( 'Home Two' === $selected_import['import_file_name'] ) {
			$main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
			set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			) );

			$front_page_id = get_page_by_title( str_replace( esc_html( '&' ), 'n', $selected_import['import_file_name'] ) );

			$blog_page_id = get_page_by_title( 'Blog' );
			update_option( 'page_for_posts', $blog_page_id->ID );

			if ( isset( $front_page_id ) and is_object( $front_page_id ) ) {
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $front_page_id->ID );
			}
		} elseif ( 'Home Three' === $selected_import['import_file_name'] ) {
			$main_menu = get_term_by( 'name', 'Primary Menu', 'nav_menu' );
			set_theme_mod( 'nav_menu_locations', array(
				'primary' => $main_menu->term_id,
			) );

			$front_page_id = get_page_by_title( str_replace( esc_html( '&' ), 'n', $selected_import['import_file_name'] ) );

			$blog_page_id = get_page_by_title( 'Blog' );
			update_option( 'page_for_posts', $blog_page_id->ID );

			if ( isset( $front_page_id ) and is_object( $front_page_id ) ) {
				update_option( 'show_on_front', 'page' );
				update_option( 'page_on_front', $front_page_id->ID );
			}
		}
	}


	function ocdi_register_plugins( $plugins ) {

		// Required: List of plugins used by all theme demos.
		$theme_plugins = [
			[ // A WordPress.org plugin repository example.
				'name'     => __('CNV core', 'cnv-school-addon'),
				'slug'     => 'cnv-school-addon',
				'required' => true,
				'source'   => 'https://codeboxr.net/wpthemes/wpcnv/cnv-school-addon.zip',
			],
			[
				'name'     => esc_attr__( 'Codestar Framework', 'cnv-school-addon' ),
				'slug'     => 'codestar-framework',
				'source'   => ( 'https://demo.gptheme.com/plugins/codestar-framework.zip' ),
				'required' => true,
				'preselected' => true,
			],
			[
				'name'     => esc_attr__( 'Elementor', 'cnv-school-addon' ),
				'slug'     => 'elementor',
				'required' => true,
			]
		];

		// Check if user is on the theme recommeneded plugins step and a demo was selected.
		if ( isset( $_GET['import'] ) ) {

			// Adding one additional plugin for the first demo import ('import' number = 0).
			if ( $_GET['import'] === '0' ) {
				$theme_plugins[] = [
					'name'     => __('Contact Form 7', 'cnv-school-addon'),
					'slug'     => 'contact-form-7',
					'required' => false,
				];
			}
		}
		return array_merge( $plugins, $theme_plugins );
	}
}