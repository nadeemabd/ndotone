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

    <header class="entry-header" style="background-image: url('<?php echo the_post_thumbnail_url()?>')">
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
            <div class="entry-cats">
                <?php nadtheme_get_the_categories(); ?>
            </div><!-- .entry-meta -->
            <?php
        endif; ?>
    </header><!-- .entry-header -->

    <div class="entry-content">
        <?php if ( 'post' === get_post_type() ) : ?>
        <div class="entry-meta">
            <?php nadtheme_posted_on(); ?>
        </div><!-- .entry-meta -->
        <?php
        endif; ?>
        <?php
            the_content();

            wp_link_pages( array(
                'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nadtheme' ),
                'after'  => '</div>',
            ) );

            if ( '' !== get_the_author_meta( 'description' ) ) {
                get_template_part( 'template-parts/biography' );
            }
        ?>
    </div><!-- .entry-content -->

    <footer class="entry-footer">
        <?php nadtheme_entry_footer(); ?>
    </footer><!-- .entry-footer -->
</article><!-- #post-## -->
