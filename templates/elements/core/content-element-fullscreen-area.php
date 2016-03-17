<?php
/* ==========================================================================
	FULL SCREEN AREA
   ========================================================================== */

   $randomString = App\generateRandomString();
   if ( get_sub_field ('animate_elements') ) {
		$animateElementsClass 	= 'animate-elements';
		$animateElements 		= 'data-animate="true" ';
		$animateElement1 		= 'data-animation-type="'. get_sub_field("section_animation_1") . '"';
	}
?>

<div class="fullscreen-area <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>" role="document">
	<div <?= $animateElements.$animateElement1; ?>>
		<?php $image = get_sub_field('image'); ?>
		<img class="fullscreen-image" src="<?php echo $image['url']; ?>" style="display: none;"/>

		<div class="wrap container" role="document">
			<div class="content row">
				<div class="fullscreen-content col-xs-12 col-md-6 col-md-offset-3">

					<!-- MESSAGE AREA -->
					<h2><span><?php the_sub_field('title') ?></span></h2>

				</div>
			</div>
		</div>

		<?php if( get_sub_field('scroll_icon') ) { ?>

		<!-- MOUSE SCROLL INDICATOR -->
		<a class="mouse-scroll" href="#">
			<span class="mouse">
		    	<span class="mouse-movement"></span>
			</span>
			<span class="mouse-message fadeIn"><?php _e('scroll', 'starter-theme'); ?></span>
		</a>

		<?php } ?>

	</div>
</div>

<script>
	jQuery.noConflict();
	jQuery(document).ready(function($) {
		var offset = $('.element-fullscreen-area').offset();						// works out the position relative to the top left corner of browser

	    $('.element-fullscreen-area').parent().removeClass('container').addClass('conatiner-fluid');

		$('.element-fullscreen-area').wrap('<div class="row"></div>');

		$('.element-fullscreen-area').css('margin-left','-'+ offset.left +'px');	// Pull that element left


		// var windowHeight = 	$(window).height();
		// var windowWidth 	= 	$(window).width();

		// $('.showcase-image').height(''+ imageHeight +'px');

		var windowHeight 	= 	$(window).height();
		var windowWidth 	= 	$(window).width();

		$('.fullscreen-area').css('height', ''+ windowHeight +'px');

		$('.fullscreen-area').css('width', ''+ windowWidth +'px');

		// to use on the background on the container
        var imageUrl = $('.fullscreen-image').attr('src');

        // get the url from the image and add it to the background of the container. We hide the inline image with css at the moment
	    $(this).find('.fullscreen-area').css('background-image', 'url(' + imageUrl + ')');


		// alert(''+ windowWidth +'');

		$(window).resize(function() {

			var windowHeight 	= 	$(this).height();
			var windowWidth 	= 	$(this).width();

			$('.fullscreen-area').css('height', ''+ windowHeight +'px', 'width', ''+ windowWidth +'px');
			$('.fullscreen-area').css('background-image', 'url(' + imageUrl + ')');
			// alert(''+ windowHeight +'px');

			/*
			if ($(this).width() < 1200) {
				$('.showcase-image').css('height', 'auto');
				$('.showcase-image').css('width', '100%');
			}

			if  ($(this).width() > 1200) {
			   $('.showcase-image').css('height', ''+ imageHeight +'px');
			   $('.showcase-image').css('width', 'auto');
			}
			*/

		});


	});
</script>
