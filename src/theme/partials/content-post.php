<?php
/**
 * Single Post loop
 *
 * Displays featured image and post details before
 * displaying the post content.
 *
 * @package  Kraftwerke
 * @since    1.0.0
 */

if ( have_posts() ) {
	while ( have_posts() ) : the_post();
		
		// Post Featured Image		
		if ( has_post_thumbnail() ) {
			$attachment_id = get_post_thumbnail_id();
			if ( $image = get_kwer_image($attachment_id, '16-9-md') ) {
				$image_xs = wp_get_attachment_image_url($attachment_id, '16-9-xs');
				$image_sm = wp_get_attachment_image_url($attachment_id, '16-9-sm');
				echo '
					<div class="frame frame--16-9 frame--rounded frame--margin-bottom">
						<picture>
							<source media="(min-width: 641px)" data-original-set="' . $image['src'] . '" />
							<source media="(min-width: 481px)" data-original-set="' . $image_sm . '" />
							<img class="frame__media" alt="' . $image['alt'] . '" data-original="' . $image_xs . '" height="' . $image['height'] . '" width="' . $image['width'] . '">
						</picture>
					</div>
				';
			}
		}
	
		// Post Meta
		$meta = kwer_post_meta();
		if ( ! empty($meta) && is_array($meta) ) {
			echo '<ul class="meta">';
			foreach ( $meta as $meta_item ) {
				echo '<li>' . $meta_item . '</li>';
			}
			echo '</ul>';
		}
		
		// Post Content
		the_content();
		
		// Post Tags
		$tags = get_the_tags();
		if ( ! empty($tags) && ! is_wp_error($tags) ) {
			echo '<div class="tags-list meta">' . __( 'Tags', 'kraftwerke' ) .': ';
			$tag_links = array();
			foreach ( $tags as $tag ) {
				$tag_links[] = '<a href="' . get_tag_link($tag) . '">' . $tag->name . '</a>';
			}
			echo implode(', ', $tag_links);
			echo '</div>';
		}
		
		// About the Author
		kwer_author_bio();
		
		// Comment Form
		base_comment_form();
		
		// Comments LIst
		base_comments_list();
		
	endwhile;
}