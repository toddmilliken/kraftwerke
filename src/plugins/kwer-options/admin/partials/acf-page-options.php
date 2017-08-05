<?php

/**
 * Defines the ACF fields used on the Pages edit screen.
 *
 * @link       www.kraftwerke1.com
 * @since      1.0.0
 *
 * @package    Kwer_Options
 * @subpackage Kwer_Options/admin/partials
 */
 
 
/** Stores default page option ACF fields from the base theme */
$base_fields = array(
	array (
		'key' => 'field_56a9071fbd3a6',
		'label' => 'Alternative Page Title',
		'name' => 'int_alt_page_title',
		'type' => 'text',
		'instructions' => 'This is used in place of the page title for the heading 1.',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'default_value' => '',
		'placeholder' => '',
		'prepend' => '',
		'append' => '',
		'maxlength' => '',
		'readonly' => 0,
		'disabled' => 0,
	),
	array (
		'key' => 'field_56a907b7bd3a9',
		'label' => 'Masthead Image',
		'name' => 'int_masthead_image',
		'type' => 'image',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'return_format' => 'array',
		'preview_size' => 'medium',
		'library' => 'all',
		'min_width' => '',
		'min_height' => '',
		'min_size' => '',
		'max_width' => '',
		'max_height' => '',
		'max_size' => '',
		'mime_types' => '',
	),
	array (
		'key' => 'field_56a9075dbd3a7',
		'label' => 'Masthead Text Color',
		'name' => 'int_masthead_color',
		'type' => 'radio',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array (
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'choices' => array (
			'dark' => 'Dark',
			'light' => 'Light',
		),
		'other_choice' => 0,
		'save_other_choice' => 0,
		'default_value' => '',
		'layout' => 'horizontal',
	),
);


/**
 * Filters $base_fields. Allows child theme developers to modify defaults. 
 *
 * @since 1.0.0
 */
$page_option_fields = apply_filters( 'kwer_options_filter_page_fields', $base_fields );


$locations = array (
	array (
		array (
			'param' => 'page_type',
			'operator' => '!=',
			'value' => 'front_page',
		),
		array (
			'param' => 'page_template',
			'operator' => '!=',
			'value' => 'tmpl-landing-page.php',
		),
	),
);
$locations = apply_filters( 'kwer_options_filter_page_locations', $locations );
		
$page_options = array(		
	'key' => 'kwer_page_options',
	'title' => 'Page Options',
	'fields' => $page_option_fields ,
	'location' => $locations ,
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
);

acf_add_local_field_group( $page_options );