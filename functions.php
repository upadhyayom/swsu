<?php
/**
 * Swsu Elementor Premium Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// Require the robust Hostinger-bypass auto-seeders
require_once get_template_directory() . '/inc/product-seeder.php';
require_once get_template_directory() . '/inc/page-seeder.php';

function swsu_elementor_setup() {
	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	// Let WordPress manage the document title.
	add_theme_support( 'title-tag' );

	// Enable featured image support.
	add_theme_support( 'post-thumbnails' );

	// Elementor specific support
	add_theme_support( 'elementor' );

	// WooCommerce support
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );

	// Register Navigation Menus
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Primary', 'swsu-elementor' ),
		'footer' => esc_html__( 'Footer', 'swsu-elementor' ),
	) );
}
add_action( 'after_setup_theme', 'swsu_elementor_setup' );

/**
 * Enqueue scripts and styles.
 */
function swsu_elementor_scripts() {
	// Enqueue Google Fonts
	wp_enqueue_style( 'swsu-fonts', 'https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Inter:wght@300;400;500;600&display=swap', array(), null );
	
	// Main Stylesheet
	wp_enqueue_style( 'swsu-style', get_stylesheet_uri(), array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'swsu_elementor_scripts' );

/**
 * Disable default WooCommerce wrapper so Elementor / our theme controls the layout perfectly.
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

add_action( 'woocommerce_before_main_content', 'swsu_elementor_wrapper_start', 10 );
function swsu_elementor_wrapper_start() {
	echo '<main id="main" class="site-main" style="padding-top: 80px; padding-bottom: 80px; max-width: 1200px; margin: 0 auto; color: var(--swsu-ink); font-family: var(--font-sans);">';
}

add_action( 'woocommerce_after_main_content', 'swsu_elementor_wrapper_end', 10 );
function swsu_elementor_wrapper_end() {
	echo '</main>';
}
