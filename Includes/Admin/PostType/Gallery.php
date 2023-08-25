<?php

namespace CodeNestVentures\SchoolAddon\Admin\PostType;

class Gallery {
	/**
	 * Post Type
	 *
	 * @var string
	 */
	private $post_type = 'gallery';

	/**
	 * Post Type Slug
	 *
	 * @var string
	 */

	private $post_type_slug = 'gallery';

	/**
	 * Post Type Singular Name
	 *
	 * @var string
	 */

	private $post_type_singular_name = 'Gallery';

	/**
	 * Post Type Plural Name
	 *
	 * @var string
	 */

	private $post_type_plural_name = 'Galleries';

	/**
	 * Post Type Icon
	 *
	 * @var string
	 */

	private $post_type_icon = 'dashicons-calendar-alt';

	/**
	 * Post Type Taxonomy
	 *
	 * @var string
	 */

	private $post_type_taxonomy = 'gallery_category';

	/**
	 * Post Type Taxonomy Singular Name
	 *
	 * @var string
	 */

	private $post_type_taxonomy_singular_name = 'Gallery Category';

	/**
	 * Post Type Taxonomy Plural Name
	 *
	 * @var string
	 */

	private $post_type_taxonomy_plural_name = 'Gallery Categories';

	/**
	 * post_type_taxonomy_slug
	 */

	private $post_type_taxonomy_slug = "gallery_category";


	/**
	 * PostType constructor.
	 */
	public function __construct() {
		add_action( 'init', array( $this, 'register_post_type' ) );
//		add_action( 'init', array( $this, 'register_taxonomy' ) );

		// Single Template
		add_filter( 'single_template', array( $this, 'single_template' ) );
	}

	/**
	 * Register Post Type
	 */

	public function register_post_type() {
		$labels = array(
			'name'                  => _x( $this->post_type_plural_name, 'Post Type General Name', 'cnv-school-addon' ),
			'singular_name'         => _x( $this->post_type_singular_name, 'Post Type Singular Name', 'cnv-school-addon' ),
			'menu_name'             => __( $this->post_type_plural_name, 'cnv-school-addon' ),
			'name_admin_bar'        => __( $this->post_type_singular_name, 'cnv-school-addon' ),
			'archives'              => __( $this->post_type_plural_name . ' Archives', 'cnv-school-addon' ),
			'attributes'            => __( $this->post_type_singular_name . ' Attributes', 'cnv-school-addon' ),
			'parent_item_colon'     => __( 'Parent ' . $this->post_type_singular_name . ':', 'cnv-school-addon' ),
			'all_items'             => __( 'All ' . $this->post_type_plural_name, 'cnv-school-addon' ),
			'add_new_item'          => __( 'Add New ' . $this->post_type_singular_name, 'cnv-school-addon' ),
			'add_new'               => __( 'Add New', 'cnv-school-addon' ),
			'new_item'              => __( 'New ' . $this->post_type_singular_name, 'cnv-school-addon' ),
			'edit_item'             => __( 'Edit ' . $this->post_type_singular_name, 'cnv-school-addon' ),
			'update_item'           => __( 'Update ' . $this->post_type_singular_name, 'cnv-school-addon' ),
			'view_item'             => __( 'View ' . $this->post_type_singular_name, 'cnv-school-addon' ),
			'view_items'            => __( 'View ' . $this->post_type_plural_name, 'cnv-school-addon' ),
			'search_items'          => __( 'Search ' . $this->post_type_singular_name, 'cnv-school-addon' ),
			'not_found'             => __( 'Not found', 'cnv-school-addon' ),
			'not_found_in_trash'    => __( 'Not found in Trash', 'cnv-school-addon' ),
			'featured_image'        => __( 'Featured Image', 'cnv-school-addon' ),
			'set_featured_image'    => __( 'Set featured image', 'cnv-school-addon' ),
			'remove_featured_image' => __( 'Remove featured image', 'cnv-school-addon' ),
			'use_featured_image'    => __( 'Use as featured image', 'cnv-school-addon' ),
		);

		$args = array(
			'label'               => __( $this->post_type_singular_name, 'cnv-school-addon' ),
			'description'         => __( $this->post_type_plural_name, 'cnv-school-addon' ),
			'labels'              => $labels,
			'supports' => array( 'title', 'editor', 'elementor', 'thumbnail', ),
			'taxonomies'          => array( $this->post_type_taxonomy ),
			'hierarchical'        => false,
			'show_in_rest'        => true,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'menu_position'       => 5,
			'menu_icon'           => $this->post_type_icon,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'rewrite'             => array( 'slug' => $this->post_type_slug ),
		);

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register Taxonomy
	 */


	public function register_taxonomy() {
		$labels = array(
			'name'                       => _x( $this->post_type_taxonomy_plural_name, 'Taxonomy General Name', 'cnv-school-addon' ),
			'singular_name'              => _x( $this->post_type_taxonomy_singular_name, 'Taxonomy Singular Name', 'cnv-school-addon' ),
			'menu_name'                  => __( $this->post_type_taxonomy_plural_name, 'cnv-school-addon' ),
			'all_items'                  => __( 'All ' . $this->post_type_taxonomy_plural_name, 'cnv-school-addon' ),
			'parent_item'                => __( 'Parent ' . $this->post_type_taxonomy_singular_name, 'cnv-school-addon' ),
			'parent_item_colon'          => __( 'Parent ' . $this->post_type_taxonomy_singular_name . ':', 'cnv-school-addon' ),
			'new_item_name'              => __( 'New ' . $this->post_type_taxonomy_singular_name . ' Name', 'cnv-school-addon' ),
			'add_new_item'               => __( 'Add New ' . $this->post_type_taxonomy_singular_name, 'cnv-school-addon' ),
			'edit_item'                  => __( 'Edit ' . $this->post_type_taxonomy_singular_name, 'cnv-school-addon' ),
			'update_item'                => __( 'Update ' . $this->post_type_taxonomy_singular_name, 'cnv-school-addon' ),
			'view_item'                  => __( 'View ' . $this->post_type_taxonomy_singular_name, 'cnv-school-addon' ),
			'separate_items_with_commas' => __( 'Separate ' . $this->post_type_taxonomy_plural_name . ' with commas', 'cnv-school-addon' ),
			'add_or_remove_items'        => __( 'Add or remove ' . $this->post_type_taxonomy_plural_name, 'cnv-school-addon' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'cnv-school-addon' ),
			'popular_items'              => __( 'Popular ' . $this->post_type_taxonomy_plural_name, 'cnv-school-addon' ),
			'search_items'               => __( 'Search ' . $this->post_type_taxonomy_plural_name, 'cnv-school-addon' ),
			'not_found'                  => __( 'Not Found', 'cnv-school-addon' ),
			'no_terms'                   => __( 'No ' . $this->post_type_taxonomy_plural_name, 'cnv-school-addon' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_in_rest'               => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => true,
			'rewrite'                    => array( 'slug' => $this->post_type_taxonomy_slug ),
		);

		register_taxonomy( $this->post_type_taxonomy, array( $this->post_type ), $args );
	}

	// Single Post Template
	public function single_template( $single_template ) {
		global $post;

		if ( $post->post_type == $this->post_type ) {
			$single_template = plugin_dir_path( __FILE__ ) . 'views/single-gallery.php';
		}

		return $single_template;
	}
}