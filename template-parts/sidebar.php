
<div class="wsu-callout wsu-news-callout">
    <?php WSUWP\Theme\WDS\Template::render( 'template-parts/news-featured', get_post_type() ); ?>
</div>

<?php WSUWP\Theme\WDS\Template::render( 'template-parts/news-trending', get_post_type() );