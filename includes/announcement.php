<?php namespace WSUWP\Theme\News;


class Announcement {

	private static $slug = 'announcement';

	private static $attributes = array(
		'labels'        => array(
			'name'          => 'Announcements',
			'singular_name' => 'Announcement',
		),
		'description'   => '',
		'public'        => true,
		'has_archive'   => true,
		'show_in_rest'  => true,
		'menu_position' => 8,
		'menu_icon'     => 'dashicons-megaphone',
	);

	public static function init() {

		add_action( 'init', array( __CLASS__, 'register_post_type' ) );

	}

	public static function register_post_type() {

		register_post_type( self::$slug, self::$attributes );

	}

}

Announcement::init();
