<?php
/**
 * Plugin Name: FairPixels: Recent Comments
 * Plugin URI: http://fairpixels.com/
 * Description: This widhet displays the recent comments with thumbnails.
 * Version: 1.0
 * Author: FairPixels
 * Author URI: http://fairpixels.com/
 *
 */

/**
 * Add function to widgets_init that'll load our widget.
 */
add_action( 'widgets_init', 'fp_recent_comments_widget_init' );

function fp_recent_comments_widget_init() {
	register_widget( 'fp_recent_comments_widget' );
}

/**
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 */
class fp_recent_comments_widget extends WP_widget {

	/**
	 * Widget setup.
	 */
	function __construct() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widget_comments', 'description' => __('Displays the recent comments with thumbnails.', 'fairpixels') );

		/* Create the widget. */
		parent::__construct( 'fp_recent_comments_widget', __('FairPixels: Recent Comments', 'fairpixels'), $widget_ops);
	}

	/**
	 * display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		
		extract( $args );
	    $title = apply_filters('widget_title', $instance['title'] );
		echo $before_widget;
		
		if ( $title ) {
			echo $before_title . esc_html( $title ) . $after_title;
		}
  
       ?>
       <?php
	   $entries_display = $instance['entries_display']; ?>
	    <ul class="list comment-list">
			<?php 
				//get recent comments
				$args = array(
					   'status' => 'approve',
						'number' => $entries_display
					);	
				
				$postcount=0;
				$comments = get_comments($args);
				
				foreach($comments as $comment) :
						$postcount++;								
						$commentcontent = strip_tags($comment->comment_content);			
						if (strlen($commentcontent)> 50) {
							$commentcontent = mb_substr($commentcontent, 0, 69) . "...";
						}
						$commentauthor = $comment->comment_author;
						if (strlen($commentauthor)> 30) {
							$commentauthor = mb_substr($commentauthor, 0, 29) . "...";			
						}
						$commentid = $comment->comment_ID;
						$commenturl = get_comment_link($commentid); 
						//$commentdate = get_comment_date( '', $commentid );
						?>
					   <li>
							<div class="thumbnail">
								<?php echo get_avatar( $comment, '60' ); ?>
							</div>
							<div class="post-right">
								<div class="comment-author"><h6><?php echo esc_html( $commentauthor ); ?></h6></div>
								<div class="comment-text">
									<a <?php if($postcount==1) { ?> class="first" <?php } ?> href="<?php echo esc_url( $commenturl ); ?>"><?php echo esc_html( $commentcontent ); ?></a>
								</div>								
							</div>
						</li>
			<?php endforeach; ?>
		</ul>
		
	   <?php
		
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {
		$defaults = array('title' => 'Recent Comments', 'entries_display' => 5);
		$instance = wp_parse_args((array) $instance, $defaults);
	?>
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e('Title:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</div>
		
		<div class="widget-field">			
			<label for="<?php echo esc_attr( $this->get_field_id( 'entries_display' ) ); ?>"><?php _e('Number:', 'fairpixels'); ?></label>
			<input type="text" id="<?php echo esc_attr( $this->get_field_id('entries_display') ); ?>" name="<?php echo esc_attr( $this->get_field_name('entries_display') ); ?>" value="<?php echo esc_attr( $instance['entries_display'] ); ?>" />
			<p class="desc"><?php _e('Enter the number of comments you want to display', 'fairpixels'); ?></p>
		</div>
		
	<?php
	}
}
?>