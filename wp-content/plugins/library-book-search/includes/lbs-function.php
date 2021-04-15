<?php
/**
 * Plugin generic functions file 
 *
 * @package Library Book Search
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package Library Book Search
 * @since 1.0.0
 */
function wp_lbs_esc_attr( $data ) {
	return esc_attr( stripslashes( $data ) );
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * 
 * @package Library Book Search
 * @since 1.0.0
 */
function wp_lbs_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'wp_lbs_clean', $var );
	} else {
		$data = is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		return wp_unslash( $data );
	}
}

/**
 * Sanitize number value and return fallback value if it is blank
 * 
 * @package Library Book Search
 * @since 1.0.0
 */
function wp_lbs_clean_number( $var, $fallback = null, $type = 'int' ) {

	if ( $type == 'number' ) {
		$data = intval( $var );		
	} else {
		$data = absint( $var );
	}

	return ( empty( $data ) && isset( $fallback ) ) ? $fallback : $data;
}
