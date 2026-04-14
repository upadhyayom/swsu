<?php
/**
 * Custom Taxonomies for SkinLuxe
 *
 * Registers:
 *   - skin_concern   ("Skin Concern")
 *   - key_ingredient ("Key Ingredient")
 *   - product_line   ("Category" — Face / Body / Grooming)
 *
 * All are attached to the WooCommerce `product` post type, exposed in the
 * admin menu, and available over the REST API (for headless / block editor use).
 *
 * @package SkinLuxe
 */

defined( 'ABSPATH' ) || exit;

function skinluxe_register_taxonomies() {

	/* ------------------- Skin Concern ------------------- */
	register_taxonomy( 'skin_concern', array( 'product' ), array(
		'labels' => array(
			'name'              => __( 'Skin Concerns', 'skinluxe' ),
			'singular_name'     => __( 'Skin Concern', 'skinluxe' ),
			'menu_name'         => __( 'Skin Concerns', 'skinluxe' ),
			'search_items'      => __( 'Search Concerns', 'skinluxe' ),
			'all_items'         => __( 'All Concerns', 'skinluxe' ),
			'edit_item'         => __( 'Edit Concern', 'skinluxe' ),
			'update_item'       => __( 'Update Concern', 'skinluxe' ),
			'add_new_item'      => __( 'Add New Concern', 'skinluxe' ),
			'new_item_name'     => __( 'New Concern Name', 'skinluxe' ),
		),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_menu'      => true,
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
		'rest_base'         => 'skin-concerns',
		'rewrite'           => array( 'slug' => 'concern', 'with_front' => false ),
	) );

	/* ------------------- Key Ingredient ------------------- */
	register_taxonomy( 'key_ingredient', array( 'product' ), array(
		'labels' => array(
			'name'          => __( 'Key Ingredients', 'skinluxe' ),
			'singular_name' => __( 'Key Ingredient', 'skinluxe' ),
			'menu_name'     => __( 'Key Ingredients', 'skinluxe' ),
			'add_new_item'  => __( 'Add New Ingredient', 'skinluxe' ),
		),
		'hierarchical'      => false,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_menu'      => true,
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
		'rest_base'         => 'key-ingredients',
		'rewrite'           => array( 'slug' => 'ingredient', 'with_front' => false ),
	) );

	/* ------------------- Product Line (Face / Body / Grooming) ------------------- */
	register_taxonomy( 'product_line', array( 'product' ), array(
		'labels' => array(
			'name'          => __( 'Lines', 'skinluxe' ),
			'singular_name' => __( 'Line', 'skinluxe' ),
			'menu_name'     => __( 'Lines (Face/Body/Grooming)', 'skinluxe' ),
		),
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_menu'      => true,
		'show_in_nav_menus' => true,
		'show_in_rest'      => true,
		'rest_base'         => 'product-lines',
		'rewrite'           => array( 'slug' => 'line', 'with_front' => false ),
	) );
}
add_action( 'init', 'skinluxe_register_taxonomies', 0 );

/**
 * Seed default terms once, on first activation.
 */
function skinluxe_seed_default_terms() {
	if ( get_option( 'skinluxe_terms_seeded' ) ) return;

	$defaults = array(
		'skin_concern'   => array( 'Acne', 'Aging', 'Dark Spots', 'Pigmentation', 'Dryness' ),
		'key_ingredient' => array( 'Vitamin C', 'Salicylic Acid', 'Niacinamide', 'Alpha Arbutin', 'Hyaluronic Acid', 'Azelaic Acid', 'Kojic Acid', 'Rice Water' ),
		'product_line'   => array( 'Face', 'Body', 'Grooming' ),
	);

	foreach ( $defaults as $tax => $terms ) {
		foreach ( $terms as $term ) {
			if ( ! term_exists( $term, $tax ) ) {
				wp_insert_term( $term, $tax );
			}
		}
	}
	update_option( 'skinluxe_terms_seeded', 1 );
}
add_action( 'init', 'skinluxe_seed_default_terms', 20 );
