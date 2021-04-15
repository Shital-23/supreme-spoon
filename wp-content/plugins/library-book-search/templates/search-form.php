<?php 
$author_list = get_terms(WP_LBS_CAT, array('hide_empty' => false,));
$publisher_list = get_terms(WP_LBS_PUBLISHER_CAT, array('hide_empty' => false,));
?>
<div class="search-form-wrap">
	<h1>Book Search</h1>

	<form name="search_form" action="" method="post" id="lbs_search_form">

		Book Name: <input type="text" name="book_name" value="<?php echo $book_name;?>">

		<p>
		Author : 

		  <select name="author" class="wp-lbs-author" id="wp-lbs-author">
			<option value=""><?php _e('Select Author',''); ?></option>
			<?php 
			foreach ($author_list as $akey => $avalue) { ?>
				<option value="<?php echo $avalue->term_id; ?>" <?php selected($author, $avalue->term_id); ?>><?php echo $avalue->name;?></option>
				
			<?php }
			?>
		</select>
		</p>
		<p>

		Publisher
		<select name="publisher" class="wp-lbs-publisher" id="wp-lbs-publisher">
									<option value=""><?php _e('Select Publisher',''); ?></option>
									<?php 
									foreach ($publisher_list as $pkey => $pvalue) { ?>
										<option value="<?php echo $pvalue->term_id; ?>" <?php selected($publisher, $pvalue->term_id); ?>><?php echo $pvalue->name;?></option>
										
									<?php }
									?>
								</select>

		<p>
		Rating
		<select name="rating" class="wp-lbs-rating" id="wp-lbs-rating">
									<option value=""><?php _e('None',''); ?></option>
									<?php for($i=1; $i<=5; $i++) { ?>
										<option value="<?php echo $i; ?>" <?php selected($rating, $i); ?>><?php echo $i; ?></option>
									<?php } ?>
								</select>
		</p>
		<p>
		Price
		<input type="text" name="min_price" value="">
		<input type="text" name="max_price" value="">
		<input type="hidden" name="limit" value="<?php echo $limit; ?>">
		</p>
		<input type="button" name="search" value="Search" class="wp-lbs-search-btn">
	</form>
</div>