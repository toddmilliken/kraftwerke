<?php
/**
 * Kwer_Widget_Hours
 *
 * Displays company hours of operation. 
 *
 * @package  Kraftwerke
 * @since    1.0.0
 */

class Kwer_Widget_Hours extends WP_Widget
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
		
		$this->widget_id = 'kwer-hours';
		
		$this->widget_name = __('Hours of Operation', 'kraftwerke');
		
		$this->widget_ops = array(
			'description' => 'Displays days of the week and the hours open for business.',
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
				'name' => 'description',
				'label' => __('Description', 'kraftwerke'),
				'type' => 'textarea',
			),
		);
		
		parent::__construct($this->widget_id, $this->widget_name, $this->widget_ops, $this->control_ops);
	}
	
	public function widget($args, $instance)
	{
		// Extract arguments and define parts
		extract($args);
		$title          = !empty($instance['title']) ? $instance['title'] : false;
		$description    = !empty($instance['description']) ? $instance['description'] : false;
		$hours_repeater = get_option( 'options_opts_hours_operation' );
		$data           = array();
		if ( ! empty( $hours_repeater ) ) { 
			for ( $i=0; $i < $hours_repeater; $i++ ) { 
				$day   = get_option( 'options_opts_hours_operation_' . $i . '_day' );
				$hours = get_option( 'options_opts_hours_operation_' . $i . '_hours' );
				$data[] = array(
					'day'   => $day ,
					'hours'	=> $hours
				);
			}
		}
		
		// Build widget HTML
		$html  = $before_widget;
		if ( !empty($title) ) {
			$html .= $before_title . $title . $after_title;
		}
		if ( !empty($description) ) {
			$html .= '<p>' . sanitize_text_field( nl2br( $description ) ) . '</p>';
		}
		$html .= '
			<table class="hours-of-operation">
				<tbody>
					
		';
		if ( !empty( $data ) ) {
			foreach ( $data as $entry ) {
				$html .= '
					<tr>
						<td class="hours-of-operation__day">' . $entry['day'] . '</td>
						<td class="hours-of-operation__hours">' . $entry['hours'] . '</td>
					</tr>
				';
			}
		}
		$html .= '
				</tbody>
			</table>
		';
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