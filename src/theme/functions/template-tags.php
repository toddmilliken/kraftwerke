<?php
/**
 * Theme template tags
 *
 * Declares common theme components and functions
 * 
 * @package  Kraftwerke
 * @since    1.0.0
 */
 
 
 
/**
 * Site Wrapper - Open
 *
 * @since   1.0.0
 */
function kwer_wrapper_open( $args = array() ) {
	?>
	<div class="outer-wrapper">
		<div class="site-wrapper">
	<?php
}
 
 
/**
 * Site Wrapper - Close
 *
 * @since   1.0.0
 */
function kwer_wrapper_close( $args = array() ) {
	?>
			</div>
		</div>
	<?php
}



/**
 * The opening HTML for the default template. 
 * Opens the "main" element that encloses everything between site header and footer. 
 * Opens the default content w/ sidebar layer, and conditionally calls the default sidebar.
 *
 * @param   array   $args
 *
 * @since   1.0.0
 */
function kwer_main_open( $args = array() ) {
	
	/** Default arguments */
	$default_args = array(
		'main_class' => '' ,
		'sidebar'    => true ,
		'no_content' => get_field('suppress_post_content') // hides the default layer
	);
	
	/** Merge passed arguments with defaults */
	$args = wp_parse_args( $args, $default_args );
	
	/**
	 * Hook for displaying additional content before opening main tag.
	 * @since 1.0.0
	 */	
	do_action('kwer_before_main_open'); ?>
	
	<main class="main<?php echo ( !empty($args['main_class']) ? ' ' . $args['main_class'] : '' ); ?>">
		
	<?php 
	/**
	 * Hook for displaying additional content before the default layer, but after opening main tag.
	 * @since 1.0.0
	 */	
	do_action('kwer_after_main_open'); 
	
	if ( ! $args['no_content'] ) : ?>
		<!-- start content w/ sidebar layer -->
		<section class="layer layer--default">
			<div class="layer__body">
				<div class="inner">
					<div class="layer__content-wrapper">
	
						<?php 
							/** Conditionally calls the sidebar */
							if ( $args['sidebar'] === true ) {
								get_sidebar(); 							
							}
						?>
						
						<article class="layer__content editor-styles">
							
							<?php
								/**
								 * Hook for displaying content before the loop.
								 * @since 1.0.0
								 */	
								 do_action('kwer_before_the_content');
							 
	endif;			 
			
	
}
 
 

/**
 * The closing HTML for the default template, enclosing the default content w/ sidebar layer
 * and the "main" element that wraps all content between header and footer.
 * 
 * @since    1.0.0
 */
function kwer_main_close( $args = array() ) {
		
	/** Default arguments */
	$default_args = array(
		'no_content' => get_field('suppress_post_content') // hides the default layer
	);
	
	/** Merge passed arguments with defaults */
	$args = wp_parse_args( $args, $default_args );
	
	if ( ! $args['no_content'] ) :
	 
		 					/**
							 * Hook for displaying additional content after the loop.
							 * @since 1.0.0
							 */	
							do_action('kwer_after_the_content'); ?>
							
						</article><!-- closes article.main__content -->
					</div><!-- closes .layer__content-wrapper -->
				</div><!-- closes .inner -->
			</div><!-- closes .layer__body -->
		</section><!-- closes .layer -->
		
		<?php 
	endif;

	/**
	 * Hook for displaying additional content below the default layer, but before closing main tag.
	 * @since 1.0.0
	 */	
	do_action('kwer_before_main_close'); ?>
			
	</main>
	
	<?php 
	/**
	 * Hook for displaying additional content after closing main tag.
	 * @since 1.0.0
	 */	
	do_action('kwer_after_main_close'); 
	
}


/**
 * Override base theme social media
 *
 * Adds different markup than base social linka.
 *
 *
 * @param    array     $args
 * @echo/@return   string    $html
 */
function base_social( $args = array() ) {
	
	/** Validates social media */
	if ( $social = get_field('opts_social_media', 'options') ) :
		
		/** Sets default arguments */
		$defaults = array(
			'container' => false,
			'container_class' => '',
			'title_text' => '', //! Example: 'Follow Us:'
			'is_square' => false, // is Font Awesome square icon?
			'class' => false,
			'echo' => true
		);
		
		/** Applies default arguments where needed */
		$args = wp_parse_args( $args, $defaults );
		extract($args);

		$html = '';
	
		/** Validates the container wrapper, if supplied */
		if ( $container ) :
			$html .= '<' . $container . (!empty($container_class) ? ' class="' . $container_class . '"' : '') . '>';
		endif;
	
		/** Open social list */
		$html .= '<ul class="social no-list-style' . ($class ? ' ' . $class : '') . '">';
		
			/** Lead-in Title */
			if ( !empty($title_text) ) :
				$html .= '<li class="social__title">' . $title_text . '</li>';
			endif;
			
			foreach ( $social as $sm ) :
				$sm_type = $sm['opts_sm_type'];
				$sm_url = $sm['opts_sm_url'];
				
				switch ( $sm_type ) :
					case 'email' :
						$sm_icon = 'paper-plane';
						break;
					case 'blog' :
						$sm_icon = 'rss';
						break;
					case 'fb' :
						$sm_icon = 'facebook';
						break;
					case 'g' :
						$sm_icon = 'google-plus';
						break;
					case 'ig' :
						$sm_icon = 'instagram';
						break;
					case 'li' :
						$sm_icon = 'linkedin';
						break;
					case 'pt' :
						$sm_icon = 'pinterest';
						break;
					case 'tw' :
						$sm_icon = 'twitter';
						break;
					case 'rss' :
						$sm_icon = 'rss';
						break;
					case 'vm' :
						$sm_icon = 'vimeo';
						break;
					case 'yt' :
						$sm_icon = 'youtube';
						break;
					case 'yp' :
						$sm_icon = 'yelp';
						break;
				endswitch;
				
				/** Outputs social list item */
				$html .= '
					<li class="social__item">
						<a class="social__link" target="_blank" href="' . esc_url($sm_url) . '">
							<span class="fa-stack">
								<i class="fa fa-circle fa-stack-2x"></i>
								<i class="fa fa-' . $sm_icon . ' fa-stack-1x"></i>
							</span>
						</a>
					</li>
				';
				
			endforeach;
		
		/** Closes social list */
		$html .= '</ul>';
		
		/** Validates container, if supplied */
		if ( $container ) :
			$html .= '</' . $container . '>';
		endif;
		
		/** Echos or returns the resulting $html */
		if ( $echo ) :
			echo $html;
		else :
			return $html;
		endif;
		
	endif;

}

/**
 * Get image parts by attachment ID.
 * 
 * @since    1.0.0
 *
 * @return   array    $image     Contains image src, alt, width, and height
 */
function get_kwer_image( $attachment_id = null, $size = 'medium' ) {
	
	if ( ! $attachment_id ) {
		if ( $current_attachment_id = wp_get_attachment_image_src( get_post_thumbnail_id(), $size ) ) {
			$attachment_id = $current_attachment_id;
		} else {
			return false;
		}
	}
	
	$image           = array();
	$image['alt']    = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
	
	$attachment      = wp_get_attachment_image_src( $attachment_id, $size );
	$image['src']    = $attachment[0];
	$image['width']  = $attachment[1];
	$image['height'] = $attachment[2];
	
	return $image;
	
}

/**
 * Array of post's meta information
 * 
 * @since    1.0.0
 *
 * @param    int     $post_id     ID of post to retrieve meta from.
 * @return   array   $meta
 */
function kwer_post_meta( $post_id = false ) {
	
	if ( ! $post_id ) {
		$post_id = get_the_id();
	}
	
	$meta = array();
	switch ( get_post_type( $post_id ) ) {
		case 'post' :
		default :
			
			// Author
			$author_id = get_post_field( 'post_author', $post_id );
			$meta[] = __( 'by', 'kraftwerke' ) . ': ' . '<a href="' . get_author_posts_url( $author_id ) . '">' . get_the_author_meta( 'display_name',  $author_id ) . '</a>';
			
			// Category
			$category_links = kwer_term_links( $post_id );
			$meta[] = implode(', ', $category_links);
	
			// Date
			$meta[] = '<time datetime="' . get_the_date( 'Y-m-d H:i', $post_id ) . '">' . get_the_date( 'm.d.y', $post_id ) . '</time>';
	}
	
	return $meta;

}

/**
 * Array of post's term links
 * 
 * @since    1.0.0
 */
function kwer_term_links( $post_id = false ) {
	
	if ( ! $post_id ) {
		$post_id = get_the_id();
	}
	
	$term_links = array();
	switch ( get_post_type( $post_id ) ) {
		case 'post' :
		default :
		
			// Get post categories
			$categories = get_the_category( $post_id );
			if ( !empty($categories) && !is_wp_error($categories) ) {
				foreach ( $categories as $cat ) {
					$term_links[] = '<a href="' . get_category_link( $cat ) . '">' . $cat->name . '</a>';
				}
			}
			
	}
	
	return $term_links;
	
}

/**
 * Theme listings style
 *
 * Displays post using the theme's post listings style.
 * 
 * @since    1.0.0
 */
function kwer_block_media( $args = array() ) {

	/** Default arguments */
	$default_args = array(
		'title'       => false ,
		'excerpt'     => false ,
		'img_id'      => false ,
		'meta'        => array() , 
		'link_target' => '_self' ,
		'link_text'   => 'Read More' ,
		'link_url'    => false ,
		'tags'        => array() , 
		'echo'        => true
	);
	
	/** Merge passed arguments with defaults */
	$args = wp_parse_args( $args, $default_args );
	 
	$html  = '<div class="block-media">';
		
		// Image	
		if ( $attachment_id = $args['img_id'] ) {
			$img        = wp_get_attachment_image_src( $attachment_id, 'medium' );
			$img_alt    = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true );
			$img_height = $img[1];
			$img_src    = $img[0];
			$img_width  = $img[2];
			$html .= '
				<div class="block-media__media block-media__media--left">
					<picture>
						<img data-original="' . $img_src . '" alt="' . $img_alt . '" width="' . $img_width . '" height="' . $img_height . '" />
					</picture>
				</div>
			';
		}
		
		// Meta 
		$meta_html = false;
		if ( ! empty($args['meta']) && is_array($args['meta']) ) {
			$meta_html = '<ul class="meta">';
			foreach ( $args['meta'] as $meta_item ) {
				$meta_html .= '<li>' . $meta_item . '</li>';
			}
			$meta_html .= '</ul>';
		}
		
		// Tags
		$tags_html = false;
		if ( ! empty($args['tags']) && is_array($args['tags']) ) {
			$tags_html = '<div class="block-media__tags tags-list meta">' . __( 'Tags', 'kraftwerke' ) . ': ' . implode(', ', $args['tags'] ) . '</div>';
		}
		
		$html .= '
			<div class="block-media__body">';
				if ( $args['title'] ) {
					$html .= '<h3 class="block-media__title">';
					if ( $args['link_url'] ) {
						$html .= '<a href="' . esc_url( $args['link_url'] ) . '" target="' . esc_attr( $args['link_target'] ) . '">';
					}
					$html .= $args['title'];
					if ( $args['link_url'] ) {
						$html .= '</a>';	
					}
					$html .= '</h3>';
				}
				if ( $meta_html ) {
					$html .= $meta_html;
				}
				$html .= ( $args['excerpt'] ? '<div class="block-media__excerpt">' . $args['excerpt'] . '</div>' : '' ) .
				( $args['link_url'] ? '<a href="' . esc_url( $args['link_url'] ) . '" target="' . esc_attr( $args['link_target'] ) . '" class="block-media__link more">' . $args['link_text'] . '</a>' : '' ) . 
				( $tags_html ? $tags_html : '' ) . '
			</div>
		';

	$html .= '</div>';
	
	
	if ( $args['echo'] ) {
		echo $html;
	} else {
		return $html;
	}	
	
}



/**
 * Theme card style
 *
 * Displays post using the theme's post card style.
 * 
 * @since    1.0.0
 */
function kwer_block_card( $args = array() ) {

	/** Default arguments */
	$default_args = array(
		'classes'     => array() , // modifier class
		'echo'        => true ,
		'excerpt'     => false ,
		'img_id'      => false ,
		'link_target' => '_self' ,
		'link_text'   => 'Read More' ,
		'link_url'    => false ,
		'meta'        => array() , 
		'tags'        => array() , 
		'title'       => false ,
	);
	
	/** Merge passed arguments with defaults */
	$args = wp_parse_args( $args, $default_args );
	
	// Title
	$title_html = false;
	if ( $title = $args['title'] ) {
		$title_html .= '<h3 class="block-card__title">';
		if ( $args['link_url'] ) {
			$title_html .= '<a href="' . esc_url( $args['link_url'] ) . '" target="' . esc_attr( $args['link_target'] ) . '">';
		}
		$title_html .= $title;
		if ( $args['link_url'] ) {
			$title_html .= '</a>';	
		}
		$title_html .= '</h3>';
	}
	
	// Image
	$image_html = false;	
	if ( $attachment_id = $args['img_id'] ) {
		$img = get_kwer_image( $attachment_id );
		$image_html .= '
			<div class="block-card__media frame frame--16-9">
				<picture>
					<img class="frame__media" data-original="' . $img['src'] . '" alt="' . $img['alt'] . '" width="' . $img['width'] . '" height="' . $img['height'] . '" />
				</picture>
			</div>
		';
	}
	
	// Meta 
	$meta_html = false;
	if ( ! empty($args['meta']) && is_array($args['meta']) ) {
		$meta_html = '<ul class="meta">';
		foreach ( $args['meta'] as $meta_item ) {
			$meta_html .= '<li>' . $meta_item . '</li>';
		}
		$meta_html .= '</ul>';
	}
	
	// Tags
	$tags_html = false;
	if ( ! empty($args['tags']) && is_array($args['tags']) ) {
		$tags_html = '<div class="block-card__tags tags-list meta">' . __( 'Tags', 'kraftwerke' ) . ': ' . implode(', ', $args['tags'] ) . '</div>';
	}
	 
	$html  = '
		<div class="block-card' . ( !empty($args['classes']) ? ' ' . implode(' ', $args['classes']) : '' ) . '">' . 
			( $image_html ? $image_html : '' ) . '
			<div class="block-card__body">' . 
				( $title_html ? $title_html : '' ) .
				( $meta_html ? $meta_html : '' ) .
				( $args['excerpt'] ? '<div class="block-card__excerpt">' . $args['excerpt'] . '</div>' : '' ) .
				( $args['link_url'] ? '<a href="' . esc_url( $args['link_url'] ) . '" target="' . esc_attr( $args['link_target'] ) . '" class="block-card__link more">' . $args['link_text'] . '</a>' : '' ) . 
				( $tags_html ? $tags_html : '' ) . '
			</div>
		';

	$html .= '</div>';
	
	
	if ( $args['echo'] ) {
		echo $html;
	} else {
		return $html;
	}	
	
}






/**
 * Theme pagination 
 *
 * @since    1.0.0
 *
 * @link     https://codex.wordpress.org/Function_Reference/paginate_links
 *
 * @global   object    $wp_query    Optionally called if no arguments are passed. Calculates the math 
 *                                  needed to display right amount of pagination links.
 *
 * @param    array     $args {
 *           Optional. An array of arguments. Defaults to global $wp_query object if none supplied
 *
 *           @type     boolean      $echo          Prints the result instead of returning for use in PHP
 *
 *           @type     boolean      $total_pages   The total number of pages in a given query. 
 *                                                 NOTE: can be calculated by: `ceil( $wp_query->found_posts / $wp_query->query_vars['posts_per_page'] );`
 *
 *           @type     boolean      $current       The current page being requested. 
 *                                                 Defaults to get_query_var('paged')
 * }
 *
 * @return   string    $html        Defaults to return. Echo if $echo argument is set to true. 
 */
function kwer_pagination( $args = array() ) {
	
	/** Default arguments */
	$default_args = array(
		'echo'        => false ,
		'total_pages' => false ,
		'current'     => false 
	);
	
	/** Merge passed arguments with defaults */
	$args = (object) wp_parse_args( $args, $default_args );
	
	/** If no args passed to this function, get the global $wp_query object to calculate values */
	if ( ! $args->total_pages || ! $args->current ) {
		global $wp_query;
		
		if ( ! $args->total_pages ) {
			$args->total_pages = $wp_query->max_num_pages;
		}
		
		if ( ! $args->current ) {
			$args->current = get_query_var('paged') ? get_query_var('paged') : 1;
		}
	}
	
	/** A really high number unlikely to be reached */
	$big = 999999999;
	
	/** Declares arguments for WP function paginate_links(). */
	$pagi_args = array(
		'base'               => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
		'format'             => '/page/%#%/',
		'total'              => $args->total_pages,
		'current'            => $args->current,
		'show_all'           => false,
		'end_size'           => 1,
		'mid_size'           => 5,
		'prev_next'          => true,
		'prev_text'          => __('<i class="fa fa-angle-left" aria-hidden="true"></i>'),
		'next_text'          => __('<i class="fa fa-angle-right" aria-hidden="true"></i>'),
		'add_args'           => false,
		'add_fragment'       => '',
		'before_page_number' => '',
		'after_page_number'  => '',
	);
	
	/** Call pagination_links and store the resulting string of HTML */
	$pagination_html = paginate_links( $pagi_args );
	
	/** Adds a container to wrap the pagination HTML. Useful for styling */
	$html = '';
	if ( !empty($pagination_html) ) {
		$html = '<div class="pagination">' . $pagination_html . '</div>';	
	}

	/** Echo or return the result */
	if ( $args->echo ) {
		echo $html; 
	} else {
		return $html;
	}
	
}



/**
 * Author Bio
 *
 * Overwrites em-base function
 * 
 * @since    1.0.0
 *
 * @return   string   $html	
 */ 
function kwer_author_bio()
{	
	$author_id =  get_the_author_meta( 'ID' );
	$bio = apply_filters( 'the_excerpt', get_the_author_meta( 'description', $author_id ) );
	
	if ( ! empty($bio) ) {
	
		/** Output the author information using .block-media format. */
		$html = '<div class="block-media">';
			if ( $author_thumbnail = get_field('user_thumbnail', 'user_' . $author_id) ) {
				$html .= '<div class="block-media__media block-media__media--left">';
					$html .= '<img data-original="' . $author_thumbnail['sizes']['thumbnail'] . '" alt="' . $author_thumbnail['alt'] . '" />';
				$html .= '</div>';
			}
			$html .= '<div class="block-media__body">';
				$html .= '<h3 class="block-media__title">' . get_the_author()  . '</h3>';
				$html .= $bio;
			$html .= '</div>';
		$html .= '</div>';
		
		echo $html;
		
	}

} 

/**
 * Header phone number
 *
 * @since    1.0.0
 */
function kwer_header_phone() {
	
	if ( $phone = get_option('options_opts_phone') ) : 
?>
		<div class="header-phone"><strong><?php _e('Phone', 'kraftwerke'); ?></strong>: <?php echo $phone; ?></div>
<?php 
	endif; 
	
}

/**
 * Footer phone number
 *
 * @since    1.0.0
 */
function kwer_footer_phone() {
	
	if ( $phone = get_option('options_opts_phone') ) : 
?>
		<div class="footer-phone"><p><i class="fa fa-phone"></i> <?php _e('Phone', 'kraftwerke'); ?>: <?php echo $phone; ?></p></div>
<?php 
	endif; 
	
}

/**
 * Header phone number
 *
 * @since    1.0.0
 */
function kwer_header_cta() {
	
	if ( $header_cta = get_option('options_opts_is_header_cta') ) :
		$link_target = '_self';
		$link_text   = get_option('options_opts_header_cta_text');
		$link_url    = false;
		switch ( get_option('options_opts_header_cta_link_type') ) {
			case 'internal' :
				$internal_post_id = get_option('options_opts_header_cta_link_internal');
				$link_url = !empty($internal_post_id) ? get_permalink($internal_post_id) : false;
				get_option('options_opts_header_cta_link_internal');
				break;
			case 'custom' :
				$link_target = get_option('options_opts_header_cta_link_target') ? '_blank' : '_self';
				$link_url = get_option('options_opts_header_cta_link_custom');
				break;
		}
?>
		<a href="<?php echo esc_url($link_url); ?>" class="header-cta-btn" target="<?php echo esc_attr($link_target); ?>"><?php echo $link_text; ?> <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>
<?php 
	endif;
	
}