<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="<?php the_field('brand_primary_colour', 'option'); ?>">
	<link rel="alternate" type="application/rss+xml" title="<?= get_bloginfo('name'); ?> Feed" href="<?= esc_url( get_feed_link() ); ?>">

	<link rel="dns-prefetch" href="<?php bloginfo('home'); ?>">
	<link rel="preconnect" href="<?php bloginfo('home'); ?>">

<?php if ( is_archive() && ( $paged > 1 ) && ( $paged < $wp_query->max_num_pages ) ) { ?>
	<link rel="prefetch" href="<?= get_next_posts_page_link(); ?>">
	<link rel="prerender" href="<?= get_next_posts_page_link(); ?>">
<?php } elseif ( is_singular() ) { ?>
	<link rel="prefetch" href="<?php bloginfo('home'); ?>">
	<link rel="prerender" href="<?php bloginfo('home'); ?>">
<?php }

	wp_head();

	// Get values from the ACF options page
	// Looking for ...
	$bgImage 			= get_field('background_image', 'option');

	if( !empty($bgImage) ) {
		// Vars if needed
		$url 				   = $bgImage['url'];
		$title 				 = $bgImage['title'];
		$alt 				   = $bgImage['alt'];
		$caption 			 = $bgImage['caption'];
	}

	$bgColour 				       = get_field('background_colour', 'option');

	$brandPrimaryColour 	   = get_field('brand_primary_colour', 'option');

	$brandSecondaryColour 	 = get_field('brand_secondary_colour', 'option');

	$navOpacity 			       = get_field('navigation_opacity', 'option');

	$showSideBarOnPosts 	   = get_field('show_sidebar_on_posts', 'option');

	if( !empty($bgColour) || !empty($bgImage) || !empty($brandPrimaryColour) ) : ?>
  <style>
<?php if( !empty($bgImage) ) { ?>
	body {
		background: url('<?php echo ($bgImage['url']); ?>') no-repeat center center fixed;
		-webkit-background-size: cover;
		-moz-background-size: cover;
		-o-background-size: cover;
		background-size: cover;
		}
<?php }
	if( !empty($bgColour) || !empty($bgImage) ) { ?>
		.forcontent { background: white; }

		.parallax { margin-bottom: 0; }

		footer {
			background-color: rgb(248, 248, 248);
			border-color: rgb(231, 231, 231);
		}
<?php }
	if( !empty($bgColour) ) { ?>
	body { background-color: <?php echo $bgColour; ?>; }
<?php }
	if( !empty($brandPrimaryColour) ) { ?>
	header.navbar .navbar-brand { color: <?php echo $brandPrimaryColour; ?>; }

	header.navbar.banner.navbar-default .navbar-nav>li>a:hover,
	header.navbar.banner.navbar-default .navbar-nav>li>a:focus { color: <?php echo $brandPrimaryColour; ?>; }

	header.navbar.banner.navbar-default .navbar-nav>.active>a,
	header.navbar.banner.navbar-default .navbar-nav>li>a:hover,
	header.navbar.banner.navbar-default .navbar-nav>li>a:focus { background-color: <?php echo $brandPrimaryColour; ?> !important; color: rgb(255, 255, 255); }

	.dropdown-menu>.active>a, .dropdown-menu>.active>a:hover,
	.dropdown-menu>.active>a:focus { background-color: <?php echo $brandPrimaryColour; ?> }

	.content .page-header {	color: <?php echo $brandPrimaryColour; ?>; }

	.content .dropcap p:first-of-type:first-letter { color: <?php echo $brandPrimaryColour; ?>; }

	.summary .gform_wrapper .gsection_title { color: <?php echo $brandPrimaryColour; ?>; }

	#instafeed .likes { background: <?php echo $brandPrimaryColour; ?>; }

	.gform_wrapper .checkradios-checkbox .focus,
	.gform_wrapper .checkradios-radio .focus {
		-webkit-box-shadow: 0px 0px 3px fadeout(<?php echo $brandPrimaryColour; ?>, 10%);
		-moz-box-shadow: 0px 0px 3px fadeout(<?php echo $brandPrimaryColour; ?>, 10%);
		box-shadow: 0px 0px 3px fadeout(<?php echo $brandPrimaryColour; ?>, 10%);

		border-color: <?php echo $brandPrimaryColour; ?>;
	}

	.gform_wrapper .ginput_container input:focus,
	.gform_wrapper .ginput_container select:focus,
	.gform_wrapper .ginput_container textarea:focus {
		border-color: <?php echo $brandPrimaryColour; ?>;
		-webkit-box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px fadeout(<?php echo $brandPrimaryColour; ?>, 40%);
		-moz-box-shadow: inset 0 1px 1px rgba(0,0,0,.075), 0 0 8px fadeout(<?php echo $brandPrimaryColour; ?>, 40%);
		box-shadow: inset 0 1px 1px rgba(0, 0, 0, 0.075), 0 0 8px fadeout(<?php echo $brandPrimaryColour; ?>, 40%);
	}

	.acf-map { border: 1px solid <?php echo $brandPrimaryColour; ?>; }

	.hentry header h2.entry-title a { color: <?php echo $brandPrimaryColour; ?>; }
<?php }
	if( !empty($navOpacity) ) { ?>
	header.navbar-default { background-color: rgba(248, 248, 248, <?php echo $navOpacity; ?>); }

	<?php if( $navOpacity !== 1 && is_front_page() ) { ?>
		.spacer { display: none !important; }
	<?php } ?>

<?php } ?>
  </style>
<?php endif; ?>
</head>
