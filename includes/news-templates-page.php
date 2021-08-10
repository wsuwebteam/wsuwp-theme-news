<?php namespace WSUWP\Plugin\News;

class News_Templates_Page {

	public static function register_page() {

		add_menu_page(
			'News Templates',
			'News Templates',
			'manage_options',
			'news_templates',
			__CLASS__ . '::the_page',
			'dashicons-welcome-widgets-menus',
			9
		);
	}

	public static function the_page() {

		echo 'Go Cougs';

	}

	public static function init() {

		if ( is_admin() ) {

			add_action( 'admin_menu', __CLASS__ . '::register_page' );

		}

	}

}

News_Templates_Page::init();
