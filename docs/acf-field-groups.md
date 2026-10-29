# ACF field groups

The theme gets its editable content from [Advanced Custom Fields](https://www.advancedcustomfields.com/).
The field groups are created in the WordPress admin and are not stored in this repository, so this
file documents what the templates expect. Field names must match exactly.

## Front page (`front-page.php`, page template "Front Page")

### Hero and brand message

| Field name | Type | Used for |
| --- | --- | --- |
| `hero-tagline` | Text | Small tagline above the title |
| `hero-title` | Text | Main `h1` of the page |
| `hero-description` | Textarea | Intro paragraph |
| `hero-image` | Image (return format: URL) | Hero picture, the title is used as alt text |
| `brand-title` | Text | Heading of the brand message (falls back to "Why choose Moto Shop") |
| `brand-description` | Textarea | Brand message text (has a default fallback) |

### Featured video

| Field name | Type | Used for |
| --- | --- | --- |
| `video_title` | Text | Heading above the video |
| `featured_video` | oEmbed or iframe embed code | Video. Only `<iframe>` tags are allowed through `wp_kses()` and `loading="lazy"` is added |

### Testimonials

| Field name | Type | Used for |
| --- | --- | --- |
| `testimonials_title` | Text | Section heading (falls back to "Customer feedback") |
| `testimonial_1_active` ... `testimonial_3_active` | True / False | Show or hide the testimonial |
| `testimonial_1_name` ... `testimonial_3_name` | Text | Customer name. A testimonial without a name is never shown |
| `testimonial_1_avatar` ... `testimonial_3_avatar` | Image (return format: URL) | Optional portrait |
| `testimonial_1_rating` ... `testimonial_3_rating` | Number (1-5) | Star rating. Values are clamped to 1-5, empty means 5 |
| `testimonial_1_quote` ... `testimonial_3_quote` | Textarea | The review text |

Tip: create the three testimonials in one field group and use conditional logic on the `_active` switch so
editors only see the fields of testimonials that are switched on.

## Contact page (`page-contact.php`, page template "Contact Page")

| Field name | Type | Used for |
| --- | --- | --- |
| `hours_mon_fri` | Text | Opening hours line, default "Monday - Friday: 9 AM - 6 PM" |
| `hours_saturday` | Text | Opening hours line, default "Saturday: 10 AM - 4 PM" |
| `hours_sunday` | Text | Opening hours line, default "Sunday: Closed" |
| `storefront_image` | Image (return format: URL) | Photo of the showroom |
| `storefront_caption` | Text | Caption and alt text for the photo |
