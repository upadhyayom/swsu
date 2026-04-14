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
			'sku'          => 'SLX-FW-VCHA-100',
			'price'        => 24.00,
			'size'         => '100ml',
			'short'        => 'Brightening daily cleanser with Vitamin C and Hyaluronic Acid.',
			'line'         => 'Face',
			'concerns'     => array( 'Dark Spots', 'Dryness' ),
			'ingredients'  => array( 'Vitamin C', 'Hyaluronic Acid' ),
			'image'        => 'https://images.unsplash.com/photo-1615397323719-20fbd589f38f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => '2% Salicylic & Rice Water Face Wash - 100ml',
			'sku'          => 'SLX-FW-SARW-100',
			'price'        => 22.00,
			'size'         => '100ml',
			'short'        => 'Clarifying cleanser for oily & acne-prone skin.',
			'line'         => 'Face',
			'concerns'     => array( 'Acne' ),
			'ingredients'  => array( 'Salicylic Acid', 'Rice Water' ),
			'image'        => 'https://images.unsplash.com/photo-1556228578-0d85b1a4d571?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => '15% Vitamin C Face Serum with Alpha Arbutin & Niacinamide - 30ml',
			'sku'          => 'SLX-SR-VC15-30',
			'price'        => 42.00,
			'size'         => '30ml',
			'short'        => 'High-potency brightening serum for an even, radiant tone.',
			'line'         => 'Face',
			'concerns'     => array( 'Dark Spots', 'Pigmentation' ),
			'ingredients'  => array( 'Vitamin C', 'Alpha Arbutin', 'Niacinamide' ),
			'image'        => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Anti-Aging & Age-Defying Face Serum — Fine Lines & Wrinkle Corrector - 30ml',
			'sku'          => 'SLX-SR-AGE-30',
			'price'        => 48.00,
			'size'         => '30ml',
			'short'        => 'Firming, smoothing treatment for visible signs of aging.',
			'line'         => 'Face',
			'concerns'     => array( 'Aging' ),
			'ingredients'  => array( 'Niacinamide', 'Hyaluronic Acid' ),
			'image'        => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Acne, Scar & Dark Spot Corrector Face Serum with Salicylic & Azelaic - 30ml',
			'sku'          => 'SLX-SR-ACNE-30',
			'price'        => 38.00,
			'size'         => '30ml',
			'short'        => 'Targeted spot & scar corrector for blemish-prone skin.',
			'line'         => 'Face',
			'concerns'     => array( 'Acne', 'Dark Spots' ),
			'ingredients'  => array( 'Salicylic Acid', 'Azelaic Acid' ),
			'image'        => 'https://images.unsplash.com/photo-1599305090598-fe179d501227?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Face Mist Toner with Niacinamide & Hyaluronic - 100ml',
			'sku'          => 'SLX-TN-NIHA-100',
			'price'        => 20.00,
			'size'         => '100ml',
			'short'        => 'Hydrating mist for a balanced, glass-skin finish.',
			'line'         => 'Face',
			'concerns'     => array( 'Dryness', 'Pigmentation' ),
			'ingredients'  => array( 'Niacinamide', 'Hyaluronic Acid' ),
			'image'        => 'https://images.unsplash.com/photo-1570554886111-e80fcca6a029?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Face Moisturizer with SPF - 100ml',
			'sku'          => 'SLX-MO-SPF-100',
			'price'        => 32.00,
			'size'         => '100ml',
			'short'        => 'Lightweight daily moisturizer with broad-spectrum SPF.',
			'line'         => 'Face',
			'concerns'     => array( 'Aging', 'Pigmentation', 'Dryness' ),
			'ingredients'  => array( 'Niacinamide', 'Hyaluronic Acid' ),
			'image'        => 'https://images.unsplash.com/photo-1555820598-c801c13d7899?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Charcoal Face Pack - 100g',
			'sku'          => 'SLX-MK-CHAR-100',
			'price'        => 18.00,
			'size'         => '100g',
			'short'        => 'Detoxifying weekly mask for a clear, refined complexion.',
			'line'         => 'Face',
			'concerns'     => array( 'Acne' ),
			'ingredients'  => array( 'Salicylic Acid' ),
			'image'        => 'https://images.unsplash.com/photo-1601049541289-9b1b7bbbfe19?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Face Scrub - 100g',
			'sku'          => 'SLX-EX-FACE-100',
			'price'        => 19.00,
			'size'         => '100g',
			'short'        => 'Gentle exfoliant for smooth, polished skin.',
			'line'         => 'Face',
			'concerns'     => array( 'Dark Spots', 'Dryness' ),
			'ingredients'  => array( 'Salicylic Acid' ),
			'image'        => 'https://images.unsplash.com/photo-1615397323984-dc3b99db2769?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => '1% Kojic, Alpha Arbutin, 2% Niacinamide Body Wash - 200ml',
			'sku'          => 'SLX-BW-KOJI-200',
			'price'        => 26.00,
			'size'         => '200ml',
			'short'        => 'Brightening body wash for even skin tone, head to toe.',
			'line'         => 'Body',
			'concerns'     => array( 'Pigmentation', 'Dark Spots' ),
			'ingredients'  => array( 'Kojic Acid', 'Alpha Arbutin', 'Niacinamide' ),
			'image'        => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Beard Growth Oil - 30ml',
			'sku'          => 'SLX-GR-BEARD-30',
			'price'        => 28.00,
			'size'         => '30ml',
			'short'        => 'Conditioning oil for a fuller, softer beard.',
			'line'         => 'Grooming',
			'concerns'     => array( 'Dryness' ),
			'ingredients'  => array(),
			'image'        => 'https://images.unsplash.com/photo-1629198688000-71f23e745b6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Luxury Night Repair Cream with Retinol - 50g',
			'sku'          => 'SLX-CR-RET-50',
			'price'        => 65.00,
			'size'         => '50g',
			'short'        => 'An intensive overnight repair cream that visibly plumps and smooths.',
			'line'         => 'Face',
			'concerns'     => array( 'Aging', 'Dryness' ),
			'ingredients'  => array( 'Retinol', 'Peptides' ),
			'image'        => 'https://images.unsplash.com/photo-1596462502278-27bf85033e5a?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
		),
		array(
			'title'        => 'Antioxidant Hand Cream - 50g',
			'sku'          => 'SLX-HC-ANT-50',
			'price'        => 30.00,
			'size'         => '50g',
			'short'        => 'Nourishing botanical cream that restores hands instantly.',
			'line'         => 'Body',
			'concerns'     => array( 'Dryness' ),
			'ingredients'  => array( 'Vitamin C', 'Shea Butter' ),
			'image'        => 'https://images.unsplash.com/photo-1617897903246-719242758050?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80',
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

/* ------------------- Admin one-shot trigger ------------------- */
add_action( 'admin_init', function() {
	if ( empty( $_GET['skinluxe_seed'] ) ) return;
	if ( ! current_user_can( 'manage_woocommerce' ) ) return;
	$count = skinluxe_seed_products( false );
	add_action( 'admin_notices', function() use ( $count ) {
		echo '<div class="notice notice-success"><p>SkinLuxe: seeded ' . intval( $count ) . ' products.</p></div>';
	} );
} );
