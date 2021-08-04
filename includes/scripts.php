<?php namespace WSUWP\Theme\News;


class Scripts {


	public static function init() {

		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_scripts' ), 10 );

	}


	public static function enqueue_scripts() {

		$theme_version = Theme::get( 'version' );
		
		wp_enqueue_style( 
			'wsu-theme-news-css', 
			get_stylesheet_uri(),
        	array(), 
        	$theme_version,
    	);

	}

}

Scripts::init();
