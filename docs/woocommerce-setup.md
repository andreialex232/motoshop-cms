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

## Shipping

Shipping is configured under **WooCommerce > Settings > Shipping**. The theme does not contain any shipping
code, it only shows the result in the cart, at checkout and on the order confirmation.

### Zones and methods

WooCommerce matches a customer to the **first** zone that fits their address, so the order of the zones matters.

| Zone | Regions | Shipping methods |
| --- | --- | --- |
| Local Showroom & Pickup | Denmark, postcodes 6700, 6705, 6710, 6715 (Esbjerg area) | Showroom Pickup (Esbjerg); Local Courier / Parcel Delivery |
| Denmark - Domestic | Denmark | Standard Delivery (GLS / PostNord); Free Shipping for orders over 1.000 kr. |
| Neighboring states | Norway, Sweden, Germany, Poland, Netherlands | International Tracked Courier (DHL / UPS) |
| Rest of the world | All other regions | No shipping methods offered |

### How it works for the customer

- Customers in Esbjerg can collect the order at the showroom or have it delivered by local courier.
- The rest of Denmark gets standard delivery, and delivery is free from 1.000 kr.
- Customers in the five neighbouring countries get tracked international delivery.
- Customers elsewhere cannot check out, because no shipping method is offered for them.
- Shipping and billing address are shown as two cards on the order confirmation page.
