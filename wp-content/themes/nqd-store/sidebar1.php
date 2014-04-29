<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package NQD Store
 */
?>
	<div id="site-sidebar" class="col-lg-3">
	<div class="cate-dropbox visible-xs">
	<form action="<?php bloginfo('url'); ?>/" method="get">
							<div >
							<label class="category">
							<?php
								$args = array(
									'show_option_all'    => '',
									'show_option_none'   => 'Chọn chuyên mục',
									'orderby'            => 'ID', 
									'order'              => 'ASC',
									'show_count'         => 1,
									'hide_empty'         => 1, 
									'child_of'           => 0,
									'exclude'            => '',
									'echo'               => 0,
									'selected'           => 0,
									'hierarchical'       => 1, 
									'name'               => 'cat',
									'id'                 => '',
									'class'              => 'postform',
									'depth'              => 0,
									'tab_index'          => 0,
									'taxonomy'           => 'category',
									'hide_if_empty'      => false
								);
							$select = wp_dropdown_categories($args);
							$select = preg_replace("#<select([^>]*)>#", "<select$1 onchange='return this.form.submit()'>", $select);
							echo $select;
							?>
							</label>
							<noscript><input type="submit" value="Xem"/></noscript>
							</div>
	</form>
	</div>
	<?php
		$args = array(
			'theme_location' => 'sidebar',
			'depth'		 => 0,
			'container'	 => false,
			'menu_class'	 => 'nav',
			'before'          => '',
			'after'           => '',
			'link_before' =>'',
			'link_after' =>'',
			'items_wrap' => '<div class="list-group visible-lg">%3$s</div>',
			'walker'	 => new BootstrapSidebarMenuWalker()
		);
		wp_nav_menu($args);
	?>
	<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('sidebar') ) : ?>
	<?php endif; ?>
	</div>
