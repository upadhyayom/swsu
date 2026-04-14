<?php
/**
 * Header
 * @package SkinLuxe
 */
defined( 'ABSPATH' ) || exit;
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'sl-body' ); ?>>
<?php wp_body_open(); ?>

<a class="sl-skip" href="#content">Skip to content</a>

<header class="sl-header" id="sl-header">
	<div class="sl-container sl-header__inner">
		<a class="sl-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
			<?php if ( has_custom_logo() ) { the_custom_logo(); } else { echo esc_html( get_bloginfo( 'name' ) ); } ?>
		</a>

		<nav class="sl-nav" aria-label="Primary">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'menu_class'     => 'sl-nav__list',
				'fallback_cb'    => function() {
					echo '<ul class="sl-nav__list">';
					echo '<li><a href="' . esc_url( get_term_link( 'face', 'product_line' ) ) . '">Face</a></li>';
					echo '<li><a href="' . esc_url( get_term_link( 'body', 'product_line' ) ) . '">Body</a></li>';
					echo '<li><a href="' . esc_url( get_term_link( 'grooming', 'product_line' ) ) . '">Grooming</a></li>';
					echo '<li><a href="' . esc_url( get_post_type_archive_link( 'product' ) ) . '">Shop All</a></li>';
					echo '</ul>';
				},
			) );
			?>
		</nav>

		<div class="sl-header__actions">
			<a href="<?php echo esc_url( get_search_link() ); ?>" class="sl-icon-btn" aria-label="Search">
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><circle cx="11" cy="11" r="7"/><path d="m20 20-3.5-3.5"/></svg>
			</a>
			<button type="button" class="sl-icon-btn sl-cart-toggle" aria-label="Open cart" data-open-drawer>
				<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M3 6h18l-2 12a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2L3 6z"/><path d="M8 6V4a4 4 0 0 1 8 0v2"/></svg>
				<?php skinluxe_mini_cart_count(); ?>
			</button>
		</div>
	</div>
</header>

<main id="content" class="sl-main">
