<?php
/*
Plugin Name: A Branding Plugin
Description: Customizes certain elements of your site's admin area
Version: 0.2
License: GPL
Author: Alex Vasquez
Author URI: http://digisavvy.com
*/

/* Dashboard Widgets
-------------------------------------------------- */

// disable default dashboard widgets
function disable_default_dashboard_widgets() {
	if(!current_user_can('administrator')) {
		// remove_meta_box('dashboard_right_now', 'dashboard', 'core');    // Right Now Widget
		remove_meta_box('dashboard_recent_comments', 'dashboard', 'core'); // Comments Widget
		remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');  // Incoming Links Widget
		remove_meta_box('dashboard_plugins', 'dashboard', 'core');         // Plugins Widget
	
		// remove_meta_box('dashboard_quick_press', 'dashboard', 'core');  // Quick Press Widget
		remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');   // Recent Drafts Widget
		remove_meta_box('dashboard_primary', 'dashboard', 'core');         // 
		remove_meta_box('dashboard_secondary', 'dashboard', 'core');       //
		
		// removing plugin dashboard boxes 
		remove_meta_box('yoast_db_widget', 'dashboard', 'normal');         // Yoast's SEO Plugin Widget
	
} }

/* DigiSavvy Dashboard Help Widget
-------------------------------------------------- */

add_action('wp_dashboard_setup', 'digisavvy_widget');

function digisavvy_widget() {

global $wp_meta_boxes;

wp_add_dashboard_widget('custom_help_widget', 'Get Support for Your Website', 'custom_dashboard_help');
}
	// All the Stuff below you should obviously change so that it is consistent with your own branding n' stuff...

function custom_dashboard_help() {
echo '<img style="margin-right:10px;" align="left" height="50" width="50" src="http://sphotos.xx.fbcdn.net/hphotos-ash4/423659_10150636190229647_329024654646_9117065_1626144716_n.jpg"><ul>
	<li><strong>Launch Date:</strong> June 2012</li>
	<li><strong>Developed by:</strong> DigiSavvy</li>
	<li><strong>Hosting Provider</strong>: InMotion Hosting</li>
	<li>Need help? Contact the DigiSavvy Team <a href="mailto:info@digisavvy.com">here</a>. For additional information on what we do, visit our site: <a href="http://digisavvy.com/contact" target="_blank">DigiSavvy</a> -or- feel free to give us a call:<strong> 855-344-7289</strong></li>
		</ul>';
}


/* Custom Login and Admin Areas
-------------------------------------------------- */
/* 	A note of caution here. The admin area has changed in a number of ways with the last few releases of WordPress. It's not the greatest idea make a bunch of changes here. In other words, all this stuff I'm doing here is ill-advised. ;-)
*/


// Add DigiSavvy Admin Bar Info
function dg_admin_bar_menu() {
	global $wp_admin_bar;
	if ( !is_super_admin() || !is_admin_bar_showing() )
		return;
	$wp_admin_bar->add_menu( array(
	'id' => 'enla_menu',
	'title' => __( 'Helpful Links'),
	'href' => FALSE ) );
	$wp_admin_bar->add_menu( array(
	'parent' => 'enla_menu',
	'title' => __( 'Your Webhosting Cpanel'),
	'href' => '#' ) );
	$wp_admin_bar->add_menu( array(
	'parent' => 'enla_menu',
	'title' => __( 'Your DigiSavvy Account Portal'),
	'href' => '#' ) );
	$wp_admin_bar->add_menu( array(
	'parent' => 'enla_menu',
	'title' => __( 'Get Support'),
	'href' => '#' ) );
	$wp_admin_bar->add_menu( array(
	'parent' => 'enla_menu',
	'title' => __( 'Contact Us'),
	'href' => '#' ) );
	$wp_admin_bar->add_menu( array(
	'parent' => 'enla_menu',
	'title' => __( 'Like us on Facebook'),
	'href' => 'http://www.facebook.com/digisavvy' ) );
	$wp_admin_bar->add_menu( array(
	'parent' => 'enla_menu',
	'title' => __( 'Follow us on Twitter'),
	'href' => 'http://www.twitter.com/digi_savvy' ) );
}
add_action('admin_bar_menu', 'dg_admin_bar_menu');


// calling your own login css so you can style it 
function LoginCSS() {
		echo '<link rel="stylesheet" type="text/css" href="'. CHILD_URL . '/lib/css/login.css">'; // Change to the the appropriate directory for your child theme
	}
	add_action('login_head', 'LoginCSS');


// Remove WordPress Admin Logo
function wps_admin_bar() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('wp-logo');
}
add_action( 'wp_before_admin_bar_render', 'wps_admin_bar' ); 

// Changing admin dashboard logo

function custom_admin_logo() {
	echo '<style type="text/css">#header-logo { background-image: url('.get_bloginfo('. CHILD_URL .').'/images/logo_admin_dashboard.png) !important; }</style>';
}
add_action('admin_head', 'custom_admin_logo');


// Change Howdy Text
function dg_replace_howdy( $text ) {
	$text = str_replace( 'Howdy', 'Welcome back', $text );

	return $text;
}
add_filter( 'gettext', 'dg_replace_howdy' );

// Custom Backend Footer
function dg_custom_admin_footer() {
	echo '<span id="footer-thankyou">Developed by <a href="http://digisavvy.com" target="_blank">DigiSavvy, Inc.</a></span>. Built using <a href="http://themble.com/genesis/bones" target="_blank">WordPress, Genesis and Some Other Goodies</a>. ';
}

// adding it to the admin area
add_filter('admin_footer_text', 'dg_custom_admin_footer');

/* Disallow file edits of theme and plugin files
------------------------------------------------------------------------------------------------------------------------ */
	define('DISALLOW_FILE_EDIT', true);

