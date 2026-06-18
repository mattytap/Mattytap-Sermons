<?php
/**
 * Audio Health diagnostic screen.
 *
 * Two read-only reports that surface the audio integrity problems described in
 * issue #49: sermons whose audio reference is broken, and sermon-area audio
 * attachments that no sermon references. Nothing on this screen deletes or
 * changes anything; it is purely diagnostic.
 *
 * @package SM/Core/Admin
 */

defined( 'ABSPATH' ) or die;

/**
 * Audio Health reports.
 *
 * @since 3.1.6
 */
class SM_Admin_Audio_Tools {
	/**
	 * Render the Audio Health page.
	 */
	public static function output() {
		$sermon_ids = self::get_sermon_ids_with_audio();
		$broken     = self::get_broken_references( $sermon_ids );
		$orphans    = self::get_orphaned_audio( $sermon_ids );

		?>
		<div class="wrap">
			<h1><?php esc_html_e( 'Audio Health', 'mattytap-sermons' ); ?></h1>
			<p>
				<?php esc_html_e( 'Read-only checks on the audio attached to your sermons. Nothing here changes or deletes anything.', 'mattytap-sermons' ); ?>
			</p>

			<h2><?php esc_html_e( 'Broken audio references', 'mattytap-sermons' ); ?></h2>
			<p class="description">
				<?php esc_html_e( 'Sermons whose audio attachment or local file is missing. Their player will be dead even though the sermon still looks fine in the list. Externally hosted (URL-only) audio is not checked here.', 'mattytap-sermons' ); ?>
			</p>
			<?php if ( empty( $broken ) ) : ?>
				<p><strong><?php esc_html_e( 'No broken references found.', 'mattytap-sermons' ); ?></strong></p>
			<?php else : ?>
				<table class="widefat striped">
					<thead>
						<tr>
							<th><?php esc_html_e( 'Sermon', 'mattytap-sermons' ); ?></th>
							<th><?php esc_html_e( 'Problem', 'mattytap-sermons' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $broken as $row ) : ?>
							<tr>
								<td>
									<a href="<?php echo esc_url( get_edit_post_link( $row['id'] ) ); ?>">
										<?php echo esc_html( get_the_title( $row['id'] ) ?: __( '(no title)', 'mattytap-sermons' ) ); ?>
									</a>
								</td>
								<td><?php echo esc_html( $row['problem'] ); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>

			<h2><?php esc_html_e( 'Orphaned audio', 'mattytap-sermons' ); ?></h2>
			<p class="description">
				<?php esc_html_e( 'Audio files in the Media Library, uploaded under the sermons folder, that no sermon currently references. These are safe candidates for tidying up by hand once you have confirmed they are not needed.', 'mattytap-sermons' ); ?>
			</p>
			<?php if ( empty( $orphans ) ) : ?>
				<p><strong><?php esc_html_e( 'No orphaned audio found.', 'mattytap-sermons' ); ?></strong></p>
			<?php else : ?>
				<table class="widefat striped">
					<thead>
						<tr>
							<th><?php esc_html_e( 'File', 'mattytap-sermons' ); ?></th>
							<th><?php esc_html_e( 'Uploaded', 'mattytap-sermons' ); ?></th>
							<th><?php esc_html_e( 'Edit', 'mattytap-sermons' ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $orphans as $att_id ) : ?>
							<tr>
								<td><?php echo esc_html( self::attachment_relative_path( $att_id ) ); ?></td>
								<td><?php echo esc_html( get_the_date( '', $att_id ) ); ?></td>
								<td>
									<a href="<?php echo esc_url( get_edit_post_link( $att_id ) ); ?>">
										<?php esc_html_e( 'View in Media Library', 'mattytap-sermons' ); ?>
									</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php endif; ?>
		</div>
		<?php
	}

	/**
	 * Get the IDs of every sermon that has any audio reference set.
	 *
	 * @return int[] Sermon post IDs.
	 */
	private static function get_sermon_ids_with_audio() {
		$query = new WP_Query(
			array(
				'post_type'           => 'wpfc_sermon',
				'post_status'         => 'any',
				'posts_per_page'      => -1,
				'fields'              => 'ids',
				'no_found_rows'       => true,
				'ignore_sticky_posts' => true,
				'meta_query'          => array(
					'relation'             => 'OR',
					'audio_url_clause'     => array(
						'key'     => 'sermon_audio',
						'value'   => '',
						'compare' => '!=',
					),
					'audio_id_clause'      => array(
						'key'     => 'sermon_audio_id',
						'value'   => '',
						'compare' => '!=',
					),
				),
			)
		);

		return array_map( 'intval', $query->posts );
	}

	/**
	 * Find sermons whose audio attachment or local file is missing.
	 *
	 * @param int[] $sermon_ids Sermon post IDs to check.
	 *
	 * @return array[] Rows of array( 'id' => int, 'problem' => string ).
	 */
	private static function get_broken_references( $sermon_ids ) {
		$broken = array();

		foreach ( $sermon_ids as $sermon_id ) {
			$audio_id  = (int) get_post_meta( $sermon_id, 'sermon_audio_id', true );
			$audio_url = (string) get_post_meta( $sermon_id, 'sermon_audio', true );
			$problem   = '';

			if ( $audio_id > 0 ) {
				$attachment = get_post( $audio_id );

				if ( ! $attachment || 'attachment' !== $attachment->post_type ) {
					// translators: %d: attachment ID.
					$problem = wp_sprintf( __( 'Audio attachment (ID %d) no longer exists.', 'mattytap-sermons' ), $audio_id );
				} else {
					$path = get_attached_file( $audio_id );

					if ( ! $path || ! file_exists( $path ) ) {
						$problem = __( 'Audio file is missing from disk.', 'mattytap-sermons' );
					}
				}
			} elseif ( '' !== $audio_url && self::is_local_url( $audio_url ) ) {
				// URL-only audio: only local files are ours to check. Remote
				// audio is deliberately left alone (see issue #49).
				$path = self::local_url_to_path( $audio_url );

				if ( ! $path || ! file_exists( $path ) ) {
					$problem = __( 'Local audio file is missing from disk.', 'mattytap-sermons' );
				}
			}

			if ( '' !== $problem ) {
				$broken[] = array(
					'id'      => $sermon_id,
					'problem' => $problem,
				);
			}
		}

		return $broken;
	}

	/**
	 * Find sermon-area audio attachments that no sermon references.
	 *
	 * @param int[] $sermon_ids Sermon post IDs that have audio.
	 *
	 * @return int[] Orphaned attachment IDs.
	 */
	private static function get_orphaned_audio( $sermon_ids ) {
		// Build the sets of attachment IDs and URLs that sermons reference.
		$referenced_ids  = array();
		$referenced_urls = array();

		foreach ( $sermon_ids as $sermon_id ) {
			$audio_id = (int) get_post_meta( $sermon_id, 'sermon_audio_id', true );
			if ( $audio_id > 0 ) {
				$referenced_ids[ $audio_id ] = true;
			}

			$audio_url = (string) get_post_meta( $sermon_id, 'sermon_audio', true );
			if ( '' !== $audio_url ) {
				$referenced_urls[ self::normalize_url( $audio_url ) ] = true;
			}
		}

		// Audio attachments uploaded under the plugin's /sermons upload area.
		$attachments = get_posts(
			array(
				'post_type'      => 'attachment',
				'post_mime_type' => 'audio',
				'post_status'    => 'inherit',
				'posts_per_page' => -1,
				'fields'         => 'ids',
				'no_found_rows'  => true,
				'meta_query'     => array(
					'sermon_path_clause' => array(
						'key'     => '_wp_attached_file',
						'value'   => 'sermons/',
						'compare' => 'LIKE',
					),
				),
			)
		);

		$orphans = array();

		foreach ( $attachments as $att_id ) {
			$att_id = (int) $att_id;

			if ( isset( $referenced_ids[ $att_id ] ) ) {
				continue;
			}

			$url = wp_get_attachment_url( $att_id );

			if ( $url && isset( $referenced_urls[ self::normalize_url( $url ) ] ) ) {
				continue;
			}

			$orphans[] = $att_id;
		}

		return $orphans;
	}

	/**
	 * Whether a URL points at this site (so its file is ours to check).
	 *
	 * @param string $url The URL to test.
	 *
	 * @return bool True if the URL host matches the site host.
	 */
	private static function is_local_url( $url ) {
		$url_host  = wp_parse_url( $url, PHP_URL_HOST );
		$home_host = wp_parse_url( home_url(), PHP_URL_HOST );

		// A path-only URL (no host) is local by definition.
		return empty( $url_host ) || $url_host === $home_host;
	}

	/**
	 * Map a local uploads URL to its absolute path on disk.
	 *
	 * @param string $url The local URL.
	 *
	 * @return string|false The absolute path, or false if it is not under uploads.
	 */
	private static function local_url_to_path( $url ) {
		$uploads = wp_get_upload_dir();

		if ( empty( $uploads['baseurl'] ) || false === strpos( $url, $uploads['baseurl'] ) ) {
			return false;
		}

		return str_replace( $uploads['baseurl'], $uploads['basedir'], $url );
	}

	/**
	 * Normalise a URL for comparison (strip scheme and any query string).
	 *
	 * Sermons store the audio URL with whichever scheme was current when saved,
	 * so compare on the host-and-path remainder to avoid http/https mismatches.
	 *
	 * @param string $url The URL to normalise.
	 *
	 * @return string The scheme-less, query-less URL.
	 */
	private static function normalize_url( $url ) {
		$url = strtok( $url, '?' );

		return preg_replace( '#^https?://#i', '', $url );
	}

	/**
	 * The attachment's path relative to the uploads directory, for display.
	 *
	 * @param int $att_id Attachment ID.
	 *
	 * @return string Relative path, or the bare file name.
	 */
	private static function attachment_relative_path( $att_id ) {
		$file = get_post_meta( $att_id, '_wp_attached_file', true );

		return $file ? $file : wp_basename( (string) get_attached_file( $att_id ) );
	}
}
