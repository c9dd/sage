<?php
/* ==========================================================================
	Alerts
   ========================================================================== */
  $randomString = App\generateRandomString();

	// Get the Timeline start date and format it as we want it
	$startDateRaw				       = 	DateTime::createFromFormat( 'Ymd', get_sub_field( 'start_date' ) );
	$startDateFormatted 		   = 	$startDateRaw->format( 'd-m-Y' );	 // Complete date
	$startDateYearFormatted 	 = 	$startDateRaw->format( 'Y' );		   // Just the year
	//echo $startDateYearFormatted;

	// See if event auto spacing has been turned off
	$autoEventSpacing = get_sub_field('event_auto_spacing');
?>

<div class="col-xs-12 animate-elements" data-element-unique-id="<?= $randomString; ?>">

	<time class="start-date" data-animate="true" data-animation-type="zoomIn"><?= $startDateYearFormatted; ?></time>
	<span class="follow"></span>
    <ul class="timeline" id="<?php the_sub_field('element_id');?>">
	<?php if( have_rows('timeline_event') ): ?>

	<?php while ( have_rows('timeline_event') ) : the_row();

		// Get this event dat in a format we can do something with
		$thisEventDateRaw			      = 	DateTime::createFromFormat( 'Ymd', get_sub_field( 'event_date' ) );
		$thisEventDateFormatted 	  = 	$thisEventDateRaw->format( 'd-m-Y' );
		$thisEventDateYearFormatted = 	$thisEventDateRaw->format( 'Y' );

		// Takeing the event date & formatting it
		$thisEventDate				=	date_create( $thisEventDateFormatted );

		// If this is the first event then this will not have been set, but we need to give it a value
		if ( empty( $previousEventDate ) ) {
			// So we set it to the given start date
			$previousEventDate		=	date_create( $startDateFormatted );
		}

		// This will be either the same as the event date (1st pass) or it will be the date of the previous event (2nd, 3rd, 4th -> pass)
		$previousEventDate			= 	$previousEventDate;

		// Find the difference between the two dates
		if ($autoEventSpacing == false && $previousEventDate 	   != 	$thisEventDate) {
			$diffRaw				 =	date_diff( $previousEventDate, $thisEventDate );
			$diff					   = 	$diffRaw->format( '%a' );
		} elseif ($autoEventSpacing) { // If event auto spacing is turned off
			$diff = get_sub_field('event_top_margin'); // Get the manual values set
		} else {
			$diff 					= '0'; // Catch all
		}

		// For testing
		// echo $diff->format( "%R%a days" );
		// print_r( $thisEventDate );



?>
        <li class="timeline-event" style="margin-top: <?= $diff; ?>px" date-event-date="<?= $thisEventDateYearFormatted; ?>" >
			<div class="timeline-badge" style="background-color: <?= the_sub_field('event_badge_background_colour'); ?>;" data-animate="true" data-animation-type="zoomIn">
				<i class="fa <?= the_sub_field('event_icon'); ?> fa-fw" <?php if ( get_sub_field('event_icon_colour') !== '#fff' )  { ?> style="color: <?= the_sub_field('event_icon_colour'); ?>;" <?php }?>></i>
			</div>
			<div class="timeline-panel" data-animate="true" data-animation-type="fadeInRight">
		        <time><?= $thisEventDateFormatted; ?></time>
	            <div class="timeline-heading">
	            	<h3 class="timeline-title"><?= the_sub_field('event_title'); ?></h3>
	            </div>

	            <?php
		            if ( !empty( get_sub_field('event_description') ) ) { ?>
	            <div class="timeline-body">
	            	<?= the_sub_field('event_description'); ?>
	            </div>
	            <?php } ?>

	            <?php
		            /*
					echo 'This Event: ' . print_r( $thisEventDate );

					echo '<hr>';

					echo 'Previous Event: ' . print_r( $previousEventDate );
					*/
				?>
        	</div>
        </li>
	<?php

		// Set this date as the previous date ready to use on the next pass
		$previousEventDate 		= 	$thisEventDate;

		// Set it so we can access it again
		global $previousEventDate;

		endwhile;
		//print_r( $previousEventDate );
		?>

	<?php endif; ?>
    </ul>
</div>

<script>
	/*
	jQuery.noConflict();
	jQuery( document ).ready(function( $ ) {
		// adds animation classes when in viewport
		var viewport = $(window),
	        setVisible = function (e) {
	            var viewportTop = viewport.scrollTop(),
	                viewportBottom = viewport.scrollTop() + viewport.height();
	            $('.timeline-event').data('element-unique-id','<?= $randomString; ?>').each(function () {

					$(this).find('.timeline-badge, .timeline-panel').each(function () {
						var animationType 	= $(this).data('animation-type');

		                var self = $(this),
		                    top = self.offset().top,
		                    bottom = top + self.height(),
		                    topOnScreen = top >= viewportTop && top <= viewportBottom,
		                    bottomOnScreen = bottom >= viewportTop && bottom <= viewportBottom,
		                    elemVisible = topOnScreen || bottomOnScreen;
		                self.toggleClass('animated '+animationType+'', elemVisible);
					});

	            });
	        };

	    viewport.scroll(setVisible);
	    setVisible();

	});
	*/
</script>
