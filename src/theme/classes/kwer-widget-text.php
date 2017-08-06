<?php
/**
 * Kwer_Widget_Text
 *
 * Displays a description with link to learn more.
 *
 * @package  Kraftwerke
 * @since    1.0.0
 */

class Kwer_Widget_Text extends WP_Widget
{
	/**
	 * Root ID for all widgets of this type.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     string
	 */
	public $widget_id;
	
	
	/**
	 * Name for this widget type.
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     string
	 */
	public $widget_name;	
	
	
	/**
	 * Option array passed to wp_register_sidebar_widget().
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     array
	 */
	public $widget_ops;
	
	
	/**
	 * Option array passed to wp_register_widget_control().
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     array
	 */
	public $control_ops;
	
	
	/**
	 * Fields used in this widget
	 *
	 * @since   1.0.0
	 * @access  public
	 * @var     array
	 */
	public $fields;
	
	
	
	/**
	 * Constructor
	 *
	 * @since   1.0.0
	 */
	public function __construct()
	{
		
		$this->widget_id = 'kwer-text';
		
		$this->widget_name = __('Text with Link', 'kraftwerke');
		
		$this->widget_ops = array(
			'description' => 'Arbitrary text with a styled link.',
		);
		
		$this->control_ops = array(
			'width' => 430,
			'height' => 420,
		);
	
		$this->fields = array(
			array(
				'name' => 'title',
				'label' => __('Title', 'kraftwerke'),
				'type' => 'text',
			),
			array(
				'name' => 'display_title',
				'label' => __('Display Title', 'kraftwerke'),
				'type' => 'text',
			),
			array(
				'name' => 'description',
				'label' => __('Description', 'kraftwerke'),
				'type' => 'textarea',
			),
			array(
				'name' => 'link_text',
				'label' => __('Link Text', 'kraftwerke'),
				'type' => 'text',
			),
			array(
				'name' => 'cta_link',
				'label' => __('Internal Link', 'kraftwerke'),
				'type' => 'select',
				'items' => array('' => __('Choose One', 'kraftwerke')),
			),
			array(
				'name' => 'cta_external_link',
				'label' => __('External Link', 'kraftwerke'),
				'type' => 'text',
			),
		);
		
		parent::__construct($this->widget_id, $this->widget_name, $this->widget_ops, $this->control_ops);
	}
	
	public function widget($args, $instance)
	{
		// Extract arguments and define parts
		extract($args);
		$title       = !empty($instance['display_title']) ? $instance['display_title'] : false;
		$description = !empty($instance['description']) ? $instance['description'] : false;
		$is_external = !empty($instance['cta_external_link']) ? true : false;
		$link_target = $is_external ? '_blank' : '_self';
		$link_text   = !empty( $instance['link_text'] ) ? $instance['link_text'] : __('Learn More', 'kraftwerke');
		$link_url    = false;
		if ( $is_external ) {
			$link_url = !empty( $instance['cta_external_link'] ) ? $instance['cta_external_link'] : false;
		} else {
			$link_url = !empty( $instance['cta_link'] ) ? get_permalink($instance['cta_link']) : false;
		}
		
		// Build widget HTML
		$html  = $before_widget;
		if ( !empty($title) ) {
			$html .= $before_title . $title . $after_title;
		}
		$html .= '<div class="textwidget">';
		if ( !empty($description) ) {
			$html .= '<p>' . sanitize_text_field( nl2br( $description ) ) . '</p>';
		}
		if ( !empty($link_url) ) {
			$html .= '<p><a class="more" href="' . $link_url . '" target="' . $link_target . '">' . $link_text . '</a></p>';
		}
		$html .= '</div>';
		$html .= $after_widget;
		
		// Echo widget HTML
		echo $html;
		
	}
	
	
	/**
	 * Update widget settings on save
	 *
	 * @since    1.0.0
	 */

	
	
	/**
	 * Display widget fields
	 *
	 * @since    1.0.0
	 */
	public function form( $instance )
	{	
		
		$widget = explode('-', $this->id);
		
		// Get Pages
		$pages = get_pages( array(
			'sort_order'  => 'ASC',
			'sort_column' => 'menu_order',
			'post_type'   => 'page',
			'post_status' => 'publish'
		) ); 
		
		// Loop through all pages, adding them to dropdown for internal link.
		foreach ( $pages as $page ) {
			
			if ( $page->post_parent != 0 ) {
				$page_title = '-' . $page->post_title;
			} else  {
				$page_title = $page->post_title;
			}
			
			$this->fields[4]['items'][$page->ID] = $page_title;
			
		}
		
		// Display interface for each field
		foreach ( $this->fields as $field )
		{
			
			$field['value'] = isset($instance[$field['name']]) ? $instance[$field['name']] : '';
			$field['id'] = $this->get_field_id($field['name']);
			$field['name'] = $this->get_field_name($field['name']);
			$field['widget_name'] = get_called_class();
			$field['widget_id'] = $widget[1] == '__i__' ? 'Save to Generate an ID' : $widget[1];
			
			
			switch ( $field['type'] ) {
				case 'select' :
					echo '<p>';
					echo '<label for="' . $field['id'] . '">' . _($field['label']) . '</label><br />';
					echo '<select name="' . $field['name'] . '" id="' . $field['id'] . '">';
							
					foreach ( (array) $field['items'] as $val => $label )
					{
						if ( !is_array($label) )
						{
							echo '<option value="' . $val . '"' . ($val == $field['value'] ? ' selected' : '') . '>' . _($label) . '</option>';
						} else {
							echo '<optgroup label="' . $val . '">';
							foreach ( $label as $value => $text ) {
								echo '<option value="' . $value . '"' . ($value == $field['value'] ? ' selected' : '') . '>' . _($text) . '</option>';
							}
							echo '</optgroup>';
						}
					}
					
					echo '</select>';
					echo '</p>';
					break;
				case 'text' :
					echo '<p>';
					echo '<label for="' . $field['id'] . '">' . _($field['label']) . '</label><br />';
					echo '<input class="widefat" type="text" name="' . $field['name'] . '" id="' . $field['id'] .'" value="' . (isset($field['value']) ? $field['value'] : '') . '" />';
					echo '</p>';
					break;
				case 'textarea' :
					echo '<p>';
					echo '<label for="' . $field['id'] . '">' . _($field['label']) . '</label><br />';
					echo '<textarea class="widefat" rows="3" name="' . $field['name'] . '" id="' . $field['id'] .'">' . (isset($field['value']) ? $field['value'] : '') . '</textarea>';
					echo '</p>';
					break;
			}

		}

	}
}