<?php
/* ==========================================================================
	Code
   ========================================================================== */

	if( get_row_layout() == 'code_area' ): ?>

	<div <?php if ( get_sub_field( 'element_id' ) !== '' ) : ?>id="<?php the_sub_field( 'element_id' );?>" <?php endif; ?> class="row <?php App\echoBootstrapHidden(); ?>">

		<?php
			if ( get_sub_field('run_or_display' ) == 'display') :

				$code = '<pre class="col-xs-12 pre-scrollable">'.get_sub_field( 'your_code' ).'</pre>';

				echo $code;

			elseif ( get_sub_field( 'run_or_display' ) == 'run' ) : ?>
			<section class="column_code_area col-xs-12">
				<?php the_sub_field( 'your_code' ); ?>
			</section>
		<?php endif; ?>

	</div>

<?php endif; ?>
