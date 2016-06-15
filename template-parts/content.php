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

	<?php if(has_post_thumbnail()) : ?>
		<div class="post-thumbnail" style="background-image: url('<?php echo the_post_thumbnail_url() ?>')">
			<a class="cover-link" href="<?php the_permalink(); ?>"></a>
		</div>
	<?php endif; ?>

<!--	--><?php //if(has_post_thumbnail()) : ?>
<!--	<div class="post-thumbnail">-->
<!--		--><?php //the_post_thumbnail(); ?>
<!--		<a class="cover-link" href="--><?php //the_permalink(); ?><!--"></a>-->
<!--	</div>-->
<!--	--><?php //endif; ?>

	<div class="post-content">
		<header class="entry-header">
			<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
				<span class="sticky-post"><?php _e( 'Featured', 'nadtheme' ); ?></span>
			<?php endif; ?>

			<?php if ( 'post' === get_post_type() ) : ?>
			<div class="entry-meta">
				<?php nadtheme_posted_date(); ?>
			</div><!-- .entry-meta-->
			<?php
			endif; ?>

			<?php
				if ( is_single() ) {
					the_title( '<h1 class="entry-title">', '</h1>' );
				} else {
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				}
			?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php
			the_excerpt();
			?>
		</div><!-- .entry-content -->
	</div>
<!--	<footer class="entry-footer">-->
<!--		--><?php //nadtheme_entry_footer(); ?>
<!--	</footer>--><!-- .entry-footer -->
</article><!-- #post-## -->
