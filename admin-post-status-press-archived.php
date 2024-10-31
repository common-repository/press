<?php
/**
 * @package Occasion
 */

/**
 * 
 * @since  		1.0.1
 * 
 * Custom post status for archived news
 * 
 */
function press_archived_post_status() {
	register_post_status( 'press_archived', array(
		'label'                     => _x( 'Archived', 'post' ),
		'public'                    => true,
		'exclude_from_search'       => true,
		'show_in_admin_all_list'    => true,
		'show_in_admin_status_list' => true,
		'label_count'               => _n_noop( 'Archived <span class="count">(%s)</span>', 'Archived <span class="count">(%s)</span>' ),
	));


	// Apply status to older news
	$args = array(
		'post_type'			=> 		'press_news',
		'posts_per_page' 	=> 		-1,
		'post_status'		=> 		array('publish')
	);

	$archived_news = get_posts( $args );

	foreach( $archived_news as $news )
	{	

		if(date('Y-m-d', strtotime($news->post_date)) <= date('Y-m-d', strtotime('-1 year')))
		{
			$args = array(
				'ID'			=> $news->ID,
				'post_status' 	=> 'press_archived'
			);
			wp_update_post( $args );
		}
	}
}
add_action( 'init', 'press_archived_post_status' );


/**
 * 
 * @since  		1.0.1
 * 
 * Add the post status as a choosible option
 * 
 */
function press_archived_post_status_list() {

	global $post;

	$label 		= '';
	$value 		= '';
	$complete 	= '';
	$span 		= '';
	$post_types = get_post_types( array('public' => true) );

	foreach( $post_types as $post_type)
	{
		if( get_option('_press_show_featured_on_' . $post_type ) == 'show' )
		{
			if( $post->post_type == $post_type )
			{
				if( $post->post_status == 'press_archived' )
				{
					$complete = ' selected=\"selected\"';
					$label = '<span id=\"post-status-display\"> Archived</span>';
				}
				echo '
				<script>
					jQuery(document).ready(function($){
						$("select#post_status").append("<option value=\"press_archived\" '.$complete.'>Archived</option>");
						$(".misc-pub-section label").append("'.$label.'");
					});
				</script>
				';
			}
		}	
	}
}
add_action('admin_footer-post.php', 'press_archived_post_status_list');

/**
 * 
 * @since  		1.0.1
 * 
 * Append the post status state to post list
 * 
 */
function press_archived_post_status_state( $states ) {

	global $post;
	
	$arg = get_query_var( 'post_status' );
	
	if( $arg != 'press_archived' )
	{
		if($post->post_status == 'press_archived')
		{
			return array('Archived');
		}
	}
    return $states;
}
add_filter( 'display_post_states', 'press_archived_post_status_state' );
?>