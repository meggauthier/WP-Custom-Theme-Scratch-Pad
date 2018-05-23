<?php


if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


	// include dependencies
	include( get_template_directory() . '/inc/admin.php');
	include( get_template_directory() . '/inc/handler.php');

	require_once dirname( __FILE__ ) . '/inc/meg_register_required_plugins.php';
		add_action( 'tgmpa_register', 'meg_register_required_plugins' );

	//require plugin_dir_path( __FILE__ ) . 'templates/create-template.php';
	//require plugin_dir_path( __FILE__ ) . 'templates/template-product.php';

function megs_enqueue_script() {   
	 if ( is_page_template( 'template-category.php' )) {
       
            wp_enqueue_script( 'megs-ajax', get_stylesheet_directory_uri() . '/js/megs-ajax.js', array( ), '2.0.2', true );
       
        }
}
add_action('wp_enqueue_script', 'megs_enqueue_script');


//enqueue styles
function wpb_adding_styles() {


	wp_enqueue_style( 'bootstrap_css', 'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css' );
	wp_enqueue_style( 'stylish', get_template_directory_uri() . '/css/styles.css' );

}
add_action( 'wp_enqueue_script', 'wpb_adding_styles' );

