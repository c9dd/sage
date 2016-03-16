<?php while (have_rows('layout_elements')): the_row(); ?>
	<?php get_template_part('templates/elements/content', 'element-calls'); ?>
<?php endwhile; ?>