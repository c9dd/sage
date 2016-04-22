<?php
/* ==========================================================================
	Share buttons
   ========================================================================== */
if ( !is_front_page() ) { ?>
<span class="<?php App\echoBootstrapHidden(); ?>"
	<hr>

	<div class="row">
		<div class="col-xs-12 socicon-label" >
			<h6><?php _e('Share this on ...', 'stc2015') ?></h6>
		</div>
	</div>
	<div class="row">
		<div id="facebook" class="col-xs-3 col-md-2 col-md-offset-2 socicon socicon-facebook" data-url="<?php echo get_permalink(); ?>" data-toggle="tooltip" data-placement="top" data-title="Facebook">
			<a href="http://www.facebook.com/share.php?u=<?php echo get_permalink(); ?>&title=STC-<?php echo get_the_title(); ?>" class="box" target="_blank"><span class="share"><?php _e('Facebook', 'stc2015'); ?></span></a>
		</div>

		<div id="twitter" class="col-xs-3 col-md-2 socicon socicon-twitter" data-url="<?php echo get_permalink(); ?>" data-toggle="tooltip" data-placement="top" data-title="Twitter">
			<a href="http://twitter.com/home?status=STC-<?php echo get_the_title(); ?>+<?php echo get_permalink(); ?>" class="box" target="_blank"><span class="share"><?php _e('Twitter', 'stc2015'); ?></span></a>
		</div>

		<div id="googleplus" class="col-xs-3 col-md-2 socicon socicon-google-plus" data-toggle="tooltip" data-placement="top" data-title="Google+" >
			<a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>" class="box" target="_blank" ><span class="share"><?php _e('Google+', 'stc2015'); ?></span></a>
		</div>

		<div id="pinterest" class="col-xs-3 col-md-2 socicon socicon-pinterest" data-url="<?php echo get_permalink(); ?>" data-title="Pinterest" data-toggle="tooltip" data-placement="top">
			<a href="http://pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>&media=<?php echo $image_link; ?>&description=STC-<?php echo get_the_title(); ?>" class="box" target="_blank"><span class="share"><?php _e('Pinterest', 'stc2015'); ?></span></a>
		</div>
	</div>
</span>
<?php } ?>
