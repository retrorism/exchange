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
		<?php get_template_part( 'parts/nav', 'facets-top' ); ?>
		<?php if (have_posts()) : ?>

		<div class="archive__interface section--blue-1-web section--coloured">
			<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex( 'blue-1-web' ) ); ?>

			<div class="archive__interface-inner">
			<?php get_template_part( 'parts/nav', 'facets-extra'); ?>
			<?php /* get_template_part( 'parts/content', 'archive-filters'); */ ?>
			



			<div class="" data-tabs-content="facet-tabs">
				<div class="tabs-panel is-active" id="facets-grid">
					<?php get_template_part( 'parts/content', 'archive-grid' ); ?>
				</div>
				<div class="tabs-panel" id="facets-map">
					<?php get_template_part( 'parts/content', 'archive-map'); ?>
				</div>
			</div>

		</ul>

			<?php exchange_page_navi(); ?>

			</div><!-- archive__interface-inner-->

			<?php echo BasePattern::build_edge_svg('bottom', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
		</div><!--archive__interface-->

		<?php else : ?>

			<?php get_template_part( 'parts/content', 'missing' ); ?>

		<?php endif; ?>

		<footer class="archive__footer">

			<section class="archive__footer__section footer__section">

				<div class="section-inner">


				</div>

			</section>

		</footer>

	</div> <!-- end .main-inner -->

</main> <!-- end #main -->

<?php get_footer(); ?>
