<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package NQD Store
 */

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function nqd_store_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'nqd_store_page_menu_args' );

/**
 * Adds custom classes to the array of body classes.
 */
function nqd_store_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'nqd_store_body_classes' );

/**
 * Filter in a link to a content ID attribute for the next/previous image links on image attachment pages
 */
function nqd_store_enhanced_image_navigation( $url, $id ) {
	if ( ! is_attachment() && ! wp_attachment_is_image( $id ) )
		return $url;

	$image = get_post( $id );
	if ( ! empty( $image->post_parent ) && $image->post_parent != $id )
		$url .= '#main';

	return $url;
}
add_filter( 'attachment_link', 'nqd_store_enhanced_image_navigation', 10, 2 );

/**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 */
function nqd_store_wp_title( $title, $sep ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	// Add the blog name
	$title .= get_bloginfo( 'name' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title .= " $sep $site_description";

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		$title .= " $sep " . sprintf( __( 'Page %s', 'nqd-store' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'nqd_store_wp_title', 10, 2 );

function catch_that_image() {
  global $post, $posts;
  $first_img = '';
  $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
  if(empty($url)){
	  ob_start();
	  ob_end_clean();
	  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	  $first_img = $matches[1][0];
	  if(empty($first_img)) {
			$first_img = find_img_src($post);
		if(empty($first_img)) {
			$first_img = get_template_directory_uri()."/images/no-image.jpg";
		}
	  }
  }else{
	$first_img = $url;
  }
  return remove_http($first_img);
}
function catch_that_image_id($post) {
  $first_img = '';
  $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
  if(empty($url)){
	  ob_start();
	  ob_end_clean();
	  $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	  $first_img = $matches[1][0];
	  if(empty($first_img)) {
			$first_img = find_img_src($post);
		if(empty($first_img)) {
			$first_img = get_template_directory_uri()."/images/no-image.jpg";
		}
	  }
  }else{
	$first_img = $url;
  }
  return remove_http($first_img);
}
function gpi_find_image_id($post_id) {
    if (!$img_id = get_post_thumbnail_id ($post_id)) {
        $attachments = get_children(array(
            'post_parent' => $post_id,
            'post_type' => 'attachment',
            'numberposts' => 1,
            'post_mime_type' => 'image'
        ));
        if (is_array($attachments)) foreach ($attachments as $a)
            $img_id = $a->ID;
    }
    if ($img_id)
        return $img_id;
    return false;
}
function find_img_src($post) {
    if (!$img = gpi_find_image_id($post->ID))
        if ($img = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches))
            $img = $matches[1][0];
    if (is_int($img)) {
        $img = wp_get_attachment_image_src($img);
        $img = $img[0];
    }
    return $img;
}
 // check mobile browser
 function remove_http($input = '')
{
	$input = trim($input, '/');

	// If scheme not included, prepend it
	if (!preg_match('#^http(s)?://#', $input)) {
		$input = 'http://' . $input;
	}

	$urlParts = parse_url($input);

	// remove www
	$domain = preg_replace('/^www\./', '', $urlParts['host']);
	$domain.=$urlParts['path'];
	$domain.=$urlParts['query'];
	return $domain;
}
function pagination($pages = '', $range = 3) {
	$showitems = ($range * 2) + 1;
	
	global $paged;
	if (empty ( $paged ))
		$paged = 1;
	
	if ($pages == '') {
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if (! $pages) {
			$pages = 1;
		}
	}
	if (1 != $pages) {
		echo "<div class='text-center'><ul class='pagination'>";
		if ($paged > 2 && $paged > $range + 1 && $showitems < $pages)
			echo "<li><a href='" . get_pagenum_link ( 1 ) . "'>&laquo;</a></li>";
		if ($paged > 1 && $showitems < $pages)
			echo "<li><a href='" . get_pagenum_link ( $paged - 1 ) . "'>&lsaquo;</a></li>";
		
		for($i = 1; $i <= $pages; $i ++) {
			if (1 != $pages && (! ($i >= $paged + $range + 1 || $i <= $paged - $range - 1) || $pages <= $showitems)) {
				echo ($paged == $i) ? "<li class='active'><span class='current'>" . $i . "</span></li>" : "<li><a href='" . get_pagenum_link ( $i ) . "' class='inactive' >" . $i . "</a></li>";
			}
		}
		
		if ($paged < $pages && $showitems < $pages)
			echo "<li><a href='" . get_pagenum_link ( $paged + 1 ) . "'>&rsaquo;</a></li>";
		if ($paged < $pages - 1 && $paged + $range - 1 < $pages && $showitems < $pages)
			echo "<li><a href='" . get_pagenum_link ( $pages ) . "'>&raquo;</a></li>";
		echo "</ul></div>\n";
	}
}
function NQD_breadcrumbs() {
	  /* === OPTIONS === */  
    $text['home']     = 'Trang chủ'; // text for the 'Home' link  
    $text['category'] = 'Danh mục "%s"'; // text for a category page  
    $text['search']   = 'Kết quả tìm kiếm cho từ khóa "%s"'; // text for a search results page  
    $text['tag']      = 'Tag "%s"'; // text for a tag page  
    $text['author']   = 'Bài viết bởi %s'; // text for an author page  
    $text['404']      = 'Error 404'; // text for the 404 page  
  
    $showCurrent = 0; // 1 - show current post/page title in breadcrumbs, 0 - don't show  
    $showOnHome  = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show  
    $delimiter   = ' &raquo; '; // delimiter between crumbs  
    $before      = '<span class="current">'; // tag before the current crumb  
    $after       = '</span>'; // tag after the current crumb  
    /* === END OF OPTIONS === */  
  
    global $post;  
    $homeLink = get_bloginfo('url') . '/';  
    $linkBefore = '<span typeof="v:Breadcrumb">';  
    $linkAfter = '</span>';  
    $linkAttr = ' rel="v:url" property="v:title"';  
    $link = $linkBefore . '<a' . $linkAttr . ' href="%1$s">%2$s</a>' . $linkAfter;  
  
    if (is_home() || is_front_page()) {  
  
        if ($showOnHome == 1) echo '<div id="crumbs" class="breadcrumb"><a href="' . $homeLink . '">' . $text['home'] . '</a></div>';  
  
    } else {  
  
        echo '<div class="breadcrumb" id="crumbs" xmlns:v="http://rdf.data-vocabulary.org/#">' . sprintf($link, $homeLink, $text['home']) . $delimiter;  
  
        if ( is_category() ) {  
            $thisCat = get_category(get_query_var('cat'), false);  
            if ($thisCat->parent != 0) {  
                $cats = get_category_parents($thisCat->parent, TRUE, $delimiter);  
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);  
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);  
                echo $cats;  
            }  
            echo $before . sprintf($text['category'], single_cat_title('', false)) . $after;  
  
        } elseif ( is_search() ) {  
            echo $before . sprintf($text['search'], get_search_query()) . $after;  
  
        } elseif ( is_day() ) {  
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
            echo sprintf($link, get_month_link(get_the_time('Y'),get_the_time('m')), get_the_time('F')) . $delimiter;  
            echo $before . get_the_time('d') . $after;  
  
        } elseif ( is_month() ) {  
            echo sprintf($link, get_year_link(get_the_time('Y')), get_the_time('Y')) . $delimiter;  
            echo $before . get_the_time('F') . $after;  
  
        } elseif ( is_year() ) {  
            echo $before . get_the_time('Y') . $after;  
  
        } elseif ( is_single() && !is_attachment() ) {  
            if ( get_post_type() != 'post' ) {  
                $post_type = get_post_type_object(get_post_type());  
                $slug = $post_type->rewrite;  
                printf($link, $homeLink . '/' . $slug['slug'] . '/', $post_type->labels->singular_name);  
                if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;  
            } else {  
                $cat = get_the_category(); $cat = $cat[0];  
                $cats = get_category_parents($cat, TRUE, $delimiter);  
                if ($showCurrent == 0) $cats = preg_replace("#^(.+)$delimiter$#", "$1", $cats);  
                $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);  
                $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);  
                echo $cats;  
                if ($showCurrent == 1) echo $before . get_the_title() . $after;  
            }  
  
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {  
            $post_type = get_post_type_object(get_post_type());  
            echo $before . $post_type->labels->singular_name . $after;  
  
        } elseif ( is_attachment() ) {  
            $parent = get_post($post->post_parent);  
            $cat = get_the_category($parent->ID); $cat = $cat[0];  
            $cats = get_category_parents($cat, TRUE, $delimiter);  
            $cats = str_replace('<a', $linkBefore . '<a' . $linkAttr, $cats);  
            $cats = str_replace('</a>', '</a>' . $linkAfter, $cats);  
            echo $cats;  
            printf($link, get_permalink($parent), $parent->post_title);  
            if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;  
  
        } elseif ( is_page() && !$post->post_parent ) {  
            if ($showCurrent == 1) echo $before . get_the_title() . $after;  
  
        } elseif ( is_page() && $post->post_parent ) {  
            $parent_id  = $post->post_parent;  
            $breadcrumbs = array();  
            while ($parent_id) {  
                $page = get_page($parent_id);  
                $breadcrumbs[] = sprintf($link, get_permalink($page->ID), get_the_title($page->ID));  
                $parent_id  = $page->post_parent;  
            }  
            $breadcrumbs = array_reverse($breadcrumbs);  
            for ($i = 0; $i < count($breadcrumbs); $i++) {  
                echo $breadcrumbs[$i];  
                if ($i != count($breadcrumbs)-1) echo $delimiter;  
            }  
            if ($showCurrent == 1) echo $delimiter . $before . get_the_title() . $after;  
  
        } elseif ( is_tag() ) {  
            echo $before . sprintf($text['tag'], single_tag_title('', false)) . $after;  
  
        } elseif ( is_author() ) {  
            global $author;  
            $userdata = get_userdata($author);  
            echo $before . sprintf($text['author'], $userdata->display_name) . $after;  
  
        } elseif ( is_404() ) {  
            echo $before . $text['404'] . $after;  
        }  
  
        if ( get_query_var('paged') ) {  
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';  
            echo __('Page') . ' ' . get_query_var('paged');  
            if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';  
        }
		if(is_page('manufacturers')){
			echo '<span typeof="v:Breadcrumb"><a href="'.home_url().'/manufacturers/'.get_query_var('manufacturers_name').'" property="v:title" rel="v:url">'.urldecode(get_query_var('manufacturers_name')).'</a></span>';
		}
		if(is_page('detail')){
			echo '<span typeof="v:Breadcrumb"><a href="'.get_permalink(get_query_var('post_id')).'" property="v:title" rel="v:url">'.get_the_title(get_query_var('post_id')).'</a></span>';
		}
        echo '</div>';  
  
    }  
}
function wp_get_postcount($id) {
  //return count of post in category child of ID 15
  $count = 0;
  $taxonomy = 'category';
  $args = array('child_of' => $id);
  $tax_terms = get_terms($taxonomy,$args);
  foreach ($tax_terms as $tax_term) {
    $count +=$tax_term->count;
  }
  return $count;
}
class BootstrapNavMenuWalker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth) {
		$indent = str_repeat ( "\t", $depth );
		$submenu = ($depth > 0) ? ' sub-menu' : '';
		$output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
	}
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$indent = ($depth) ? str_repeat ( "\t", $depth ) : '';
		
		$li_attributes = '';
		$class_names = $value = '';
		
		$classes = empty ( $item->classes ) ? array () : ( array ) $item->classes;
		
		// managing divider: add divider class to an element to get a divider
		// before it.
		$divider_class_position = array_search ( 'divider', $classes );
		if ($divider_class_position !== false) {
			$output .= "<li class=\"divider\"></li>\n";
			unset ( $classes [$divider_class_position] );
		}
		
		$classes [] = ($args->has_children) ? 'dropdown' : '';
		$classes [] = ($item->current || $item->current_item_ancestor) ? 'active' : '';
		$classes [] = 'menu-item-' . $item->ID;
		if ($depth && $args->has_children) {
			$classes [] = 'dropdown-submenu';
		}
		
		$class_names = join ( ' ', apply_filters ( 'nav_menu_css_class', array_filter ( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr ( $class_names ) . '"';
		
		$id = apply_filters ( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = strlen ( $id ) ? ' id="' . esc_attr ( $id ) . '"' : '';
		
		$output .= $indent . '<li' . $id . $value . $class_names . $li_attributes . '>';
		
		$attributes = ! empty ( $item->attr_title ) ? ' title="' . esc_attr ( $item->attr_title ) . '"' : '';
		$attributes .= ! empty ( $item->target ) ? ' target="' . esc_attr ( $item->target ) . '"' : '';
		$attributes .= ! empty ( $item->xfn ) ? ' rel="' . esc_attr ( $item->xfn ) . '"' : '';
		$attributes .= ! empty ( $item->url ) ? ' href="' . esc_attr ( $item->url ) . '"' : '';
		$attributes .= ($args->has_children) ? ' class="dropdown-toggle" data-toggle="dropdown"' : '';
		
		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters ( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= ($depth == 0 && $args->has_children) ? ' <b class="caret"></b></a>' : '</a>';
		$item_output .= $args->after;
		
		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		// v($element);
		if (! $element)
			return;
			
			// $start="<li class=\"active\"><a href=\"index.html\"><i
			// class=\"icon-home\"></i></a></li>";
			// $start.= $output;
			// $output = $start;
		
		$id_field = $this->db_fields ['id'];
		
		// display this element
		if (is_array ( $args [0] ))
			$args [0] ['has_children'] = ! empty ( $children_elements [$element->$id_field] );
		else if (is_object ( $args [0] ))
			$args [0]->has_children = ! empty ( $children_elements [$element->$id_field] );
		$cb_args = array_merge ( array (
				&$output,
				$element,
				$depth 
		), $args );
		call_user_func_array ( array (
				&$this,
				'start_el' 
		), $cb_args );
		$id = $element->$id_field;
		
		// descend only when the depth is right and there are childrens for this
		// element
		if (($max_depth == 0 || $max_depth > $depth + 1) && isset ( $children_elements [$id] )) {
			
			foreach ( $children_elements [$id] as $child ) {
				
				if (! isset ( $newlevel )) {
					$newlevel = true;
					// start the child delimiter
					$cb_args = array_merge ( array (
							&$output,
							$depth 
					), $args );
					call_user_func_array ( array (
							&$this,
							'start_lvl' 
					), $cb_args );
				}
				$this->display_element ( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset ( $children_elements [$id] );
		}
		
		if (isset ( $newlevel ) && $newlevel) {
			// end the child delimiter
			$cb_args = array_merge ( array (
					&$output,
					$depth 
			), $args );
			call_user_func_array ( array (
					&$this,
					'end_lvl' 
			), $cb_args );
		}
		
		// end this element
		$cb_args = array_merge ( array (
				&$output,
				$element,
				$depth 
		), $args );
		call_user_func_array ( array (
				&$this,
				'end_el' 
		), $cb_args );
	}
}
class BootstrapSidebarMenuWalker extends Walker_Nav_Menu {
	function start_lvl(&$output, $depth) {
		$indent = str_repeat ( "\t", $depth );
		$submenu = ($depth > 0) ? ' sub-menu' : '';
	}
	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
		$indent = ($depth) ? str_repeat ( "\t", $depth ) : '';
		
		$li_attributes = '';
		$class_names = $value = '';
		
		$classes = empty ( $item->classes ) ? array () : ( array ) $item->classes;
		
		// managing divider: add divider class to an element to get a divider
		// before it.
		$id_cate = $id;
		$class_names = join ( ' ', apply_filters ( 'nav_menu_css_class', array_filter ( $classes ), $item, $args ) );
		$class_names = ' class="' . esc_attr ( $class_names ) . '"';
		
		$id = apply_filters ( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args );
		$id = strlen ( $id ) ? ' id="' . esc_attr ( $id ) . '"' : '';
		$attributes = ! empty ( $item->attr_title ) ? ' title="' . esc_attr ( $item->attr_title ) . '"' : '';
		$attributes .= ! empty ( $item->target ) ? ' target="' . esc_attr ( $item->target ) . '"' : '';
		$attributes .= ! empty ( $item->xfn ) ? ' rel="' . esc_attr ( $item->xfn ) . '"' : '';
		$attributes .= ! empty ( $item->url ) ? ' href="' . esc_attr ( $item->url ) . '"' : '';
		$attributes .= ' class="list-group-item"';
		
		//$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$category = get_category($item->object_id);
		$count = $category->category_count;
		
		$item_output .= ($args->has_children) ?'<span class="badge bg-warning">'.wp_get_postcount($item->object_id).'</span>':'<span class="badge bg-info">'.$count.'</span>';
		$item_output .= ($args->has_children) ? '<span class="text-bold">'.$args->link_before . apply_filters ( 'the_title', $item->title, $item->ID ) . $args->link_after .'</span>': $args->link_before . apply_filters ( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		//$item_output .= $args->after;
		
		$output .= apply_filters ( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
	function end_el( &$output, $element, $depth, $args ) {
		$output.='';
	}
	function end_lvl( &$output, $depth, $args ) {
		$output.='';
	}
	function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output) {
		// v($element);
		if (! $element)
			return;
		
		$id_field = $this->db_fields ['id'];
		
		// display this element
		if (is_array ( $args [0] ))
			$args [0] ['has_children'] = ! empty ( $children_elements [$element->$id_field] );
		else if (is_object ( $args [0] ))
			$args [0]->has_children = ! empty ( $children_elements [$element->$id_field] );
		$cb_args = array_merge ( array (
				&$output,
				$element,
				$depth 
		), $args );
		call_user_func_array ( array (
				&$this,
				'start_el' 
		), $cb_args );
		$id = $element->$id_field;
		
		// descend only when the depth is right and there are childrens for this
		// element
		if (($max_depth == 0 || $max_depth > $depth + 1) && isset ( $children_elements [$id] )) {
			
			foreach ( $children_elements [$id] as $child ) {
				
				if (! isset ( $newlevel )) {
					$newlevel = true;
					// start the child delimiter
					$cb_args = array_merge ( array (
							&$output,
							$depth 
					), $args );
					call_user_func_array ( array (
							&$this,
							'start_lvl' 
					), $cb_args );
				}
				$this->display_element ( $child, $children_elements, $max_depth, $depth + 1, $args, $output );
			}
			unset ( $children_elements [$id] );
		}
		
		if (isset ( $newlevel ) && $newlevel) {
			// end the child delimiter
			$cb_args = array_merge ( array (
					&$output,
					$depth 
			), $args );
			call_user_func_array ( array (
					&$this,
					'end_lvl' 
			), $cb_args );
		}
		
		// end this element
		$cb_args = array_merge ( array (
				&$output,
				$element,
				$depth 
		), $args );
		call_user_func_array ( array (
				&$this,
				'end_el' 
		), $cb_args );
	}
}
function formatBytes($bytes, $precision = 2) { 
    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 

    $bytes = max($bytes, 0); 
    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
    $pow = min($pow, count($units) - 1); 

    // Uncomment one of the following alternatives
     $bytes /= pow(1024, $pow);
    // $bytes /= (1 << (10 * $pow)); 

    return round($bytes, $precision) . ' ' . $units[$pow]; 
}
//expand link from bit.ly
function expandBitly($url){
	// get host name from URL
	preg_match('@^(?:http://)?([^/]+)@i',$url, $matches);
	$host = $matches[1];
	// get last two segments of host name
	preg_match('/[^.]+\.[^.]+$/', $host, $matches);
	if($matches[0] == 'bit.ly')
	{

		$bitly  = new Bitly('o_19kpvsso1r','R_bb9f3f8d2aa62705fdc5750866f11176');
		$url= $bitly->expand($url);
	}
	return $url;
}
//rewrite url download

add_filter('query_vars', 'parameter_queryvars' );
function parameter_queryvars( $qvars )
{
	$qvars[] = 'pid';
	return $qvars;
}
//meta query var
add_filter('query_vars', 'parameter_queryvars1' );
function parameter_queryvars1( $qvars )
{
	$qvars[] = 'file_id';
	return $qvars;
}
add_filter('query_vars', 'parameter_queryvars2' );
function parameter_queryvars2( $qvars )
{
	$qvars[] = 'file_name';
	return $qvars;
}
add_action( 'init', 'urldlRewrite_init' );
function urldlRewrite_init()
{
    add_rewrite_rule(
        'download(/([^/]+))?(/([^/]+))?(/([^/]+))?/?',
        'index.php?pagename=download&file_id=$matches[2]&file_name=$matches[4]&pid=$matches[6]','top'
    );
}
//rewrite url download

add_filter('query_vars', 'parameter_queryvar_manufacturers' );
function parameter_queryvar_manufacturers( $qvars )
{
	$qvars[] = 'manufacturers_name';
	return $qvars;
}
//meta query var
add_action( 'init', 'url_manufacturers_Rewrite_init' );
function url_manufacturers_Rewrite_init()
{
    add_rewrite_rule(
        'manufacturers(/([^/]+))?/?',
        'index.php?pagename=manufacturers&manufacturers_name=$matches[2]','top'
    );
}

add_filter('query_vars', 'parameter_queryvar_download_detail' );
function parameter_queryvar_download_detail( $qvars )
{
	$qvars[] = 'post_id';
	return $qvars;
}
//meta query var
add_action( 'init', 'url_download_detail_Rewrite_init' );
function url_download_detail_Rewrite_init()
{
    add_rewrite_rule(
        'detail(/([^/]+))?/?',
        'index.php?pagename=detail&post_id=$matches[2]','top'
    );
}
add_action( 'wp_head','add_ajax_library');
function add_ajax_library() {
 
    $html = '<script type="text/javascript">';
        $html .= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"';
    $html .= '</script>';
    echo $html;
 
} // end add_ajax_library

function mostDownloadTab(){
?>
<div class="mostDownload">
	<?php 
		$post_ID = getPostIDFilterFileHits();			
	?>
	<?php 
		foreach($post_ID as $post_item):
		global $post; 
		$post = get_post($post_item->post_id);			
		setup_postdata($post); 
	?>
	<?php
		get_template_part( 'content', get_post_format() );
	?>
	<?php endforeach;
		wp_reset_postdata();
	?>
	</div>
<?php
die();
}
add_action( 'wp_ajax_mostDownloadTab', 'mostDownloadTab' );
add_action( 'wp_ajax_nopriv_mostDownloadTab', 'mostDownloadTab' );

function mostStarTab(){
?>
<div class="mostStar">
	<?php 
							$post_ID = getPostIDFilterStar();					
						?>
						<?php 
							foreach($post_ID as $post_item):
							global $post; 
							$post = get_post($post_item->post_id);				
							setup_postdata($post); 
						?>
					<?php
						get_template_part( 'content', get_post_format() );
					?>
						<?php endforeach;
							wp_reset_postdata();
						?>
	</div>
<?php
die();
}
add_action( 'wp_ajax_mostStarTab', 'mostStarTab' );
add_action( 'wp_ajax_nopriv_mostStarTab', 'mostStarTab' );
function download_page_link($page) {
	$current_url = $_SERVER['REQUEST_URI'];
	$curren_downloadpage = intval($_GET['paged']);
	$download_page_link = preg_replace('/paged=(\d+)/i', 'paged='.$page, $current_url);
	if($curren_downloadpage == 0) {
		if(strpos($current_url, '?') !== false) {
			$download_page_link = "$download_page_link&amp;paged=$page";
		} else {
			$download_page_link = "$download_page_link?paged=$page";
		}
	}
	return $download_page_link;
}
