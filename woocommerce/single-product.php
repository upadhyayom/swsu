<?php
/**
 * Single Product Template Override
 *
 * CRO-focused layout:
 *   - Sticky scrolling gallery column
 *   - Clean summary column with trust badges near ATC
 *   - Accordion for Ingredients / How to Use / Benefits
 *   - Sticky "Add to Cart" bar (desktop + mobile)
 *
 * @package SkinLuxe
 */
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>

<?php
/**
 * Hook: woocommerce_before_main_content.
 */
do_action( 'woocommerce_before_main_content' );
?>

<div class="sl-product-wrap">
	<?php while ( have_posts() ) : the_post(); global $product; ?>

	<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'sl-product', $product ); ?>>
		<div class="sl-container sl-product__grid">

			<?php /* ------------------- Gallery column (sticky) ------------------- */ ?>
			<div class="sl-product__gallery">
				<?php
				/**
				 * Use Woo's default gallery hooks so zoom/lightbox/slider theme supports continue to work.
				 */
				do_action( 'woocommerce_before_single_product_summary' );
				?>
			</div>

			<?php /* ------------------- Summary column ------------------- */ ?>
			<div class="summary entry-summary sl-product__summary">

				<p class="sl-product__eyebrow">
					<?php
					$lines = wp_get_post_terms( $product->get_id(), 'product_line', array( 'fields' => 'names' ) );
					if ( ! is_wp_error( $lines ) && ! empty( $lines ) ) {
						echo esc_html( implode( ' · ', $lines ) );
					}
					$size = get_post_meta( $product->get_id(), '_skinluxe_size', true );
					if ( $size ) echo '<span class="sl-dot">·</span>' . esc_html( $size );
					?>
				</p>

				<h1 class="product_title entry-title sl-product__title"><?php the_title(); ?></h1>

				<div class="sl-product__price">
					<?php woocommerce_template_single_price(); ?>
				</div>

				<div class="sl-product__short">
					<?php woocommerce_template_single_excerpt(); ?>
				</div>

				<?php /* ATC (Woo handles form + variations) */ ?>
				<div class="sl-product__atc">
					<?php woocommerce_template_single_add_to_cart(); ?>
				</div>

				<?php /* Trust badges — directly under ATC for CRO */ ?>
				<ul class="sl-trust-badges" aria-label="Product promises">
					<li>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M12 2l3 6 6 1-4.5 4.5L18 20l-6-3-6 3 1.5-6.5L3 9l6-1 3-6z"/></svg>
						<span>Dermatologist Tested</span>
					</li>
					<li>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M20 6 9 17l-5-5"/></svg>
						<span>Cruelty-Free</span>
					</li>
					<li>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 12h18"/><path d="M12 3v18"/></svg>
						<span>Vegan · Fragrance-Free</span>
					</li>
					<li>
						<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect x="3" y="7" width="18" height="13" rx="2"/><path d="M16 7V5a4 4 0 0 0-8 0v2"/></svg>
						<span>Secure Checkout</span>
					</li>
				</ul>

				<?php /* Key ingredients (chips) */ ?>
				<?php
				$ing = wp_get_post_terms( $product->get_id(), 'key_ingredient', array( 'fields' => 'all' ) );
				if ( ! is_wp_error( $ing ) && ! empty( $ing ) ) : ?>
					<div class="sl-ingredient-chips">
						<span class="sl-ingredient-chips__label">Key ingredients</span>
						<?php foreach ( $ing as $term ) : ?>
							<a class="sl-chip" href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
						<?php endforeach; ?>
					</div>
				<?php endif; ?>

				<?php /* Accordion: Ingredients / How to Use / Benefits */ ?>
				<div class="sl-accordion" data-accordion>
					<?php
					$panels = array(
						'benefits'    => array(
							'title'   => 'Benefits',
							'content' => get_post_meta( $product->get_id(), '_skinluxe_benefits', true ) ?: $product->get_short_description(),
						),
						'ingredients' => array(
							'title'   => 'Ingredients',
							'content' => get_post_meta( $product->get_id(), '_skinluxe_ingredients_full', true ) ?: 'Full INCI list available on pack. Free from parabens, sulfates, and synthetic fragrance.',
						),
						'how-to-use'  => array(
							'title'   => 'How to Use',
							'content' => get_post_meta( $product->get_id(), '_skinluxe_how_to_use', true ) ?: 'Apply to clean skin, AM and PM. Follow with moisturizer and SPF in the morning. Always patch-test.',
						),
					);
					foreach ( $panels as $slug => $panel ) : ?>
						<div class="sl-accordion__item" data-accordion-item>
							<button type="button" class="sl-accordion__trigger" aria-expanded="false">
								<span><?php echo esc_html( $panel['title'] ); ?></span>
								<span class="sl-accordion__icon" aria-hidden="true">+</span>
							</button>
							<div class="sl-accordion__panel" hidden>
								<div class="sl-accordion__inner">
									<?php echo wp_kses_post( wpautop( $panel['content'] ) ); ?>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<?php /* Shipping reassurance */ ?>
				<p class="sl-product__ship">Free standard shipping on orders over <?php echo wc_price( 75 ); ?>. 30-day returns.</p>
			</div>
		</div>
	</div>

	<?php /* ------------------- Sticky ATC bar ------------------- */ ?>
	<div class="sl-sticky-atc" id="sl-sticky-atc" aria-hidden="true">
		<div class="sl-container sl-sticky-atc__inner">
			<div class="sl-sticky-atc__info">
				<?php echo $product->get_image( array( 56, 56 ), array( 'class' => 'sl-sticky-atc__thumb' ) ); ?>
				<div class="sl-sticky-atc__meta">
					<span class="sl-sticky-atc__title"><?php echo esc_html( get_the_title() ); ?></span>
					<span class="sl-sticky-atc__price"><?php echo $product->get_price_html(); ?></span>
				</div>
			</div>
			<form class="cart sl-sticky-atc__form" method="post" enctype="multipart/form-data">
				<button type="submit"
					name="add-to-cart"
					value="<?php echo esc_attr( $product->get_id() ); ?>"
					class="single_add_to_cart_button sl-btn sl-btn--primary">
					Add to Bag
				</button>
			</form>
		</div>
	</div>

	<?php /* Related products */ ?>
	<div class="sl-container">
		<?php woocommerce_output_related_products(); ?>
	</div>

	<?php endwhile; // end of the loop. ?>
</div>

<?php
/**
 * Hook: woocommerce_after_main_content.
 */
do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );
