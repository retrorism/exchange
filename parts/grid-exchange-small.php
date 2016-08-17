<div data-equalizer-watch class="griditem__content griditem__content--<?php echo $exchange->type; ?>">

	<?php $link = exchange_create_link( $exchange, false ); echo $exchange_link; ?>
	<!-- IMAGE -->
		<?php $exchange->publish_featured_image('griditem'); ?>
	</a>

	<?php echo $exchange_link ); ?>
	<!-- TITLE -->
		<h4 class="griditem__title"><?php echo $exchange->title; ?></h4>
	</a>

</div>
