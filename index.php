<?php
/*
Plugin Name: Wordpress Tornado Warnings
Plugin URI: http://warningweather.com
Description: Displays a list of Tornado Warnings from the National Weather Service in Twitter
Version: 0.3.1
Author: Zesty Labs LLC
Author URI: http://warningweather.com
License: GPL2
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
		$site = urlencode(site_url());
		echo $before_title . "Tornado Warnings" . $after_title;
		$wptornwarn_warnings = file_get_contents("http://warningweather.com/wptorn.php?site=$site");
		echo $wptornwarn_warnings;
		echo $after_widget;
	}
}

class WP_Mesodiscussions_Widget extends WP_Widget {
	function WP_Mesodiscussions_Widget() {
		$widget_ops = array('classname' => 'widget_mesodiscussions', 'description' => 'Active Mesodiscussions in this widget.' );
		$this->WP_Widget('mesodiscussions', 'Mesodiscussions', $widget_ops);
	}
	function widget($args, $instance) {
		extract($args, EXTR_SKIP);
		echo $before_widget;
		echo $before_title . "Mesodiscussions" . $after_title;
		$site = urlencode(site_url());
		$wptornwarn_warnings = file_get_contents("http://www.mesodiscussion.com/wpmeso.php?site=$site");
		echo $wptornwarn_warnings;
		echo $after_widget;
	}
}

add_action('widgets_init', 'register_wp_tornado_warnings_widget');
function register_wp_tornado_warnings_widget() {
    register_widget('WP_Tornado_Warning_Widget');
	register_widget('WP_Mesodiscussions_Widget');
}

?>