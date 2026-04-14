<?php
/**
 * SkinLuxe Theme Functions
 *
 * @package SkinLuxe
 */

defined( 'ABSPATH' ) || exit;

define( 'SKINLUXE_VERSION', '1.0.0' );
define( 'SKINLUXE_DIR', get_template_directory() );
define( 'SKINLUXE_URI', get_template_directory_uri() );

/* -------------------------------------------------------------------------
 * 1. Theme Setup
 * ------------------------------------------------------------------------- */
function skinluxe_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	// WooCommerce support
	add_theme_support( 'woocommerce', array(
		'thumbnail_image_width' => 800,
		'single_image_width'    => 1400,
		'product_grid'          => array(
			'default_rows'    => 3,
			'min_rows'        => 2,
			'default_columns' => 4,
			'min_columns'     => 2,
			'max_columns'     => 6,
		),
	) );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'skinluxe' ),
		'footer'  => __( 'Footer Menu', 'skinluxe' ),
	) );
}
add_action( 'after_setup_theme', 'skinluxe_setup' );

/* -------------------------------------------------------------------------
 * 2. Enqueue Assets
 * ------------------------------------------------------------------------- */
function skinluxe_enqueue_assets() {
	// Google Fonts — luxury sans-serif pairing
	wp_enqueue_style(
		'skinluxe-fonts',
		'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600&family=Cormorant+Garamond:wght@300;400;500&display=swap',
		array(),
		null
	);

	// Tailwind via CDN (quick build). For production, replace with a compiled build.
	wp_enqueue_script(
		'skinluxe-tailwind-cdn',
		'https://cdn.tailwindcss.com',
		array(),
		'3.4.0',
		false
	);

	wp_enqueue_style(
		'skinluxe-main',
		SKINLUXE_URI . '/assets/css/main.css',
		array(),
		SKINLUXE_VERSION
	);

	wp_enqueue_script(
		'skinluxe-main',
		SKINLUXE_URI . '/assets/js/main.js',
		array( 'jquery' ),
		SKINLUXE_VERSION,
		true
	);

	wp_localize_script( 'skinluxe-main', 'SkinLuxeData', array(
		'ajax_url'          => admin_url( 'admin-ajax.php' ),
		'nonce'             => wp_create_nonce( 'skinluxe_nonce' ),
		'cart_url'          => function_exists( 'wc_get_cart_url' ) ? wc_get_cart_url() : '',
		'checkout_url'      => function_exists( 'wc_get_checkout_url' ) ? wc_get_checkout_url() : '',
		'currency_symbol'   => function_exists( 'get_woocommerce_currency_symbol' ) ? get_woocommerce_currency_symbol() : '$',
		'free_shipping_min' => (float) apply_filters( 'skinluxe_free_shipping_min', 75 ),
	) );
}
add_action( 'wp_enqueue_scripts', 'skinluxe_enqueue_assets' );

/* -------------------------------------------------------------------------
 * 3. Load Modules
 * ------------------------------------------------------------------------- */
require_once SKINLUXE_DIR . '/inc/taxonomies.php';
require_once SKINLUXE_DIR . '/inc/ajax-cart.php';
require_once SKINLUXE_DIR . '/inc/product-seeder.php';

/* -------------------------------------------------------------------------
 * 4. WooCommerce Layout Tweaks
 * ------------------------------------------------------------------------- */
// Remove sidebar on WooCommerce pages for clean minimalist layout.
add_action( 'init', function() {
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
});

// Products per page on archive.
add_filter( 'loop_shop_per_page', function() { return 12; }, 20 );

// Add fragment refresh on add-to-cart.
add_filter( 'woocommerce_add_to_cart_fragments', function( $fragments ) {
	ob_start();
	skinluxe_mini_cart_count();
	$fragments['.skinluxe-cart-count'] = ob_get_clean();

	ob_start();
	skinluxe_mini_cart_drawer_contents();
	$fragments['.skinluxe-drawer-contents'] = ob_get_clean();

	return $fragments;
});

/**
 * True only when WooCommerce is active AND the cart singleton is ready.
 * Cart is not constructed until the 'wp_loaded' hook, so earlier calls are unsafe.
 */
function skinluxe_wc_cart_ready() {
	return function_exists( 'WC' ) && WC() instanceof WooCommerce && isset( WC()->cart ) && WC()->cart;
}

// Cart count bubble.
function skinluxe_mini_cart_count() {
	$count = skinluxe_wc_cart_ready() ? (int) WC()->cart->get_cart_contents_count() : 0;
	printf(
		'<span class="skinluxe-cart-count" data-count="%d">%d</span>',
		esc_attr( $count ),
		esc_html( $count )
	);
}

/* -------------------------------------------------------------------------
 * 5. Helper: get taxonomy terms with thumbnails (for Shop By sections)
 * ------------------------------------------------------------------------- */
function skinluxe_get_terms_with_images( $taxonomy, $limit = 6 ) {
	$terms = get_terms( array(
		'taxonomy'   => $taxonomy,
		'hide_empty' => false,
		'number'     => $limit,
	) );
	if ( is_wp_error( $terms ) ) return array();
	return $terms;
}
