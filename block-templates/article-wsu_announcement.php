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
        <p class="wsu-announcements__intro">
        The Notices and Announcements section is provided as a service to the WSU community for sharing events such as lectures, trainings, and other highly 
        transactional types of information related to the university experience. Accuracy of the information presented is the responsibility of 
        those who submitted it. The self-uploaded posts are reviewed for compliance with state statutes and ethics guidelines but are not edited by the News 
        and Media Relations unit for spelling, grammar or clarity.
        </p>
        <!-- wp:wsuwp/post-categories /-->
        <!-- wp:wsuwp/post-tags /-->
    <!-- /wp:wsuwp/post-footer -->
<!-- /wp:wsuwp/post-article -->
<?php WSUWP\Theme\WDS\Template::render( 'template-parts/news-recent', get_post_type() ); ?>