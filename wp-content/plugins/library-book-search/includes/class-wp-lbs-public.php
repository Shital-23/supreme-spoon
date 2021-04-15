<?php
/**
 * Script Class 
 *
 * Handles the script and style functionality of plugin
 *
 * @package Library Book Search
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Wp_Lbs_Public{ 

	function __construct() {

		// Ajax call to update attachment data
		add_action( 'wp_ajax_wp_lbs_search_results', array($this, 'wp_lbs_search_results') );
		add_action( 'wp_ajax_nopriv_wp_lbs_search_results', array( $this, 'wp_lbs_search_results') );
		
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package Library Book Search
	 * @since 1.0.0
	 */
	function wp_lbs_search_results() {

		global $post;

		// Taking passed data
		$params = array();
		parse_str($_POST['form_data'], $form_data);
		
		// Taking some defaults		
		$result 			= array();
		$result['success'] 	= 0;
		$result['data'] 	= __('Sorry, no data found.', '');

		if( ! empty( $form_data ) ) {
				
			$i = 1;
			$prefix = WP_LBS_META_PREFIX; // Metabox prefix

			$args = array(
				'post_type' => 'book',
				'posts_per_page' => $form_data['limit'],
				'order' => 'DESC',
				'orderby' => 'date',
			);

			if( ! empty( $form_data['book_name'] ) ) {
				$args['meta_query'][] = array(
											'key' => $prefix.'book_name',
											'value' => $form_data['book_name'],
											'compare' => 'LIKE',
										);
			}

			if( ! empty( $form_data['author'] ) ) {
				$args['meta_query'][] = array(
											'key' => $prefix.'author',
											'value' => $form_data['author'],
											'compare' => 'LIKE',
										);
			}

			if( ! empty( $form_data['publisher'] ) ) {
				$args['meta_query'][] = array(
											'key' => $prefix.'publisher',
											'value' => $form_data['publisher'],
											'compare' => 'LIKE',
										);
			}

			if( ! empty( $form_data['rating'] ) ) {
				$args['meta_query'][] = array(
											'key' => $prefix.'rating',
											'value' => $form_data['rating'],
											'compare' => 'LIKE',
										);
			}

			$query = new WP_Query( $args );

			ob_start();

			if ( $query->have_posts() ) { ?>
		
			<table>
				<thead>
					<th>No</th>
					<th>Book Name</th>
					<th>Price</th>
					<th>Author</th>
					<th>Publisher</th>
					<th>Rating</th>
				</thead>
				<tbody>			
					<?php
						while ( $query->have_posts() ) : $query->the_post(); 

							$book_name 	= get_post_meta( $post->ID, $prefix.'book_name', true );
							$author 	= get_post_meta( $post->ID, $prefix.'author', true );
							$author 	= get_term_by('id', $author, 'author');
							$rating 	= get_post_meta( $post->ID, $prefix.'rating', true );
							$publisher 	= get_post_meta( $post->ID, $prefix.'publisher', true );
							$publisher 	= get_term_by('id', $publisher, 'publisher');
							$price 	= get_post_meta( $post->ID, $prefix.'price', true );
							?>
							<tr>
								<td><?php echo $i; ?></td>
								<td><?php echo $book_name; ?></td>
								<td>$<?php echo $price; ?></td>
								<td><?php echo $author->name; ?></td>
								<td><?php echo $publisher->name; ?></td>
								<td><?php echo $rating; ?></td>
							</tr>

							<?php
							$i++;
						endwhile;
					?>
				</tbody>
			</table>
			<?php }	
			$data = ob_get_clean(); 

			//print_r($data);
			$result['success'] 	= 1;
			$result['data'] 	= $data;
		}

		wp_send_json($result);
		
	}

}
$wp_lbs_public = new Wp_Lbs_Public();

