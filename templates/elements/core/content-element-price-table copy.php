<?php
/* ==========================================================================
	Price Tables
   ========================================================================== */
?>
<div <?php if (get_sub_field('element_id') !== '') : ?>id="<?php the_sub_field('element_id');?>" <?php endif;?> class="table-container <?php App\echoBootstrapHidden(); ?>">
<?php
$table = get_sub_field( 'price_table' );

if ( $table ) {

	if ( get_sub_field( 'price_table_title' ) ) { ?>


		<div class="row">
			<div class="col-xs-12">
				<h3 class="block-title">
				<?php the_sub_field( 'price_table_title' ); ?>
				</h3>
			</div>
		</div>

	<?php }

	if ( get_sub_field( 'price_show_table_header_extras' ) ) { ?>

		<div class="row">
			<div class="col-xs-12 price table-header-extras">
			<?php the_sub_field( 'price_table_header_extras' ); ?>
			</div>
		</div>

	<?php } ?>

    	<div class="row">
			<div class="col-xs-12">
				<table class="table table-striped" border="0">

		        <?php if ( $table['header'] ) { ?>

		            <thead>

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
	if ( get_sub_field( 'price_show_table_footer_extras' ) ) { ?>

		<div class="row">
			<div class="col-xs-12 price footer-table-extras">
				<?php get_sub_field( 'price_table_footer_extras' ); ?>
			</div>
		</div>

	<?php }

	if ( get_sub_field( 'price_table_link_url' ) ) { ?>

		<div class="row">
			<div class="col-xs-12 price table-link">
				<a class="block-signoff" href="<?= get_sub_field('price_table_link_url');?>"><?= get_sub_field('price_table_link_text'); ?></a>
			</div>
		</div>

	<?php }

}
?>
</div>
<div class="row">
	<section class="col-xs-12 cta call">
		<p class="text">
			<?php

			if ( get_sub_field( 'price_table_link_url' ) ) { _e('Or call us on', 'stc2015'); }
			else { _e('Call us on', 'stc2015'); }
			?>
		</p>
		<p class="tel"><?php the_field('main_telephone_number', 'option'); ?></p>
	</section>
</div>
