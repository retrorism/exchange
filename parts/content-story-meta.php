<div class="story__meta-wrapper">

	<aside class="article-meta story__meta">

		<div class="story__meta-inner">

			<div class="story__meta-bg post-it-bg"></div>

			<?php if ( ! empty( $exchange->category ) ) : ?>

				<section class="story__meta__item story__meta__item--category">

					<?php echo esc_html( $exchange->category->name ); ?>

				</section>

			<?php endif; ?>

			<?php if ( ! empty( $exchange->storyteller ) ) : ?>

				<section class="story__meta__item story__meta__item--storyteller">

					<?php echo esc_html( sprintf( __("Shared by: %s", 'exchange' ), $exchange->storyteller->title ) ); ?>

				</section>

			<?php endif; ?>

			<section class="story__meta__item story__meta__item--date">

				<?php echo esc_html( mysql2date('F jS, Y', $exchange->date ) ); ?>

			</section>

			<?php if ( $exchange->has_tags ) : ?>

				<section class="story__meta__item story__meta__item--tags">

					<?php $exchange->publish_tags('story__meta'); ?>

				</section>

			<?php endif; ?>

			<section class="story__meta__item story__meta__item--sharing-buttons">

				<?php /* <small class="story_sharing-buttons__header"><?php _e( 'Share or print this story', EXCHANGE_PLUGIN ); ?></small> */ ?>

				<?php $exchange->publish_sharing_buttons(); ?>

			</section>

		</div>

	</aside>

</div>
