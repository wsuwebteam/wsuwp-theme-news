<?php namespace WSUWP\Theme\News;


class Press_Release {

	private static $slug = 'press_release';

	private static $attributes = array(
		'labels'        => array(
			'name'          => 'Press Releases',
			'singular_name' => 'Press Release',
		),
		'description'   => '',
		'public'        => true,
		'has_archive'   => true,
		'show_in_rest'  => true,
		'menu_position' => 4,
		'menu_icon'     => 'dashicons-media-text',
		'supports'      => array(
			'title',
			'editor',
			'thumbnail',
			'excerpt',
		),
		'rewrite'       => array(
			'slug'       => 'press-release/%year%/%monthnum%/%day%',
			'with_front' => false,
		),
		'taxonomies'    => array(
			'post_tag',
			'category',
			'media_contact',
		),
	);

	public static function init() {

		add_action( 'init', array( __CLASS__, 'register_post_type' ) );

		// Converts the Structure Tags in our permalink.
		add_filter( 'post_type_link', array( __CLASS__, 'post_type_link' ), 10, 2 );

	}

	public static function register_post_type() {

		register_post_type( self::$slug, self::$attributes );

	}


	public static function post_type_link( $url, $post ) {

		if ( self::$slug == get_post_type( $post ) ) {
			$url = str_replace( '%year%', get_the_date( 'Y' ), $url );
			$url = str_replace( '%monthnum%', get_the_date( 'm' ), $url );
			$url = str_replace( '%day%', get_the_date( 'd' ), $url );
		}

		return $url;

	}

}

Press_Release::init();
