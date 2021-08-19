<div class="wsu-news-recent">
<h2 class="wsu-news-sidebar-title">Featured <strong>News</strong></h2>
<?php

$featured_query_args = array(
	'post_type'      => 'news_article',
	'posts_per_page' => 2,
	'meta_query'     => array( 
		array(
			'key' => '_thumbnail_id',
		),
	),
);

$news_query = WSUWP\Theme\News\Query::get( $featured_query_args );

while ( $news_query->have_posts() ) {

	$news_query->the_post();

	WSUWP\Theme\News\Query::add_exclude_post( get_the_ID() );

	WSUWP\Theme\WDS\Template::render( 'block-templates/article-card', get_post_type(), array( 'title_tag' => 'h3', 'hideCaption' => true ) );

};

wp_reset_postdata(); ?>
<a class="wsu-button" href="<?php echo esc_url( get_bloginfo( 'url' ) ); ?>">Find More News</a>
</div>