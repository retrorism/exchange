<div data-equalizer-watch class="griditem__content griditem__content--<?php echo $exchange->type; ?>">

	<?php $exchange_link = exchange_create_link( $exchange, false ); echo $exchange_link; ?>
	<!-- IMAGE -->
		<?php $exchange->publish_featured_image('griditem'); ?>
	</a>

	<?php if ( $exchange->has_tags ) : ?>
	<!-- TAGS -->
		<div class='griditem__tags'><?php $exchange->publish_tags('griditem'); ?></div>
	<?php endif; ?>

	<?php echo $exchange_link; ?>
	<!-- TITLE -->
		<h4 class="griditem__title"><?php echo $exchange->title; ?></h4>
	</a>

	<?php if ( ! empty( $exchange->has_participants ) ) : ?>
	<!-- COLLABORATIONS -->
		<div class='griditem__collaboration-info'>
			<div class="ampersand-wrapper">
			<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 377.7 464.5"><path class="ampersand" d="M164 339l-5.3 3.3-.3 1.6c-5.3 1.5-8.4 4-9.6 8l-10.3 5.2-11.3 5.6H106c-1.2-.5-2-1.3-3.2-1.6l-1.3-1.3-3-2.8L96 356l-3-3.6-3-2.7c-.7-.2-1.5-2-2-3.3-.4-1.7-1.2-3.6-2.3-5.3-.4-3 .3-5 1.4-8 1.4-3 3-7 2.7-12.5 2.7-3 4.8-7 5.8-12 1.3-1 2.2-2 3-3l1.4-1.4 6-7.6c-.3-2.4.3-3 3.7-5.3 2.2-1.8 4.8-4 7-7 1.8 2.8 4 4 5.7 5.5l2 1.6v1.4c1.5 3.2 2.8 6 4 8 1.5 2 2.3 3.7 2.8 5.3l1.6 4 4 1c1.3 0 2 1 4 3.6 2.3 3 5.7 7.7 12.5 9.3 2.7 4.5 7.4 6.7 10.7 8.5 2 1.5 3.6 2 4 2.8 0 1.6-.7 2-4.4 4.3m-71-266l2-1.4c1.7-1.3 3.8-2.4 8-2.4 1 0 2.2 0 4 .3 3.4 0 6 1.3 9 2.6 3 1.5 6 2.8 10 3.5 1 1.3 2.3 2.4 3 3.2l1.4 1 3.6 5.5c.5 1 1.3 2.7 3 4.3v17.8c-.3 1-1 1.8-1.8 3-1.7 2.8-4.4 6.5-4.7 12.5-1.2 3-2.3 6-3 8.8-.5 2-1.3 4.5-2 5.6-1.7 2.3-2.6 4.8-3.5 7-.4 1-.8 2.5-1.4 3v-.4c-.4-2.3-1.5-6.4-4.4-9.3-.8-6-5-8.8-7-10.3l-.5-.3-4.5-9-.3-1.5c-.7-2.2-1.7-6.6-5.3-9.6-.8-4.7-3-7.8-4.7-10-1-1.3-1.6-2-2-3V72.7h1.4zM371 240h-.5l-6.2-9.5c-.4-.2-1.4-2-1.6-3.3-.8-2.3-2-4.8-3.6-7.2l-1.3-2-2.2-.7c-4-1.3-7.5-3.7-11.2-6.4-6.7-5-14.7-10.3-27.4-10.7l-3.8-.3c-7.2 0-10.4 5-11.7 7l-6.4 6.7-2 1.8c-2 1.3-5 3.6-6.6 7.2-1.7.8-3.2 1.7-4.5 2.6-2 1-3.7 2-5.5 2.7l-2.2.7-1.4 1.8c-2 2.3-3 4.8-3.8 7-.4 1.4-1 3.2-1.3 3.4L265 243l-3.5 2.7c-1 2.5-2.6 4.4-5.7 5.5l-2.3 1-2.4 4c-2.6 4.6-2.6 4.7-5.3 4.7l-4 1.3-2.7 2.2c-5.6 8.2-9.7 13.3-20.4 13.3-3.8 0-5-1.6-8.3-6.4l-2.7-4-1.3-2-2.7-.5c-1.3-.5-2.7-1.8-4.7-4.2-1.8-2.4-4.5-5.6-8.5-7.7-2-4-5.3-6.6-7.7-8.3-2.3-2-3.7-3-4.3-4.8-1.4-4-3.4-7.5-5.4-10.4-2-3.6-3.7-6.7-4.4-10.7v-.6l.5-.5c2.2-2 3-4 3-6.5l1-.8 1-1.6 1.6-1.3c3-2.2 3.3-5.6 3.2-8 4.7-4 6.7-9.3 8.4-13.8 1-2.5 2-5 3-6.4l.7-1.3c1.6-3.4 3-7 4.3-10.7 1.3-4.5 3-8.8 5.3-12l.7-2c.8-2.5 2.2-4.7 3.6-7.2 2.7-4.3 6-10 6.7-18.7l-.4-46.6-1-4.5c-3-8-6-15.3-5.8-25.6v-5l-4.5-2c-1.8-1-2.3-5-2.7-7.2l-.3-5.3-3-.8c0-4.7-2.3-7.5-3.5-8.4L190 19l-3-1.7c-5-3-11-4-16.7-5.3l-7.2-1.6c-6.3-4.4-14.6-9-27-10.4L85 .4h-3.7C78.7.4 73 .4 69 3.7L49 7.7c-1.7.6-4 1.4-6.3 2.7-2 0-4 0-5.6.7-1.4.6-2.7 1.4-3.7 2.7l-2.6.3-1.8 1.3c-3 1.6-4 4.7-5 7.4-2 .6-5.3 1.7-7.3 5l-1 1.2-.4 2c-.5 6.2-1.7 12-2.6 18C11 57 9.3 65.2 9 75v2.5c6.2 29 12.3 54.6 24.5 75 1 3.4 2.6 5.8 4 7.8 2 2.6 2.6 3.6 2.4 5.7l4.8 7.7.4 1.4c.5 2.5 1.7 6.7 5 9.8 1 4.5 3 7.6 4.7 10 1.3 1.5 2 2.5 2.2 3.6L60 202l2 2.3c.5 1 1.3 2.6 2.7 3.7.8 1.7 1.8 3 2.6 3.6-.2.4-1.7 1-2.6 1.6l-2 3.2-2.3 4c.3 2 0 2-1.3 2.7l-5.3 7.8c-2 1-3.6 2.3-4.6 3.6-2.3 1.3-4 3-5 4l-1.3 1.3-2.7 2.7-2.7 4c-.6 5.3-3 9-5.6 13.6-2.6 4.5-5.6 9.3-7 16-1.8 1.6-3 3.7-4 6.7-2 1.6-3.4 3.4-4.4 5.3-5 2.7-6.4 8.4-7 11.2l-.5 1.3.4 3-5.3 4.8c.3 6.4-.7 11.6-1.7 17.3C.7 332.4-1 340.8.7 352l.5 2c4.4 10.8 7.6 20 9.7 29l.7 3.5 3 1.6c4.5 2.3 8 6 11.6 10C32 404.6 39 412 50.7 415c3 3.5 7.3 5 10.6 6 1 .4 3 1 3.2 1.3l9 6.8c.5 0 .8 0 2 .7 1.2.6 2.8 1.3 5 2 1.6 1.7 4 3.2 8 3.8l3.4 2.3 26.7 2H134l16.4-1.5 2.7-.3c1.4 1 2.7 0 5 .6l9.3-4.8c1.4-.6 2.7-1.4 4-3 3-1.4 4.8-3.3 6-4.6l.6-1c5-1 8-4 10-7 4.4-1 8-3.7 10.5-8 3-1.3 5-4 6.3-6 1.3-.7 3-1.5 4-3.3 2.7-.8 4.3-1.8 5.6-3 4-.8 7.5-3 10-6.6 2.3-.3 4-1.3 5.3-2 2.3 1.7 4.7 2.6 6.3 3 .8 4 2.7 10 8 13.7 2.7 4.8 6.3 8 9.3 10.7 3 2.3 5.4 4.3 6.4 6.7l1.6 4 2.7.6v.7c.8 2.2 1.7 5.3 4.4 7.7l1 1 1.4.5c3 1.3 4.7 3 6 5.7l3 3.5 2.7 1.3c.7 2.7 2.4 7 6.7 9 3.6 4.5 9.6 7 17.7 7.5h17l14.7-6.6 1.7-2c2-1.2 5.7-4 7.5-8.4l1.7-2.4 2-3.5c2.2-9.7.8-25.3-5.4-34.6-1.4-2.3-3-4-4.6-5.3-.5-4.2-3.4-8.5-11.2-10.6h-.4c-1.7-4-4.8-6-6.8-7.5l-2-2-6-6.7c-.8-2-2-5.7-5.5-8-.5-1.3-1.3-2.4-2-3.2l-1.4-5H303c-.5-1-1-2-2-3-.3-4-2-6.7-3.3-8l-.6-1.3.3-1.6-5.3-9.8c-3-1.7-4-2.5-4.4-3.4 4-6 8.7-10.7 14.4-14.7 4.8 0 8-2.3 9.7-3.7l1.4-.8s.6 0 1.4.4l10-6c2.3-.7 6.3-2.2 8.4-6 1.6-.7 3-1.5 4.4-2.6l5.3-2.7 4.7-1.6v-2.5c5.3-1.6 8.7-4.4 10-8.3l1.2-.7c8-4 19.6-10 19-27 1.7-9.4-4.2-13.4-6.6-15.2" fill="#fccb06"/><image src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/png/T_ampersand_WEB.png"></image></svg>
			</div>
			<ul class="participants">
			<?php foreach( $exchange->participants as $p ) : ?>
				<li class="participant">
					<?php $org_name = isset( $p->org_short_name ) ? $p->org_short_name : $p->org_name; ?>
					<?php echo '<span class="participant__name">' . $p->name . '</span>
					<span class="participant__organisation-details">' . $org_name . '</span>'; ?>
				</li>
			<?php endforeach; ?>
			</ul>
		</div>
	<?php endif; ?>

	<!-- READMORE -->
	<div class='griditem__button-wrapper'>
		<?php echo exchange_create_link( $exchange, true, 'griditem__button button--small' ); ?>
	</div>

</div>
