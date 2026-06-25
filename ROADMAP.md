# ROADMAP

Mattytap Sermons is a caretaker restoration, and the restoration is complete. This file used to track the features that might come next. It now records the project's settled posture and the short list of things that could still land if someone makes the case.

## Maintenance mode

The restoration is complete. Mattytap Sermons is published, live on WordPress.org, and running in production. The security backlog is cleared, the codebase is modernised, and drop-in compatibility with Sermon Manager 2.30.0 is in place. The job it set out to do is done.

From here the plugin is maintained, not developed:

- **Bugs get fixed.** File it on the [issue tracker](https://github.com/mattytap/Mattytap-Sermons/issues) and it will be looked at.
- **Security findings get fixed,** and take priority. Report them privately through [SECURITY.md](SECURITY.md).
- **Compatibility is kept current.** Each WordPress release, the "Tested up to" version is checked and kept honest.

New features are a different matter. "Fix not change" is the working stance, and a caretaker restoration earns trust by staying stable, not by growing. Enhancement requests are welcome, but most will be politely declined. The door isn't bolted shut: a genuinely compelling, well-scoped contribution that fits the plugin's purpose can still land. But nothing is planned, and a missing feature is not a backlog item waiting its turn.

There is no paid tier and no plan to introduce one. The plugin is, and will remain, free and GPLv2.

## What shipped

The restoration scope, now complete:

- All security audit findings (`#13`–`#37`) shipped with patches, including three publicly-disclosed CVEs (CVE-2025-12368, CVE-2025-63000, CVE-2025-63002).
- Codebase modernised against current PHP (8.1+ floor) and WordPress (6.0+ floor) APIs.
- Drop-in compatibility preserved for existing Sermon Manager 2.30.0 installs: the `wpfc_sermon` custom post type, the `wpfc_*` taxonomies, the core option keys, the six shortcodes, and the view-template surface.
- Salvaged upstream bug fixes ingested with attribution from the open-PR backlog.
- Published to WordPress.org as `mattytap-sermons` (approved 2026-06-15), with maintenance releases shipping across the 3.x line since.

## What could still land

No commitment, no timeline, nothing planned. These are the kinds of contributions that would get a fair hearing if someone brought a compelling, well-scoped pull request:

- **Per-sermon structured data.** schema.org markup describing each sermon (speaker, date, audio file) so search engines and podcast directories can surface the preaching. Server-side, no toolchain, squarely within the caretaker remit.
- **Accessibility.** A WCAG 2.1 AA pass over the front-end templates.
- **Performance.** Lazy-loaded sermon images, podcast feed caching.

(Gutenberg / block-theme support used to head this list. It has not been dropped, it has moved to *Out of scope* below: still wanted, but deliberately delivered as a separate companion plugin rather than baked into the core. See that section for the reasoning.)

The bar is the same in each case: it has to fit a caretaker restoration and earn its place against "fix not change." Best-practice contributions (security, accessibility, performance, modern APIs) have the clearest path; radical scope changes do not.

## Out of scope

- **A paid tier.** The original "Pro" pitch is closed; nothing from it carries over.
- **A build-toolchain modernisation (asset pipeline).** The current SCSS and asset build works without a Node commitment; tying the project to a webpack or npm toolchain is not justified for a caretaker restoration. Considered and declined.
- **Gutenberg / block-theme support inside the core plugin.** Block themes are where WordPress is heading, and proper block support matters, but it will not be bundled into this plugin. The core stays a faithful, stable, toolchain-free drop-in; folding a JavaScript build pipeline and a fast-moving block layer into it would compromise the very stability and simplicity that make it a trustworthy replacement. If block support is built, it ships as a **separate companion plugin, `mattytap-sermons-blocks`**, that depends on this one. It is demand-led (built when users ask for it, not before) and open for community contributors to lead. The split is deliberately reversible: a separate add-on can be promoted into the core later far more easily than a bundled feature can be pulled back out.
- **Per-theme compatibility shims** (e.g. zerif-lite).
- **Removing CMB2.** CMB2 is bundled and kept current.

## Known latent risks (not features)

- **CMB2 class collisions.** The bundled `CMB2_*` classes can in principle collide with another active plugin that bundles a different CMB2 version, depending on load order. CMB2's own bootstrap arbitration handles the common cases, and no real-world collision has been reported against Mattytap Sermons. Namespacing the bundled copy would close the gap for good, but it is a substantial mechanical refactor across the vendor tree; it would be revisited if a genuine collision is reported, in keeping with "fix not change."

## How to nominate a feature

Open an [issue](https://github.com/mattytap/Mattytap-Sermons/issues/new/choose) and make the case. The bar for adding a feature is higher than the bar for fixing a bug. Mattytap Sermons is a caretaker restoration and "fix not change" is the working stance. Requests aligned with current best practice (accessibility, performance, modern WordPress APIs) have the clearest path; radical scope changes will be declined. See [CONTRIBUTING.md](.github/CONTRIBUTING.md) for what makes a strong feature request.
