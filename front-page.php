<?php
/**
 * Front Page Template
 *
 * Sections:
 *   1. Hero (full-screen typography + CTA)
 *   2. Shop by Concern (image grid -> skin_concern taxonomy archives)
 *   3. Shop by Ingredient (minimalist carousel -> key_ingredient archives)
 *   4. Bestsellers slider
 *
 * @package SkinLuxe
 */
defined( 'ABSPATH' ) || exit;
get_header(); ?>

<?php /* ------------------- 1. HERO ------------------- */ ?>
<section class="sl-hero" role="banner">
	<div class="sl-hero__media">
		<?php
		$hero_img = get_theme_mod( 'skinluxe_hero_image', 'https://images.unsplash.com/photo-1596462502278-27bf85033e5a?ixlib=rb-4.0.3&auto=format&fit=crop&w=2000&q=80' );
		if ( $hero_img ) : ?>
			<img src="<?php echo esc_url( $hero_img ); ?>" alt="">
		<?php else : ?>
			<div class="sl-hero__gradient" aria-hidden="true"></div>
		<?php endif; ?>
		<div class="sl-hero__gradient" style="opacity: 0.3;" aria-hidden="true"></div>
	</div>

	<div class="sl-hero__content sl-container">
		<p class="sl-hero__eyebrow" data-reveal>New Season&nbsp;&mdash;&nbsp;SS26</p>
		<h1 class="sl-hero__title" data-reveal>
			Skin, refined.<br>
			<em>Quietly radiant.</em>
		</h1>
		<p class="sl-hero__sub" data-reveal>
			Clinical-grade actives. Minimal, measured formulations.
			Nothing loud. Nothing wasted.
		</p>
		<div class="sl-hero__cta" data-reveal>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>" class="sl-btn sl-btn--primary">Shop Now</a>
			<a href="#shop-by-concern" class="sl-btn sl-btn--ghost">Explore Concerns</a>
		</div>
	</div>
</section>

<?php /* ------------------- 2. SHOP BY CONCERN ------------------- */ ?>
<section id="shop-by-concern" class="sl-section">
	<div class="sl-container">
		<header class="sl-section__head">
			<p class="sl-section__eyebrow">Targeted care</p>
			<h2 class="sl-section__title">Shop by Concern</h2>
		</header>

		<div class="sl-concern-grid">
			<?php
			$concerns = skinluxe_get_terms_with_images( 'skin_concern', 6 );
			foreach ( $concerns as $term ) :
				$image_id  = (int) get_term_meta( $term->term_id, 'image_id', true );
				$image_src = $image_id ? wp_get_attachment_image_url( $image_id, 'large' ) : '';
				$link      = get_term_link( $term );
			?>
				<a class="sl-concern-card" href="<?php echo esc_url( $link ); ?>" data-reveal>
					<div class="sl-concern-card__media">
						<?php if ( $image_src ) : ?>
							<img src="<?php echo esc_url( $image_src ); ?>" alt="<?php echo esc_attr( $term->name ); ?>">
						<?php else : 
							// Default final images based on slug
							$slug_img = array(
								'acne' => 'https://images.unsplash.com/photo-1615397323719-20fbd589f38f?auto=format&fit=crop&w=400&q=80',
								'aging' => 'https://images.unsplash.com/photo-1608248543803-ba4f8c70ae0b?auto=format&fit=crop&w=400&q=80',
								'dark-spots' => 'https://images.unsplash.com/photo-1599305090598-fe179d501227?auto=format&fit=crop&w=400&q=80',
								'pigmentation' => 'https://images.unsplash.com/photo-1620916566398-39f1143ab7be?auto=format&fit=crop&w=400&q=80',
								'dryness' => 'https://images.unsplash.com/photo-1555820598-c801c13d7899?auto=format&fit=crop&w=400&q=80'
							);
							$img_bg = isset($slug_img[$term->slug]) ? $slug_img[$term->slug] : 'https://images.unsplash.com/photo-1617897903246-719242758050?auto=format&fit=crop&w=400&q=80';
						?>
							<img src="<?php echo esc_url($img_bg); ?>" alt="<?php echo esc_attr( $term->name ); ?>">
						<?php endif; ?>
					</div>
					<div class="sl-concern-card__body">
						<h3><?php echo esc_html( $term->name ); ?></h3>
						<span class="sl-concern-card__more">Explore &rarr;</span>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<?php /* ------------------- 3. SHOP BY INGREDIENT ------------------- */ ?>
<section class="sl-section sl-section--alt">
	<div class="sl-container">
		<header class="sl-section__head sl-section__head--row">
			<div>
				<p class="sl-section__eyebrow">Clean actives</p>
				<h2 class="sl-section__title">Shop by Ingredient</h2>
			</div>
			<div class="sl-carousel__controls" aria-hidden="true">
				<button type="button" class="sl-carousel__prev" aria-label="Previous">&larr;</button>
				<button type="button" class="sl-carousel__next" aria-label="Next">&rarr;</button>
			</div>
		</header>

		<div class="sl-ingredient-carousel" data-carousel>
			<div class="sl-ingredient-carousel__track">
				<?php
				$ingredients = skinluxe_get_terms_with_images( 'key_ingredient', 10 );
				foreach ( $ingredients as $term ) :
					$link = get_term_link( $term );
				?>
					<a class="sl-ingredient-card" href="<?php echo esc_url( $link ); ?>" data-reveal>
						<span class="sl-ingredient-card__mark" aria-hidden="true">
							<?php echo esc_html( strtoupper( mb_substr( $term->name, 0, 1 ) ) ); ?>
						</span>
						<h3 class="sl-ingredient-card__name"><?php echo esc_html( $term->name ); ?></h3>
						<span class="sl-ingredient-card__count"><?php echo intval( $term->count ); ?> products</span>
					</a>
				<?php endforeach; ?>
			</div>
		</div>
	</div>
</section>

<?php /* ------------------- 4. BESTSELLERS SLIDER ------------------- */ ?>
<section class="sl-section">
	<div class="sl-container">
		<header class="sl-section__head sl-section__head--row">
			<div>
				<p class="sl-section__eyebrow">Loved by many</p>
				<h2 class="sl-section__title">Bestsellers</h2>
			</div>
			<a href="<?php echo esc_url( get_post_type_archive_link( 'product' ) ); ?>" class="sl-link">View all</a>
		</header>

		<div class="sl-bestsellers" data-carousel>
			<div class="sl-bestsellers__track">
				<?php
				$bs = new WP_Query( array(
					'post_type'      => 'product',
					'posts_per_page' => 8,
					'meta_key'       => 'total_sales',
					'orderby'        => 'meta_value_num',
					'order'          => 'DESC',
					'no_found_rows'  => true,
				) );
				if ( $bs->have_posts() ) :
					while ( $bs->have_posts() ) : $bs->the_post();
						$product = wc_get_product( get_the_ID() );
						if ( ! $product ) continue;
				?>
					<article class="sl-product-card" data-reveal>
						<a class="sl-product-card__media" href="<?php the_permalink(); ?>">
							<?php echo $product->get_image( 'woocommerce_thumbnail' ); ?>
						</a>
						<div class="sl-product-card__body">
							<h3 class="sl-product-card__title">
								<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
							</h3>
							<div class="sl-product-card__price"><?php echo $product->get_price_html(); ?></div>
							<a href="?add-to-cart=<?php echo esc_attr( $product->get_id() ); ?>"
								class="sl-btn sl-btn--outline sl-ajax-add"
								data-product-id="<?php echo esc_attr( $product->get_id() ); ?>"
								rel="nofollow">
								Add to bag
							</a>
						</div>
					</article>
				<?php
					endwhile;
					wp_reset_postdata();
				endif;
				?>
			</div>
		</div>
	</div>
</section>

<?php /* ------------------- PROMISE BAR ------------------- */ ?>
<section class="sl-promise">
	<div class="sl-container sl-promise__grid">
		<div><span>—</span><p>Dermatologist Tested</p></div>
		<div><span>—</span><p>Cruelty Free</p></div>
		<div><span>—</span><p>Free Shipping over $75</p></div>
		<div><span>—</span><p>Clean Actives, No Fillers</p></div>
	</div>
</section>

<?php get_footer();
