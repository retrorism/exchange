<div class="griditem__content">

	<!-- IMAGE -->
	<?php if ( $exchange->has_featured_image ) : ?>
		<?php echo exchange_create_link( $exchange, false ); ?>
			<?php $exchange->publish_featured_image('griditem'); ?>
		</a>
	<?php endif; ?>

	<!-- TITLE -->
	<?php echo exchange_create_link( $exchange, false ); ?>
		<h4 class="griditem__title"><?php echo $exchange->title; ?></h4>
	</a>

	<!-- TAGS -->
	<?php if ( $exchange->has_tags ) : ?>
		<div class='griditem__tags'><?php $exchange->publish_tags('griditem'); ?></div>
	<?php endif; ?>

	<!-- INTRO / EXCERPT -->
	<?php if ( ! empty( $exchange->has_editorial_intro ) ) :
		$exchange->editorial_intro->publish_stripped('griditem');
	endif; ?>

</div>
