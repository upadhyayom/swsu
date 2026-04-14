<?php
/**
 * The main template file
 * Required for Elementor compatibility.
 */
get_header();

if ( is_singular() ) {
	if ( ! post_password_required() ) {
		// Elementor takes full control of the main content execution
		the_content();
	} else {
		echo get_the_password_form();
	}
} else {
	// Fallback for archives/blogs
	if ( have_posts() ) {
		echo '<main class="swsu-elementor-main" style="padding: 100px 20px; max-width: 1200px; margin: 0 auto;">';
		while ( have_posts() ) {
			the_post();
			echo '<article id="post-' . get_the_ID() . '" ' . get_post_class() . ' style="margin-bottom: 40px;">';
			echo '<h2 style="font-family: var(--font-serif);"><a href="' . esc_url( get_permalink() ) . '">' . get_the_title() . '</a></h2>';
			the_excerpt();
			echo '</article>';
		}
		echo '</main>';
	} else {
		echo '<main class="swsu-elementor-main" style="padding: 100px 20px; text-align:center;"><h2>No content found.</h2></main>';
	}
}

get_footer();
