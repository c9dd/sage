<?php
/* ==========================================================================
	Testimonial
   ========================================================================== */

   $randomString = App\generateRandomString();
   if ( get_sub_field ('animate_elements') ) {
		$animateElementsClass 	= 'animate-elements';
		$animateElements 		= 'data-animate="true" ';
		$animateElement1 		= 'data-animation-type="'. get_sub_field("section_animation_1") . '"';
		$animateElement2 		= 'data-animation-type="'. get_sub_field("section_animation_2") . '"';
		$animateElement3 		= 'data-animation-type="'. get_sub_field("section_animation_3") . '"';
		$animateElement4 		= 'data-animation-type="'. get_sub_field("section_animation_4") . '"';
	}
?>

<div <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?>class="container content <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="testimonials">
            	<div class="active item">
                  <blockquote <?= $animateElements.$animateElement1; ?>><?php the_sub_field('quote'); ?></blockquote>
                  <div class="carousel-info">
                    <img alt="" src="<?php the_sub_field('profile_pic'); ?>" class="pull-left" <?= $animateElements.$animateElement2; ?>>
                    <div class="pull-left">
                      <span class="testimonials-name" <?= $animateElements.$animateElement3; ?>><?php the_sub_field('name'); ?></span>
                      <span class="testimonials-post" <?= $animateElements.$animateElement4; ?>><?php the_sub_field('title'); ?></span>
                    </div>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
