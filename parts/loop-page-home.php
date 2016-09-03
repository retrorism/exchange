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

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/Article">
	<div id="article-body" class="entry-content story__content" itemprop="articleBody">

		<?php $exchange = new Story( $post ); 

			include_once( get_stylesheet_directory() . '/parts/loop-featured-stories.php' );

			$exchange->publish_sections();
		?>

	</div> <!-- end article -->

</article> <!-- end article -->
