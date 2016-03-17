<?php
/* ==========================================================================
	Tabs
   ========================================================================== */

   $randomString = App\generateRandomString();
   if ( get_sub_field ('animate_elements') ) {
		$animateElementsClass 	= 'animate-elements';
		$animateElements 		= 'data-animate="true" ';
		$animateElement1 		= 'data-animation-type="'. get_sub_field("section_animation_1") . '"';
	}

   	/*
	$a = get_sub_field('element_visible_on');
	print_r($a);
	*/
	// IF the tab locations is on the left or right then we to add an extra class to the ul
	if ( get_sub_field('layout_directions') 		== 'tabs-right' | 'tabs-left') {

		$layout_type 			= 'nav-stacked';

	}

	// We can set the class on the containing div to set the location of the tabs
	if ( get_sub_field('layout_directions') 		== 'tabs-top') 		{

		$layout_direction 		= 'tabs-top';

	} elseif ( get_sub_field('layout_directions') 	== 'tabs-right') 	{

		$layout_direction 		= 'tabs-right';

	} elseif ( get_sub_field('layout_directions') 	== 'tabs-bottom') 	{

		$layout_direction		= 'tabs-bottom';

	} elseif ( get_sub_field('layout_directions') 	== 'tabs-left') 	{

		$layout_direction 		= 'tabs-left';

	}

	if ( get_sub_field('layout_directions') 		== 'tabs-top' | 'tabs-bottom') {

		if ( get_sub_field('layout_styles') 		== 'justified') {

			$layout_styles 		= ' nav-justified';

		}

	}

	$random_number	= rand();

	?>

<div class="tabbable tabbable-<?php echo $random_number; ?> <?php echo $layout_direction; ?> <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>" role="tabpanel">
	<?php
	if( have_rows('tab') ) {
?>
	<ul id="<?php echo $unique_tab_id; ?>" class="nav nav-tabs <?php echo $layout_type . $layout_tab_size . $layout_styles;?>" <?= $animateElements.$animateElement1; ?>>
		<?php while ( have_rows('tab') ) : the_row();

			// Make the label lowercase & strip white space from it
			$raw_label 										= get_sub_field('tab_label');

			$label_lower_case 								= strtolower($raw_label);

			$label_lower_case_no_white_space 				= str_replace(' ', '', $label_lower_case);

			$label_lower_case_no_white_space_no_specials 	= preg_replace("/[^a-zA-Z0-9]+/", "", $label_lower_case_no_white_space);

			$tab_id 										= $label_lower_case_no_white_space_no_specials;

			$unique_tab_id 									= $tab_id . '_' . $random_number;

		?>
		<li class="<?php echo $tab_id; ?><?php if ( get_sub_field('selected')) : ?> active<?php endif; ?>"><a href="#<?php echo $unique_tab_id; ?>" class="tab-link"><?php the_sub_field('tab_label'); ?></a></li>
	<?php endwhile; ?>
	</ul>

	<?php } ?>

	<?php if( have_rows('tab') ) { ?>
	<div class="tab-content<?php echo $layout_content_size; ?> <?php echo $unique_tab_id; ?>" <?= $animateElements.$animateElement1; ?>>
		<?php while ( have_rows('tab') ) : the_row();

			// Make the label lowercase & strip white space from it
			$raw_label 										= get_sub_field('tab_label');

			$label_lower_case 								= strtolower($raw_label);

			$label_lower_case_no_white_space 				= str_replace(' ', '', $label_lower_case);

			$label_lower_case_no_white_space_no_specials 	= preg_replace("/[^a-zA-Z0-9]+/", "", $label_lower_case_no_white_space);

			$tab_id 										= $label_lower_case_no_white_space_no_specials;

			$unique_tab_id 									= $tab_id . '_' . $random_number;

		?>
	 	<div class="tab-pane fade<?php if ( get_sub_field('selected')) : ?> in active<?php endif; ?>" id="<?php echo $unique_tab_id; ?>">
			<?php the_sub_field('tab_content'); ?>
		</div>
		<?php endwhile; ?>
	</div>
<script>
	jQuery.noConflict();
	jQuery(document).ready(function($) {
		$('div.tabbable-<?php echo $random_number; ?> .nav-tabs a').click(function(e) {
			e.preventDefault();
			$(this).tab('show');
		});
	});
</script>
<?php } ?>
</div>
