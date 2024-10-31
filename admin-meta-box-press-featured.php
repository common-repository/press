<?php
/**
 * @package Press
 */

/**
 * 
 * @since  		1.0.0
 * 
 * Custom meta box for featured slides
 * 
 */
function press_featured_meta_box() {

	// Only add the box to the selected post types
	$screens 		= array();
	$post_types 	= get_post_types( array('public' => true) );

	foreach( $post_types as $post_type)
	{
		if( get_option('_press_show_featured_on_' . $post_type ) === 'show' )
		{
			array_push( $screens, $post_type );
		}
	}

	foreach ( $screens as $screen ) 
	{
		add_meta_box(
			'press_featured',
			'Featured',
			'press_featured_render_meta_box',
			$screen,
			'side'
		);
	}

}
add_action( 'add_meta_boxes', 'press_featured_meta_box' );



/**
 * 
 * @since  		1.0.0
 * 
 * Render the featured meta box
 * 
 */
function press_featured_render_meta_box( $post ) {

	$press_featured 		= get_post_meta( $post->ID, '_press_featured', true );

	?>
		<div class="press_featured cf">
			<p>
				<div class="row cf">
					<div class="label__container">
						<strong>
							<label class="label-inline" for="press_featured">Featured news</label>
						</strong>
					</div>
					<div class="input__container">
							<input type="checkbox" id="press_featured" name="press_featured" value="true"<?php echo ( $press_featured == 'true') ? ' checked' : '';?>/>
					</div>
				</div>
			</p>
		</div> 

	<?php


	wp_nonce_field( 'submit_press_featured', 'press_featured_nonce' ); 
}


/**
 * 
 * @since  		1.0.0
 * 
 * Handle the featured meta box post data
 * 
 */
function press_featured_handle_post_data( $post_id )
{
	$nonce_key							= 'press_featured_nonce';
	$nonce_action						= 'submit_press_featured';

	// If it is just a revision don't worry about it
	if ( wp_is_post_revision( $post_id ) )
		return $post_id;

	// Check it's not an auto save routine
	if ( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE ) 
		return $post_id;

	// Verify the nonce to defend against XSS
	if ( !isset( $_POST[$nonce_key] ) || !wp_verify_nonce( $_POST[$nonce_key], $nonce_action ) )
		return $post_id;

	// Check that the current user has permission to edit the post
	if ( !current_user_can( 'edit_post', $post_id ) )
		return $post_id;

	$press_featured 		= isset( $_POST['press_featured'] ) 	? 'true' : 'false';

	update_post_meta( $post_id, '_press_featured', 		$press_featured );

}
add_action( 'save_post', 'press_featured_handle_post_data' );
?>