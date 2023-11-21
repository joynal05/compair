<?php
session_start();
/**
 * Template Name: Contact 
 * Description: A Page Template to display contact form with captcha and jQuery validation.
 *
 * @package  WordPress
 * @file     page-contact.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
 
	$name_error = '';
	$email_error = '';
	$message_error = '';
	$captcha_error = '';
						
if(isset($_POST['fp_submit'])) {

		//validate sender name
		if(trim($_POST['sender_name']) === '') {
			$name_error = 'Please enter your name.';
			$has_error = true;
		} else {
			$name = trim($_POST['sender_name']);
		}
		
		//validate sender email
		if(trim($_POST['sender_email']) === '')  {
			$email_error = 'Please enter your email address.';
			$has_error = true;
		} else if (!preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", trim($_POST['sender_email']))){
			$email_error = 'Please enter a valid email address.';
			$has_error = true;
		} else {
			$email = trim($_POST['sender_email']);
		}
		
		//validate message
		if(trim($_POST['message_text']) === '') {
			$message_error = 'Please enter a message.';
			$has_error = true;
		} else {
			if(function_exists('stripslashes')) {
				$message = stripslashes(trim($_POST['message_text']));
			} else {
				$message = trim($_POST['message_text']);
			}
		}

		//validate captcha
		if(trim($_POST['capt_field']) != '') {
			$has_error = true;
		}		
		
		//if no error, send email.
		if(!isset($has_error)) {
			
			$email_to = fp_get_settings('fp_contact_email');		
			$subject = fp_get_settings('fp_contact_subject');	
			
			if (!isset($email_to) || ($email_to == '') ){
				$email_to = get_option('admin_email');				
			}
			
			if (!isset($subject) || ($subject == '') ){
				$subject = 'Contact Message From '.$name;			
			}

			$body = "Name: $name \n\nEmail: $email \n\nComments: $message";
			$headers = 'From: '.$name.' <'.$email_to.'>' . "\r\n" . 'Reply-To: ' . $email;
			
			mail($email_to, $subject, $body, $headers);
			$email_sent = true;
		}
	
	} 

?>

<?php get_header(); ?>

	<script type="text/javascript">
	<!--//--><![CDATA[//><!--
		jQuery(document).ready(function() {
			jQuery('form#fp_contact_form').submit(function() {
			jQuery('form#fp_contact_form .error').remove();
			var hasError = false;
			jQuery('.requiredField').each(function() {
			if(jQuery.trim(jQuery(this).val()) == '') {
									
					if(jQuery(this).hasClass('name_field')) {
						jQuery(this).parent().append('<span class="error"><?php _e('Please enter your name.', 'fairpixels'); ?></span>');
					}
					
					if(jQuery(this).hasClass('title_field')) {
						jQuery(this).parent().append('<span class="error"><?php _e('Please enter message title.', 'fairpixels'); ?></span>');
					}
					
					if(jQuery(this).hasClass('email')) {
						jQuery(this).parent().append('<span class="error"><?php _e('Please enter your email.', 'fairpixels'); ?></span>');
					}
					
					if(jQuery(this).hasClass('message_field')) {
						jQuery(this).parent().append('<span class="error"><?php _e('Please enter your message.', 'fairpixels'); ?></span>');
					}
									
					jQuery(this).addClass('inputError');
					hasError = true;
				} else if(jQuery(this).hasClass('email')) {
					var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
					if(!emailReg.test(jQuery.trim(jQuery(this).val()))) {
						jQuery(this).parent().append('<span class="error"><?php _e('Please enter valid email', 'fairpixels'); ?> </span>');
						jQuery(this).addClass('inputError');
						hasError = true;
					}
				}
			});
						
			if(hasError) {
				return false;
			} else{
				return true;
			}						
			});
		});
	//-->!]]>
	</script>	
	
	<div id="content" class="contact-page">
			<div class="entry-header">
				<h1><?php the_title(); ?></h1>			
			</div>
			
			<?php $fp_contact_address = fp_get_settings( 'fp_contact_address' );	
			if ($fp_contact_address){ ?>
				<div class="contact-map">
					<iframe width="100%" scrolling="no" height="270" frameborder="0" src="		https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=<?php echo urlencode($fp_contact_address); ?>&amp;z=10&amp;iwloc=near&amp;output=embed" marginwidth="0" marginheight="0"></iframe>
				</div><!--/map -->
			<?php } ?>
		
			<div class="entry-content page-content">		
				<?php while ( have_posts() ) : the_post(); ?>			
					<?php the_content(); ?>			
				<?php endwhile; ?>					
			</div>
		
			<div class="contact-wrap">
			
				<div class="contact-form">											
					
					<?php if(isset($email_sent) && $email_sent == true) { ?>				
						<div class="msgbox msgbox-success"><?php _e('<strong>Thank you.</strong> Your email was sent successfully.', 'fairpixels'); ?></div>	
					<?php } else { ?>
	
					<?php if(isset($has_error)) { ?>
						<div class="msgbox msgbox-error"><?php _e('Please correct the following errors and try again.', 'fairpixels'); ?></div>
						<?php } ?>
	
						<form action="<?php $_SERVER['PHP_SELF']; ?>" id="fp_contact_form" method="post">
						
						<div class="field-section">
							
							<div class="one-half">	
								<div class="field">
									<label for="sender_name"><?php _e('Name', 'fairpixels') ?><span class="required"><?php _e('required', 'fairpixels') ?></span></label>
									<input type="text" class="text name_field requiredField" name="sender_name" id="sender_name" placeholder="Your name and surname" value="<?php if(isset($_POST['sender_name'])) echo esc_attr( $_POST['sender_name'] );?>" />
									<?php if($name_error != '') { ?>
										<span class="error"><?php echo esc_html( $name_error ); ?></span>  
									<?php } ?>
								</div>
							</div>
						
							<div class="one-half col-last">
								<div class="field">
									<label for="sender_email"><?php _e('Email', 'fairpixels') ?><span class="required"><?php _e('required', 'fairpixels') ?></span></label>
									<input type="text" class="text requiredField email" name="sender_email" id="sender_email" placeholder="To contact you" value="<?php if(isset($_POST['sender_email']))  echo esc_attr( $_POST['sender_email'] );?>" />
									<?php if($email_error != '') { ?>
										<span class="error"><?php echo esc_html( $email_error ); ?></span> 
									<?php } ?>	
								</div>
							</div>							
						</div>						
					
						<div class="field message-field">
							<label for="message_title"><?php _e('Message title', 'fairpixels') ?><span class="required"><?php _e('required', 'fairpixels') ?> </span></label>
							<input type="text" class="text title_field requiredField" name="message_title" id="message_title" placeholder="What you ask about?" value="<?php if(isset($_POST['message_title'])) echo esc_attr( $_POST['message_title'] );?>" />
							<?php if($name_error != '') { ?>
								<span class="error"><?php echo esc_html( $message_error ); ?></span>  
							<?php } ?>
						</div>					
						
						<div class="field textarea-field">		
							<label for="message_text"><?php _e('Write your message below', 'fairpixels') ?><span class="required"><?php _e('required', 'fairpixels') ?> </span></label>
							<textarea class="textarea message_field requiredField" name="message_text" id="message_text" placeholder="Your question here."><?php if(isset($_POST['message_text'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['message_text']); } else { echo esc_attr( $_POST['message_text'] ); } } ?></textarea>
															
							<?php if($message_error != '') { ?>
								<span class="error"><?php echo esc_html( $message_error ); ?></span> 
							<?php } ?>				
						</div>	
						
						<div class="field capt-section">
							<label for="capt_field"><?php _e('Leave it blank', 'fairpixels') ?></label>
							<input type="text" class="text" name="capt_field" id="capt_field" value="<?php if(isset($_POST['capt_field'])) echo esc_attr( $_POST['capt_field'] );?>" />
						</div>
						
						<div class="field submit-field">
							<input type="submit" name="fp_submit" value="Send Message" class="button" />
						</div>
										
				</form>
	
			<?php } ?>
	
		</div><!-- /contact-form -->
		
			
	</div><!-- /contact-form-wrap -->
</div><!-- /content -->

<?php get_sidebar('left'); ?>
<?php get_sidebar('right'); ?>
<?php get_footer(); ?>