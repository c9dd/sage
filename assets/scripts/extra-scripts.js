/* ==========================================================================
   Extra Frontend scripts
   ========================================================================== */

jQuery.noConflict();
jQuery(document).ready(function($) {
	// for animating elements on scroll
	var viewport = $(window),
  setVisible = function (e) {
      var viewportTop = viewport.scrollTop(),
          viewportBottom = viewport.scrollTop() + viewport.height();
      $('.animate-elements').data('element-unique-id','<?= $randomString; ?>').each(function () {

				$(this).find('*[data-animate="true"]').not('.element-slider').each(function () {
					var animationType 	= $(this).data('animation-type');

		      var self = $(this),
		          top = self.offset().top,
		          bottom = top + self.height(),
		          topOnScreen = top >= viewportTop && top <= viewportBottom,
		          bottomOnScreen = bottom >= viewportTop && bottom <= viewportBottom,
		          elemVisible = topOnScreen || bottomOnScreen;

		      self.toggleClass('animated '+animationType+'', elemVisible);
				});
      });
  };

  viewport.scroll(setVisible);
  setVisible();


	$('a').smoothScroll();	// Yep for smooth scrolling

	if ( $('html').is('.no-mobile.no-phone.no-tablet') && $('body').is('.archive, .single-post') )
	{
		var contentWrapperHeight = $('.content-wrapper').height();
		// alert(contentWrapperHeight);
		$('aside.sidebar').height(contentWrapperHeight - 52);
	}

	if ( $('.element-video').length )
	{
		var offset = $('.element-video').offset();						// works out the position relative to the top left corner of browser

		var windowWidth = $(window).width();							// Width of the browser window

		$('.element-video').width(windowWidth);							// Apply that width to the element

		$('.element-video').css('margin-left','-'+ offset.left +'px');	// Pull that element left
	}

	// activate tooltips
	//$('[data-toggle="tooltip"]').tooltip();

	// activate input mask
	/*
	$('[data-mask="dd.mm.yyyy"]').inputmask({
	  mask: '99.99.9999' // format required
	});
	*/
	var mobile = $('body').hasClass('mobile');

  $('body.error404').wrapInner('<div class="error404-bg"></div>');


	// Off Canvas sidebars show/hide
	$('.offcanvas a').click(function(e) {
      e.preventDefault();

      if ( $(this).hasClass('left') || $(this).parent().hasClass('left') ) {
    	$(this).attr('data-toggle', 'offcanvas').attr('data-target', '.offcanvas-left').attr('data-canvas', 'body');
      }

      if ( $(this).hasClass('right') || $(this).parent().hasClass('right') ) {
    		$(this).attr('data-toggle', 'offcanvas').attr('data-target', '.offcanvas-right').attr('data-canvas', 'body');
      }
  });


	//$('table').addClass('table table-striped table-bordered table-hover table-responsive');

  $('table').addClass('table table-striped table-bordered table-hover');


	// For lightbvox effect. Look for links with images and add a class
	if ( $('body').is('.page, .single-post') )
	{
		$('.wp_content p a img, .element-columns p a img, .gallery-row a img').each(function () {
		    $(this).parent().addClass('lightGallery');
		});

		// Now do something with them
		//$('a.lightGallery').fluidbox();

		// $('.content a').attr('data-src', 'imagelightbox');
	}


	// Responsive helpers
	$('.element-contents iframe, .element-contents object, .element-contents embed:not(.slider)').wrap('<div class="embed-container"></div>');


	// remove image widths & heights
	$('img, iframe, figure').not('.keep-sizing, .element-instagramfeed img').each(function(){
		$(this).removeAttr('width');
		$(this).removeAttr('height');
	});

	// To get the JetPack image galleries to load at the correct size, we need to fake a resize of the widow to trigger them
	$('.tab-link').click(function() {

		setTimeout(function(){
		     $(window).trigger('resize');
		}, 200);

	});

	// If this ia a 'page' or a 'post', but not the contact us page
	if ( $('body').is('.page, .archive, .single-post') ) {

		$('.gform_wrapper, .gf_progressbar_wrapper, .gform_page, .gform_fields').addClass('row');

		$('.gform_wrapper form, .gf_progressbar_title, .gf_progressbar, .gform_body, .gform_page_fields, .gform_wrapper ul.gform_fields li, .gform_wrapper .ginput_complex .name_prefix, .gform_wrapper .ginput_complex .ginput_full').addClass('col-xs-12');

		$('.gform_wrapper .gfield').wrapInner('<fieldset class="form-group"></fieldset>');


		if ( $('.gform_wrapper .gf_progressbar') )
		{
			var totalPercentValue = $('.gform_wrapper .gf_progressbar span').text();
			var percentValue = totalPercentValue.match(/\d+/); // 123456
			// alert(percentValue);

			$('.gform_wrapper gf_progressbar_percentage').remove();

			$('.gform_wrapper .gf_progressbar').html(function() {

				return '<progress class="progress progress-striped progress-success progress-animated" value="'+ percentValue +'" max="100">'+ totalPercentValue +'</progress>';
			})
		}

   if ( $('.gform_wrapper .field-name') )
	 {

		//var elementcount = $('.gform_wrapper .field-name .ginput_complex').children('div span').length;

		// Add a class so we can target them
		$('.gform_wrapper .field-name .ginput_complex span').not('.name_prefix').addClass('name-field');

		// Add a defalt size to elements
		$('.gform_wrapper .ginput_complex .name_prefix, .gform_wrapper .ginput_complex .name_first, .gform_wrapper .ginput_complex .name_middle, .gform_wrapper .ginput_complex .name_last, .gform_wrapper .ginput_complex .name_suffix').addClass('col-xs-12 form-group');

		$('.field_sublabel_below .ginput_complex span label').addClass('text-muted');


		// 5
		if ( $('.ginput_container_name').hasClass('gf_name_has_5') )
		{
			//$('.ginput_complex').addClass(''+count+'');

			$('.gform_wrapper .ginput_complex .name_prefix').addClass('col-md-1');

			$('.gform_wrapper .ginput_complex .name_first, .gform_wrapper .ginput_complex .name_last').addClass('col-md-3');

			$('.gform_wrapper .ginput_complex .name_middle').addClass('col-md-4');

			$('.gform_wrapper .ginput_complex .name_suffix').addClass('col-md-1');
		}

		// 4
		else if ( $('.ginput_container_name').hasClass('gf_name_has_4') )
		{
			//$('.ginput_complex').addClass(''+count+'');

			$('.gform_wrapper .ginput_complex .name_prefix').removeClass('col-xs-12').addClass('col-xs-1');

			$('.gform_wrapper .ginput_complex .name_first, .gform_wrapper .ginput_complex .name_last').removeClass('col-xs-12').addClass('col-xs-4');

			$('.gform_wrapper .ginput_complex .name_middle, .gform_wrapper .ginput_complex .name_suffix').removeClass('col-xs-12').addClass('col-xs-3');
		}

		// 3
		else if ( $('.ginput_container_name').hasClass('gf_name_has_3') )
		{
			//$('.ginput_complex').addClass(''+count+'');

			$('.gform_wrapper .ginput_complex .name_prefix').removeClass('col-xs-12').addClass('col-xs-2');

			$('.gform_wrapper .ginput_complex .name_first, .gform_wrapper .ginput_complex .name_middle, .gform_wrapper .ginput_complex .name_last, .gform_wrapper .ginput_complex .name_suffix').removeClass('col-xs-12').addClass('col-md-5');
		}

		// 2
		else if ( $('.ginput_container_name').hasClass('gf_name_has_2') )
		{
			//$('.ginput_complex').addClass(''+count+'');

			$('.gform_wrapper .ginput_complex .name_first, .gform_wrapper .ginput_complex .name_middle, .gform_wrapper .ginput_complex .name_last, .gform_wrapper .ginput_complex .name_suffix').removeClass('col-xs-12').addClass('col-md-6');
		}

		// 1
		else if ( $('.ginput_container_name').hasClass('gf_name_has_1') )
		{
			// $('.ginput_complex').addClass(''+count+'');

			$('.gform_wrapper .ginput_complex .name_first, .gform_wrapper .ginput_complex .name_middle, .gform_wrapper .ginput_complex .name_last, .gform_wrapper .ginput_complex .name_suffix').addClass('col-md-12');
		}
  }


		// For footer form only
		$('footer .gform_wrapper .ginput_complex .name_prefix').removeClass('col-xs-12').addClass('col-xs-12 col-md-4');

		$('footer .gform_wrapper label').addClass('input-group-addon');

		$('footer .gform_wrapper .btn').addClass('col-xs-4');

		$('footer .gform_wrapper form').addClass('form-inline');

		$('footer .gform_wrapper ul.gform_fields, .gform_wrapper .ginput_complex').addClass('row');

		$('footer .gform_wrapper ul.gform_fields li, .gform_wrapper .ginput_complex .name_prefix, .gform_wrapper .ginput_complex .ginput_full').addClass('form-group col-xs-12');

		$('footer .gform_wrapper .ginput_complex .ginput_left, .gform_wrapper .ginput_complex .ginput_right').addClass('form-group col-xs-12 col-md-6');

		$('footer .gform_wrapper .name_first').parents('li').addClass('field-name');

		$('footer .gform_wrapper #field_1_2 .ginput_container').after('<span class="input-group-addon submit"></span>');

		var button = $('footer .gform_wrapper .gform_footer input.gform_button').addClass('btn btn-danger');

		$('footer .gform_wrapper .gform_footer input.gform_button').detach();

		$('footer .gform_wrapper .gform_footer .row').remove();

		$('footer .gform_wrapper #field_1_2 .input-group-addon.submit').append(button);




		// Errors
		$('.gform_wrapper .gfield_error').addClass('inputWarning');
		$('.gform_wrapper .validation_error').addClass('alert');
		$('.gform_wrapper .validation_error').addClass('alert-error');

		// Success
		$('.gform_confirmation_message').addClass('alert alert-success');


		// Time
		$('.gform_wrapper .gfield_time_hour, .gform_wrapper .gfield_time_minute, .gform_wrapper article .gfield_time_ampm').closest( '.size' ).addClass('col-xs-12 col-sm-4');


		// Date Picker
		$('.gform_wrapper .datepicker').closest( '.ginput_container' ).addClass('datepicker_container');


		// Buttons
    $('article .gform_wrapper input[type="submit"]').wrap('<div class="row"><div class="col-xs-12"></div></div>');
    $('article .gform_wrapper input[type="submit"]').addClass('btn btn-danger col-xs-12');
    $('article .gform_wrapper .gform_next_button').addClass('pull-right');
    $('article .gform_wrapper .gform_page_footer').addClass('row').wrapInner('<div class="col-xs-12"></div>');
    $('article .gform_wrapper .gform_button').addClass('controls');

		//*//
		// Material Design
		if ( $('body').is('.material-design-active') )
		{

			$('input[type=text], input[type=email], input[type=url], textarea, select').addClass('form-control');
			$('input[type=text], input[type=email], input[type=url], textarea').addClass('loating-label');

			$('.gf_progressbar').addClass('progress progress-striped active');
			$('.gf_progressbar_percentage').addClass('progress-bar progress-bar-info');

			$('.gfield_radio li').each(function()
			{
				var input = $(this).find('input'); 	// Find the input
				var label = $(this).find('label'); 	// Find the label
				$(input).detach().appendTo(label);	// Move the input inside of the label
				$(this).wrapInner('<div class="radio radio-primary"></div>');
				$(label).append('<span class="circle"></span><span class="check"></span>');
			});

			$('.gfield_checkbox li').each(function()
			{
				var input = $(this).find('input'); 	// Find the input
				var label = $(this).find('label'); 	// Find the label
				$(this).addClass('checkbox');
				$(input).detach().prependTo(label);	// Move the input inside of the label befoe the text
				$(label).prepend('<span class="checkbox-material"><span class="check"></span></span>');
			});

			$('.ginput_container_fileupload').each(function()
			{
				$(this).addClass('form-control-wrapper fileinput');
				$(this).append('<input type="text" readonly="" class="form-control"><div class="floating-label">Browse...</div><span id="extensions_message" class="screen-reader-text"></span>');
			});

			$('input.gform_previous_button, input.gform_next_button').addClass('btn btn-default').after('<div class="ripple-wrapper"></div>');
		}
		//*//

/**/
  }


  // Parallax Power (getting things ready)

	// Hide the nav when we scroll down the page, but bring it back when we scroll up

	var mywindow = $(window);
	var mypos = mywindow.scrollTop();
	var up = false;
	var newscroll;
	mywindow.scroll(function () {
	    newscroll = mywindow.scrollTop();
	    if (newscroll > mypos && !up) {
	      	$('.navbar-fixed-top, .mouse-scroll').stop().fadeToggle('slow', 'linear'); // Fade out on SCROLL DOWN
	        $('.mouse-scroll').stop().fadeToggle('slow', 'linear'); // Fade out on SCROLL DOWN
	      // $('.spacer').stop().slideToggle(); // reduce the height of the spacer that mimics the header depth

	        up = !up;
	       // console.log(up);
	    } else if(newscroll < mypos && up) {
	      	$('.navbar-fixed-top, .mouse-scroll').stop().fadeToggle('slow', 'linear'); // Fade in on SCROLL UP
	        $('.mouse-scroll').stop().fadeToggle('slow', 'linear'); // Fade in on SCROLL UP
	       // $('.spacer').stop().slideToggle(); // increase the height of the spacer that mimics the header depth
	        up = !up;
	    }
	    mypos = newscroll;
	});


/*
	// Vars for resizing the logo when needed
	var websiteLogoWidthRaw = $('.website-logo').width(); // Find the width

    var websiteLogoWidthStart 	= websiteLogoWidthRaw;
    var websiteLogoWidthFinish 	= (websiteLogoWidthStart / 100 * 60); // working out 60% of the original value

    var websiteNavMarginRaw = $('#menu-primary-navigation').css('margin-top').replace(/[^-\d\.]/g, ''); // get the margin without the 'px' text

	var websiteNavMarginStart 	= websiteNavMarginRaw;
	var websiteNavMarginFinish 	= (websiteNavMarginStart / 100 * 35); // working out 35% of the original value

    // alert(''+ websiteNavMargin +''); // For development
/*
	// Shrink the logo when we go down the page
	$('.logo').attr('data-207', 'margin-left: -30%; margin-bottom: 15px;');
	$('.logo').attr('data-300', 'margin-left: -30%; margin-bottom: 0;');

	$('.website-logo').attr('data-207', 'width: '+ websiteLogoWidthStart +'px; height: auto;');
	$('.website-logo').attr('data-300', 'width: '+ websiteLogoWidthFinish +'px; height: auto;');
*/
	// alert(''+websiteNavMarginFinish+'');

/*
	$('.header-meta-area').attr('data-207', 'margin-top: 7%;');
	$('.header-meta-area').attr('data-300', 'margin-top: 2.5%;');


	// Header Animation
	$('#menu-primary-navigation').attr('data-207', 'margin-top: '+ websiteNavMarginStart +'px;');
	$('#menu-primary-navigation').attr('data-300', 'margin-top: '+ websiteNavMarginFinish +'px;');
*/

	setTimeout(function(){
		//if ( $('html').hasClass('mobile') ) {

			//alert(bodyClass);

			// Parallax Power from Skrollr

			var s = skrollr.init({
				forceHeight: false,
				render: function(data) {

					//Log the current scroll position & show it in our div.
					$('#scroll-info').text(data.curTop + 'px');
				},

				constants: {
					//fill the box for a "duration" of 150% of the viewport (pause for 150%)
					//adjust for shorter/longer pause
					//box: '1900',
					//sequence: '280'
					forceHeight: false
				}


				});
/*
				s.setScrollTop(0);

				skrollr.init({
					forceHeight: false
				});
*/
		//}



	}, 1000);




	// Stops the overscroll that is on a mac and causes issues with nav see https://github.com/lloeki/unelastic
    if ($('body.mac')) {

		(function () {

		var debug = 0;

		var MODES = { 'CSS':    'css',
		              'JS':     'js',
		              'HYBRID': 'hybrid',
		              'NATIVE': 'native' };

		var defaultMode = MODES.JS;
		var modeMap = { '.*\\.pdf$': MODES.CSS,
		                'play\\.google\\.com/music/listen': MODES.CSS };

		detectMode = function () {
		    var location = document.location;
		    var mode;

		    for (var re in modeMap) {
		        if (modeMap.hasOwnProperty(re)) {
		            if ((new RegExp(re)).test(location)) {
		                mode = modeMap[re];
		                if (debug === 1) {
		                    console.log("mode " + mode + " matched with: " + re);
		                }
		                break;
		            }
		        }
		    }

		    return (mode || defaultMode);
		};

		var scrollHandler = function (e, mode) {
		    var stopScroll = false;
		    var stopScrollX = false;
		    var stopScrollY = false;

		    var deltaX = e.wheelDeltaX;
		    var deltaY = e.wheelDeltaY;

		    var scrollToX = window.scrollX - deltaX;
		    var scrollToY = window.scrollY - deltaY;

		    var scrollMaxX = document.body.scrollWidth - window.innerWidth;
		    var scrollMaxY = document.body.scrollHeight - window.innerHeight;

		    var scrollX = window.scrollX;
		    var scrollY = window.scrollY;

		    if (debug > 1) {
		        console.log("body", document.body.scrollWidth, document.body.scrollHeight);
		        console.log("window", window.innerWidth, window.innerHeight);
		        console.log("scroll", window.scrollX, window.scrollY);
		        console.log("scrollMax", scrollMaxX, scrollMaxY);
		        console.log("delta", deltaX, deltaY);
		    }

		    if (deltaX > 0 && scrollX <= 0) {
		        stopScrollX = true;
		        scrollToX = 0;
		    }

		    if (deltaY > 0 && scrollY <= 0) {
		        stopScrollY = true;
		        scrollToY = 0;
		    }

		    if (deltaX < 0 && scrollX >= scrollMaxX) {
		        stopScrollX = true;
		        scrollToX = scrollMaxX;
		    }

		    if (deltaY < 0 && scrollY >= scrollMaxY) {
		        stopScrollY = true;
		        scrollToY = scrollMaxY;
		    }

		    if (debug > 0) {
		        console.log("stopScroll", stopScrollX, stopScrollY);
		    }

		    if (mode === MODES.HYBRID) {
		        document.documentElement.classList.remove('unelasticX');
		        document.documentElement.classList.remove('unelasticY');

		        if (stopScrollX) {
		            document.documentElement.classList.add('unelasticX');
		        }

		        if (stopScrollY) {
		            document.documentElement.classList.add('unelasticY');
		        }
		    }

		    if (mode === MODES.JS) {
		        if (stopScrollX || stopScrollY) {
		            e.preventDefault();
		            e.stopPropagation();
		            window.scroll(scrollToX, scrollToY);
		        }

		        return (stopScrollX || stopScrollY);
		    }
		};


		/* main */

		var mode = detectMode();

		if (mode === MODES.JS || mode === MODES.HYBRID) {
		    document.addEventListener('mousewheel',
		    	function (e) { scrollHandler(e, mode); },
		        false);
		}


		if (mode === MODES.CSS) {
		    document.addEventListener('DOMContentLoaded', function () {
		        document.documentElement.classList.add('unelastic');
		    });
		}

		})();
    }

	$( window ).resize(function() {
		var windowWidth = $(window).width();

		$(window).width(windowWidth - 1);

		console.log(windowWidth);

		/*
	  	var websiteLogoWidthRaw 	= $('.website-logo').width();
		var websiteLogoWidthStart 	= websiteLogoWidthRaw;
		var websiteLogoWidthFinish 	= (websiteLogoWidthStart / 100 * 60); // working out 60% of the original value

		$('.website-logo').removeAttr( 'data-207' );
		$('.website-logo').removeAttr( 'data-300' );

		$('.website-logo').attr('data-207', 'width: '+ websiteLogoWidthStart +'px; height: auto;');
		$('.website-logo').attr('data-300', 'width: '+ websiteLogoWidthFinish +'px; height: auto;');*/
/*
			var fullWindowHeight 	= $(window).height();

			var navBarHeight		= $('.navbar-fixed-top').height();

			var windowHeight 		= fullWindowHeight - navBarHeight;

			$('ul.dropdown-menu').height(windowHeight);
*/
	});



	setTimeout(function(){
		$(window).trigger('resize'); // fixes so odd resize trigger in Safari on gallaries
	}, 1000);

	// Remove the 'no scroll' on mobiles being added by 'something'
	$('html,body').css('overflow', ''); // passing value as null removes it

	/*
	var container = document.querySelector('footer .footer-logos');
	var msnry = new Masonry( container, {
	  // options
	  // columnWidth: 200,
	  itemSelector: '.logo-container'
	});*/

});
