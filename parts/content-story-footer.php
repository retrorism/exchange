<footer class="article-footer story__footer">

	<?php if ( is_singular('story') && ! empty( $exchange->byline ) ) : ?>

		<section class="article-byline story__footer__section footer__section section--byline">

			<div class="section-inner">

		<?php $exchange->publish_byline( 'story__footer' ); ?>

			</div><!-- section-inner-->

		</section>

	<?php endif; ?>

	<?php include_once( get_stylesheet_directory() . '/parts/content-sharing-footer.php' ); ?>

	<?php if ( $exchange->has_related_content ) : ?>

	<section class="article-related-content story__footer__section footer__section section--salmon-1-web section--coloured">

		<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex( 'salmon-1-web' ) ); ?>

		<div class="section-inner">

		<?php $exchange->publish_related_content( $exchange->type . '__footer'); ?>

		</div><!-- section-inner-->

		<?php echo BasePattern::build_edge_svg('bottom', exchange_slug_to_hex( 'salmon-1-web' ) ); ?>

	</section><!-- related-content -->

<?php endif; ?>

</footer> <!-- end article footer -->
