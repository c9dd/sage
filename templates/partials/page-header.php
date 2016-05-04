<?php
// Show the page title if set OR if this is an attachment page
if( get_field('show_page_title') == 'true' || is_attachment() )
{
?>
<div class="container">
	<?php
  if ( function_exists('yoast_breadcrumb') )
  {
  ?>
	<div id="breadcrumbs" class="col-xs-12">
		<?php yoast_breadcrumb('<p>','</p>'); ?>
	</div>
	<?php
  }
  ?>
	<div class="col-xs-12 page-header">
		<div class="row">
			<div class="col-xs-12 page-title">
				<h1><?= App\title(); ?></h1>
				<?php
        if ( is_single() )
        {
          get_template_part('templates/entry-meta');
        }
        ?>
			</div>
		</div>
	</div>
</div>
<?php
}
?>
