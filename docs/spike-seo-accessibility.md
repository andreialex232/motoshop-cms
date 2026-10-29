# Spike: SEO and accessibility

- **Sprint:** 2
- **Time box:** 4 hours
- **Question:** What does the theme need so that its pages are easy to find and usable with a keyboard and a
  screen reader, and what can we apply right away?

## Method

- Walked through the front page, blog and contact page with keyboard only (`Tab`, `Shift+Tab`, `Enter`, `Esc`).
- Checked pages with browser tooling (Lighthouse, WAVE and the Siteimprove browser extension).
- Read the WordPress theme handbook on `title-tag`, `wp_body_open()` and the template hierarchy.

## Findings and decisions

| # | Finding | Decision | Where |
| --- | --- | --- | --- |
| 1 | Pages have no meta description, search engines pick a random snippet. | Generate one per template: excerpt or trimmed content, with a site wide fallback, cut at 160 characters. | `functions.php` - `motoshop_dynamic_meta_description()` |
| 2 | Keyboard users have to tab through the whole navigation on every page. | Add a "Skip to main content" link as the first focusable element and call `wp_body_open()`. | `header.php`, `style.css` |
| 3 | The mobile menu cannot be closed with the keyboard. | `Esc` closes the menu, moves focus back to the toggle and keeps `aria-expanded` / `aria-label` in sync. | `assets/main.js` |
| 4 | We need a way to hide text visually but keep it for screen readers. | Add a `.sr-only` utility class. | `style.css` |
| 5 | We want to measure traffic without a heavy analytics script. | Use Burst Statistics. Its must-use plugin keeps the REST API fast, so it is tracked in the repo. | `wp-content/mu-plugins/` |

## Guidelines for the next sprint

- One `h1` per page and a logical heading order.
- Text contrast of at least 7:1 (WCAG AAA 1.4.6) and click targets of at least 44 x 44 px (WCAG 2.5.5).
- Icon-only links and buttons get an `aria-label`, decorative SVGs get `aria-hidden="true"`.
- Meaningful `alt` text on images, `loading="lazy"` on images and iframes below the fold.
- Check every new page with the Siteimprove extension before the pull request is merged.

## Not doing now

- XML sitemap, robots rules and structured data are left to WordPress / WooCommerce defaults for now.
  We revisit them when the shop content is complete.
