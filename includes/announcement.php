<?php namespace WSUWP\Theme\News;


class Announcement {

	private static $slug = 'wsu_announcement';

	private static $attributes = array(
		'labels'        => array(
			'name'          => 'Announcements',
			'singular_name' => 'Announcement',
		),
		'description'   => '',
		'public'        => true,
		'has_archive'   => true,
		'show_in_rest'  => true,
		'rewrite'       => array( 'slug' => 'announcements' ),
		'menu_position' => 8,
		'menu_icon'     => 'dashicons-megaphone',
	);

	public static function init() {

		add_action( 'init', array( __CLASS__, 'register_post_type' ) );

		add_action( 'pre_get_posts', array( __CLASS__, 'show_weeks_announcements' ) );

	}

	public static function register_post_type() {

		register_post_type( self::$slug, self::$attributes );

	}


	public static function show_weeks_announcements( $query ) {

		if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'wsu_announcement' ) ) {

			$query->set( 'posts_per_page', 100 );
			$query->set( 'date_query', array( array( 'before' => '3 week ago' ) ) );

		}

	}

}

Announcement::init();
