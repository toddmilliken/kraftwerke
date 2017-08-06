<?php

/**
 * Defines the ACF fields used on the Options page.
 *
 * @link       www.kraftwerke1.com
 * @since      1.0.0
 *
 * @package    Kwer_Options
 * @subpackage Kwer_Options/admin/partials
 */

$options = array (
	'key' => 'kwer_options',
	'title' => 'Site Options',
	'fields' => array (
		array (
			'key' => 'field_56a90abad1b8d',
			'label' => 'General',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array (
			'key' => 'field_56a90b08edb44',
			'label' => 'Footer Copy',
			'name' => 'opts_footer',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 0,
		),
		array (
			'key' => 'field_56a90b29edb45',
			'label' => 'Fallback Masthead Image',
			'name' => 'opts_masthead',
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
			'key' => 'field_56a90ad1d1b8f',
			'label' => 'Utilities',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array (
			'key' => 'field_59861c1c66feb',
			'label' => 'Phone Number',
			'name' => 'opts_phone',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '888.888.8888',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array (
			'key' => 'field_59861c4266fec',
			'label' => 'Add Header Button',
			'name' => 'opts_is_header_cta',
			'type' => 'true_false',
			'instructions' => 'Adds a button link to the top right of the header.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => '',
			'default_value' => 0,
			'ui' => 1,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array (
			'key' => 'field_59861c6e66fed',
			'label' => 'Button Text',
			'name' => 'opts_header_cta_text',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_59861c4266fec',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'Example: "Schedule Service", "Contact Us", etc.',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
		),
		array (
			'key' => 'field_59861ca466fee',
			'label' => 'Button Link Type',
			'name' => 'opts_header_cta_link_type',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_59861c4266fec',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'internal' => 'Internal',
				'custom' => 'Custom URL',
			),
			'allow_null' => 0,
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'internal',
			'layout' => 'horizontal',
			'return_format' => 'value',
		),
		array (
			'key' => 'field_59861cd266fef',
			'label' => 'Button Link',
			'name' => 'opts_header_cta_link_internal',
			'type' => 'page_link',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_59861c4266fec',
						'operator' => '==',
						'value' => '1',
					),
					array (
						'field' => 'field_59861ca466fee',
						'operator' => '==',
						'value' => 'internal',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array (
			),
			'taxonomy' => array (
			),
			'allow_null' => 0,
			'allow_archives' => 1,
			'multiple' => 0,
		),
		array (
			'key' => 'field_59861cef66ff1',
			'label' => 'Button Link',
			'name' => 'opts_header_cta_link_custom',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_59861c4266fec',
						'operator' => '==',
						'value' => '1',
					),
					array (
						'field' => 'field_59861ca466fee',
						'operator' => '==',
						'value' => 'custom',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'http://www.google.com',
		),
		array (
			'key' => 'field_59861d1266ff2',
			'label' => 'Button Link Target',
			'name' => 'opts_header_cta_link_target',
			'type' => 'true_false',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_59861c4266fec',
						'operator' => '==',
						'value' => '1',
					),
					array (
						'field' => 'field_59861ca466fee',
						'operator' => '==',
						'value' => 'custom',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'Open in a new window/tab',
			'default_value' => 0,
			'ui' => 0,
			'ui_on_text' => '',
			'ui_off_text' => '',
		),
		array (
			'key' => 'field_598696ce92252',
			'label' => 'Hours of Operation',
			'name' => 'opts_hours_operation',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => 0,
			'max' => 0,
			'layout' => 'table',
			'button_label' => 'Add Day',
			'sub_fields' => array (
				array (
					'key' => 'field_5986977a92253',
					'label' => 'Day',
					'name' => 'day',
					'type' => 'text',
					'instructions' => '',
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
				),
				array (
					'key' => 'field_598697a092254',
					'label' => 'Hours Open',
					'name' => 'hours',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '00:00 - 00:00',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
				),
			),
		),
		array (
			'key' => 'field_56a90b68edb47',
			'label' => 'Social Media',
			'name' => 'opts_social_media',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => '',
			'max' => '',
			'layout' => 'row',
			'button_label' => 'Add Social Media Option',
			'sub_fields' => array (
				array (
					'key' => 'field_56a90b8cedb48',
					'label' => 'Social Media Type',
					'name' => 'opts_sm_type',
					'type' => 'select',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'choices' => array (
						'blog' => 'Blog',
						'email' => 'Email',
						'fb' => 'FaceBook',
						'g' => 'Google+',
						'ig' => 'Instagram',
						'li' => 'LinkedIn',
						'rss' => 'RSS',
						'pt' => 'Pintrest',
						'tw' => 'Twitter',
						'vm' => 'Vimeo',
						'yp' => 'Yelp',
						'yt' => 'YouTube',
					),
					'default_value' => array (
					),
					'allow_null' => 0,
					'multiple' => 0,
					'ui' => 0,
					'ajax' => 0,
					'placeholder' => '',
					'disabled' => 0,
					'readonly' => 0,
				),
				array (
					'key' => 'field_56a90c04edb49',
					'label' => 'Social Media URL',
					'name' => 'opts_sm_url',
					'type' => 'url',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => '',
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
				),
			),
		),
		array (
			'key' => 'field_56a90ad5d1b91',
			'label' => 'SEO',
			'name' => 'seo',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array (
			'key' => 'field_56a90cefedb52',
			'label' => 'Exclude from Site Search',
			'name' => 'opts_exclude_posts',
			'type' => 'relationship',
			'instructions' => 'Select the pages and posts to hide from Wordpress search engine.',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'post_type' => array (
				0 => 'post',
				1 => 'page',
			),
			'taxonomy' => array (
			),
			'filters' => array (
				0 => 'search',
				1 => 'post_type',
				2 => 'taxonomy',
			),
			'elements' => '',
			'min' => '',
			'max' => '',
			'return_format' => 'object',
		),
		array (
			'key' => 'field_56a90d59edb55',
			'label' => 'Page Not Found Text',
			'name' => 'opts_404_text',
			'type' => 'wysiwyg',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'tabs' => 'all',
			'toolbar' => 'full',
			'media_upload' => 1,
		),
		array (
			'key' => 'field_56d07b077df65',
			'label' => 'Tracking Scripts',
			'name' => '',
			'type' => 'tab',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'placement' => 'top',
			'endpoint' => 0,
		),
		array (
			'key' => 'field_56d07b157df66',
			'label' => 'Google Tracking Scripts',
			'name' => 'opts_is_google_tracking',
			'type' => 'true_false',
			'instructions' => 'Enables Google Tag Manager or Google Analytics',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'Yes, Add Google Tracking Scripts',
			'default_value' => 0,
		),
		array (
			'key' => 'field_56d07bbb7df67',
			'label' => 'Choose Google Service',
			'name' => 'opts_google_service',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56d07b157df66',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'tag-manager' => 'Google Tag Manager',
				'analytics' => 'Google Analytics',
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => '',
			'layout' => 'horizontal',
		),
		array (
			'key' => 'field_56d07c487df68',
			'label' => 'Google Tag Manager ID',
			'name' => 'opts_google_tag_manager_id',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56d07b157df66',
						'operator' => '==',
						'value' => '1',
					),
					array (
						'field' => 'field_56d07bbb7df67',
						'operator' => '==',
						'value' => 'tag-manager',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => 'GTM-XXXXXX',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_5384d56a4f1ae',
			'label' => 'Use Google Analytics Classic',
			'name' => 'opts_ga_classic',
			'type' => 'true_false',
			'message' => '',
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56d07b157df66',
						'operator' => '==',
						'value' => '1',
					),
					array (
						'field' => 'field_56d07bbb7df67',
						'operator' => '==',
						'value' => 'analytics',
					),
				),
			),
			'default_value' => 0,
		),
		array (
			'key' => 'field_5384d5484f1ad',
			'label' => 'Google Analytics ID',
			'name' => 'opts_ga_id',
			'type' => 'text',
			'default_value' => '',
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56d07b157df66',
						'operator' => '==',
						'value' => '1',
					),
					array (
						'field' => 'field_56d07bbb7df67',
						'operator' => '==',
						'value' => 'analytics',
					),
				),
			),
			'placeholder' => 'UA-XXXXX-Y',
			'prepend' => '',
			'append' => '',
			'formatting' => 'html',
			'maxlength' => '',
		),
		array (
			'key' => 'field_5384d5844f1af',
			'label' => 'Google Analytics Domain',
			'name' => 'opts_ga_domain',
			'type' => 'text',
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56d07b157df66',
						'operator' => '==',
						'value' => '1',
					),
					array (
						'field' => 'field_56d07bbb7df67',
						'operator' => '==',
						'value' => 'analytics',
					),
					array (
						'field' => 'field_5384d56a4f1ae',
						'operator' => '!=',
						'value' => '1',
					),
				),
			),
			'instructions' => 'There are three modes to this method: "auto", "none", or "yourdomain.com". By default, this method is set to auto.',
			'default_value' => 'auto',
			'placeholder' => 'auto',
			'prepend' => '',
			'append' => '',
			'formatting' => 'html',
			'maxlength' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'options_page',
				'operator' => '==',
				'value' => 'acf-options',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => '',
);

$options = apply_filters( 'kwer_options_filter_site_fields', $options );

acf_add_local_field_group( $options );