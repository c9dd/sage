<?php
/* ==========================================================================
	Video Area - http://www.tripadvisor.co.uk/Widgets-d0
   ========================================================================== */

   $randomString = App\generateRandomString();
   if ( get_sub_field ('animate_elements') ) {
		$animateElementsClass 	 = 'animate-elements';
		$animateElements 		     = 'data-animate="true" ';
		$animateElement1 		     = 'data-animation-type="'. get_sub_field("section_animation_1") . '"';
	}
?>

<div class="full-width-video row <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>" role="document">
	<div <?= $animateElements.$animateElement1; ?>>
	<?php

	// If we have the share url use that
	if(get_sub_field('video_url')) {

		$iframe = get_sub_field('video_url');

		// use preg_match to find iframe src
		preg_match('/src="(.+?)"/', $iframe, $matches);

		$video_url = $matches[1];

		// echo $video_url;


		// EMBED URL from YouTube / Vimeo
		/// $video_url = get_sub_field('video_url');

		// the_sub_field('video_url');

		if ($video_url) {

			// Video Options
			$video_colour_override	 = get_sub_field('video_colour_override');
			$video_colour_override 	 = str_replace('#', '', $video_colour_override);
			$auto_play 				       = '0';
			$loop 					         = '0';
			$portrait 				       = '&portrait=0';
			$video_title 			       = '&title=0';
			$showinfo				         = '&showinfo=0';
			$byline 				         = '&byline=0';





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

			//echo '<br>'.$parse['host'];

			// print_r( $parse );

			/* If we are dropping a SHARE url from YouTube */
			if ($parse['host'] == 'youtu.be') {

				$host = 'youtube';

				// Remove the forward slahes
				$video_url = trim($video_url,'/');

				// Find each value by looking for -
				$video_url_id = explode('/', $video_url);

				// now we just get the ID
				$video_url_id = htmlspecialchars($video_url_id[2], ENT_QUOTES, 'UTF-8');


			/* If we are just dropping a FULL url from YouTube */
			} elseif ($parse['host'] == 'www.youtube.com') {

				$host = 'youtube';

				// Remove the forward slahes
				$video_url = trim($video_url,'/');

				// Find each value by looking for -
				$video_url_id = explode('/', $video_url);

				// now we just get the ID
				$video_url_id = htmlspecialchars($video_url_id[4], ENT_QUOTES, 'UTF-8');

				//echo '<br>'.$video_url_id;

			/* If we have a url from Vimeo instead ... */
			} elseif ($parse['host'] == 'player.vimeo.com') {

				$host = 'vimeo';

				// Remove the forward slahes
				$video_url = trim($video_url,'/');

				// Find each value by looking for -
				$video_url_id = explode('/', $video_url);

				// now we just get the ID
				$video_url_id = htmlspecialchars($video_url_id[4], ENT_QUOTES, 'UTF-8');

				//echo '<br>'.$video_url_id;
			}

		}


		if ($video_url && $parse['host'] == 'youtu.be' || $parse['host'] == 'www.youtube.com') {
											echo "<iframe class='video youtube' id='player_1' type='text/html' src='//www.youtube.com/embed/$video_url_id?controls=1&modestbranding=1&rel=0$showinfo&autohide=1&color=$video_colour_override' frameborder='0' allowfullscreen></iframe>";

		} elseif ($video_url && $parse['host'] == 'player.vimeo.com') {
			echo "<iframe class='video vimeo' id='player_1' type='text/html' src='//player.vimeo.com/video/$video_url_id?autoplay=$auto_play&loop=$loop&color=$video_colour_override$video_title$byline$portrait' frameborder='0' webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>";

		}


	} 	// Else we will see if we have the embed code & use that

		elseif (!get_sub_field('video_url') && get_sub_field('slide_text')) {
				// Get the embed code
				the_sub_field('video_embed_code');
		}


	// OH and a share url will win over embed code ;)

	?>
	</div>
</div>
