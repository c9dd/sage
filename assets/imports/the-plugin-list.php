<?php

add_action( 'tgmpa_register', __NAMESPACE__ . '\\my_theme_register_required_plugins' );

function my_theme_register_required_plugins() {

	$plugins = array(
		array(
			'name'      			=> 'Soil',
			'slug'      			=> 'roots/soil',
			'source'    			=> 'https://github.com/roots/soil/archive/master.zip',
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'HTML5 Boilerplate .htaccess for WordPress',
			'slug'      			=> 'roots/wp-h5bp-htaccess',
			'source'    			=> 'https://github.com/roots/wp-h5bp-htaccess/archive/master.zip',
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Pro', // License Key = b3JkZXJfaWQ9MzQwMDV8dHlwZT1kZXZlbG9wZXJ8ZGF0ZT0yMDE0LTA3LTA5IDEwOjQ1OjA0
			'source'    			=> 'http://connect.advancedcustomfields.com/index.php?p=pro&a=download&k=b3JkZXJfaWQ9MzQwMDV8dHlwZT1kZXZlbG9wZXJ8ZGF0ZT0yMDE0LTA3LTA5IDEwOjQ1OjA0',
			'force_activation'   	=> true, // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
			'force_deactivation' 	=> true, // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
		),
		array(
			'name'      			=> 'Gravity Forms', // License Key = 277a22fe94a8c151cb0ba0de4e98f70a
			'source'    			=> 'http://s3.amazonaws.com/gravityforms/releases/gravityforms_1.9.14.5.zip?AWSAccessKeyId=1603BBK66770VCSCJSG2&Expires=1445512738&Signature=65%2FFQNxXs5DvvekOWfmrtrb%2BHo4%3D',
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'Coming Soon Pro', // License Key = a0d5430a-5fbc-4f8c-a871-fa2382e368b5
			'source'    			=> 'http://secure.sellwp.co.s3.amazonaws.com/1/seedprod-coming-soon-pro-4.3.6.zip?AWSAccessKeyId=0K306H56064GD37NBKR2&Expires=1445445730&Signature=x25%2BslQ%2BWe%2BjRz1ct1ss7zLMrCQ%3D',
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),

		// This is an example of how to include a plugin from a GitHub repository in your theme.
		// This presumes that the plugin code is based in the root of the GitHub repository and not in a subdirectory ('/src') of the repository.
		array(
			'name'      			=> 'ACF: Country Field',
			'slug'      			=> 'Vheissu/acf-country-field',
			'source'    			=> 'https://github.com/Vheissu/acf-country-field/archive/master.zip',
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Hidden Field type',
			'slug'      			=> 'gerbenvandijk/acf-hidden-field',
			'source'    			=> 'https://github.com/gerbenvandijk/acf-hidden-field/archive/master.zip',
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Reuse Field Groups',
			'slug'      			=> 'tybruffy/ACF-Reusable-Field-Group',
			'source'    			=> 'https://github.com/tybruffy/ACF-Reusable-Field-Group/archive/master.zip',
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Auto-generated Value Field',
			'slug'      			=> 'andersthorborg/ACF-auto-generated-value',
			'source'    			=> 'https://github.com/andersthorborg/ACF-auto-generated-value/archive/master.zip',
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Divider Field',
			'slug'      			=> 'Kreshnik/acf-divider-field',
			'source'    			=> 'https://github.com/Kreshnik/acf-divider-field/archive/master.zip',
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: PayPal Field',
			'source'    			=> 'https://bitbucket.org/c9ash/paypal-field-for-the-advanced-custom-fields-wordpress-plugin/get/ab79120d21f9.zip',
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Gravity Forms',
			'slug'      			=> 'stormuk/Gravity-Forms-ACF-Field',
			'source'    			=> 'https://github.com/stormuk/Gravity-Forms-ACF-Field/archive/master.zip',
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: QuickEdit Fields',
			'slug'      			=> 'mcguffin/acf-quick-edit-fields',
			'source'    			=> 'https://github.com/mcguffin/acf-quick-edit-fields/archive/master.zip',
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'Sagextras',
			'slug'      			=> 'storm2k/sagextras',
			'source'    			=> 'https://github.com/storm2k/sagextras/archive/master.zip',
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),

		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		// ACF Addons on WordPress Repo
		array(
			'name'      			=> 'ACF: Accordion Tab Field',
			'slug'      			=> 'acf-accordion',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Button Field',
			'slug'      			=> 'acf-button-field',
			'required'  			=> true,
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Date & Time Picker Field',
			'slug'      			=> 'acf-field-date-time-picker',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Field Selector',
			'slug'      			=> 'acf-field-selector-field',
			'required'  			=> true,
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Fold Flexible Content',
			'slug'      			=> 'acf-fold-flexible-content',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Google Font Selector',
			'slug'      			=> 'acf-google-font-selector-field',
			'required'  			=> false,
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),
		/*array(
			'name'      			=> 'ACF: Repeater & Flexible Content Fields Collapser',
			'slug'      			=> 'advanced-custom-field-repeater-collapser',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),*/
		array(
			'name'      			=> 'ACF: Field Snitch',
			'slug'      			=> 'advanced-custom-fields-field-snitch',
			'required'  			=> false,
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Font Awesome',
			'slug'      			=> 'advanced-custom-fields-font-awesome',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Leaflet Field',
			'slug'      			=> 'advanced-custom-fields-leaflet-field',
			'required'  			=> false,
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Limiter Field',
			'slug'      			=> 'advanced-custom-fields-limiter-field',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Nav Menu Field',
			'slug'      			=> 'advanced-custom-fields-nav-menu-field',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Number Slider',
			'slug'      			=> 'advanced-custom-fields-number-slider',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Row Field',
			'slug'      			=> 'advanced-custom-fields-row-field',
			'required'  			=> false,
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Table Field',
			'slug'      			=> 'advanced-custom-fields-table-field',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Viewer',
			'slug'      			=> 'advanced-custom-fields-viewer',
			'required'  			=> false,
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Widget',
			'slug'      			=> 'advanced-custom-fields-widget',
			'required'  			=> false,
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'ACF: Widget Area Field',
			'slug'      			=> 'advanced-custom-fields-widget-area-field',
			'required'  			=> false,
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),


		// Additional plugins on the WordPress Repo
		array(
			'name'      			=> 'Admin Color Schemes',
			'slug'      			=> 'admin-color-schemes',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'Admin Columns',
			'slug'      			=> 'codepress-admin-columns',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'Akismet',
			'slug'      			=> 'akismet',
			'required'  			=> false,
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'Enable Media Replace',
			'slug'      			=> 'enable-media-replace',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'Jetpack',
			'slug'      			=> 'jetpack',
			'required'  			=> false,
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'User Switching',
			'slug'      			=> 'user-switching',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'WordPress Importer',
			'slug'      			=> 'wordPress-importer',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'WPCore Plugin Manager',
			'slug'      			=> 'wpcore',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'Yoast SEO',
			'slug'      			=> 'wordpress-seo',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'WP Max Submit Protect',
			'slug'      			=> 'wp-max-submit-protect',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'Stream',
			'slug'      			=> 'stream',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'Slash Edit',
			'slug'      			=> 'slash-edit',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'WP Smush',
			'slug'      			=> 'wp-smushit',
			'required'  			=> true,
			'force_activation'   	=> true,
			'force_deactivation' 	=> true,
		),
		array(
			'name'      			=> 'W3 Total Cache',
			'slug'      			=> 'w3-total-cache',
			'required'  			=> false,
			'force_activation'   	=> false,
			'force_deactivation' 	=> true,
		),	);

	$config = array(
		'id'           				=> 'starter-theme-tgmpa',   								// Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' 				=> get_stylesheet_directory() . '/assets/imports/wp-admin', // Default absolute path to bundled plugins.
		'menu'         				=> 'starter-theme-tgmpa-install-plugins', 					// Menu slug.
		'parent_slug'  				=> 'themes.php',            								// Parent menu slug.
		'capability'   				=> 'edit_theme_options',    								// Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  				=> true,                    								// Show admin notices or not.
		'dismissable'  				=> true,                    								// If false, a user cannot dismiss the nag message.
		'dismiss_msg'  				=> '',                      								// If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' 				=> true,                   									// Automatically activate plugins after installation or not.
	    'message'      				=> '<!--Hey there.-->', 									// message to output right before the plugins table
        'strings'      				=> array(
            'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
            'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
            'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), 																										// %s = plugin name.
            'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), 								// %1$s = plugin name(s).
            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), 							// %1$s = plugin name(s).
            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), 												// %1$s = plugin name(s).
            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), 		// %1$s = plugin name(s).
            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), 												// %1$s = plugin name(s).
            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), 																																// %1$s = plugin name(s).
            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), 														// %1$s = plugin name(s).
            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
            'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
            'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
            'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), 																		// %s = dashboard link.
            'nag_type'                        => 'updated' 																																		// Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
        )
	);

	tgmpa( $plugins, $config );
}
?>
