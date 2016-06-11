<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package nadtheme
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/content', get_post_format() );

			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
					'mid_size'  		 => 2,
					'prev_text'          => __( 'Previous', 'nadtheme' ),
					'next_text'          => __( 'Next', 'nadtheme' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'nadtheme' ) . ' </span>',
			) );

//			$args = array(
//					'base'               => '%_%',
//					'format'             => '?paged=%#%',
//					'total'              => 1,
//					'current'            => 0,
//					'show_all'           => false,
//					'end_size'           => 1,
//					'mid_size'           => 2,
//					'prev_next'          => true,
//					'prev_text'          => __('« Previous'),
//					'next_text'          => __('Next »'),
//					'type'               => 'plain',
//					'add_args'           => false,
//					'add_fragment'       => '',
//					'before_page_number' => '',
//					'after_page_number'  => ''
//			);
//
//			echo paginate_links( $args );

			else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_sidebar('right');
get_footer();
