<?php
/**
 * Plugin Name: Library Book Search
 * Text Domain: library-book-search
 * Domain Path: /languages/
 * Description:  
 * Version: 1.0.0
 *
 * @package Library Book Search
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if( ! defined( 'WP_LBS_VERSION' ) ) {
	define( 'WP_LBS_VERSION', '1.0.0' ); // Version of plugin
}
if( ! defined( 'WP_LBS_DIR' ) ) {
	define( 'WP_LBS_DIR', dirname( __FILE__ ) ); // Plugin dir
}
if( ! defined( 'WP_LBS_URL' ) ) {
	define( 'WP_LBS_URL', plugin_dir_url( __FILE__ ) ); // Plugin url
}
if( ! defined( 'WP_LBS_POST_TYPE' ) ) {
	define( 'WP_LBS_POST_TYPE', 'book' ); // Plugin post type
}
if( ! defined( 'WP_LBS_CAT' ) ) {
	define( 'WP_LBS_CAT', 'author' ); // Plugin category name
}
if( ! defined( 'WP_LBS_PUBLISHER_CAT' ) ) {
	define( 'WP_LBS_PUBLISHER_CAT', 'publisher' ); // Plugin category name
}
if( ! defined( 'WP_LBS_META_PREFIX' ) ) {
	define( 'WP_LBS_META_PREFIX', '_wp_lbs_' ); // Plugin metabox prefix
}

/**
 * Activation Hook
 * 
 * Register plugin activation hook.
 * 
 * @package Library Book Search
 * @since 1.0.0
 */
register_activation_hook( __FILE__, 'wp_lbs_install' );

/**
 * Deactivation Hook
 * 
 * Register plugin deactivation hook.
 * 
 * @package Library Book Search
 * @since 1.0.0
 */
register_deactivation_hook( __FILE__, 'wp_lbs_uninstall');

/**
 * Plugin Setup (On Activation)
 * 
 * Does the initial setup,
 * stest default values for the plugin options.
 * 
 * @package Library Book Search
 * @since 1.0.0
 */
function wp_lbs_install() {


	wp_lbs_register_post_type();
	wp_lbs_register_taxonomies();

	// IMP need to flush rules for custom registered post type
	flush_rewrite_rules();
}

/**
 * Plugin Setup (On Deactivation)
 * 
 * Delete  plugin options.
 * 
 * @package Library Book Search
 * @since 1.0.0
 */
function wp_lbs_uninstall() {
	// Uninstall functionality
}

// Plugin function file
require_once( WP_LBS_DIR . '/includes/lbs-function.php' );

// Post Type File
require_once( WP_LBS_DIR . '/includes/lbs-custom-post-type.php' );

// Script Class
require_once( WP_LBS_DIR . '/includes/class-wp-lbs-script.php' );

// Admin Class
require_once( WP_LBS_DIR . '/includes/admin/class-lbs-book-admin.php' );

// Shortcode file
require_once( WP_LBS_DIR . '/includes/shortcode/lbs-search-filter-shortcode.php' );

// Public Class
require_once( WP_LBS_DIR . '/includes/class-wp-lbs-public.php' );