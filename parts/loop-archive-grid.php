<?php
// Adjust the amount of rows in the grid
$grid_columns = 3; ?>

<?php
	//var_dump( $wp_query->current_post );
	if( 0 === ( $wp_query->current_post  ) % $grid_columns ): ?>

    <div class="archive__grid" data-equalizer> <!--Begin Row:-->

<?php endif; ?>

		<!--Item: -->
		<?php
			$grid_item = BaseGrid::create_grid_item_from_post( $post, 'archive__grid' );
			$grid_item->publish();
		?>


<?php if( 0 === ( $wp_query->current_post + 1 )  % $grid_columns ||  ( $wp_query->current_post + 1 ) ===  $wp_query->post_count ): ?>

   </div>  <!--End Row: -->

<?php endif; ?>
