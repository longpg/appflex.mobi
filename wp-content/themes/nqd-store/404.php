<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package NQD Store
 */

get_header(); ?>
<div id="site-main-content" class="col-lg-12">
		<?php get_sidebar();?>
		<main id="main" class="site-main col-lg-9" role="main">
			<section class="error-404 not-found">
				<header class="page-header">
					<h1 class="page-title"><?php _e( 'Oops! That page can&rsquo;t be found.', 'nqd-store' ); ?></h1>
				</header><!-- .page-header -->
				<div class="page-content">
					<p><?php _e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'nqd-store' ); ?></p>
				</div><!-- .page-content -->
			</section><!-- .error-404 -->
		</main><!-- #main -->
</div>
<?php get_footer(); ?>