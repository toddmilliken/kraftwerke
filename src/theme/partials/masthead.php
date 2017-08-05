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
 
$masthead = get_field('int_masthead_image');

if ( !$masthead && ($ancestors = get_post_ancestors($post)) ) :
	
	foreach ( $ancestors as $a ) :
		if ( $has_masthead_image = get_field('int_masthead_image', $a) ) :
			$masthead = $has_masthead_image;
			break;
		endif;
	endforeach;
	
endif;
	
//! IF THERE IS STILL NO MASTHEAD IMAGE USE THE FALLBACK IMAGE DEFINED IN OPTIONS
if ( !$masthead || is_search() || is_404() ) $masthead = get_field('opts_masthead', 'option'); 
	
?>

<section class="masthead">
	<div class="masthead__flex-parent">
		<div class="masthead__flex-child inner">
			<?php get_template_part('partials/page-header'); ?>
			<?php if ( function_exists('yoast_breadcrumb') ) : ?>
				<div class="masthead__breadcrumbs">
					<?php yoast_breadcrumb('<div class="breadcrumbs">','</div>'); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="frame frame--cover">
		<picture>
			<source media="(min-width: 641px)" data-original-set="<?php echo $masthead['sizes']['masthead']; ?>" />
			<img class="frame__media" alt="<?php echo $masthead['alt']; ?>" data-original="<?php echo $masthead['sizes']['masthead-mobile']; ?>">
		</picture>
	</div>
</section>