<?php
	if ( ! is_post_type_archive('story') || empty( $featured_posts ) || ! in_array( $post->ID, $featured_posts ) ) {
		$grid_item = BaseGrid::create_grid_item_from_post( $post, 'archive__grid' );
		$grid_item->publish();
	}
?>
