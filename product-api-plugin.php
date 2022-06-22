<?php
/*
Plugin Name: belajar api plugin
Plugin URI: https://twitter.com/belajar-api-plugin
Description: 
Version: 1.0
Author: belajar-api-plugin
Author URI: https://instagram.com/belajar-api-plugin
License: Private
*/

add_filter( 'page_template', 'halaman_rest' );
function halaman_rest( $page_template ){
	$slug = 'belajar-api-plugin';
	if ( is_page($slug) ) {
		$page_template = dirname( __FILE__ ) . '/endpoint.php';
	}
	return $page_template;
}

function install_cs() {
	
	$post_data = array(
		'post_title' => '_for_belajar-api-plugin',
		'post_type' => 'page',
		'post_status'   => 'publish',
		'post_name' => 'belajar-api-plugin',
	);
	$post_id = wp_insert_post( $post_data );
}
register_activation_hook( __FILE__, 'install_cs' ); 


function uninstall_cs() {
	$data_halaman = get_pages();
	for ($i=0; $i < count($data_halaman); $i++) { 
		if ($data_halaman[$i]->post_name == "belajar-api-plugin") {
			wp_delete_post( $data_halaman[$i]->ID, true);
		}
	}
}
register_deactivation_hook( __FILE__, 'uninstall_cs' );
