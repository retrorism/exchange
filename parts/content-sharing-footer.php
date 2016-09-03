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
<section class="story__footer__section footer__section">

	<div class="section-inner">

		<div class="share-cta-wrapper">

			<h4 class="share-cta-header share-cta-social"><?php printf( __( 'Share this %s with friends ( or take it with you! )','exchange'), $exchange->type ); ?></h4>

			<?php $exchange->publish_sharing_buttons( 'footer' ); ?>

			<br />

			<?php if ( 'story' === $exchange->type ) : ?>

			<?php get_template_part( 'parts/content','story-share-cta' ); ?>

			<?php endif; ?>

		</div class="share-cta-wrapper">

	</div><!-- end section-inner -->

</section>
