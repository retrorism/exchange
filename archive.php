<?php get_header(); ?>

<main id="main" class="archive-wrapper" role="main">

	<div class="main-inner">

		<div class="archive__interface section--blue-1-web section--coloured">

			<?php get_template_part( 'parts/content', 'archive-header'); ?>

		    <?php if (have_posts()) : ?>

				<?php get_template_part( 'parts/content', 'archive-grid' ); ?>

				<?php exchange_page_navi(); ?>

			<?php else : ?>

				<?php get_template_part( 'parts/content', 'missing' ); ?>

			<?php endif; ?>

		</div><!-- end archive__interface -->

	</div><!-- end main-inner -->

</main> <!-- end #main -->

<?php get_footer(); ?>
