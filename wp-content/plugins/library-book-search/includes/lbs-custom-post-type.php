<?php
/**
 * Register Post type functionality
 *
 * @package Library Book Search
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Function to register post type
 * 
 * @package Library Book Search
 * @since 1.0.0
 */
function wp_lbs_register_post_type() {

	$wp_lbs_labels = apply_filters( 'wp_lbs_post_labels', array(
		'name' 					=> __( 'Book', 'library-book-search' ),
		'singular_name' 		=> __( 'Book', 'library-book-search' ),
		'add_new' 				=> __( 'Add New Book', 'library-book-search' ),
		'add_new_item' 			=> __( 'Add New Book', 'library-book-search' ),
		'all_items'				=> __( 'All Books', 'library-book-search' ),
		'edit_item' 			=> __( 'Edit Book', 'library-book-search' ),
		'new_item' 				=> __( 'New Book', 'library-book-search' ),
		'view_item' 			=> __( 'View Book', 'library-book-search' ),
		'search_items' 			=> __( 'Search Books','library-book-search' ),
		'not_found' 			=> __( 'No Book found', 'library-book-search' ),
		'not_found_in_trash' 	=> __( 'No Books found in Trash', 'library-book-search' ),
		'menu_name' 			=> __( 'Book', 'library-book-search' ),
		'featured_image'		=> __( 'Book Image', 'library-book-search' ),
		'set_featured_image'	=> __( 'Set Book Image', 'library-book-search' ),
		'remove_featured_image'	=> __( 'Remove Book Image', 'library-book-search' ),
		'use_featured_image'	=> __( 'Use as Book Image', 'library-book-search' ),
	) );

	$wp_lbs_args = array(
		'labels' 				=> $wp_lbs_labels,
		'public' 				=> true,
		'publicly_queryable' 	=> true,
		'exclude_from_search' 	=> false,
		'show_ui' 				=> true,
		'show_in_menu' 			=> true, 
		'query_var' 			=> true,
		'rewrite' 				=> array( 
										'slug' 			=> apply_filters( 'wp_lbs_post_slug', 'book' ),
										'with_front' 	=> false
									),
		'capability_type' 		=> 'post',
		'has_archive' 			=> false,
		'hierarchical' 			=> false,
		'menu_icon' 			=> 'dashicons-groups',
		'supports' 				=> apply_filters( 'wp_lbs_post_supports', array('title', 'editor', 'thumbnail', 'excerpt', 'page-attributes', 'publicize') )
	);

	// Register book post type
	register_post_type( WP_LBS_POST_TYPE, apply_filters( 'wp_lbs_registered_post', $wp_lbs_args ) );
}

// Action to register plugin post type
add_action('init', 'wp_lbs_register_post_type');

/**
 * Function to register taxonomy
 * 
 * @package Library Book Search
 * @since 1.0.0
 */
function wp_lbs_register_taxonomies() {

	$wp_lbs_cat_lbls = apply_filters('wp_lbs_cat_labels', array(
								'name' 				=> __( 'Author', 'library-book-search' ),
								'singular_name' 	=> __( 'Author', 'library-book-search' ),
								'search_items' 		=> __( 'Search Author', 'library-book-search' ),
								'all_items' 		=> __( 'All Authors', 'library-book-search' ),
								'parent_item' 		=> __( 'Parent Author', 'library-book-search' ),
								'parent_item_colon' => __( 'Parent Author', 'library-book-search' ),
								'edit_item' 		=> __( 'Edit Author', 'library-book-search' ),
								'update_item' 		=> __( 'Update Author', 'library-book-search' ),
								'add_new_item' 		=> __( 'Add New Author', 'library-book-search' ),
								'new_item_name' 	=> __( 'New Author Name', 'library-book-search' ),
								'menu_name' 		=> __( 'Author', 'library-book-search' ),
							));

	$wp_lbs_cat_args = array(
		'hierarchical' 		=> true,
		'labels' 			=> $wp_lbs_cat_lbls,
		'show_ui' 			=> true,
		'show_admin_column' => true,
		'query_var' 		=> true,
		'rewrite' 			=> array(
									'slug' 			=> apply_filters( 'wp_lbs_cat_slug', 'author' ),
									'with_front' 	=> false,
									'hierarchical' 	=> true,
									),
	);

	// Register author category
	register_taxonomy( WP_LBS_CAT, array( WP_LBS_POST_TYPE ), apply_filters( 'wp_lbs_registered_cat', $wp_lbs_cat_args ) );


	$wp_lbs_publisher_lbls = apply_filters('wp_lbs_publisher_lbls', array(
								'name' 				=> __( 'Publisher', 'library-book-search' ),
								'singular_name' 	=> __( 'Publisher', 'library-book-search' ),
								'search_items' 		=> __( 'Search Publisher', 'library-book-search' ),
								'all_items' 		=> __( 'All Publisher', 'library-book-search' ),
								'parent_item' 		=> __( 'Parent Publisher', 'library-book-search' ),
								'parent_item_colon' => __( 'Parent Publisher', 'library-book-search' ),
								'edit_item' 		=> __( 'Edit Publisher', 'library-book-search' ),
								'update_item' 		=> __( 'Update Publisher', 'library-book-search' ),
								'add_new_item' 		=> __( 'Add New Publisher', 'library-book-search' ),
								'new_item_name' 	=> __( 'New Publisher Name', 'library-book-search' ),
								'menu_name' 		=> __( 'Publisher', 'library-book-search' ),
							));

	$wp_lbs_publisher_args = array(
		'hierarchical' 		=> true,
		'labels' 			=> $wp_lbs_publisher_lbls,
		'show_ui' 			=> true,
		'show_admin_column' => true,
		'query_var' 		=> true,
		'rewrite' 			=> array(
									'slug' 			=> apply_filters( 'wp_lbs_publisher_slug', 'publisher' ),
									'with_front' 	=> false,
									'hierarchical' 	=> true,
									),
	);

	// Register team showcase category
	register_taxonomy( WP_LBS_PUBLISHER_CAT, array( WP_LBS_POST_TYPE ), apply_filters( 'wp_lbs_publisher_cat', $wp_lbs_publisher_args ) );
}

// Action to register plugin taxonomies
add_action( 'init', 'wp_lbs_register_taxonomies');

/**
 * Function to update post message for team showcase
 * 
 * @package Library Book Search
 * @since 1.0.0
 */
function wp_lbs_post_updated_messages( $messages ) {

	global $post, $post_ID;

	$messages[WP_LBS_POST_TYPE] = array(
		0 => '', // Unused. Messages start at index 1.
		1 => sprintf( __( 'Book updated. <a href="%s">View Book</a>', 'library-book-search' ), esc_url( get_permalink( $post_ID ) ) ),
		2 => __( 'Custom field updated.', 'library-book-search' ),
		3 => __( 'Custom field deleted.', 'library-book-search' ),
		4 => __( 'Book updated.', 'library-book-search' ),
		5 => isset( $_GET['revision'] ) ? sprintf( __( 'Book restored to revision from %s', 'library-book-search' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
		6 => sprintf( __( 'Book published. <a href="%s">View Book</a>', 'library-book-search' ), esc_url( get_permalink( $post_ID ) ) ),
		7 => __( 'Book saved.', 'library-book-search' ),
		8 => sprintf( __( 'Book submitted. <a target="_blank" href="%s">Preview Book</a>', 'library-book-search' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
		9 => sprintf( __( 'Book scheduled for: <strong>%1$s</strong>. <a target="_blank" href="%2$s">Preview Book</a>', 'library-book-search' ),
		  date_i18n( 'M j, Y @ G:i', strtotime($post->post_date) ), esc_url( get_permalink( $post_ID ) ) ),
		10 => sprintf( __( 'Book draft updated. <a target="_blank" href="%s">Preview Book</a>', 'library-book-search' ), esc_url( add_query_arg( 'preview', 'true', get_permalink( $post_ID ) ) ) ),
	);

	return $messages;
}

// Filter to update book post message
add_filter( 'post_updated_messages', 'wp_lbs_post_updated_messages' );