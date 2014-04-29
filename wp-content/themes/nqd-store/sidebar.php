<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package NQD Store
 */
?>
	<div id="site-sidebar" class="col-lg-3">
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
			'items_wrap' => '<div class="list-group">%3$s</div>',
			'walker'	 => new BootstrapSidebarMenuWalker()
		);
		wp_nav_menu($args);
	?>
	</div>
