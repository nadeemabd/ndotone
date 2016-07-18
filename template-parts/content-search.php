<?php
/**
 * Template part for displaying results in search pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package ndotone
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if(has_post_thumbnail()) : ?>
		<div class="post-thumbnail" style="background-image: url('<?php echo the_post_thumbnail_url() ?>')">
			<a class="cover-link" href="<?php the_permalink(); ?>"></a>
		</div>
	<?php endif; ?>
	<div class="post-content">
		<header class="entry-header">
			<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>

	<!--		--><?php //if ( 'post' === get_post_type() ) : ?>
	<!--		<div class="entry-meta">-->
	<!--			--><?php //ndotone_posted_on(); ?>
	<!--		</div>--><!-- .entry-meta -->
	<!--		--><?php //endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
	</div>

<!--	<footer class="entry-footer">-->
<!--		--><?php //ndotone_entry_footer(); ?>
<!--	</footer>--><!-- .entry-footer -->
</article><!-- #post-## -->
