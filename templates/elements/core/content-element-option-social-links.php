<?php
/* ==========================================================================
	Accordion
   ========================================================================== */
?>

<div class="panel-group <?php App\echoBootstrapHidden(); ?>" id="accordion">
	<div class="panel panel-default">
	<?php if( have_rows('panel') ): ?>

	<?php while ( have_rows('panel') ) : the_row();

			// Make the label lowercase & strip white space from it
			$raw_label = get_sub_field('panel_label');

			$label_lower_case = strtolower($raw_label);

			$label_lower_case_no_white_space = str_replace(' ', '', $label_lower_case);

			$label_lower_case_no_white_space_no_specials = preg_replace("/[^a-zA-Z0-9]+/", "", $label_lower_case_no_white_space);

			$panel_id = $label_lower_case_no_white_space_no_specials;

		?>
		<div class="panel-heading">
	      <h4 class="panel-title">
	        <a data-toggle="collapse" data-parent="#accordion" href="#<?php echo $panel_id; ?>">
	          <?php the_sub_field('panel_label'); ?>
	        </a>
	      </h4>
	    </div>

	    <div id="<?php echo $panel_id; ?>" class="panel-collapse collapse<?php if ( get_sub_field('selected')) : ?> in<?php endif; ?>">
	      <div class="panel-body">
	        <?php the_sub_field('panel_content'); ?>
	      </div>
	    </div>

	<?php endwhile; ?>

	<?php endif; ?>
	</div>
</div>
