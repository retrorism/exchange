<header class="article-header archive__header">

	<div class="archive__header__introduction">

		<div class="archive__title-wrapper">

		<?php if ( is_tax() || get_query_var( 'programme-round' ) ) : ?>

			<h1 class="archive__title" itemprop="headline"><?php the_archive_title() ?></h1>

		<?php the_archive_description( '<div class="taxonomy-description">', '</div>' );?>

		<?php elseif ( is_page_template('archive.php') || is_search() ) : ?>

			<h1 class="archive__title"><?php echo __( 'Browsing the archives', 'exchange' ); ?></h1>

		<?php endif; ?>

		</div>

	</div>

</header>
