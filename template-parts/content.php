<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package nadtheme
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<a class="post-thumbnail" href="<?php the_permalink(); ?>">
		<?php the_post_thumbnail('medium'); ?>
	</a>

	<header class="entry-header">
		<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
			<span class="sticky-post"><?php _e( 'Featured', 'nadtheme' ); ?></span>
		<?php endif; ?>

		<?php
			if ( is_single() ) {
				the_title( '<h1 class="entry-title">', '</h1>' );
			} else {
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			}

		if ( 'post' === get_post_type() ) : ?>
		<div class="entry-meta">
			<?php nadtheme_posted_on(); ?>
		</div><!-- .entry-meta -->
		<?php
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
//			the_content( sprintf(
//				/* translators: %s: Name of current post. */
//				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'nadtheme' ), array( 'span' => array( 'class' => array() ) ) ),
//				the_title( '<span class="screen-reader-text">"', '"</span>', false )
//			) );
//
//			wp_link_pages( array(
//				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nadtheme' ),
//				'after'  => '</div>',
//			) );

		the_excerpt();
		?>
	</div><!-- .entry-content -->

<!--	<footer class="entry-footer">-->
<!--		--><?php //nadtheme_entry_footer(); ?>
<!--	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
