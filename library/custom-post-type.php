<?php
// Flush rewrite rules for custom post types
add_action( 'after_switch_theme', 'ted_flush_rewrite_rules' );

// Flush your rewrite rules
function ted_flush_rewrite_rules()
{
	flush_rewrite_rules();
}

// let's create the function for the custom type
function custom_post_example()
{ 
	register_post_type( 'custom_type',
		array( 'labels' => array(
				'name'  => __( 'Custom Types', 'ted' ),
				'singular_name' => __( 'Custom Post', 'ted' ),
				'all_items' => __( 'All Custom Posts', 'ted' ),
				'add_new'   => __( 'Add New', 'ted' ),
				'add_new_item' => __( 'Add New Custom Type', 'ted' ),
				'edit'      => __( 'Edit', 'ted' ),
				'edit_item' => __( 'Edit Post Types', 'ted' ),
				'new_item'  => __( 'New Post Type', 'ted' ),
				'view_item' => __( 'View Post Type', 'ted' ),
				'search_items' => __( 'Search Post Type', 'ted' ),
				'not_found'    =>  __( 'Nothing found in the Database.', 'ted' ),
				'not_found_in_trash' => __( 'Nothing found in Trash', 'ted' ),
				'parent_item_colon'  => ''
			),
			'description' => __( 'This is the example custom post type', 'ted' ),
			'public'      => true,
			'publicly_queryable'  => true,
			'exclude_from_search' => false,
			'show_ui'   => true,
			'query_var' => true,
			'menu_position' => 8,
			'menu_icon'   => 'dashicons-desktop',
			'rewrite'	  => array( 'slug' => 'custom_type', 'with_front' => false ),
			'has_archive' => 'custom_type',
			'capability_type' => 'post',
			'hierarchical' => false,
			'supports'     => array( 'title', 'editor', 'thumbnail' )
		)
	);
	
	register_taxonomy_for_object_type( 'category', 'custom_type' );
	register_taxonomy_for_object_type( 'post_tag', 'custom_type' );
}

add_action( 'init', 'custom_post_example');
	
register_taxonomy( 'custom_cat', 
	array( 'custom_type' ),
	array( 'hierarchical' => true,
			'labels' => array(
				'name' => __( 'Custom Categories', 'ted' ),
				'singular_name' => __( 'Custom Category', 'ted' ),
				'search_items'  =>  __( 'Search Custom Categories', 'ted' ),
				'all_items'     => __( 'All Custom Categories', 'ted' ),
				'parent_item'   => __( 'Parent Custom Category', 'ted' ),
				'parent_item_colon' => __( 'Parent Custom Category:', 'ted' ),
				'edit_item'     => __( 'Edit Custom Category', 'ted' ),
				'update_item'   => __( 'Update Custom Category', 'ted' ),
				'add_new_item'  => __( 'Add New Custom Category', 'ted' ),
				'new_item_name' => __( 'New Custom Category Name', 'ted' )
			),
			'show_admin_column' => true, 
			'show_ui'   => true,
			'query_var' => true,
			'rewrite'   => array( 'slug' => 'custom-slug' ),
	)
);

register_taxonomy( 'custom_tag', 
	array( 'custom_type' ),
	array( 'hierarchical' => false,
			'labels' => array(
				'name' => __( 'Custom Tags', 'ted' ),
				'singular_name' => __( 'Custom Tag', 'ted' ),
				'search_items'  =>  __( 'Search Custom Tags', 'ted' ),
				'all_items'     => __( 'All Custom Tags', 'ted' ),
				'parent_item'   => __( 'Parent Custom Tag', 'ted' ),
				'parent_item_colon' => __( 'Parent Custom Tag:', 'ted' ),
				'edit_item'     => __( 'Edit Custom Tag', 'ted' ),
				'update_item'   => __( 'Update Custom Tag', 'ted' ),
				'add_new_item'  => __( 'Add New Custom Tag', 'ted' ),
				'new_item_name' => __( 'New Custom Tag Name', 'ted' )
			),
			'show_admin_column' => true,
			'show_ui'   => true,
			'query_var' => true,
	)
);
