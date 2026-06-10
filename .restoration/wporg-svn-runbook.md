# WordPress.org SVN runbook

How this plugin ships to WordPress.org once (and after) the plugin review
approves the `mattytap-sermons` slug. Written 2026-06-10, ahead of
acceptance, so acceptance day is a checklist rather than a research
session.

## How WP.org distribution works

GitHub is the development home; WordPress.org runs its own SVN repository
per plugin (`https://plugins.svn.wordpress.org/mattytap-sermons/`) which is
purely a release-shipping mechanism, not a development repo. It has three
parts:

- `trunk/` — the current plugin code. The `Stable tag:` in trunk's
  `readme.txt` tells WP.org which tag users actually download.
- `tags/<version>/` — one frozen copy per release (e.g. `tags/3.1.1/`).
- `assets/` — the listing artwork: `banner-772x250.png`,
  `banner-1544x500.png`, `icon-256x256.png`, `icon-128x128.png`,
  `screenshot-N.png`. These live ONLY in SVN assets/, never inside the
  plugin itself. In this repo they are kept under `.wordpress-org/`.

After the first approval, releases ship straight to SVN with no further
human review.

## One-time setup on acceptance day

1. The approval email arrives at scappylappy@gmail.com with the SVN URL.
   SVN credentials are the wordpress.org account (`mattytap`) and a
   wordpress.org SVN password (set/confirm via wordpress.org profile;
   record in the password manager).
2. Add the two repository secrets (values prompt interactively):
   `gh secret set SVN_USERNAME` and `gh secret set SVN_PASSWORD`.
3. First deploy, dry run: Actions tab, "Deploy to WordPress.org SVN",
   select the release tag (v3.1.1) as the ref, leave `dry_run = true`.
   Inspect the log: file list rsync'd to trunk, assets list, version
   detected.
4. Re-run with `dry_run = false`. This commits trunk, creates
   `tags/3.1.1/`, and uploads `.wordpress-org/` to assets/.
5. Verify the live page at <https://wordpress.org/plugins/mattytap-sermons/>:
   banner and icon render, version reads 3.1.1, the Download button serves
   a working ZIP (install it once on a scratch site).
6. Subscribe to the plugin's support forum (per-plugin email setting on
   the wordpress.org profile) so support threads aren't missed.

## Every subsequent release

1. Cut the release exactly as now: version bump commit, annotated tag,
   GitHub Release with the dist ZIP.
2. Run "Deploy to WordPress.org SVN" against the new tag (dry run first
   while the process is still new). The action reads the version from the
   plugin headers, populates trunk, and creates the matching SVN tag.
3. Once trusted, flip the workflow trigger to fire automatically on
   published (non-prerelease) GitHub releases; instructions are in the
   workflow header comment.

## Assets and readme between releases

Screenshots, banner tweaks, FAQ/readme edits, and "Tested up to" bumps do
NOT need a plugin release: run "Update WordPress.org assets and readme"
(wporg-assets.yml), which pushes `.wordpress-org/` and `readme.txt` to SVN
without touching the shipped code.

## Screenshots (still to capture)

Captured from a browser against a 3.1.1 install (the staging site, once
updated; capture admin screens only AFTER 3.1.1 is active or the old
branding shows). Save as PNG into `.wordpress-org/`:

| File | Shows |
|---|---|
| screenshot-1.png | Sermon archive page (front end) |
| screenshot-2.png | Single sermon with the audio player |
| screenshot-3.png | Edit Sermon admin screen (details metabox) |
| screenshot-4.png | Settings page, General tab |
| screenshot-5.png | Import/Export screen |

When the captures land, update the `== Screenshots ==` section of
`readme.txt` to five numbered captions matching the files (the captions on
the plugin page come from there), then ship via the asset-update workflow
(plus a readme-only trunk update) or fold into the next release.

## Packaging parity note

`.distignore` (used by the deploy action) must stay in sync with the
allow-list in `bin/build-release-zip.ps1`: same eight shipped paths
(sermons.php, readme.txt, changelog.txt, LICENSE, assets/, includes/,
languages/, views/). If one changes, change the other.
