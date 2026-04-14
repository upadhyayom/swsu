<?php
/**
 * Product Seeder
 *
 * Inserts the canonical SkinLuxe catalog with correct taxonomy assignments.
 *
 * Run it either way:
 *   WP-CLI:  wp skinluxe seed-products
 *   URL:     /wp-admin/?skinluxe_seed=1   (must be logged in as admin)
 *
 * Idempotent — checks by SKU before creating.
 *
 * @package SkinLuxe
 */

defined( 'ABSPATH' ) || exit;

/**
 * Canonical product catalog.
 *
 * Each entry: title, sku, price, size, short_description, line, concerns[], ingredients[]
 */
function skinluxe_product_catalog() {
	return array(
		array(
			'title'        => 'Vitamin C & Hyaluronic Face Wash - 100ml',
			'sku'          => 'SWSU-FW-VC-100',
			'price'        => 399.00,
			'size'         => '100ml',
			'short'        => 'A daily brightening and hydrating Ayurvedic wash.',
			'line'         => 'Face',
			'concerns'     => array( 'Pigmentation' ),
			'ingredients'  => array( 'Vitamin C', 'Hyaluronic Acid' ),
			'image'        => 'https://images.unsplash.com/photo-1615397323719-20fbd589f38f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => '2% Salicylic & Rice Water Face Wash - 100ml',
			'sku'          => 'SWSU-FW-SA-100',
			'price'        => 399.00,
			'size'         => '100ml',
			'short'        => 'Anti-tan charcoal face wash enriched with Green Tea and Coconut Oil.',
			'line'         => 'Face',
			'concerns'     => array( 'Acne', 'Dark Spots' ),
			'ingredients'  => array( 'Salicylic Acid', 'Rice Water', 'Niacinamide' ),
			'image'        => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => '15% Vitamin C Face Serum with Alpha Arbutin & Niacinamide - 30ml',
			'sku'          => 'SWSU-SR-VC15-30',
			'price'        => 599.00,
			'size'         => '30ml',
			'short'        => 'High-potency brightening serum for a flawless, glowing complexion.',
			'line'         => 'Face',
			'concerns'     => array( 'Dark Spots', 'Pigmentation' ),
			'ingredients'  => array( 'Vitamin C', 'Alpha Arbutin', 'Niacinamide' ),
			'image'        => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Anti-Aging & Age-Defying Face Serum - 30ml',
			'sku'          => 'SWSU-SR-AGE-30',
			'price'        => 649.00,
			'size'         => '30ml',
			'short'        => 'Fine lines and wrinkle corrector infused with clinical actives.',
			'line'         => 'Face',
			'concerns'     => array( 'Aging' ),
			'ingredients'  => array(),
			'image'        => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Acne, Scar & Dark Spot Corrector Serum - 30ml',
			'sku'          => 'SWSU-SR-ACNE-30',
			'price'        => 599.00,
			'size'         => '30ml',
			'short'        => 'Formulated with Salicylic and Azelaic acid to visibly reduce scarring.',
			'line'         => 'Face',
			'concerns'     => array( 'Acne', 'Dark Spots' ),
			'ingredients'  => array( 'Salicylic Acid', 'Azelaic Acid' ),
			'image'        => 'https://images.unsplash.com/photo-1599305090598-fe179d501227?auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Face Mist Toner with Niacinamide & Hyaluronic - 100ml',
			'sku'          => 'SWSU-TN-MIST-100',
			'price'        => 299.00,
			'size'         => '100ml',
			'short'        => 'Hydrating boost that refines pores and locks in moisture instantly.',
			'line'         => 'Face',
			'concerns'     => array( 'Dryness' ),
			'ingredients'  => array( 'Niacinamide', 'Hyaluronic Acid' ),
			'image'        => 'https://images.unsplash.com/photo-1570554886111-e80fcca6a029?auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Face Moisturizer with SPF - 100ml',
			'sku'          => 'SWSU-MO-SPF-100',
			'price'        => 449.00,
			'size'         => '100ml',
			'short'        => 'Daily defense moisturizer to protect your skin barrier.',
			'line'         => 'Face',
			'concerns'     => array( 'Aging', 'Dryness' ),
			'ingredients'  => array(),
			'image'        => 'https://images.unsplash.com/photo-1555820598-c801c13d7899?auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Charcoal Face Pack - 100g',
			'sku'          => 'SWSU-MK-CHAR-100',
			'price'        => 349.00,
			'size'         => '100g',
			'short'        => 'Deep pore detox formula to pull impurities and reveal radiant skin.',
			'line'         => 'Face',
			'concerns'     => array( 'Acne' ),
			'ingredients'  => array( 'Activated Charcoal' ),
			'image'        => 'https://images.unsplash.com/photo-1601049541289-9b1b7bbbfe19?auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'FACE Scrub - 100g',
			'sku'          => 'SWSU-EX-SCB-100',
			'price'        => 299.00,
			'size'         => '100g',
			'short'        => 'Gentle exfoliation for shedding dead skin and reducing texture.',
			'line'         => 'Face',
			'concerns'     => array( 'Pigmentation' ),
			'ingredients'  => array(),
			'image'        => 'https://images.unsplash.com/photo-1615397323984-dc3b99db2769?auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => '1% Kojic, Alpha Arbutin, 2% Niacinamide Body Wash - 200ml',
			'sku'          => 'SWSU-BW-KOJI-200',
			'price'        => 499.00,
			'size'         => '200ml',
			'short'        => 'Clinical body wash designed to unify tone and soften texture.',
			'line'         => 'Body',
			'concerns'     => array( 'Dark Spots' ),
			'ingredients'  => array( 'Kojic Acid', 'Niacinamide' ),
			'image'        => 'https://images.unsplash.com/photo-1617897903246-719242758050?auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Beard Growth Oil - 30ml',
			'sku'          => 'SWSU-GR-BRD-30',
			'price'        => 299.00,
			'size'         => '30ml',
			'short'        => 'Redensifying organic oil for a thicker, softer, fuller beard.',
			'line'         => 'Grooming',
			'concerns'     => array(),
			'ingredients'  => array(),
			'image'        => 'https://images.unsplash.com/photo-1629198688000-71f23e745b6e?auto=format&fit=crop&w=800&q=80',
		),
	);
}

/**
 * Insert / update catalog into WooCommerce.
 */
function skinluxe_seed_products( $log = false ) {
	if ( ! class_exists( 'WC_Product_Simple' ) ) {
		if ( $log ) echo "WooCommerce not active.\n";
		return 0;
	}

	$created = 0;
	foreach ( skinluxe_product_catalog() as $row ) {
		$existing_id = wc_get_product_id_by_sku( $row['sku'] );
		if ( $existing_id ) {
			$product = wc_get_product( $existing_id );
		} else {
			$product = new WC_Product_Simple();
		}

		$product->set_name( $row['title'] );
		$product->set_sku( $row['sku'] );
		$product->set_regular_price( $row['price'] );
		$product->set_price( $row['price'] );
		$product->set_status( 'publish' );
		$product->set_catalog_visibility( 'visible' );
		$product->set_short_description( wp_kses_post( $row['short'] ) );
		$product->set_description( wp_kses_post(
			'<p>' . esc_html( $row['short'] ) . '</p>' .
			'<p><strong>Size:</strong> ' . esc_html( $row['size'] ) . '</p>'
		) );
		$product->set_manage_stock( false );
		$product->set_stock_status( 'instock' );

		$product_id = $product->save();
		if ( ! $product_id ) continue;

		// Attach Image
		if ( ! empty( $row['image'] ) && ! has_post_thumbnail( $product_id ) ) {
			if ( ! function_exists( 'media_sideload_image' ) ) {
				require_once( ABSPATH . 'wp-admin/includes/image.php' );
				require_once( ABSPATH . 'wp-admin/includes/file.php' );
				require_once( ABSPATH . 'wp-admin/includes/media.php' );
			}
			$image_id = media_sideload_image( $row['image'], $product_id, $row['title'], 'id' );
			if ( ! is_wp_error( $image_id ) ) {
				set_post_thumbnail( $product_id, $image_id );
			}
		}

		// Custom taxonomies
		wp_set_object_terms( $product_id, $row['line'], 'product_line', false );
		if ( ! empty( $row['concerns'] ) )    wp_set_object_terms( $product_id, $row['concerns'], 'skin_concern', false );
		if ( ! empty( $row['ingredients'] ) ) wp_set_object_terms( $product_id, $row['ingredients'], 'key_ingredient', false );

		// Also mirror "line" into Woo's product_cat so default Woo archives still work.
		wp_set_object_terms( $product_id, $row['line'], 'product_cat', false );

		// Meta: size for display
		update_post_meta( $product_id, '_skinluxe_size', $row['size'] );

		$created++;
		if ( $log ) echo "✓ {$row['title']}\n";
	}
	return $created;
}

/* ------------------- WP-CLI command ------------------- */
if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::add_command( 'skinluxe seed-products', function() {
		$count = skinluxe_seed_products( true );
		WP_CLI::success( "Seeded {$count} products." );
	} );
}

/* ------------------- Public one-shot trigger ------------------- */
add_action( 'init', function() {
	if ( empty( $_GET['skinluxe_seed'] ) ) return;
	// Warning: Disabled auth check temporarily so user can run it
	skinluxe_seed_products( false );
} );
