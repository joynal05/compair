<?php
/*
 * Plugin Name: FairPixels: RSS Email Subscription
 * Plugin URI: http://fairpixels.com/
 * Description: A widget to display RSS email subscription form.
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com/
 */

add_action( 'widgets_init', 'fp_subscribe_widget_init' );
function fp_subscribe_widget_init() {
	register_widget( 'fp_subscribe_widget' );
}

class fp_subscribe_widget extends WP_widget_xxx {

	function fp_subscribe_widget() {
		$widget_ops = array( 'classname' => 'widget_subscribe', 'description' => 'Displays RSS Email Subscription Form' );
		$this->WP_Widget( 'fp_subscribe_widget', 'FairPixels: RSS Email Subscription', $widget_ops);
	}
	
	function form($instance) {		
		$instance = wp_parse_args( (array) $instance, array('title' => 'Subscribe now', 'subscribe_text' => 'Get all latest content delivered to your email a few times a month.', 'feedid' => '') );

?>

	<div class="widget-field">			
		<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
		<input type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
	</div>
	
	<div class="widget-field">			
		<label for="<?php echo esc_attr( $this->get_field_id( 'subscribe_text' ) ); ?>"><?php _e('Text:', 'fairpixels'); ?></label>
		<textarea style="height:200px;" class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'subscribe_text' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'subscribe_text' ) ); ?>"><?php echo stripslashes(htmlspecialchars(( $instance['subscribe_text'] ), ENT_QUOTES)); ?></textarea>
		<p class="desc"><?php _e('If you want to display any text.', 'fairpixels'); ?></p>
	</div>
	
	<div class="widget-field">			
		<label for="<?php echo esc_attr( $this->get_field_id( 'feedid' ) ); ?>"><?php _e('Feedburner ID:', 'fairpixels'); ?></label>
		<input type="text" id="<?php echo esc_attr( $this->get_field_id('feedid') ); ?>" name="<?php echo esc_attr( $this->get_field_name('feedid') ); ?>" value="<?php echo esc_attr( $instance['feedid'] ); ?>" />
	</div>

<?php
    }

	function update($new_instance, $old_instance) {
        $instance=$old_instance;

        $instance['title'] = strip_tags($new_instance['title']);
		$instance['subscribe_text'] = $new_instance['subscribe_text'];
		$instance['feedid'] = $new_instance['feedid'];

        return $instance;

    }

	function widget($args, $instance) {
	
		extract($args);

		$title = apply_filters('widget_title', $instance['title']);
		if ( empty($title) ) $title = false;
		
		$feedid = $instance['feedid'];
		$subscribe_text = $instance['subscribe_text'];	
		
		echo $before_widget;
	
		if ( $title ) {
			echo $before_title . esc_html( $title ) . $after_title;
		}
		
       if( $subscribe_text ){ ?>
		
				<p>
					<?php 
						$allowed_html = fp_get_allowed_html_tags(); 
						echo wp_kses($subscribe_text, $allowed_html);
					?>
				</p>							
		<?php } ?>
		
		<form class="widget_rss_subscription" action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr( $feedid ) ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
			<input type="text" placeholder="Your email" name="email"/>
			<input type="hidden" value="<?php echo esc_attr( $feedid ); ?>" name="uri"/>
			<input type="hidden" name="loc" value="en_US"/>
			<button type="submit" class="sub-button" value="Subscribe"><i class="fa fa-envelope"></i></button>
		</form>
        
		<?php	
			
		echo $after_widget;
		
	}

}
?>