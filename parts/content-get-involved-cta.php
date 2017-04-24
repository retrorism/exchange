<?php 
	
	$args = array(
		'title' => 'Get involved!',
		'post_type' => 'page',
	);
	$get_involved_page = get_posts( $args );
	if ( ! empty( $get_involved_page[0] ) ) : ?>
	
	<h4 class="share-cta-header share-cta-story"><?php _e( 'Interested in joining the Tandem network?','exchange' ); ?></h4>
	<div class="button-wrapper">
		<a class="button button--large button--share-cta" href="<?php echo get_permalink( $get_involved_page[0]->ID ); ?>" ><?php _e( 'Get involved!', 'exchange' ); ?></a>
	</div><!-- button-wrapper -->
<?php endif; ?>