<?php
while (have_posts()) : the_post();
  if( get_field('show_page_title') == 'false' ) {
    // get_template_part('templates/page', 'header');
  } elseif( get_field('show_page_title') == 'true' ) {
    get_template_part('partials/page-header');
  } else {
    get_template_part('partials/page-header');
  }
  get_template_part('partials/content-single');
endwhile;
?>
