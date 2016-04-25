<?php
/* ==========================================================================
	Row brake / spacer
	was column break
   ========================================================================== */

while( have_rows('row_break_spacer') ) : the_row();
?>
<div class="row-break <?php App\echoBootstrapHidden(); ?>" style="height: <?php the_sub_field('row_break_spacer_height') ?>px">
</div>
<?php
endwhile;
?>
