<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ndotone
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
    <a class="skip-link screen-reader-text" href="#main"><?php esc_html_e('Skip to content', 'ndotone'); ?></a>

    <?php if (!is_404()) : ?>
    <header id="masthead" class="site-header" role="banner" style="background-image: url('<?php get_custom_header_image(); ?>')">

        <?php if (is_single() || is_page()) : ?>
            <p class="side-title">
                <?php
                    // Theme custom logo function
                    ndotone_the_custom_logo();
                ?>

                <?php if (!has_custom_logo()) : ?>
                    <a class="go-home" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><i class="fa fa-home" aria-hidden="true"></i></a>
                <?php endif; ?>
            </p><!-- .side-title -->
        <?php endif; // Front page and home check ?>

        <?php if (has_nav_menu('primary')): ?>
            <nav id="site-navigation" class="main-navigation" role="navigation">
                <div class="site-header-menu">
                    <button id="menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Menu', 'ndotone'); ?></button>
                    <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu')); ?>
                </div><!-- .site-header-menu -->
            </nav><!-- #site-navigation -->
        <?php endif; // Primary menu check ?>

        <?php if ( !is_single() && !is_page()) : ?>
            <div class="site-branding">
                <?php
                    // Custom logo for single page
                    ndotone_the_custom_logo();
                ?>

                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                </h1> <!-- .site-title -->

                <?php $description = get_bloginfo('description', 'display');
                if ($description || is_customize_preview()) : ?>
                    <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                <?php endif; ?>
            </div><!-- .site-branding -->
        <?php endif; // Single and page check ?>

    </header><!-- #masthead -->
    <?php endif; // 404 check ?>

<div id="content" class="site-content">
