<?php
/* ==========================================================================
	Parallax
   ========================================================================== */

   $randomString = App\generateRandomString();
   if ( get_sub_field ('animate_elements') ) {
		$animateElementsClass 	= 'animate-elements';
		$animateElements 		= 'data-animate="true" ';
		$animateElement1 		= 'data-animation-type="'. get_sub_field("section_animation_1") . '"';
	}
// A custom image size is required to make these work correctly, so paste this in to your functions file

/*

if ( function_exists( 'add_image_size' ) ) {
	add_image_size( 'paralax-image-size', 1561, 683 ); // Soft Crop Mode
}

*/

// var_dump(get_sub_field('background_image'));

$image = get_sub_field('background_image');

if( !empty($image) ) {
	// vars
	$url = $image['url'];
	$title = $image['title'];
	$alt = $image['alt'];
	$caption = $image['caption'];

	// thumbnail
	$size = 'paralax-image-size';
	$thumb = $image['sizes'][ $size ];
	$width = $image['sizes'][ $size . '-width' ];
	$height = $image['sizes'][ $size . '-height' ];

	// print_r(array_values($image));

}

?>
<div class="<?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>">
<section class="parallax parallax-<?php the_sub_field('parallax_unique_name'); ?>" style="background: trasparent url('<?= $thumb; ?>') no-repeat;" <?= $animateElements.$animateElement1; ?>>
	<img class="parallax-image" data-adaptive-background='1' cross-origin="anonymous" src="<?= $thumb; ?>" alt="<?php the_sub_field('message'); ?>" style="display: none;" width="<?= $width; ?>" height="<?= $height; ?>" />
	<!--div class="wrap container" role="document"-->
		<div class="content row">
	    	<main class="col-xs-12 col-md-8 col-md-offset-2" role="main">
				<?php if ( get_sub_field('message') !== '' ) : ?>
				<h1><span><?php the_sub_field('message'); ?></span></h1>
				<?php endif; ?>
				<img src="<?= $thumb; ?>" alt="<?php the_sub_field('message'); ?>" />
			</main><!-- /.main -->
		</div><!-- /.content -->
	<!--/div><!-- /.wrap -->

</section>
</div>
<script>
	jQuery.noConflict();
	jQuery(document).ready(function($) {

	    $('.element-parallax').parent().removeClass('container').addClass('conatiner-fluid');

		$('.element-parallax').wrap('<div class="row"></div>');

		// $.adaptiveBackground.run()

		// Parallax elements
		var id = $('.parallax-<?php the_sub_field('parallax_unique_name'); ?> img');
        var parallaxImageWidth			= 	id.width();
        var parallaxImageHeight			= 	id.height();

        // to use on the container
		var parallaxContainerHeightHalf = 	(parallaxImageHeight / 2);
		var parallaxContainerHeightFull = 	(parallaxImageHeight);

		// animation speeds
        var parallaxEndValue 			=	(parallaxImageHeight - parallaxContainerHeightHalf);
        var parallaxHalfWayValue 		=	(parallaxEndValue / 2);


        // to use on the background on the container
        var imageUrl = $('.parallax-<?php the_sub_field('parallax_unique_name'); ?> img').attr('src');


        // ready for the message
        // var parallaxHalfWayValueMessage	=	(parallaxHalfWayValue - 20);
        var parallaxHalfWayValueMessage	=	(parallaxHalfWayValue - 20);


	    // add the value to the container
	    // $(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?>').css('height', parallaxContainerHeightHalf + 'px');
	    $(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?>').css('height', parallaxContainerHeightHalf + 'px');

	    // get the url from the image and add it to the background of the container. We hide the inline image with css at the moment
	    $(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?>').css('background-image', 'url(' + imageUrl + ')');


		// add these to the container - data-[offset]-(viewport-anchor)-[element-anchor]
		$(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?>').attr('data-bottom-top', 'background-position: 50% 0px;');																// Start
		$(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?>').attr('data-center-center', 'background-position: 50% -' + parallaxHalfWayValue + 'px;');								// Middle
	    $(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?>').attr('data-top-bottom', 'background-position: 50% -' + parallaxEndValue + 'px;');										// End


	    $(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?> h1').css('margin-top', ''+ parallaxHalfWayValueMessage + 'px');

	    // add this to the message - data-[offset]-(viewport-anchor)-[element-anchor]
	    /*$(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?> h1').attr('data-start', 'opacity: 0; margin-top: ' + parallaxEndValue + 'px; filter: blur(20px);'); 					// Start
	    $(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?> h1').attr('data-center-center', 'opacity: 1; margin-top: ' + parallaxHalfWayValueMessage + 'px; filter: blur(0px);'); 	// Middle
	    $(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?> h1').attr('data--50-top', 'opacity: 0; filter: blur(20px); margin-top: -' + parallaxEndValue + 'px;');					// End
	    */

	    	if ( $('.element-parallax').length ) {
				var offset = $('.element-parallax').offset();							// works out the position relative to the top left corner of browser

				var windowWidth = $(window).width();									// Width of the browser window

				$('.element-parallax').width(windowWidth);								// Apply that width to the element

				$('.element-parallax').css('margin-left','-'+ offset.left - 15 +'px');	// Pull that element left
			}
	});

</script>
