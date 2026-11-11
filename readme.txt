=== Mattytap Sermons ===
Contributors: mattytap
Tags: church, sermon, podcast, preaching, audio
Requires at least: 6.0
Tested up to: 7.1
Requires PHP: 8.1
Stable tag: 3.8.1
License: GPLv2
License URI: https://www.gnu.org/licenses/gpl-2.0.html

A maintained restoration of Sermon Manager: publish, organise, and podcast sermons on a WordPress site.

== Description ==

Mattytap Sermons lets a church publish sermons online with the structure they actually need: speakers, series, topics, books of the Bible, and service types, all as proper WordPress taxonomies, all searchable, all filterable. Add audio and video, attach handouts (PDF, DOC, PPT, anything), embed video from YouTube or Vimeo, and ship a fully-featured iTunes-compatible podcast feed for the whole library or for any individual series, speaker, topic, or book.

Mattytap Sermons is a maintained restoration of [Sermon Manager](https://wordpress.org/plugins/sermon-manager-for-wordpress/) by WP for Church. The original plugin was last published to WordPress.org in September 2024 (version 2.30.0); the upstream maintainer's web presence is no longer reachable, and several publicly-disclosed CVEs remain unpatched in 2.30.0 and earlier. Mattytap Sermons is the successor line. Existing Sermon Manager installs (including 2.30.0) can switch to Mattytap Sermons as a drop-in replacement: the database schema, custom post type (`wpfc_sermon`), taxonomies (`wpfc_preacher`, `wpfc_sermon_series`, etc.), all `wpfc_*` option keys, six core shortcodes, and view templates are preserved. Multi-attachments for notes and bulletin, post-body editor support, and Twenty Twenty-Four theme wrapper are cherry-picked from upstream 2.30.0.

= What Mattytap Sermons preserves =

* Same shortcodes (`[sermons]`, `[sermon_images]`, `[list_podcasts]`, `[list_sermons]`, `[latest_series]`, `[sermon_sort_fields]`)
* Same custom post type and taxonomies: existing sermon data carries over without import
* Same template files in `views/`: existing theme overrides continue to work
* Same Bib.ly Bible-reference integration
* Same iTunes-compatible podcast feeds

= What's new in Mattytap Sermons =

* Active security maintenance, with [private vulnerability reporting](https://github.com/mattytap/Mattytap-Sermons/security) for responsible disclosure
* Modernised for PHP 8.1+ and WordPress 6.0+
* Bundled outdated third-party dependencies removed or upgraded (CMB2, wp-background-processing, the entry-views polyfill, taxonomy-images)
* Continuing development on [GitHub](https://github.com/mattytap/Mattytap-Sermons)

= Popular shortcodes =

* `[sermons]`: list the 10 most recent sermons
* `[sermons per_page="20"]`: list the 20 most recent sermons
* `[sermon_images]`: list all sermon series with associated image in a grid
* `[list_podcasts]`: list available podcast services with large buttons
* `[list_sermons]`: list all series or speakers in a simple unordered list
* `[latest_series]`: display information about the latest sermon series, including the image, title, and description
* `[sermon_sort_fields]`: dropdown selections to navigate to sermons by series or speaker

== Installation ==

1. Use the "Add New" button in the Plugins section of your WordPress dashboard. Search for "Mattytap Sermons".
2. Activate the plugin.
3. Add a sermon through the dashboard.
4. Display sermons on the front end via shortcode (`[sermons]` in any page or post), or by visiting `https://yourdomain.example/sermons` (with pretty permalinks enabled) or `https://yourdomain.example/?post_type=wpfc_sermon` (without).

= Migrating from Sermon Manager =

If you have an existing Sermon Manager install, install and activate Mattytap Sermons, then deactivate Sermon Manager. All your sermons, speakers, series, topics, and settings carry over without further action. The two plugins use the same database schema. Don't run both at once; the schema overlap will cause conflicts.

= Migrating from Sermon Browser or Series Engine =

Mattytap Sermons inherits Sermon Manager's import functionality for these older sermon plugins. Once Mattytap Sermons is activated, the importer is available under Tools → Import.

== Frequently Asked Questions ==

= How do I display sermons on the front end? =

Use the shortcode `[sermons]` in any page or post, or visit `https://yourdomain.example/sermons` (with pretty permalinks enabled) or `https://yourdomain.example/?post_type=wpfc_sermon` (without).

= How do I create a menu link to the sermons archive? =

Go to Appearance → Menus. In "Custom Links" add `https://yourdomain.example/?post_type=wpfc_sermon` as the URL and "Sermons" as the label. Click "Add to Menu".

= Is Mattytap Sermons a maintained replacement for Sermon Manager? =

Yes. Sermon Manager is no longer receiving updates, and Mattytap Sermons continues it as a faithful restoration: the same plugin brought up to date for current WordPress and PHP, with security fixes, and actively maintained. Your existing sermons, taxonomies, and settings carry over unchanged. Full credit to the original authors is in the Credits section.

= I'm coming from Sermon Manager. Will my sermons survive? =

Yes. Mattytap Sermons uses the same database schema, custom post type, taxonomies, and option keys as Sermon Manager. Activate Mattytap Sermons, deactivate Sermon Manager, and existing sermons keep working. Don't run both at once. The overlapping schema will conflict.

= I'm coming from Sermon Manager Pro. What carries over? =

Your sermons, series, preachers, topics, books, service types, files and preached dates all carry over, because Pro kept them in Sermon Manager's own format. Your main podcast feed carries on at the same address, so subscribers keep receiving episodes.

Pro's own extras aren't part of Mattytap Sermons. Its custom layouts give way to the plugin's standard templates. Its extra podcast feeds still answer, but carry every sermon rather than their own selection. Its widgets for Elementor, Divi, Beaver Builder and WPBakery, and its blocks, show nothing. Pages that used Pro's `[smpro_archive]` shortcode show the standard sermon list instead, and pages that used `[smpro_tax]` show just their title.

Nothing of Pro's is deleted, so you can switch back if you need to. Deactivate Sermon Manager Pro and Sermon Manager before activating Mattytap Sermons.

= I'm coming from Church Sermon Manager. What carries over? =

Church Sermon Manager is built on Sermon Manager and includes Sermon Manager Pro's features, so the switch works the same way. Deactivate Church Sermon Manager first, then activate Mattytap Sermons. WordPress won't activate it while the other is still running, though nothing is harmed if you try.

Your sermons, series, preachers, topics, books, service types, images, settings and main podcast feed all carry over. Pages using its sermon archive shortcodes or its sermon grid block show the standard sermon list. Its custom layouts, page-builder widgets and extra podcast feeds behave as described for Sermon Manager Pro above. Nothing is deleted, so you can switch back.

= Can I show my sermons on another website or in a podcast app? =

Yes. Your sermons are published as a podcast feed at your sermon archive's address with `feed/` added, for example `https://example.com/sermons/feed/`. Each series, preacher, topic and book has its own feed too: add `feed/` to the end of its page's address. Podcast apps can subscribe to any of these, and website builders with a podcast or RSS block can show them on another site.

For developers, the same sermons are available as data through the WordPress REST API at `/wp-json/wp/v2/wpfc_sermon`.

= How do I report a bug or request a feature? =

[GitHub Issues](https://github.com/mattytap/Mattytap-Sermons/issues). For security issues, please use [private vulnerability reporting](https://github.com/mattytap/Mattytap-Sermons/security/advisories/new) rather than public issues.

= Does it work with my theme? =

Before 3.8.0 we tested the plugin with 70 free themes from WordPress.org, with Theme Compatibility on and off. The list is on the [3.8.0 release](https://github.com/mattytap/Mattytap-Sermons/releases/tag/v3.8.0). We can't test paid themes, because we don't buy them. Several popular paid themes are add-ons to a free theme we did test (Astra, GeneratePress, Kadence, Neve and OceanWP, for example), so their core has been through the same checks.

If your sermon pages look wrong, first turn on Theme Compatibility under Sermons > Settings > Advanced. It lets your theme draw the page and fixes most layout problems straight away. If that doesn't help, open a support topic. Include the theme's name and version, a link to a sermon page, a screenshot, and what you expected to see. If you're willing to try the fix on your site before it's released, we'll fix it.

= Is there a paid version or commercial support? =

No. Mattytap Sermons is GPLv2 free software with no paid tier, no premium add-ons, and no commercial support. Bug fixes, feature requests, and translation contributions are welcome through GitHub.

== External services ==

Mattytap Sermons doesn't need any outside service to work. A few features do reach one, either in a visitor's browser or from your own site. Each is listed here with what is sent, when, and how to avoid it.

* **Bible verse popups (Faithlife Reftagger).** On sermon pages, the visitor's browser loads a script from api.reftagger.com, which turns Bible references into links that show the verse when hovered. It's on by default, as it was in Sermon Manager. Turn it off under Sermons > Settings > Verse > Verse Popups. Faithlife [terms](https://faithlife.com/terms) and [privacy](https://faithlife.com/privacy).
* **YouTube and Vimeo.** A sermon given a YouTube or Vimeo address in its Video Link field plays in that service's own player, which the visitor's browser loads from YouTube or Vimeo when the sermon is opened. With the Plyr player, the default, YouTube videos come from youtube-nocookie.com, YouTube's reduced-tracking address, though YouTube may still set cookies of its own, and Vimeo is asked not to track the visitor. Plyr also asks noembed.com for a YouTube video's title. A video pasted into the Video Embed Code field plays exactly as pasted. Nothing is embedded unless a sermon has a video. YouTube [terms](https://www.youtube.com/t/terms) and [privacy](https://policies.google.com/privacy). Vimeo [terms](https://vimeo.com/terms) and [privacy](https://vimeo.com/privacy). [noembed](https://noembed.com/).
* **Audio file size.** When a sermon is saved with an audio file address rather than an uploaded file, your site sends a single request to that address to read the file's size for the podcast feed. Only public web addresses are checked, and nothing about your site is sent.
* **PodTrac.** Off by default. If you turn on PodTrac Tracking under Sermons > Settings > Podcast, the audio links in your podcast feed pass through dts.podtrac.com, so podcast apps fetch each episode by way of PodTrac, which counts the download. PodTrac [privacy](https://www.podtrac.com/privacy-policy/).
* **Importing a Sermon Manager export file.** When you import an export file under Sermons > Import/Export, your site downloads each attached file from the address recorded in the export. Only public web addresses are fetched.

The Plyr player's icons are part of the plugin and load from your own site.

== Screenshots ==

1. Sermon Details
2. Sermon Files

== Credits ==

Mattytap Sermons is a restoration of [Sermon Manager for WordPress](https://wordpress.org/plugins/sermon-manager-for-wordpress/), originally by WP for Church (Jason Westbrook and contributors). The full upstream contributor list is recorded in [CONTRIBUTORS.md](https://github.com/mattytap/Mattytap-Sermons/blob/main/CONTRIBUTORS.md). Translations were originally contributed by GITNE (German, Polish), Gilles Pilloud (French), and the Dutch translation behind v2.15.13.

== Changelog ==

= 3.8.1 =

* Fix: with WordPress debugging switched on, page 2 and later of a sermon list showed a PHP "Deprecated" notice about `str_replace()` on PHP 8.1 and later. Inherited from Sermon Manager.
* Fix: the same kind of notice, about `parse_str()`, for a Facebook video link with no settings after a `?` in its address. Nobody reported this one; we found it while fixing the first. Inherited from Sermon Manager.

= 3.8.0 =

A support topic about the Kadence theme prompted a review of how sermon pages sit inside themes. We tested the plugin with 70 free themes, including every default Twenty theme, with Theme Compatibility on and off, and the fixes below came from that. Most of the faults were inherited from Sermon Manager; the sidebar fault was ours. The full list of themes is on the GitHub release.

If a sermon page looks wrong after updating, turn on Theme Compatibility under Sermons > Settings > Advanced, then open a support topic so we can fix it.

* Fix: with Theme Compatibility off, search boxes, dropdowns and other widgets in the theme's sidebar were damaged on sermon pages, and some printed their code as text. This was our fault, from 3.0.
* Fix: on Hueman, a single sermon with a comment caused a critical error, and Customizr showed an empty comment list.
* Fix: with Theme Compatibility off, sermon pages now use the theme's own layout on Blocksy, Colibri, Envo Royal, GeneratePress, Hestia, Kubio, Lightning, Mantra, Neve, OnePress, PopularFX, Sydney, Total, Twenty Ten, Twenty Nineteen, Twenty Twenty and Twenty Twenty-One. Before, they could run edge to edge, drop the sidebar below the sermon, lose the theme's header and footer, or let the footer cover the sermon.
* Fix: with Theme Compatibility off, sermon pages on the other default themes now match their posts: the width on Twenty Eleven and Twenty Thirteen, line spacing on Twenty Twelve, the sidebars on Twenty Thirteen and Twenty Fourteen, the title on Twenty Fifteen, and the margins on Twenty Sixteen phones. On Hueman, sermon content is padded again.
* Fix: on any other theme that floats its columns, the footer no longer rides up behind sermon pages.
* Fix: on phones, the audio player's seek bar no longer shrinks to nothing; on a narrow player the volume slider hides instead. On block themes the player now fills the column.
* Fix: theme button styles no longer reach the audio player (a second play button, square or dark buttons, a seek bar stopping halfway).
* Fix: with Theme Compatibility off, search results showed every sermon twice.
* Fix: on block themes and some others, sermon listings showed each sermon's details as one run-on line. They now show the sermon's description or, where it has none, its date, passage and preacher.
* Fix: on Kubio, sermon pages showed no player or details with Theme Compatibility on, and no reply form with it off.
* Fix: single sermon pages could scroll sideways on phones, from the details row and from large sermon images.
* Fix: the featured image showed twice on Twenty Ten, Twenty Eleven and Twenty Seventeen.
* Fix: on Twenty Fourteen with Theme Compatibility on, sermon pages were squeezed narrower than posts.
* Fix: sermon cards were unreadable on dark themes, and the card image became a narrow strip where a theme lays results out in a grid.
* Fix: a debug notice about loading translations too early, when another theme schedules events while it loads.

= 3.7.1 =

* Fix: with Theme Compatibility off, sermon pages on the Kadence theme now use Kadence's own layout and settings, instead of running edge to edge. Inherited from Sermon Manager.

= 3.7.0 =

* Improved: with the Plyr player, YouTube sermons now play from youtube-nocookie.com, YouTube's reduced-tracking address, and Vimeo is asked not to track visitors. The player's icons now load from your own site instead of cdn.plyr.io. The player looks and works as before.
* Improved: for sites coming from Church Sermon Manager, its sermon grid block now shows the standard sermon list instead of nothing, keeping the block's number of sermons and sort order. Its taxonomy grid block shows nothing, as Sermon Manager Pro's taxonomy shortcode already does.
* Fix: the podcast feed now gives its explicit-content flag as `false`, the form Apple Podcasts currently documents, rather than the older `no`. The meaning is unchanged.
* Fix: podcast episodes in M4A, MP4, M4V or MOV format are now labelled with their own file type in the feed, rather than as MP3. Inherited from Sermon Manager.
* Fix: sermons imported from Sermon Browser or Series Engine with no description no longer show "%todo_render%" as their text. This covers sermons already imported too; the next save replaces it with the usual search summary. Inherited from Sermon Manager.
* Fix: the "Use native player on Safari" setting under Settings > Debug works again. Since 3.1 it had no effect.
* New: readme sections on the outside services the plugin can reach, on showing your sermons elsewhere, and on switching from Church Sermon Manager.

= 3.6.3 =

* Fix: on the All Sermons screen, columns added by other plugins (an SEO plugin's title and description, for instance) are no longer squeezed to nothing with their text one letter per line. Inherited from Sermon Manager.
* New: the `wpfc_sermon_single_title_tag` filter sets the heading tag for the sermon title on single sermon pages, for themes that print no page heading of their own. The default is still `h2`, so nothing changes unless a site uses it.

= 3.6.2 =

* Fix: the `[list_podcasts]` shortcode no longer shows a PHP deprecation notice when `exclude` is left out. Inherited from Sermon Manager.

= 3.6.1 =

* Fix: the `[sermons]` shortcode's `exclude` now leaves out every sermon ID given, not just the first, and no longer shows a PHP warning. Inherited from Sermon Manager.

= 3.6.0 =

* Improved: sermon pages are brought up to date with the themes WordPress has shipped since Sermon Manager's templates were written. On block themes (Twenty Twenty-Two onwards, including the current default, Twenty Twenty-Five), sermon pages now use the theme's own layout instead of WordPress's long-retired fallback header and sidebar, and a sermon template built in the Site Editor is now used. Other themes are unchanged.
* Fix: on Twenty Nineteen and on block themes, a sermon's featured image no longer shows twice.
* Fix: on Twenty Twenty and Twenty Twenty-One, sermon pages no longer end with WordPress's fallback sidebar.
* Fix: the `[sermons]` shortcode's `filter_value` now accepts term IDs, as documented.
* Tested on WordPress 7.1.3, 6.2 and 6.0.

= 3.5.0 =

* New: a landing for sites coming from Sermon Manager Pro. Pages that used Pro's sermon archive shortcode, or its WPBakery and Divi versions, now show the standard sermon list instead of raw shortcode text, and Pro's taxonomy shortcodes no longer show at all. Administrators see a one-time notice explaining what has carried over and what hasn't. Pro's data is left untouched.

= 3.4.10 =

Seven fixes, all inherited from the original Sermon Manager.

* Fix: podcast episodes whose audio link carries extra settings after a question mark, such as Dropbox share links, now point podcast apps at the right file.
* Fix: podcast episode artwork is sent at full size, which podcast directories ask for, rather than as a small thumbnail.
* Fix: a long sermon description containing accented or other non-English letters no longer leaves that episode's subtitle blank in the podcast feed.
* Fix: moving a sermon to a different series, preacher or other group now updates that group's latest-sermon date, so `[latest_series]` shows the right series.
* Fix: on sites whose timezone isn't UTC, the `[sermons]` and `[latest_series]` shortcodes no longer show a future-dated sermon a few hours early, or hold it back a few hours late.
* Fix: on the Divi theme, comments appear once on a sermon page rather than twice.
* Fix: on the Twenty Nineteen theme, sermon pages pick up the plugin's container styling, as they do on other themes.

= 3.4.9 =

* Security: the Video Embed Code field on a sermon is now filtered when it is saved by someone who isn't allowed to post unfiltered HTML, such as an Author. Until now it kept whatever was typed, so an Author could add code that ran in the browser of anyone viewing the sermon. Sites where only Administrators and Editors edit sermons were not exposed. Embed codes from YouTube, Vimeo and similar keep working, and those saved by Administrators and Editors are unchanged. Codes already saved by other users are filtered when the sermon is displayed. The fault was inherited from Sermon Manager, which has carried it since 2017.
* Fix: a video embed sent through the REST API by someone without unfiltered HTML now keeps its YouTube or Vimeo player rather than losing it.
* For developers: `sm_get_sermon_video_embed()` returns a sermon's video embed code ready for `do_shortcode()`, and should be used in place of reading the `sermon_video` meta directly.

= 3.4.8 =

* Fix: videos placed in a sermon's text show on the sermon's own page again. A pasted YouTube embed code was being removed when the page was displayed, and a YouTube link on a line of its own was turned into a player and then removed, leaving a gap. This mostly affects sites that moved here from Sermon Manager 2.30.0, where the video usually sits in the sermon text, and it has done since 3.4.6 began showing that text. Videos added through the Video Link or Video Embed fields were unaffected. No sermon data is changed.

= 3.4.7 =

* Fix: a sermon with no description of its own no longer shows its passage, preacher and series in place of the description text. Version 3.4.6 began reading the sermon's post body wherever the Description field is empty, and on most sites that body holds a short summary the plugin writes there for search rather than any sermon text. That summary is now recognised and left out. Sermons brought over from Sermon Manager 2.30.0 still show their text as they did in 3.4.6.
* Fix: that summary is no longer written over text already in the post. This was found while investigating the fault above, and there have been no reports of anyone losing text to it. Sermons whose text is held in the Description field are unaffected, which covers most sites. It is worth a look if you moved here from Sermon Manager 2.30.0, which had no Description field and kept sermon text in the post itself, or if you have typed into a sermon's editor pane, since text replaced this way cannot be recovered. The summary is now written only where the post is empty or already holds a summary the plugin wrote. Search still matches sermons on preacher, series and passage as before.

= 3.4.6 =

* Fix: sermons brought over from Sermon Manager 2.30.0 show their text again. 2.30.0 stored the sermon body in the post itself rather than in the Description field, so after switching to this plugin those sermons appeared with a title and a date and nothing else, in the sermon list, on the sermon's own page and in the podcast feed. The Description field is still used wherever it holds anything; the post body is now read only when it is empty. No sermon data is changed.
* Fix: text typed into the editor pane on a sermon is displayed again on sites using the plugin's own templates. Since 3.0.2 it had only ever appeared on sites running Theme Compatibility.

= 3.4.5 =

* Fix: a fatal error no longer occurs when Jetpack Sync, or other code running from WordPress's scheduled tasks, sets the admin screen. Sites without Jetpack were unaffected.
* Fix: the `[sermons]` shortcode no longer raises a PHP deprecation warning when all its sermons fit on one page. Visible only on sites running with WP_DEBUG switched on.

= 3.4.4 =

* Fix: the speaker's image appears again beside the speaker's name on sermon archive cards and in the `[sermons]` shortcode, as it did in the original Sermon Manager. Images you have already set are used as they are; nothing needs re-uploading.
* Fix: the `[sermons]` shortcode no longer raises a PHP warning when a page renders it more than once. Visible only on sites running with WP_DEBUG switched on.
* Tested on WordPress 7.1.

= 3.4.3 =

* Fix: reading a sermon's details no longer causes an error on block themes when the current post isn't available. This mainly affected sermon blocks and other code built on the plugin's template functions; classic themes are unaffected.
* Dev: added the missing @since tag to the sm_template_allowed_html() documentation.
* Tested on WordPress 7.0.2.

= 3.4.2 =

* Fix: a sermon with no image of its own again falls back to its series image, rather than dropping straight to the Default Image. This affects the single-sermon view, the archive cards, and the podcast feed image, and restores the behaviour of the original Sermon Manager.

= 3.4.1 =

* Fix: series, speaker, topic, and book images now appear on the correct items again. A one-time migration from the original Sermon Manager could attach images to the wrong terms (or none at all), so the `[sermon_images]` grid showed some items blank and others with the wrong or a duplicated image. This release repairs the affected images automatically from the preserved original data and backs up the prior state first. No action needed; images you set by hand are left untouched.
* New: the `[sermon_images]` grid can optionally include items that have no image, showing your Default Image (Settings > Display) in their place, or a neutral placeholder if no Default Image is set. Off by default, so existing grids are unchanged; add `show_empty="yes"` to the shortcode to switch it on.

= 3.4.0 =

* Fix: the Audio Health report no longer lists local audio as missing when the audio URL was saved as `http://` on a site now served over `https` (for example after an SSL migration). The file is matched regardless of scheme; genuinely missing files are still reported.
* New: each of the six front-end filter dropdowns (speaker, series, topic, book, service type, month) can now be shown or hidden individually under Settings > Display.
* Change: the "Month preached" filter is now hidden by default. Existing sites will see it disappear from the archive filter after updating; switch it back on under Settings > Display > Display Month Filtering. Speaker, series, topic, and book filters are unchanged.

= 3.3.0 =

* Fix: the `[sermon_images]` grid works again. It had stopped finding any images after an earlier change removed a third-party dependency; it now reads series, speaker, topic, and book images directly. You can also order the grid by most recently preached with `orderby="sermon"`.
* Fix: importing now refreshes permalinks automatically, so the sermon archive and feeds work straight after an import instead of needing a manual Settings > Permalinks re-save.
* Fix: video added to a sermon through the REST API is now saved where the templates read it, so API-posted video embeds and links display correctly.
* Fix: a failed import now shows an error notice instead of finishing silently.

= 3.2.0 =

* New: filter and group sermons by the month they were *preached*, not the date they were published, on both the front end and in the admin sermon list. A "Month preached" dropdown joins the existing speaker, series, topic, and book filters on the archive, and the admin list table gains the same preached-month filter (replacing WordPress's default published-date months dropdown for sermons).
* New: optional month headings on the sermon archive, grouping sermons under the month they were preached.
* Fix: the month and year date filters now include the whole of the last day of the range (previously the final day was excluded), compare dates numerically, and no longer depend on the PHP calendar extension.

= 3.1.7 =

* New: the "Audio Health" report's broken-references list now shows each sermon's date preached, preacher, and service type, so a broken audio link is identifiable at a glance without opening the sermon.
* New: an "Audio used by more than one sermon" section on the Audio Health report, listing audio files that two or more sermons share. These are the files the optional delete-cleanup deliberately keeps.

= 3.1.6 =

* New: an optional "Delete Audio On Sermon Deletion" setting under Settings > General. When enabled, permanently deleting a sermon also removes its audio file from the Media Library, but only when no other sermon uses that file. It applies to permanent deletion only, never to sermons moved to Trash, and never touches externally hosted (URL-only) audio. Off by default, so existing sites are unchanged.
* New: an "Audio Health" report under Sermons. Two read-only checks: sermons whose audio attachment or local file is missing (a dead player on an otherwise fine-looking sermon), and audio files in the sermons folder that no sermon references. Nothing on the screen changes or deletes anything.

= 3.1.5 =

* Fixed the dedicated podcast feed: requesting `?feed=podcast` returned a blank page, and now renders the podcast RSS as intended.
* Fixed the next and previous sermon links on a single sermon page, which now follow the date a sermon was preached rather than the date it was published.
* Fixed a fatal error that could occur when using the "Export Sermon Manager" tool under Sermons > Import/Export.
* Fixed a theme-compatibility issue on sites using the Uncode theme, where a header initialisation script was stripped from sermon archive and single pages.

= 3.1.4 =

* New: an "Archive layout" option in Settings > Display, under Archive. Choose Classic (the existing full-width cards, unchanged), Compact list, or Grid for sermon archive pages and the [sermons] shortcode. The shortcode also accepts a layout="classic|compact|grid" attribute to override the setting per page. Classic remains the default, so existing sites are unchanged.
* Updated the bundled CMB2 admin framework from 2.11.0 to 2.12.0, fixing several PHP 8.2/8.3 deprecation notices on the sermon edit screen and a WordPress 7.0 field-styling issue.
* Cleared deprecation notices our own code emitted on current PHP/WordPress: the PHP 8.3 "Calling get_class() without arguments" notices from the sermon date hooks, and the "Hook contextual_help is deprecated" notice from the admin help-tab cleanup (now done on current_screen instead).
* Refreshed the translation template (.pot) so the renamed plugin strings are available to translators.

= 3.1.3 =

* Fixed a fault in the 3.1.2 package that could cause a critical error after installing or updating from WordPress.org. Update to 3.1.3 if you installed 3.1.2. No feature or data changes.

= 3.1.2 =

* Hardened the "Specific Background Updates" debug tool: the submitted value is now validated against the registered list of update routines before anything is executed.
* Escaping pass over filtered template output: the previous/next sermon navigation links, the deprecated v1 sermon renderers, the `[sermons]` shortcode's per-sermon output, and the preacher-image filter on archive cards are now escaped at output with `wp_kses`. The sermon-template allowlist now admits provider iframes so pasted video embed codes continue to render.
* The Uncode theme-compatibility init call is now printed via `wp_print_inline_script_tag()` instead of a hand-built script tag.

= 3.1.1 =

* Completed the Mattytap Sermons rename in user-visible admin text. The settings and Import/Export screens, the plugins-page action link, several settings descriptions, and two front-end error messages still displayed "Sermon Works"; all now read "Mattytap Sermons". The settings page heading is now also translatable.
* Fixed a PHP warning (undefined array key "display") in the `[sermon_images]` shortcode when no matching term images exist.
* Replaced `wp_reset_query()` with `wp_reset_postdata()` after the podcast feed's secondary loop, the correct reset for a custom WP_Query.

= 3.1 =

First stable release of the renamed Mattytap Sermons line, and the first WordPress.org submission. No runtime change against 3.1-rc3: this entry promotes the release-candidate cycle to stable. The rc1, rc2, and rc3 entries below record the rename from Sermon Works, the ten WordPress.org pre-review fixes, the three rc1 playback and widget regressions, and the WordPress 6.0 to 6.8 export-compatibility fix closed during the candidate cycle.

Earlier versions, from the 3.0 restoration to the 3.1 release candidates, are in [changelog.txt](https://github.com/mattytap/Mattytap-Sermons/blob/main/changelog.txt).

== Upgrade Notice ==

= 3.8.1 =

Stops two PHP notices that show only with debugging switched on. Nothing on your pages changes; no data changes.

= 3.8.0 =

Sermon pages change on many themes, from testing 70 free themes. Fixes a crash on Hueman and sidebar search boxes we broke in 3.0. No data changes. If a sermon page looks wrong, turn on Theme Compatibility (Sermons > Settings > Advanced) and open a support topic.

= 3.7.1 =

Sermon pages now follow the Kadence theme's layout. Other themes are unchanged; no data changes.

= 3.7.0 =

Privacy and podcast feed improvements, a landing for sites coming from Church Sermon Manager, and three fixes. Sermon pages look the same as before; no data migration.

= 3.6.3 =

Fixes extra columns from other plugins collapsing on the All Sermons screen, and adds a filter for the single sermon title's heading tag. Sermon pages look the same as before; no data migration.

= 3.6.2 =

Fixes a PHP deprecation notice from the `[list_podcasts]` shortcode when `exclude` is left out. Output is unchanged; no data migration.

= 3.6.1 =

Fixes the `[sermons]` shortcode's `exclude` option, which only left out the first sermon and showed a PHP warning. Sites not using `exclude` see no change; no data migration.

= 3.6.0 =

Brings Sermon Manager's sermon pages up to date with WordPress's newer default themes, including the block themes from Twenty Twenty-Two onwards. Sites on other themes see no change; no data migration.

= 3.5.0 =

Adds a landing for sites coming from Sermon Manager Pro: no more raw shortcode text, and a one-time notice explaining the switch. Nothing changes on other sites; no data migration.

= 3.4.10 =

Seven fixes inherited from Sermon Manager: podcast feed links, artwork and subtitles, series dates, timezones, Divi comments and Twenty Nineteen styling. Recommended for all sites; no data migration.

= 3.4.9 =

Security release. Filters the Video Embed Code field for users who can't post unfiltered HTML, such as Authors. Sites where only Administrators and Editors edit sermons were not exposed. Recommended for all sites; no data change.

= 3.4.8 =

Restores videos placed in a sermon's text, which were being removed from the sermon's own page. Mostly affects sites that moved here from Sermon Manager 2.30.0. Recommended for all sites; no data change.

= 3.4.7 =

Fixes a sermon with no description of its own showing its passage, preacher and series in place of one, which 3.4.6 introduced. Also closes a fault found while investigating that, with no reports of anyone losing text to it: the same summary line could be written over text already in the post. Sermons whose text is in the Description field are unaffected. Recommended for all sites.

= 3.4.6 =

Restores sermon text on sites that moved here from Sermon Manager 2.30.0, where descriptions could appear blank in the sermon list, on the sermon page and in the podcast feed. Recommended for all sites; no data change.

= 3.4.5 =

Fixes a fatal error on sites running Jetpack Sync, and clears a debug-only warning from the [sermons] shortcode. Recommended for all sites; no data change.

= 3.4.4 =

Restores the speaker image on archive cards and in the [sermons] shortcode, and clears a debug-only warning from the shortcode. Tested on WordPress 7.1. Safe for all sites; no data change.

= 3.4.3 =

A small maintenance release: fixes a possible error when sermon details are read on block themes without a current post, and confirms compatibility with WordPress 7.0.2. Safe for all sites; no data change.

= 3.4.2 =

Restores the series-image fallback for sermons that have no image of their own (single view, archive, and podcast feed), matching the original plugin. Recommended for sites that rely on series images.

= 3.4.1 =

Recommended for any site using series/speaker/topic/book images. Repairs images that an earlier migration could attach to the wrong term, which left some [sermon_images] entries blank or showing the wrong image. The repair runs automatically and backs up the prior state; images set by hand are preserved.

= 3.4.0 =

Recommended for all sites. Fixes a false "missing audio" report on https sites whose audio links were saved as http://, and lets you show or hide each front-end filter under Settings > Display. Note: the Month filter is now hidden by default; re-enable it under Settings > Display if you want it. No data change.

= 3.3.0 =

A maintenance release: restores the [sermon_images] grid, makes feeds work straight after an import, fixes REST-API video saving, and adds an import-failure notice. No data change.

= 3.2.0 =

Adds the ability to filter and group sermons by the month they were preached, front end and admin, plus fixes to the month/year date range. Read-only over your data: no sermon dates are rewritten.

= 3.1.7 =

Adds the date preached, preacher, and service type to the Audio Health report's broken-references list, and a new section listing audio shared by more than one sermon. Read-only report changes only. No data change.

= 3.1.6 =

Adds an optional setting to delete a sermon's audio file when the sermon is permanently deleted (off by default, never touches Trash or shared/external audio), and a read-only "Audio Health" report under Sermons for finding broken and orphaned sermon audio. No data change.

= 3.1.5 =

Bug-fix release: restores the `?feed=podcast` feed, orders single-sermon next/previous links by preached date, fixes a fatal in the Sermon Manager export tool, and preserves the Uncode theme init script. No data change.

= 3.1.4 =

Adds an optional Archive layout (Classic/Compact/Grid) for archives and the [sermons] shortcode, and updates the bundled CMB2 framework for PHP 8.2/8.3 and WordPress 7.0. Classic stays the default, so no visible change unless you choose otherwise. No data change.

= 3.1.3 =

Fixes a fault in the 3.1.2 package that could cause a critical error after install or update. Update if you installed 3.1.2. No feature or data changes.

= 3.1.2 =

Security hardening: output escaping on sermon templates and validation of the debug update-runner. No functional or data change; safe upgrade from 3.1.x.

= 3.1.1 =

Completes the plugin rename in user-visible admin text. No functional or data change; safe upgrade from 3.1.

= 3.1 =

First stable release of Mattytap Sermons. No data migration. Existing 3.0.x and Sermon Works installs migrate by deactivating the old plugin and activating Mattytap Sermons; existing Sermon Manager installs (including 2.30.0) can switch as a drop-in replacement.

= 3.1-rc3 =

Fixes a sermon-export fatal on WordPress 6.0 through 6.8 (the exporter called a function only added in WordPress 6.9). No data migration. Sites on WordPress 6.9 or later are unaffected.

= 3.1-rc2 =

Three rc1 playback and widget regressions fixed: YouTube embed seek-on-load no longer throws after the Plyr 3.7 upgrade; `<audio>` / `<video>` elements again include their `<source>` children; the sermon archive sort widget renders its `<option>` tags. No data migration.

= 3.1-rc1 =

Plugin renamed from Sermon Works to Mattytap Sermons under the WordPress.org slug `mattytap-sermons`. Database, content, post type, taxonomies, and front-end render unchanged. Migrate by activating Mattytap Sermons and deactivating Sermon Works. Also closes ten technical items raised by the WordPress.org plugin reviewer's automated pre-review of 3.0.2.

= 3.0.2 =

Editor-pane render fix following 3.0.1. Content typed into the WordPress editor on the edit-sermon screen now renders on the front-end alongside the existing `sermon_description` rendering. Existing sermons unaffected; no data migration.

= 3.0.1 =

Drop-in compatibility cherry-picks from upstream 2.30.0: multi-attachments rendering for notes and bulletin (closes a render gap on sites that ran the upstream multi-attachments migration), post-body editor support, and Twenty Twenty-Four theme wrapper. Database and front-end render unchanged for existing sites.

= 3.0 =

Plugin renamed from Sermon Manager to Sermon Works; database and content unchanged. Migrate by activating Sermon Works and deactivating Sermon Manager. Includes fixes for three CVEs filed against the upstream Sermon Manager codebase.
