<?php 
/**
 * The template for displaying the header
 *
 * Displays the head element and the "site-header" element
 *
 * @package Base_Theme
 * @since 0.7.0
 */
header('X-UA-Compatible: IE=edge,chrome=1'); ?>
<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<title><?php wp_title(''); ?></title>
	<link rel="sitemap" href="<?php echo home_url('sitemap_index.xml'); ?>" />
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php
	/**
	 * Fires immediately after the opening "body" tag
	 *
	 * @since 0.7.0
	 */
	do_action('base_after_body_open');
	
	/** Calls the site navigation partial */
	get_template_part( 'partials/site-navigation' );
	
	/**
	 * Site wrapper - open 
	 */
	kwer_wrapper_open();
	?>
		<header id="js-site-header" class="site-header site-header--fixed" role="banner">
			<div class="site-header__left">			
				<button id="js-navicon" class="navicon no-button-style" href="javascript:;">
					<div class="navicon__trigger"></div>
					<div class="navicon__text" data-menu="Menu" data-close="Close">Menu</div>
				</button>
			</div>
			<div class="site-header__right">
				<div id="js-site-search" class="site-header__search-btn">
					<i class="fa fa-search" aria-hidden="true"></i>
				</div>
				<div class="site-header__callouts">
					<div class="header-phone"><strong>Phone</strong>: 888.888.8888</div>
					<a href="#" class="header-cta-btn">Schedule Service <i class="fa fa-long-arrow-right" aria-hidden="true"></i></a>	
				</div>
			</div>
			<a href="#" class="custom-logo-link">
				<div class="logo-text" href="http://staging.kraftwerke1.com">Kraftwerke<sup>&reg;</sup></div>
			</a>
			<div id="js-search-container" class="site-search">
				<div class="inner">
					<form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
						<div class="search-inner">
							<input placeholder="<?php _e( 'Search', 'kraftwerke' ); ?>" type="text" name="s" class="search-input">
							<button type="submit" class="search-button" value=""><i class="fa fa-search" aria-hidden="true"></i></button>
						</div>
					</form>
				</div>
			</div>
		</header>
		<?php
		/**
		 * Fires immediately after the closing "header" tag
		 *
		 * @since 0.7.0
		 */
		do_action('base_after_header_close');
		?>