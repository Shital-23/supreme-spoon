<?php
/**
 * Handles team member details metabox HTML
 *
 * @package Library Book Search
 * @since 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $post;

$prefix = WP_LBS_META_PREFIX; // Metabox prefix

$book_name 	= get_post_meta( $post->ID, $prefix.'book_name', true );
$author 	= get_post_meta( $post->ID, $prefix.'author', true );
$author_list = get_terms(WP_LBS_CAT, array('hide_empty' => false,));
$rating 	= get_post_meta( $post->ID, $prefix.'rating', true );
$publisher 	= get_post_meta( $post->ID, $prefix.'publisher', true );
$price 	= get_post_meta( $post->ID, $prefix.'price', true );
$publisher_list = get_terms(WP_LBS_PUBLISHER_CAT, array('hide_empty' => false,));

?>


	<div id="wp-lbs-mdetails" class="wp-lbs-mdetails wp-lbs-tab-cnt" style="display:block;">
		<table class="form-table wp-lbs-team-detail-tbl">
			<tbody>

				<tr valign="top">
					<th scope="row">
						<label for="wp-lbs-mdepartment"><?php _e('Book Name', 'library-book-search'); ?></label>
					</th>
					<td>
						<input type="text" value="<?php echo wp_lbs_esc_attr($book_name); ?>" class="large-text wp-lbs-mdepartment" id="wp-lbs-mdepartment" name="<?php echo $prefix;?>book_name" /><br/>
						<span class="description"><?php _e('Enter team member department.', 'library-book-search'); ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="wp-lbs-mdepartment"><?php _e('Author', 'library-book-search'); ?></label>
					</th>
					<td>
						<select name="<?php echo $prefix; ?>author" class="wp-lbs-author" id="wp-lbs-author">
							<option value=""><?php _e('Select Author',''); ?></option>
							<?php 
							foreach ($author_list as $akey => $avalue) { ?>
								<option value="<?php echo $avalue->term_id; ?>" <?php selected($author, $avalue->term_id); ?>><?php echo $avalue->name;?></option>
								
							<?php }
							?>
						</select>
						<br/>
						<span class="description"><?php _e('Select author', 'library-book-search'); ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="wp-lbs-mdepartment"><?php _e('Publisher', 'library-book-search'); ?></label>
					</th>
					<td>
						<select name="<?php echo $prefix; ?>publisher" class="wp-lbs-publisher" id="wp-lbs-publisher">
							<option value=""><?php _e('Select Publisher',''); ?></option>
							<?php 
							foreach ($publisher_list as $pkey => $pvalue) { ?>
								<option value="<?php echo $pvalue->term_id; ?>" <?php selected($publisher, $pvalue->term_id); ?>><?php echo $pvalue->name;?></option>
								
							<?php }
							?>
						</select>
						<br/>
						<span class="description"><?php _e('Select publisher', 'library-book-search'); ?></span>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="wp-lbs-mdepartment"><?php _e('Rating', 'library-book-search'); ?></label>
					</th>
					<td>
						<select name="<?php echo $prefix; ?>rating" class="wp-lbs-rating" id="wp-lbs-rating">
							<option value=""><?php _e('None',''); ?></option>
							<?php for($i=1; $i<=5; $i++) { ?>
								<option value="<?php echo $i; ?>" <?php selected($rating, $i); ?>><?php echo $i; ?></option>
							<?php } ?>
						</select>
						<br/>
						<span class="description"><?php _e('Select Rating', 'library-book-search'); ?></span>
					</td>
				</tr>

				<tr valign="top">
					<th scope="row">
						<label for="wp-lbs-mdepartment"><?php _e('Price', 'library-book-search'); ?></label>
					</th>
					<td>
						<span id="slider_value" style="color:red;"></span>
						<span>0</span><input type="range" value="<?php echo wp_lbs_esc_attr($price); ?>" class="large-text wp-lbs-price" id="wp-lbs-price" name="<?php echo $prefix;?>price" min="1" max="10000" onchange="show_value(this.value);" /><span>10000</span><br/>
						<script type="text/javascript">	
							function show_value(x)
							{
							 document.getElementById("slider_value").innerHTML=x;
							}
						</script>
						<span class="description"><?php _e('Select price.', 'library-book-search'); ?></span>
					</td>
				</tr>
			</tbody>
		</table><!-- end .wp-lbs-team-detail-tbl -->
	</div><!-- end .wp-lbs-mdetails -->

