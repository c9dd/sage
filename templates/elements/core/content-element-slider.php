<?php
/* ==========================================================================
	Slider Area
   ========================================================================== */
	$elementIDRaw 				= get_sub_field('element_id');
	$elementIDRawNoSpace		= preg_replace('/\s+/', '-', $elementIDRaw);
	$elementIDNoSpaceLowerCase 	= strtolower($elementIDRawNoSpace);

	$animationType				= get_sub_field('animation_type');

?>
<section class="slider-area  <?php App\echoBootstrapHidden(); ?>">
	<section id="<?php echo $elementIDNoSpaceLowerCase; ?>">
		<div id="carousel-example-generic" class="carousel carousel-<?= $animationType; ?> slide" data-ride="carousel">
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<?php
				$count = 0;
				// check if the repeater field has rows of data

				if( have_rows('slides') ) {

				 	// loop through the rows of data
				    while ( have_rows('slides') ) { the_row();

						if ($count == 0) 	{

						echo '<li data-target="#bs-carousel" data-slide-to="0" class="active"></li>';

						} else {
							echo '<li data-target="#bs-carousel" data-slide-to="'.$count.'"></li>';
						}
					$count++;
					};
				}
				?>
			</ol>

			<!-- Wrapper for slides -->
			<div class="carousel-inner slides" role="listbox">
				<?php
				$count = 0;
				// check if the repeater field has rows of data
				if( have_rows('slides') ) {

				 	// loop through the rows of data
				    while ( have_rows('slides') ) { the_row();

						if( get_sub_field('slide_type' ) == 'image' ) {
							$slideType = 'image-slide';
						} elseif ( get_sub_field('slide_type' ) == 'video' ) {
							$slideType = 'video-slide';
						}


						if ($count == 0) 	{
							$active = 'active';
						} else {
							$active = '';
						}
				?>



					<?php
						if ( get_sub_field('slide_type') == 'image' ) {
					?>
					<div id="<?=$count;?>" class="item <?=$slideType?> <?=$active?>" style="overflow: hidden;">
					<div class="content-area" role="document">
						<aside class="slider-text-area col-xs-12 <?php the_sub_field('text_align')?>">

							<img src="<?php the_sub_field('slide_image'); ?>" >

							<div class="carousel-caption">

								<?php if(get_sub_field('slide_title') && get_sub_field('show_title')) { ?>
								<section class="title"<?php if ( get_sub_field('slide_title_verticle_posision') ) :?> style="margin-top: <?php the_sub_field('slide_title_verticle_posision'); ?>%;"<?php endif;?> data-animation="animated <?php the_sub_field('title_animation'); ?>">
									<h1><span><?php the_sub_field('slide_title'); ?></span></h1>
								</section>
								<?php } ?>

								<?php if(get_sub_field('slide_text') ){ ?>
								<section class="text"<?php if ( get_sub_field('slide_text_verticle_posision') ) :?> style="margin-top: <?php the_sub_field('slide_title_verticle_posision'); ?>%;"<?php endif;?> data-animation="animated <?php the_sub_field('text_animation'); ?>">
									<p><?php the_sub_field('slide_text'); ?></p>
								</section>
								<?php } ?>

								<?php
									// If we have text set for the link & the link is an external one & not just http:// (the default value for the field set within ACF in WP)
									if(get_sub_field('slide_link_text') && get_sub_field('slide_link_external') !=='http://'): ?>

									<a href="<?php the_sub_field('slide_link_external'); ?>" target="_blank" class="slider-link btn" data-animation="animated <?php the_sub_field('link_animation'); ?>"><?php the_sub_field('slide_link_text'); ?></a>

									<?php
									// If the link text has not been given, the link is an external one & not just http:// (the default value for the field set within ACF in WP)
									elseif(!get_sub_field('slide_link_text') && get_sub_field('slide_link_external') !=='http://'): ?>

									<a href="<?php the_sub_field('slide_link_external'); ?>" target="_blank" class="slider-link btn"data-animation="animated <?php the_sub_field('link_animation'); ?>"><?php _e('Find out more', 'starter-theme'); ?></a>

									<?php
									// If the text link has been set & the link is an internal one
									elseif(get_sub_field('slide_link_text') && get_sub_field('slide_link_internal')): ?>

									<a href="<?php the_sub_field('slide_link_internal'); ?>" class="slider-link btn"data-animation="animated <?php the_sub_field('link_animation'); ?>"><?php the_sub_field('slide_link_text'); ?></a>

									<?php
									// If the link text is not set & is an internal one
									elseif(!get_sub_field('slide_link_text') && get_sub_field('slide_link_internal')): ?>

									<a href="<?php the_sub_field('slide_link_internal'); ?>" class="slider-link btn"data-animation="animated <?php the_sub_field('link_animation'); ?>"><?php _e('Find out more', 'starter-theme'); ?></a>

									<?php
									// Else ummm...
									else: ?>

							<?php endif;

								if (get_sub_field('jump_link') == 'no') : ?>
									<!-- MOUSE SCROLL INDICATOR -->
									<?php
										if ( empty(get_sub_field('jump_to') ) ) {
											$jumpLink	= $count.'jumplink';
									?>
											<script>
												jQuery.noConflict();
												jQuery( document ).ready(function( $ ) {
													$('.element-slider').next('div.element-contents').attr('id', '<?=$count;?>jumplink');
												});
											</script>
									<?php
											// $jumpLink	= $count.'jumplink';

										} else {
											$jumpLink	=	get_sub_field('jump_to');
										}
									?>
									<a class="mouse-scroll" href="#<?= $jumpLink; ?>">
										<span class="mouse">
									    	<span class="mouse-movement"></span>
										</span>
										<span class="mouse-message fadeIn"><?php _e('scroll', 'starter-theme'); ?></span>
									</a>
								<?php endif; ?>


							</div>
						</aside>
					</div>
					</div>

				<?php
				} elseif ( get_sub_field('slide_type') == 'video' ) {
				?>
					<div class="item <?=$slideType?> <?=$active?>" style="overflow: hidden;">
					<div class="content-area" role="document">
					<?php
						// If we have the share url use that
						if(get_sub_field('video_url')) :

							// EMBED URL from YouTube / Vimeo
							//$video_url = get_sub_field('video_url');

							$iframe = get_sub_field('video_url');

							// use preg_match to find iframe src
							preg_match('/src="(.+?)"/', $iframe, $matches);

							$video_url = $matches[1];


							if ($video_url) {

								// Video Options
								$video_colour_override	= get_sub_field('video_colour_override');
								$video_colour_override 	= str_replace('#', '', $video_colour_override);
								$auto_play 				= '0';
								$loop 					= '0';
								$portrait 				= '&portrait=0';
								$video_title 			= '&title=0';
								$showinfo				= '&showinfo=0';
								$byline 				= '&byline=0';



								/*
								if( in_array( 'autoplay', get_sub_field('video_display_options') ) ) :
									$auto_play = '1';
								endif;
								*/

								// Only do this if we have at least one set
								if ( get_sub_field('video_display_options') != '' ) {

									if( in_array( 'loop', get_sub_field('video_display_options') ) ) :
										$loop 			= '1';
									endif;

									if( in_array( 'portrait', get_sub_field('video_display_options') ) ) :
										$portrait 		= '';
									endif;

									if( in_array( 'title', get_sub_field('video_display_options') ) ) :
										$video_title 	= '';
										$showinfo		= '&showinfo=1';
									endif;

									if( in_array( 'byline', get_sub_field('video_display_options') ) ) :
										$byline 		= '';
									endif;
								}


								// To work out where the video is hosted later
								$share_url = $video_url;

								// We will do this to check later where it's from
								$parse = parse_url($share_url);


								/* If we are dropping a SHARE url from YouTube */
								if ($parse['host'] == 'youtu.be') :

									$host = 'youtube';

									// Remove the forward slahes
									$video_url = trim($video_url,'/');

									// Find each value by looking for -
									$video_url_id = explode('/', $video_url);

									// now we just get the ID
									$video_url_id = htmlspecialchars($video_url_id[3], ENT_QUOTES, 'UTF-8');


								/* If we are just dropping a FULL url from YouTube */
								elseif ($parse['host'] == 'www.youtube.com') :

									$host = 'youtube';

									// echo parse_url($video_url, PHP_URL_QUERY);

									// Take the URl & find the query string
									$rawUrlQuery = parse_url($video_url, PHP_URL_QUERY);

									// Remove the query ID
									$video_url_id = trim($rawUrlQuery,'v=');

								/* If we have a url from Vimeo instead ... */
								elseif ($parse['host'] == 'player.vimeo.com') :

									$host = 'vimeo';

									// Remove the forward slahes
									$video_url = trim($video_url,'/');

									// Find each value by looking for -
									$video_url_id = explode('/', $video_url);

									// now we just get the ID
									$video_url_id = htmlspecialchars($video_url_id[4], ENT_QUOTES, 'UTF-8');

								endif;

							}


							if ($video_url && $parse['host'] == 'youtu.be') :
								echo "<div class='embed-container'><iframe class='video youtube' id='player_1' type='text/html' src='http://www.youtube.com/embed/$video_url_id?controls=1&modestbranding=1&rel=0&showinfo=0&autohide=1&color=$video_colour_override' frameborder='0' allowfullscreen></iframe></div>";

							elseif ($video_url && $parse['host'] == 'player.vimeo.com') :
								echo "<div class='embed-container'><iframe class='video vimeo' id='player_1' type='text/html' src='https://player.vimeo.com/video/$video_url_id?autoplay=$auto_play&loop=$loop&color=$video_colour_override$video_title$byline$portrait' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe></div>";

							endif;


						 	// Else we will see if we have the embed code & use that

						elseif (!get_sub_field('video_url') && get_sub_field('slide_text')) :
								// Get the embed code
								the_sub_field('video_embed_code');
						endif;
						?>
						<div class="fake-button"></div>
					</div>
					</div>
			<?php } ?>

			<?php
				$count++;
			    }
			};
			?>
			</div>

			<!-- Controls -->
			<a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
				<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				<span class="sr-only"><?php _e('Previous', 'starter-theme'); ?></span>
			</a>
			<a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
				<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
				<span class="sr-only"><?php _e('Next', 'starter-theme'); ?></span>
			</a>
		</div>

	</section>
</section>


<script>
	jQuery.noConflict();
	jQuery( document ).ready(function( $ ) {


		//Function to animate slider captions
	    function doAnimations( elems ) {
	        //Cache the animationend event in a variable
	        var animEndEv = 'webkitAnimationEnd animationend';

	        elems.each(function () {
	            var $this = $(this),
	                $animationType = $this.data('animation');
	            $this.addClass($animationType).one(animEndEv, function () {
	                $this.removeClass($animationType);
	            });
	        });
	    }

	    //Variables on page load
	    var $myCarousel = $('#carousel-example-generic'),
	        $firstAnimatingElems = $myCarousel.find('.item:first').find("[data-animation ^= 'animated']");

	    //Initialize carousel
	    //$myCarousel.carousel();

	    //Animate captions in first slide on page load
	    doAnimations($firstAnimatingElems);

	    //Pause carousel
	    //$myCarousel.carousel('pause');


	    //Other slides to be animated on carousel slide event
	    $myCarousel.on('slide.bs.carousel', function (e) {
	        var $animatingElems = $(e.relatedTarget).find("[data-animation ^= 'animated']");
	        doAnimations($animatingElems);
	    });


		 // Option to make slider full width
	    <?php if( get_sub_field('allow_full_width') == 'true' ) { ?>
/*
	    	if ( $('.element-slider').length ) {
				var offset = $('.element-video').offset();						// works out the position relative to the top left corner of browser

				var windowWidth = $(window).width();							// Width of the browser window

				$('.element-slider').width(windowWidth);						// Apply that width to the element

				$('.element-slider').css('margin-left','-'+ offset.left +'px');	// Pull that element left
			}
*/
			/* The above code is mor elegent than this, but I'm going to leave it here and walk away ... */
	    	// The html to construct the containers for BEFORE the slider
			var newContainerBeforeSlider = $('<div class="wrap primary container before-slider" role="document"><div class="content row"><main class="main" role="main"><div class="col-xs-12 content-wrapper target"><div class="page content"><div class="row"><article class="col-xs-12 type-page status-publish hentry"></article></div></div></div></main></div></div>');

			// The html to construct the containers for AFTER the slider
			var newContainerAfterSlider = $('<div class="wrap primary container after-slider" role="document"><div class="content row"><main class="main" role="main"><div class="col-xs-12 content-wrapper"><div class="page content"><div class="row"><article class="col-xs-12 type-page status-publish hentry"></article></div></div></div></main></div></div>');

			// Insert the AFTER container
			$('.wrap.primary.container').after(newContainerAfterSlider);

			// Insert the BEFORE container - Use .not() to ensure it only does it once
			$('.wrap.primary.container').not('.after-slider').before(newContainerBeforeSlider);

			// The title will need moving to the BEFORE container
			$('.page-header').detach().prependTo('.before-slider .target');

			// Take all the content before the slider and move it to the contain BEFORE the slider
			//$('.element-slider').prevUntil('article.hentry').appendTo('.before-slider article.hentry');
			// Fixed to call out in reverse order to make sure the appear in the correct order
			var elements = $('.element-slider').prevUntil('article.hentry').get().reverse();

			$(elements).appendTo('.before-slider article.hentry');

			// Take all the content after the slider and move it to the container AFTER the slider
			$('.element-slider').nextUntil('article.hentry').appendTo('.after-slider article.hentry');

			// Change some classes of the original container to make if full width - Again the .not() is used to only target what we want
			$('.wrap.primary.container').not('.before-slider, .after-slider').removeClass('container').addClass('conatiner-fluid slider');
			/**/
        <?php } ?>

		/*$('.carousel').carousel({
			interval: 	<?php the_sub_field('slide_show_speed'); ?>,
			wrap: 		<?php the_sub_field('loop_animation'); ?>,
			keyboard: 	true
		});
/*
		$('.carousel').on('click', function(e){
			// alert();
	       $('.carousel').carousel('pause');
	    }).blur(function() {
	       $('.carousel').carousel('cycle');
	    });
*/

		/*
		$('.carousel .item').each(function() {
		    var elements = $(this);
		    var height = 0;
		    elements.css('min-height','0px');
		    elements.each(function() {
			    height = $(this).height() > height ? $(this).height() : height;
		    });
		    elements.css('min-height',height+'px');
		});
		*/
		function matchSlideHeights() {
			$('.carousel .item').each(function() {

				var slideHeight 	= $(this).height(); 						// Selector height

				var videoHeight		= $('.carousel .video-slide').height(); 	// Selector height

				var trueSlideHeight	= slideHeight + 85; 						// Slide hieght + Nav height

				var windowHeight	= $(window).height(); 						// Window height

				var windowWidth		= $(window).width(); 						// Window width

				var newSlideHeight	= windowHeight - 85; 						// Window height - Nav height

				// For testing
				/*
				console.log('Window Height 		= '+windowHeight+'px');
				console.log('Slide Height 		= '+slideHeight+'px');
				console.log('True Slide Height 	= '+trueSlideHeight+'px');
				console.log('New Slide Height 	= '+newSlideHeight+'px');
				*/
				if ( trueSlideHeight > windowHeight ) { 		// If the true slide height is greater than the visable viewport
					$(this).height(newSlideHeight); 			// Set the height
				}

				if ( videoHeight < slideHeight ) {
					$('.carousel .video-slide').height(slideHeight);
					$('.carousel .video-slide .embed-container').css('padding-bottom','52.25%');
				}


			});
		};

		// matchSlideHeights();


	});

	jQuery(window).resize(function() {
		// matchSlideHeights();
	});
</script>
