<?php // use Roots\Sage\Nav\NavWalker; ?>
<header class="banner navbar navbar-default navbar-fixed-top" role="banner">

	<div class="container">
		<div class="row">
	  		<div class="col-xs-3">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
						<span class="sr-only"><?= _e('Toggle navigation', 'trident2015'); ?></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<div class="web-title-area">
						<a href="<?= esc_url(home_url('/')); ?>" class="logo">
						<?php
							// Get values from the ACF options page
							$image 		= get_field('master_logo', 'option');

						// Now get the image vars
						if( !empty($image) ) {
							// Vars if needed
							$url 		= $image['url'];
							$title 		= $image['title'];
							$alt 		= $image['alt'];
							$caption 	= $image['caption'];
						?>
							<img class="website-logo hidden-xs" src="<?php echo($image['sizes']['logo-image-size']); ?>" alt="<?php bloginfo('name'); ?>" />
							<img class="website-logo-mobile visible-xs-block" src="<?php echo($image['sizes']['logo-image-size']); ?>" alt="<?php bloginfo('name'); ?>" />
						<?php } ?>
						</a>
						<a class="navbar-brand" href="<?= esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
					</div>
				</div>
	  		</div>

	  		<div class="col-xs-9">

				<div class="container-container">
					<nav class="collapse navbar-collapse row" role="navigation">
					  <?php
							/*
							if (has_nav_menu('primary_navigation')) {
					       wp_nav_menu(['theme_location' => 'primary_navigation', 'walker' => new NavWalker(), 'menu_class' => 'nav navbar-nav col-xs-12']);
					    }
							*/
							if (has_nav_menu('primary_navigation')) {
					       wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav navbar-nav col-xs-12']);
					    }
					  ?>
					</nav>
				</div>
	  		</div>
		</div>
	</div>
</header>
<?php
// to display screen size for css
if ( !is_user_logged_in() ) { ?>
<div class="screen-view navbar-fixed-bottom visible-xs">screen-xs-max</div>

<div class="screen-view navbar-fixed-bottom visible-sm">screen-sm-min</div>

<div class="screen-view navbar-fixed-bottom visible-md">screen-md-min</div>

<div class="screen-view navbar-fixed-bottom visible-lg">screen-lg-min</div>
<?php } ?>
