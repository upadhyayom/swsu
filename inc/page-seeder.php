<?php
/**
 * Page Seeder
 *
 * Programmatically inserts essential premium store pages if they don't exist.
 * Integrates with WooCommerce seeder on ?skinluxe_seed=1
 *
 * @package SkinLuxe
 */

defined( 'ABSPATH' ) || exit;

function skinluxe_seed_core_pages() {
	$pages = array(
		'About Us' => array(
			'content' => '
<!-- wp:group {"layout":{"type":"constrained"}} -->
<div class="wp-block-group">
<!-- wp:heading {"textAlign":"center","level":1} -->
<h1 class="wp-block-heading has-text-align-center">Our Philosophy</h1>
<!-- /wp:heading -->
<!-- wp:paragraph {"align":"center"} -->
<p class="has-text-align-center">We believe that luxury skincare should be clean, clinical, and completely transparent. Born from a desire to strip away the complex layers of modern beauty routines, SkinLuxe delivers potent, active-driven formulations housed in minimalist packaging. Less clutter, more efficacy.</p>
<!-- /wp:paragraph -->
<!-- wp:spacer {"height":"32px"} -->
<div style="height:32px" aria-hidden="true" class="wp-block-spacer"></div>
<!-- /wp:spacer -->
<!-- wp:columns -->
<div class="wp-block-columns">
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Cruelty-Free</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">We never have and never will test on animals.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
<!-- wp:column -->
<div class="wp-block-column">
<!-- wp:heading {"level":3} -->
<h3 class="wp-block-heading">Clinical Grade</h3>
<!-- /wp:heading -->
<!-- wp:paragraph {"fontSize":"small"} -->
<p class="has-small-font-size">Formulated by aesthetic experts using proven active ingredients.</p>
<!-- /wp:paragraph -->
</div>
<!-- /wp:column -->
</div>
<!-- /wp:columns -->
</div>
<!-- /wp:group -->',
			'slug' => 'about-us'
		),
		'Shipping & Returns' => array(
			'content' => '
<!-- wp:heading -->
<h2 class="wp-block-heading">Shipping Policy</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>We process all orders within 24 hours. Enjoy complimentary standard shipping on all orders over $50. Expedited 2-day shipping is available at checkout for $15.</p>
<!-- /wp:paragraph -->
<!-- wp:heading -->
<h2 class="wp-block-heading">The SkinLuxe Guarantee (Returns)</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Skincare is a personal journey. If you do not see visible improvements within 30 days of receiving your product, simply reach out to our concierge team at support@example.com for a full, no-questions-asked refund. We even cover the return shipping.</p>
<!-- /wp:paragraph -->',
			'slug' => 'shipping-returns'
		),
		'Contact' => array(
			'content' => '
<!-- wp:heading -->
<h2 class="wp-block-heading">Get in Touch</h2>
<!-- /wp:heading -->
<!-- wp:paragraph -->
<p>Our skincare concierge is available Monday through Friday, 9am to 6pm EST.</p>
<!-- /wp:paragraph -->
<!-- wp:list -->
<ul class="wp-block-list"><li>Email: support@example.com</li><li>Phone: +1 (800) 555-0199</li></ul>
<!-- /wp:list -->
<!-- wp:paragraph -->
<p><em>For wholesale inquiries, please email wholesale@example.com.</em></p>
<!-- /wp:paragraph -->',
			'slug' => 'contact'
		),
		'Privacy Policy' => array(
			'content' => '<!-- wp:paragraph --><p>Your privacy is important to us. We securely encrypt all payment data and never sell your personal information to third parties.</p><!-- /wp:paragraph -->',
			'slug' => 'privacy-policy'
		),
		'Terms of Service' => array(
			'content' => '<!-- wp:paragraph --><p>By accessing our website, you agree to these terms of service. Prices and products are subject to change without notice.</p><!-- /wp:paragraph -->',
			'slug' => 'terms-of-service'
		)
	);

	foreach ( $pages as $title => $data ) {
		$page_check = get_page_by_path( $data['slug'] );
		if ( ! isset( $page_check->ID ) ) {
			wp_insert_post( array(
				'post_title'   => wp_strip_all_tags( $title ),
				'post_content' => $data['content'],
				'post_status'  => 'publish',
				'post_type'    => 'page',
				'post_name'    => $data['slug'],
			) );
		}
	}
}
add_action( 'admin_init', function() {
	if ( isset( $_GET['skinluxe_seed'] ) && current_user_can( 'manage_woocommerce' ) ) {
		skinluxe_seed_core_pages();
	}
} );
