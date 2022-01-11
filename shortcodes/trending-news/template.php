<?php
$news_query = new \WP_Query(
	array(
		'post_type' => 'news_article',
		'posts_per_page' => 5,
		'post__in' => array(100292,222222,222337,222159,222215),
		'orderby' => 'post__in',
		)
	);

while ( $news_query->have_posts() ) {

	$news_query->the_post();

	WSUWP\Theme\WDS\Template::render( 'template-parts/news-card-titles', get_post_type() );

};

wp_reset_postdata();
