<?php
/**
 * Footer
 * @package SkinLuxe
 */
defined( 'ABSPATH' ) || exit;
?>
</main>

<footer class="sl-footer">
	<div class="sl-container sl-footer__grid">
		<div class="sl-footer__brand">
			<h3 class="sl-footer__logo"><?php bloginfo( 'name' ); ?></h3>
			<p class="sl-footer__tag">Clean, clinical, considered skincare.</p>
		</div>
		<div class="sl-footer__col">
			<h4>Shop</h4>
			<ul>
				<li><a href="<?php echo esc_url( get_term_link( 'face', 'product_line' ) ); ?>">Face</a></li>
				<li><a href="<?php echo esc_url( get_term_link( 'body', 'product_line' ) ); ?>">Body</a></li>
				<li><a href="<?php echo esc_url( get_term_link( 'grooming', 'product_line' ) ); ?>">Grooming</a></li>
			</ul>
		</div>
		<div class="sl-footer__col">
			<h4>Help</h4>
			<ul>
				<li><a href="<?php echo esc_url( home_url( '/shipping-returns/' ) ); ?>">Shipping & Returns</a></li>
				<li><a href="<?php echo esc_url( home_url( '/about-us/' ) ); ?>">Our Philosophy</a></li>
				<li><a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a></li>
			</ul>
		</div>
		<div class="sl-footer__col">
			<h4>Newsletter</h4>
			<form class="sl-newsletter">
				<input type="email" placeholder="Your email" aria-label="Email">
				<button type="submit">Subscribe</button>
			</form>
		</div>
	</div>
	<div class="sl-footer__legal sl-container">
		<small>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.</small>
		<div class="sl-footer__legal-links">
			<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
			<a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>">Terms of Service</a>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
