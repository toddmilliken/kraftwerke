<?php 
/**
 * Displays the section header graphic. 
 *
 * If no masthead exists for the current post, find the masthead from the
 * nearest ancestor. If still no masthead from ancestors, use fallback masthead
 * set in Site Options. 
 *
 * @package Base_Theme
 * @since 0.7.0
 */
 
$post_id  = get_the_id();
$masthead_attachment_id = get_post_meta( $post_id, 'int_masthead_image', true );
$has_breadcrumbs = kwer_has_breadcrumbs($post->ID);
if ( !$masthead_attachment_id && ($ancestors = get_post_ancestors($post_id)) ) :
	
	foreach ( $ancestors as $a ) :
		if ( $has_masthead_image = get_post_meta( $a, 'int_masthead_image', true ) ) :
			$masthead_attachment_id = $has_masthead_image;
			break;
		endif;
	endforeach;
	
endif;
	
//! IF THERE IS STILL NO MASTHEAD IMAGE USE THE FALLBACK IMAGE DEFINED IN OPTIONS
if ( !$masthead_attachment_id || is_search() || is_404() ) $masthead_attachment_id = get_option('options_opts_masthead'); 

$masthead_alt         = get_post_meta( $masthead_attachment_id, '_wp_attachment_image_alt', true);
$masthead_desktop_url = wp_get_attachment_image_url( $masthead_attachment_id, 'masthead' );
$masthead_mobile_url  = wp_get_attachment_image_url( $masthead_attachment_id, 'masthead-mobile' );
?>

<section class="masthead<?php echo ( $has_breadcrumbs ? ' masthead--has-breadcrumbs' : ''); ?>">
	<div class="masthead__flex-parent">
		<div class="masthead__flex-child inner">
			<?php get_template_part('partials/page-header'); ?>
			<?php if ( function_exists('yoast_breadcrumb') && $has_breadcrumbs ) : ?>
				<?php yoast_breadcrumb('<div class="masthead__breadcrumbs"><div class="breadcrumbs">','</div></div>'); ?>
			<?php endif; ?>
		</div>
	</div>
	<?php if ( !empty($masthead_desktop_url) ) : ?>
	<div class="frame frame--cover frame--dark">
		<picture>
			<source media="(min-width: 641px)" data-original-set="<?php echo esc_url($masthead_desktop_url); ?>" />
			<img class="frame__media" alt="<?php echo esc_attr($masthead_alt); ?>" data-original="<?php echo esc_url($masthead_mobile_url); ?>">
		</picture>
	</div>
	<?php endif; ?>
</section>