<?php
/**
 * @package Press
 */

/**
 * 
 * @since  		1.0.0
 * 
 * Register the options page
 * 
 */
function press_add_options_page() {

	add_options_page( 'Press', 'Press', 'manage_options', 'press-settings', 'press_render_options_page' );

	add_action( 'admin_init', 'press_register_settings' );
}
add_action('admin_menu', 'press_add_options_page');




/**
 * 
 * @since  		1.0.0
 * 
 * Register the options settings
 * 
 */
function press_register_settings() {

	$post_types = get_post_types( array('public' => true) );

	register_setting( 'press_group', '_press_show_news_cpt' );

	register_setting( 'press_group', '_press_show_url' );
	register_setting( 'press_group', '_press_show_email' );
	register_setting( 'press_group', '_press_show_sms' );
	register_setting( 'press_group', '_press_show_sms_instructions' );
	register_setting( 'press_group', '_press_show_telephone' );
	register_setting( 'press_group', '_press_show_hashtag' );
	register_setting( 'press_group', '_press_show_twitter' );
	register_setting( 'press_group', '_press_show_facebook' );
	register_setting( 'press_group', '_press_show_google' );

	foreach( $post_types as $post_type)
	{
		register_setting( 'press_group', '_press_show_featured_on_' . $post_type );
		register_setting( 'press_group', '_press_show_news_information_on_' . $post_type );
	}

}

/**
 * 
 * @since  		1.0.0
 * 
 * Render the options page
 * 
 */
function press_render_options_page()
{	
	$post_types 		= get_post_types( array('public' => true) );
	sort( $post_types );

	foreach( $post_types as $post_type)
	{
		if($post_type == 'press_news')
		{
			if( get_option('_press_show_featured_on_' . $post_type ) === false )
			{
				add_option( '_press_show_featured_on_' . $post_type, 'show' );
			}

			if( get_option('_press_show_news_information_on_' . $post_type ) === false )
			{
				add_option( '_press_show_news_information_on_' . $post_type, 'show' );
			}
		}
	}

	if( get_option('_press_show_news_cpt') === false)
	{
		add_option( '_press_show_news_cpt', 'show' );
	}

	if( get_option('_press_show_url') === false)
	{
		add_option( '_press_show_url', 'true' );
	}

	if( get_option('_press_show_email') === false)
	{
		add_option( '_press_show_email', 'true' );
	}

	if( get_option('_press_show_telephone') === false)
	{
		add_option( '_press_show_telephone', 'true' );
	}

	if( get_option('_press_show_hashtag') === false)
	{
		add_option( '_press_show_hashtag', 'true' );
	}

	if( get_option('_press_show_twitter') === false)
	{
		add_option( '_press_show_twitter', 'true' );
	}

	if( get_option('_press_show_facebook') === false)
	{
		add_option( '_press_show_facebook', 'true' );
	}

	?>
		<div class="wrap press_options">
			<h2>Press</h2>
			<form method="post" action="options.php">
			<?php 
				settings_fields( 'press_group' );
				do_settings_sections( 'press_group' );
			?>
			<table class="form-table">
				<tr valign="top">
					<th scope="row"><label for="press_show_news_cpt">Show the 'News' post type</label></th>
					<td><input type="checkbox" value="show" id="press_show_news_cpt" name="_press_show_news_cpt"<?php echo ( get_option('_press_show_news_cpt') == 'show' ) ? ' checked' : '';?>></td>
				</tr>
				<tr valign="top">
					<th scope="row">Show 'Featured news' custom meta on post type</th>
					<td>
						<?php
							foreach( $post_types as $post_type)
							{
								?>
									<span class="inline">
										<input type="checkbox" value="show" id="press_show_featured_on_<?php echo $post_type;?>" name="_press_show_featured_on_<?php echo $post_type;?>"<?php echo ( get_option('_press_show_featured_on_' . $post_type ) == 'show' ) ? ' checked' : '';?>>
										<label for="press_show_featured_on_<?php echo $post_type;?>">
										<?php
											
											$obj = get_post_type_object( $post_type );
											echo $obj->labels->singular_name;
										?>
										</label>
									</span>
								<?php
							}
						?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">Show 'News Information' custom meta on post type</th>
					<td>
						<?php
							foreach( $post_types as $post_type)
							{
								?>
									<span class="inline">
										<input type="checkbox" value="show" id="press_show_news_information_on_<?php echo $post_type;?>" name="_press_show_news_information_on_<?php echo $post_type;?>"<?php echo ( get_option('_press_show_news_information_on_' . $post_type ) == 'show' ) ? ' checked' : '';?>>
										<label for="press_show_news_information_on_<?php echo $post_type;?>">
										<?php
											
											$obj = get_post_type_object( $post_type );
											echo $obj->labels->singular_name;
										?>
										</label>
									</span>
								<?php
							}
						?>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">News information fields</th>
					<td>
						<span class="inline">
							<input type="checkbox" value="true" id="press_show_url" name="_press_show_url"<?php echo ( get_option( '_press_show_url' ) == 'true' ) ? ' checked' : '';?>>
							<label for="press_show_url">
								Website URL
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="press_show_email" name="_press_show_email"<?php echo ( get_option( '_press_show_email' ) == 'true' ) ? ' checked' : '';?>>
							<label for="press_show_email">
								Email
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="press_show_sms" name="_press_show_sms"<?php echo ( get_option( '_press_show_sms' ) == 'true' ) ? ' checked' : '';?>>
							<label for="press_show_sms">
								SMS
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="press_show_sms_instructions" name="_press_show_sms_instructions"<?php echo ( get_option( '_press_show_sms_instructions' ) == 'true' ) ? ' checked' : '';?>>
							<label for="press_show_sms_instructions">
								SMS instructions
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="press_show_telephone" name="_press_show_telephone"<?php echo ( get_option( '_press_show_telephone' ) == 'true' ) ? ' checked' : '';?>>
							<label for="press_show_telephone">
								Telephone
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="press_show_hashtag" name="_press_show_hashtag"<?php echo ( get_option( '_press_show_hashtag' ) == 'true' ) ? ' checked' : '';?>>
							<label for="press_show_hashtag">
								Hashtag
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="press_show_twitter" name="_press_show_twitter"<?php echo ( get_option( '_press_show_twitter' ) == 'true' ) ? ' checked' : '';?>>
							<label for="press_show_twitter">
								Twitter
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="press_show_facebook" name="_press_show_facebook"<?php echo ( get_option( '_press_show_facebook' ) == 'true' ) ? ' checked' : '';?>>
							<label for="press_show_facebook">
								Facebook
							</label>
						</span>

						<span class="inline">
							<input type="checkbox" value="true" id="press_show_google" name="_press_show_google"<?php echo ( get_option( '_press_show_google' ) == 'true' ) ? ' checked' : '';?>>
							<label for="press_show_google">
								Google+
							</label>
						</span>

					</td>
				</tr>
			</table>
			<?php submit_button(); ?>
			</form>
		</div>
	<?php
}

/**
 * Add "Settings" action on installed plugin list
 */
function press_add_plugin_actions( $links ) {
	array_unshift( $links, '<a href="options-general.php?page=press-settings">Settings</a>');
	return $links;
}
add_action( 'plugin_action_links_Press/index.php', 'press_add_plugin_actions' );

/**
 * Add links on installed plugin list
 */
function press_add_plugin_links( $links, $file ) 
{
	if( $file == 'Press/index.php' ) {
		$rate_url = 'http://wordpress.org/support/view/plugin-reviews/Press?rate=5#postform';
		$links[] = '<a href="' . $rate_url . '" target="_blank" title="Rate and Review this Plugin on WordPress.org">Rate this plugin</a>';
	}
	
	return $links;
}
add_filter( 'plugin_row_meta', 'press_add_plugin_links' , 10, 2);
?>