<?php namespace WSUWP\Theme\News;


class Taxonomy {

	public static function get_related_term( $post_id, $taxonomy = 'category' ) {

		$terms = get_the_terms( $post_id, $taxonomy );

		if ( ! is_array( $terms ) || ! $terms || is_wp_error( $terms ) ) {

			return false;

		}

		foreach ( $terms as $term ) {

			if ( 'uncategorized' !== $term->name ) {

				return $term;

			}
		}

		return false;

	}


	public static function get_related_term_id( $post_id, $taxonomy = 'category' ) {

		$term = self::get_related_term( $post_id, $taxonomy );

		return ( ! $term ) ? false : $term->term_id;

	}


}
