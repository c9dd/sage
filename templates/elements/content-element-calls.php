<?php
	use Roots\Sage\Config;
	use Roots\Sage\Extras;
?>
<!-- CORE ELEMENT CALLS -->

<?php while (have_rows('layout_elements')): the_row(); ?>
		<?php
		// If we need to display any of these fields...
		$layout_elements = array( 'page_contents', 'one_column', 'two_columns', 'two_columns_25_75', 'two_columns_75_25', 'three_columns', 'three_columns_50_25_25', 'three_columns_25_25_50', 'four_columns' );

		//	$layout = get_row_layout();
		//	print_r( $layout );

		if( in_array( get_row_layout(), $layout_elements ) ) :


		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-columns" role="document">
			<!--div class="content row"-->
			<div class="content row">
		    	<!--main class="main" role="main"-->
		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>

				<div class="col-xs-12">
					<?php get_template_part('templates/elements/core/content', 'element-columns');  ?>
				</div>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
				<!--/main><!-- /.main -->
			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->

		<?php
		// Layout for Code Area
		elseif(get_row_layout() == 'code_area'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-heading-area" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-code-area'); ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->




		<?php
		// Layout for Heading Area
		elseif(get_row_layout() == 'heading_area'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-heading-area" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-heading-area');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->


		<?php
		// Layout for column break
		elseif(get_row_layout() == 'column_break'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-column-break" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


			<?php get_template_part('templates/elements/core/content', 'element-column-break');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->


		<?php
		// Layout for Google Map
		elseif(get_row_layout() == 'google_map'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-google-map" role="document">
			<div class="content">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-google-map-v2');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->


		<?php
		// Layout for Alerts
		elseif(get_row_layout() == 'alerts'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-alerts" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-alerts');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->


		<?php
		// Layout for Cards
		elseif(get_row_layout() == 'cards'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-cards" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-cards');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->

		<?php
		// Layout for Tabs
		elseif(get_row_layout() == 'tabs_area'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-tabs" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-tabs');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->


		<?php
		// Layout for Testimonials
		elseif(get_row_layout() == 'testimonial'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-testimonial" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-testimonial');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->

		<?php
		// Layout for Accordion
		elseif(get_row_layout() == 'accordion_area'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-accordion" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-accordion');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->


		<?php
		// Layout for Jumbtron area
		elseif(get_row_layout() == 'jumbotron'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-jumbotron" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-jumbotron');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->


		<?php
		// Layout for instagram feed
		elseif(get_row_layout() == 'instagram_feed'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-instagramfeed" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-instagramfeed');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->


		<?php
		// Layout for Pinterest area
		elseif(get_row_layout() == 'pinterest_feed'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-pinterestfeed" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-pinterestfeed');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->


		<?php
		// Layout for Table area
		elseif(get_row_layout() == 'table_area'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-table-area" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-table');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->


		<?php
		// Layout for slider area
		elseif(get_row_layout() == 'slider_area'):
		?>
		<div class="element-slider" role="document">
		<?php get_template_part('templates/elements/core/content', 'element-slider');  ?>
		</div><!-- /.col-xs-12 -->

<!---->


		<?php
		// Layout for Trip Advisor block
		elseif(get_row_layout() == 'tripadvisor_block'):
		?>

		<div class="col-xs-12 element-tripadvisor-block element-contents" role="document">
		<?php get_template_part('templates/elements/core/content', 'element-tripadvisor-block');  ?>
		</div><!-- /.col-xs-12 -->


<!---->



		<?php
		// Layout for video area
		elseif(get_row_layout() == 'full_width_video'):
		?>

		<div class="col-xs-12 element-contents element-video" role="document">
		<?php get_template_part('templates/elements/core/content', 'element-video');  ?>
		</div><!-- /.col-xs-12 -->


<!---->


		<?php
		// Layout for fullscreen area
		elseif(get_row_layout() == 'fullscreen_area'):
		?>

		<div class="col-xs-12 element-contents element-fullscreen-area" role="document">
		<?php get_template_part('templates/elements/core/content', 'element-fullscreen-area');  ?>
		</div><!-- /.col-xs-12 -->


<!---->


		<?php
		// Layout for showcase area
		elseif(get_row_layout() == 'showcase_area'):
		?>

		<div class="col-xs-12 element-contents element-showcase-area" role="document">
		<?php get_template_part('templates/elements/core/content', 'element-showcase-area');  ?>
		</div><!-- /.col-xs-12 -->



<!---->


		<?php
		// Layout for paralax message area
		elseif(get_row_layout() == 'parallax_message_area'): ?>
		<div class="col-xs-12 element-contents element-parallax" role="document">
		<?php get_template_part('templates/elements/core/content', 'element-parallax');  ?>
		</div><!-- /.col-xs-12 -->


<!---->


		<?php
		// Layout for Social Timeline elements area
		elseif(get_row_layout() == 'social_timeline_elements_area'): ?>
		<div class="col-xs-12 element-contents element-social-timeline" role="document">
		<?php get_template_part('templates/elements/custom/content', 'element-social-timeline');  ?>
		</div><!-- /.col-xs-12 -->


<!---->


		<?php
		// Layout for PayPal Forms type block area
		elseif(get_row_layout() == 'paypal_forms'):
		?>

		<div class="col-xs-12 forcontent element-contents element-paypal-form-blocks" role="document">
		<?php get_template_part('templates/elements/core/content', 'element-paypal-form');  ?>
		</div><!-- /.col-xs-12 -->


<!---->


		<?php
		// Layout for Latest Posts
		elseif(get_row_layout() == 'latest_posts'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-latest-posts" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-latest-posts');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!---->


		<?php
		// Layout for Timeline
		elseif(get_row_layout() == 'timeline'):
		?>

		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>
		<div class="col-xs-12 forcontent element-contents element-timeline" role="document">
			<div class="content row">

		<?php
			// IF not a 'page'
			else : ?>

				<div class="col-xs-12" role="document">

		<?php endif; ?>


					<?php get_template_part('templates/elements/core/content', 'element-timeline');  ?>


		<?php if(is_page() || is_single() && !Setup\display_sidebar() ) : ?>

			</div><!-- /.content -->
		</div><!-- /.col-xs-12 -->
		<?php
			// IF not a 'page'
			else :  ?>

				</div><!-- /.col-xs-12 -->

		<?php endif; ?>


<!-- CUSTOM CALLS -->



<?php endif; ?>


<?php endwhile; ?>
