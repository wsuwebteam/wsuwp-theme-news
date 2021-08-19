<div class="wsu-news-next-up">
<h2><a href="#"><span>Next</span> Story</a></h2>
<?php

$news_query = WSUWP\Theme\News\Query::get( array( 'post_type' => 'news_article', 'posts_per_page' => 1 ) );

while ( $news_query->have_posts() ) {

    $news_query->the_post();

    WSUWP\Theme\News\Query::add_exclude_post( get_the_ID() );

    WSUWP\Theme\WDS\Template::render( 'block-templates/article-card-horizontal', get_post_type(), array( 'title_tag' => 'h3' ) );

};

wp_reset_postdata(); ?>
</div>