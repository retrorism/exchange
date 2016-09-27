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
$exchange = new Collaboration( $post );
?>

<?php include_once( get_stylesheet_directory() . '/parts/nav-breadcrumbs-bar.php' ); ?>

<main id="main" role="main" data-scroll="main">

	<div class="main-inner">

		<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
			<?php $image_class = $exchange->has_header_image ? 'has-image' : 'no-image'; ?>

			<header class="article-header collaboration__header collaboration__header--<?php echo $image_class; ?>" data-equalizer data-equalize-on="large">
				<?php $exchange->publish_header_image();?>
				<div class="collaboration__header__desc" data-equalizer-watch>
					<div class="collaboration__header__desc-inner">
						<h1 class="entry-title collaboration__title" itemprop="headline"><?php the_title(); ?></h1>
						<?php if ( $exchange->description_length > 0 ) {
								$exchange->description->publish('collaboration');
							} ?>
						<?php if ( ! empty( $exchange->website ) ) : ?>
								<a class="button button--large" href="<?php echo esc_url( $exchange->website ); ?>"><?php _e('project website','exchange'); ?></a>
								<hr>
							<?php endif; ?>
						<section class="collaboration__tags"><?php $exchange->publish_tags('collaboration'); ?></section>
					</div>
				</div><!-- end description -->
			</header> <!-- end article header -->

			<div class="entry-content collaboration__content" itemprop="articleBody">

				<!-- PARTICIPANTS -->
				<?php if ( $exchange->has_participants ) : ?>
					<section class="collaboration__participants">
						<div class="section-inner">
						<?php $participants = $exchange->participants; ?>
						<?php foreach( $participants as $p_obj ) : ?>
							<?php include( locate_template( 'parts/content-participant.php' ) ); ?>
					 	<?php endforeach; ?>

						</div><!-- section-inner -->
					</section><!-- collaboration__participants -->
				<?php endif; ?>

				<!-- MAP -->
				<?php if ( $exchange->has_participants && count ( $exchange->participants ) > 1 ) : ?>
					<section class="collaboration__extras collaboration__section section--blue-1-web section--coloured section--has-grid section--collaboration-grid">
						<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
						<div class="section-inner">
							<header class="sectionheader">
								<div class="sectionheader-inner">
									<h4 class="sectionheader__text sectionheader__text--black"><?php _e( 'The connection','exchange' ); ?></h4>
								</div>
							</header>
							<div class="collaboration__map">
								<div class="collaboration__griditem griditem--grid-full">
									<?php $exchange->publish_collab_map(); ?>
								</div>
							</div>

						</div><!-- section-inner -->
						<?php echo BasePattern::build_edge_svg('bottom', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
					</section>
				<?php endif; ?>

				<!-- MEDIA -->
				<?php if ( $exchange->has_files || $exchange->has_gallery ) : ?>
					<?php if ( $exchange->has_files && $exchange->has_gallery ) {
						$title = __( 'The process (gallery and downloads)', 'exchange' );
					} elseif ( ! $exchange->has_gallery ) {
						$title = __( 'The process (gallery)', 'exchange' );
					} elseif ( ! $exchange->has_files ) {
						$title = __( 'The process (downloads)', 'exchange' );
					} ?>
					<section class="collaboration__extras collaboration__section section--blue-1-web section--coloured section--has-grid section--collaboration-grid">
						<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex( 'salmon-1-web' ) ); ?>
						<div class="section-inner">
							<header class="sectionheader">
								<div class="sectionheader-inner">
									<h4 class="sectionheader__text sectionheader__text--black"><?php echo $title; ?></h4>
								</div>
								<?php if ( $exchange->has_gallery ) : ?>
									<p><?php _e('Hint: click on the image to see a larger version!', 'exchange' ); ?>
								<?php endif; ?>
							</header>
						<div class="collaboration__media__grid" data-masonry='{ "percentPosition": true, "columnWidth": ".masonry__grid-sizer", "gutter": ".masonry__gutter-sizer", "itemSelector": ".collaboration__griditem" }'>
							<div class="masonry__grid-sizer"></div>
							<div class="masonry__gutter-sizer"></div>
							<?php $exchange->publish_collab_media_gallery(); ?>
							<?php $exchange->publish_collab_video(); ?>
							<?php $exchange->publish_collab_files(); ?>
						</div>
					</div><!-- section-inner -->
					<?php echo BasePattern::build_edge_svg('bottom', exchange_slug_to_hex( 'blue-1-web' ) ); ?>
					</section>

				<?php endif; ?>

				<!-- SHARED STORIES -->
				<?php if ( $exchange->has_stories ) : ?>
					<section class="collaboration__section collaboration__stories section--yellow-1-web section--coloured">
						<?php echo BasePattern::build_edge_svg('top', exchange_slug_to_hex( 'yellow-1-web' ) ); ?>
						<div class="section-inner">
							<?php $exchange->publish_related_stories(); ?>
						</div><!--section-inner-->
						<?php echo BasePattern::build_edge_svg('bottom', exchange_slug_to_hex( 'yellow-1-web' ) ); ?>
					</section>
				<?php endif; ?>

			</div> <!-- end articleBpdy -->

			<?php include_once( get_stylesheet_directory() . '/parts/content-story-footer.php' ); ?>

		</article> <!-- end article -->

		<?php if ( $exchange->has_gallery ) : ?>
			<?php include_once( get_stylesheet_directory() .'/parts/content-story-modal.php' ); ?>
		<?php endif; ?>

</div><!-- end .main-inner -->

</main> <!-- end #main -->
