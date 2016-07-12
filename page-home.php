<?php get_header(); ?>

	<main id="main" role="main">

		<div class="main-inner">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php get_template_part( 'parts/loop', 'page-home' ); ?>

		<?php endwhile; endif; ?>

		</div><!-- end .main-inner -->

	</main> <!-- end #main -->

<?php get_footer(); ?>
