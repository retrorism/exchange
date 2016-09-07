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

$exchange = new Story( $post ); ?>

<?php if ( ! empty( $post->post_parent ) ) : ?>
	<?php include_once( get_stylesheet_directory() . '/parts/nav-breadcrumbs-bar.php' ); ?>
<?php endif; ?>

<main id="main" role="main" data-scroll="main">

	<div class="main-inner">

		<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/Article">

			<?php include_once( get_stylesheet_directory() . '/parts/content-page-header.php' ) ?>

			<div class="entry-content story__content" itemprop="articleBody">
				<?php
				// Loop through sections.
				$exchange->publish_sections();
				?>
			</div> <!-- end story__content -->

			<?php include_once( get_stylesheet_directory() . '/parts/content-story-footer.php' ); ?>

		</article> <!-- end article -->

		<?php if ( $exchange->has_gallery ) : ?>

			<?php include_once( get_stylesheet_directory() .'/parts/content-story-modal.php' ); ?>

		<?php endif; ?>

	</div><!-- end .main-inner -->

</main> <!-- end #main -->
