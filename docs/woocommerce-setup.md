# WooCommerce setup

Settings that live in the WordPress / WooCommerce admin and are therefore not part of the theme code.
The theme only styles the result.

## Coupons

The banner on the shop page promotes a first-order discount. Create the matching coupon under
**Marketing > Coupons**:

| Setting | Value |
| --- | --- |
| Coupon code | `HALLOWEEN10` |
| Discount type | Percentage discount |
| Coupon amount | `10` |
| Usage limit per user | `1` (first order only) |
| Expiry date | End of the campaign |

The code can be entered in the coupon field on the cart page and on the checkout page. When it is applied it
shows up as a removable badge in the cart totals.

## Payments (Stripe)

- Plugin: **WooCommerce Stripe Payment Gateway**, configured under **WooCommerce > Settings > Payments**.
- While developing, keep the gateway in **test mode** and pay with Stripe's test card
  `4242 4242 4242 4242` (any future expiry date, any CVC).
- Card details are entered in Stripe's payment element, so they never reach our server.
- The look of the payment element is controlled from `functions.php` through the `wc_stripe_upe_params` filter
  (input padding, label weight and colour). The cached appearance transients are deleted on every request so
  style changes show up immediately.

