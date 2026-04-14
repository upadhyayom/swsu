<?php
/**
 * Archive Product — clean, editorial grid.
 * @package SkinLuxe
 */
defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

do_action( 'woocommerce_before_main_content' );
?>

<section class="sl-section sl-archive">
	<div class="sl-container">

		<header class="sl-archive__head">
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
				<h1 class="sl-archive__title"><?php woocommerce_page_title(); ?></h1>
			<?php endif; ?>
			<?php do_action( 'woocommerce_archive_description' ); ?>
		</header>

		<div class="sl-archive__toolbar">
			<?php do_action( 'woocommerce_before_shop_loop' ); ?>
		</div>

		<?php if ( woocommerce_product_loop() ) : ?>
			<div class="sl-product-grid">
				<?php
				woocommerce_product_loop_start( false );
				if ( wc_get_loop_prop( 'total' ) ) {
					while ( have_posts() ) {
						the_post();
						wc_get_template_part( 'content', 'product' );
					}
				}
				woocommerce_product_loop_end( false );
				?>
			</div>
			<?php do_action( 'woocommerce_after_shop_loop' ); ?>
		<?php else : ?>
			<?php do_action( 'woocommerce_no_products_found' ); ?>
		<?php endif; ?>

	</div>
</section>

<?php
do_action( 'woocommerce_after_main_content' );
get_footer( 'shop' );
