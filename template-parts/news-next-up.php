<div class="wsu-news-next-up">
<h2><a href="#"><span>Next</span> Story</a></h2>
<?php

$news_query = WSUWP\Theme\News\Query::get( array( 'post_type' => 'news_article', 'posts_per_page' => 1 ) );

while ( $news_query->have_posts() ) {

    $news_query->the_post();

    WSUWP\Theme\News\Query::add_exclude_post( get_the_ID() );

    WSUWP\Theme\WDS\Template::render( 'template-parts/article-list-item', get_post_type() );

};

wp_reset_postdata(); ?>
</div>