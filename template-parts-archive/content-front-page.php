<!-- wp:wsuwp/post-layout -->
<div class="wsu-news-curated">
	<?php

	$the_query = new WP_Query(
		array(
			'post_type' => 'curated_news',
			'posts_per_page' => 1
		)
	);

	if ( $the_query->have_posts() ) {

		while ( $the_query->have_posts() ) {

			$the_query->the_post();

			the_content();

		}
	}
	/* Restore original Post Data */
	wp_reset_postdata();

	;?>
</div>
<div class="wsu-news-feed">
	<?php
	$the_query = new WP_Query(
		array(
			'post_type' => 'news_feed',
			'posts_per_page' => 1
		)
	);

	if ( $the_query->have_posts() ) {

		while ( $the_query->have_posts() ) {

			$the_query->the_post();

			the_content();

		}
	}
	/* Restore original Post Data */
	wp_reset_postdata();

	;?>
</div>
<!-- /wp:wsuwp/post-layout -->