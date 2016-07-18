<?php
/**
 * ndotone Theme Customizer.
 *
 * @package ndotone
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function ndotone_customize_register( $wp_customize ) {

	$color_scheme = ndotone_get_color_scheme();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
				'selector' => '.site-title a',
				'container_inclusive' => false,
				'render_callback' => 'ndotone_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
				'selector' => '.site-description',
				'container_inclusive' => false,
				'render_callback' => 'ndotone_customize_partial_blogdescription',
		) );
	}

	// Add color scheme setting and control.
	$wp_customize->add_setting('color_scheme', array(
			'default'           => 'default',
			'sanitize_callback' => 'ndotone_sanitize_color_scheme',
			'transport'         => 'postMessage',
	));

	$wp_customize->add_control('color_scheme', array(
			'label'     => __('Base Color Scheme', 'ndotone'),
			'section'   => 'colors',
			'type'      => 'select',
			'choices'   => ndotone_get_color_scheme_choices(),
			'priority'  => 1,
	));

	// Remove the core background color control, as it shares the main text color.
	$wp_customize->remove_setting( 'background_color' );

	// Add secondary text color setting and control.
	$wp_customize->add_setting('secondary_text_color', array(
			'default'           => $color_scheme[3],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'secondary_text_color', array(
			'label'     => __('Secondary Text Color', 'ndotone'),
			'section'   => 'colors',
	)));

	// Add primary link color setting and control.
	$wp_customize->add_setting('primary_link_color', array(
			'default'           => $color_scheme[4],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'primary_link_color', array(
			'label'     => __('Primary Link Color', 'ndotone'),
			'section'   => 'colors',
	)));

	// Add sidebar color setting and control.
	$wp_customize->add_setting('sidebar_color', array(
			'default'           => $color_scheme[6],
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
	));

	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'sidebar_color', array(
			'label'     => __('Sidebar Color', 'ndotone'),
			'section'   => 'colors',
	)));
}
add_action( 'customize_register', 'ndotone_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @since ndotone 1.2
 * @see ndotone_customize_register()
 *
 * @return void
 */
function ndotone_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @since ndotone 1.2
 * @see ndotone_customize_register()
 *
 * @return void
 */
function ndotone_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Registers color schemes for ndotone.
 *
 * Can be filtered with {@see 'ndotone_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Header Text Color
 * 2. Content Background Color
 * 3. Main Text Color.
 * 4. Secondary Text Color.
 * 5. Primary Link Color.
 * 6. Secondary Link Color.
 * 7. Sidebar Color
 * 8. Border Color
 *
 * @since ndotone 1.0
 *
 * @return array An associative array of color scheme options.
 */
function ndotone_get_color_schemes()
{
	/**
	 * Filter the color schemes registered for use with ndotone.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'yellow'.
	 *
	 * @since ndotone 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 * @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 * @type string $label Color scheme label.
	 * @type array $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, page
	 *                              background, link, main text, secondary text.
	 *     }
	 * }
	 */
	return apply_filters('ndotone_color_schemes', array(
			'default' => array(
					'label' => __('Default', 'ndotone'),
					'colors' => array(
							'#ffffff',
							'#ffffff',
							'#262626',
							'#ffffff',
							'#FF561C',
							'#888888',
							'#262626',
							'#262626',
					),
			),
			'dark' => array(
					'label' => __('Dark', 'ndotone'),
					'colors' => array(
							'#bebebe',
							'#111111',
							'#bebebe',
							'#bebebe',
							'#2b4856',
							'#e5e5e5',
							'#202020',
							'#bebebe',
					),
			),
			'light' => array(
					'label' => __('Light', 'ndotone'),
					'colors' => array(
							'#ffffff',
							'#ffffff',
							'#262626',
							'#262626',
							'#88d651',
							'#888888',
							'#e3e3e3',
							'#262626',
					),
			),
			'blue-dark' => array(
					'label' => __('Blue Dark', 'ndotone'),
					'colors' => array(
							'#bebebe',
							'#111111',
							'#bebebe',
							'#ffffff',
							'#2b4856',
							'#e5e5e5',
							'#55c3dc',
							'#2b4856',
					),
			),

			'blue-light' => array(
					'label' => __('Blue Light', 'ndotone'),
					'colors' => array(
							'#ffffff',
							'#ffffff',
							'#22313f',
							'#22313f',
							'#dd3333',
							'#e5e5e5',
							'#55c3dc',
							'#22313f',
					),
			),
	));
}

if (!function_exists('ndotone_get_color_scheme')) :
	/**
	 * Retrieves the current ndotone color scheme.
	 *
	 * Create your own ndotone_get_color_scheme() function to override in a child theme.
	 *
	 * @since ndotone 1.0
	 *
	 * @return array An associative array of either the current or default color scheme HEX values.
	 */
	function ndotone_get_color_scheme()
	{
		$color_scheme_option = get_theme_mod('color_scheme', 'default');
		$color_schemes = ndotone_get_color_schemes();

		if (array_key_exists($color_scheme_option, $color_schemes)) {
			return array_map('strtolower', $color_schemes[$color_scheme_option]['colors']);
		}

		return array_map('strtolower', $color_schemes['default']['colors']);

	}
endif; // ndotone_get_color_scheme

if (!function_exists('ndotone_get_color_scheme_choices')) :
	/**
	 * Retrieves an array of color scheme choices registered for ndotone.
	 *
	 * Create your own ndotone_get_color_scheme_choices() function to override
	 * in a child theme.
	 *
	 * @since ndotone 1.0
	 *
	 * @return array Array of color schemes.
	 */
	function ndotone_get_color_scheme_choices()
	{
		$color_schemes = ndotone_get_color_schemes();
		$color_scheme_control_options = array();

		foreach ($color_schemes as $color_scheme => $value) {
			$color_scheme_control_options[$color_scheme] = $value['label'];
		}

		return $color_scheme_control_options;
	}
endif; // ndotone_get_color_scheme_choices

if (!function_exists('ndotone_sanitize_color_scheme')) :
	/**
	 * Handles sanitization for ndotone color schemes.
	 *
	 * Create your own ndotone_sanitize_color_scheme() function to override
	 * in a child theme.
	 *
	 * @since ndotone 1.0
	 *
	 * @param string $value Color scheme name value.
	 * @return string Color scheme name.
	 */
	function ndotone_sanitize_color_scheme($value)
	{
		$color_schemes = ndotone_get_color_scheme_choices();

		if (!array_key_exists($value, $color_schemes)) {
			return 'default';
		}

		return $value;
	}
endif; // ndotone_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since ndotone 1.0
 *
 * @see wp_add_inline_style()
 */
function ndotone_color_scheme_css()
{
	$color_scheme_option = get_theme_mod('color_scheme', 'default');

	// Don't do anything if the default color scheme is selected.
	if ('default' === $color_scheme_option) {
		return;
	}

	$color_scheme = ndotone_get_color_scheme();

	// Convert main text hex color to rgba.
	$color_bordercolor_rgb = ndotone_hex2rgb($color_scheme[7]);
	$color_sidebar_linkcolor_rgb = ndotone_hex2rgb($color_scheme[3]);

	// If we get this far, we have a custom color scheme.
	$colors = array(
			'header_textcolor'              => $color_scheme[0],
			'content_background_color'      => $color_scheme[1],
			'main_text_color'               => $color_scheme[2],
			'secondary_text_color'          => $color_scheme[3],
			'primary_link_color'			=> $color_scheme[4],
			'secondary_link_color'			=> vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.7)', $color_sidebar_linkcolor_rgb ),
			'sidebar_color'          		=> $color_scheme[6],
			'border_color'                  => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.1)', $color_bordercolor_rgb ),

	);

	$color_scheme_css = ndotone_get_color_scheme_css($colors);
	if ('default' !== $color_scheme_option) {
		wp_add_inline_style('ndotone-style', $color_scheme_css);
	} else {
		return;
	}
}

add_action('wp_enqueue_scripts', 'ndotone_color_scheme_css');

/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since ndotone 1.0
 */
function ndotone_customize_control_js()
{
	wp_enqueue_script('color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array('customize-controls', 'iris', 'underscore', 'wp-util'), '20150926', true);
	wp_localize_script('color-scheme-control', 'colorScheme', ndotone_get_color_schemes());
}

add_action('customize_controls_enqueue_scripts', 'ndotone_customize_control_js');

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function ndotone_customize_preview_js() {
	wp_enqueue_script( 'ndotone_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'ndotone_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since ndotone 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */
function ndotone_get_color_scheme_css($colors)
{
	$colors = wp_parse_args($colors, array(
			'header_textcolor'              => '',
			'content_background_color'      => '',
			'main_text_color'               => '',
			'secondary_text_color'          => '',
			'primary_link_color'			=> '',
			'secondary_link_color'			=> '',
			'sidebar_color'          		=> '',
			'border_color'                  => '',
	));

	return <<<CSS
	/* Color Scheme */

	/* Content Background Color */
	body {
		background-color: {$colors['content_background_color']};
	}

	.hfeed .overflow .post-content:after {
            background: linear-gradient(to bottom, rgba(255, 255, 255, 0) 0%, {$colors['content_background_color']} 50%);
        }

	/* Header Text Color */
	.site-title a,
	.site-description {
		color: {$colors['header_textcolor']};
	}

	/* Main Text Color */
	body,
	input,
	select,
	textarea,
	.hfeed .entry-title a,
 	.navigation .post-title,
 	.site-main #infinite-handle span,
	.entry-footer .cat-links a:hover {
		color: {$colors['main_text_color']};
	}

	button:hover,
	input[type="button"]:hover,
	input[type="reset"]:hover,
	input[type="submit"]:hover,
	input[type="text"]:hover,
	input[type="email"]:hover,
	input[type="url"]:hover,
	input[type="password"]:hover,
	input[type="search"]:hover,
	input[type="number"]:hover,
	input[type="tel"]:hover,
	input[type="range"]:hover,
	input[type="date"]:hover,
	input[type="month"]:hover,
	input[type="week"]:hover,
	input[type="time"]:hover,
	input[type="datetime"]:hover,
	input[type="datetime-local"]:hover,
	input[type="color"]:hover,
	textarea:hover,
	.pagination .page-numbers.current {
		border-color: {$colors['main_text_color']};
		color: {$colors['main_text_color']};
	}

	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="password"]:focus,
	input[type="search"]:focus,
	input[type="number"]:focus,
	input[type="tel"]:focus,
	input[type="range"]:focus,
	input[type="date"]:focus,
	input[type="month"]:focus,
	input[type="week"]:focus,
	input[type="time"]:focus,
	input[type="datetime"]:focus,
	input[type="datetime-local"]:focus,
	input[type="color"]:focus,
	textarea:focus {
		color: {$colors['main_text_color']};
	}

 	.site-main #infinite-handle span button::after {
		background-color: {$colors['main_text_color']};
	}

	/* Secondary Text Color */
	.widget,
	body.error404 .error-404 {
		color: {$colors['secondary_text_color']};
	}

	.widget .search-field:hover,
	body.error404 .search-form .search-field:hover {
		border-color: {$colors['secondary_text_color']};
	}

	.side-title .fa.fa-home {
		background-color: {$colors['secondary_text_color']};
	}

	/* Primary Link Color */
	a,
	.site-title a:hover,
	.site-title a:focus,
	.widget a:hover,
	.widget a:focus,
	.entry-footer a:hover,
	.entry-footer a:focus,
	.entry-footer .tags-links a:hover,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.hfeed .entry-title a:hover,
	.hfeed .entry-title a:focus,
	.search-form .search-submit:hover,
	.search-form .search-submit:focus,
	.widget .tagcloud a:hover,
	.site-footer a:hover,
	.site-footer a:focus,
	.site-main #infinite-handle span button:hover,
	.site-main #infinite-handle span button:focus {
        color: {$colors['primary_link_color']};
	}

	.main-navigation a:hover,
	.main-navigation a:focus,
	.main-navigation .nav-site-title:hover,
	.main-navigation .nav-site-title:focus,
	.menu-toggle:hover,
	.menu-toggle.toggled,
	.dropdown-toggle:hover,
	.dropdown-toggle.toggled:after {
		color: {$colors['primary_link_color']};
	}

	.navigation .nav-previous a:hover .meta-nav,
	.navigation .nav-previous a:focus .meta-nav,
	.navigation .nav-next a:hover .meta-nav,
	.navigation .nav-next a:focus .meta-nav,
	.pagination a:hover,
	.pagination a:focus,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus{
		 color: {$colors['primary_link_color']};
	}

 	.sticky-post,
 	mark,
 	ins,
 	.entry-footer .cat-links a:hover,
 	.side-title .fa.fa-home:hover,
 	.side-title .fa.fa-home:focus,
 	.hfeed .cover-link,
 	.site-main #infinite-handle span button:hover:after,
 	.site-main #infinite-handle span button:focus:after {
        background-color: {$colors['primary_link_color']};
	}

	.entry-footer .tags-links a:hover,
	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="password"]:focus,
	input[type="search"]:focus,
	input[type="number"]:focus,
	input[type="tel"]:focus,
	input[type="range"]:focus,
	input[type="date"]:focus,
	input[type="month"]:focus,
	input[type="week"]:focus,
	input[type="time"]:focus,
	input[type="datetime"]:focus,
	input[type="datetime-local"]:focus,
	input[type="color"]:focus,
	textarea:focus,
	.widget .search-field:focus,
	.widget .tagcloud a:hover,
	body.error404 .search-form .search-field:focus {
		border-color: {$colors['primary_link_color']};
	}

	/* Secondary Link Color */
	a:hover,
	a:focus,
	a:active,
	.main-navigation a,
	.main-navigation .nav-site-title,
	.widget a,
	.widget.widget_archive li,
	.widget ul li.cat-item,
	.widget select,
	.search-form .search-submit,
	.wp-caption-text,
	.site-footer,
	.site-footer a,
	.page-links,
	.navigation.post-navigation .meta-nav,
	.post-password-form label,
	.comment-metadata a,
	.menu-toggle,
	.dropdown-toggle,
	.pagination .nav-links,
	.pagination a,
	.entry-footer .cat-links a {
		color: {$colors['secondary_link_color']};
	}

	.search-field::-webkit-input-placeholder {
		color: {$colors['secondary_link_color']};
	}
	.search-field:-moz-placeholder {
		color:    {$colors['secondary_link_color']};
	}
	.search-field::-moz-placeholder {
		color:    {$colors['secondary_link_color']};
	}
	.search-field:-ms-input-placeholder {
		color:    {$colors['secondary_link_color']};
	}

	button, input[type="button"],
	input[type="reset"],
	input[type="submit"] {
		border-color: {$colors['secondary_link_color']};
		color: {$colors['secondary_link_color']};
	}

	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	input[type="number"],
	input[type="tel"],
	input[type="range"],
	input[type="date"],
	input[type="month"],
	input[type="week"],
	input[type="time"],
	input[type="datetime"],
	input[type="datetime-local"],
	input[type="color"],
	textarea {
		color: {$colors['secondary_link_color']};
		border-color: {$colors['secondary_link_color']};
	}

	.widget .widget-title:after {
		background-color: {$colors['secondary_link_color']};
	}

	.widget .search-field,
	.widget select,
	.widget .tagcloud a,
	.widget table,
	.main-navigation ul li,
	body.error404 .search-form .search-field {
		border-color: {$colors['secondary_link_color']};
	}

	/* Sidebar Color */
	.sidebar-right,
	.sidebar-left,
	.site-footer .site-info,
	.site-footer .social-navigation,
	.main-navigation,
	.main-navigation ul ul li,
	body.error404,
	body.error404 .error-404,
	body.error404 .search-form .search-field {
		background-color: {$colors['sidebar_color']};
	}

	.side-title .fa.fa-home {
			color: {$colors['sidebar_color']};
	}

	@media screen and (max-width: 1440px) {
		.site-footer .site-copyright,
		body.no-left-sidebar .site-info {
			background-color: {$colors['sidebar_color']};
		}
	}

	@media screen and (max-width: 1170px) {
		.site-footer .site-copyright,
		body.no-right-sidebar .social-navigation,
		body.no-right-sidebar .site-copyright {
			background-color: {$colors['sidebar_color']};
		}
	}

	/* Border Color */
	.main-navigation ul li,
	.hfeed .post-content,
	.hfeed .page-header,
	.entry-meta,
	.entry-footer,
	.entry-footer .tags-links a,
	.author-info-wrapper,
	.navigation .nav-previous .meta-nav,
	.navigation .nav-next .meta-nav,
	.navigation .nav-links,
	.comments-title-wrapper,
	.comment-navigation,
	.comment-list > .comment,
	.comment-list > .comment .children .comment-body,
	.site-footer .site-copyright,
	table tr,
	table td,
	table th {
		border-color: {$colors['border_color']};
	}

	@media screen and (min-width: 1170px) {
		.main-navigation ul ul li:first-child > a {
			border-color: {$colors['border_color']};
		}
	}

	body.no-left-sidebar .site-info,
	body.no-sidebar .site-footer,
	body.no-right-sidebar .social-navigation {
			border-color: {$colors['border_color']};
	}

	blockquote:before {
		color: {$colors['border_color']};
	}

	code,
	pre,
	.entry-footer .cat-links a {
		background-color: {$colors['border_color']};
	}

	div.sharedaddy h3.sd-title:before {
		border-color: {$colors['border_color']} !important;
	}

	@media screen and (max-width: 1440px) {
		.sidebar-right,
		body.no-right-sidebar .site-copyright {
			border-color: {$colors['border_color']} !important;
		}
	}

	@media screen and (max-width: 1170px) {
		.sidebar-left {
			border-color: {$colors['border_color']} !important;
		}
	}

CSS;
}


/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the
 * Customizer preview.
 *
 * @since ndotone 1.0
 */
function ndotone_color_scheme_css_template()
{
	$colors = array(
			'header_textcolor'              => '{{ data.header_textcolor }}',
			'content_background_color'		=> '{{ data.content_background_color }}',
			'main_text_color'               => '{{ data.main_text_color }}',
			'secondary_text_color'          => '{{ data.secondary_text_color }}',
			'primary_link_color'			=> '{{ data.primary_link_color }}',
			'secondary_link_color'			=> '{{ data.secondary_link_color }}',
			'sidebar_color'          		=> '{{ data.sidebar_color }}',
			'border_color'                  => '{{ data.border_color }}',
	);
	?>
	<script type="text/html" id="tmpl-ndotone-color-scheme">
		<?php echo ndotone_get_color_scheme_css($colors); ?>
	</script>
	<?php
}

add_action('customize_controls_print_footer_scripts', 'ndotone_color_scheme_css_template');

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since ndotone 1.0
 *
 * @see wp_add_inline_style()
 */
function ndotone_secondary_text_color_css()
{
	$color_scheme = ndotone_get_color_scheme();
	$default_color = $color_scheme[3];
	$secondary_text_color = get_theme_mod('secondary_text_color', $default_color);

	// Don't do anything if the current color is the default.
	if ($secondary_text_color === $default_color) {
		return;
	}

	$css = '
		/* Custom Secondary Text Color */
		.widget {
			color: %1$s;
		}
	';

	wp_add_inline_style('ndotone-style', sprintf($css, $secondary_text_color));
}

add_action('wp_enqueue_scripts', 'ndotone_secondary_text_color_css', 11);

/**
 * Enqueues front-end CSS for the primary link color.
 *
 * @since ndotone 1.0
 *
 * @see wp_add_inline_style()
 */
function ndotone_primary_link_color_css()
{
	$color_scheme = ndotone_get_color_scheme();
	$default_color = $color_scheme[4];
	$primary_link_color = get_theme_mod('primary_link_color', $default_color);

	// Don't do anything if the current color is the default.
	if ($primary_link_color === $default_color) {
		return;
	}

	$css = '
		/* Custom Primary Link Color */
		a,
		.site-title a:hover,
		.site-title a:focus,
		.widget a:hover,
		.widget a:focus,
		.entry-footer a:hover,
		.entry-footer a:focus,
		.entry-footer .tags-links a:hover,
		.comment-metadata a:hover,
		.comment-metadata a:focus,
		.hfeed .entry-title a:hover,
		.hfeed .entry-title a:focus,
		.search-form .search-submit:hover,
		.search-form .search-submit:focus,
		.widget .tagcloud a:hover,
		.site-footer a:hover,
		.site-footer a:focus,
		.site-main #infinite-handle span button:hover,
		.site-main #infinite-handle span button:focus {
			color: %1$s;
		}

		.main-navigation a:hover,
		.main-navigation a:focus,
		.main-navigation .nav-site-title:hover,
		.main-navigation .nav-site-title:focus,
		.menu-toggle:hover,
		.menu-toggle.toggled,
		.dropdown-toggle:hover,
		.dropdown-toggle.toggled:after {
			color: %1$s;
		}


		.navigation .nav-previous a:hover .meta-nav,
		.navigation .nav-previous a:focus .meta-nav,
		.navigation .nav-next a:hover .meta-nav,
		.navigation .nav-next a:focus .meta-nav,
		.pagination a:hover,
		.pagination a:focus,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus {
			 color: %1$s;
		}


		.sticky-post,
		mark,
	 	ins,
	 	.entry-footer .cat-links a:hover,
		.side-title .fa.fa-home:hover,
		.side-title .fa.fa-home:focus,
 		.hfeed .cover-link,
		.site-main #infinite-handle span button:hover:after,
		.site-main #infinite-handle span button:focus:after {
            background-color: %1$s;
        }

        .entry-footer .tags-links a:hover,
        input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="range"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="week"]:focus,
		input[type="time"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="color"]:focus,
		textarea:focus,
		.widget .search-field:focus,
		.widget .tagcloud a:hover {
			border-color: %1$s;
		}

	';

	wp_add_inline_style('ndotone-style', sprintf($css, $primary_link_color));
}

add_action('wp_enqueue_scripts', 'ndotone_primary_link_color_css', 12);

/**
 * Enqueues front-end CSS for the sidebar color.
 *
 * @since ndotone 1.0
 *
 * @see wp_add_inline_style()
 */
function ndotone_sidebar_color_css()
{
	$color_scheme = ndotone_get_color_scheme();
	$default_color = $color_scheme[6];
	$sidebar_color = get_theme_mod('sidebar_color', $default_color);

	// Don't do anything if the current color is the default.
	if ($sidebar_color === $default_color) {
		return;
	}

	$css = '
		/* Custom Sidebar Color */
		.sidebar-right,
		.sidebar-left,
		.site-footer .site-info,
		.site-footer .social-navigation,
		.main-navigation,
		.main-navigation ul ul li {
			background-color: %1$s;
		}

		@media screen and (max-width: 1440px) {
			.site-footer .site-copyright,
			body.no-left-sidebar .site-info {
				background-color: %1$s;
			}
		}

		@media screen and (max-width: 1170px) {
			.site-footer .site-copyright,
			body.no-right-sidebar .social-navigation,
			body.no-right-sidebar .site-copyright {
				background-color: %1$s;
			}
		}
	';

	wp_add_inline_style('ndotone-style', sprintf($css, $sidebar_color));
}

add_action('wp_enqueue_scripts', 'ndotone_sidebar_color_css', 11);