<?php
/**
 * Functions used for podcast rendering.
 *
 * @package SM/Core/Podcasting
 */

defined( 'ABSPATH' ) or die;

/**
 * Locates and loads the podcast feed template.
 *
 * The view can be overridden by placing a file named "wpfc-podcast-feed.php"
 * in your (child) theme.
 *
 * @since 3.1.5
 */
function sm_load_podcast_template() {
	$overridden_template = locate_template( 'wpfc-podcast-feed.php' );
	if ( $overridden_template ) {
		load_template( $overridden_template );
	} else {
		load_template( SM_PATH . 'views/wpfc-podcast-feed.php' );
	}
}

/**
 * Renders the dedicated podcast feed at `?feed=podcast`.
 *
 * The handler previously registered here, wpfc_podcast_render(), was deprecated
 * to a no-op in 2.13.0, so the route returned an empty body (and logged a
 * deprecation notice) while the real rendering lived only on rss_tag_pre, which
 * fires inside core's feed-rss2.php and so never ran for ?feed=podcast. This
 * handler renders the feed directly. Unlike the rss_tag_pre path it does not
 * inherit core's Content-Type header or XML prolog, so both are emitted here;
 * the template itself begins at the <rss> element.
 *
 * Users can also echo the whole feed manually: `do_action( 'do_feed_podcast' );`.
 *
 * @since 3.1.5
 */
function sm_do_feed_podcast() {
	header( 'Content-Type: ' . feed_content_type( 'rss-http' ) . '; charset=' . get_option( 'blog_charset' ), true );
	echo '<?xml version="1.0" encoding="' . esc_attr( get_option( 'blog_charset' ) ) . '"?>' . "\n";

	sm_load_podcast_template();

	exit;
}
add_action( 'do_feed_podcast', 'sm_do_feed_podcast' );

/**
 * Redirection, if enabled in settings.
 */
add_action( 'parse_request', function () {
	if ( SermonManager::getOption( 'enable_podcast_redirection' ) ) {
		$old_url     = wp_make_link_relative( preg_replace( '{/$}', '', SermonManager::getOption( 'podcast_redirection_old_url' ) ) );
		$current_url = preg_replace( '{/$}', '', $_SERVER['REQUEST_URI'] );

		if ( strpos( $current_url, $old_url ) !== false ) {
			wp_redirect( SermonManager::getOption( 'podcast_redirection_new_url' ), 301 );
			exit;
		}
	}
} );

/**
 * Render the feed.
 *
 * The view can be overridden by placing a file named "wpfc-podcast-feed.php" in your (child) theme.
 */
add_action( 'rss_tag_pre', function () {
	global $post_type, $taxonomy;

	if ( 'wpfc_sermon' === $post_type || in_array( $taxonomy, sm_get_taxonomies() ) ) {
		sm_load_podcast_template();

		exit;
	}
} );
