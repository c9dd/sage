<?php
/* ==========================================================================
	Instagram Feed
   ========================================================================== */
?>

<div class="row instagramfeed <?php App\echoBootstrapHidden(); ?>">


		<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/assets/scripts/plugins/instagram/instafeed.min.js"></script>
		<script>
			jQuery.noConflict();
			jQuery(document).ready(function($) {

			var feed = new Instafeed({

				<?php
				if (get_sub_field('images_to_find') == 'user_id') :

				$user_id = get_sub_field('user_id');
				?>

				get: 'user',
		        userId: <?php echo $user_id; ?>,

		        <?php
		        endif;

		        if (get_sub_field('images_to_find') == 'location') :

				$location = get_sub_field('location');
				?>

				get: 'location',
		        locationId: "<?php echo $location; ?>",

				<?php
				endif;

				if (get_sub_field('images_to_find') == 'hashtag') :

				$hashtag = get_sub_field('hashtag');
				?>

				get: 'tagged',
		        tagName: "<?php echo $hashtag; ?>",

				<?php
				endif;

				if (get_sub_field('number_of_images_to_show')) :

				$number_of_images_to_show = get_sub_field('number_of_images_to_show');
				?>

				limit: '<?php echo $number_of_images_to_show; ?>',

				<?php
				endif;

				if (get_sub_field('sort_by')) :

				$sort_by = get_sub_field('sort_by');
				?>

				sortBy: '<?php echo $sort_by; ?>',

				<?php
				endif;

				/*
				$location = get_field('location');

				echo $location['lat'];
				echo $location['lng'];

				*/
				?>



				resolution: 'standard_resolution',

				after: function () {
				    var images = $("#instafeed").find('a');
				    $.each(images, function(index, image) {
				      var delay = (index * 175) + 'ms';
				      $(image).css('-webkit-animation-delay', delay);
				      $(image).css('-moz-animation-delay', delay);
				      $(image).css('-ms-animation-delay', delay);
				      $(image).css('-o-animation-delay', delay);
				      $(image).css('animation-delay', delay);
				      $(image).addClass('animated fadeIn');
				    });
				  },


				template: '<a href="{{link}}" target="_blank"><img src="{{image}}" /><div class="likes"><i class="fa fa-heart"></i> {{likes}} | <i class="fa fa-comments"></i> {{comments}}</div></a>',

		        accessToken: '11047347.467ede5.9fb1a750a5374570a67b70dc861eaa9d',
		        clientId: 'aed1864b789a45bea676569287ec49d1'


		    });

		    feed.run();

			});

		</script>


	<div class="col-xs-12">
		<h5><i class="fa fa-instagram"></i> Instagram<a href="https://instagram.com/explore/tags/<?php echo $hashtag; ?>" target="_blank">#<?php echo $hashtag; ?></a></h5>
	</div>
	<div id="instafeed" class="col-xs-12"></div>

</div>

<script>

jQuery.noConflict();
jQuery(document).ready(function($) {
	// add the #review to the url to jump to the right place on the page
	setTimeout(
	  function() {
		$('#instafeed').wrapInner('<div class="row"></div>');

		$('#instafeed a').wrap('<div class="instagram-img col-xs-6 col-md-3"></div>');

	  }, 10000);
});

</script>
