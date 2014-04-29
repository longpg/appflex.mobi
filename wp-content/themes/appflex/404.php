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


			<div class="khungfoot">
			Liên kết bạn vừa truy cập hiện không tồn tại, vui lòng trở về trang chủ hoặc lựa chọn danh mục ứng dụng
			</div>
	
			<div>
			<div class="nav">
			<h3 style="font-size:15px;line-height: 34px;
margin-left: 5px;
display: inline-block;color: #FFF;">Danh mục</h3>
			</div>
			<?php
		$args = array(
			'theme_location' => '',
			'depth'		 => 0,
			'container'	 => false,
			'menu_class'	 => 'nav',
			'before'          => '',
			'after'           => '',
			'link_before' =>'',
			'link_after' =>'',
			'items_wrap' => '<div class="list-group">%3$s</div>',
			'walker'	 => new BootstrapSidebarMenuWalker()
		);
		wp_nav_menu($args);
	?>
			</div>
		</main><!-- #main -->
	</section><!-- #primary -->
	<?php get_sidebar();?>
<?php get_footer(); ?>
