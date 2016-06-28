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
					<?php if ( $collab->has_description ) {
							$collab->description->publish('collaboration');
						} ?>
					<section class="collaboration__tags"><?php $collab->publish_tags('collaboration'); ?></section>
				</div>
			</div><!-- end description -->
		</div><!-- end description-wrapper -->
	</header> <!-- end article header -->
	<section class="collaboration__participants">
	<?php if ( $collab->has_participants ) : ?>
		<?php $participants = $collab->participants;
			foreach( $participants as $p_obj ) { ?>
				<div class="collaboration__participants__item">
					<div class="collaboration__participant__details">
						<h2 class="participant__name">
							<?php echo $p_obj->name; ?>
						</h2>
						<?php if ( ! empty( $p_obj->org_name ) ) : ?>
							<?php if ( ! empty( $p_obj->org_website ) ) : ?>
								<p class="participant__organisation__name">
									<a href="<?php echo $p_obj->org_website; ?>" target="_blank">
										<?php echo $p_obj->org_name; ?>
									</a>
								</p>
							<?php else : ?>
								<p class="participant__organisation__name">
									<?php echo $p_obj->org_name; ?>
								</p>
							<?php endif; ?>
						<p class="participant__organisation__city">
							<?php echo $p_obj->org_city;
								if ( ! empty( $p_obj->org_country ) ) {
									echo ', ' .  $p_obj->org_country;
								}
							?>
						</p>
						<?php endif; ?>
					</div>
				</div>
		<?php } ?>
	<?php endif; ?>
	</section>

	<div class="entry-content collaboration__content" itemprop="articleBody">
		<?php
		// Loop through sections.
		?>
	</div> <!-- end article -->

	<footer class="article-footer collaboration__footer">

	</footer> <!-- end article footer -->

</article> <!-- end article -->
