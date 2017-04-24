<?php get_header(); ?>

<main id="main" class="archive__wrapper" role="main" data-toggler=".facets-active">

	<div class="main-inner">

		<?php
		$args = array(
			'name'        => 'collaborations',
			'post_type'   => 'page',
			'post_status' => 'private',
			'numberposts' => 1
		);
		$get_collaborations_page = get_posts( $args );
		if ( $get_collaborations_page ) : ?>

			<?php $exchange = BaseController::exchange_factory( $get_collaborations_page[0] );
			include_once( get_stylesheet_directory() . '/parts/content-page-header.php' ); ?>

		<?php else: ?>

			<?php get_template_part( 'parts/content', 'archive-header'); ?>

		<?php endif; ?>
		
		<?php get_template_part( 'parts/nav', 'facets' ); ?>
		
		<?php get_template_part( 'parts/nav', 'archive-view-toggle') ; ?>
		
		<?php if (have_posts()) : ?>
		
		<?php get_template_part( 'parts/content', 'archive-interface' ); ?>

		<?php else : ?>

			<?php get_template_part( 'parts/content', 'missing' ); ?>

		<?php endif; ?>

		<footer class="archive__footer">

			<section class="archive__footer__section footer__section">

				<div class="section-inner">

					<?php get_template_part( 'parts/content','get-involved-cta' ); ?>

				</div>

			</section>

		</footer>

	</div> <!-- end .main-inner -->

</main> <!-- end #main -->

<?php get_footer(); ?>
