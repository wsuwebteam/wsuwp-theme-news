<?php
$news_query = new \WP_Query(
	array(
		'post_type' => 'news_article',
		'posts_per_page' => 5,
		'post__in' => array(217848,217893,217764,217983,218072,218030),
		'orderby' => 'post__in',
		)
	);

while ( $news_query->have_posts() ) {

	$news_query->the_post();

	WSUWP\Theme\WDS\Template::render( 'template-parts/news-card-titles', get_post_type() );

};

wp_reset_postdata();
