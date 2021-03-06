<?php
/*
Template Name: Manufacturers
*/
get_header();
?>
<div id="site-main-content" class="col-lg-12">
	<?php get_sidebar(); ?>
	<main id="site-content" class="col-lg-9" role="main">
	<div id="site-breadcrumbs">
		<?php NQD_breadcrumbs();?>
	</div>
	<ul class="nav nav-tabs">
	  <li class="active"><a href="#home" data-toggle="tab">Mới nhất</a></li>
	</ul>
	<div class="tab-content">
	  <div class="tab-pane active" id="home">
		<div class="list-app">
			<?php
				global $manufacturers_name;
				$manufacturers_name = get_query_var('manufacturers_name');
				if(have_posts()):
					$game_page = max( 1, $_GET['manufacturer-page']);
					$args1 = array(
							'posts_per_page'=>$posts_per_page,
							'paged' => $game_page,
							'meta_query' => array(
								'relation' =>'AND',
								array(
								'key' => '_infomation_manufacturers',
								'value' => urldecode($manufacturers_name),
								'compare' => '='
								)
							)
					);
					$my_query = new WP_Query($args1);
					while ($my_query->have_posts()): 
						$my_query->the_post();
						$do_not_duplicate = $post->ID;
				?>
				<?php
				get_template_part( 'content', get_post_format() );
				?>
				<?php
					endwhile;
					wp_reset_query();
					echo '<div class="clearfix"></div>';
					echo '<div class="text-center"><div class ="pagination">';
						paging('manufacturer-page',$my_query);
					echo '</div></div>';
				endif;
				?>
		</div>
	  </div>
	</div>
	</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>