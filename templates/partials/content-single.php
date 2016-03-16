<div class="page content">

	<div class="row">

		<article <?php post_class('col-xs-12 '.$cssClass);?> >
			<div class="row">

				<?php

					$editorType = get_field('select_content_editor');

					// If we have no 'traditional' WordPress content, we are using ACF
					if ( $editorType == 'flexi' && !get_the_content() ) {

						get_template_part('templates/layouts/content-layout-pages');

					// If not then we look for traditional WordPress content
					} elseif ( $editorType == 'flexi' && get_the_content() ) { ?>

				<div class="element-contents wp_content col-xs-12">
					<?php the_content(); ?>
					<!-- /.content -->
				</div><!-- /.wrap -->

				<? } else { ?>

				<div class="element-contents wp_content col-xs-12">
					<?php the_content(); ?>
					<!-- /.content -->
				</div><!-- /.wrap -->

				<?php } ?>
				<div class="element-comments col-xs-12" role="document">
					<?php
						// load the comments template
            comments_template('/templates/partials/comments.php');
					?>
				</div>
			</div>
		</article>
	</div>
</div>
