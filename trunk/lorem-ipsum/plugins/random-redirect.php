<?php
/*
Plugin Name: Random Redirect
Plugin URI: http://wordpress.org/extend/plugins/random-redirect/
Description: Allows you to create a link to yourblog.example.com/?random which will redirect someone to a random post on your blog, in a StumbleUpon-like fashion.
Version: 1.0.1
Author: Matt Mullenweg
Author URI: http://photomatt.net/
*/

function matt_random_redirect() {
	global $wpdb;
	$random_id = $wpdb->get_var( "SELECT ID FROM $wpdb->posts WHERE post_type = 'post' AND post_password = '' AND post_status = 'publish' ORDER BY RAND() LIMIT 1");
	wp_redirect( get_permalink( $random_id ) );
	exit;
}

if ( isset( $_GET['random'] ) )
	add_action( 'template_redirect', 'matt_random_redirect' );
?>