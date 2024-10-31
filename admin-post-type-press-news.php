<?php
/**
 * @package Press
 */

/**
 *
 * @since 		1.0.0
 *
 * Creates a custom post type for the news
 *
 */
function press_create_post_type() {

	$labels 	= array();
	$args 		= array();

	// Set labels for the custom post type
	$labels = array(
		'name'               => _x( 'News', 'post type general name' ),
		'singular_name'      => _x( 'News', 'post type singular name' ),
		'add_new'            => _x( 'Add New', 'News' ),
		'add_new_item'       => __( 'Add New News' ),
		'edit_item'          => __( 'Edit News' ),
		'new_item'           => __( 'New News' ),
		'all_items'          => __( 'All News' ),
		'view_item'          => __( 'View News' ),
		'search_items'       => __( 'Search News' ),
		'not_found'          => __( 'No news found' ),
		'not_found_in_trash' => __( 'No news found in the Trash' ),
		'parent_item_colon'  => '',
		'menu_name'          => 'News'
	);

	// Set the arguements for the custom post type
	$args = array(
		'rewrite' 				=> array( 'slug' => 'news' ),
		'labels'				=> $labels,
		'description'			=> 'News',
		'public'				=> true,
		'menu_position'			=> 20,
		'menu_icon'				=> 'dashicons-id-alt',
		'hierarchical'			=> true,
		'has_archive'			=> true,
		'supports'				=> array(
									'title',
									'editor',
									'author',
									'thumbnail',
									'excerpt',
									'custom-fields',
									'revisions',
									'comments',
									'page-attributes'
									)
	);

	// Register the custom post type
	if( get_option('_press_show_news_cpt') == 'show' )
	{
		register_post_type( 'press_news', $args );
	}
}
add_action( 'init', 'press_create_post_type' );


/**
 *
 * @since 		1.0.0
 *
 * Hide meta boxes by default
 *
 */
function press_change_default_hidden( $hidden, $screen ) {
	if ( 'press_news' == $screen->id ) {
		$hidden[] 	= 'postcustom';
		$hidden[] 	= 'trackbacksdiv';
		$hidden[] 	= 'commentstatusdiv';
		$hidden[] 	= 'commentsdiv';
		$hidden[] 	= 'slugdiv';
		$hidden[] 	= 'authordiv';
		$hidden[] 	= 'revisionsdiv';
		$hidden[]	= 'pageparentdiv';
	}
	return $hidden;
}
add_filter( 'default_hidden_meta_boxes', 'press_change_default_hidden', 10, 2 );




/**
 *
 * @since 		1.0.0
 *
 * Register post thumbnails
 *
 */
function press_register_post_thumbnails()
{
	$post_thumbnails = get_theme_support( 'post-thumbnails' );
	$new_post_thumbnails = array();

	if( is_array( $post_thumbnails ) )
	{
		if( is_array( $post_thumbnails[0] ) )
		{
			foreach( $post_thumbnails[0] as $value )
			{
				array_push( $new_post_thumbnails, $value );
			}
		}
	}

	array_push( $new_post_thumbnails, 'press_news' );

	// Add support for post thumbnails to the theme
	add_theme_support( 'post-thumbnails', $new_post_thumbnails );

	// Add custom image sizes
	if( !in_array( 'square-75', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'square-75', 75, 75, true );
	}

	if( !in_array( 'square-150', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'square-150', 150, 150, true );
	}

	if( !in_array( 'square-300', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'square-300', 300, 300, true );
	}

	if( !in_array( 'square-600', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'square-600', 600, 600, true );
	}

	if( !in_array( 'square-1200', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'square-1200', 1200, 1200, true );
	}

		if( !in_array( 'golden-ratio-2560', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'golden-ratio-2560', 2560, 1582, true );
	}

	if( !in_array( 'golden-ratio-2048', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'golden-ratio-2048', 2048, 1266, true );
	}

	if( !in_array( 'golden-ratio-1920', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'golden-ratio-1920', 1920, 1186, true );
	}
	
	if( !in_array( 'golden-ratio-1680', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'golden-ratio-1680', 1680, 633, true );
	}

	if( !in_array( 'golden-ratio-1440', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'golden-ratio-1440', 1440, 890, true );
	}

	if( !in_array( 'golden-ratio-1280', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'golden-ratio-1280', 1280, 791, true );
	}
	
	if( !in_array( 'golden-ratio-1024', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'golden-ratio-1024', 1024, 633, true );
	}

	if( !in_array( 'golden-ratio-800', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'golden-ratio-800', 800, 494, true );
	}

	if( !in_array( 'golden-ratio-640', get_intermediate_image_sizes() ) )
	{
		add_image_size( 'golden-ratio-640', 640, 396, true );
	}
}
add_action( 'after_setup_theme', 'press_register_post_thumbnails' );
?>