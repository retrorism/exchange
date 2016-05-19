<div class="contactblock__team-member">
	<!-- user description -->
	<?php if ( ! empty ( $user_info['user_description'] ) ) : ?>
		<h6 class="team-member__cta"><?php echo $user_info['user_description']; ?></h6>
	<?php endif; ?>

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
		<ul class="table team-member__info__contact-details">
		<?php if ( ! empty ( $user_info['display_name'] ) ) : ?>
			<li class="team-member__name"><?php echo $user_info['display_name']; ?></li>
		<?php endif; ?>

			<!-- user position, organisation (with link) -->
			<li class="team-member__position">
				<?php if ( ! empty ( $user_acf['user_position'] ) ) : ?>
					<span class="team-member__position"><?php echo $user_acf['user_position'] . ' at ' ?><span>
				<?php endif;
				if ( ! empty ( $user_acf['user_organisation'] ) ) :
					if ( ! empty( $user_acf['user_organisation_link'] ) ) : ?>
						<a href="<?php echo esc_url( $acf['user_organisation_link'] ); ?>">
							<span class="team-member__organisation"><?php echo $user_acf['user_organisation']; ?></span>
						</a>
					<?php else : ?>
						<span class="team-member__organisation"><?php echo $user_acf['user_organisation']; ?></span>
					<?php endif;
				endif; ?>
			</li>
		</ul>
		<!-- user contact-details -->
		<ul class="table team-member__info__contact-details">
	<?php if ( ! empty ( $user_acf['user_phone'] ) || ! empty( $user_info['user_email'] ) ) : ?>
		<?php if ( ! empty( $user_acf['user_phone'] ) ) : ?>
			<li class="team-member__phone">
				<?php echo $user_acf['user_phone']; ?>
			</li>
		<?php endif; ?>
		<?php if ( ! empty( $user_info['user_email'] ) && function_exists( 'eae_encode_str' ) ) :
			$mem = eae_encode_str( $user_info['user_email'] ); ?>
			<li class="team-member__e-mail">
				<a href="mailto:<?php echo $mem; ?>"><?php echo $mem; ?></a>
			<li>
		<?php endif; ?>
	<?php endif; ?>

		</ul>
</div><!-- .contactblock__team-member -->
