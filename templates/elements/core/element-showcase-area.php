<?php
/* ==========================================================================
	Showcase Area
   ========================================================================== */
?>
<div class="showcase_area <?php App\echoBootstrapHidden(); ?>" role="document">

<?php
// Find images for background
// check for rows (parent repeater)
if( have_rows('showcase_set') ):

	// loop through rows (parent repeater)
	while( have_rows('showcase_set') ): the_row();

			// check for rows (sub repeater)
			if( have_rows('showcase_images') ):

				// loop through rows (sub repeater)
				while( have_rows('showcase_images') ): the_row();

					// display each item as a list - with a class of completed ( if completed )

					$image = get_sub_field('images');
					?>

					<img data-adaptive-background='1' cross-origin="anonymous" class="showcase-image" src="<?php echo $image['url']; ?>" />

					<?php
				endwhile;

			endif;

	endwhile;

endif;

?>




<?php
	// Get values from the website options page (In a custom post type)

	// Set the title of the page we want to look for
	$postTitle = 'Website Options';

	// Search for similer post in db table & fetch the ID - Note the post type ;)
	$postID = $wpdb->get_var($wpdb->prepare("SELECT ID FROM {$wpdb->posts} WHERE   post_type='options' AND post_title = %s",$postTitle));

	// Print id
	$postID;

	// Or use get_post($post_id) to get whatever you want
	// $getCustomPost = get_post($postID);
	// echo $getCustomPost->id;

	// Looking for...
	$bgImage = get_field('background_image', $postID);

	if( !empty($bgImage) ) {
		// Vars if needed
		$url 		= $bgImage['url'];
		$title 		= $bgImage['title'];
		$alt 		= $bgImage['alt'];
		$caption 	= $bgImage['caption'];
	}

	$bgColour = get_field('background_colour', $postID);
?>


	<div class="wrap container" role="document">
		<div class="content row">

				<div class="showcase-content col-xs-12 col-lg-8 col-lg-offset-4" style="background-color: <?php echo $bgColour; ?>">

					<?php
						// check if the repeater field has rows of data
						if( have_rows('showcase_set') ):

						 	// loop through the rows of data
						    while ( have_rows('showcase_set') ) : the_row();

						    // display a sub field value
						    ?>

						    <h2><?php the_sub_field('set_title'); ?></h2>

						    <?php the_sub_field('set_content'); ?>

							<?php
						    endwhile;

						else :

						    // no rows found

						endif;
					?>
			</div>
		</div>
	</div>

	<?php
	?>
</div>



<script>
	jQuery.noConflict();
	jQuery(document).ready(function($) {

		var imageHeight = $('.showcase-content').height();

		$('.showcase-image').height(''+ imageHeight +'px');

		$( window ).resize(function() {

			if ($(window).width() < 1200) {
				$('.showcase-image').css('height', 'auto');
				$('.showcase-image').css('width', '100%');
			}

			if ($(window).width() > 1200) {
				$('.showcase-image').css('height', ''+ imageHeight +'px');
				$('.showcase-image').css('width', 'auto');
			}

		});

	});
</script>
