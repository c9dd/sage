<?php
/* ==========================================================================
	PayPal Forms
   ========================================================================== */

   $randomString = App\generateRandomString();
   if ( get_sub_field ('animate_elements') ) {
		$animateElementsClass 	= 'animate-elements';
		$animateElements 		= 'data-animate="true" ';
		$animateElement1 		= 'data-animation-type="'. get_sub_field("section_animation_1") . '"';
	}
?>

<div class="paypal-form <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>">
	<div <?= $animateElements.$animateElement1; ?>>
		<?php the_sub_field('paypal_form') ?>
	</div>
</div>
