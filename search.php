<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ndotone
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'ndotone' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile; // End of while loop

			// Previous/next page navigation.
			the_posts_pagination( array(
					'mid_size'  		 => 2,
					'prev_text'          => __( 'Previous', 'ndotone' ),
					'next_text'          => __( 'Next', 'ndotone' ),
					'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'ndotone' ) . ' </span>',
			) );

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; // Have posts check ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php
get_sidebar();
get_sidebar('right');
get_footer();
