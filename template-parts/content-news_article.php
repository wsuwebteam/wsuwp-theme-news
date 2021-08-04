<div class="wsu-row wsu-row--sidebar-right">
	<div class="wsu-column">
		<?php
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				//
				WSUWP\Theme\WDS\Template::render( 'template-parts/article', get_post_type() );
				//
			} // end while
		} // end if
		;?>
		<?php WSUWP\Theme\WDS\Template::render( 'template-parts/news-next-up', get_post_type() ); ?>
		<?php WSUWP\Theme\WDS\Template::render( 'template-parts/news-recent', get_post_type() ); ?>
	</div>
	<div class="wsu-column">
		<?php WSUWP\Theme\WDS\Template::render( 'template-parts/news-you-might-like', get_post_type() ); ?>
		<?php WSUWP\Theme\WDS\Template::render( 'template-parts/news-trending', get_post_type() ); ?>
	</div>
</div>
