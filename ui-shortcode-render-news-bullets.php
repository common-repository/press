<?php
/**
 * @package Press
 */


/**
 * 
 * @since  		1.0.0
 * 
 * Render a shortcode
 * 
 */
function press_news_list_render_shortcode_bullet( $args ) {

	if( empty( $args ) )
	{
		$args = array();
	}

	$version = 3;

	if( !empty( $args['version'] ) && is_numeric( $args['version'] ) )
	{
		$version = $args['version'];
	}

	if( !empty( $args['taxonomy_terms'] ) )
	{
		$args['taxonomy_filter'] = true; // If the terms are set, we probebly want to filter by them
	}

	if( empty( $args['show_pagination'] ) )
	{
		$args['show_pagination'] = false; // We dont want to page by default
	}

	$news = get_posts( press_query_arguements( $args ) );

	ob_start();

	if( count( $news > 0 ) )
	{	

		if( !empty( $args['message'] ) )
		{
			echo '<p>' . $args['message'] . '</p>';
		}
		?>
		<ul>
		<?php

		foreach( $news as $news )
		{
			?>
			<li>
				<a href="<?php echo get_permalink( $news->ID ); ?>"><?php echo $news->post_title; ?></a>
			</li>
			<?php
		}

		?>
		</ul>
		<?php
	}
	return ob_get_clean();
}
add_shortcode( 'press_shortcode_bullet_list', 'press_news_list_render_shortcode_bullet' );
?>