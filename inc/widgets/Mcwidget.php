<?php class Post extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
			'post_widget', // Base ID
			__('Post', 'Homehouse'), // Name
			array( 'description' => __( 'A post selection widget.', 'Homehouse' ), ) // Args
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', $instance['title'] );

		echo $args['before_widget'];
		if ( ! empty( $title ) )
			echo $args['before_title'] . $title . $args['after_title'];
		echo __( 'Hello, World!', 'text_domain' );
		echo $args['after_widget'];


		//GRID SHIT
		$the_sidebars = wp_get_sidebars_widgets();
		$widget_count = count( $the_sidebars['primary'] );

		switch ($widget_count){
			case 1:
			$out = '<div class="column col-full pad">';
			break;
			case 2:
			$out = '<div class="column col-1-2 pad">';
			break;
			case 3:
			$out = '<div class="column col-1-3 pad">';
			break;
			case 4:
			$out = '<div class="column col-1-2 pad">';
			break;
		}
		$widget_post = get_field('selected_post', 'widget_' .$args['widget_id']);
		$url = wp_get_attachment_url( get_post_thumbnail_id($widget_post->ID) );

		$out .= '<div class="rect bg"  style="background-image:url('. $url .')">';
		$out .= '<div class="valign">';
		$title = get_field('title', 'widget_' .$args['widget_id']);
		$out .= '<h3 class="large title">' . $title . '</h3>';
		$rows = get_field('buttons', 'widget_' .$args['widget_id']);
		foreach ($rows as $row) {
			$out .= '<button class="small primary button">'. $row['button'] . '</button>';
		}
		$out .= '</div>';
		$out .= '</div>';
		$out .= '</div>';

		echo $out;
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'text_domain' );
		}
	?>
		<p>
		<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
	<?php
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}
}

register_widget('Post');