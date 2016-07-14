<div class="collaboration__participants__item">
	<div class="collaboration__participant__details">
		<h2 class="participant__name">
			<?php echo esc_html( $p_obj->name ); ?>
		</h2>

		<?php if ( ! empty( $p_obj->org_name ) ) : ?>
			<?php if ( ! empty( $p_obj->org_website ) ) : ?>
				<p class="participant__organisation__name">
					<a href="<?php echo esc_url( $p_obj->org_website ); ?>" target="_blank">
						<?php echo esc_html( $p_obj->org_name ); ?>
					</a>
				</p>
			<?php else : ?>
				<p class="participant__organisation__name">
					<?php echo esc_html( $p_obj->org_name ); ?>
				</p>
			<?php endif; ?>
		<p class="participant__organisation__city">
			<?php echo esc_html( $p_obj->org_city );
				if ( ! empty( $p_obj->org_country ) ) {
					echo ', ' . esc_html( $p_obj->org_country );
				}
			?>
		</p>

		<?php endif; ?>

		<?php if ( ! empty( $p_obj->org_description ) ) : ?>
			<?php $p_obj->publish_org_description(); ?>
		<?php endif; ?>
		<?php if ( $p_obj->has_contactme ) : ?>
			<p class="participant__contactme">
				<?php $p_obj->publish_contactme(); ?>
			</p>
		<?php endif; ?>
	</div>
</div>
