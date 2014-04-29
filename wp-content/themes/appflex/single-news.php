<?php
/**
 * The Template for displaying all single posts.
 *
 * @package NQD-Store-Smart
 */

get_header(); ?>
	<div id="primary" class="content-area">
<div class="breadcrumb" id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">
<span typeof="v:Breadcrumb"> <a rel="v:url" property="v:title" href="<?php bloginfo('home'); ?>">Trang chủ</a></span> <?php the_category(' '); ?>

</div>
		<main id="main" class="site-main" role="main">
			
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'single' ); ?>

			<?php nqd_store_smart_content_nav( 'nav-below' ); ?>
				<!-- Target both sliders with the same properties -->
			<div>
			<?php 
				$args1 = array(
						'posts_per_page' => 5,
						'paged' => 1,
						'orderby' => 'rand'
				);
				$my_query = new WP_Query($args1);
			?>
			<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
					<?php
						get_template_part( 'contentsingle', get_post_format() );
					?>
			<?php endwhile;
				wp_reset_query();
			?>
			</div>
			
			<?php
				// If comments are open or we have at least one comment, load up the comment template
				//if ( comments_open() || '0' != get_comments_number() )
				//	comments_template();
			?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>