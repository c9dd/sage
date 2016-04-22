<?php
/* ==========================================================================
	Tables
   ========================================================================== */

   $randomString = App\generateRandomString();
   if ( get_sub_field ('animate_elements') ) {
		$animateElementsClass 	= 'animate-elements';
		$animateElements 		= 'data-animate="true" ';
		$animateElement1 		= 'data-animation-type="'. get_sub_field("section_animation") . '"';
	}
?>

<div <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?> class="table-container col-xs-12 <?= $animateElementsClass; App\echoBootstrapHidden(); ?>" data-element-unique-id="<?= $randomString; ?>">
	<div <?= $animateElements.$animateElement1; ?>>
	<?php
	$table = get_sub_field( 'table' );

	if ( $table ) {

		if ( get_sub_field( 'table_title' ) ) { ?>


			<div class="row">
				<div class="col-xs-12">
					<h3 class="block-title">
					<?php the_sub_field( 'table_title' ); ?>
					</h3>
				</div>
			</div>

		<?php }

		if ( get_sub_field( 'show_table_header_extras' ) ) { ?>

			<div class="row">
				<div class="col-xs-12 table-header-extras">
				<?php the_sub_field( 'table_header_extras' ); ?>
				</div>
			</div>

		<?php } ?>

	    	<div class="row">
				<div class="col-xs-12">
					<table class="table table-striped table-hover" border="0" >

			        <?php if ( $table['header'] ) { ?>

			            <thead class="thead-default">

			                <tr>
								<?php
			                    foreach ( $table['header'] as $th ) {

			                        echo '<th>';
			                            echo $th['c'];
			                        echo '</th>';
			                    }
								?>
			                </tr>

			            </thead>

			        <?php } ?>

			        <tbody>
						<?php foreach ( $table['body'] as $tr ) { ?>

			                <tr>
								<?php
			                    foreach ( $tr as $td ) {

			                        echo '<td>';
			                            echo $td['c'];
			                        echo '</td>';
			                    }
								?>
			                </tr>
			           <?php } ?>

			        </tbody>

			    </table>
			    </div>
			</div>
	    <?php
		if ( get_sub_field( 'show_table_footer_extras' ) ) { ?>

			<div class="row">
				<div class="col-xs-12 footer-table-extras">
					<?php get_sub_field( 'table_footer_extras' ); ?>
				</div>
			</div>

		<?php }

		if ( get_sub_field( 'table_link_url' ) ) { ?>

			<div class="row">
				<div class="col-xs-12 table-link">
					<a class="block-signoff" href="<?= get_sub_field('table_link_url');?>"><?= get_sub_field('table_link_text'); ?></a>
				</div>
			</div>

		<?php }

	}
	?>
	</div>
</div>
