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
			'slug'       => 'press-release',
			'with_front' => false,
		),
		'taxonomies'    => array(
			'post_tag',
			'category',
			'media_contact',
			'wsuwp_university_location',
			'wsuwp_university_org',
			'wsuwp_university_category',
		),
	);

	public static function init() {

		add_action( 'init', array( __CLASS__, 'register_post_type' ) );

		// Converts the Structure Tags in our permalink.
		add_filter( 'post_type_link', array( __CLASS__, 'post_type_link' ), 10, 2 );

		add_filter( 'wsu_wds_component_post_byline', array( __CLASS__, 'set_author' ) );

	}

	public static function register_post_type() {

		add_rewrite_rule(
			'^press-release/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)',
			'index.php?press_release=$matches[4]',
			'top'
		);
		add_rewrite_rule(
			'^press-release/([0-9]{4})/([0-9]{1,2})/?$',
			'index.php?post_type=press_release&year=$matches[1]&monthnum=$matches[2]',
			'top'
		);
		add_rewrite_rule(
			'^press-release/([0-9]{4})/?$',
			'index.php?post_type=press_release&year=$matches[1]',
			'top'
		);

		register_post_type( self::$slug, self::$attributes );

	}


	public static function post_type_link( $url, $post ) {

		if ( self::$slug == get_post_type( $post ) ) {

			$url_array = explode( '/press-release/', $url );

			$url = $url_array[0] . '/press-release/';

			$url .= get_the_date( 'Y', $post->ID ) . '/';
			$url .= get_the_date( 'm', $post->ID ) . '/';
			$url .= get_the_date( 'd', $post->ID ) . '/';
			$url .= $url_array[1];

		}

		return $url;

	}


	public static function set_author( $attrs ) {

		if ( 'press_release' === get_post_type() && taxonomy_exists( 'author' ) ) {

			$attrs['authors'] = array();

			$post_id = get_the_ID();

			$terms = get_the_terms( $post_id, 'author' );

			if ( is_array( $terms ) ) {

				foreach ( $terms as $term ) {

					$author = array(
						'name' => $term->name,
						'title' => get_term_meta( $term->term_id, 'organization', true ),
					);

					$attrs['authors'][] = $author;
				}
			}
		}

		return $attrs;
	}

}

Press_Release::init();
