<div class="wsu-news-recent">
<h2>Recent News</h2>
<?php
$news_query = new \WP_Query( array( 'post_type' => 'news_article', 'posts_per_page' => 6 ) );

while ( $news_query->have_posts() ) {

    $news_query->the_post();

    WSUWP\Theme\WDS\Template::render( 'template-parts/article-list-item', get_post_type() );

};

wp_reset_postdata(); ?>
<a class="wsu-button" href="">Find More News</a>
</div>
