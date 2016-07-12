<?php
/**
 * Page Loop Template
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


<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/Article">

	<header class="article-header story__header">

		<?php if ( $story->has_header_image ) {
			$story->publish_header_image();
		 } ?>

		<div class="story__header__introduction">

			<div class="story__title-wrapper">

				<h1 class="entry-title story__title" itemprop="headline"><?php the_title(); ?></h1>

			</div>

			<?php if ( $story->has_editorial_intro ) {
				$story->publish_intro();
			} ?>

		</div>

	</header> <!-- end .story__header -->

	<div id="article-body" class="entry-content story__content" itemprop="articleBody">

		<?php
		// Loop through sections.
		$story->publish_sections();
		?>
	</div> <!-- end article -->

</article> <!-- end article -->

<div class="article-related-content story__extras">
	<?php $story->publish_related_content('story'); ?>
</div>
