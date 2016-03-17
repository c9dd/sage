import "../styles/main.scss";

import $ from 'jquery';
import Router from './util/router';

// Import Bootstrap
import "bootstrap/dist/js/umd/util.js";
import "bootstrap/dist/js/umd/alert.js";
import "bootstrap/dist/js/umd/button.js";
import "bootstrap/dist/js/umd/carousel.js";
import "bootstrap/dist/js/umd/collapse.js";
import "bootstrap/dist/js/umd/dropdown.js";
import "bootstrap/dist/js/umd/modal.js";
import "bootstrap/dist/js/umd/scrollspy.js";
import "bootstrap/dist/js/umd/tab.js";
import "bootstrap/dist/js/umd/tooltip.js";
import "bootstrap/dist/js/umd/popover.js";

// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.
var Sage = {
	// All pages
	'common': {
		init: function() {
			// JavaScript to be fired on all pages
		},
		finalize: function() {
			// JavaScript to be fired on all pages, after page specific JS is fired


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
							//$('.spacer').stop().slideToggle(); // reduce the height of the spacer that mimics the header depth

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



			// Responsive helpers
			$('.element-contents iframe, .element-contents object, .element-contents embed:not(.slider)').wrap('<div class="embed-container"></div>');

			// Remove image widths & heights
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

			// 404 page
			$('body.error404').wrapInner('<div class="error404-bg"></div>');

			// Tables
			$('table').addClass('table table-striped table-bordered table-hover table-responsive');

			// For lightbvox effect. Look for links with images and add a class
			if ( $('body').is('.page, .single-post') )
			{
				$('.wp_content p a img, .element-columns p a img, .gallery-row a img').each(function () {
						$(this).parent().addClass('lightGallery');
				});

				// Now do something with them
				// $('a.lightGallery').fluidbox();

				// $('.content a').attr('data-src', 'imagelightbox');
			}

			// For knowing the window width
			$( window ).resize(function() {
				var windowWidth = $(window).width();

				$(window).width(windowWidth - 1);

				console.log(windowWidth);
			});

      setTimeout(function(){
        $(window).trigger('resize'); // fixes so odd resize trigger in Safari on gallaries
      }, 1000);

      // Remove the 'no scroll' on mobiles being added by 'something'
      $('html,body').css('overflow', ''); // passing value as null removes it


		}
	},
	// Home page
	'home': {
		init: function() {
			// JavaScript to be fired on the home page
		},
		finalize: function() {
			// JavaScript to be fired on the home page, after the init JS
		}
	},
	// About us page, note the change from about-us to about_us.
	'about_us': {
		init: function() {
			// JavaScript to be fired on the about us page
		}
	}
};

// Load Events
$(document).ready(function () {
	new Router(Sage).loadEvents();
	$('body').addClass('yep');
});
