<?php
/* ==========================================================================
	Trip Advisor widget - http://www.tripadvisor.co.uk/Widgets-d0
   ========================================================================== */
// Raw url input
$rawUrl = get_sub_field('tripadvisor_url');

// Look for '-' and break them apart
$lookingFor = explode('-', $rawUrl);

// Look for the 2nd occurence of it
$rawId = $lookingFor[2];

// Remove the letter 'd' as we don't need that
$id = str_replace('d','', $rawId);

// Give us the clean ID
//echo $id;
?>

<!--div class="row">
	<div class="col-xs-12 col-md-6 col-md-offset-3" <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?>>

		<div id="TA_selfserveprop255" class="TA_selfserveprop tripadvisor-reviews">
			<ul id="6OEo7GRcbbk" class="TA_links ko0Xwa3">
				<li id="fSQk0IEIp" class="zfYRDnl">
					<a target="_blank" href="http://www.tripadvisor.co.uk/"><img src="http://www.tripadvisor.co.uk/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a>
				</li>
			</ul>
		</div>

		<script src="http://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=255&amp;locationId=<?=$id;?>&amp;lang=en_UK&amp;rating=true&amp;nreviews=4&amp;writereviewlink=false&amp;popIdx=false&amp;iswide=true&amp;border=true&amp;display_version=2"></script>
	</div>
</div-->
<div class="row <?php App\echoBootstrapHidden(); ?>">
	<div class="col-xs-12 col-md-6 trip-map" <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?>>
		<div id="TA_impnearbyaccomwide648" class="TA_impnearbyaccomwide">
			<ul id="QVPpx0ShjvQf" class="TA_links i31Kvuh">
				<li id="IZC7wGjxl" class="RavusVO">
					<a target="_blank" href="http://www.tripadvisor.co.uk/"><img src="http://www.tripadvisor.co.uk/img/cdsi/partner/tripadvisor_logo_96x15t-13352-2.png" alt="TripAdvisor"/></a>
				</li>
			</ul>
		</div>
		<script src="http://www.jscache.com/wejs?wtype=impnearbyaccomwide&amp;uniq=648&amp;locationId=<?=$id;?>&amp;lang=en_UK&amp;border=false&amp;display_version=2&amp;ltype=v"></script>
	</div>

	<div class="col-xs-12 col-md-6 trip-reviews" <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?>>

		<div id="TA_selfserveprop255" class="TA_selfserveprop tripadvisor-reviews">
			<ul id="6OEo7GRcbbk" class="TA_links ko0Xwa3">
				<li id="fSQk0IEIp" class="zfYRDnl">
					<a target="_blank" href="http://www.tripadvisor.co.uk/"><img src="http://www.tripadvisor.co.uk/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a>
				</li>
			</ul>
		</div>

		<script src="http://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=255&amp;locationId=<?=$id;?>&amp;lang=en_UK&amp;rating=true&amp;nreviews=4&amp;writereviewlink=false&amp;popIdx=false&amp;iswide=true&amp;border=true&amp;display_version=2"></script>
	</div>
</div>

<script>

	jQuery.noConflict();
	jQuery(document).ready(function($) {


		setTimeout(
		  function() {
			// for Tripadvisor map
			$('#CDSWIDVRNB').css('width','auto');




			// for Tripadvisor reviews
			// add the #review to the url to jump to the right place on the page
		    var href = $('.widSSPSummary a').attr('href');
			$('.widSSPSummary a, .widSSPReadReview a').attr('href', href + '#REVIEWS');
		  }, 15000);
	});

</script>
