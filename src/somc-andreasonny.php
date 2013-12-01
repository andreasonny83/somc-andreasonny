<?php

/*
 *	Plugin Name: somc-&lt;andreasonny&gt;
 *	Plugin URI: http://andreasonny.github.io/somc-andreasonny/
 *	Description: A plug-in made for Sony Mobile that show a list of the subpages related to the current page.
 *	Version: 1.0
 *	Author: Andrea Zornada
 *	Author URI: http://www.sonnywebdesign.com
 *	License: GPL2
 *
*/

function somc_andreasonny_options_page() {

	if( !current_user_can( 'manage_options' ) ) {

		wp_die( 'You do not have suggicient permissions to access this page.' );

	}

	require( 'inc/options-page-wrapper.php' );

}

class Somc_Andreasonny_Widget extends WP_Widget {

	function somc_andreasonny_widget() {
		// Instantiate the parent object
		
		parent::__construct( false, 'somc-&lt;andreasonny&gt; Sony Plugin' );
	}

	function widget( $args, $instance ) {
		// Widget output

		extract( $args );
		$title = apply_filters( 'widget_title' , $instance['title'] );

		require( 'inc/front-end.php' );

	}

	function update( $new_instance, $old_instance ) {
		// Save widget options
		
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		
		return $instance;
	}

	function form( $instance ) {
		// Output admin widget options form

		$title = esc_attr($instance['title']);

		require( 'inc/widget-fields.php' );

	}
}

function somc_andreasonny_register_widget() {
	register_widget( 'somc_andreasonny_widget' );
}

add_action( 'widgets_init', 'somc_andreasonny_register_widget' );

function somc_andreasonny_shortcode() {
	ob_start();

	require( 'inc/front-end.php' );
	$content = ob_get_clean();
	return $content;
}

add_shortcode( "somc-subpages-&lt;andreasonny&gt;", 'somc_andreasonny_shortcode' );

function somc_andreasonny_frontend_styles() {
	// Load the css and javascript files related to the plugin

	wp_enqueue_style( 'somc_andreasonny_frontend_css', plugins_url( 'somc-andreasonny/css/somc-andreasonny.css' ) );
	wp_enqueue_script( 'script-name', plugins_url( 'somc-andreasonny/js/script.js' ), array( 'jquery' ), '1.0.0', true );

}

add_action( 'wp_enqueue_scripts', 'somc_andreasonny_frontend_styles' );

?>