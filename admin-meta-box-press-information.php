<?php
/**
 * @package Press
 */

/**
 * 
 * @since  		1.0.0
 * 
 * Custom meta box for news information
 * 
 */
function press_information_meta_box() {

	// Only add the box to the selected post types
	$screens 		= array();
	$post_types 	= get_post_types( array('public' => true) );

	foreach( $post_types as $post_type)
	{
		if( get_option('_press_show_news_information_on_' . $post_type ) === 'show' )
		{
			array_push( $screens, $post_type );
		}
	}

	foreach ( $screens as $screen ) 
	{
		add_meta_box(
			'press_information',
			'News information',
			'press_information_render_meta_box',
			$screen
		);
	}

}
add_action( 'add_meta_boxes', 'press_information_meta_box' );



/**
 * 
 * @since  		1.0.0
 * 
 * Render the cost meta box
 * 
 */
function press_information_render_meta_box( $post ) {

	$press_url 				= get_post_meta( $post->ID, '_press_url', true );
	$press_email 			= get_post_meta( $post->ID, '_press_email', true );
	$press_sms 				= get_post_meta( $post->ID, '_press_sms', true );
	$press_sms_instructions = get_post_meta( $post->ID, '_press_sms_instructions', true );
	$press_telephone 		= get_post_meta( $post->ID, '_press_telephone', true );
	$press_hashtag 			= get_post_meta( $post->ID, '_press_hashtag', true );
	$press_twitter 			= get_post_meta( $post->ID, '_press_twitter', true );
	$press_facebook 		= get_post_meta( $post->ID, '_press_facebook', true );
	$press_google 			= get_post_meta( $post->ID, '_press_google', true );

	?>
		<div class="press_information cf">

			<?php

				if( get_option('_press_show_url') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="press_url">Website URL</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="press_url" name="press_url" value="<?php echo $press_url; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_press_show_email') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="press_email">Email</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="press_email" name="press_email" value="<?php echo $press_email; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_press_show_sms') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="press_sms">SMS number</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="press_sms" name="press_sms" value="<?php echo $press_sms; ?>"/>
							</div>
						</div>
					</p>
				<?php
				}
				if( get_option('_press_show_sms_instructions') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="press_sms_instructions">SMS instructions</label>
								</strong>
							</div>
							<div class="input__container">
									<textarea id="press_sms_instructions" name="press_sms_instructions" ><?php echo $press_sms_instructions; ?></textarea>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_press_show_telephone') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="press_telephone">Telephone</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="tel" id="press_telephone" name="press_telephone" value="<?php echo $press_telephone; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_press_show_hashtag') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="press_hashtag">Hashtag</label>
								</strong>
							</div>
							<div class="input__container">
								<div class="input__wrapper">
									<span class="help-inline hash">#</span><input type="text" id="press_hashtag" name="press_hashtag" value="<?php echo $press_hashtag; ?>"/>
								</div>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_press_show_twitter') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="press_twitter">Twitter</label>
								</strong>
							</div>
							<div class="input__container">
								<div class="input__wrapper">
									<span class="help-inline at">@</span><input type="text" id="press_twitter" name="press_twitter" value="<?php echo $press_twitter; ?>"/>
								</div>
							</div>
						</div>
					</p>
					<?php
				}
				if( get_option('_press_show_facebook') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="press_facebook">Facebook</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="press_facebook" name="press_facebook" value="<?php echo $press_facebook; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
				
				if( get_option('_press_show_google') == 'true' )
				{
					?>
					<p>
						<div class="row cf">
							<div class="label__container">
								<strong>
									<label class="label-inline" for="press_google">Google+</label>
								</strong>
							</div>
							<div class="input__container">
									<input type="text" id="press_google" name="press_google" value="<?php echo $press_google; ?>"/>
							</div>
						</div>
					</p>
					<?php
				}
			?>
		</div>

	<?php

	wp_nonce_field( 'submit_press_information_values', 'press_information_nonce' ); 
}


/**
 * 
 * @since  		1.0.0
 * 
 * Handle the event information meta box post data
 * 
 */
function press_information_handle_post_data( $post_id )
{
	$nonce_key							= 'press_information_nonce';
	$nonce_action						= 'submit_press_information_values';

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

	$press_url 				= isset( $_POST['press_url'] ) 				? esc_url_raw( $_POST['press_url'] ) 				: null;
	$press_email 			= isset( $_POST['press_email'] ) 			? sanitize_email( $_POST['press_email'] )			: null;
	$press_sms 				= isset( $_POST['press_sms'] ) 				? $_POST['press_sms'] 								: null;
	$press_sms_instructions 	= isset( $_POST['press_sms_instructions'] )	 ? esc_textarea( $_POST['press_sms_instructions'] )	: null;
	$press_telephone 		= isset( $_POST['press_telephone'] ) 		? $_POST['press_telephone'] 							: null;
	$press_hashtag 			= isset( $_POST['press_hashtag'] ) 			? $_POST['press_hashtag'] 							: null;
	$press_twitter 			= isset( $_POST['press_twitter'] ) 			? $_POST['press_twitter'] 							: null;
	$press_facebook 		= isset( $_POST['press_facebook'] ) 		? esc_url_raw( $_POST['press_facebook'] ) 			: null;
	$press_google 			= isset( $_POST['press_google'] ) 			? esc_url_raw( $_POST['press_google'] ) 				: null;

	if( !empty( $press_sms ) )
	{
		$press_sms = preg_replace( '/[^0-9\s]/', '', $press_sms );
		$press_sms = preg_replace( '/\s\s+/', ' ', $press_sms );
		$press_sms = trim( $press_sms );
	}

	if( !empty( $press_telephone ) )
	{
		$press_telephone = preg_replace( '/[^0-9\s]/', '', $press_telephone );
		$press_telephone = preg_replace( '/\s\s+/', ' ', $press_telephone );
		$press_telephone = trim( $press_telephone );
	}

	if( !empty( $press_hashtag ) )
	{
		$press_hashtag = preg_replace( '/[^0-9A-Z]/', '', $press_hashtag );
	}

	if( !empty( $press_twitter ) )
	{
		$press_twitter = preg_replace( '/[^0-9a-zA-Z_]/', '', $press_twitter );
	}

	update_post_meta( $post_id, '_press_url', 					$press_url );
	update_post_meta( $post_id, '_press_email', 				$press_email );
	update_post_meta( $post_id, '_press_sms', 					$press_sms );
	update_post_meta( $post_id, '_press_sms_instructions', 		$press_sms_instructions );
	update_post_meta( $post_id, '_press_telephone', 			$press_telephone );
	update_post_meta( $post_id, '_press_hashtag', 				$press_hashtag );
	update_post_meta( $post_id, '_press_twitter', 				$press_twitter );
	update_post_meta( $post_id, '_press_facebook', 				$press_facebook );
	update_post_meta( $post_id, '_press_google', 				$press_google );

}
add_action( 'save_post', 'press_information_handle_post_data' );
?>