<div id="post-not-found" class="hentry">

	<?php if ( is_search() ) : ?>

		<section class="no-results">

			<div class="section-inner">

				<header class="story__title-wrapper">
					<h2><?php _e( 'Sorry, No Results.', 'exchange' );?></h2>
				</header>

				<div class="section__slice entry-content">
					<p><?php _e( 'We could not find anything for this search. Please try your search again.', 'exchange' );?></p>
				</div>

				<div class="section__slice">
					<p><?php get_search_form(); ?></p>
				</div>

			</div>

		</section> <!-- end no-results section -->

	<?php else: ?>

		<section class="no-results">

			<div class="section-inner">

				<div class="story__title-wrapper">
					<div class="header-inner">
						<div class="section__slice">
							<h2><?php _e( 'Oops, Post Not Found!', 'exchange' ); ?></h2>
						</div>
						<div class="section__slice entry-content">
							<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'exchange' ); ?></p>
						</div>
						<div class="section__slice">
							<p><?php get_search_form(); ?></p>
						</div>
					</div>
				</div>

			</div>

		</section> <!-- end no-results section -->

	<?php endif; ?>

</div>
