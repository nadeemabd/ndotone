/* global colorScheme, Color */
/**
 * Add a listener to the Color Scheme control to update other color controls to new values/defaults.
 * Also trigger an update of the Color Scheme CSS when a color is changed.
 */

(function (api) {
	var cssTemplate = wp.template('ndotone-color-scheme'),
			colorSchemeKeys = [
				'header_textcolor',
				'content_background_color',
				'main_text_color',
				'secondary_text_color',
				'primary_link_color',
				'secondary_link_color',
				'sidebar_color',
				'border_color'
			],
			colorSettings = [
				'header_textcolor',
				'secondary_text_color',
				'primary_link_color',
				'sidebar_color'
			];

	api.controlConstructor.select = api.Control.extend({
		ready: function () {
			if ('color_scheme' === this.id) {
				this.setting.bind('change', function (value) {
					var colors = colorScheme[value].colors;

					//Update Header Text Color.
					var color = colors[0];
					api('header_textcolor').set(color);
					api.control('header_textcolor').container.find('.color-picker-hex')
							.data('data-default-color', color)
							.wpColorPicker('defaultColor', color);

					// Update Secondary Text Color.
					color = colors[3];
					api('secondary_text_color').set(color);
					api.control('secondary_text_color').container.find('.color-picker-hex')
							.data('data-default-color', color)
							.wpColorPicker('defaultColor', color);

					// Update Primary Link Color.
					color = colors[4];
					api('primary_link_color').set(color);
					api.control('primary_link_color').container.find('.color-picker-hex')
							.data('data-default-color', color)
							.wpColorPicker('defaultColor', color);

					// Update Sidebar Color.
					color = colors[6];
					api('sidebar_color').set(color);
					api.control('sidebar_color').container.find('.color-picker-hex')
							.data('data-default-color', color)
							.wpColorPicker('defaultColor', color);

				});
			}
		}
	});

	// Generate the CSS for the current Color Scheme.
	function updateCSS() {
		var scheme = api('color_scheme')(),
				css,
				colors = _.object(colorSchemeKeys, colorScheme[scheme].colors);

		// Merge in color scheme overrides.
		_.each(colorSettings, function (setting) {
			colors[setting] = api(setting)();
		});

		// Add additional color.
		// jscs:disable
		colors.border_color = Color(colors.border_color).toCSS('rgba', 0.2);
		colors.secondary_link_color = Color(colors.secondary_text_color).toCSS('rgba', 0.7);
		// jscs:enable

		css = cssTemplate(colors);

		api.previewer.send('update-color-scheme-css', css);
	}

	// Update the CSS whenever a color setting is changed.
	_.each(colorSettings, function (setting) {
		api(setting, function (setting) {
			setting.bind(updateCSS);
		});
	});
})(wp.customize);
