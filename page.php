<?php get_header(); ?>

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<?php get_template_part( 'parts/loop', 'page' ); ?>

		<?php endwhile; endif; ?>

<?php get_footer(); ?>
