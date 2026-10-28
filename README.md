# MotoShop - WordPress / WooCommerce theme

Custom WordPress theme (`cmsdm`) for **MotoShop**, a motorcycle and rider-gear web shop.
Built from scratch for the 3rd semester CMS exam project.

## Features

- Front page with hero, brand message, featured video and customer testimonials (content managed with ACF)
- Blog feed and single post view with comments
- WooCommerce shop: catalogue, product details, cart, coupons, checkout with Stripe, customer account
- Contact page and multi-step test ride booking form, both with email notifications
- Sustainability initiatives page
- Built with accessibility (WCAG) and SEO in mind

## Tech stack

| Area | Tools |
| --- | --- |
| CMS | WordPress 6.x, custom theme `cmsdm` |
| Shop | WooCommerce, WooCommerce Stripe Payment Gateway |
| Content | Advanced Custom Fields (ACF) |
| Analytics | Burst Statistics |
| Frontend | PHP templates, hand-written CSS, vanilla JavaScript |
| Local dev | Local WordPress install with Mailpit for catching test emails |

## Repository layout

Only the parts we wrote ourselves are tracked (see `.gitignore`).

```
wp-content/
  mu-plugins/         must-use plugins
  themes/cmsdm/       the custom theme
    assets/           JavaScript and images
    *.php             templates
    style.css         all styles
docs/                 spike results and setup notes
.github/              issue / PR templates and CI
```

## Getting started

1. Install WordPress locally (Local, DDEV or similar) and set up Mailpit for outgoing mail.
2. Install and activate the plugins: WooCommerce, Advanced Custom Fields, WooCommerce Stripe Payment Gateway.
3. Copy `wp-content/themes/cmsdm` into your `wp-content/themes/` folder and activate **CMSDM**.
4. Create the pages and assign the page templates:

   | Page | Slug | Template |
   | --- | --- | --- |
   | Home | - | Front Page |
   | Blog | `blog` | (set as *Posts page* under Settings > Reading) |
   | Test ride | `test` | Test Ride Dialogue Form |
   | Sustainability | `sustainability` | Sustainability Page |
   | Contact | `contact` | Contact Page |

   Shop, Cart, Checkout and My account are created by WooCommerce.
5. Create the ACF field groups described in [`docs/acf-field-groups.md`](docs/acf-field-groups.md).

## Workflow

- Work is planned in sprints in Scrumwise; every backlog item has a GitHub issue and every sprint a milestone.
- `main` is protected. Work happens on a branch per issue (`feature/<issue>-<short-name>`), is merged through a pull request that closes the issue.
- Commit messages follow [Conventional Commits](https://www.conventionalcommits.org/) (`feat:`, `fix:`, `style:`, `docs:`, `chore:`).
