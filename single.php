<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ndotone
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

			if (is_singular('attachment')) {
				// Parent post navigation.
				the_post_navigation(array(
                    'prev_text' => _x('<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'ndotone'),
				));
			} elseif (is_singular('post')) {
				// Previous/next post navigation.
				the_post_navigation(array(
                    'next_text' => '<span class="post-title">%title</span>' .
                                '<span class="meta-nav" aria-hidden="true">' . __('Next', 'ndotone') . '</span>' .
                                '<span class="screen-reader-text">' . __('Next post:', 'ndotone') . '</span>',
                    'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __('Previous', 'ndotone') . '</span>' .
                                '<span class="screen-reader-text">' . __('Previous post:', 'ndotone') . '</span>' .
                                '<span class="post-title">%title</span>',
				));
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_sidebar('right');
get_footer();
