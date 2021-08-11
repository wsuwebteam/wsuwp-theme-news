<!-- wp:wsuwp/post-article {"className":"wsu-news-article"} -->
    <!-- wp:wsuwp/post-header -->
        <!-- wp:wsuwp/post-date /-->
        <!-- wp:wsuwp/post-title /-->
        <!-- wp:wsuwp/post-byline /-->
        <!-- wp:wsuwp/post-social /-->
    <!-- /wp:wsuwp/post-header -->
    <!-- wp:wsuwp/post-hero {"style":"figure"} /-->
    <!-- wp:wsuwp/post-article-copy -->
        <!-- wp:wsuwp/post-content /-->
    <!-- /wp:wsuwp/post-article-copy -->
    <!-- wp:wsuwp/post-footer -->
        <!-- wp:wsuwp/post-social /-->
        <!-- wp:wsuwp/post-categories /-->
        <!-- wp:wsuwp/post-tags /-->
    <!-- /wp:wsuwp/post-footer -->
<!-- /wp:wsuwp/post-article -->
<?php WSUWP\Theme\WDS\Template::render( 'template-parts/news-next-up', get_post_type() ); ?>
<?php WSUWP\Theme\WDS\Template::render( 'template-parts/news-recent', get_post_type() ); ?>