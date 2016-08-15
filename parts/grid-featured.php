<div class="griditem__content griditem__content--<?php echo $exchange->type; ?>">

	<!-- IMAGE -->
	<?php echo exchange_create_link( $exchange, false ); ?>
		<?php $exchange->publish_featured_image('griditem'); ?>
	</a>

	<!-- META -->
	<?php /* <div class='griditem__meta'><?php echo mysql2date( get_option('date_format'), $exchange->date ) ?></div> */ ?>

	<!-- TAGS -->
	<?php if ( $exchange->has_tags ) : ?>
		<div class='griditem__tags'><?php $exchange->publish_tags('griditem'); ?></div>
	<?php endif; ?>

	<!-- TITLE -->
	<?php echo exchange_create_link( $exchange, false ); ?>
		<h4 class="griditem__title"><?php echo $exchange->title; ?></h4>
	</a>

	<!-- INTRO / EXCERPT -->
	<?php if ( ! empty( $exchange->has_editorial_intro ) ) : ?>
		<div class='griditem__intro-wrapper'>
			<?php $exchange->editorial_intro->publish_stripped( 'griditem', 100 ); ?>
		</div>
	<?php endif; ?>

	<!-- READMORE -->
	<div class='griditem__button-wrapper'>
		<?php echo exchange_create_link( $exchange, true, 'griditem__button button--small' ); ?>
	</div>

</div>
