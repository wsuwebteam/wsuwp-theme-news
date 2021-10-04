<?php namespace WSUWP\Theme\News;


class Announcement {

	private static $slug = 'wsu_announcement';

	private static $attributes = array(
		'labels'        => array(
			'name'          => 'Announcements',
			'singular_name' => 'Announcement',
		),
		'description'   => '',
		'public'        => true,
		'has_archive'   => true,
		'show_in_rest'  => true,
		'rewrite'       => array( 'slug' => 'announcements' ),
		'taxonomies'    => array( 'post_tag', 'category', 'wsuwp_university_location', 'wsuwp_university_org', 'wsuwp_university_category' ),
		'menu_position' => 8,
		'menu_icon'     => 'dashicons-megaphone',
		'supports'      => array( 'title', 'editor', 'custom-fields'),
	);

	public static function init() {

		add_action( 'init', array( __CLASS__, 'register_post_type' ) );

		add_action( 'pre_get_posts', array( __CLASS__, 'show_weeks_announcements' ) );

		add_shortcode( 'wsu_announcement_form', array( __CLASS__, 'output_submission_form' ) );

		add_action( 'wp_ajax_submit_announcement', array( __CLASS__, 'ajax_callback' ) );

		add_action( 'wp_ajax_nopriv_submit_announcement', array( __CLASS__, 'ajax_callback' ) );

		add_action( 'wp_ajax_copy_announcement_to_post', array( __CLASS__, 'ajax_copy_announcement_to_post' ) );

		add_filter( 'wsu_wds_component_post_byline', array( __CLASS__, 'set_author' ) );

		add_action( 'init', array( __CLASS__, 'register_taxonomies' ), 12 );

		add_action( 'manage_wsu_announcement_posts_custom_column', array( __CLASS__, 'manage_list_table_email_column' ), 10, 2 );

		add_filter( 'manage_edit-wsu_announcement_columns', array( __CLASS__, 'manage_list_table_columns' ), 10, 1 );

	}


	public static function manage_list_table_columns( $columns ) {
		// We may use categories and tags, but we don't need them on this screen.
		unset( $columns['categories'] );
		unset( $columns['tags'] );
		unset( $columns['date'] );

		// Add our custom columns. Move date to the end of the array after we unset it above.
		$columns['contact_email'] = 'Contact Email';
		$columns['date'] = 'Publish Date';

		return $columns;
	}

	public static function manage_list_table_email_column( $column_name, $post_id ) {

		if ( 'contact_email' !== $column_name ) {

			return;

		}

		$contact_email = get_post_meta( $post_id, '_announcement_contact_email', true );

		if ( $contact_email ) {

			echo esc_html( $contact_email );

		}
	}


	public static function register_taxonomies() {

		register_taxonomy_for_object_type( 'wsuwp_university_category', self::$slug );

		register_taxonomy_for_object_type( 'wsuwp_university_location', self::$slug );

		register_taxonomy_for_object_type( 'wsuwp_university_org', self::$slug );

	}

	public static function register_post_type() {

		add_rewrite_rule(
			'^announcements/([0-9]{4})/([0-9]{1,2})/([0-9]{1,2})/([^/]+)',
			'index.php?wsu_announcement=$matches[4]',
			'top'
		);
		add_rewrite_rule(
			'^announcements/([0-9]{4})/([0-9]{1,2})/?$',
			'index.php?post_type=wsu_announcement&year=$matches[1]&monthnum=$matches[2]',
			'top'
		);
		add_rewrite_rule(
			'^announcements/([0-9]{4})/?$',
			'index.php?post_type=wsu_announcement&year=$matches[1]',
			'top'
		);

		register_post_type( self::$slug, self::$attributes );

	}

	public static function post_type_link( $url, $post ) {

		if ( self::$slug == get_post_type( $post ) ) {

			$url_array = explode( '/announcements/', $url );

			$url = $url_array[0] . '/announcements/';

			$url .= get_the_date( 'Y', $post->ID ) . '/';
			$url .= get_the_date( 'm', $post->ID ) . '/';
			$url .= get_the_date( 'd', $post->ID ) . '/';
			$url .= $url_array[1];

		}

		return $url;

	}


	public static function set_author( $attrs ) {

		if ( self::$slug === get_post_type() ) {

			$attrs['authors'] = array();

			$post_id = get_the_ID();

			$author = get_post_meta( $post_id, 'announcement_author', true );

			if ( $author ) {

				$attrs['authors'][] = array(
					'name' => $author,
				);
			}
		}

		return $attrs;
	}


	public static function show_weeks_announcements( $query ) {

		if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'wsu_announcement' ) ) {

			$query->set( 'posts_per_page', 20 );

			if ( isset( $_REQUEST['search_announcements'] ) ) {

				$query->set( 's', sanitize_text_field( $_REQUEST['search_announcements']  ) );

			}

			//$query->set( 'date_query', array( array( 'after' => '1 week ago' ) ) );

		}

	}


	/**
	 * Setup the announcement form for output when the shortcode is used.
	 * Copied from https://github.com/washingtonstateuniversity/news.wsu.edu-internal/blob/master/includes/announcements.php
	 *
	 * Forked from the original WSU News & Announcements plugin
	 * and adapted for use on WSU Insider.
	 *
	 * @since 0.7.0
	 *
	 * @return string Contains form to be output.
	 */
	public static function output_submission_form() {
		// Enqueue jQuery UI's datepicker to provide an interface for the publish date(s).
		wp_enqueue_script( 'jquery-ui-datepicker' );
		wp_enqueue_style( 'jquery-ui-core', 'https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css' );

		// Enqueue the Javascript needed to handle the form submission properly.
		wp_enqueue_script( 'wsu-news-announcement-form', get_stylesheet_directory_uri() . '/assets/dist/js/announcements-form.js', array(), Theme::get( 'version' ), true );

		// Provide a global variable containing the ajax URL that we can access
		wp_localize_script( 'wsu-news-announcement-form', 'announcementSubmission', array(
			'ajaxurl' => admin_url( 'admin-ajax.php' ),
		) );

		wp_enqueue_style( 'wsu-news-announcement-form', get_stylesheet_directory_uri() . '/assets/dist/css/announcements-form.css' );

		// Build the output to return for use by the shortcode.
		ob_start();
		?>
		<div id="announcement-submission-form" class="announcement-form">
			<form action="#" class="">
				<label for="announcement-form-title">Announcement Title:</label>
				<input type="text" id="announcement-form-title" class="announcement-form-input" name="announcement-title" value="" />
				<div class="announcements-helper-text"><strong>110 character limit</strong> | characters remaining: <span id="announcement-form-title--limit">110</span></div>
				<label for="announcement-form-text">Announcement Text:</label>
				<?php
				$editor_settings = array(
					'wpautop'       => true,
					'media_buttons' => false,
					'textarea_name' => 'announcement-text',
					'textarea_rows' => 15,
					'editor_class'  => 'announcement-form-input',
					'teeny'         => false,
					'dfw'           => false,
					'tinymce'       => array(
						'toolbar1'       => 'bold italic bullist numlist link',
						'toolbar2'       => '',
						'content_css'    => get_stylesheet_directory_uri() . '/style.css',
						'valid_styles'   => '{ "*": "" }', // Disable inline styles.
						'valid_elements' => 'a[href],strong/b,em/i,p,ul,ol,li', // Allow only a subset of HTML elements.
						'paste_as_text'  => true,
					),
					'quicktags'     => false,
				);
				wp_editor( '', 'announcement-form-text', $editor_settings );
				?>
				<div class="announcements-helper-text"><strong>1050 character limit</strong> | characters remaining: <span id="announcement-form-text--limit">1050</span></div>
				<p>
					<label for="announcement-form-date">What date should this announcement be published on?</label>
					<input type="text" id="announcement-form-date" class="announcement-form-input announcement-form-date-input" name="announcement-date" value="" />
				</p>
				<p>
					<label for="announcement-form-email">Your Email Address:</label>
					<input type="text" id="announcement-form-email" class="announcement-form-input" name="announcement-email" value="" />
				</p>
				<p>
					<label for="announcement-form-author">Author/Organization (Required)</label>
					<input type="text" id="announcement-form-author" class="announcement-form-input" name="announcement-author" value="" />
					<span class="announcement-helper">Author Orginization will display on the announcement in the "By:" field</span>
					<span class="announcement-helper">Example: Butch Cougar, University Marketing and Communications</span>
				</p>
				<p id="announcement-other-wrap">
					If you see the following input box, please leave it empty.
					<label for="announcement-form-other">Other Input:</label>
					<input type="text" id="announcement-form-other" class="announcement-form-input" name="announcement-other" value="" />
				</p>
				<div id="announcement-submit-wrap">
					<input type="submit" id="announcement-form-submit" class="announcement-form-input" value="Submit Announcement" />
				</div>
			</form>
		</div>
		<?php
		$output = ob_get_contents();
		ob_end_clean();

		return $output;
	}

	/**
	 * Handle the ajax submission of the announcement form.
	 *
	 * Forked from the original WSU News & Announcements plugin
	 * and adapted for use on WSU Insider.
	 *
	 * @since 0.7.0
	 */
	public static function ajax_callback() {
		if ( ! DOING_AJAX || ! isset( $_POST['action'] ) || 'submit_announcement' !== $_POST['action'] ) { // WPCS: CSRF Ok.
			die();
		}

		// If the honeypot input has anything filled in, we can bail.
		if ( isset( $_POST['other'] ) && '' !== $_POST['other'] ) { // WPCS: CSRF Ok.
			die();
		}

		$title = $_POST['title']; // WPCS: CSRF Ok. Sanitized in wp_insert_post().

		// TinyMCE strips HTML, but not non-breaking spaces.
		$text = str_replace( '&nbsp;', '', $_POST['text'] ); // // WPCS: CSRF Ok. Sanitized in wp_kses_post.

		// Stripping HTML from pasted content leaves a lot of surrounding whitespace!
		$text = trim( $text );

		$text = wp_kses_post( $text );
		$email = sanitize_email( $_POST['email'] );
		$author = wp_kses_post( $_POST['author'] );

		// If a websubmission user exists, we'll use that user ID.
		$user = get_user_by( 'slug', 'websubmission' );

		if ( is_wp_error( $user ) || false === $user ) {
			$user_id = 0;
		} else {
			$user_id = $user->ID;
		}

		$post_date = date( 'Y-m-d H:i:s', strtotime( $_POST['date'] ) ); // WPCS: CSRF Ok.
		$post_date_gmt = get_gmt_from_date( $post_date );

		$post_data = array(
			'comment_status' => 'closed',
			'ping_status'    => 'closed',
			'post_author'    => $user_id,
			'post_content'   => $text,    // Sanitized with wp_kses_post(), probably overly so.
			'post_title'     => $title,   // Sanitized in wp_insert_post().
			'post_type'      => 'wsu_announcement',
			'post_status'    => 'pending',
			'post_date'      => $post_date,
			'post_date_gmt'  => $post_date_gmt,
		);
		$post_id = wp_insert_post( $post_data );

		if ( is_wp_error( $post_id ) ) {
			echo 'error';
			exit;
		}

		update_post_meta( $post_id, '_announcement_contact_email', $email );

		update_post_meta( $post_id, 'announcement_author', $author );

		echo 'success';
		exit;
	}

	/**
	 * Handle an ajax request to copy an announcement to a new post.
	 *
	 * @since 0.8.0
	 */
	public static function ajax_copy_announcement_to_post() {
		check_ajax_referer( 'copy-post-nonce' );

		$post = get_post( absint( $_POST['post_id'] ) );

		if ( ! $post || get_post_type_slug() !== $post->post_type ) {
			wp_send_json_error( 'This is not an announcement.' );
			wp_die();
		}

		$new_post = array(
			'post_title' => $post->post_title,
			'post_content' => $post->post_content,
			'post_type' => 'post',
			'post_status' => 'draft',
		);
		$created_post = wp_insert_post( $new_post );

		if ( is_wp_error( $created_post ) ) {
			wp_send_json_error( $created_post->get_error_message() );
			wp_die();
		}

		$edit_post_link = get_edit_post_link( $created_post );
		update_post_meta( $post->ID, '_copied_post_id', $created_post );

		wp_send_json_success( $edit_post_link );
		wp_die();
	}

}

Announcement::init();
