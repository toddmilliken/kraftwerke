<nav class="site-navigation site-navigation--fixed">
	<span id="js-navicon-close" class="site-navigation__close-btn" role="button"><?php _e('Close', 'kraftwerke'); ?> <i class="fa fa-times"></i></span>
	<?php base_social(array('title_text' => __('Follow Us', 'kraftwerke') . ':')); ?>
	<?php
	/** Displays Main Menu */
	if ( has_nav_menu('main-menu') ) :
		wp_nav_menu(array(
			'theme_location'  => 'main-menu',
			'menu'            => '',
			'container'       => '',
			'container_class' => '',
			'items_wrap' 	  	=> '<ul class="%2$s">%3$s</ul>',
			'menu_class'      => 'main-menu',
		));
	endif;
	?>
</nav>