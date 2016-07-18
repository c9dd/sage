<!doctype html>
<html <?php language_attributes(); ?>>
  <?php get_template_part('partials/head'); ?>
  <body <?php body_class(); ?>>
    <!--[if IE]>
      <div class="alert alert-warning">
        <?php _e('You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.', 'startertheme'); ?>
      </div>
    <![endif]-->
    <?php
      do_action('get_header');
      get_template_part('partials/header');

      if( get_field('background_colour') )
      {
        $cssClass = 'background-color-is-set';
      }
    ?>
    <div class="wrap primary container" role="document">
      <div class="content row">
        <main class="main">
          <div class="col-xs-12 content-wrapper"<?php if( get_field('display_background_image') ) : ?>
          style="
            <?php 	if(get_field('background_colour')) : ?>	background: <?php the_field('background_colour'); ?>; 							<?php endif; ?>

            <?php 	if(get_field('background_image') && get_field('image_repeat')) : ?>		background-repeat: <?php the_field('image_repeat'); ?>;							<?php endif; ?>

            <?php 	if(get_field('background_image')) : ?>	background-image: url('<?php the_field("background_image"); ?>'); 				<?php endif; ?>

            <?php 	// Image size
                $imagePosition 	= get_field('image_position');
                $imageSize 		= get_field('image_size');
                if (get_field('background_image') && $imageSize !='--' && $imagePosition = '--') : ?>	background-size: <?php the_field('image_size'); ?>;


            <?php 	// Image position
                $imagePosition = get_field('image_position');
                elseif(get_field('background_image') && $imageSize = '--' && $imagePosition != '--' && $imagePosition != 'value') : ?>
                                    background-position: <?php the_field('image_position'); ?>;
                <?php
                elseif (get_field('background_image') && $imagePosition = 'value') : ?>
                                    background-position: <?php the_field('position_top');?>  <?php the_field('position_left');?>;
                <?php

                endif;
            ?>

            <?php 	if(get_field('background_image') && get_field('image_attachment')) :?>	background-attachment: <?php the_field('image_attachment'); ?>;

            <?php 	endif; ?>
          "
          <?php endif; ?>>
            <?php include App\template()->main(); ?>
          </div>
        </main><!-- /.main -->
        <?php if (App\display_sidebar()) : ?>
          <aside class="sidebar">
            <?php App\template_part('partials/sidebar'); ?>
          </aside><!-- /.sidebar -->
        <?php endif; ?>
      </div><!-- /.content -->
    </div><!-- /.wrap -->
    <?php
      do_action('get_footer');
      get_template_part('partials/footer');
    ?>

    <script>
      jQuery.noConflict();
      jQuery( document ).ready(function( $ ) {
        // NOTE:
        // Activate material design and set a class to check against when needed

        // $.material.init()
        // $('body').addClass('material-design-active');

      });
    </script>
    <?php
      wp_footer();

      // NOTE:
      // If UPUP is active within the options page
      // UPUP requires an SSL Cert to work https://www.talater.com/upup/
      if( get_field('activate_upup', 'option') )
      {
      ?>

      <script src="<?= get_template_directory_uri(); ?>/dist/scripts/upup.min.js"></script>
      <script src="<?= get_template_directory_uri(); ?>/dist/scripts/upup.sw.min.js"></script>
      <script>
        /*
        UpUp.start({
          'content-url': ['<?php
          $upupPages = get_field('upup_pages', 'option');	// Get the pages selected on the theme options page
          echo current($upupPages) . "', '";				// Between pages
          echo end($upupPages);							// Last page
        ?>'],

          'assets': ['<?= get_template_directory_uri(); ?>/dist/images/logo.png', '<?= get_template_directory_uri(); ?>/dist/styles/main.css', '<?= get_template_directory_uri(); ?>/dist/scripts/main.js' <?php if ( get_field('upup_assets', 'option') ) { echo ', ' . get_field('upup_assets', 'option'); } ?> ]

        });
        */
      </script>
    <?php
      }
    ?>
  </body>
</html>
