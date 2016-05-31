<?php
/**
 * nadtheme functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package nadtheme
 */

if (!function_exists('nadtheme_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function nadtheme_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on nadtheme, use a find and replace
         * to change 'nadtheme' to the name of your theme in all the template files.
         */
        load_theme_textdomain('nadtheme', get_template_directory() . '/languages');

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
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support( 'post-thumbnails' );
        set_post_thumbnail_size( 1920, 9999 );

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'primary' => esc_html__('Primary', 'nadtheme'),
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

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('nadtheme_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

        /**
         * Set up the WordPress core custom header feature.
         *
         * @uses nadtheme_header_style()
         * @uses nadtheme_admin_header_style()
         * @uses nadtheme_admin_header_image()
         */
        add_theme_support('custom-header', apply_filters('nadtheme_custom_header_args', array(
            'default-color' => '000000',
            'width' => 1920,
            'height' => 280,
            'flex-height' => false,
            'flex-width' => false,
            'default-image' => get_template_directory_uri() . '/images/header.jpg',
            'uploads' => true,
        )));
    }
endif;
add_action('after_setup_theme', 'nadtheme_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function nadtheme_content_width()
{
    $GLOBALS['content_width'] = apply_filters('nadtheme_content_width', 640);
}

add_action('after_setup_theme', 'nadtheme_content_width', 0);

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function nadtheme_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Left Sidebar', 'nadtheme'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'nadtheme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Right Sidebar', 'nadtheme'),
        'id' => 'sidebar-2',
        'description' => esc_html__('Add widgets here.', 'nadtheme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h2 class="widget-title">',
        'after_title' => '</h2>',
    ));
}

add_action('widgets_init', 'nadtheme_widgets_init');

if ( ! function_exists( 'nadtheme_fonts_url' ) ) :
    /**
     * Register Google fonts for nadtheme.
     *
     * Create your own nadtheme_fonts_url() function to override in a child theme.
     *
     * @since nadtheme 1.0
     *
     * @return string Google fonts URL for the theme.
     */
    function nadtheme_fonts_url() {
        $fonts_url = '';
        $fonts     = array();
        $subsets   = 'latin,latin-ext';

        /* translators: If there are characters in your language that are not supported by Merriweather, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Merriweather font: on or off', 'twentysixteen' ) ) {
            $fonts[] = 'Merriweather:400,700,900,400italic,700italic,900italic';
        }

        /* translators: If there are characters in your language that are not supported by Montserrat, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Roboto Condensed font: on or off', 'nadtheme' ) ) {
            $fonts[] = 'Roboto Condensed:400,700';
        }

        /* translators: If there are characters in your language that are not supported by Inconsolata, translate this to 'off'. Do not translate into your own language. */
        if ( 'off' !== _x( 'on', 'Inconsolata font: on or off', 'nadtheme' ) ) {
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
function nadtheme_scripts() {

    // Add custom fonts, used in the main stylesheet.
    wp_enqueue_style( 'nadtheme-fonts', nadtheme_fonts_url(), array(), null );

    wp_enqueue_style('nadtheme-style', get_stylesheet_uri());

//    wp_enqueue_script('nadtheme-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true);


    wp_enqueue_script('nadtheme-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }

    wp_enqueue_script('nadtheme-functions', get_template_directory_uri() . '/js/functions.js', array('jquery'), '20151215', true);

    wp_localize_script('nadtheme-functions', 'screenReaderText', array(
        'expand' => __('expand child menu', 'nadtheme'),
        'collapse' => __('collapse child menu', 'nadtheme'),
    ));
}

add_action('wp_enqueue_scripts', 'nadtheme_scripts');

function get_custom_header_image() {
    if (!has_post_thumbnail()) :
        if (get_header_image()) {
            header_image();
        } else {
            echo get_template_directory_uri() . '/images/header.jpg';
        } // End header image check.
    else :
        echo the_post_thumbnail_url();
    endif; // End header image check.
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
