<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nadtheme
 */

?>

</div><!-- #content -->
<?php if (!is_404()) : ?>
<footer id="colophon" class="site-footer" role="contentinfo">

    <div class="site-info">
        <a href="<?php echo esc_url(__('https://wordpress.org/', 'nadtheme')); ?>"><?php printf(esc_html__('%s', 'nadtheme'), 'WordPress'); ?></a>
        <span class="sep">&nbsp;|&nbsp;</span>
        <a href="http://nadeemabd.github.io/" rel="designer"><?php printf(esc_html__('%1$s by %2$s', 'nadtheme'), 'nadtheme', 'Nadeem Abdulla'); ?></a>
    </div><!-- .site-info -->

    <div class="site-copyright">
        <div class="copy">
            <?php _e('Copyright', 'nadtheme') ?> &copy; <?php echo date("Y"); ?> &mdash;
            <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>. <?php _e('All Rights Reserved', 'nadtheme') ?>
        </div>

        <?php if (has_nav_menu('footer')): ?>
            <?php wp_nav_menu(array(
                'theme_location' => 'footer',
                'menu_id' => 'footer-menu',
                'menu_class' => 'footer-menu',
            )); ?>
        <?php endif; ?>
    </div>

    <nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e('Footer Social Links Menu', 'elegance'); ?>">
        <?php if (has_nav_menu('social')): ?>
            <?php wp_nav_menu(array(
                'theme_location' => 'social',
                'menu_id' => 'social-menu',
                'menu_class' => 'social-menu',
                'container' => 'ul',
                'link_before' => '<span class="screen-reader-text">',
                'link_after' => '</span>',
            )); ?>
        <?php endif; ?>
    </nav>

</footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
