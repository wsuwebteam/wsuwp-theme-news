<div class="wsu-wrapper-content">
	<div class="wsu-layout wsu-layout--sidebar">
		<main class="wsu-layout-panel">
			<h1>Notices and Announcements</h1>
			<div class="wsu-announcements__intro">
			Welcome to the Craigslist of Washington State University! The listings below are submitted by others on various WSU
campuses. They are not edited for spelling, grammar, or clarity. WSU News and Media Relations offers this page as a service and
takes no ownership or responsibility for the content these posts contain.
			</div>
			<form class="wsu-announcements__form" method="get">
				<div class="wsu-search-field wsu-search-field--secondary">
					<input class="wsu-search-field__input" type="text" name="s" value="<?php echo esc_html( $_REQUEST['s'] ?: '' ); ?>" placeholder="Search Announcements" />
					<button class="wsu-search-field__button" type="submit">Search</button>
				</div>
			</form>
			<h2 class="wsu-announcements__results-title">
			<?php if ( ! empty( $_REQUEST['s'] ) ) : ?>Search Results<?php elseif ( is_paged() ) : ?>Announcements Archive<?php else : ?>New This Week<?php endif; ?>
			</h2>
			<?php 
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();

						//WSUWP\Theme\WDS\Template::render( 'block-templates/article-card-horizontal-reversed', get_post_type() );

						WSUWP\Theme\WDS\Template::render( 'block-templates/article-accordion', get_post_type() );

					} // end while

					WSUWP\Theme\WDS\Template::render( 'block-templates/pagination', get_post_type() );
			} 
			;?>
		</main>
		<aside class="wsu-layout-panel">
			<div class="wsu-announcements-submit">
				<h2 class="wsu-announcements-submit__title"><strong>Create and submit</strong> your own notice</h2>
				<a class="wsu-button wsu-announcements-submit__button" href="<?php echo esc_url( get_bloginfo( 'url' ) ); ?>/submit-announcement/">Submit announcement</a>
			</div>
			<?php WSUWP\Theme\WDS\Template::render( 'template-parts/sidebar', get_post_type() ); ?>
		</aside>
	</div>
</div>