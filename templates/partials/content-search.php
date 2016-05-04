<article <?php post_class(); ?>>
  <header>
    <?php get_template_part( 'partials/page-header' ); ?>
    <?php
    if ( get_post_type() === 'post' )
    { 
      get_template_part( 'partials/entry-meta' );
    }
    ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
</article>
