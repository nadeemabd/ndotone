<?php
/**
 * The right sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ndotone
 */

if ( ! is_active_sidebar( 'sidebar-2' ) ) {
	return;
}
?>

<aside id="secondary-right" class="widget-area sidebar-right" role="complementary">
	<?php dynamic_sidebar( 'sidebar-2' ); ?>
</aside><!-- #secondary -->
