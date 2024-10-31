<?php
/**
 * @package Press
 */


/**
 * 
 * @since  		1.0.0
 * 
 * Render bootstrap 
 * 
 */
function press_render_bootstrap( $post_id, $args = array(), $version = '3' )
{
	// Future proofing, set the version of Bootstrap we wish to render
	// if( $version == '3' ){ // Render here }

	press_render_bootstrap_3( $post_id, $args );
}


/**
 * 
 * @since  		1.0.0
 * 
 * Render bootstrap 3
 *
 * @param 		int 		$post_id 	the post id to render
 * @param 		array 		$args 		arguments to define render
 * 
 */
function press_render_bootstrap_3( $post_id, $args = array() ) 
{
	$defaults = array(
		'class_address_wrapper'			=> '',						// The class of the address wrapper
		'class_content_wrapper' 		=> '',						// The class of the content wrapper
		'class_header'					=> '',						// The class of the header tag
		'class_image_wrapper' 			=> 'pull-right',			// The class of the image wrapper
		'class_link_wrapper' 			=> 'pull-right',			// The class of the map link wrapper
		'class_meta_label_wrapper'		=> 'col-md-2',				// The class of the label wrapper
		'class_wrapper'					=> 'location__wrapper',		// The class of the location wrapper
		'class_meta_row'				=> 'row',					// The class of the row
		'class_meta_value_wrapper'		=> 'col-md-10',				// The class of the value wrapper
		'class_map_wrapper'				=> 'location__map',			// The class of the map wrapper
		'class_title'					=> 'location__title',		// The class of the title
		'date_format'					=> 'F jS, Y',				// The format of the date output
		'id'							=> 'position',				// If you want to have multiple renders, you will want to change the id each time
		'post_type'						=> 'position',				// [ post | page | custom post type | array() ]			
		'show_content'					=> true,					// [ true | false ] - show the post content in the list
		'show_email'					=> true,					// [ true | false ] - show the email in the list
		'show_facebook'					=> true,					// [ true | false ] - show facebook in the list
		'show_google'					=> true,					// [ true | false ] - show google+ in the list
		'show_hashtag'					=> true,					// [ true | false ] - show the hashtag
		'show_image'					=> true, 					// [ true | false ] - show images in the list
		'show_location'					=> true,					// If a related location is set, show it (this requires the plugin 'Position' to be installed)
		'show_sms'						=> true,					// [ true | false ] - show the sms
		'show_sms_instructions'			=> true,					// [ true | false ] - show the sms instructions
		'show_telephone'				=> true,					// [ true | false ] - show the telephone number
		'show_twitter'					=> true,					// [ true | false ] - show twitter in the list
		'show_website'					=> true,					// [ true | false ] - show the website url in the list
		'tag_meta_label_wrapper_close' 	=> '</strong></p>',			// The tag(s) you wish to close the label with
		'tag_meta_label_wrapper_open' 	=> '<p><strong>',			// The tag(s) you wish to open the label with
		'tag_meta_value_wrapper_close' 	=> '</p>',					// The tag(s) you wish to close the value with
		'tag_meta_value_wrapper_open' 	=> '<p>',					// The tag(s) you wish to open the value with
		'time_format'					=> 'g:i A',
	);

	$r 								= array_merge( $defaults, $args );
	$news 							= get_post( $post_id );
	$post_thumbnail_id 				= get_post_thumbnail_id( $post_id );

	$press_email 					= get_post_meta( $post_id, '_press_email', true );
	$press_url 						= get_post_meta( $post_id, '_press_url', true );
	$press_telephone 				= get_post_meta( $post_id, '_press_telephone', true );
	$press_twitter 					= get_post_meta( $post_id, '_press_twitter', true );
	$press_facebook 				= get_post_meta( $post_id, '_press_facebook', true );
	$press_google 					= get_post_meta( $post_id, '_press_google', true );
	$press_sms 						= get_post_meta( $post_id, '_press_sms', true );
	$press_sms_instructions 		= get_post_meta( $post_id, '_press_sms_instructions', true );
	$press_hashtag 					= get_post_meta( $post_id, '_press_hashtag', true );

	$press_show_name 				= get_option( '_press_show_name' );
	$press_show_email 				= get_option( '_press_show_email' );
	$press_show_website 			= get_option( '_press_show_url' );
	$press_show_telephone 			= get_option( '_press_show_telephone' );
	$press_show_twitter 			= get_option( '_press_show_twitter' );
	$press_show_facebook 			= get_option( '_press_show_facebook' );
	$press_show_google 				= get_option( '_press_show_google' );
	$press_show_sms 				= get_option( '_press_show_sms' );
	$press_show_sms_instructions 	= get_option( '_press_show_sms_instructions' );
	$press_show_hashtag 			= get_option( '_press_show_hashtag' );
	$press_show_facebook_news 		= get_option( '_press_show_facebook_news' );
	$press_show_google_news 		= get_option( '_press_show_google_news' );
	$press_show_lanyrd 				= get_option( '_press_show_lanyrd' );
	$press_show_meetup 				= get_option( '_press_show_meetup' );

	if( $press_show_email 			!= 'true' 	|| !$r['show_email'] ) 				$press_email 			= null;
	if( $press_show_website 		!= 'true' 	|| !$r['show_website'] ) 			$press_url 				= null;
	if( $press_show_telephone 		!= 'true' 	|| !$r['show_telephone'] ) 			$press_telephone 		= null;
	if( $press_show_twitter 		!= 'true' 	|| !$r['show_twitter'] ) 			$press_twitter 			= null;
	if( $press_show_facebook		!= 'true' 	|| !$r['show_facebook'] ) 			$press_facebook 			= null;
	if( $press_show_google			!= 'true' 	|| !$r['show_google'] ) 			$press_google 			= null;

	if( $press_show_sms				!= 'true' 	|| !$r['show_sms'] ) 				$press_sms 				= null;
	if( $press_show_sms_instructions	!= 'true' 	|| !$r['show_sms_instructions'] ) 	$press_sms_instructions 	= null;
	if( $press_show_hashtag			!= 'true' 	|| !$r['show_hashtag'] ) 			$press_hashtag 			= null;
	if( $press_show_facebook_news	!= 'true' 	|| !$r['show_facebook_news'] ) 	$press_facebook_news 	= null;
	if( $press_show_google_news		!= 'true' 	|| !$r['show_google_news'] ) 		$_press_google_news 	= null;
	if( $press_show_lanyrd			!= 'true' 	|| !$r['show_lanyrd'] ) 			$press_lanyrd 			= null;
	if( $press_show_meetup			!= 'true' 	|| !$r['show_meetup'] ) 			$press_meetup 			= null;

	?>
	<section id="<?php echo $r['id']; ?>" class="<?php echo $r['class_wrapper']; ?> vcard organisation">
		
		<?php 

		?>
		<header class="<?php echo $r['class_header']; ?>">
			<h1 class="<?php echo $r['class_title']; ?> org"><?php echo $news->post_title; ?></h1>
		</header>
		<?php
		
		if( $r['show_image'] )
		{
			?>
			<div class="<?php echo $r['class_image_wrapper']; ?>"><?php echo wp_get_attachment_image( $post_thumbnail_id, 'medium' ); ?></div>
			<?php
		}
		?>
		<?php 
		if( $r['show_content'] )
		{
			?>
			<div class="<?php echo $r['class_content_wrapper']; ?>">
				<?php echo wpautop( $news->post_content );?>
			</div>
			<?php
		}
		if( !empty( $press_email ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
						<?php echo $r['tag_meta_label_wrapper_open']; ?>
							Email
						<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a class="email" href="mailto:<?php echo $press_email; ?>"><?php echo $press_email; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $press_telephone ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Telephone
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a class="tel" href="tel:<?php echo str_replace( ' ','', $press_telephone ); ?>"><?php echo $press_telephone; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $press_sms ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						SMS
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a class="tel" href="tel:<?php echo str_replace( ' ','', $press_sms ); ?>"><?php echo $press_sms; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $press_sms_instructions ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						SMS Instructions
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<?php echo $press_sms_instructions; ?>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $press_url ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Website
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a class="url" href="<?php echo $press_url; ?>" target="_blank"><?php echo $press_url; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $press_twitter ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Twitter
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a href="http://twitter.com/<?php echo $press_twitter; ?>" target="_blank">@<?php echo $press_twitter; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $press_hashtag ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Twitter
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a href="http://twitter.com/#<?php echo $press_hashtag; ?>" target="_blank">#<?php echo $press_hashtag; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $press_facebook ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Facebook
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a href="<?php echo $press_facebook; ?>" target="_blank"><?php echo $press_facebook; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( !empty( $press_google ) )
		{
			?>
			<div class="<?php echo $r['class_meta_row']; ?>">
				<div class="<?php echo $r['class_meta_label_wrapper']; ?>">
					<?php echo $r['tag_meta_label_wrapper_open']; ?>
						Google+
					<?php echo $r['tag_meta_label_wrapper_close']; ?>
				</div>
				<div class="<?php echo $r['class_meta_value_wrapper']; ?>">
					<?php echo $r['tag_meta_value_wrapper_open']; ?>
						<a href="<?php echo $press_google; ?>" target="_blank"><?php echo $press_google; ?></a>
					<?php echo $r['tag_meta_value_wrapper_close']; ?>
				</div>
			</div>
			<?php
		}
		if( $r['show_location'] )
		{
			$position_related = get_post_meta( $post_id, '_position_related', true );

			if( !empty( $position_related ) )
			{
				position_render_bootstrap( $position_related );
			}
		}
		?>
	</section>

	<?php
}
?>