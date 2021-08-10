<?php namespace WSUWP\Theme\News;


class Theme {


	protected static $version = '0.0.1';


	public static function get( $property ) {

		switch ( $property ) {
			case 'version':
				return self::$version;
			default:
				return '';
		}

	}


	public static function init() {

		require_once __DIR__ . '/scripts.php';
		require_once __DIR__ . '/taxonomy.php';
		require_once __DIR__ . '/query.php';
		require_once __DIR__ . '/curated-news.php';
		require_once __DIR__ . '/news-feed.php';
		require_once __DIR__ . '/press-release.php';
		require_once __DIR__ . '/news-templates-page.php';
		require_once __DIR__ . '/content-defaults.php';
		require_once __DIR__ . '/announcement.php';

	}


	public static function require_class( $class_slug ) {

		require_once get_template_directory() . '/classes/class-' . $class_slug . '.php';

	}

}

Theme::init();
