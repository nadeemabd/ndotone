<?php
/**
 * ndotone functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ndotone
 */

if (!function_exists('ndotone_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function ndotone_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on ndotone, use a find and replace
         * to change 'ndotone' to the name of your theme in all the template files.
         */
        load_theme_textdomain('ndotone', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for custom logo.
         *
         *  @since ndotone1.2
         */
        add_theme_support( 'custom-logo', array(
            'height'      => 240,
            'width'       => 240,
            'flex-height' => true,
        ) );

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1920, 9999);

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'ndotone'),
            'social' => esc_html__('Social', 'ndotone'),
            'footer' => esc_html__('Footer', 'ndotone'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        /*
         * Enable support for Post Formats.
         * See https://developer.wordpress.org/themes/functionality/post-formats/
         */
        add_theme_support('post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ));

        /*
         * This theme styles the visual editor to resemble the theme style,
         * specifically font, colors, icons, and column width.
         */
        add_editor_style( array( 'css/editor-style.css', ndotone_fonts_url() ) );

        // Indicate widget sidebars can use selective refresh in the Customizer.
        add_theme_support( 'customize-selective-refresh-widgets' );
    }
endif;
add_action('after_setup_theme', 'ndotone_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ndotone_content_width()
{
    $GLOBALS['content_width'] = apply_filters('ndotone_content_width', 600);
}

add_action('after_setup_theme', 'ndotone_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ndotone_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Left Sidebar', 'ndotone'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'ndotone'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Right Sidebar', 'ndotone'),
        'id' => 'sidebar-2',
        'description' => esc_html__('Add widgets here.', 'ndotone'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'ndotone_widgets_init');

if ( ! function_exists( 'ndotone_fonts_url' ) ) :
    /**
     * Register Google fonts for ndotone.
     *
     * Create your own ndotone_fonts_url() function to override in a child theme.
     *
     * @since ndotone 1.0
     *
     * @return string Google fonts URL for the theme.
     */
    function ndotone_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'ndotone' ) ) {
            $fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
        }

        /* translators: If there are characters in your language that are not supported by Roboto Condensed, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Roboto Condensed font: on or off', 'ndotone' ) ) {
            $fonts[] = 'Roboto Condensed:400,700';
        }

        /* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'ndotone' ) ) {
            $fonts[] = 'Inconsolata:400';
        }

        if ( $fonts ) {
            $fonts_url = add_query_arg( array(
                'family' => urlencode( implode( '|', $fonts ) ),
                'subset' => urlencode( $subsets ),
            ), 'https://fonts.googleapis.com/css' );
        }

        return $fonts_url;
    }
endif;

/**
 * Enqueue scripts and styles.
 */
function ndotone_scripts() {

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'ndotone-fonts', ndotone_fonts_url(), array(), null );

    // Add Font Awesome, used in the main stylesheet.
    wp_enqueue_style('fontawesome', get_template_directory_uri() . '/fontawesome/css/font-awesome.min.css', array(), '4.5.0');

    // Add main stylesheet used for the theme
    wp_enqueue_style('ndotone-style', get_stylesheet_uri());

    // Add script for skip-link-focus
    wp_enqueue_script('ndotone-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('ndotone-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20151215', true);

    wp_localize_script('ndotone-functions', 'screenReaderText', array(
        'expand' => __('expand child menu', 'ndotone'),
        'collapse' => __('collapse child menu', 'ndotone'),
    ));
}

add_action('wp_enqueue_scripts', 'ndotone_scripts');

/**
 * Custom Header check.
 * Checks for custom header set by user or defaults to default header set by theme.
 * Default header location - '{theme_dir}/images/header.jpg'
 *
 * @since ndotone 1.0
 * @return string URI string of custom header if set by user or of default header
 */
function get_custom_header_image() {
        if (get_header_image() != '') {
            // Check if custom header set by user
            header_image();
        } else {
            // Set default header
            echo get_stylesheet_directory_uri() . '/images/header.jpg';
        }
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Converts a HEX value to RGB.
 *
 * @since ndotone 1.0
 *
 * @param string $color The original color, in 3- or 6-digit hexadecimal form.
 * @return array Array containing RGB (red, green, and blue) values for the given
 *               HEX code, empty array otherwise.
 */
function ndotone_hex2rgb( $color ) {
    $color = trim( $color, '#' );

    if ( strlen( $color ) === 3 ) {
        $r = hexdec( substr( $color, 0, 1 ).substr( $color, 0, 1 ) );
        $g = hexdec( substr( $color, 1, 1 ).substr( $color, 1, 1 ) );
        $b = hexdec( substr( $color, 2, 1 ).substr( $color, 2, 1 ) );
    } else if ( strlen( $color ) === 6 ) {
        $r = hexdec( substr( $color, 0, 2 ) );
        $g = hexdec( substr( $color, 2, 2 ) );
        $b = hexdec( substr( $color, 4, 2 ) );
    } else {
        return array();
    }

    return array( 'red' => $r, 'green' => $g, 'blue' => $b );
}


/**
 * Filter the excerpt length to 30 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function wpdocs_custom_excerpt_length( $length ) {
    return 30;
}
add_filter( 'excerpt_length', 'wpdocs_custom_excerpt_length', 999 );

/**
 * Custom infinite loader text.
 * Sets custom infinite scroll text.
 *
 * @since ndotone 1.0
 */
function ndotone_custom_infinite_more() {
    if ( class_exists( 'Jetpack' ) && Jetpack::is_module_active( 'infinite-scroll' ) ) :
        if ( is_home() || is_archive() ) {
            ?>
            <script type="text/javascript">
                //<![CDATA[
                infiniteScroll.settings.text = "Load More"; // Custom text
                //]]>
            </script>
        <?php } // Load more only on home and archive pages
    endif; // Jetpack module check
}
add_action( 'wp_footer', 'ndotone_custom_infinite_more', 3 );

/**
 * Set custom widget cloud text size
 *
 * @since ndotone 1.0
 */
function ndotone_widget_tag_cloud_args($args)
{
    $args['largest'] = 1.6;
    $args['smallest'] = 1.6;
    $args['unit'] = 'rem';
    return $args;
}

add_filter('widget_tag_cloud_args', 'ndotone_widget_tag_cloud_args');