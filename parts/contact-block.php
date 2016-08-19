<div class="contactblock__team-member">

	<!-- IMAGE -->

	<?php if ( ! empty( $user_image ) ) : ?>
			<?php $user_image->publish(); ?>
	<?php elseif ( ! empty ( $user_avatar ) ) : ?>
		<figure class="contactblock__image">
			<?php echo $user_info['user_avatar']; ?>
		</figure>
	<?php endif; ?>
	<!-- INFO -->
	<div class="contactblock__info">
		<ul class="team-member__info__contact-details">
			<?php if ( ! empty ( $user_info['display_name'] ) ) : ?>
				<li class="team-member__name"><?php echo $user_info['display_name']; ?></li>
			<?php endif; ?>

			<!-- user position, organisation (with link) -->
			<?php if ( ! empty ( $user_meta['user_position'][0] ) ) : ?>
				<li class="team-member__position">
					<span class="team-member__position"><?php echo $user_meta['user_position'][0] . ' at ' ?><span>
				<?php endif;
				if ( ! empty ( $user_meta['user_organisation'][0] ) ) :
					if ( ! empty( $user_meta['user_organisation_link'] ) ) : ?>
						<a href="<?php echo esc_url( $user_meta['user_organisation_link'][0] ); ?>">
							<span class="team-member__organisation"><?php echo $user_meta['user_organisation'][0]; ?></span>
						</a>
					<?php else : ?>
						<span class="team-member__organisation"><?php echo $user_meta['user_organisation'][0]; ?></span>
					<?php endif; ?>

				</li>
			<?php endif; ?>
			<?php if ( ! empty( $user_meta['user_story_link'][0] && ! empty( $user_meta['first_name'][0] ) ) ) : ?>
				<li class="team-member__story-link">
					<span><?php echo exchange_create_link( $user_meta['user_story_link'][0], false, 'button--small' )
						. sprintf( __( "%s's story", 'exchange' ), $user_meta['first_name'][0] )
						. '</a>' ?>
					</span>
				</li>
			<?php endif; ?>
		</ul>
		<!-- user contact-details -->
		<ul class="team-member__info__contact-details">
	<?php if ( ! empty ( $user_meta['user_phone'][0] ) || ! empty( $user_info['user_email'] ) ) : ?>
		<?php if ( ! empty( $user_meta['user_phone'][0] ) ) : ?>
				<?php echo $user_meta['user_phone'][0]; ?>
			</li>
		<?php endif; ?>
		<?php if ( ! empty( $user_info['user_email'] ) && function_exists( 'eae_encode_str' ) ) :
			$mem = eae_encode_str( $user_info['user_email'] );
			$icon = exchange_build_svg( get_stylesheet_directory() .'/assets/images/svg/T_icon_email_WEB.svg' ); ?>
			<li class="team-member__contactme">
				<?php echo $icon; ?>
				<a href="mailto:<?php echo $mem; ?>"><?php echo $mem; ?></a>
			<li>
		<?php endif; ?>
	<?php endif; ?>

		</ul>
	</div><!-- contactblock__info -->
	<!-- user description -->
</div><!-- .contactblock__team-member -->
<?php if ( ! empty ( $user_meta['description'][0] ) ) : ?>
	<aside class="contactblock__cta"><?php echo $user_meta['description'][0]; ?></aside>
<?php endif; ?>
