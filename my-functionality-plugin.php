<?php
/*
Plugin Name: A sample functionality plugin n' stuff
Description: For WordCamp Orange County 2012
Version: 0.1
License: GPL
Author: Alex Vasquez
Author URI: http://digisavvy.com
*/

/* DigiSavvy Dashboard Functions
------------------------------------------------- */
add_action('wp_dashboard_setup', 'digisavvy_widget');

function digisavvy_widget() {
if(!current_user_can('administrator')) {
global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'Need Help With Your Website?', 'custom_dashboard_help');
}

function custom_dashboard_help() {
echo '<img style="margin-right:10px;" align="left" height="50" width="50" src="http://sphotos.xx.fbcdn.net/hphotos-ash4/423659_10150636190229647_329024654646_9117065_1626144716_n.jpg"><ul>
	<li><strong>Launch Date:</strong> May 2012</li>
	<li><strong>Developed by:</strong> DigiSavvy</li>
	<li><strong>Hosting Provider</strong>: Hostgator</li>
	<li>Need help? Contact the DigiSavvy Team <a href="mailto:info@digisavvy.com">here</a>. For additional information on what we do, visit our site: <a href="http://digisavvy.com/contact" target="_blank">DigiSavvy</a> -or- feel free to give us a call:<strong> 855-344-7289</strong></li>
		</ul>';
} } 


/* Change the site Login Logo
------------------------------------------------------------------------------------------------------------------------ */
function LoginCSS() {
		echo '<link rel="stylesheet" type="text/css" href="http://www.wcoc2012/wp-content/themes/base-theme/wp-login.css"/>';
	}
	add_action('login_head', 'LoginCSS');
	
	
/* Change the admin footer info
------------------------------------------------------------------------------------------------------------------------ */
	function remove_footer_admin () {
		echo 'Theme designed and developed by <a href="http://digisavvy.com" target="_blank">DigiSavvy, Inc.</a> and powered by <a href="http://wordpress.org" target="_blank">WordPress</a>.';
	}
	add_filter('admin_footer_text', 'remove_footer_admin');
	
/* Disallow file edits of theme and plugin files
------------------------------------------------------------------------------------------------------------------------ */
	define('DISALLOW_FILE_EDIT', true);
	
/* Editing the Admin Menu Ñ http://wp.tutsplus.com/tutorials/creative-coding/customizing-your-wordpress-admin/
------------------------------------------------------------------------------------------------------------------------ */
function edit_admin_menus() {
	global $menu;
	global $submenu;

	$menu[5][0] = 'Articles'; // Change Posts to Articles
	$submenu['edit.php'][5][0] = 'All Articles';
	$submenu['edit.php'][10][0] = 'Add an Article';
	$submenu['edit.php'][15][0] = 'Topics'; // Rename categories to Topics
	
	$menu[10][0] = 'Images'; // Change Media to images
	$submenu['upload.php'][5][0] = 'All Images';
	$submenu['media-new.php'][10][0] = 'Add New Image';
	
	remove_menu_page('tools.php'); // Remove the Tools menu
	remove_menu_page('link-manager.php'); // Get the links manager outta here
	remove_submenu_page('themes.php','theme-editor.php'); // Remove the Theme Editor submenu
}
add_action( 'admin_menu', 'edit_admin_menus' );


/* Re-ordering the admin menu Ñ by Andrew Norcross - https://gist.github.com/1340795
------------------------------------------------------------------------------------------------------------------------ */
function rkv_reorder_menu( $__return_true) {
		return array(
			'index.php', // this represents the dashboard link
			'options-general.php', // this represents the dashboard link
			'edit.php?post_type=page', // this is the default page menu		
			'edit.php', // this is the default POST admin menu 
			'upload.php',
		);
   }

add_filter('custom_menu_order', 'rkv_reorder_menu');
add_filter('menu_order', 'rkv_reorder_menu');     

/* Removing Un-needed dashboard widgets
------------------------------------------------------------------------------------------------------------------------ */

add_action('wp_dashboard_setup', 'wpc_dashboard_widgets');

function wpc_dashboard_widgets() {
if(!current_user_can('administrator')) {
	global $wp_meta_boxes;
	// Today widget
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_right_now']);
	// Last comments
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	// Incoming links
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	// Plugins
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_secondary']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
} }


