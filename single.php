<?php
/*
Exchange story template
*/
?>

<?php get_header(); ?>
		
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<?php get_template_part( 'parts/loop', $post->post_type ); ?>

	<?php endwhile; else : ?>

		<?php get_template_part( 'parts/content', 'missing' ); ?>

	<?php endif; ?>

<?php get_footer(); ?>
