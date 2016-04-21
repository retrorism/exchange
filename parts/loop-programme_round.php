<?php
/**
 * Programme Round Loop Template
 * Author: Willem Prins | SOMTIJDS
 * Project: Tandem
 * Date created: 18/04/2016
 *
 * @package Exchange Plugin
 **/

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
};

$programme_round = new Programme_Round( $post );

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

	<header class="article-header programme_round__header">

		<?php if ( $programme_round->has_header_image ) {
			$programme_round->publish_header_image();
		 } ?>

		<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>

	</header> <!-- end article header -->

	<div class="entry-content programme_round__content" itemprop="articleBody">
		<?php
		// Loop through sections.
		$programme_round->publish_sections();
		?>
	</div> <!-- end article -->

	<footer class="article-footer programme_round__footer">
		<?php $programme_round->publish_related_content(); ?>

		<p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'exchange' ) . '</span> ', ', ', ''); ?></p>	</footer> <!-- end article footer -->

</article> <!-- end article -->
