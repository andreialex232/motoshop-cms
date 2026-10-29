# Spike: security

- **Sprint:** 2
- **Time box:** 8 hours
- **Question:** Where can the theme and the repository leak data or be abused, and what do we fix in code
  versus in WordPress configuration?

## Method

- Reviewed all templates and form handlers (`contact`, `test ride`) against the OWASP top 10.
- Reviewed what is tracked in git and what ended up in the working folder (backups, logs, plugin data).
- Looked at what the Wordfence plugin reports and how UpdraftPlus stores its backups.

## Findings and decisions

| # | Risk | Decision | Where |
| --- | --- | --- | --- |
| 1 | The contact and test ride forms can be submitted from other sites (CSRF). | Add a WordPress nonce to both forms and verify it in the handler. | `page-contact.php`, `page-test-ride.php`, `functions.php` |
| 2 | Bots can spam the forms and our mailbox. | Add a hidden honeypot field, requests that fill it are dropped silently. | same as above |
| 3 | Input can contain markup or script (XSS, header injection). | Keep sanitising every field (`sanitize_text_field()`, `sanitize_email()`, `sanitize_textarea_field()`) and escape all output with `esc_html()`, `esc_url()` and `esc_attr()`. | all templates (already in place) |
| 4 | Theme files can be requested directly and run outside WordPress. | Stop with `exit` when `ABSPATH` is not defined, and add an empty `index.php` to `wp-content/`. | every PHP file |
| 5 | Backups, firewall logs and caches could be committed by accident. | Ignore `wflogs`, `updraft`, `cache`, `uploads`, `*.log`, `wordfence-waf.php` and `.user.ini`. | `.gitignore` |
| 6 | Card data. | Payments will use Stripe's hosted payment element, so card numbers never reach our server. | decided for sprint 3 |

## Configuration (outside the repository)

- Keep WordPress core, WooCommerce and plugins updated.
- Enable the Wordfence firewall and login attempt limiting.
- Use strong admin passwords and do not use the `admin` username.
- Keep database credentials and API keys in `wp-config.php` only. The root of the repository is ignored,
  so this file can never be committed.

## Follow-ups

- Re-check the checkout and account pages when they are built (sprint 3).
