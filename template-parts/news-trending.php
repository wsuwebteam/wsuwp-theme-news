<div class="wsu-callout wsu-news-callout wsu-news-callout--trending">
<h2>Trending <span>News</span></h2>
<?php
$news_query = new \WP_Query( array( 'post_type' => 'news_article', 'posts_per_page' => 5 ) );

while ( $news_query->have_posts() ) {

    $news_query->the_post();

    WSUWP\Theme\WDS\Template::render( 'template-parts/news-card-titles', get_post_type() );

};

wp_reset_postdata(); ?>
</div>