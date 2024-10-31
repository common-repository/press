<?php
/**
 * @package Press
 */

/**
 * 
 * @since  		1.0.0
 * 
 * Add scripts and styles to the admin boxes
 * 
 */
function press_enqueue_scripts( $hook ) 
{
	global $post;

	if ( $hook == 'post-new.php' || $hook == 'post.php' || $hook == 'settings_page_conveyor-settings' ) 
	{
		// Custom styles
		wp_enqueue_style( 'press_admin_styles', plugins_url( 'assets/css/styles.css' , __FILE__ ) );
		
		// Custom scripts
		wp_enqueue_script( 'press_admin_scripts', plugins_url( 'assets/js/scripts.min.js' , __FILE__ ), array( 'jquery' ), '1.0', true );
	}
}
add_action( 'admin_enqueue_scripts', 'press_enqueue_scripts' );
?>