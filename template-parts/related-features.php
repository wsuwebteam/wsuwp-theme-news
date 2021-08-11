<div class="wsu-callout wsu-news-callout wsu-news-callout--related">
<h2>You Might <span>Also Like...</span></h2>
<?php

$news_query = WSUWP\Theme\News\Query::get_related( 
    get_the_ID(), 
    'category', 
    array( 'post_type' => 'news_article', 'posts_per_page' => 2 ) 
);

while ( $news_query->have_posts() ) {

    $news_query->the_post();

    WSUWP\Theme\News\Query::add_exclude_post( get_the_ID() );

    WSUWP\Theme\WDS\Template::render( 'template-parts/news-card', get_post_type() );

};

wp_reset_postdata(); ?>
<a class="wsu-button wsu-button--full-width" href="">Find More News</a>
</div>
