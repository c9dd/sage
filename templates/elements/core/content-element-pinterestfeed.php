<?php
/* ==========================================================================
	Pinterest Feed
   ========================================================================== */
?>

<div class="row pinterestfeed <?php App\echoBootstrapHidden(); ?>">

	<?php

		$pinterest_image_width	= get_sub_field('image_width');

		$pinterest_board_height	= get_sub_field('board_height');

		$pinterest_feed_type	= get_sub_field('pinterest_feed_type');

		if ($pinterest_feed_type == 'embedUser') :

			$pinterest_url	= get_sub_field('pinterest_user_url');

		elseif ($pinterest_feed_type == 'embedBoard') :

			$pinterest_url	= get_sub_field('pinterest_board_url');

		endif;

	?>
	<div class="col-xs-12 col-sm-12">
	<a data-pin-do="<?php echo $pinterest_feed_type; ?>" href="<?php echo $pinterest_url; ?>" data-pin-scale-width="<?php echo $pinterest_image_width; ?>" data-pin-scale-height="<?php echo $pinterest_board_height; ?>" data-pin-board-width="1170">Follow Pinterest's board Pin pets on Pinterest.</a>

	<!-- Please call pinit.js only once per page -->
	<script type="text/javascript" async src="//assets.pinterest.com/js/pinit.js"></script>
	</div>
</div>
