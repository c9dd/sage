<div class="page content row">
    <article <?php post_class('col-xs-12 '.$cssClass);?>>
      <div class="row">
        <header class="col-xs-12">
          <?php get_template_part( 'partials/page-header' ); ?>
        </header>
        <?php
        // Find the editor type we are using here
        $editorType = get_field( 'select_content_editor' );

        // If we have no 'traditional' WordPress content, we are using ACF
        if ( $editorType == 'flexi' && !get_the_content() )
        {
          get_template_part( 'templates/layouts/content-layout-pages' );
        }
        // If not then we look for traditional WordPress content
        elseif ( $editorType == 'flexi' && get_the_content() )
        {
        ?>
        <div class="element-contents flexi_content wp_content col-xs-12">
          <?php the_content(); ?>
        </div>
        <?php
        }
        // Catch all
        else
        {
        ?>
        <div class="element-contents wp_content col-xs-12">
          <?php the_content(); ?>
        </div>
        <?php
        }
        ?>
        <footer>
          <?php wp_link_pages( ['before' => '<nav class="page-nav"><p>' . __('Pages:', 'sage'), 'after' => '</p></nav>'] ); ?>
        </footer>
        <section class="element-comments comments col-xs-12" role="document">
          <?php comments_template( '/templates/partials/comments.php' ); ?>
        </section>
      </div>
    </article>
</div>
