<?php
/**
 * The template for displaying Archive pages.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package NQD-Store-Smart
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<div class="nav">
			<h1 style="font-size:15px;line-height: 34px;
margin-left: 5px;
display: inline-block;color: #FFF;"><?php single_cat_title(); ?></h1>
			</div>

			<?php while ( have_posts() ) : the_post(); ?>
				<?php
					get_template_part( 'content', get_post_format() );
				?>

			<?php endwhile; ?>
			<div class="khungfoot">
			GameHot.Mobi hiện đang là website cung cấp ứng dụng <strong><?php single_cat_title(); ?></strong> miễn phí, <?php echo excerpt(40); ?> ... Hãy cùng khám phá <strong><?php single_cat_title(); ?></strong> và trải nghiệm nhé, Chúc các bạn vui vẻ.
			</div>
			<div class='page-pagination'>
			<?php pagination( ); ?>
			</div>

			<div>
			<div class="nav">
			<h3 style="font-size:15px;line-height: 34px;
margin-left: 5px;
display: inline-block;color: #FFF;">Xem nhiều nhất</h3>
			</div>
			<?php 
				$category = get_the_category($post->ID);
				$category = $category[0]->cat_ID;
				$args1 = array(
						'posts_per_page' => 5,
						'paged' => 1,
						'category__in' => array($category), 
						'post_status'=>'publish',
						'orderby' =>'meta_value_num',
						'meta_key' => 'views',
						'order' => 'DESC'
				);
				$my_query = new WP_Query($args1);
			?>
			<?php while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
					<?php
						get_template_part( 'content', get_post_format() );
					?>
			<?php endwhile;
				wp_reset_query();
			?>
			</div>
		</main><!-- #main -->
	</section><!-- #primary -->
	<?php get_sidebar();?>
<?php get_footer(); ?>
