<div class="story__modal--gallery full reveal" role="dialog" id="story__modal--gallery" aria-describedby="description" data-reveal>

	<button class="modal__button--close" data-close aria-label="Close reveal" type="button">

		<?php $close_button = get_stylesheet_directory() . '/assets/images/svg/T_cross_WEB.svg'; ?>

		<?php echo $close_button ? exchange_build_svg( $close_button, true ) : 'X'; ?>

	</button>

	<div class="orbit" data-use-m-u-i="false" role="region" aria-label="<?php printf( esc_html__('Gallery for "%s"', 'exchange' ), get_the_title() ); ?>" data-orbit data-auto-play="false">

		<?php $exchange->publish_gallery( 'gallery' ); ?>

	</div>

</div>
