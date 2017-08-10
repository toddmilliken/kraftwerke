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
			
			// Date
			$meta[] = '<time datetime="' . get_the_date( 'Y-m-d H:i', $post_id ) . '">' . get_the_date( 'm.d.y', $post_id ) . '</time>';
			
			// Author
			$author_id = get_post_field( 'post_author', $post_id );
			$meta[] = '<a href="' . get_author_posts_url( $author_id ) . '">' . get_the_author_meta( 'display_name',  $author_id ) . '</a>';

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
function kwer_media_block( $args = array() ) {

	/** Default arguments */
	$default_args = array(
		'title'       => false ,
		'excerpt'     => false ,
		'img_id'      => false , 
		'link_target' => '_self' ,
		'link_text'   => 'Read More' ,
		'link_url'    => false ,
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
	 
	$html .= '
		<div class="block-media__body">' . 
			( $args['title'] ? '<h3 class="block-media__title">' . $args['title'] . '</h3>' : '' ) . 
			( $args['excerpt'] ? '<div class="block-media__excerpt">' . $args['excerpt'] . '</div>' : '' ) .
			( $args['link_url'] ? '<a href="' . esc_url( $args['link_url'] ) . '" target="' . esc_attr( $args['link_target'] ) . '" class="block-media__link more">' . $args['link_text'] . '</a>' : '' ) . '
		</div>
	';
	$html .= '</div>';
	
	
	if ( $args['echo'] ) {
		echo $html;
	} else {
		return $html;
	}	
	
}



