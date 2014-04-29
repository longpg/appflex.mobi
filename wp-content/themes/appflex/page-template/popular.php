<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package NQD Store
 
 Template Name: Popular
 */

get_header(); ?>
<div id="tabmenu">
    <ul class="individual">
        <li><a href="http://appflex.mobi/"><span>Mới nhất</span></a></li>
        <li class="selected"><a href="http://appflex.mobi/top-views"><span>Hot nhất</span></a></li>
        <li><a href="http://appflex.mobi/top-downloads"><span>Tải nhiều</span></a></li>
    </ul>
</div>

		<?php if ( have_posts() ) : ?>
				<div class="list-app">
						<?php 
						$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
						$args1 = array( 'posts_per_page' => 10,
						'post_status' => 'publish',
						'paged' => $paged,
						'orderby' =>'meta_value_num',
						'meta_key' => 'views',
						'order' => 'DESC');
						$my_query = new WP_Query($args1);	
						while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
						<?php
							get_template_part( 'content', get_post_format() );
						?>
						<?php endwhile;?>
						<?php wp_pagenavi();
						wp_pagenavi(array('query' => $my_query));
						wp_reset_postdata();?>
						<div class="clearfix"></div>
				</div>
					<div class='show-pagination'>
					<?php wp_pagenavi(); ?>
					</div>
		<?php else : ?>
			<?php get_template_part( 'no-results', 'archive' ); ?>
		<?php endif; ?>


<?php get_footer(); ?>
