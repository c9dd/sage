<?php
/* ==========================================================================
	Google Map - Used in Flexi layouts and Contact us page
   ========================================================================== */


   // IF we are using ACF on flexifelds
   if (get_sub_field('location_marker')) :

   		$field = 'the_sub_field';

   else: // We are using a top level ACF feild

   		$field = 'the_field';

   endif;

?>

<style type="text/css">

.acf-map {
	height: <?php the_sub_field('map_height'); ?>px;
}

.labels {
	/*
	color: rgb(51, 51, 51);
	border-radius: 10px;
	padding: 0px;
	font-size: 13px;
	text-align: center;
	width: 16px;
	height: 16px;
	line-height: 16px;
	white-space: nowrap;
*/

	color: #5D130D;
	border-radius: 40px;
	padding: 0px;
	font-size: 26px;
	text-align: center;
	width: 32px;
	height: 32px;
	line-height: 32px;
	white-space: nowrap;

/* Permalink - use to edit and share this gradient: http://colorzilla.com/gradient-editor/#fd6f60+0,fa5746+100 */
background: #fd6f60; /* Old browsers */
background: -moz-linear-gradient(top,  #fd6f60 0%, #fa5746 100%); /* FF3.6+ */
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#fd6f60), color-stop(100%,#fa5746)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top,  #fd6f60 0%,#fa5746 100%); /* Chrome10+,Safari5.1+ */
background: -o-linear-gradient(top,  #fd6f60 0%,#fa5746 100%); /* Opera 11.10+ */
background: -ms-linear-gradient(top,  #fd6f60 0%,#fa5746 100%); /* IE10+ */
background: linear-gradient(to bottom,  #fd6f60 0%,#fa5746 100%); /* W3C */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#fd6f60', endColorstr='#fa5746',GradientType=0 ); /* IE6-9 */


   }
</style>

<script src="//maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="//google-maps-utility-library-v3.googlecode.com/svn/trunk/markerwithlabel/src/markerwithlabel.js"/></script>


<?php if( have_rows('locations') ): ?>
<div class="row google-map">
	<section class="acf-map main">
		<?php while ( have_rows('locations') ) : the_row();

			$location 		= get_sub_field('location_marker');
			$marker_image 	= get_sub_field('marker_image');
			$title			= get_sub_field('title');
			$icon_overlay	= get_sub_field('icon_overlay');
			$make_icon_spin = get_sub_field('make_icon_spin');

			?>
			<div class="marker" data-marker-type="<?php echo get_sub_field('marker_type'); ?>" data-lat="<?php echo $location['lat']; ?>" data-lng="<?php echo $location['lng']; ?>" <?php if ( $marker_image !== '' ) { echo 'data-markerimage="'.$marker_image.'"'; } ?> <?php if ( $title !== '' ) { echo 'data-title="'.$title.'"'; } ?> <?php if ( $icon_overlay !== '' ) { echo 'data-labelicon="'.$icon_overlay.'"'; } ?> <?php if ( $make_icon_spin == 'fa-spin' ) { echo 'data-icon-spin="fa-spin"'; } ?> >
				<h3><?php the_sub_field('title'); ?></h3>
				<p><?php the_sub_field('description'); ?></p>
				<!-- p class="address"><?php echo $location['address']; ?></p -->

				<?php
					$marker_type	= get_sub_field('marker_type');

					$icon_overlay 	= get_sub_field('icon_overlay');
				?>
			</div>
	<?php endwhile; ?>
	</section>
</div>
<?php endif; ?>


<script>
jQuery(function($) {

	/*
	*  render_map
	*
	*  This function will render a Google Map onto the selected jQuery element
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	$el (jQuery element)
	*  @return	n/a
	*/

	function render_map( $el ) {

		// var
		var $markers = $el.find('.marker');

		<?php if ( get_sub_field('map_styles') == 'apple_maps_esque' ) { ?>
		var style_apple_maps_esque = <?php include('google-map-styles/apple_maps_esque.php'); ?>;
		<?php } elseif ( get_sub_field('map_styles') == 'bright_and_bubbly' ) { ?>
		var style_bright_and_bubbly = <?php include('google-map-styles/bright_and_bubbly.php'); ?>;
		<?php } elseif ( get_sub_field('map_styles') == 'clean_cut' ) { ?>
		var style_clean_cut = <?php include('google-map-styles/clean_cut.php'); ?>;
		<?php } elseif ( get_sub_field('map_styles') == 'facebook' ) { ?>
		var style_facebook = <?php include('google-map-styles/facebook.php'); ?>;
		<?php } elseif ( get_sub_field('map_styles') == 'lunar_landscape' ) { ?>
		var style_lunar_landscape = <?php include('google-map-styles/lunar_lanscape.php'); ?>;
		<?php } elseif ( get_sub_field('map_styles') == 'mapa' ) { ?>
		var style_mapa = <?php include('google-map-styles/mapa.php'); ?>;
		<?php } elseif ( get_sub_field('map_styles') == 'muted_monotone' ) { ?>
		var style_muted_monotone = <?php include('google-map-styles/muted_monotone.php'); ?>;
		<?php } elseif ( get_sub_field('map_styles') == 'subtle_grayscale' ) { ?>
		var style_subtle_grayscale = <?php include('google-map-styles/subtle_grayscale.php'); ?>;
		<?php } elseif ( get_sub_field('map_styles') == 'default' ) { ?>
		var style_default = [];

		<?php } ?>

		<?php if ( get_sub_field('custom_map_styles') ) { ?>
		var style_custom = <?php the_sub_field('custom_map_styles') ?>;
		<?php } ?>

		var styleArray = style_<?php the_sub_field('map_styles') ?>;

		// vars
		var args = {

			styles: styleArray,

			// zoom		: 16,
			center		: new google.maps.LatLng(52.335950, -1.728524),
			// mapTypeId	: google.maps.MapTypeId.ROADMAP

			// Level of zoom 0 - 18

			<?php if ( get_sub_field('zoom_level') == '') {
				$zoomLevel = 16;

				} else {
				$zoomLevel = get_sub_field('zoom_level');
				}
			?>

	    	zoom: <?php echo $zoomLevel; ?>,

	        // Disable draggable feature of the map
	    	draggable: <?php the_sub_field('draggable_map'); ?>,

	    	// Disable Keyboard Shortcuts
	    	keyboardShortcuts: true,


	    	// Disable the defualt UI ie remove all controls
	    	disableDefaultUI:  <?php the_sub_field('disable_all_ui'); ?>,

	    	<?php if (get_sub_field('disable_all_ui') == 'false') { ?>

	    	// The Pan controler
	    	panControl:  <?php the_sub_field('pan_control'); ?>,

	    	// Street View controler
	    	streetViewControl: <?php the_sub_field('street_view_control'); ?>,


	    	<?php if (get_sub_field('zoom_control') !== 'false') { ?>
			// Zoom Control

	    	zoomControl: true,

			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.<?php the_sub_field('zoom_control'); ?>
			},

	    	<?php } elseif (get_sub_field('zoom_control') == 'false') { ?>

	    	zoomControl: false,

	    	<?php } ?>

	    	// The scale overlay
	        scaleControl: <?php the_sub_field('scale_overlay'); ?>,


	    	// The controls for map type
	    	mapTypeControl: <?php the_sub_field('map_type_controls'); ?>,

			// I like these as a dropdown option
		    mapTypeControlOptions: {
		      style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
		    },

			<?php } else { ?>

			// The Pan controler
	    	panControl:  false,

	    	// Street View controler
	    	streetViewControl: false,

	    	// Zoom Control
	    	zoomControl: false,

	    	// The scale overlay
	        scaleControl: false,


	    	// The controls for map type
	    	mapTypeControl: false,

			<?php } ?>

	    	// Map Type ROADMAP, SATELLITE, HYBRID, TERRAIN
	        mapTypeId: google.maps.MapTypeId.<?php the_sub_field('map_type'); ?>

		};


		// create map
		var map = new google.maps.Map( $el[0], args, styleArray);

		// add a markers reference
		map.markers = [];

		// add markers
		$markers.each(function(){

	    	add_marker( $(this), map );

		});

		// center map
		center_map( map );

	}

	/*
	*  add_marker
	*
	*  This function will add a marker to the selected Google Map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	$marker (jQuery element)
	*  @param	map (Google Map object)
	*  @return	n/a
	*/

	function add_marker( $marker, map ) {

		// var
		var latlng 			= 	new google.maps.LatLng( $marker.data('lat'), $marker.data('lng') );
		var title 			= 	new google.maps.LatLng( $marker.data('title') );
		var image 			= 	$marker.data('markerimage');
		var title 			= 	$marker.data('title');
		var markertype		= 	$marker.data('marker-type');
		var iconspin		=	$marker.data('icon-spin');


		// If we want a custom marker
		if ( markertype == 'image' ) {

			var labelicon		= 	$marker.data('labelicon');

			// create marker
			var marker 	= new MarkerWithLabel({
				position		:	latlng,
				icon			: 	image,
				title			: 	title,
				map				: 	map
			});

		}
		// If we want marker with icons
		if ( markertype == 'icon' ) {

			var labelicon		= 	$marker.data('labelicon');

			// create marker
			var marker 	= new MarkerWithLabel({
				position		:	latlng,
				icon			: 	image,
				title			: 	title,
				map				: 	map,
				labelContent	: 	'<i class="fa '+labelicon+' '+iconspin+'"></i>',
				// labelAnchor		: 	new google.maps.Point(8, 37),
				labelAnchor		: 	new google.maps.Point(16, 50),
				labelClass		: 	'labels', // the CSS class for the label
				labelStyle		: 	{ opacity: 1.0 }
			});

		}
		// Else we don't, so show the default marker
		if ( markertype == 'default' ) {

			var marker = new google.maps.Marker({
				position		: 	latlng,
				icon			: 	image,
				title			: 	title,
				map				: 	map
			});

		}

		//alert(image);
		// add to array
		map.markers.push( marker );

		// if marker contains HTML, add it to an infoWindow
		if( $marker.html() )
		{
			// create info window
			var infowindow = new google.maps.InfoWindow({
				content		: $marker.html()
			});

			// Do things when marker is clicked
			google.maps.event.addListener(marker, 'click', function() {

				map.setZoom(16);						// Zoom in to that pin
				map.setCenter(marker.getPosition());	// Center on that pin
				infowindow.open( map, marker );			// Show info window

			});
		}

	}

	/*
	*  center_map
	*
	*  This function will center the map, showing all markers attached to this map
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	4.3.0
	*
	*  @param	map (Google Map object)
	*  @return	n/a
	*/

	function center_map( map ) {

		// vars
		var bounds = new google.maps.LatLngBounds();

		// loop through all markers and create bounds
		$.each( map.markers, function( i, marker ){

			var latlng = new google.maps.LatLng( marker.position.lat(), marker.position.lng() );

			bounds.extend( latlng );

		});

		// only 1 marker?
		if( map.markers.length == 1 )
		{
			// set center of map
		    map.setCenter( bounds.getCenter() );

		    <?php if ( get_sub_field('zoom_level') == '') {
				$zoomLevel = 16;

				} else {
				$zoomLevel = get_sub_field('zoom_level');
				}
			?>

			map.setZoom( <?php echo $zoomLevel; ?> );

		}
		else
		{
			// fit to bounds
			map.fitBounds( bounds );
		}

	}

	/*
	*  document ready
	*
	*  This function will render each map when the document is ready (page has loaded)
	*
	*  @type	function
	*  @date	8/11/2013
	*  @since	5.0.0
	*
	*  @param	n/a
	*  @return	n/a
	*/

	$(document).ready(function(){

		$('.acf-map').each(function(){

			render_map( $(this) );

		});

	});

});
</script>

