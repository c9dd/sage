			<section class="parallax parallax-<?php the_sub_field('parallax_unique_name'); ?>" style="background: trasparent url('<?php the_sub_field('background_image'); ?>') no-repeat;">
				<img src="<?php the_sub_field('background_image'); ?>" alt="<?php the_sub_field('message'); ?>" style="display:none;" />
				<div class="wrap container" role="document" >
					<div class="content row">
				    	<main class="main col-xs-12 col-md-8 col-md-offset-2" role="main">
							<h1><span><?php the_sub_field('message'); ?></span></h1>
						</main><!-- /.main -->
					</div><!-- /.content -->
				</div><!-- /.wrap -->
			</section>
			<script>
				jQuery.noConflict();
				jQuery(document).ready(function($) {

					// Parallax elements
					var id = $('.parallax-<?php the_sub_field('parallax_unique_name'); ?> img');
	        var parallaxImageWidth				       = 	id.width();
	        var parallaxImageHeight				       = 	id.height();

	        // to use on the container
	        var parallaxContainer 				       = 	(parallaxImageHeight / 3);

	        var parallaxContainerHeightQuater 	 = 	(parallaxImageHeight / 4);

	        var parallaxContainerHeightHalf 	   = 	(parallaxContainerHeightQuater * 2);

	        var parallaxContainerHeightFull 	   = 	(parallaxContainerHeightQuater * 4);


					// animation speeds
	        var parallaxEndValue 			   =	parallaxContainerHeightQuater;

	        //var parallaxEndValue 			 =	(parallaxImageHeight - parallaxContainerHeightHalf);
	        var parallaxHalfWayValue 		 =	(parallaxContainerHeightQuater / 2);


	        // to use on the background on the container
	        var imageUrl = $('.parallax-<?php the_sub_field('parallax_unique_name'); ?> img').attr('src');


	        // ready for the message
	        var parallaxHalfWayValueMessage	=	(parallaxHalfWayValue - 20);


			    // add the value to the container
			    $(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?>').css('height', parallaxContainer + 'px');


			    // get the url from the image and add it to the background of the container. We hide the inline image with css at the moment
			    $(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?>').css('background-image', 'url(' + imageUrl + ')');


					// add these to the container - data-[offset]-(viewport-anchor)-[element-anchor]
					$(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?>').attr('data-center-top', 'background-position: 50% 0px;');																// Start
					$(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?>').attr('data-center', 'background-position: 50% -' + parallaxHalfWayValue + 'px;');										// Middle
				  $(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?>').attr('data-center-bottom', 'background-position: 50% -' + parallaxEndValue + 'px;');									// End


			    // add this to the message - data-[offset]-(viewport-anchor)-[element-anchor]
			    $(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?> h1').attr('data-start', 'opacity: 0; margin-top: ' + parallaxEndValue + 'px;'); 					// Start
			    $(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?> h1').attr('data-center-center', 'opacity: 1; margin-top: ' + parallaxHalfWayValueMessage + 'px;'); 	// Middle
			    $(this).find('.parallax-<?php the_sub_field('parallax_unique_name'); ?> h1').attr('data--100-top', 'opacity: 0; margin-top: -' + parallaxEndValue + 'px;');					// End

				});

			</script>
