<?php
/**
 * Script Class 
 *
 * Handles the script and style functionality of plugin
 *
 * @package 
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wp_Lbs_Script{ 

	function __construct() {
		// Action to add style at front side
		add_action( 'admin_enqueue_scripts', array( $this, 'wp_lbs_admin_script_style' ) );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array( $this, 'wp_lbs_front_script' ) );
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package Library Book Search
	 * @since 1.0.0
	 */
	function wp_lbs_admin_script_style() {
		// Registring post order script
		wp_register_script( 'wp-lbs-range', WP_LBS_URL . 'assets/js/wp-lbs-admin.js', array(), WP_LBS_VERSION, true );
		wp_enqueue_script('wp-lbs-range');
	}

	/**
	 * Function to add script at public side
	 * 
	 * @package Library Book Search
	 * @since 1.0.0
	 */
	function wp_lbs_front_script() {
		// Registring and enqueing public script
		wp_register_script( 'wp-lbs-public-js', WP_LBS_URL."assets/js/wp-lbs-public.js", array('jquery'), WP_LBS_VERSION, true );
		wp_localize_script( 'wp-lbs-public-js', 'WpLbs', array(
															'ajaxurl' 			=> admin_url( 'admin-ajax.php', ( is_ssl() ? 'https' : 'http' ) ),
														) );
	}

}
$wp_lbs_script = new Wp_Lbs_Script();

