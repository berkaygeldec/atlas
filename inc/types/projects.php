<?php 

function custom_project_post_type() {

	$labels = array(
		'name'                  => _x( 'Projects', 'Post Type General Name', 'atlas' ),
		'singular_name'         => _x( 'Projects', 'Post Type Singular Name', 'atlas' ),
		'menu_name'             => __( 'Projects', 'atlas' ),
		'name_admin_bar'        => __( 'Projects', 'atlas' ),
		'archives'              => __( 'Item Archives', 'atlas' ),
		'attributes'            => __( 'Item Attributes', 'atlas' ),
		'parent_item_colon'     => __( 'Parent Item:', 'atlas' ),
		'all_items'             => __( 'All Items', 'atlas' ),
		'add_new_item'          => __( 'Add New Item', 'atlas' ),
		'add_new'               => __( 'Add New', 'atlas' ),
		'new_item'              => __( 'New Item', 'atlas' ),
		'edit_item'             => __( 'Edit Item', 'atlas' ),
		'update_item'           => __( 'Update Item', 'atlas' ),
		'view_item'             => __( 'View Item', 'atlas' ),
		'view_items'            => __( 'View Items', 'atlas' ),
		'search_items'          => __( 'Search Item', 'atlas' ),
		'not_found'             => __( 'Not found', 'atlas' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'atlas' ),
		'featured_image'        => __( 'Featured Image', 'atlas' ),
		'set_featured_image'    => __( 'Set featured image', 'atlas' ),
		'remove_featured_image' => __( 'Remove featured image', 'atlas' ),
		'use_featured_image'    => __( 'Use as featured image', 'atlas' ),
		'insert_into_item'      => __( 'Insert into item', 'atlas' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'atlas' ),
		'items_list'            => __( 'Items list', 'atlas' ),
		'items_list_navigation' => __( 'Items list navigation', 'atlas' ),
		'filter_items_list'     => __( 'Filter items list', 'atlas' ),
	);
	$args = array(
		'label'                 => __( 'Projects', 'atlas' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor','excerpt' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'show_in_rest'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => true,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
	);
	register_post_type( 'my_projects', $args );

}
add_action( 'init', 'custom_project_post_type', 0 );
?>