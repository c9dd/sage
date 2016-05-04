<?php get_template_part( 'partials/page-header' ); ?>

<?php if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it. ?>

	<div class="container-fluid">
		<div class="row">
			<div class="col-xs-12">
					<?php the_post_thumbnail(); ?>
			</div>
		</div>
	</div>
<?php } ?>
<div class="page content">
	<div class="row">
<?php while ( have_posts() ) : the_post(); ?>
		<article <?php post_class( 'col-xs-12 '.$cssClass );?>>
			<div class="container">
		    <div class="row entry-content">
  				<div class="element-contents col-xs-12" role="document">
						<div class="row">
							<div class="card card-block text-xs-center col-xs-12 col-md-6 col-md-offset-3">
								<?php
									if ( !empty( $post->post_title ) )
									{
										$attachmentTitle = get_the_title();
									}
									else
									{
										$attachmentTitle = basename( $post->guid );
									}

									$fileType     = App\get_file_type_for_attachment( $post->id );
									$fileTypeIcon = App\get_icon_for_attachment( $post->id );


									if ( wp_attachment_is_image( $post->id ) )
									{
										$att_image 		= wp_get_attachment_image_src( $post->id, 'full');
										$images      	= array();
										$image_sizes 	= get_intermediate_image_sizes();
										array_unshift( $image_sizes, 'full' );
										foreach( $image_sizes as $image_size ) {
											$image    	= wp_get_attachment_image_src( get_the_ID(), $image_size );
											$name     	= $image_size . ' (' . $image[1] . 'x' . $image[2] . ')';
											$images[] 	= '<a class="dropdown-item btn btn-danger" target="_blank" href="' . $image[0] . '" rel="attachment">' . $name . '</a>';
										}
								?>
								<img src="<?php echo $att_image[0];?>" width="<?php echo $att_image[1]; ?>" height="<?php echo $att_image[2]; ?>" class="card-img-top" alt="<?php $post->post_excerpt; ?>" />
								<?php
								}
								else
								{
								?>
								<p class="attachment file-icon">
									<?php echo $fileTypeIcon; ?>
								</p>
								<?php
								}
								?>
								<div class="card-block">
									<h4 class="card-title"><?php echo $attachmentTitle; ?></h4>
									<p class="card-text"><?php echo strip_tags( apply_filters ( 'the_excerpt', $post->post_excerpt ) ); ?></p>
									<?php
									if ( wp_attachment_is_image( $post->id ) )
									{
									?>
									<div class="dropdown">
										<button class="btn btn-danger dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
											<i class="fa fa-cloud-download" aria-hidden="true"></i> <?php _e( 'Download &quot;'. $attachmentTitle . '&quot; in these sizes as '. $fileType . ' ' . $fileTypeIcon ,'startertheme' ); ?>
										</button>
										<div class="dropdown-menu" aria-labelledby="dropdownMenu1">
											<?php echo implode( '', $images ); ?>
										</div>
									</div>
									<?php
									}
									else
									{
									?>
									<p class="card-text">
										<a href="<?php echo wp_get_attachment_url( $post->ID ) ?>" class="btn btn-danger" target="_blank" title="<?php echo wp_specialchars( get_the_title( $post->ID ), 1 ) ?>" rel="attachment"><i class="fa fa-cloud-download" aria-hidden="true"></i> <?php _e( 'Download ','startertheme' ); ?> <?php echo $attachmentTitle . ' as '. $fileType . ' ' . $fileTypeIcon; ?> </a>
									</p>
									<?php
									}
									?>
									<hr/>
									<div class="alert alert-info" role="alert">
										<?php _e('<strong>Please Note</strong> : Making a selection from above may open a new tab / window. If this does happen please right click on the image in that tab / window and select &quot;Save as&quot; to save it to your device.', 'startertheme'); ?>
									</div>
								</div>
							</div>
						</div>
  				</div><!-- /.wrap -->
		    </div>

				<?php
					if ( get_field('options_pages_allow_comments', 'option') )
					{
				?>
				<div class="row entry-content">
					<section class="element-comments comments col-xs-12" role="document">
	          <?php comments_template('/templates/partials/comments.php'); ?>
	        </section>
				</div>
				<?php
					}
				?>
			    <footer>
					<?php get_template_part( 'templates/elements/content', 'element-share-buttons' ); ?>

					<?php wp_link_pages( ['before' => '<nav class="page-nav"><p>' . __( 'Pages:', 'startertheme' ), 'after' => '</p></nav>'] ); ?>
			    </footer>
	      </div>
		</article>
<?php endwhile; ?>
	</div>
</div>
