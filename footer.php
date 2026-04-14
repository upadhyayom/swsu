	<footer id="colophon" class="swsu-premium-footer" style="background: var(--swsu-white); border-top: 1px solid var(--swsu-line); padding: 60px 30px; margin-top: 80px; text-align: center;">
		<div style="font-family: var(--font-serif); font-size: 24px; color: var(--swsu-olive); margin-bottom: 20px; letter-spacing: 0.1em; text-transform: uppercase;">
			<?php bloginfo( 'name' ); ?>
		</div>
		<p style="color: var(--swsu-muted); font-size: 14px; max-width: 400px; margin: 0 auto 30px;">
			Ayurvedic precision meets clinical actives for flawless skin. Made in India.
		</p>
		<div class="swsu-footer-nav" style="display: flex; justify-content: center; gap: 30px; font-size: 12px; letter-spacing: 0.1em; text-transform: uppercase;">
			<a href="<?php echo esc_url( home_url( '/privacy-policy/' ) ); ?>">Privacy Policy</a>
			<a href="<?php echo esc_url( home_url( '/terms-of-service/' ) ); ?>">Terms of Service</a>
			<a href="<?php echo esc_url( home_url( '/shipping-returns/' ) ); ?>">Shipping & Returns</a>
			<a href="<?php echo esc_url( home_url( '/contact/' ) ); ?>">Contact</a>
		</div>
		<div style="margin-top: 40px; font-size: 11px; color: var(--swsu-muted); letter-spacing: 0.05em;">
			&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>. All rights reserved.
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
