//import "../styles/main.scss";
import "../vendor/animate.css-master/animate.min.css";

import $ from 'jquery';
import Router from './util/router';

// NOTE:
// Import Bootstrap
import 'bootstrap/dist/js/umd/util.js';
import 'bootstrap/dist/js/umd/alert.js';
import 'bootstrap/dist/js/umd/button.js';
import 'bootstrap/dist/js/umd/carousel.js';
import 'bootstrap/dist/js/umd/collapse.js';
import 'bootstrap/dist/js/umd/dropdown.js';
import 'bootstrap/dist/js/umd/modal.js';
import 'bootstrap/dist/js/umd/scrollspy.js';
import 'bootstrap/dist/js/umd/tab.js';
import 'bootstrap/dist/js/umd/tooltip.js';
import 'bootstrap/dist/js/umd/popover.js';


// NOTE:
// Use this variable to set up the common and page specific functions. If you
// rename this variable, you will also need to rename the namespace below.

var Sage = {
	// NOTE:
	// All pages
	'common': {
		init: function() {
			// NOTE:
			// JavaScript to be fired on all pages


			// for animating elements on scroll
			var viewport = $(window),
			setVisible   = function () {
					var viewportTop    			= viewport.scrollTop(),
							viewportBottom 			= viewport.scrollTop() + viewport.height();

					$('.animate-elements').each(function () {
						$(this).find('*[data-animate="true"]').not('.element-slider').each(function () {
							var animationType 	= $(this).data('animation-type');

							var self = $(this),
									top 						= self.offset().top,
									bottom 					= top + self.height(),
									topOnScreen 		= top >= viewportTop && top <= viewportBottom,
									bottomOnScreen 	= bottom >= viewportTop && bottom <= viewportBottom,
									elemVisible 		= topOnScreen || bottomOnScreen;

							self.toggleClass('animated '+animationType+'', elemVisible);
						});
					});
			};

			viewport.scroll(setVisible);
			setVisible();


		},
		finalize: function() {
			// NOTE:
			// JavaScript to be fired on all pages, after page specific JS is fired

			// NOTE:
			// Hide the nav when we scroll down the page, but bring it back when we scroll up
			var mywindow = $(window);
			var mypos = mywindow.scrollTop();
			var up = false;
			var newscroll;
			mywindow.scroll(function () {
				newscroll = mywindow.scrollTop();
				if (newscroll > mypos && !up)
				{
					$('.navbar-fixed-top, .mouse-scroll').stop().fadeToggle('slow', 'linear'); // Fade out on SCROLL DOWN
					$('.mouse-scroll').stop().fadeToggle('slow', 'linear'); // Fade out on SCROLL DOWN
					// $('.spacer').stop().slideToggle(); // reduce the height of the spacer that mimics the header depth

					up = !up;
					// console.log(up);
				}
				else if(newscroll < mypos && up)
				{
					$('.navbar-fixed-top, .mouse-scroll').stop().fadeToggle('slow', 'linear'); // Fade in on SCROLL UP
					$('.mouse-scroll').stop().fadeToggle('slow', 'linear'); // Fade in on SCROLL UP
					// $('.spacer').stop().slideToggle(); // increase the height of the spacer that mimics the header depth
					up = !up;
				}
				mypos = newscroll;
			});


			// NOTE:
			// Responsive helpers
			$('.element-contents iframe, .element-contents object, .element-contents embed:not(.slider)').wrap('<div class="embed-container"></div>');

			// NOTE:
			// Remove image widths & heights
			$('img, iframe, figure').not('.keep-sizing, .element-instagramfeed img').each(function(){
				$(this).removeAttr('width');
				$(this).removeAttr('height');
			});

			// NOTE:
			// To get the JetPack image galleries to load at the correct size, we need to fake a resize of the widow to trigger them
			$('.tab-link').click(function() {

				setTimeout(function(){
							$(window).trigger('resize');
				}, 200);

			});

			// NOTE:
			// 404 page
			$('body.error404').wrapInner('<div class="error404-bg"></div>');

			// NOTE:
			// Tables
			$('table').addClass('table table-striped table-bordered table-hover table-responsive');

			// NOTE:
			// For lightbvox effect. Look for links with images and add a class
			if ( $('body').is('.page, .single-post') )
			{
				$('.wp_content p a img, .element-columns p a img, .gallery-row a img').each(function () {
						$(this).parent().addClass('lightGallery');
				});

				// NOTE:
				// Now do something with them
				// $('a.lightGallery').fluidbox();

				// $('.content a').attr('data-src', 'imagelightbox');
			}

			// NOTE:
			// For knowing the window width
			$( window ).resize(function() {
				var windowWidth = $(window).width();

				$(window).width(windowWidth - 1);

				console.log(windowWidth);
			});

			setTimeout(function(){
				$(window).trigger('resize'); // fixes so odd resize trigger in Safari on gallaries
			}, 1000);

			// NOTE:
			// Remove the 'no scroll' on mobiles being added by 'something'
			$('html,body').css('overflow', ''); // passing value as null removes it


			// NOTE:
			// GRAVITY FORMS
			// If this ia a 'page' or a 'post' (but not the contact us page), that has a gravity form on it
			if ( $('body').is('.page, .archive, .single-post') )
			{

				if ( $('div').is('.gform_wrapper') )
				{

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

						// NOTE:
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

					// NOTE:
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



					// NOTE
					// Errors
					$('.gform_wrapper .gfield_error').addClass('inputWarning');
					$('.gform_wrapper .validation_error').addClass('alert');
					$('.gform_wrapper .validation_error').addClass('alert-error');


					// NOTE
					// Success
					$('.gform_confirmation_message').addClass('alert alert-success');


					// NOTE
					// Time
					$('.gform_wrapper .gfield_time_hour, .gform_wrapper .gfield_time_minute, .gform_wrapper article .gfield_time_ampm').closest( '.size' ).addClass('col-xs-12 col-sm-4');


					// NOTE
					// Date Picker
					$('.gform_wrapper .datepicker').closest( '.ginput_container' ).addClass('datepicker_container');

					// NOTE
					// Buttons
					$('article .gform_wrapper input[type="submit"]').wrap('<div class="row"><div class="col-xs-12"></div></div>');
					$('article .gform_wrapper input[type="submit"]').addClass('btn btn-danger col-xs-12');
					$('article .gform_wrapper .gform_next_button').addClass('pull-right');
					$('article .gform_wrapper .gform_page_footer').addClass('row').wrapInner('<div class="col-xs-12"></div>');
					$('article .gform_wrapper .gform_button').addClass('controls');


					// NOTE
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
				}
			}
		}
	},

	// NOTE:
	// Home page
	'home': {
		init: function() {
			// NOTE:
			// JavaScript to be fired on the home page
		},
		finalize: function() {
			// NOTE:
			// JavaScript to be fired on the home page, after the init JS
		}
	},

	// NOTE:
	// About us page, note the change from about-us to about_us.
	'about_us': {
		init: function() {
			// NOTE:
			// JavaScript to be fired on the about us page
		}
	}
};
// NOTE:
// Load Events
$(document).ready(function () {
	new Router(Sage).loadEvents();
	$('body').addClass('yep');
});
