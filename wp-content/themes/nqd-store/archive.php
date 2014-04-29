<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package NQD Store
 */

get_header(); ?>
	<div id="site-main-content" class="col-lg-12">
		
		<main id="site-content" class="col-lg-9" role="main">	
		<div id="site-breadcrumbs">
			<?php NQD_breadcrumbs();?>
		</div>
		<?php if ( have_posts() ) : ?>
				<div class="list-app">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
						<?php 
							$key_3_values = get_post_meta( get_the_ID(), '_infomation_manufacturers',true );
							//$a = strtotime($post->post_modified_gmt);
							//$b = strtotime($post->post_date_gmt);
						?>
						<?php
						get_template_part( 'content', get_post_format() );
						?>
						<?php endwhile;?>
						<?php pagination();?>
					<?php endif;?>
						<div class="clearfix"></div>
					</div>
		<?php else : ?>

			<?php get_template_part( 'no-results', 'archive' ); ?>

		<?php endif; ?>

		</main><!-- #main -->
		<?php get_sidebar(); ?>
		</div>
<?php get_footer(); ?>
