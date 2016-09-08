<div id="update__selection" class="hentry">

		<section class="collab-selection">

			<div class="section-inner">

				<header class="story__title-wrapper">
					<h2><?php _e( 'Select your collaboration', 'exchange' );?></h2>
				</header>

				<div class="section__slice entry-content">

			<?php
				$pr = exchange_verify_token();
				if ( empty( $pr ) ) : ?>

					<div class="callout"><?php  _e( 'There seems to be a problem with your token. Please get in touch with the Tandem Team', EXCHANGE_PLUGIN ); ?></div>

				</div>

			<?php else : ?>

				<?php

					$exchange_pr_obj = BaseController::exchange_factory( $pr );
					if ( ! $exchange_pr_obj instanceof Programme_Round ) : ?>

					<div class="callout"><?php  _e( 'There seems to be a problem with your token. Please get in touch with the Tandem Team', EXCHANGE_PLUGIN ); ?></div>

				</div>

				<?php else: ?>

					<p><?php _e( 'To submit a story, update your personal info or update your project page, select your Tandem collaboration in the dropdown menu below', 'exchange' );?></p>

				</div>

				<div class="section__slice">

					<?php
						$select = $exchange_pr_obj->build_pr_dropdown();
						echo $select; ?>

				</div>

				<?php endif; ?>

			<?php endif; ?>

			</div><!-- section-inner -->

		</section>

		<section class="section--has_grid section--coloured section--yellow-1-web">
			<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex('yellow-1-web') ); ?>
			<div class="section-inner">
				<div class="section__slice simplegrid grid--form-options" data-equalizer data-equalize-on="medium" >
					<div class="grid--form-options__helper"><?php _e('Select your collaboration to see your options', 'exchange' ); ?></div>
				</div>
			</div>
		</section>

</div>
