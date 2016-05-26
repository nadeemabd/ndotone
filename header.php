<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nadtheme
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'nadtheme'); ?></a>

    <header id="masthead" class="site-header" role="banner">

        <nav id="site-navigation" class="main-navigation" role="navigation">
            <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'nadtheme'); ?></button>
            <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu')); ?>
        </nav><!-- #site-navigation -->


        <?php if (!has_post_thumbnail()): ?>
            <?php
            /**
             * Filter the default nadtheme custom header sizes attribute.
             *
             * @since nadtheme 1.0
             *
             * @param string $custom_header_sizes sizes attribute
             * for Custom Header. Default '(max-width: 709px) 85vw,
             * (max-width: 909px) 81vw, (max-width: 1362px) 88vw, 1200px'.
             */
			$custom_header_sizes = apply_filters('nadtheme_custom_header_sizes', '(max-width: 709px) 85vw, (max-width: 909px) 95vw, (max-width: 1362px) 100vw, 1920px');
//
//            $header1srcset = get_template_directory_uri() . '/images/header.jpg 1920w, ';
//            $header2srcset = get_template_directory_uri() . '/images/header2.jpg 1200w, ';
//            $header3srcset = get_template_directory_uri() . '/images/header3.jpg 600w';
//            $default_header_srcset = apply_filters('nadtheme_default_header_srcset', $header1srcset . $header2srcset . $header3srcset);
            ?>
            <div class="header-image">
                <?php if (get_header_image()) { ?>
                    <img src="<?php header_image(); ?>" srcset="<?php echo esc_attr(wp_get_attachment_image_srcset(get_custom_header()->attachment_id, 1920)); ?>" sizes="<?php echo esc_attr($custom_header_sizes); ?>" width="<?php echo esc_attr(get_custom_header()->width); ?>" height="<?php echo esc_attr(get_custom_header()->height); ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                <?php } else { ?>

                    <img src="<?php echo get_template_directory_uri() . '/images/header.jpg' ?>" alt="<?php echo esc_attr(get_bloginfo('name', 'display')); ?>">
                <?php } // End header image check. ?>

            </div><!-- .header-image -->
        <?php endif; // End header image check. ?>


        <div class="site-branding">
            <?php
            if (is_front_page() && is_home()) : ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php else : ?>
                <p class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
                <?php
            endif;

            $description = get_bloginfo('description', 'display');
            if ($description || is_customize_preview()) : ?>
                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                <?php
            endif; ?>
        </div><!-- .site-branding -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
