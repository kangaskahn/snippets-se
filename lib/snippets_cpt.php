<?php
/*================================================
=            SNIPPETS CPT FOR PLUGIN            =
================================================*/

add_action( 'init', 'snippetsse_etd_cpt_vars', 0 );
add_action( 'init', 'snippetsse_create_snippet_category', 0 );

/* Add Snippets CPT */
function snippetsse_etd_cpt_vars() {
	$labels = array(
		'name'                => _x( 'Snippets', 'Post Type General Name', 'snippet' ),
		'singular_name'       => _x( 'Snippet', 'Post Type Singular Name', 'snippet' ),
		'menu_name'           => __( 'Snippets', 'snippet' ),
		'parent_item_colon'   => __( 'Parent Snippet', 'snippet' ),
		'all_items'           => __( 'All Snippets', 'snippet' ),
		'view_item'           => __( 'View Snippet', 'snippet' ),
		'add_new_item'        => __( 'Add New Snippet', 'snippet' ),
		'add_new'             => __( 'Add New', 'snippet' ),
		'edit_item'           => __( 'Edit Snippet', 'snippet' ),
		'update_item'         => __( 'Update Snippet', 'snippet' ),
		'search_items'        => __( 'Search Snippet', 'snippet' ),
		'not_found'           => __( 'Not Found', 'snippet' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'snippet' ),
	);

	$args = array(
		'label'               => __( 'Snippet', 'snippet' ),
		'description'         => __( 'Snippets', 'snippet' ),
		'labels'              => $labels,
		'menu_icon'		      => 'dashicons-hammer',
		// Features this CPT supports in Post Editor
		'supports'            => array( 'title', 'editor' ),
		'hierarchical'        => false,
		'public'              => false,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => false,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'can_export'          => true,
		'has_archive'         => false,
		'exclude_from_search' => true,
		'publicly_queryable'  => false,
		'capability_type'     => 'page',
	);

	// Registering your Custom Post Type
	register_post_type( 'snippet', $args );
}

/* Add Taxonomy to Snippets */
function snippetsse_create_snippet_category() {
	$labels = array(
		'name'              => _x( 'Collections', 'taxonomy general name' ),
		'singular_name'     => _x( 'Collection', 'taxonomy singular name' ),
		'search_items'      => __( 'Search Collections' ),
		'all_items'         => __( 'All Collections' ),
		'parent_item'       => __( 'Parent Collection' ),
		'parent_item_colon' => __( 'Parent Collection:' ),
		'edit_item'         => __( 'Edit Collection' ),
		'update_item'       => __( 'Update Collection' ),
		'add_new_item'      => __( 'Add New Collection' ),
		'new_item_name'     => __( 'New Collection Name' ),
		'menu_name'         => __( 'Collections' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'collection' ),
	);

	register_taxonomy( 'sse-collection', array( 'snippet' ), $args );
}

add_filter('manage_edit-snippet_columns' , 'snippetsse_snippet_cpt_columns');
function snippetsse_snippet_cpt_columns($columns) {
		unset($columns['author']);
	   unset($columns['categories']);
	   unset($columns['tags']);
	   unset($columns['comments']);
	   unset($columns['date']);

	$new_columns = array(
		'snippet_content' => __('Snippet Content', 'snippet-se'),
		'categories' => __('Collections', 'snippet-se'),
		'date' => __('Date', 'snippet-se'),
	);
    return array_merge($columns, $new_columns);
}

add_action( 'manage_snippet_posts_custom_column' , 'snippetsse_custom_columns_snippets_se', 10, 2 );
function snippetsse_custom_columns_snippets_se( $column, $post_id ) {
	switch ( $column ) {
		case 'snippet_content':
			$mypost = get_post($post_id);
			
			if ( isset($mypost) ) {
				apply_filters('the_content',$mypost->post_content);
			} else {
				_e( 'Unable to get author(s)', 'your_text_domain' );
			}
			break;
	}
}