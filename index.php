<?php
/**
 * Fallback index
 * @package SkinLuxe
 */
defined( 'ABSPATH' ) || exit;
get_header(); ?>

<section class="sl-section">
	<div class="sl-container">
		<?php if ( have_posts() ) : ?>
			<div class="sl-post-list">
				<?php while ( have_posts() ) : the_post(); ?>
					<article class="sl-post-card">
						<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
						<div class="sl-post-card__excerpt"><?php the_excerpt(); ?></div>
					</article>
				<?php endwhile; ?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<p>Nothing here yet.</p>
		<?php endif; ?>
	</div>
</section>

<?php get_footer();
