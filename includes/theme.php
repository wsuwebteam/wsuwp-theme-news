<?php namespace WSUWP\Theme\News;


class Theme {


	protected static $version = '0.0.11';


	public static function get( $property ) {

		switch ( $property ) {
			case 'version':
				return self::$version;
			default:
				return '';
		}

	}


	public static function init() {

		self::load_class( 'query' );

		require_once __DIR__ . '/scripts.php';
		require_once __DIR__ . '/taxonomy.php';
		require_once __DIR__ . '/curated-news.php';
		require_once __DIR__ . '/news-feed.php';
		require_once __DIR__ . '/press-release.php';
		require_once __DIR__ . '/news-templates-page.php';
		require_once __DIR__ . '/content-defaults.php';
		require_once __DIR__ . '/announcement.php';
		require_once __DIR__ . '/shortcodes.php';

	}


	public static function load_class( $class_slug ) {

		require_once get_stylesheet_directory() . '/classes/class-' . $class_slug . '.php';

	}

}

Theme::init();
