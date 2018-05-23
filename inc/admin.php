<?php


function new_product() {
	// set up labels
	$labels = array(
 		'name' => 'Products',
    	'singular_name' => 'Product',
    	'add_new' => 'Add New Product',
    	'add_new_item' => 'Add New Product',
    	'edit_item' => 'Edit Product',
    	'new_item' => 'New Product',
    	'all_items' => 'All Products',
    	'view_item' => 'View Product',
    	'search_items' => 'Search Products',
    	'not_found' =>  'No Products Found',
    	'not_found_in_trash' => 'No Products found in Trash', 
    	'parent_item_colon' => '',
    	'menu_name' => 'Products',
    );

	register_post_type( 'product', array(
		'labels' => $labels,
		'has_archive' => true,
 		'public' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'thumbnail','page-attributes' ),
		'taxonomies' => array( 'post_tag', 'clothes' ),	
		'exclude_from_search' => false,
		'capability_type' => 'post',
		'rewrite' => array( 'slug' => 'products' ),
		)
	);
}
add_action( 'init', 'new_product' );

//register the clothing type taxonomy

function product_taxonomies() {
	$args = array(
		'labels'		    =>array('name' => 'Clothing Types'),
		'hierarchical'      => true,
		'show_ui'	        => true,
		'show_admin_column'	=> true,
		'query_var' 	    => true,
		'slug'				=> 'clothes',
	);
	register_taxonomy( 'clothes', 'product', $args );

}

add_action( 'init', 'product_taxonomies');

function product_colors() {
	$args = array(
		'labels'		    =>array('name' => 'Colors'),
		'hierarchical'      => true,
		'show_ui'	        => true,
		'show_admin_column'	=> true,
		'query_var' 	    => true,
		'slug'				=> 'colors',
	);
	register_taxonomy( 'colors', 'product', $args );

}

add_action( 'init', 'product_colors');