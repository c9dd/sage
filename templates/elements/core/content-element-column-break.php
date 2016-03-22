<?php
/* ==========================================================================
	Row brake / spacer
	was column break
   ========================================================================== */
// OLD - the_sub_field('column_break');
// NEW - the_sub_field('row_break');

?>
<div class="row-break <?php App\echoBootstrapHidden(); ?>" style="height: <?php the_sub_field('row_break') ?>px">
</div>
