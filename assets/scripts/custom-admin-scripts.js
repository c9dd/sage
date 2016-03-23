/* ==========================================================================
	 Custom admin area scripts
	 ========================================================================== */
/*
function getVideoId(videoURL){
		if(videoURL.indexOf('?') !== -1 ) {
				var query = decodeURI(videoURL).split('?')[1];
				var params = query.split('&');
				for(var i=0,l = params.length;i<l;i++) {
						if(params[i].indexOf('v=') === 0) {
								return params[i].replace('v=','');
					}
				}
		} else if (videoURL.indexOf('youtu.be') !== -1) {
				return decodeURI(videoURL).split('youtu.be/')[1];
		}
		return null;
}
*/


// NOTE:
// To stop conflicts with native jQuery stuff as we will us $j instead of just $
$j = jQuery.noConflict();
$j(document).ready(function() {


  if ( $j('body').hasClass('wp-admin') )
  {
    //alert('Hello, I\'m loaded $j');
  }


	/*
	function testAnimLink(anim, id) {
		var aniElementID = $j('.js--animations--section').attr('class').split(' ')[4];

		$j('.'+aniElementID+'').find('.animationWrapper span').alert('found it');

		$j('.js--animations--section col1-1 .animationWrapper span').removeClass().addClass(anim + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$j(this).removeClass();
			//alert(id);
		});
	}
	*/

	$j('.js--animations--section .acf-input').prepend('<div class="animationWrapper"><span class="animation demo">Animation Example</span></div>');

	function testAni(anim, aniElementID) {
		// Find our element and the span within it. Remove any classes we don't want and add those that we do
		$j('.js--animations--section.'+aniElementID+'').find('.animationWrapper span').removeClass().addClass(anim + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$j(this).removeClass();
			// Clean it afer we use it
			aniElementID = null;
			// console.log( aniElementID );
		});
	}

/*
	$j('.js--animations--section select').change(function() {
		var anim 					 = $j(this).val();
		var aniElementID 	 = $j(this).closest('.js--animations--section').attr('class').split(' ')[4];
		testAni(anim, aniElementID);
	});
*/
/*
	$j('.js--animations--section input[type=hidden]').change(function() {
		var anim 					 = $j(this).val();
		var aniElementID 	 = $j(this).closest('.js--animations--section').attr('class').split(' ')[4];
		testAni(anim, aniElementID);
    alert();
	});
*/
  $j('.js--animations--section input[type=hidden]').change(function() {
    var anim 					 = $j(this).val();
    var aniElementID 	 = $j(this).closest('.js--animations--section').attr('class').split(' ')[4];
    testAni(anim, aniElementID);
  });

	// Slider START

	$j('.js--animations--title .acf-input').prepend('<h2 id="title--animation" style="text-align: center;">Title Animation</h2>');
	$j('.js--animations--text .acf-input').prepend('<h2 id="text--animation" style="text-align: center;">Text Animation</h2>');
	$j('.js--animations--link .acf-input').prepend('<h2 id="link--animation" style="text-align: center;">Link Animation</h2>');

/*
	function testAnimTitle(anim, id) {
		$j('h2#title--animation').removeClass().addClass(anim + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$j(this).removeClass();
			//alert(id);
		});
	}

	function testAnimText(anim, id) {
		$j('h2#text--animation').removeClass().addClass(anim + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$j(this).removeClass();
			//alert(id);
		});
	}

	function testAnimLink(anim, id) {
		$j('h2#link--animation').removeClass().addClass(anim + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
			$j(this).removeClass();
			//alert(id);
		});
	}


/*
	$j('.js--triggerAnimation').click(function(e){
		e.preventDefault();
		var anim = $j('.js--animations').val();
		testAnimTitle(anim);
	});
*/



	$j('.js--animations--title select').change(function() {
		var anim 	= $j(this).val();
		var id		= $j(this).attr('id');
		testAnimTitle(anim, id);
	});

	$j('.js--animations--text select').change(function() {
		var anim 	= $j(this).val();
		var id		= $j(this).attr('id');
		testAnimText(anim, id);
	});

	$j('.js--animations--link select').change(function() {
		var anim 	= $j(this).val();
		var id		= $j(this).attr('id');
		testAnimLink(anim, id);
	});

	// Slider END



/*
function testAnimLink(anim, id) {
	$j('.js--animations--section--col1-1 .animationWrapper span').removeClass().addClass(anim + ' animated').one('webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend', function() {
		$j(this).removeClass();
		//alert(id);
	});
}
*/



	acf.add_action('ready', function( $el ){

		acf.add_filter('wysiwyg_tinymce_settings', function( mceInit, id ){

			// do something to mceInit
			var my_style = "a { outline: 3px solid red; }";
		$j( "#acf-editor-562fadb734e42_ifr" ).contents().find( "head" ).append( "<style type=\'text/css\'>" + my_style + "</style>" );


			// return
			return mceInit;

	});
			var $field = $j('#my-wrapper-id');

			// do something to $field

	});

	// var info = tinymce.get('.mce-edit-area iframe').getContent();
	// alert(info);
/*
	$j('acf-editor-562fadb734e42_ifr').each( function() {

		$j(this).append('
		<a href="#wheel2" class="wheel-button ne">
			<span>+</span>
		</a>
		<ul id="wheel2" class="wheel">
			<li class="item"><a href="#home">A</a></li>
			<li class="item"><a href="#home">B</a></li>
		</ul>
		');



		$j(this).contents().find( 'a' ).css('outline', '3px solid red');


			console.log( 'image found' );
	});
*/



	// NOTE:
	// This switches the visiblity of the editor type picked by the user within the edit pages/post screens

	$j('.postarea').hide();																								 // Hide the default editor when page loads

	$j('.acf-field-559d0c8ec06f8 input[type="radio"]').click(function(){
		if( $j(this).attr('value') === 'flexi' ) {													 // Looking for the Flexi fields content editor
			 	// alert('flexi');

				$j('.postarea').hide();																					 // Hide the default editor
				$j('.acf-tab-button[data-key="field_554c7be3c5fb7"]').show();		 // Show the tab
				$j('.acf-field-55438dd3e29de').show();													 // Show the Flexi editor
		}

		if( $j(this).attr('value') === 'standard' ) {												 // Looking for the Standard content editor
				//alert('standard');

				$j('.postarea').show();																					 // Show the default editor
				$j('.acf-tab-button[data-key="field_554c7be3c5fb7"]').hide();		 // Hide the tab
				$j('.acf-field-55438dd3e29de').hide();													 // Hide the Flexi editor
		}
	});




/*
	$j('input#acf-field_55438dd3e29de-9-field_55438dd3ed2cc').on('input',function(e){
		// alert('Changed!');

		var videoURL = $j(this).val();

		getVideoId(videoURL);

		// alert(getVideoId(videoURL));

		// var urlLONG 	= "http://www.youtube.com/watch?v=UF8uR6Z6KLc&feature=feedlik";
		// var urlSHORT = "http://youtu.be/UF8uR6Z6KLc";

		$j('').html('Hello <b>world</b>!');

	});
*/


});
