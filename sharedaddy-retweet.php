<?php
/*
Plugin Name: Sharedaddy (Jetpack) Retweet Button
Description: An extension to Sharedaddy plugin (bundled with Jetpack) that allows an actual Retweet button.
Version: 1.0
Author: Konstantin Kovshenin
Author URI: http://kovshenin.com/
*/

class Sharedaddy_Retweet_Plugin {
	public function __construct() { die( 'Do not construct me!' ); }
	
	public static function on_load() {
		add_filter( 'sharing_services', array( __CLASS__, 'sharing_services' ) );
		add_action( 'admin_print_styles-settings_page_sharing', array( __CLASS__, 'admin_styles' ) );
		add_action( 'wp_head', array( __CLASS__, 'wp_head' ) );
	}
		
	public function sharing_services( $services ) {
		include_once 'share-retweet.class.php';
		if ( class_exists( 'Share_Retweet' ) )
			$services['retweet'] = 'Share_Retweet';
		return $services;
	}
	
	function admin_styles() {
		wp_enqueue_style( 'sharedaddy-retweet', plugins_url( 'admin-sharing.css', __FILE__ ) );
	}
	
	function wp_head() {
		wp_enqueue_style( 'sharedaddy-retweet', plugin_dir_url( __FILE__ ) . 'sharing.css' );	
	}
}
Sharedaddy_Retweet_Plugin::on_load();