<?php
/**
 * A landing for sites coming from Sermon Manager Pro.
 *
 * Pro's sermons are ordinary Sermon Manager data and carry over as they are.
 * What doesn't carry over is Pro's own page furniture, so this file makes the
 * switch degrade gracefully: Pro's sermon shortcodes render a standard sermon
 * list (or nothing) instead of raw shortcode text, and administrators are told
 * once, plainly, what has changed. Pro's data is never modified.
 *
 * @package SM/Core/Compat
 * @since   3.5.0
 */

defined( 'ABSPATH' ) or die;

/**
 * Renders Pro's sermon archive shortcodes as the plugin's own [sermons].
 *
 * Covers [smpro_archive] and the WPBakery and Divi equivalents. The settings a
 * site is likely to have used are carried across: how many sermons, sort order,
 * chosen IDs, a series or other term, filters and pagination. Pro-only layout
 * settings (columns, rows, caching, masonry) have no equivalent and are ignored.
 *
 * @since 3.5.0
 *
 * @param array|string $atts Pro shortcode attributes.
 *
 * @return string The sermon list HTML.
 */
function sm_pro_compat_archive_shortcode( $atts ) {
	if ( is_admin() ) {
		return '';
	}

	$atts = (array) $atts;
	$args = array();

	foreach ( array( 'limit', 'count', 'per_page', 'posts_per_page' ) as $key ) {
		if ( isset( $atts[ $key ] ) && '' !== $atts[ $key ] ) {
			$args['per_page'] = absint( $atts[ $key ] );
			break;
		}
	}

	if ( ! empty( $atts['orderby'] ) ) {
		// Pro's "date" meant the published date; the plugin's own "date" follows the archive setting.
		$orderby_map     = array(
			'date'          => 'date_published',
			'date_preached' => 'date_preached',
			'title'         => 'title',
			'rand'          => 'rand',
		);
		$orderby         = strtolower( sanitize_key( $atts['orderby'] ) );
		$args['orderby'] = isset( $orderby_map[ $orderby ] ) ? $orderby_map[ $orderby ] : 'date_preached';
	}

	if ( ! empty( $atts['order'] ) ) {
		$args['order'] = 'ASC' === strtoupper( $atts['order'] ) ? 'ASC' : 'DESC';
	}

	if ( ! empty( $atts['ids'] ) ) {
		$args['include'] = implode( ',', array_filter( array_map( 'absint', explode( ',', $atts['ids'] ) ) ) );
	}

	if ( ! empty( $atts['taxonomy'] ) && ! empty( $atts['terms'] ) ) {
		$taxonomy = sanitize_key( $atts['taxonomy'] );

		if ( in_array( $taxonomy, sm_get_taxonomies(), true ) ) {
			// Pro accepted slugs or IDs; [sermons] matches by slug, so turn IDs into slugs here.
			$slugs = array();

			foreach ( explode( ',', $atts['terms'] ) as $term ) {
				$term = trim( $term );

				if ( is_numeric( $term ) ) {
					$term_object = get_term( (int) $term, $taxonomy );
					$term        = $term_object instanceof WP_Term ? $term_object->slug : '';
				}

				if ( '' !== $term ) {
					$slugs[] = sanitize_title( $term );
				}
			}

			if ( $slugs ) {
				$args['filter_by']    = $taxonomy;
				$args['filter_value'] = implode( ',', $slugs );
			}
		}
	}

	// Pro showed the filter bar unless told not to; [sermons] hides it unless told to show it.
	$filtering            = isset( $atts['filtering'] ) ? strtolower( (string) $atts['filtering'] ) : 'yes';
	$args['hide_filters'] = in_array( $filtering, array( 'no', 'false', '0', 'off' ), true ) ? 'yes' : 'no';

	foreach ( array( 'hide_topics', 'hide_series', 'hide_preachers', 'hide_books', 'hide_service_types' ) as $key ) {
		if ( ! empty( $atts[ $key ] ) ) {
			$args[ $key ] = sanitize_key( $atts[ $key ] );
		}
	}

	if ( isset( $atts['paginate'] ) && in_array( strtolower( (string) $atts['paginate'] ), array( 'no', 'false', '0', 'off' ), true ) ) {
		$args['disable_pagination'] = 1;
	}

	return SM_Shortcodes::get_instance()->display_sermons( $args );
}

/**
 * Renders Pro's sermon taxonomy shortcodes as nothing.
 *
 * Under Pro these only did anything on series, preacher and topic pages, which
 * the plugin now renders itself. Visited directly they showed Pro's setup
 * message, so after the switch the page keeps its title and nothing else.
 *
 * @since 3.5.0
 *
 * @return string An empty string.
 */
function sm_pro_compat_taxonomy_shortcode() {
	return '';
}

/**
 * Registers the Pro shortcode names, each only if nothing else has claimed it.
 *
 * @since 3.5.0
 */
function sm_pro_compat_register_shortcodes() {
	$shortcodes = array(
		'smpro_archive'       => 'sm_pro_compat_archive_shortcode',
		'sermon_blog'         => 'sm_pro_compat_archive_shortcode',
		'smp_sermon_blog'     => 'sm_pro_compat_archive_shortcode',
		'smpro_tax'           => 'sm_pro_compat_taxonomy_shortcode',
		'sermon_taxonomy'     => 'sm_pro_compat_taxonomy_shortcode',
		'smp_sermon_taxonomy' => 'sm_pro_compat_taxonomy_shortcode',
	);

	foreach ( $shortcodes as $tag => $callback ) {
		if ( ! shortcode_exists( $tag ) ) {
			add_shortcode( $tag, $callback );
		}
	}
}

// Late, so that a page builder or other plugin that owns one of these names keeps it.
add_action( 'wp_loaded', 'sm_pro_compat_register_shortcodes' );

/**
 * Whether Sermon Manager Pro has left its data on this site.
 *
 * @since 3.5.0
 *
 * @return bool True if any of Pro's own markers are present.
 */
function sm_pro_compat_data_found() {
	if ( get_option( 'smp_version' ) || get_option( 'sm_template' ) || get_option( 'smp_new_templates' ) ) {
		return true;
	}

	$podcasts = get_posts(
		array(
			'post_type'      => 'wpfc_sm_podcast',
			'post_status'    => 'any',
			'posts_per_page' => 1,
			'fields'         => 'ids',
		)
	);

	return ! empty( $podcasts );
}

/**
 * Shows administrators a one-time notice explaining what changed after leaving Pro.
 *
 * @since 3.5.0
 */
function sm_pro_compat_notice() {
	if ( ! current_user_can( 'manage_options' ) || get_option( 'sm_pro_compat_notice_dismissed' ) ) {
		return;
	}

	if ( ! sm_pro_compat_data_found() ) {
		return;
	}

	$dismiss_url = wp_nonce_url( add_query_arg( 'sm_pro_compat_dismiss', '1' ), 'sm_pro_compat_dismiss' );
	?>
	<div class="notice notice-info">
		<p><strong><?php esc_html_e( 'Mattytap Sermons found settings left by Sermon Manager Pro.', 'mattytap-sermons' ); ?></strong></p>
		<p><?php esc_html_e( 'Your sermons, series, preachers, files and main podcast feed have all carried over. Pro\'s custom layouts, its extra podcasts and its page-builder widgets are not part of Mattytap Sermons: pages that used Pro\'s sermon archive shortcode now show the standard sermon list, and Pro\'s extra podcast feeds now carry every sermon. Pro\'s data is left untouched in the database.', 'mattytap-sermons' ); ?></p>
		<p>
			<a href="https://wordpress.org/plugins/mattytap-sermons/#faq"><?php esc_html_e( 'Read more about switching from Pro', 'mattytap-sermons' ); ?></a>
			&nbsp;|&nbsp;
			<a href="<?php echo esc_url( $dismiss_url ); ?>"><?php esc_html_e( 'Dismiss this notice', 'mattytap-sermons' ); ?></a>
		</p>
	</div>
	<?php
}

add_action( 'admin_notices', 'sm_pro_compat_notice' );

/**
 * Records the notice as dismissed, for every administrator.
 *
 * @since 3.5.0
 */
function sm_pro_compat_dismiss() {
	if ( ! isset( $_GET['sm_pro_compat_dismiss'] ) || ! current_user_can( 'manage_options' ) ) {
		return;
	}

	check_admin_referer( 'sm_pro_compat_dismiss' );
	update_option( 'sm_pro_compat_notice_dismissed', 1, false );
	wp_safe_redirect( remove_query_arg( array( 'sm_pro_compat_dismiss', '_wpnonce' ) ) );
	exit;
}

add_action( 'admin_init', 'sm_pro_compat_dismiss' );
