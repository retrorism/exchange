<h2><?php echo $exchange->title; ?></h2>

	<?php if ( $exchange->has_tags ) : ?>

		<div class='tags'><?php $exchange->publish_tags('grid'); ?></div>

	<?php endif; ?>

	<?php $exchange->publish_featured_image(); ?>

	<?php if ( ! empty( $exchange->has_editorial_intro ) ) {
			$exchange->editorial_intro->publish_stripped();
		} ?>
