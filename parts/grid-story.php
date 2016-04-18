<?php
	$story = new Story( $post_object, 'grid' );
	$story->publish_featured_image();
	$story->editorial_intro->publish_stripped();
	$story->storyteller->publish_name();
