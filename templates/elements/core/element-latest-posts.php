<?php
/* ==========================================================================
	Latest Post
   ========================================================================== */

   $randomString = App\generateRandomString();
   if ( get_sub_field ('animate_elements') ) {
		$animateElementsClass 	= 'animate-elements';
		$animateElements 		= 'data-animate="true" ';
		$animateElement1 		= 'data-animation-type="'. get_sub_field("section_animation_1") . '"';
	}
?>
<div class="latest-posts col-md-12 <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>">
	<?php
	if( get_row_layout() == 'latest_posts' ) {
		$category 				= get_sub_field('category');
		$numberOfPosts			= get_sub_field('number_of_posts_to_display');
		$orderBy				= get_sub_field('order_by'); // date, author etc
		$orderIn				= get_sub_field('order_in'); // DESC or ASC
		$layout 				= get_sub_field('how_many_posts_per_row'); // Column Numers


		if ( $layout 			== 1 ) {

			$columnCoumnt 		= 'col-md-12';

		} elseif ( $layout 		== 2 ) {

			$columnCoumnt 		= 'col-md-6';

		} elseif ( $layout 		== 3 ) {

			$columnCoumnt 		= 'col-md-4';

		} else {

			$columnCoumnt 		= 'col-md-3';

		}
	}
	?>

	<div class="row">
		<?php
			// Setting defaults
			if ( !$categoryID ) {
				$categoryID 	= '1';
			}

			if ( $numberOfPosts == '3' ) {
				$numberOfPosts 	= '3';
			}
/*
			echo 'Cat ID = '.$categoryID. '<br/>';
			echo 'No Posts = '.$numberOfPosts. '<br/>';
			echo 'Order by = '.$orderBy. '<br/>';
			echo 'Order in = '.$orderIn. '<br/>';
			echo 'Layout = '.$layout. '<br/>';
			echo 'Column Count = '.$columnCoumnt. '<br/>';
*/
			query_posts('cat='.$categoryID.'&showposts='.$numberOfPosts.'&orderby='.$orderBy.'&order='.$orderIn.''); // show me the latest post from this cat
			while (have_posts()) : the_post();
		?>
		<article class="col-xs-12 <?=$columnCoumnt;?>" <?= $animateElements.$animateElement1; ?>>
			<header>
				<h2 class="entry-title">
					<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
				</h2>
			</header>

			<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>
			<section class="featured-image">
				<a href="<?php the_permalink(); ?>" class="featured-image-link">
					<?php the_post_thumbnail(); ?>
				</a>
			</section>
			<?php } else {
				$noFeaturedImage = true;
			} ?>

			<section class="entry-summary<?php if ( $noFeaturedImage ) { echo ' no-featured-image'; $noFeaturedImage = false; } ?>">
				<?php
					if( !empty($post->post_excerpt) ) {
						the_excerpt();
					} else {
						$advanced_excerpt = get_field('advanced_excerpt');

						echo '<p>'.$advanced_excerpt.'</p>';
					}
				?>
			</section>
			<footer>
				<?php get_template_part('templates/entry-meta'); ?>
				<a href="<?php the_permalink(); ?>" class="btn btn-default btn-block featured-image-link">
					<?php _e('Continued','starter-theme-2015'); ?>
				</a>
			</footer>
		</article>
		<?php
			endwhile;
			wp_reset_query();
		?>
	</div>
</div>
