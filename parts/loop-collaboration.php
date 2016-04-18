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

$collaboration = new Collaboration( $post );

var_dump( $collaboration );

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

	<header class="article-header collaboration__header">


		<h1 class="entry-title" itemprop="headline"><?php the_title(); ?></h1>


	</header> <!-- end article header -->

	<div class="entry-content collaboration__content" itemprop="articleBody">
		<?php
		// Loop through sections.
		?>
	</div> <!-- end article -->

	<footer class="article-footer collaboration__footer">

		<p class="tags"><?php the_tags('<span class="tags-title">' . __( 'Tags:', 'jointswp' ) . '</span> ', ', ', ''); ?></p>	</footer> <!-- end article footer -->

</article> <!-- end article -->
