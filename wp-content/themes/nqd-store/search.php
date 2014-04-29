<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package NQD Store
 */

get_header(); ?>
	<div id="site-main-content" class="col-lg-12">
	<?php get_sidebar(); ?>
		<main id="site-content" class="col-lg-9" role="main">
		<div id="site-breadcrumbs">
			<?php NQD_breadcrumbs();?>
		</div>	
				<?php get_template_part( 'content', 'search' ); ?>

		</main><!-- #main -->
	</div>
<?php get_footer(); ?>