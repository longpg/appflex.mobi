<?php
/*
Plugin Name: Google Play Category Importer
Plugin URI:
Description: IMPORT all apps from a google play category
Version: 1.0
Author: Dao Dog
Author URI: daodog.tk
License: GPL
Copyright: Condom
*/

add_action('admin_menu', 'gic_admin_menu');

/**
 * add external link to Tools area
 */
function gic_admin_menu() {
    global $submenu;
    $url = '/wp-admin/postgame.php';
    $submenu['edit.php'][] = array('Google Play Import', 'manage_options', $url);
}