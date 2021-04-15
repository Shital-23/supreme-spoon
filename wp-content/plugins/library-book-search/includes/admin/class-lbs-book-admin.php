<?php
/** 
 * Admin Class
 *
 * Handles the admin side functionality of plugin
 *
 * @package Library Book Search
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wp_Lbs_Admin {

function __construct() {

	// Action to add metabox
	add_action( 'add_meta_boxes', array( $this, 'wp_lbs_metabox' ) );

	// Action to save metabox
	add_action( 'save_post_'.WP_LBS_POST_TYPE, array( $this, 'wp_lbs_save_metabox_value' ) );
}

/**
	 * Book details settings metabox
	 * 
	 * @package Library Book Search
	 * @since 1.0.0
	 */
	function wp_lbs_metabox() {
		add_meta_box( 'wp-lbs-book-details', __( 'Book Details', 'library-book-search' ), array($this, 'wp_lbs_render_book_details') , WP_LBS_POST_TYPE, 'normal', 'high' );
	}

	/**
	 * Book settings metabox HTML
	 * 
	 * @package Library Book Search
	 * @since 1.0.0
	 */
	function wp_lbs_render_book_details() {
		include_once( WP_LBS_DIR .'/includes/admin/metabox/wp-lbs-book-details-metabox.php');
	}

	/**
	 * Function to save metabox values
	 * 
	 * @package Library Book Search
	 * @since 1.0.0
	 */
	function wp_lbs_save_metabox_value( $post_id ) {

		global $post_type;

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )					// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )	// Check Revision
		|| ( $post_type !=  WP_LBS_POST_TYPE ) )								// Check if current post type is supported.
		{
		return $post_id;
		}

		$prefix = WP_LBS_META_PREFIX; // Taking metabox prefix

		//print_r(expression)
		// Taking variables
		$book_name 	= isset( $_POST[$prefix.'book_name'] ) 	? wp_lbs_clean( $_POST[$prefix.'book_name'] ) 	: '';	
		$author 	= isset( $_POST[$prefix.'author'] ) 	? wp_lbs_clean_number( $_POST[$prefix.'author'] ) 	: '';
		$publisher 	= isset( $_POST[$prefix.'publisher'] ) 	? wp_lbs_clean_number( $_POST[$prefix.'publisher'] ) 	: '';
		$rating 	= isset( $_POST[$prefix.'rating'] ) 	? wp_lbs_clean_number( $_POST[$prefix.'rating'] ) 	: '';			
		$price 	= isset( $_POST[$prefix.'price'] ) 	? wp_lbs_clean_number( $_POST[$prefix.'price'] ) 	: '';			

		// Updating meta
		update_post_meta( $post_id, $prefix.'book_name', $book_name );
		update_post_meta( $post_id, $prefix.'author', $author );
		update_post_meta( $post_id, $prefix.'publisher', $publisher );
		update_post_meta( $post_id, $prefix.'rating', $rating );
		update_post_meta( $post_id, $prefix.'price', $price );
	}

}

$wp_lbs_admin = new Wp_Lbs_Admin();