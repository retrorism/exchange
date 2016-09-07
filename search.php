<?php get_header(); ?>

<main id="main" role="main" data-scroll="main">

	<div class="main-inner">

		<?php get_template_part( 'parts/content', 'archive-header'); ?>

		<?php if (have_posts()) : ?>

		<div class="archive__interface section--salmon-1-web section--coloured">
		<?php echo BasePattern::build_edge_svg( 'top', exchange_slug_to_hex( 'salmon-1-web' ) ); ?>

			<div class="archive__interface-inner">

			<?php get_template_part( 'parts/content', 'archive-grid' ); ?>

			<?php exchange_page_navi(); ?>

			</div><!-- end .archive__interface-inner -->

		<?php echo BasePattern::build_edge_svg( 'bottom', exchange_slug_to_hex( 'salmon-1-web' ) ); ?>
		</div><!-- end .archive__interface-->

		<?php else : ?>

			<?php get_template_part( 'parts/content', 'missing' ); ?>

		<?php endif; ?>

			</div>

		</div>

	</div>

</main> <!-- end #main -->

<?php get_footer(); ?>
