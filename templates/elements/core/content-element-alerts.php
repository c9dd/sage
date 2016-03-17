<?php
/* ==========================================================================
	Alerts
   ========================================================================== */

		$alert_dismissable = '';

		if (get_sub_field('alert_colour') == 'blue') : $alert_type = 'info';

		elseif (get_sub_field('alert_colour') == 'green') : $alert_type = 'success';

		elseif (get_sub_field('alert_colour') == 'yellow') : $alert_type = 'warning';

		else : $alert_type = 'danger';
		endif;

		if(get_sub_field('alert_dismissable') == 'true') :
			$alert_dismissable = ' alert-dismissable';
		endif;

   $randomString = App\generateRandomString();
   if ( get_sub_field ('animate_elements') ) {
		$animateElementsClass 	= 'animate-elements';
		$animateElements 		= 'data-animate="true" ';
		$animateElement1 		= 'data-animation-type="'. get_sub_field("section_animation_1") . '"';
	}
?>
<div <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?> class="<?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>">
	<div class="alert alert-<?php echo $alert_type; echo $alert_dismissable; ?>" <?= $animateElements.$animateElement1; ?>>
		<?php if(get_sub_field('alert_dismissable') == 'true') { ?>
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
		<?php } ?>
		<?php the_sub_field('alert_message'); ?>
	</div>
</div>
