<?php namespace WSUWP\Theme\News;


class Curated_News {

	private static $slug = 'curated_news';

	private static $attributes = array(
		'labels'       => array(
			'name'          => 'Curated News',
			'singular_name' => 'Curated News',
		),
		'description'  => '',
		'show_ui'      => true,
		'show_in_menu' => 'news_templates',
		'show_in_rest' => true,
		'public'       => true,
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

Curated_News::init();
