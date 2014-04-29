<?php
require_once('plugins/wp-postviews/wp-postviews.php');

if ( isset($_GET['id']) ) {
  $validated = true;
  $id = $_GET['id'];

  // Check if ID is positive number
  if ( !preg_match("/^\d+$/", $id) ) {
    $validated = false;
  }

  // If input looks good, record the view
  if ( $validated ) {
	  $post_views = get_post_custom($post_id);
	  $post_views = intval($post_views['views'][0]);
    if(!update_post_meta($id, 'views', ($post_views+1))) {
      add_post_meta($id, 'views', 1, true);
    }
  }
}
?>
