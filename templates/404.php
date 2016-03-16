<?php get_template_part('partials/page-header'); ?>

<div class="alert alert-warning">
  <?php _e('Sorry, but it looks like we can\'t find what you\'re looking for.', 'startertheme'); ?>
</div>

<?php get_search_form(); ?>

<img src="<?php echo get_template_directory_uri(); ?>/dist/images/search.png" alt="search" class="pull-right"/>
