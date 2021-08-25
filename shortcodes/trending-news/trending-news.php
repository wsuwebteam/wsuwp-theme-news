<?php namespace WSUWP\Plugin\News;

class Shortcode_Trending_News {

	public static function render() {

        ob_start();

        include __DIR__ . '/template.php';

        return ob_get_clean();

    }

}