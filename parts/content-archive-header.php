<header class="article-header archive__header">
	<div class="archive__header__introduction">
		<div class="archive__title-wrapper">
			<h1 class="entry-title archive__title" itemprop="headline"><?php the_archive_title() ?></h1>
			<?php the_archive_description('<div class="taxonomy-description">', '</div>');?>
		</div>
	</div>
	<?php if ( is_archive('collaboration' ) ) : ?>
		<?php get_template_part( 'parts/content', 'archive-map'); ?>
	<?php endif; ?>
</header>
