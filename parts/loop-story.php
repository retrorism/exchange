<?php
/**
 * Story Loop Template
 * Author: Willem Prins | SOMTIJDS
 * Project: Tandem
 * Date created: 10/04/2016
 *
 * @package Exchange Plugin
 **/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
};

$story = new Story( $post );

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

	<header class="article-header story__header">

		<?php if ( $story->has_header_image ) {
			$story->publish_header_image();
		 } ?>

		<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>

		<?php if ( $story->has_editorial_intro ) {
			$story->publish_intro();
		} ?>

	</header> <!-- end article header -->

	<div class="entry-content story__content" itemprop="articleBody">
		<?php
		// Loop through sections.
		$story->publish_sections();
		?>
	</div> <!-- end article -->

	<footer class="article-footer story__footer">
		<?php $story->publish_byline(); ?>
		<?php $story->publish_related_content(); ?>

		<p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'jointswp' ) . '</span> ', ', ', ''); ?></p>	</footer> <!-- end article footer -->

</article> <!-- end article -->
