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

    <header id="masthead" class="site-header" role="banner" style="background-image: url('<?php get_custom_header_image(); ?>')">

        <nav id="site-navigation" class="main-navigation" role="navigation">

            <?php if (!is_front_page() && !is_home()) : ?>
                <p class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                </p>
            <?php endif ?>

            <div class="site-header-menu">
            <?php if (has_nav_menu('primary')): ?>
                <button id="menu-toggle" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e('Primary Menu', 'nadtheme'); ?></button>
                <?php wp_nav_menu(array('theme_location' => 'primary', 'menu_id' => 'primary-menu')); ?>
            <?php endif ?>
            </div>
        </nav><!-- #site-navigation -->

        <div class="site-branding">

            <?php if (is_front_page() && is_home()) : ?>
                <h1 class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
            <?php else : ?>
                <?php the_title('<h1 class="entry-title">', '</h1>'); ?>
            <?php endif;
            $description = get_bloginfo('description', 'display');
            if ($description || is_customize_preview()) : ?>
                <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
            <?php endif; ?>

        </div><!-- .site-branding -->

    </header><!-- #masthead -->

<div id="content" class="site-content">
