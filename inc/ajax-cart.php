<?php
/**
 * AJAX Slide-Out Cart Drawer
 *
 * Endpoints:
 *   - skinluxe_get_drawer   (GET/POST) — returns rendered drawer HTML + meta
 *   - skinluxe_update_qty   (POST)     — update a line's qty
 *   - skinluxe_remove_item  (POST)     — remove a line
 *
 * @package SkinLuxe
 */

defined( 'ABSPATH' ) || exit;

function skinluxe_free_shipping_threshold() {
	return (float) apply_filters( 'skinluxe_free_shipping_min', 75 );
}

/**
 * Render mini-cart drawer contents (re-used by AJAX + fragments).
 */
function skinluxe_mini_cart_drawer_contents() {
	if ( ! function_exists( 'skinluxe_wc_cart_ready' ) || ! skinluxe_wc_cart_ready() ) {
		echo '<div class="skinluxe-drawer-contents"></div>';
		return;
	}

	$cart      = WC()->cart;
	$subtotal  = (float) $cart->get_subtotal();
	$threshold = skinluxe_free_shipping_threshold();
	$progress  = $threshold > 0 ? min( 100, ( $subtotal / $threshold ) * 100 ) : 100;
	$remaining = max( 0, $threshold - $subtotal );
	?>
	<div class="skinluxe-drawer-contents">

		<div class="sl-drawer__shipbar" data-progress="<?php echo esc_attr( $progress ); ?>">
			<?php if ( $remaining > 0 ) : ?>
				<p class="sl-drawer__shipbar-label">
					Add <strong><?php echo wc_price( $remaining ); ?></strong> for <strong>free shipping</strong>.
				</p>
			<?php else : ?>
				<p class="sl-drawer__shipbar-label sl-drawer__shipbar-label--hit">
					You've unlocked <strong>free shipping</strong>.
				</p>
			<?php endif; ?>
			<div class="sl-drawer__shipbar-track">
				<span class="sl-drawer__shipbar-fill" style="width: <?php echo esc_attr( $progress ); ?>%;"></span>
			</div>
		</div>

		<?php if ( $cart->is_empty() ) : ?>
			<div class="sl-drawer__empty">
				<p>Your cart is empty.</p>
				<a href="<?php echo esc_url( wc_get_page_permalink( 'shop' ) ); ?>" class="sl-btn sl-btn--outline">Continue shopping</a>
			</div>
		<?php else : ?>
			<ul class="sl-drawer__items">
				<?php foreach ( $cart->get_cart() as $cart_key => $cart_item ) :
					$product   = $cart_item['data'];
					if ( ! $product || ! $product->exists() || $cart_item['quantity'] <= 0 ) continue;
					$thumb_id  = $product->get_image_id();
					$thumb_src = $thumb_id ? wp_get_attachment_image_url( $thumb_id, 'woocommerce_thumbnail' ) : wc_placeholder_img_src();
					$permalink = apply_filters( 'woocommerce_cart_item_permalink', $product->is_visible() ? $product->get_permalink( $cart_item ) : '', $cart_item, $cart_key );
				?>
					<li class="sl-drawer__item" data-key="<?php echo esc_attr( $cart_key ); ?>">
						<a class="sl-drawer__thumb" href="<?php echo esc_url( $permalink ); ?>">
							<img src="<?php echo esc_url( $thumb_src ); ?>" alt="<?php echo esc_attr( $product->get_name() ); ?>">
						</a>
						<div class="sl-drawer__meta">
							<a class="sl-drawer__title" href="<?php echo esc_url( $permalink ); ?>">
								<?php echo esc_html( $product->get_name() ); ?>
							</a>
							<div class="sl-drawer__price"><?php echo wc_price( $product->get_price() ); ?></div>
							<div class="sl-drawer__qty">
								<button type="button" class="sl-qty-dec" aria-label="Decrease">&minus;</button>
								<input type="number" min="0" value="<?php echo esc_attr( $cart_item['quantity'] ); ?>" class="sl-qty-input" aria-label="Quantity">
								<button type="button" class="sl-qty-inc" aria-label="Increase">+</button>
								<button type="button" class="sl-drawer__remove" aria-label="Remove">Remove</button>
							</div>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>

			<div class="sl-drawer__footer">
				<div class="sl-drawer__subtotal">
					<span>Subtotal</span>
					<strong><?php echo wc_price( $subtotal ); ?></strong>
				</div>
				<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="sl-btn sl-btn--primary sl-drawer__checkout">
					Checkout
				</a>
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="sl-drawer__viewcart">View cart</a>
			</div>
		<?php endif; ?>

	</div>
	<?php
}

/* ------------------- AJAX: get drawer ------------------- */
add_action( 'wp_ajax_skinluxe_get_drawer',        'skinluxe_ajax_get_drawer' );
add_action( 'wp_ajax_nopriv_skinluxe_get_drawer', 'skinluxe_ajax_get_drawer' );
function skinluxe_ajax_get_drawer() {
	check_ajax_referer( 'skinluxe_nonce', 'nonce' );
	ob_start();
	skinluxe_mini_cart_drawer_contents();
	$html = ob_get_clean();

	wp_send_json_success( array(
		'html'  => $html,
		'count' => WC()->cart ? WC()->cart->get_cart_contents_count() : 0,
	) );
}

/* ------------------- AJAX: update qty ------------------- */
add_action( 'wp_ajax_skinluxe_update_qty',        'skinluxe_ajax_update_qty' );
add_action( 'wp_ajax_nopriv_skinluxe_update_qty', 'skinluxe_ajax_update_qty' );
function skinluxe_ajax_update_qty() {
	check_ajax_referer( 'skinluxe_nonce', 'nonce' );
	$key = isset( $_POST['cart_key'] ) ? sanitize_text_field( wp_unslash( $_POST['cart_key'] ) ) : '';
	$qty = isset( $_POST['qty'] )      ? max( 0, (int) $_POST['qty'] )                          : 0;
	if ( ! $key ) wp_send_json_error( array( 'message' => 'Missing key' ) );

	if ( $qty <= 0 ) {
		WC()->cart->remove_cart_item( $key );
	} else {
		WC()->cart->set_quantity( $key, $qty, true );
	}

	ob_start();
	skinluxe_mini_cart_drawer_contents();
	wp_send_json_success( array(
		'html'  => ob_get_clean(),
		'count' => WC()->cart->get_cart_contents_count(),
	) );
}

/* ------------------- AJAX: remove item ------------------- */
add_action( 'wp_ajax_skinluxe_remove_item',        'skinluxe_ajax_remove_item' );
add_action( 'wp_ajax_nopriv_skinluxe_remove_item', 'skinluxe_ajax_remove_item' );
function skinluxe_ajax_remove_item() {
	check_ajax_referer( 'skinluxe_nonce', 'nonce' );
	$key = isset( $_POST['cart_key'] ) ? sanitize_text_field( wp_unslash( $_POST['cart_key'] ) ) : '';
	if ( $key ) WC()->cart->remove_cart_item( $key );

	ob_start();
	skinluxe_mini_cart_drawer_contents();
	wp_send_json_success( array(
		'html'  => ob_get_clean(),
		'count' => WC()->cart->get_cart_contents_count(),
	) );
}

/**
 * Output the drawer shell in the footer (populated on demand).
 */
function skinluxe_render_drawer_shell() {
	?>
	<div class="sl-drawer" id="sl-drawer" aria-hidden="true" role="dialog" aria-label="Cart">
		<div class="sl-drawer__backdrop" data-close-drawer></div>
		<aside class="sl-drawer__panel" tabindex="-1">
			<header class="sl-drawer__header">
				<h2 class="sl-drawer__heading">Your Cart</h2>
				<button type="button" class="sl-drawer__close" aria-label="Close cart" data-close-drawer>&times;</button>
			</header>
			<div class="sl-drawer__body">
				<?php skinluxe_mini_cart_drawer_contents(); ?>
			</div>
		</aside>
	</div>
	<?php
}
add_action( 'wp_footer', 'skinluxe_render_drawer_shell', 5 );
