<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ndotone
 */

?>

</div><!-- #content -->
<?php if (!is_404()) : ?>
<footer id="colophon" class="site-footer" role="contentinfo">

    <div class="site-info">
        <a href="<?php echo esc_url(__('https://wordpress.org/', 'ndotone')); ?>"><?php printf(esc_html__('%s', 'ndotone'), 'WordPress'); ?></a>
        <span class="sep">&nbsp;|&nbsp;</span>
        <a href="http://nadeemabd.com/" rel="designer"><?php printf(esc_html__('%1$s by %2$s', 'ndotone'), 'ndotone', 'Nadeem Abdulla'); ?></a>
    </div><!-- .site-info -->

    <div class="site-copyright">
        <div class="copy">
            <?php _e('Copyright', 'ndotone') ?> &copy; <?php echo date("Y"); ?> &mdash;
            <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>. <?php _e('All Rights Reserved', 'ndotone') ?>
        </div><!-- .copy -->

        <?php if (has_nav_menu('footer')): ?>
            <?php wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_id' => 'footer-menu',
                'menu_class' => 'footer-menu',
            )); ?>
        <?php endif; // Footer menu check ?>
    </div><!-- .site-copyright -->

    <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e('Footer Social Links Menu', 'ndotone'); ?>">
        <?php if (has_nav_menu('social')): ?>
            <?php wp_nav_menu(array(
                'theme_location' => 'social',
                'menu_id' => 'social-menu',
                'menu_class' => 'social-menu',
                'container' => 'ul',
                'link_before' => '<span class="screen-reader-text">',
                'link_after' => '</span>',
            )); ?>
        <?php endif; // Social menu check ?>
    </nav><!-- .social-navigation -->

</footer><!-- #colophon -->
<?php endif; // 404 check ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
