<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ndotone
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if( has_post_thumbnail() ) : ?>
		<div class="post-thumbnail" style="background-image: url('<?php echo the_post_thumbnail_url()?>')">
			<!--            --><?php //the_post_thumbnail(); ?>
		</div>
	<?php endif; ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="content-wrapper">
		<div class="entry-content">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'ndotone' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
	</div>
	<footer class="entry-footer">
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					esc_html__( 'Edit %s', 'ndotone' ),
					the_title( '<span class="screen-reader-text">"', '"</span>', false )
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
