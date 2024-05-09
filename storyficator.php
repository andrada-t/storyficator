<?php
/**
* Plugin Name: Storyficator
* Plugin URI: https://modeltheme.com/
* Description: Stories Carousel for WordPress
* Version: 1.0.0
* Author: ModelTheme
* Author https://modeltheme.com/
* Text Domain: storyfi
*/

$plugin_dir = plugin_dir_path( __FILE__ );

// CMB METABOXES
require_once ('inc/vendor/cmb2/init.php');
// LOAD METABOXES
require_once('inc/metaboxes/metaboxes.php');
// LOAD POST TYPES
require_once('inc/post-types/post-types.php');

function storyfi_scripts() {
    wp_enqueue_style('storyfi-frontend-custom', plugin_dir_url(__FILE__) . 'assets/css/storyfi-frontend-custom.css', false);
    wp_enqueue_style( 'storyfi-style', get_stylesheet_uri() );
    wp_enqueue_style('flickity', plugin_dir_url(__FILE__) . 'assets/css/flickity.min.css', false);

    wp_enqueue_script('storyfi-custom', plugin_dir_url(__FILE__) . 'assets/js/storyfi-custom.js', array('jquery'));
    wp_enqueue_script('flickity', plugin_dir_url(__FILE__) . 'assets/js/flickity.pkgd.min.js', array('jquery'));
    wp_enqueue_script('jquery', plugin_dir_url(__FILE__) . 'assets/js/jquery.min.js', array('jquery'));
}
add_action( 'wp_enqueue_scripts', 'storyfi_scripts' );

// LOAD FUNCTIONS
require_once('inc/functions.php');

/**
||-> Function: storyfi_enqueue_admin_scripts()
*/
function storyfi_enqueue_admin_scripts( $hook ) {
	// CSS
	wp_register_style( 'storyfi-admin-style',  plugin_dir_url( __FILE__ ) . 'assets/css/storyfi-admin-style.css' );
	wp_enqueue_style( 'storyfi-admin-style' );

	//JS
	wp_enqueue_script('storyfi-admin', plugin_dir_url(__FILE__) . 'assets/js/storyfi-admin.js', array('jquery'), '1.0', true);
}
add_action('admin_enqueue_scripts', 'storyfi_enqueue_admin_scripts');


/**
||-> Function: LOAD PLUGIN TEXTDOMAIN
*/
function storyfi_load_textdomain(){
    $domain = 'storyfi';
    $locale = apply_filters( 'plugin_locale', get_locale(), $domain );
    load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . esc_html($domain) . '/' . esc_html($domain) . '-' . esc_html($locale) . '.pot' );
    load_plugin_textdomain( $domain, false, basename( plugin_dir_path( dirname( __FILE__ ) ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'storyfi_load_textdomain' );

