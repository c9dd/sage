<?php
$randomString = App\generateRandomString();


	/* ==========================================================================
		Layout Page Contents
	   ========================================================================== */

		if(get_row_layout() == 'page_contents'): ?>
	<div <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?> class="row multi-column page-contents <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>" >
			<section class="column_two page-contents-block col-xs-12 col-md-4 col-md-push-8 last-column" style="margin-top: <?php the_sub_field('column_two_add_margin_to_the_top'); ?>px">

				<div class="row">
					<div class="col-xs-12">
						<h3 class="block-title">
						<?php _e('On this page'); ?>
						</h3>
					</div>

					<div class="col-xs-12">
						<ul>
						<?php

						// check if the repeater field has rows of data
						if( have_rows('column_two_25_page_contents') ):

						 	// loop through the rows of data
						    while ( have_rows('column_two_25_page_contents') ) : the_row();

								$linkType = get_sub_field('pc_link_type');
								$linkText = get_sub_field('pc_link_text');

								if ( $linkType == 'jump' ) {

									$link		= '#'.get_sub_field('pc_section_id');

								} elseif ( $linkType == 'internal' ) {

									$link 		= get_sub_field('pc_internal_link');

								} elseif ( $linkType == 'external' ) {

									$target 	= 'target="_blank"';
									$link 		= get_sub_field('pc_external_link');

								}

								?>
								<li class="<?=$linkType?>"><a href="<?=$link;?>" <?=$target;?>><?=$linkText;?></a></li>
								<?php

						    endwhile;

						endif;
						?>
						</ul>
					</div>
					<?php if ( get_sub_field('pc_booking_link') ) { ?>
					<a href="<?php the_sub_field('pc_booking_link_address'); ?>" class="btn btn-danger pc-booking-link"><?php _e('Book');?></a>
					<?php } ?>
				</div>
			</section>

			<section class="column_one<?php if (get_sub_field('column_one_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-8 col-md-pull-4 first-column" style="margin-top: <?php the_sub_field('column_one_add_margin_to_the_top'); ?>px">
				<?php the_sub_field('column_one_75'); ?>
			</section>

	</div>



	<?php
	/* ==========================================================================
		Layout 1 column
	   ========================================================================== */

		elseif(get_row_layout() == 'one_column'):

			if ( get_sub_field ('animate_elements') ) {
				$animateElementsClass 	= 'animate-elements';
				$animateElements 		= 'data-animate="true" ';
				$animateElement1 		= 'data-animation-type="'. get_sub_field("column_one_section_animation") . '"';
			}

		?>

	<div <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?> class="multi-column one_column row <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>" >
			<section class="column_one<?php if (get_sub_field('column_one_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-sm-12 col-md-12 col-lg-12 first-column" style="margin-top: <?php the_sub_field('column_one_add_margin_to_the_top'); ?>px" <?= $animateElements.$animateElement1; ?>>
				<?php the_sub_field('column_one'); ?>
			</section>
	</div>


		<?php
		/* ==========================================================================
			Layout 2 columns
		   ========================================================================== */

		elseif(get_row_layout() == 'two_columns'):

			if ( get_sub_field ('animate_elements') ) {
				$animateElementsClass 	= 'animate-elements';
				$animateElements 		= 'data-animate="true" ';
				$animateElement1 		= 'data-animation-type="'. get_sub_field("column_one_section_animation") . '"';
				$animateElement2 		= 'data-animation-type="'. get_sub_field("column_two_section_animation") . '"';
			}

		?>

	<div <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?> class="row multi-column two_columns <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>" >
			<section class="column_one<?php if (get_sub_field('column_one_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-sm-6 first-column" style="margin-top: <?php the_sub_field('column_one_add_margin_to_the_top'); ?>px" <?= $animateElements.$animateElement1; ?>>
				<?php the_sub_field('column_one'); ?>
			</section>

			<section class="column_two col-xs-12 col-sm-6 last-column"  style="margin-top: <?php the_sub_field('column_two_add_margin_to_the_top'); ?>px" <?= $animateElements.$animateElement2; ?>>
				<?php the_sub_field('column_two'); ?>
			</section>
	</div>


		<?php
		/* ==========================================================================
			Layout 2 columns 25% - 75%
		   ========================================================================== */

		elseif(get_row_layout() == 'two_columns_25_75'):

			if ( get_sub_field ('animate_elements') ) {
				$animateElementsClass 	= 'animate-elements';
				$animateElements 		= 'data-animate="true" ';
				$animateElement1 		= 'data-animation-type="'. get_sub_field("column_one_section_animation") . '"';
				$animateElement2 		= 'data-animation-type="'. get_sub_field("column_two_section_animation") . '"';
			}

		?>

	<div <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?> class="row multi-column two_columns_25_75 <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>" >
			<section class="column_one<?php if (get_sub_field('column_one_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-4 first-column" style="margin-top: <?php the_sub_field('column_one_add_margin_to_the_top'); ?>px"data-animation-type="<?php the_sub_field('column_one_section_animation'); ?>" <?= $animateElements.$animateElement1; ?>>
				<?php the_sub_field('column_one_25'); ?>
			</section>

			<section class="column_two<?php if (get_sub_field('column_two_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-8 last-column" style="margin-top: <?php the_sub_field('column_two_add_margin_to_the_top'); ?>px"data-animation-type="<?php the_sub_field('column_two_section_animation'); ?>" <?= $animateElements.$animateElement2; ?>>
				<?php the_sub_field('column_two_75'); ?>
			</section>
	</div>


		<?php
		/* ==========================================================================
			Layout 2 columns 75% - 25%
		   ========================================================================== */

		elseif(get_row_layout() == 'two_columns_75_25'):

			if ( get_sub_field ('animate_elements') ) {
				$animateElementsClass 	= 'animate-elements';
				$animateElements 		= 'data-animate="true" ';
				$animateElement1 		= 'data-animation-type="'. get_sub_field("column_one_section_animation") . '"';
				$animateElement2 		= 'data-animation-type="'. get_sub_field("column_two_section_animation") . '"';
			}

		?>
	<div <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?> class="row multi-column two_columns_75_25 <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>" >
			<section class="column_one<?php if (get_sub_field('column_one_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-8 first-column" style="margin-top: <?php the_sub_field('column_one_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_one_section_animation'); ?>" <?= $animateElements.$animateElement1; ?>>
				<?php the_sub_field('column_one_75'); ?>
			</section>

			<section class="column_two<?php if (get_sub_field('column_two_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-4 last-column" style="margin-top: <?php the_sub_field('column_two_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_two_section_animation'); ?>" <?= $animateElements.$animateElement2; ?>>
				<?php the_sub_field('column_two_25'); ?>
			</section>
	</div>


		<?php
		/* ==========================================================================
			Layout 3 columns
		   ========================================================================== */

		elseif(get_row_layout() == 'three_columns'):

			if ( get_sub_field ('animate_elements') ) {
				$animateElementsClass 	= 'animate-elements';
				$animateElements 		= 'data-animate="true" ';
				$animateElement1 		= 'data-animation-type="'. get_sub_field("column_one_section_animation") . '"';
				$animateElement2 		= 'data-animation-type="'. get_sub_field("column_two_section_animation") . '"';
				$animateElement3 		= 'data-animation-type="'. get_sub_field("column_three_section_animation") . '"';
			}

		?>

	<div <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?> class="row multi-column three_columns <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>" >
			<section class="column_one<?php if (get_sub_field('column_one_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-4 first-column" style="margin-top: <?php the_sub_field('column_one_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_one_section_animation'); ?>" <?= $animateElements.$animateElement1; ?>>
				<?php the_sub_field('column_one'); ?>
			</section>

			<section class="column_two<?php if (get_sub_field('column_two_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-4" style="margin-top: <?php the_sub_field('column_two_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_two_section_animation'); ?>" <?= $animateElements.$animateElement2; ?>>
				<?php the_sub_field('column_two'); ?>
			</section>

			<section class="column_three<?php if (get_sub_field('column_three_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-4 last-column" style="margin-top: <?php the_sub_field('column_three_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_three_section_animation'); ?>" <?= $animateElements.$animateElement3; ?>>
				<?php the_sub_field('column_three'); ?>
			</section>
	</div>


		<?php
		/* ==========================================================================
			Layout 3 columns 50% 25% 25%
		   ========================================================================== */

		elseif(get_row_layout() == 'three_columns_50_25_25'):

			/*
			$notVisibleOn = bootstapHidden();
			//print_r($notVisibleOn);
			$notVisibleOn = in_array( 'hidden-lg' , $notVisibleOn );

			if ( $deviceType == 'desktop' && $notVisibleOn ) {

			} else {
			*/


			if ( get_sub_field ('animate_elements') ) {
				$animateElementsClass 	= 'animate-elements';
				$animateElements 		= 'data-animate="true" ';
				$animateElement1 		= 'data-animation-type="'. get_sub_field("column_one_section_animation") . '"';
				$animateElement2 		= 'data-animation-type="'. get_sub_field("column_two_section_animation") . '"';
				$animateElement3 		= 'data-animation-type="'. get_sub_field("column_three_section_animation") . '"';
			}

		?>

	<div <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?> class="row multi-column three_columns <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>" >
			<section class="column_one<?php if (get_sub_field('column_one_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-6 first-column" style="margin-top: <?php the_sub_field('column_one_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_one_section_animation'); ?>" <?= $animateElements.$animateElement1; ?>>
				<?php the_sub_field('column_one'); ?>
			</section>

			<section class="column_two<?php if (get_sub_field('column_two_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-3" style="margin-top: <?php the_sub_field('column_two_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_two_section_animation'); ?>" <?= $animateElements.$animateElement2; ?>>
				<?php the_sub_field('column_two'); ?>
			</section>

			<section class="column_three<?php if (get_sub_field('column_three_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-3 last-column" style="margin-top: <?php the_sub_field('column_three_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_three_section_animation'); ?>" <?= $animateElements.$animateElement3; ?>>
				<?php the_sub_field('column_three'); ?>
			</section>
	</div>

		<?php /* } */
		/* ==========================================================================
			Layout 3 columns 25% 25% 50%
		   ========================================================================== */

		elseif(get_row_layout() == 'three_columns_50_25_25'):

			if ( get_sub_field ('animate_elements') ) {
				$animateElementsClass 	= 'animate-elements';
				$animateElements 		= 'data-animate="true" ';
				$animateElement1 		= 'data-animation-type="'. get_sub_field("column_one_section_animation") . '"';
				$animateElement2 		= 'data-animation-type="'. get_sub_field("column_two_section_animation") . '"';
				$animateElement3 		= 'data-animation-type="'. get_sub_field("column_three_section_animation") . '"';
			}

		?>

	<div <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?> class="row multi-column three_columns <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>" >
			<section class="column_one<?php if (get_sub_field('column_one_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-3 first-column" style="margin-top: <?php the_sub_field('column_one_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_one_section_animation'); ?>" <?= $animateElements.$animateElement1; ?>>
				<?php the_sub_field('column_one'); ?>
			</section>

			<section class="column_two<?php if (get_sub_field('column_two_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-3" style="margin-top: <?php the_sub_field('column_two_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_two_section_animation'); ?>" <?= $animateElements.$animateElement2; ?>>
				<?php the_sub_field('column_two'); ?>
			</section>

			<section class="column_three<?php if (get_sub_field('column_three_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-6 last-column" style="margin-top: <?php the_sub_field('column_three_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_three_section_animation'); ?>" <?= $animateElements.$animateElement3; ?>>
				<?php the_sub_field('column_three'); ?>
			</section>
	</div>


		<?php
		/* ==========================================================================
			Layout 4 columns
		   ========================================================================== */

		elseif(get_row_layout() == 'four_columns'):

			if ( get_sub_field ('animate_elements') ) {
				$animateElementsClass 	= 'animate-elements';
				$animateElements 		= 'data-animate="true" ';
				$animateElement1 		= 'data-animation-type="'. get_sub_field("column_one_section_animation") . '"';
				$animateElement2 		= 'data-animation-type="'. get_sub_field("column_two_section_animation") . '"';
				$animateElement3 		= 'data-animation-type="'. get_sub_field("column_three_section_animation") . '"';
				$animateElement3 		= 'data-animation-type="'. get_sub_field("column_four_section_animation") . '"';
			}

		?>
	<div <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?> class="row multi-column four_columns <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>" >
			<section class="column_one<?php if (get_sub_field('column_one_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-3 first-column" style="margin-top: <?php the_sub_field('column_one_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_one_section_animation'); ?>" <?= $animateElements.$animateElement1; ?>>
				<?php the_sub_field('column_one'); ?>
			</section>

			<section class="column_two<?php if (get_sub_field('column_two_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-3" style="margin-top: <?php the_sub_field('column_two_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_two_section_animation'); ?>" <?= $animateElements.$animateElement2; ?>>
				<?php the_sub_field('column_two'); ?>
			</section>

			<section class="column_three<?php if (get_sub_field('column_three_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-3" style="margin-top: <?php the_sub_field('column_three_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_three_section_animation'); ?>" <?= $animateElements.$animateElement3; ?>>
				<?php the_sub_field('column_three'); ?>
			</section>

			<section class="column_four<?php if (get_sub_field('column_four_start_with_drop_cap') == 'true') { echo ' dropcap'; } ?> col-xs-12 col-md-3 last-column" style="margin-top: <?php the_sub_field('column_four_add_margin_to_the_top'); ?>px" data-animation-type="<?php the_sub_field('column_four_section_animation'); ?>" <?= $animateElements.$animateElement4; ?>>
				<?php the_sub_field('column_four'); ?>
			</section>
	</div>

	<?php endif; ?>
