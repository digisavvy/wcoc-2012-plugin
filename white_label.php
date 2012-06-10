<?php 
/*
	White Label 
********************************************/
/*
// Repalce WP Logoin
*/
function my_custom_login() {
echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('template_directory') . '/css/custom_admin.css" />';
}
add_action('login_head', 'my_custom_login');

function new_wp_login_url() {
    echo bloginfo('url');
}

function new_wp_login_title() {
    echo 'Powered by ' . get_option('blogname');
}

add_filter('login_headerurl', 'new_wp_login_url');
add_filter('login_headertitle', 'new_wp_login_title');
/*
// Repalce WP Logo
*/
function custom_admin_css() {
echo '<link rel="stylesheet" id="custom_admin" type="text/css" href="' . get_bloginfo('template_directory') . '/css/custom_admin.css" />';
}

add_action('admin_head','custom_admin_css');
/*
// Repalce Footer Text
*/
function filter_footer_admin() {
	echo 'Provided by <a href="http://www.creativemktgservices.com/">Creative Marketing Services</a>';
}
add_filter('admin_footer_text', 'filter_footer_admin');
/*
// Replace Welcome
*/
// Customize:
$nohowdy = "Welcome Back";

// Hook in
if (is_admin()) {
add_action('init', 'ozh_nohowdy_h');
add_action('admin_footer', 'ozh_nohowdy_f');
}

// Load jQuery
function ozh_nohowdy_h() {
wp_enqueue_script('jquery');
}

// Modify
function ozh_nohowdy_f() {
global $nohowdy;
echo <<<JS
<script type="text/javascript">
//<![CDATA[
var nohowdy = "$nohowdy";
jQuery('#user_info p')
.html(
jQuery('#user_info p')
.html()
.replace(/Howdy/,nohowdy)
);
//]]>
JS;
}

// Add Favicon for admin area

function admin_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_bloginfo('template_directory').'/images/favicon.ico" />';
}
add_action('admin_head', 'admin_favicon');

?>