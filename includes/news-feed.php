<?php namespace WSUWP\Theme\News;


class News_Feed {

	private static $slug = 'news_feed';

	private static $attributes = array(
		'labels'       => array(
			'name'          => 'News Feeds',
			'singular_name' => 'News Feed',
		),
		'description'  => '',
		'show_ui'      => true,
		'show_in_menu' => 'news_templates',
		'show_in_rest' => true,
		'exclude_from_search' => true,
		'supports'     => array(
			'title',
			'editor',
		),
	);

	public static function init() {

		add_action( 'init', array( __CLASS__, 'register_post_type' ) );

	}

	public static function register_post_type() {

		register_post_type( self::$slug, self::$attributes );

	}

}

News_Feed::init();
