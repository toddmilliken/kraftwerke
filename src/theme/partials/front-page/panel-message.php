<?php
$panel_headline  = get_post_meta( $post_id, 'panel_headline', true );
$panel_desc      = get_post_meta( $post_id, 'panel_description', true );
$panel_link      = get_post_meta( $post_id, 'panel_link', true );
$panel_link_text = get_post_meta( $post_id, 'panel_link_text', true );

$panel_messaging = '';
if ( !empty($panel_headline) ) {
	$panel_messaging .= '<h1 class="panel__headline">' . nl2br($panel_headline) . '</h1>';
}
if ( !empty($panel_desc) ) {
	$panel_messaging .= '<p class="panel__description">' . nl2br($panel_desc) . '</p>';
}
if ( !empty($panel_link) && !empty($panel_link_text) ) {
	$panel_messaging .= '<span class="panel__link more">' . $panel_link_text . '</span>';
}

if ( !empty($panel_link) ) {
	$panel_messaging = '<a class="panel__link-wrapper" href="' . get_permalink( $panel_link ) . '">' . $panel_messaging . '</a>';
}

echo '<div class="panel__message">' . $panel_messaging . '</div>';