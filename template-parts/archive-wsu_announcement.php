<?php 

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$dates = array();

for ( $d = 0; $d < 7; $d++ ) {

	$date_string = ( 0 === $d && 1 === $paged ) ? 'now' : '-' . ( $d + ( 7 * ( $paged - 1 ) ) )  . ' day';

	$dates[] = strtotime( $date_string );

}

?>
<div class="wsu-wrapper-content">
	<div class="wsu-layout wsu-layout--sidebar">
		<main class="wsu-layout-panel">
			<h1>Notices and Announcements</h1>
			<div class="wsu-announcements__intro">
			The Notices and Announcements section is provided as a service to the WSU community for sharing events such as lectures, trainings, and other highly 
			transactional types of information related to the university experience. Accuracy of the information presented is the responsibility of 
			those who submitted it. The self-uploaded posts are reviewed for compliance with state statutes and ethics guidelines but are not edited for spelling, grammar, or clarity.
			</div>
			<form class="wsu-announcements__form" method="get">
				<div class="wsu-search-field wsu-search-field--secondary">
					<input class="wsu-search-field__input" type="text" name="search_announcements" value="<?php echo esc_html( $_REQUEST['search_announcements'] ?: '' ); ?>" placeholder="Search Announcements" />
					<button class="wsu-search-field__button" type="submit">Search</button>
				</div>
			</form>
			<h2 class="wsu-announcements__results-title">
			<?php if ( ! empty( $_REQUEST['search_announcements'] ) ) : ?>Search Results<?php elseif ( is_paged() ) : ?>Announcements Archive<?php else : ?>Recent Announcements<?php endif; ?>
			</h2>

			<?php 

			foreach( $dates as $date ) {

				$query_args = array(
					'post_type' => 'wsu_announcement',
					'posts_per_page' => -1,
					'date_query' => array(
						'year' => wp_date( 'Y', $date ),
						'month' => wp_date( 'm', $date ),
						'day' => wp_date( 'd', $date ),
					),
				);

				$the_query = new WP_Query( $query_args );
 
				if ( $the_query->have_posts() ) {

					while ( $the_query->have_posts() ) {

						$the_query->the_post();

						WSUWP\Theme\WDS\Template::render( 'block-templates/article-accordion', get_post_type() );

					}
				}

				wp_reset_postdata();
			}

			?>

			<?php 
			if ( have_posts() ) {
				while ( have_posts() ) {
					the_post();

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