<div class="wsu-news-recent">
<h2>Recent News</h2>
<?php
$news_query = WSUWP\Theme\News\Query::get( array( 'post_type' => 'news_article', 'posts_per_page' => 6 ) );

while ( $news_query->have_posts() ) {

    $news_query->the_post();

    WSUWP\Theme\News\Query::add_exclude_post( get_the_ID() );

    WSUWP\Theme\WDS\Template::render( 'block-templates/article-card-horizontal-reversed', get_post_type(), array( 'title_tag' => 'h3', 'link' => true ) );

};

wp_reset_postdata(); ?>
<a class="wsu-button" href="<?php echo esc_url( get_bloginfo( 'url' ) ); ?>">Find More News</a>
</div>
