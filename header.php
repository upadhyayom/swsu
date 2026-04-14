<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
	<style>
		.swsu-premium-header {
			background: rgba(250, 249, 247, 0.95);
			backdrop-filter: blur(10px);
			-webkit-backdrop-filter: blur(10px);
			position: sticky;
			top: 0;
			z-index: 999;
			padding: 15px 30px;
			display: flex;
			align-items: center;
			justify-content: space-between;
			border-bottom: 1px solid var(--swsu-line);
		}
		.swsu-logo {
			font-family: var(--font-serif);
			font-size: 28px;
			letter-spacing: 0.15em;
			text-transform: uppercase;
			color: var(--swsu-olive-dark);
			font-weight: 500;
		}
		.swsu-nav ul {
			list-style: none;
			margin: 0;
			padding: 0;
			display: flex;
			gap: 30px;
		}
		.swsu-nav a {
			font-size: 13px;
			letter-spacing: 0.1em;
			text-transform: uppercase;
			color: var(--swsu-ink);
			transition: color 0.3s ease;
		}
		.swsu-nav a:hover {
			color: var(--swsu-olive);
		}
		@media (max-width: 768px) {
			.swsu-nav { display: none; }
		}
	</style>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">

	<header id="masthead" class="swsu-premium-header">
		<div class="swsu-logo">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="swsu-nav">
			<?php
			if ( has_nav_menu( 'menu-1' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'menu-1',
						'menu_id'        => 'primary-menu',
						'container'      => false,
					)
				);
			} else {
				// Fallback generic premium links
				echo '<ul>';
				echo '<li><a href="' . esc_url( home_url( '/shop/' ) ) . '">Shop Collection</a></li>';
				echo '<li><a href="' . esc_url( home_url( '/about-us/' ) ) . '">Our Science</a></li>';
				echo '</ul>';
			}
			?>
		</nav><!-- #site-navigation -->
		
		<div class="swsu-cart-icon">
			<?php if ( class_exists( 'WooCommerce' ) ) : ?>
				<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" title="<?php _e( 'View your shopping cart' ); ?>" style="font-size:13px; text-transform:uppercase; letter-spacing:0.1em;">
					Cart (<?php echo WC()->cart->get_cart_contents_count(); ?>)
				</a>
			<?php else: ?>
				<a href="#" style="font-size:13px; text-transform:uppercase; letter-spacing:0.1em;">Account</a>
			<?php endif; ?>
		</div>
	</header><!-- #masthead -->
