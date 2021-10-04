<?php namespace WSUWP\Plugin\News;

class Templates {


	public static function init() {

		add_filter( 'get_the_archive_title', array( __CLASS__, 'filter_archive_title' ) );

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

}

Templates::init();


