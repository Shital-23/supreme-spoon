<?php
/**
 * Shortcode File
 *
 * Handles the 'lbs_search_filter' shortcode of plugin
 *
 * @package Library Book Search
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * 'lbs_search_filter' shortcode
 * 
 * @package Library Book Search
 * @since 1.0.0
 */

function wp_lbs_search_filter( $atts, $content = null ) {

	// Taking some globals
	global $post;

	$atts = shortcode_atts(array(
		'limit' 		=> 15,
		'serach_btn' 	=> _e('Search', ''),
		), $atts, 'lbs_search_filter');

	$atts['limit'] 				= wp_lbs_clean_number( $atts['limit'], 5, 'number' );
	$atts['serach_btn'] 		= isset($atts['serach_btn']) ? $atts['serach_btn'] : _e('Search', '');
	extract( $atts );

	wp_enqueue_script('wp-lbs-public-js');

	ob_start();
	?>
	<div class="search-container-wrap">
		<?php

			require_once( WP_LBS_DIR .'/templates/search-form.php');
			
			require_once( WP_LBS_DIR .'/templates/search-result.php');
		?>
	</div>
	<?php
	$content .= ob_get_clean();
	return $content;
}

// Search Shortcode
add_shortcode( 'lbs_search_filter', 'wp_lbs_search_filter' );