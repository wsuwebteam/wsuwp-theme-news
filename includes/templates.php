<?php namespace WSUWP\Plugin\News;

class Templates {


	public static function init() {

		add_filter( 'get_the_archive_title', array( __CLASS__, 'filter_archive_title' ) );

		add_action( 'pre_get_posts', array( __CLASS__, 'add_post_type_to_archive' ) );

	}


	public static function filter_archive_title( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = get_the_author();
		} elseif ( is_post_type_archive() ) {

			if ( 'news_article' === get_post_type() ) {
				$title = 'Latest News';
			} else {
				$title = post_type_archive_title( '', false );
			}
		} elseif ( is_tax() ) {
			$title = single_term_title( '', false );
		}
		return $title;
	}

	public static function add_post_type_to_archive( $query ) {

		if ( $query->is_main_query() && ! is_admin() && ( is_category() || is_tag() && empty( $query->query_vars['suppress_filters'] ) ) ) {

			$query_post_types = $query->get( 'post_type' );

			if ( ! is_array( $query_post_types ) ) {

				$query_post_types = array( $query_post_types );

			}

			$query_post_types[] = 'page';

			$query->set( 'post_type', $query_post_types );

		}
	}

}

Templates::init();


