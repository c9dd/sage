<?php
/* ==========================================================================
	Layout Heading Area
   ========================================================================== */
	if(get_row_layout() == "heading_area"): ?>

	<div class="row heading_area <?php App\echoBootstrapHidden(); ?>">
			<section class="col-xs-12" style="margin-top: <?php the_sub_field('heading_area_add_margin_to_the_top'); ?>px">
				<h1><?php the_sub_field('main_heading'); ?></h1>

				<h2><?php the_sub_field('sub_heading'); ?></h2>
			</section>
	</div>
<?php endif; ?>
