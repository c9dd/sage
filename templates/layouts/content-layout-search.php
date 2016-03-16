<?php while (have_rows('layout_elements')): the_row(); ?>
<section class="container">
	<?php get_template_part('templates/elements/content', 'element-calls'); ?>
</section>
<?php endwhile; ?>

<section class="container">
	<div class="col-xs-12">
	<?php get_search_form(); ?>
	</div>
</section>