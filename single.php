<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package nadtheme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

//			the_post_navigation();

			if (is_singular('attachment')) {
				// Parent post navigation.
				the_post_navigation(array(
						'prev_text' => _x('<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'nadtheme'),
				));
			} elseif (is_singular('post')) {
				// Previous/next post navigation.
				the_post_navigation(array(
						'next_text' => '<span class="post-title">%title</span>' .
								'<span class="meta-nav" aria-hidden="true">' . __('Next', 'nadtheme') . '</span>' .
								'<span class="screen-reader-text">' . __('Next post:', 'nadtheme') . '</span>',
						'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __('Previous', 'nadtheme') . '</span>' .
								'<span class="screen-reader-text">' . __('Previous post:', 'nadtheme') . '</span>' .
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
