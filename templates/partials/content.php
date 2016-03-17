<article <?php post_class(); ?>>
	<header>
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
		<?php get_template_part('partials/entry-meta'); ?>
	</header>

	<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
	<section class="featured-image">
		<a href="<?php the_permalink(); ?>" class="featured-image-link">
			<?php the_post_thumbnail(); ?>
		</a>
	</section>
	<?php } ?>

	<div class="entry-summary">
		<?php if( get_the_excerpt() !== '' ) {
			the_excerpt();
		} else {
			$advanced_excerpt = get_field('advanced_excerpt');

			echo '<p>'.$advanced_excerpt.'</p>';
			?>
			<p><a href="<?php the_permalink(); ?>" class="featured-image-link">
				Continued
			</a></p>
			<?
		}
		?>
	</div>
</article>
