<?php 
/**
 * Displays the queried page title and subtitle if exists. 
 *
 * @package  Kraftwerke
 * @since    1.0.0
 */
$post_id = get_the_id();

$title_props = base_page_title( array('echo' => false ) );
$title       = isset( $title_props['title'] ) ? $title_props['title'] : get_the_title( $post_id );
$subtitle    = get_post_meta( $post_id, 'int_page_subtitle', true );

?>
<div class="page-header-wrapper">
	<div class="page-header">
		<h1 class="page-title"><?php echo $title; ?></h1>
		<?php if ( ! empty( $subtitle ) ) : ?>
			<h2 class="page-subtitle"><?php echo nl2br( $subtitle ); ?></h2>
		<?php endif; ?>
	</div>
</div>