<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package  WordPress
 * @file     footer.php
 * @author   FairPixels
 * @link 	 http://fairpixels.com
 */
?>
	</div><!-- /inner-wrap -->
	
</div><!-- /main -->

<div id="footer" class="footer">
	<div class="gotop"><i class="fa fa-chevron-up"></i></div>
	
<!-- 	<div class="footer-menu">
		<div class="inner-wrap">
			<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'container' => '0', 'depth' => '1') ); ?>
		</div>
	</div> -->
		
	<div class="footer-content">
		<div class="inner-wrap">	
		
			<!-- <div class="footer-widget footer-widget-1">	
				<php
					if ( ! dynamic_sidebar( 'footer-1' ) ) : 			
					endif;
				?>
			</div> -->

			<div class="footer-row">
			
				<div class="footer-widget footer-nav">
					<?php wp_nav_menu( array( 'theme_location' => 'footer-menu', 'menu_class' => 'footer-menu', 'container' => '0', 'depth' => '2') ); ?>
				</div>

				<div class="footer-widget footer-widget-2">
					<?php
					if ( ! dynamic_sidebar( 'footer-2' ) ) : 			
					endif;				
					?>
				</div>

			</div>

			<div class="footer-row footer-row-info">
				<?php if (fp_get_settings( 'fp_footer_text_left' )){ ?> 
					<div class="footer-info">
						<div class="inner-wrap">
							<?php echo fp_get_settings( 'fp_footer_text_left' ); ?>
						</div>
					</div>
				<?php } ?>	
			</div>
			
					
		</div>
	</div><!-- /footer-widgets -->
	
	
	
</div><!-- /footer -->

<?php wp_footer(); ?>

</body>
</html>