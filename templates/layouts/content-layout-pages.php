<?php while (have_rows('flexi_layouts')): the_row(); ?>
	<?php get_template_part('templates/elements/content', 'element-calls'); ?>
<?php endwhile; ?>
