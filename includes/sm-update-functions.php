<?php
/**
 * Functions used by database updater go here.
 *
 * @package SM/Core/Updating
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

/**
 * Renames all "sermon_date_old" fields to "sermon_date" if "sermon_date" is not set.
 */
function sm_update_28_revert_old_dates() {
	if ( get_option( 'wpfc_sm_dates_restore_done' ) ) {
		return;
	}

	global $wpdb;

	foreach ( $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_date FROM $wpdb->posts WHERE post_type = %s AND post_status NOT IN ('auto-draft', 'inherit')", 'wpfc_sermon' ) ) as $sermon ) {
		$date = get_post_meta( $sermon->ID, 'sermon_date_old', true );

		if ( '' === get_post_meta( $sermon->ID, 'sermon_date', true ) && '' !== $date ) {
			update_post_meta( $sermon->ID, 'sermon_date', is_numeric( $date ) ?: strtotime( $date ) );
			delete_post_meta( $sermon->ID, 'sermon_date_old' );
		}
	}

	// Clear all cached data.
	wp_cache_flush();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Final dates conversion for users who skipped converters in previous SM versions.
 *
 * Basically, converts "sermon_date" value to Unix time if it's not numeric.
 */
function sm_update_28_convert_dates_to_unix() {
	global $wpdb;

	// All sermons.
	$sermons = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_date FROM $wpdb->posts WHERE post_type = %s AND post_status NOT IN ('auto-draft', 'inherit')", 'wpfc_sermon' ) );

	foreach ( $sermons as $sermon ) {
		$date = get_post_meta( $sermon->ID, 'sermon_date', true );

		if ( $date ) {
			if ( ! is_numeric( $date ) ) {
				update_post_meta( $sermon->ID, 'sermon_date', strtotime( $date ) );
			}
		}
	}

	// Clear all cached data.
	wp_cache_flush();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Fills out dates of sermons that don't have `sermon_date` set. Takes "Published" date for them and marks
 * them as auto-filled, so they get updated when Published date gets updated.
 */
function sm_update_28_fill_out_empty_dates() {
	global $wpdb;

	// All sermons.
	$sermons = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_date FROM $wpdb->posts WHERE post_type = %s AND post_status NOT IN ('auto-draft', 'inherit')", 'wpfc_sermon' ) );

	foreach ( $sermons as $sermon ) {
		if ( get_post_meta( $sermon->ID, 'sermon_date', true ) === '' ) {
			update_post_meta( $sermon->ID, 'sermon_date', strtotime( $sermon->post_date ) );
			update_post_meta( $sermon->ID, 'sermon_date_auto', '1' );
		}
	}

	// Clear all cached data.
	wp_cache_flush();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * For enabling sorting by series date.
 *
 * @see SM_Dates_WP::update_series_date()
 */
function sm_update_28_fill_out_series_dates() {
	SM_Dates_WP::update_series_date();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Renders sermon text and saves as "post_content", for better search compatibility.
 *
 * @since 2.11.0 updated to render text and not HTML.
 */
function sm_update_28_save_sermon_render_into_post_content() {
	sm_update_211_render_content();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * We had a bug from 2.8 to 2.8.3, so we will do it again.
 */
function sm_update_284_resave_sermons() {
	sm_update_28_save_sermon_render_into_post_content();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * There was a bug in function for 2.8, so we will do it again.
 */
function sm_update_29_fill_out_series_dates() {
	sm_update_28_fill_out_series_dates();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Settings storage has been changed in 2.9
 */
function sm_update_29_convert_settings() {
	$original_settings = get_option( 'wpfc_options', array() );

	foreach ( $original_settings as $key => $value ) {
		add_option( 'sermonmanager_' . $key, $value );
	}

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * SB and SE import did not import dates correctly. This function imports them for those who did import.
 */
function sm_update_293_fix_import_dates() {
	sm_update_28_fill_out_empty_dates();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Removed Bibly so we will change option names.
 */
function sm_update_210_update_options() {
	if ( is_bool( SermonManager::getOption( 'bibly' ) ) ) {
		add_option( 'sermonmanager_verse_popup', SermonManager::getOption( 'bibly' ) ? 'yes' : 'no' );
	}

	$bible_version = SermonManager::getOption( 'bibly_version' );
	if ( $bible_version ) {
		add_option( 'sermonmanager_verse_bible_version', $bible_version );
	}

	if ( is_bool( SermonManager::getOption( 'use_old_player' ) ) ) {
		add_option( 'sermonmanager_player', SermonManager::getOption( 'use_old_player' ) ? 'WordPress' : 'plyr' );
	}

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Re-renders all sermon content into database as text; for better compatibility with search engines, etc...
 */
function sm_update_211_render_content() {
	global $wpdb;

	// All sermons.
	$sermons = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type = %s", 'wpfc_sermon' ) );

	$sermon_manager = \SermonManager::get_instance();

	foreach ( $sermons as $sermon ) {
		$sermon_manager->render_sermon_into_content( $sermon->ID, get_post( $sermon->ID ), true );
	}

	// Clear all cached data.
	wp_cache_flush();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Adds time alongside date in sermon date option.
 */
function sm_update_211_update_date_time() {
	global $wpdb;

	// All sermons.
	$sermons = $wpdb->get_results( $wpdb->prepare( "SELECT ID, post_date FROM $wpdb->posts WHERE post_type = %s", 'wpfc_sermon' ) );

	foreach ( $sermons as $sermon ) {
		$sermon_date = get_post_meta( $sermon->ID, 'sermon_date', true );

		if ( $sermon_date ) {
			$dt      = DateTime::createFromFormat( 'U', $sermon_date );
			$dt_post = DateTime::createFromFormat( 'U', mysql2date( 'U', $sermon->post_date ) );

			$time = array(
				$dt_post->format( 'H' ),
				$dt_post->format( 'i' ),
				$dt_post->format( 's' ),
			);

			// Convert all to ints.
			$time = array_map( 'intval', $time );

			list( $hours, $minutes, $seconds ) = $time;

			if ( $dt instanceof DateTime && $dt->format( 'U' ) != $GLOBALS['sm_original_sermon_date'] ) {
				$dt->setTime( $hours, $minutes, $seconds );

				update_post_meta( $sermon->ID, 'sermon_date', $dt->format( 'U' ) );
				update_post_meta( $sermon->ID, 'sermon_date_auto', 0 );
			}
		}
	}

	// Clear all cached data.
	wp_cache_flush();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * There was a bug that prevented preacher slug to be used as a permalink as well.
 */
function sm_update_2123_fix_preacher_permalink() {
	flush_rewrite_rules();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * For enabling sorting by sermon date, in all terms.
 *
 * @see SM_Dates_WP::update_term_dates()
 */
function sm_update_2130_fill_out_sermon_term_dates() {
	SM_Dates_WP::update_term_dates();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Removes old auto-generated excerpts
 */
function sm_update_2130_remove_excerpts() {
	$sermons = new WP_Query( array(
		'post_type'      => 'wpfc_sermon',
		'meta_key'       => 'sermon_date',
		'meta_value_num' => time(),
		'meta_compare'   => '<=',
		'orderby'        => 'meta_value_num',
		'order'          => 'DESC',
		'posts_per_page' => - 1,
	) );

	foreach ( $sermons->posts as $sermon ) {
		wp_update_post( array(
			'ID'           => $sermon->ID,
			'post_excerpt' => '',
		) );
	}

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Converts bible verses from Sermon Browser to Sermon Manager format.
 */
function sm_update_2140_convert_bible_verse() {
	global $wpdb;

	// All sermons.
	$sermons = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type = %s", 'wpfc_sermon' ) );

	foreach ( $sermons as $sermon ) {
		$id = $sermon->ID;

		if ( get_post_meta( $id, 'bible_passage', true ) ) {
			continue;
		}

		$bible_passage_start = get_post_meta( $id, 'bible_passages_start', true );
		$bible_passage_end   = get_post_meta( $id, 'bible_passages_end', true );

		if ( $bible_passage_start && $bible_passage_end ) {
			$bible_passage_start = unserialize( $bible_passage_start, array( 'allowed_classes' => false ) );
			$bible_passage_end   = unserialize( $bible_passage_end, array( 'allowed_classes' => false ) );
			$bible_passage       = '';

			/**
			 * 'John' '2' '11' ... 'John' '2' '11' => 'John 2:11'
			 * 'John' '2' '11' ... 'John' '2' '12' => 'John 2:11-12'
			 * 'John' '2' '11' ... 'John' '3' '12' => 'John 2:11-3:12'
			 * 'John' '2' '11' ... 'Luke' '3' '12' => 'John 2:11-Luke 3:12'
			 */

			foreach ( $bible_passage_start as $id => $data_start ) {
				$data_start = array(
					'book'    => sanitize_text_field( $data_start['book'] ),
					'chapter' => intval( $data_start['chapter'] ),
					'verse'   => intval( $data_start['verse'] ),
				);

				$bible_passage .= $data_start['book'] . ' ' . $data_start['chapter'] . ':' . $data_start['verse'];

				if ( $bible_passage_end[ $id ] ) {
					$data_end = $bible_passage_end[ $id ];

					$data_end = array(
						'book'    => sanitize_text_field( $data_end['book'] ),
						'chapter' => intval( $data_end['chapter'] ),
						'verse'   => intval( $data_end['verse'] ),
					);

					if ( $data_end['book'] !== $data_start['book'] ) {
						$bible_passage .= '-' . $data_end['book'] . ' ' . $data_end['chapter'] . ':' . $data_end['verse'];
					} else {
						if ( $data_end['chapter'] !== $data_start['chapter'] ) {
							$bible_passage .= '-' . $data_end['chapter'] . ':' . $data_end['verse'];
						} elseif ( $data_end['verse'] !== $data_start['verse'] ) {
							$bible_passage .= '-' . $data_end['verse'];
						}
					}
				}

				if ( count( $bible_passage_start ) > 1 && count( $bible_passage_start ) - 1 !== $id ) {
					$bible_passage .= ', ';
				}
			}

			update_post_meta( $sermon->ID, 'bible_passage', $bible_passage );
		}
	}

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Removes file ID of the files where they point to external URL.
 *
 * Future IDs won't be saved in that scenario.
 */
function sm_update_2150_audio_file_ids() {
	global $wpdb;

	// All sermons.
	$sermons = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type = %s", 'wpfc_sermon' ) );

	foreach ( $sermons as $sermon ) {
		$id = $sermon->ID;

		$audio_id  = get_post_meta( $id, 'sermon_audio_id', true );
		$audio_url = get_post_meta( $id, 'sermon_audio', true );

		if ( $audio_url && $audio_id ) {
			$parsed_audio_url   = wp_parse_url( $audio_url, PHP_URL_HOST );
			$parsed_website_url = wp_parse_url( home_url(), PHP_URL_HOST );

			if ( $parsed_audio_url !== $parsed_website_url ) {
				update_post_meta( $id, 'sermon_audio_id', '' );
			}
		}
	}

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Update sermon audio duration and file size.
 */
function sm_update_2150_audio_duration_and_size() {
	global $wpdb;

	// All sermons.
	$sermons = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type = %s", 'wpfc_sermon' ) );

	foreach ( $sermons as $sermon ) {
		$id = $sermon->ID;

		$audio_id = get_post_meta( $id, 'sermon_audio_id', true );

		if ( $audio_id ) {
			$attachment_data = wp_get_attachment_metadata( $audio_id );

			if ( $attachment_data ) {
				if ( isset( $attachment_data['length'] ) ) {
					update_post_meta( $id, '_wpfc_sermon_duration', gmdate( 'H:i:s', $attachment_data['length'] ) );
				}

				if ( isset( $attachment_data['filesize'] ) ) {
					update_post_meta( $id, '_wpfc_sermon_size', $attachment_data['filesize'] );
				}
			}
		}
	}

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * The default image was not right, since it looked too much link an ad, so we removed it in 2.15.2.
 * We need to remove the option if it was already set to it.
 */
function sm_update_2152_remove_default_image() {
	if ( strpos( get_option( 'sermonmanager_default_image' ), 'SermonManagerDefaultImage.jpg' ) !== false ) {
		update_option( 'sermonmanager_default_image', '' );
	}

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Updates all term dates so we can sort terms by latest sermon.
 */
function sm_update_21511_update_term_dates() {
	global $wpdb;

	// All sermons.
	$sermons = $wpdb->get_results( $wpdb->prepare( "SELECT ID FROM $wpdb->posts WHERE post_type = %s", 'wpfc_sermon' ) );

	foreach ( $sermons as $sermon ) {
		$id = $sermon->ID;

		$terms = wp_get_object_terms( $id, sm_get_taxonomies() );

		foreach ( $terms as $term ) {
			update_term_meta( $term->term_id, 'sermon_date_' . $id, get_post_meta( $id, 'sermon_date', true ) );
		}
	}

	SM_Dates_WP::update_term_dates();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Re-update term dates that were not updated due to a bug.
 *
 * @see SM_Dates_WP::update_term_dates()
 */
function sm_update_21516_update_term_dates() {
	sm_update_21511_update_term_dates();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Rebuild `sm_term_image_id` term_meta from the legacy taxonomy-images
 * `sermon_image_plugin` option, keyed correctly by term_id.
 *
 * Background: the bundled taxonomy-images library (removed in the restoration,
 * see #28) stored series/preacher/topic/book images in its own
 * `sermon_image_plugin` option, keyed by *term_taxonomy_id*. The original
 * 2.16.0 migration copied that option into native `sm_term_image_id` term_meta
 * but treated each key as a *term_id*, so on any site where term_id is not
 * equal to term_taxonomy_id the image landed on the wrong term (#53). This
 * helper is the single correct code path shared by the first-run migration and
 * the repair re-runner.
 *
 * Process:
 *   1. Snapshot every existing `sm_term_image_id` row once into
 *      `sm_term_image_repair_backup` (term_id => attachment_id) so a bad
 *      rebuild is recoverable.
 *   2. Clear stray rows: for each option entry, if the term whose term_id
 *      equals the mis-used tt_id still holds exactly the value the broken
 *      migration wrote, delete it. A value a human changed since will not match
 *      and is left untouched.
 *   3. Write each image onto the correct term, resolving term_taxonomy_id to
 *      term_id via get_term_by().
 *
 * The original `sermon_image_plugin` option is only read, never modified, so it
 * remains the source of truth and this helper is safely idempotent.
 *
 * @since 3.4.1
 */
function sm_migrate_term_images_from_option() {
	$associations = get_option( 'sermon_image_plugin', array() );

	if ( ! is_array( $associations ) || empty( $associations ) ) {
		return;
	}

	// 1. One-time backup of the current term-image rows, before any change.
	if ( false === get_option( 'sm_term_image_repair_backup', false ) ) {
		global $wpdb;

		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching -- One-off snapshot of all sm_term_image_id rows for rollback; caching is not applicable to a migration.
		$rows = $wpdb->get_results( "SELECT term_id, meta_value FROM {$wpdb->termmeta} WHERE meta_key = 'sm_term_image_id'", ARRAY_A );

		$backup = array();
		foreach ( (array) $rows as $row ) {
			$backup[ (int) $row['term_id'] ] = (int) $row['meta_value'];
		}

		update_option( 'sm_term_image_repair_backup', $backup, false );
	}

	// 2. Remove rows the mis-keyed migration wrote, leaving manual edits alone.
	foreach ( $associations as $tt_id => $attachment_id ) {
		$tt_id         = (int) $tt_id;
		$attachment_id = (int) $attachment_id;

		if ( ! $tt_id || ! $attachment_id ) {
			continue;
		}

		if ( (int) get_term_meta( $tt_id, 'sm_term_image_id', true ) === $attachment_id ) {
			delete_term_meta( $tt_id, 'sm_term_image_id' );
		}
	}

	// 3. Write each image onto the correct term (term_taxonomy_id -> term_id).
	foreach ( $associations as $tt_id => $attachment_id ) {
		$tt_id         = (int) $tt_id;
		$attachment_id = (int) $attachment_id;

		if ( ! $tt_id || ! $attachment_id ) {
			continue;
		}

		$term = get_term_by( 'term_taxonomy_id', $tt_id );

		if ( $term instanceof WP_Term ) {
			update_term_meta( $term->term_id, 'sm_term_image_id', $attachment_id );
		}
	}
}

/**
 * Migrate the bundled taxonomy-images library's term/attachment associations
 * out of the `sermon_image_plugin` option and into per-term `sm_term_image_id`
 * term_meta rows.
 *
 * Delegates to sm_migrate_term_images_from_option(), which keys by term_id
 * correctly. The `sm_term_image_migrated_to_meta` sentinel is set on completion
 * for diagnostics and the repair re-runner.
 *
 * @since 2.16.0
 */
function sm_update_2160_migrate_term_images() {
	sm_migrate_term_images_from_option();

	// Sentinel for "this site has been migrated", separate from the framework
	// per-function done-flag so the repair re-runner can use a different name.
	update_option( 'sm_term_image_migrated_to_meta', 1 );

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}

/**
 * Repair re-runner for #53: rebuild `sm_term_image_id` term_meta correctly from
 * the preserved `sermon_image_plugin` option.
 *
 * The original 2.16.0 migration mis-keyed the legacy option by term_id when its
 * keys are term_taxonomy_ids, scattering series/preacher/topic/book images onto
 * the wrong terms. Sites that already ran it carry its done-flag, so the
 * corrected 2.16.0 callback will not re-run for them; this callback has its own
 * done-flag and so runs once on every existing site to repair it.
 *
 * @since 3.4.1
 */
function sm_update_341_repair_term_images() {
	sm_migrate_term_images_from_option();

	// Mark it as done, backup way.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals -- Legacy upstream option-key prefix; drop-in compat with Sermon Manager.
	update_option( 'wp_sm_updater_' . __FUNCTION__ . '_done', 1 );
}
