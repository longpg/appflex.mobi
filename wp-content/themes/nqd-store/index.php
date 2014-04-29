<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package NQD Store
 */
global $NHP_Options;
//var_dump($NHP_Options);exit;
get_header(); ?>
<?php if($NHP_Options->get('slider_img_1') || $NHP_Options->get('slider_img_2') || $NHP_Options->get('slider_img_3') || $NHP_Options->get('slider_img_4') || $NHP_Options->get('slider_img_5')):?>
	<div class="col-lg-12" id="site-slider">
			<div id="slider" class="carousel slide">
				<ol class="carousel-indicators">
				<?php if($NHP_Options->get('slider_img_1')):?>
					<li data-target="#slider" data-slide-to="0"></li>
				<?php endif;?>
				<?php if($NHP_Options->get('slider_img_2')):?>
					<li data-target="#slider" data-slide-to="1"></li>
				<?php endif;?>
				<?php if($NHP_Options->get('slider_img_3')):?>
					<li data-target="#slider" data-slide-to="2"></li>
				<?php endif;?>
				<?php if($NHP_Options->get('slider_img_4')):?>
					<li data-target="#slider" data-slide-to="3"></li>
				<?php endif;?>
				<?php if($NHP_Options->get('slider_img_5')):?>
					<li data-target="#slider" data-slide-to="4"></li>
				<?php endif;?>
				</ol>
				<div class="carousel-inner">
				<?php if($NHP_Options->get('slider_img_1')):?>
				<div class="item active">
					<a href="<?php ($NHP_Options->get('slider_url_1')!='')?$NHP_Options->show('slider_url_1'):'#';?>" title="game android">
						<img src="<?php $NHP_Options->show('slider_img_1'); ?>" alt="tai game android">
					</a>
				</div>
				<?php endif;?>
				<?php if($NHP_Options->get('slider_img_2')):?>
				<div class="item">				  
					<a href="<?php ($NHP_Options->get('slider_url_2')!='')?$NHP_Options->show('slider_url_2'):'#';?>" title="game cho android">
						<img src="<?php $NHP_Options->show('slider_img_2'); ?>" alt="tai game cho android hay mien phi">
					</a>
				</div>
				<?php endif;?>
				<?php if($NHP_Options->get('slider_img_3')):?>
				<div class="item">				  
					<a href="<?php ($NHP_Options->get('slider_url_3')!='')?$NHP_Options->show('slider_url_3'):'#';?>" title="Tải game hot cho điện thoại">
						<img src="<?php $NHP_Options->show('slider_img_3'); ?>" alt="tai game cho android">
					</a>
				</div>
				<?php endif;?>
				<?php if($NHP_Options->get('slider_img_4')):?>
				<div class="item">				  
					<a href="<?php ($NHP_Options->get('slider_url_4')!='')?$NHP_Options->show('slider_url_4'):'#';?>" title="Tải game hot cho điện thoại">
						<img src="<?php $NHP_Options->show('slider_img_4'); ?>" alt="game android">
					</a>
				</div>
				<?php endif;?>
				<?php if($NHP_Options->get('slider_img_5')):?>
				<div class="item">			
					<a href="<?php ($NHP_Options->get('slider_url_5')!='')?$NHP_Options->show('slider_url_5'):'#';?>" title="Tải game hot cho điện thoại">				
						<img src="<?php $NHP_Options->show('slider_img_5'); ?>" alt="game android">
					</a>
				</div>
				<?php endif;?>
				</div>
				<a class="left carousel-control" href="#slider" data-slide="prev">
				  <span class="icon-prev"></span>
				</a>
				<a class="right carousel-control" href="#slider" data-slide="next">
				  <span class="icon-next"></span>
				</a>
		  </div>
	</div>
	<?php endif;?>
	<div id="site-main-content" class="col-lg-12">
		<?php get_sidebar(); ?>
		<main id="site-content" class="col-lg-9" role="main">
		<div id="site-breadcrumbs">
			<?php NQD_breadcrumbs();?>
		</div>
		<ul class="nav nav-tabs">
			<li class="active"><a href="#latest" data-toggle="tab">Mới nhất</a></li>
			<li><a href="#mostView" data-toggle="tab">Tải nhiều nhất</a></li>
		</ul>
		<div class="tab-content">
			  <div class="tab-pane active" id="latest">
				<div class="list-app">
					<?php if ( have_posts() ) : ?>
						<?php while ( have_posts() ) : the_post(); ?>
					<?php
						get_template_part( 'content', get_post_format() );
					?>
						<?php endwhile;?>
				</div>
				<?php wp_reset_query();?>
				<?php endif;?>
					<?php pagination();?>
			  </div>
			  <div class="tab-pane" id="mostView">
							<div class="list-app">					
					<?php 
					$args2 = array(
							'posts_per_page' => 16,
							'orderby' =>'meta_value_num',
							'meta_key' => 'views',
							'order' => 'DESC'
					);
					$my_query = new WP_Query($args2);?>
						<?php while ($my_query->have_posts()) : $my_query->the_post(); ?>
					<?php
						get_template_part( 'content', get_post_format() );
					?>
					<?php endwhile;?>
					
				</div>
			  </div>
		</div>
		<div class="clearfix"></div>
		
	<div style="padding:8px;">
	<h2 style="font-weight: bold;margin:0;font-size: 15px;display: inline;">Tải game android hay miễn phí</h2> - GameHot.Mobi hiện đang là website cung cấp ứng dụng miễn phí cho điện thoại và máy tính bảng sử dụng hệ điều hành Android. Khách truy cập có thể download <strong>game android</strong> theo các thể loại. Các danh mục game cho android được phân chia rõ ràng để dễ dàng tìm kiếm <strong>game android hay</strong> cho dế yêu của mình. Ngoài việc tải game thì các bạn còn có thể tải các ứng dụng hay về máy để sử dụng, tất cả đều miễn phí. Hãy ghé thăm website chúng tôi thường xuyên để download <strong>game cho android</strong> và App mới nhất nhé. <br/>
	</div>
	</div>

		</main><!-- #main -->
<!-- #primary -->

<?php get_footer(); ?>