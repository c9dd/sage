<?php namespace App;

use Roots\Sage\Asset;
use Roots\Sage\Assets\JsonManifest;
use Roots\Sage\Template\WrapperCollection;
use Roots\Sage\Template\WrapperInterface;

/**
 * @param WrapperInterface $wrapper
 * @param string $slug
 * @return string
 * @throws \Exception
 * @SuppressWarnings(PHPMD.StaticAccess) This is a helper function, so we can suppress this warning
 */
function template_wrap(WrapperInterface $wrapper, $slug = 'base')
{
    WrapperCollection::add($wrapper, $slug);
    return $wrapper->getWrapper();
}

/**
 * @param string $slug
 * @return string
 */
function template_unwrap($slug = 'base')
{
    return WrapperCollection::get($slug)->getTemplate();
}

/**
 * @param $filename
 * @return string
 */
function asset_path($filename)
{
    static $manifest;
    isset($manifest) || $manifest = new JsonManifest(get_template_directory() . '/' . Asset::$dist . '/assets.json');
    return (string) new Asset($filename, $manifest);
}

/**
 * Determine whether to show the sidebar
 * @return bool
 */
function display_sidebar()
{
    static $display;
    isset($display) || $display = apply_filters('sage/display_sidebar', true);
    return $display;
}

/**
 * Page titles
 * @return string
 */
function title()
{
    if (is_home()) {
        if ($home = get_option('page_for_posts', true)) {
            return get_the_title($home);
        }
        return __('Latest Posts', 'sage');
    }
    if (is_archive()) {
        return get_the_archive_title();
    }
    if (is_search()) {
        return sprintf(__('Search Results for %s', 'sage'), get_search_query());
    }
    if (is_404()) {
        return __('Not Found', 'sage');
    }
    return get_the_title();
}


/* ==============================================================================================================================================================================================================================

	CUSTOM FUNCTIONS START HERE

   ============================================================================================================================================================================================================================== */
// require_once get_stylesheet_directory() . '/assets/imports/acf/fewbricks-master/init.php';
/* ==========================================================================
   TGM Plugin Activation - Required or recommend plugins for the theme
   ========================================================================== */
require_once get_stylesheet_directory() . '/assets/imports/the-plugin-list.php';

// NOTE:
// Generate a random string that is used throughout various elemnts within the theme
// SO DON'T REMOVE IT!
function generateRandomString($length = 10) {
  $characters       = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $charactersLength = strlen($characters);
  $randomString     = '';

  for ($i = 0; $i < $length; $i++)
  {
    $randomString .= $characters[rand(0, $charactersLength - 1)];
  }
  return $randomString;
}

/* ==========================================================================
   Adds ACF data to Yoast's SEO tool! - https://goo.gl/7MjA9Q
   ========================================================================== */

  // NOTE:
  // Check to make sure we aren't on the front-end
  if ( is_admin() )
  {
	add_filter('wpseo_pre_analysis_post_content', __NAMESPACE__ . '\\add_custom_to_yoast');

	function add_custom_to_yoast( $content ) {
		global $post;
		$pid    = $post->ID;
		$custom = get_post_custom($pid);

    // NOTE:
    // Don't count the keyword in the Yoast field!
		unset($custom['_yoast_wpseo_focuskw']);

		foreach( $custom as $key => $value )
    {
			if( substr( $key, 0, 1 ) != '_' && substr( $value[0], -1) != '}' && !is_array($value[0]) && !empty($value[0])) {
				$custom_content .= $value[0] . ' ';
      }
 		}

		$content = $content . ' ' . $custom_content;
		return $content;

    // NOTE:
    // Don't let WP execute this twice
		remove_filter('wpseo_pre_analysis_post_content', __NAMESPACE__ . '\\add_custom_to_yoast');

	}
}




/* ==========================================================================
   Trims excerpt by value
   ========================================================================== */
function excerpt($num) {
	$limit   = $num+1;
	$excerpt = explode(' ', get_the_excerpt(), $limit);
	array_pop($excerpt);
	$excerpt = implode(" ",$excerpt)."…";
	echo $excerpt;
}


/* ==========================================================================
   Gets rid of the word "Category:" in front of the Archive title
   ========================================================================== */
add_filter( 'get_the_archive_title', function( $title ) {

  if ( is_category() )
  {
    $title = single_cat_title( '<h1 class="page-title">', '</h1>' );
  }
  return $title;
} );




// include(get_template_directory().'/assets/imports/acf/acf-field-column-master/acf-column.php');


/* ==========================================================================
   Human timestamps
   ========================================================================== */
function time_ago( $type = 'post' ) {
    $d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
    return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');
}



/* ==========================================================================
   Create a 'is_blog' check
   ========================================================================== */
function is_blog() {
	global  $post;
	$posttype = get_post_type($post);

	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}


/* ==========================================================================
   Add additional menu to TinyMCE
   ========================================================================== */

// Hooks your functions into the correct filters
function my_add_mce_button() {
  // NOTE:
	// Check user permissions
	if ( !current_user_can( 'edit_posts' ) && !current_user_can( 'edit_pages' ) )
  {
		return;
	}
  // NOTE:
	// Check if WYSIWYG is enabled
	if ( 'true' == get_user_option( 'rich_editing' ) )
  {
		add_filter( 'mce_external_plugins', __NAMESPACE__ . '\\my_add_tinymce_plugin' );
		add_filter( 'mce_buttons', __NAMESPACE__ . '\\my_register_mce_button' );
	}
}
add_action('admin_head', __NAMESPACE__ . '\\my_add_mce_button');

// NOTE:
// Declare script for new button
function my_add_tinymce_plugin( $plugin_array ) {
	$plugin_array['my_mce_button'] = get_template_directory_uri() .'/assets/scripts/mce-button.js';
	return $plugin_array;
}

// NOTE:
// Register new button in the editor
function my_register_mce_button( $buttons ) {
	array_push( $buttons, 'my_mce_button' );
	return $buttons;
}



/* ==========================================================================
   Load custom scripts in to admin area
   ========================================================================== */
/*
function custom_admin_scripts($hook) {

	if( $hook != 'edit.php' && $hook != 'post.php' && $hook != 'post-new.php' )
		return;
		// Checks to see what version (dev or production) we are using and uses that
		wp_enqueue_script('custom_admin_scripts_wheel', 	Assets\asset_path('scripts/jquery.wheelmenu.min.js'), ['jquery'], null, false);
		wp_enqueue_style ('custom_admin_styles_wheel', 		Assets\asset_path('styles/wheelmenu.css'));
    wp_enqueue_script('custom_admin_scripts', 			Assets\asset_path('scripts/custom_admin_scripts.js'), ['jquery'], null, true);
    wp_enqueue_style ('custom_admin_styles', 			Assets\asset_path('styles/custom-admin-style.css'));
}

add_action( 'admin_enqueue_scripts', __NAMESPACE__ . '\\custom_admin_scripts' );
*/


/* ==========================================================================
   Remove widths & heights from images as they are inserted in to the page
   ========================================================================== */

function remove_thumbnail_dimensions( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html ); return $html;
}

add_filter( 'post_thumbnail_html', __NAMESPACE__ . '\\remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', __NAMESPACE__ . '\\remove_thumbnail_dimensions', 10 );



/* ==================================================================================================
   Set custom image sizes that are needed for the theme & Responsive activation for the custom fields
   ================================================================================================== */
if (function_exists('tevkori_filter_content_images'))
{
    add_filter('acf_the_content', 'tevkori_filter_content_images', 5, 1);
}

if ( function_exists( 'add_image_size' ) )
{
	add_image_size( 'logo-image-size', 447, 160 ); // Soft Crop Mode
	add_image_size( 'paralax-image-size', 1561, 683 ); // Soft Crop Mode
	// add_image_size( 'holiday-type-block', 350, 226 ); // Hard Crop Mode
}



/* =============================================================================================
   Add responsiveness to IE 8 and lower. I don't care about IE so I'll leave this out by default
   ============================================================================================= */
/*
add_action( 'wp_head', create_function( '',
   'echo \'
   <!-- I hate you -->
   <!--[if lt IE 10]>
   <link href="'.Assets\asset_path('styles/bless/main.css').'" media="all" rel="stylesheet"/>
   <link href="'.Assets\asset_path('styles/bless/main-blessed2.css').'" media="all" rel="stylesheet"/>
   <link href="'.get_template_directory_uri() . '/dist/styles/splitCSS/main-2d04ac6c-blessed2.css" media="all" rel="stylesheet"/>
   <![endif]-->
   <!--[if lt IE 9]>
   <script src="'.get_template_directory_uri() . '/assets/js/plugins/respond-for-ie/respond.src.js"></script>
   <![endif]-->
   \';'
) );
*/


/* ==========================================================================
   This adds the options screen to the admin area (ACF)	http://goo.gl/tMhLih
   ========================================================================== */

if( function_exists('acf_add_options_page') )
{
	acf_add_options_page(); 			       // Adds a new options page
	acf_add_options_sub_page();			     // Adds a new child options page
/*
  acf_update_options_page();		   	 // Updates an options page's settings
	acf_set_options_page_title();		     // Updates the default options page's page_title
	acf_set_options_page_menu();		     // Updates the default options page's menu_title
	acf_set_options_page_capability();	 // Updates the default options page's capability
	register_options_page();			       // Alias of acf_add_options_page()
*/
}

if( function_exists('acf_add_options_page') )
{

	acf_add_options_page(array(
		'page_title' 	=> 'Theme General Settings',
		'menu_title'	=> 'Theme Settings',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'redirect'		=> false
	));
	/*
	acf_add_options_sub_page(array(
		'page_title' 	=> 'WooCommerce Overrides',
		'menu_title'	=> 'WC Ovrrides',
		'parent_slug'	=> 'theme-general-settings',
	));
	*/
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Header Settings',
		'menu_title'	=> 'Header',
		'parent_slug'	=> 'theme-general-settings',
	));

	acf_add_options_sub_page(array(
		'page_title' 	=> 'Theme Footer Settings',
		'menu_title'	=> 'Footer',
		'parent_slug'	=> 'theme-general-settings',
	));
	/*
	acf_add_options_sub_page(array(
		'page_title' 	=> 'Translation Settings',
		'menu_title'	=> 'Translations',
		'parent_slug'	=> 'theme-general-settings',
	));
	*/
}



/* ==========================================================================
   Custom Excerpt with ACF & limit text
   ========================================================================== */
function custom_field_excerpt() {
	global $post;
	$text             = get_field('custom_excerpt');

	if ( '' != $text )
  {
		$text           = strip_shortcodes( $text );
		$text           = apply_filters('the_content', $text);
		$text           = str_replace(']]>', ']]>', $text);
		$excerpt_length = 60; // # words
		$excerpt_more   = apply_filters('excerpt_more', ' ' . '[...]');
		$text           = wp_trim_words( $text, $excerpt_length, $excerpt_more );
	}
	return apply_filters('the_excerpt', __NAMESPACE__ . '\\'. $text);
}


/* ==========================================================================
   Add addition field for Gravity Forms to ACF
   ========================================================================== */

// include(get_template_directory().'/assets/imports/acf/gravity-forms-acf-field/acf-gravity_forms.php');


/* ==========================================================================
   Add search & logout to nav
   ========================================================================== */
/*
function add_search_form($items, $args) {

	if( $args->theme_location == 'primary_navigation' )

		if (is_user_logged_in()) :
			$current_user = wp_get_current_user();

	        $items .= 	'<li class="visible-xs-block">
	        				<a href="'. get_site_url() .'/my-account/?customer-logout=true">Log Out</a>
	        			</li>
	        			<li class="visible-xs-block">' . get_search_form() . '</li>';

        elseif (!is_user_logged_in()) :
        	$items .= 	'<li class="visible-xs-block">
        					<a href="'.get_site_url().'/my-account/">Log In</a>
						</li>
						<li class="visible-xs-block">' . get_search_form() . '</li>';
        endif;

	return $items;
}

add_filter('wp_nav_menu_items', __NAMESPACE__ . '\\add_search_form', 10, 2);
*/

/* ==========================================================================
   Allow additional file types to be uploaded
   ========================================================================== */

function custom_upload_mimes ( $existing_mimes=array() ) {

    $existing_mimes['svg'] 							            = 'image/svg+xml';
    $existing_mimes['svgz'] 						            = 'image/svg+xml';
    $existing_mimes['pdf']                          = 'application/pdf';
    $existing_mimes['doc']                          = 'application/msword';
    $existing_mimes['pot|pps|ppt']                  = 'application/vnd.ms-powerpoint';
    $existing_mimes['wri']                          = 'application/vnd.ms-write';
    $existing_mimes['xla|xls|xlt|xlw']              = 'application/vnd.ms-excel';
    $existing_mimes['mdb']                          = 'application/vnd.ms-access';
    $existing_mimes['mpp']                          = 'application/vnd.ms-project';
    $existing_mimes['docx']                         = 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
    $existing_mimes['docm']                         = 'application/vnd.ms-word.document.macroEnabled.12';
    $existing_mimes['dotx']                         = 'application/vnd.openxmlformats-officedocument.wordprocessingml.template';
    $existing_mimes['dotm']                         = 'application/vnd.ms-word.template.macroEnabled.12';
    $existing_mimes['xlsx']                         = 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet';
    $existing_mimes['xlsm']                         = 'application/vnd.ms-excel.sheet.macroEnabled.12';
    $existing_mimes['xlsb']                         = 'application/vnd.ms-excel.sheet.binary.macroEnabled.12';
    $existing_mimes['xltx']                         = 'application/vnd.openxmlformats-officedocument.spreadsheetml.template';
    $existing_mimes['xltm']                         = 'application/vnd.ms-excel.template.macroEnabled.12';
    $existing_mimes['xlam']                         = 'application/vnd.ms-excel.addin.macroEnabled.12';
    $existing_mimes['pptx']                         = 'application/vnd.openxmlformats-officedocument.presentationml.presentation';
    $existing_mimes['pptm']                         = 'application/vnd.ms-powerpoint.presentation.macroEnabled.12';
    $existing_mimes['ppsx']                         = 'application/vnd.openxmlformats-officedocument.presentationml.slideshow';
    $existing_mimes['ppsm']                         = 'application/vnd.ms-powerpoint.slideshow.macroEnabled.12';
    $existing_mimes['potx']                         = 'application/vnd.openxmlformats-officedocument.presentationml.template';
    $existing_mimes['potm']                         = 'application/vnd.ms-powerpoint.template.macroEnabled.12';
    $existing_mimes['ppam']                         = 'application/vnd.ms-powerpoint.addin.macroEnabled.12';
    $existing_mimes['sldx']                         = 'application/vnd.openxmlformats-officedocument.presentationml.slide';
    $existing_mimes['sldm']                         = 'application/vnd.ms-powerpoint.slide.macroEnabled.12';
    $existing_mimes['onetoc|onetoc2|onetmp|onepkg'] = 'application/onenote';

    return $existing_mimes;
}

add_filter('upload_mimes', __NAMESPACE__ . '\\custom_upload_mimes');










/* ==========================================================================
   Banner widget

   // This extends widget code in init.php
   // Also uses ACF
   ========================================================================== */


function my_dynamic_sidebar_params( $params ) {

  // NOTE:
	// Get widget vars
	$widget_name = $params[0]['widget_name'];
	$widget_id   = $params[0]['widget_id'];

  // NOTE:
	// Bail early if this widget is not a Banners widget
	if( $widget_name != 'Banners' )
  {
		return $params;
	}

	// '<pre>'. print_r(get_field('banner_locations', 'widget_' . $widget_id)) . '</pre>';

	// $bannerPosts = get_field('banner_locations', 'widget_' . $widget_id);

	// echo $bannerPosts[0]->slug;

	// $bannerLocation = $bannerPost['ID'];

	// echo $bannerLocation;

	// $params[0]['after_widget'] = '<pre>'. print_r($bannerPosts) . '</pre>';

	// $params[0]['after_widget'] = '<pre>'. $bannerPost['ID'] . '</pre>';

	// $params[0]['after_widget'] = print_r($bannerPost['post_title']);

	// var_dump($bannerPosts);



	  if( have_rows('banner', 'widget_' . $widget_id) )
    {

  	  while ( have_rows('banner', 'widget_' . $widget_id) ) : the_row();  // ACF
        // NOTE:
  	  	// Get todays time stamp
  	  	$todaysDate				   = time();

        // NOTE:
  	  	// If we have a date to deactivate the banner, get that too
  	  	$deactivateDate			 = get_sub_field('deactivate_banner_on'); // ACF

        // NOTE:
  	  	// For conditions
  	  	$showBanner          = true;

        // NOTE:
  	  	// If we have a date to deactivate the banner ...
  	  	if ( $deactivateDate )
        {

          // NOTE:
    	  	// And IF todays date is greater that the deactivate date ...
    	  	if ( $todaysDate > $deactivateDate )
          {

            // NOTE:
  	  	    // Set the show condition to be false
  	  		  $showBanner = false;

          };

  	  	};

        // NOTE:
  	  	// Now only do this stuff if the banner is not deactivated
  	  	if ( $showBanner )
        {

    	  	$image 					     = get_sub_field('banner_image'); // ACF

          // NOTE:
    			// Vars
    			$url 					       = $image['url'];
    			$title 					     = $image['title'];
    			$alt 					       = $image['alt'];
    			$caption 				     = $image['caption'];

          // NOTE:
    			// Thumbnail
    			$size 					     = 'medium';
    			$square					     = $image['sizes'][ $size ];
    			$width 					     = $image['sizes'][ $size . '-width' ];
    			$height 				     = $image['sizes'][ $size . '-height' ];


    	  	$params[0]['after_widget'] .= '<section class="banner">';

    	  	$params[0]['after_widget'] .= '<span>' . get_sub_field('banner_title') . '</span> '; // ACF

    	  	// $params[0]['after_widget'] .= '<span>Todays date is ' . $todaysDate . '</span> - ';

    	  	// $params[0]['after_widget'] .= '<span>Deactivate on ' . $deactivateDate . '</span>';


    	  	$banner_link = get_sub_field('banner_link'); // ACF


    	  	if ( $banner_link == 'internal' )
          {

    	  		$page_link = get_sub_field('banner_internal_link'); // ACF

    	  		$params[0]['after_widget'] .= '<a href="' . $page_link . '" class="internal-link"><img class="banner-image" style="max-width: 100%;" src="'. $url .'"/></a>';

          }
    	  	elseif ( $banner_link == 'external' )
          {
    	  		$page_link = get_sub_field('banner_external_link'); // ACF

    	  		$params[0]['after_widget'] .= '<a href="' . $page_link . '" class="external-link"><img class="banner-image" style="max-width: 100%;" src="'. $url .'"/></a>';

          }
    	  	elseif ( $banner_link == 'no' )
          {
    	  		$params[0]['after_widget'] .= '<img class="banner-image no-link" style="max-width: 100%;" src="'. $url .'"/>';
          }

			    $params[0]['after_widget'] .= '</section>';
        };

  	  endwhile;
    };
	// return
	return $params;
}

add_filter('dynamic_sidebar_params', __NAMESPACE__ . '\\my_dynamic_sidebar_params');



// NOTE:
// Device detection
function deviceType() {

	$tablet_browser = 0;
	$mobile_browser = 0;

	if (preg_match('/(tablet|ipad|playbook)|(android(?!.*(mobi|opera mini)))/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
  {
	  $tablet_browser++;
	}

	if (preg_match('/(up.browser|up.link|mmp|symbian|smartphone|midp|wap|phone|android|iemobile)/i', strtolower($_SERVER['HTTP_USER_AGENT'])))
  {
	  $mobile_browser++;
	}

	if ((strpos(strtolower($_SERVER['HTTP_ACCEPT']),'application/vnd.wap.xhtml+xml') > 0) or ((isset($_SERVER['HTTP_X_WAP_PROFILE']) or isset($_SERVER['HTTP_PROFILE']))))
  {
	  $mobile_browser++;
	}

	$mobile_ua = strtolower(substr($_SERVER['HTTP_USER_AGENT'], 0, 4));

	$mobile_agents = array(
	    'w3c ','acs-','alav','alca','amoi','audi','avan','benq','bird','blac',
	    'blaz','brew','cell','cldc','cmd-','dang','doco','eric','hipt','inno',
	    'ipaq','java','jigs','kddi','keji','leno','lg-c','lg-d','lg-g','lge-',
	    'maui','maxo','midp','mits','mmef','mobi','mot-','moto','mwbp','nec-',
	    'newt','noki','palm','pana','pant','phil','play','port','prox',
	    'qwap','sage','sams','sany','sch-','sec-','send','seri','sgh-','shar',
	    'sie-','siem','smal','smar','sony','sph-','symb','t-mo','teli','tim-',
	    'tosh','tsm-','upg1','upsi','vk-v','voda','wap-','wapa','wapi','wapp',
	    'wapr','webc','winw','winw','xda ','xda-');

	if (in_array($mobile_ua,$mobile_agents))
  {
	  $mobile_browser++;
	}

	if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']),'opera mini') > 0)
  {
    $mobile_browser++;

    // NOTE:
    // Check for tablets on opera mini alternative headers
    $stock_ua = strtolower(isset($_SERVER['HTTP_X_OPERAMINI_PHONE_UA'])?$_SERVER['HTTP_X_OPERAMINI_PHONE_UA']:(isset($_SERVER['HTTP_DEVICE_STOCK_UA'])?$_SERVER['HTTP_DEVICE_STOCK_UA']:''));
    if (preg_match('/(tablet|ipad|playbook)|(android(?!.*mobile))/i', $stock_ua))
    {
      $tablet_browser++;
    }
	}

	if ($tablet_browser > 0)
  {
    // NOTE:
    // Do something for tablet devices
    // Print 'is tablet';

    $deviceType = 'tablet';
	}
	else if ($mobile_browser > 0)
  {
    // NOTE:
    // Do something for mobile devices
    // Print 'is mobile';

    $deviceType = 'mobile';
	}
	else
  {
    // NOTE:
    // Do something for everything else
    // Print 'is desktop';

    $deviceType = 'desktop';
	}

  return $deviceType;
}

$deviceType = deviceType();



/* ==========================================================================
   Show/Hide elements
   ========================================================================== */

function bootstapHidden() {
  // NOTE:
	// Create empty array to store in to
	$notVisibleOn = array();

  // NOTE:
	// if not wanted to display on Large devices
	if( !in_array( 'col-lg', get_sub_field('element_visible_on') ) )
  {
		array_push($notVisibleOn, 'hidden-lg');
		$lgHidden = true;
	}

  // NOTE:
	// if not wanted to display on Medium devices
	if( !in_array( 'col-md', get_sub_field('element_visible_on') ) )
  {
		array_push($notVisibleOn, 'hidden-md');
		$mdHidden = true;
	}

  // NOTE:
	// if not wanted to display on Small devices
	if( !in_array( 'col-sm', get_sub_field('element_visible_on') ) )
  {
		array_push($notVisibleOn, 'hidden-sm');
		$smHidden = true;
	}

  // NOTE:
	// if not wanted to display on Xtra Small devices
	if( !in_array( 'col-xs', get_sub_field('element_visible_on') ) )
  {
		array_push($notVisibleOn, 'hidden-xs');
		$xsHidden = true;
	}

	return $notVisibleOn;
}

function echoBootstrapHidden() {

	$notVisibleOn = bootstapHidden();

  // NOTE:
	// seporate them out ready to use
	foreach ($notVisibleOn as $hiddenOn)
  {
    $hiddenOn = $hiddenOn.' ';
    echo $hiddenOn;
	}

}

function show_sitemap() {
  if( isset( $_GET['show_sitemap'] ) )
  {
    $the_query = new \WP_Query(array('post_type' => 'any', 'posts_per_page' => '-1', 'post_status' => 'publish'));
    $urls = array();

    while($the_query->have_posts())
    {
      $the_query->the_post();
      $urls[] = get_permalink();
    }
    die(json_encode($urls));
  }
}
add_action('template_redirect', __NAMESPACE__ . '\\show_sitemap');
