<h4 class="share-cta-header share-cta-story"><?php _e( 'Do you have a Tandem story you would like to share?','exchange' ); ?></h4>

<div class="button-wrapper">
<?php
	$story_form_page = get_option( 'options_story_update_form_page' );
	if ( ! empty( $story_form_page ) ) {
		$exchange_form = BaseController::exchange_factory( $story_form_page );
		if ( $exchange_form instanceof Exchange ) {
			echo exchange_create_link( $exchange_form, false, 'button--large button--share-cta' ) . __('Share your story','exchange') . '</a>';
		}
	}
	?>
</div><!-- button-wrapper -->
