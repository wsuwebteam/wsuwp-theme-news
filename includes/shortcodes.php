<?php namespace WSUWP\Plugin\News;

class Shortcodes {


	public static function init() {

		require_once get_stylesheet_directory() . '/shortcodes/trending-news/trending-news.php';
		/*** Remove Default Post Type */

		add_shortcode( 'trending_news', array( __NAMESPACE__ . '\Shortcode_Trending_News', 'render' ) );

	}

}

Shortcodes::init();