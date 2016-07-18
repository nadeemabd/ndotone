<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 * @package ndotone
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php esc_html_e( '?', 'ndotone' ); ?></h1>
				</header><!-- .page-header -->

				<div class="page-content">

					<h2 class="no-404"><?php esc_html_e( '404', 'ndotone' ); ?></h2>
					<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'ndotone' ); ?> <a href="<?php echo esc_url(home_url('/')); ?>"><?php esc_html_e( 'Take me home.', 'ndotone' ); ?></a></p>

					<?php
						get_search_form();
						the_widget( 'WP_Widget_Recent_Posts' );
					?>

				</div><!-- .page-content -->
			</section><!-- .error-404 -->

		</main><!-- #main -->
	</div><!-- #primary -->