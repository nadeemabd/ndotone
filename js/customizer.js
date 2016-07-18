/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	var style = $('#ndotone-color-scheme-css'),
			api = wp.customize;

	if (!style.length) {
		style = $('head').append('<style type="text/css" id="ndotone-color-scheme-css" />')
				.find('#ndotone-color-scheme-css');
	}

	// Color Scheme CSS.
	api.bind('preview-ready', function () {
		api.preview.bind('update-color-scheme-css', function (css) {
			style.html(css);
		});
	});
} )( jQuery );
