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
$collab = new Collaboration( $post );

?>


<article id="post-<?php the_ID(); ?>" <?php post_class(''); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">
	<?php $image_class = $collab->has_header_image ? 'has-image' : 'no-image'; ?>
	<header class="article-header collaboration__header collaboration__header--<?php echo $image_class; ?>" data-equalizer data-equalize-on="large">
		<?php $collab->publish_header_image();?>
			<div class="collaboration__header__desc" data-equalizer-watch>
				<div class="collaboration__header__desc-inner">
					<h1 class="entry-title collaboration__title" itemprop="headline"><?php the_title(); ?></h1>
					<?php if ( $collab->description_length > 0 ) {
							$collab->description->publish('collaboration');
						} ?>
					<?php if ( ! empty( $collab->website ) ) : ?>
							<a class="button button--large" href="<?php echo esc_url( $collab->website ); ?>"><?php _e('project website','exchange'); ?></a>
							<hr>
						<?php endif; ?>
					<section class="collaboration__tags"><?php $collab->publish_tags('collaboration'); ?></section>
				</div>
			</div><!-- end description -->
		</div><!-- end description-wrapper -->
	</header> <!-- end article header -->
	<div class="entry-content collaboration__content" itemprop="articleBody">

	<?php if ( $collab->has_participants ) : ?>

		<section class="collaboration__participants">
			<div class="section-inner">

			<?php $participants = $collab->participants; ?>
			<?php foreach( $participants as $p_obj ) : ?>
				<?php include( locate_template( 'parts/content-participant.php' ) ); ?>
		 	<?php endforeach; ?>

			</div><!-- section-inner -->
		</section><!-- collaboration__participants -->

	<?php endif; ?>

	<?php if ( $collab->has_participants && count ( $collab->participants ) > 1 ) : ?>
	<section class="collaboration__map">
		<div class="section-inner">
		<?php $collab->publish_collab_map(); ?>
		</div>
	</section>
	<?php endif; ?>
	<?php if ( $collab->has_gallery ) : ?>
	<section class="collaboration__gallery section--salmon-1-web">
		<div class="section-inner orbit" role="region" aria-label="<?php printf( esc_html__('Gallery for "%s"', 'exchange' ), get_the_title() ); ?>" data-orbit data-auto-play="false">
		<?php $collab->publish_gallery('collaboration'); ?>
		</div>
	</section>
	<?php endif; ?>
	<section class="collaboration__stories">
		<?php $collab->publish_related_stories(); ?>
	</section>

		<?php
		// Loop through sections.
		$collab->publish_sections();
		?>
	</div> <!-- end articleBpdy -->


	<footer class="article-footer collaboration__footer">

	</footer> <!-- end article footer -->

</article> <!-- end article -->
<div class="article-related-content collaboration__extras">
	<?php $collab->publish_related_content('collaboration'); ?>
</div>
