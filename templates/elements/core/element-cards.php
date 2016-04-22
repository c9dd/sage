<?php
/* ==========================================================================
	Cards
   ========================================================================== */

  $randomString = App\generateRandomString();

?>


<div class="row">
<?php
if( have_rows('card') )
{
  while ( have_rows('card') )
  {
    the_row();
    if( get_sub_field('card_sizing') )
    {
      $columnSize = get_sub_field('card_sizing');
    }
    if( get_sub_field('card_text_alignment') )
    {
      $cardTextAligment = get_sub_field('card_text_alignment');
    }
    if( get_sub_field('show_hidden') == true )
    {
      if ( !empty(get_sub_field('card_header')) )
      {
        $cardHeader = true;
      }
      else {
        $cardHeader = false;
      }
      if ( !empty(get_sub_field('card_footer')) )
      {
        $cardFooter = true;
      }
      else
      {
        $cardFooter = false;
      }
    }
    if ( get_sub_field ('animate_elements') )
    {
     $animateElementsClass  = 'animate-elements';
     $animateElements 		  = 'data-animate="true" ';
     $animateElement1 		  = 'data-animation-type="'. get_sub_field("section_animation_1") . '"';
    }


  ?>
  <div class="col-md-<?=$columnSize;?> <?=$animateElementsClass;?>">
    <div class="card text-xs-<?=$cardTextAligment;?>" data-element-unique-id="<?= $randomString; ?>" <?= $animateElements.$animateElement1; ?>>
      <?php
      if( $cardHeader == true )
      {
      ?>
        <div class="card-header">
          <h3><?php the_sub_field('card_header'); ?></h3>
        </div>
      <?php
      }
      // check if the flexible content field has rows of data
      if( have_rows('card_content') )
      {
        // loop through the rows of data
        while ( have_rows('card_content') )
        {
        the_row();

          if( get_row_layout() == 'card_content_image' )
          {
            $attachment_id = get_sub_field('card_image');

            // vars
            $img_src       = wp_get_attachment_image_url( $attachment_id, 'medium' );
            $img_srcset    = wp_get_attachment_image_srcset( $attachment_id, 'medium' );
            $alt           = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
          ?>
          <img srcset="<?=esc_attr( $img_srcset );?>" sizes="(max-width: 50em) 87vw, 680px"
          src="<?=esc_url( $img_src );?>" alt="<?=$alt;?>">
          <?php
          }
          if( get_row_layout() == 'card_content_titles' )
          {
          ?>
          <div class="card-block card-titles">
            <h4><?php the_sub_field('card_title'); ?></h4>
            <h6><?php the_sub_field('card_subtitle'); ?></h6>
          </div>
          <?php
          }
          if( get_row_layout() == 'card_content_text_area' )
          {
          ?>
          <div class="card-block card-ext-area">
            <?php the_sub_field('card_text_area'); ?>
          </div>
          <?php
          }
          if( get_row_layout() == 'card_content_button' )
          {
            $buttonColor        = get_sub_field('card_button_color');

            $buttonStateRaw     = get_sub_field('card_button_state');

            if ($buttonStateRaw == 'solid')
            {
              $buttonState      = '';
            }
            else
            {
              $buttonState = 'outline-';
            }
          ?>
          <div class="card-block card-content-button">
            <a href="<?php the_sub_field('card_button'); ?>" class="btn btn-<?php echo $buttonState; echo $buttonColor; ?>">Button</a>
          </div>
          <?php
          };
        };
      }
      else
      {
        // no layouts found
      }
      if( $cardFooter == true )
      {
      ?>
        <div class="card-footer text-muted">
          <p><?php the_sub_field('card_footer'); ?></p>
        </div>
      <?php
      }
    };
    ?>
    </div>
  </div>
  <?php
  };
?>
</div>
