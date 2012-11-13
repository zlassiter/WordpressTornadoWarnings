<?php
/*
Plugin Name: Wordpress Tornado Warnings
Plugin URI: http://URI_Of_Page_Describing_Plugin_and_Updates
Description: Displays a list of Tornado Warnings from the National Weather Service in Twitter
Version: 0.1
Author: Zesty Labs LLC
Author URI: http://URI_Of_The_Plugin_Author
License: A "Slug" license name e.g. GPL2
*/


add_action( 'admin_menu', 'my_plugin_menu' );

function my_plugin_menu() {
	add_options_page( 'Wordpress Tornado Warnings Settings', 'Tornado Warnings', 'manage_options', 'wp_torando_warnings', 'wp_tornado_warnings_options' );
}


class WP_Tornado_Warning_Widget extends WP_Widget {
	function WP_Tornado_Warning_Widget() {
		$widget_ops = array('classname' => 'widget_tornado_warnings', 'description' => 'Tornado Warnings in this widget.' );
		$this->WP_Widget('tornado_warnings', 'Tornado Warnings', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		echo $before_title . "Tornado Warnings" . $after_title;
		$wptornwarn_warnings = file_get_contents('http://warningweather.com/wptorn.php');
		echo $wptornwarn_warnings;
		echo $after_widget;
	}
}
add_action('widgets_init', 'register_wp_tornado_warnings_widget');
function register_wp_tornado_warnings_widget() {
    register_widget('WP_Tornado_Warning_Widget');
}

?>