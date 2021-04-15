<?php 

$args = array(
	'post_type' => 'book',
	'posts_per_page' => $limit,
	'order' => 'DESC',
	'orderby' => 'date',
);

$query = new WP_Query( $args );

$i = 1;
$prefix = WP_LBS_META_PREFIX; // Metabox prefix
?>
<div class="search-result-wrap">

	<?php if ( $query->have_posts() ) { ?>
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
	<?php } else{ echo "No data found"; } ?>
</div>