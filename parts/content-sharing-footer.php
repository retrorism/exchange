<?php
/**
 * Sharing Footer Content Template
 * Author: Willem Prins | SOMTIJDS
 * Project: Tandem
 * Date created: 14/08/2016
 *
 * @package Exchange
 **/
// Exit if accessed directly.
?>
<div class="share-cta-wrapper">
	<h4 class="share-cta-header share-cta-social"><?php printf( __( 'Share this %s with friends ( or take it with you! )','exchange'), $exchange->type ); ?></h4>
	<?php $exchange->publish_sharing_buttons( 'footer' ); ?>
	<br />
	<?php if ( 'story' === $exchange->type ) : ?>
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
		</div>
	<?php endif; ?>
</div>
