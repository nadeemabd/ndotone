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
    <?php if( has_post_thumbnail() ) : ?>
        <div class="post-thumbnail" style="background-image: url('<?php echo the_post_thumbnail_url()?>')">
<!--            --><?php //the_post_thumbnail(); ?>
        </div>
    <?php endif; ?>
<!--    <header class="entry-header" style="background-image: url('<?php //echo the_post_thumbnail_url()?>')"> -->
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

//        if ( 'post' === get_post_type() ) : ?>
<!--            <div class="entry-cats">-->
<!--                --><?php //nadtheme_get_the_categories(); ?>
<!--            </div>--><!-- .entry-meta -->
<!--            --><?php
//        endif; ?>
    </header><!-- .entry-header -->
    <div class="content-wrapper">
        <?php if ( 'post' === get_post_type() ) : ?>
            <div class="entry-meta">
                <?php nadtheme_posted_on(); ?>
            </div><!-- .entry-meta -->
            <?php
        endif; ?>
        <div class="entry-content">
            <?php
                the_content();

                wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'nadtheme' ),
                    'after'  => '</div>',
                ) );

            ?>
        </div><!-- .entry-content -->
    </div>
    <footer class="entry-footer">
        <?php nadtheme_entry_footer(); ?>
    </footer><!-- .entry-footer -->
    <?php if ( '' !== get_the_author_meta( 'description' ) ) { ?>
        <div class="author-info-wrapper">
            <?php get_template_part( 'template-parts/biography' ); ?>
        </div>
    <?php } ?>
</article><!-- #post-## -->
