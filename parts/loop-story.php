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

$exchange = new Story( $post );
?>

<?php include_once( get_stylesheet_directory() . '/parts/nav-breadcrumbs-bar.php' ); ?>

<main id="main" role="main" data-scroll="main">

	<div class="main-inner">

		<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/Article">

			<header class="article-header story__header">

				<?php if ( $exchange->has_header_image ) {
					$exchange->publish_header_image();
				 } ?>

				<div class="story__header__introduction">

					<div class="story__title-wrapper">

						<h1 class="entry-title story__title" itemprop="headline"><?php the_title(); ?></h1>

					</div>

					<?php include_once( get_stylesheet_directory() . '/parts/content-story-meta.php' ); ?>

					<?php if ( $exchange->has_editorial_intro ) {
						$exchange->publish_intro();
					} ?>

				</div>


			</header> <!-- end .story__header -->

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
